<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\ApplicantProfile;
use App\Models\Application;
use App\Models\Log;
use App\Services\ApplicationNotificationService;
use Illuminate\Http\Request;

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
    public function index($id)
    {
        $application = Application::with([
            'user.applicantProfile',
            'user.applicantProfile.education',
            'user.applicantProfile.skills',
            'user.applicantProfile.experiences',
        ])
            ->where('id', $id)
            ->firstOrFail();

        $application->application_status = 'in_review';
        $application->save();

        Log::create([
            'previous_status' => 'applied',
            'new_status' => 'in_review',
            'application_id' => $application->id,
            'changed_at' => now(),
        ]);
        return view('company.application.detail', compact('application'));
    }


    public function confirmReview($id)
    {
        $application = Application::findOrFail($id);

        if ($application->application_status === 'applied') {
            $application->update([
                'application_status' => 'in_review',
            ]);

            Log::create([
                'previous_status' => 'applied',
                'new_status' => 'in_review',
                'application_id' => $application->id,
                'changed_at' => now(),
            ]);

            if (request()->has('remember')) {
                $minutes = 60 * 24 * 30;
                cookie()->queue('confirmed_application_' . $id, true, $minutes);
            } else {
                session()->put('confirmed_application_' . $id, true);
            }
        }

        return redirect()->route('company.application.detail', $id);
    }
}
