<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\ApplicantProfile;
use App\Models\Application;
use App\Models\JobPosting;
use App\Models\Log;
use App\Services\ApplicationNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    protected $notificationService;

    public function __construct(ApplicationNotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function scheduleInterview(Request $request, Application $application)
    {
        $application->load(['user', 'jobPosting.companyProfile']);

        $validated = $request->validate([
            'interview_date' => 'required|date|after:now',
            'location' => 'required|string|max:255',
            'notes' => 'nullable|string'
        ]);

        try {
            $this->notificationService->scheduleInterview($application, $validated);
            return redirect()->back()->with('success', 'Interview scheduled successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to schedule interview: ' . $e->getMessage());
        }
    }

    public function accept(Request $request, Application $application)
    {
        $application->load(['user', 'jobPosting.companyProfile']);

        $validated = $request->validate([
            'start_date' => 'required|date|after:now',
            'additional_info' => 'nullable|string'
        ]);

        try {
            $this->notificationService->acceptApplication($application, $validated);
            return redirect()->back()->with('success', 'Application accepted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to accept application: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, Application $application)
    {
        $application->load(['user', 'jobPosting.companyProfile']);

        $validated = $request->validate([
            'rejection_reason' => 'required|string'
        ]);

        try {
            $this->notificationService->rejectApplication($application, $validated);
            return redirect()->back()->with('success', 'Application rejected successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to reject application: ' . $e->getMessage());
        }
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $companyProfile = $user->companyProfile;

        if (!$companyProfile) {
            return redirect()->route('register.company')
                ->with('error', 'Please complete your company profile first.');
        }

        $query = Application::whereHas('jobPosting', function ($q) use ($companyProfile) {
            $q->where('company_profile_id', $companyProfile->id);
        })->with(['user.applicantProfile', 'jobPosting']);

        if ($request->filled('search')) {
            $query->whereHas('user.applicantProfile', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($request) {
                        $userQuery->where('email', 'like', '%' . $request->search . '%');
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('application_status', $request->status);
        }

        if ($request->filled('job_posting')) {
            $query->where('job_posting_id', $request->job_posting);
        }

        $applications = $query->latest('applied_at')->paginate(12);

        $jobPostings = JobPosting::where('company_profile_id', $companyProfile->id)->get();

        return view('company.application.index', compact(
            'applications',
            'jobPostings'
        ));
    }

    public function detail($id)
    {
        $application = Application::with([
            'user.applicantProfile',
            'user.applicantProfile.educations',
            'user.applicantProfile.skills',
            'user.applicantProfile.experiences',
            'jobPosting'
        ])
            ->where('id', $id)
            ->firstOrFail();

        if (
            $application->application_status === 'applied'
            && request()->has('confirmed')
            && !session()->has('application_viewed_' . $id)
        ) {

            $application->application_status = 'in_review';
            $application->save();

            Log::create([
                'previous_status' => 'applied',
                'new_status' => 'in_review',
                'application_id' => $application->id,
                'changed_at' => now(),
            ]);


            session()->put('application_viewed_' . $id, true);
        }

        return view('company.application.detail', compact('application'));
    }

    public function updateStatus($id, $status)
    {
        $application = Application::findOrFail($id);
        $previousStatus = $application->application_status;

        $allowedStatuses = ['interview', 'hired', 'rejected'];
        if (!in_array($status, $allowedStatuses)) {
            return redirect()->back()->with('error', 'Invalid status!');
        }

        $application->update([
            'application_status' => $status
        ]);

        Log::create([
            'previous_status' => $previousStatus,
            'new_status' => $status,
            'application_id' => $application->id,
            'changed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Application status updated successfully');
    }
}
