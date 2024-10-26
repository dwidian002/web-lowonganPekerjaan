<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\FieldOfWork;
use App\Models\JobCategory;
use App\Models\JobPosting;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JobPostingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $companyProfile = $user->companyProfile;

        if (!$companyProfile) {
            return redirect()->route('register.company')
                ->with('error', 'Please complete your company profile first.');
        }

        $jobPostings = JobPosting::where('company_profile_id', $companyProfile->id)
            ->with(['location', 'jobCategory', 'companyProfile', 'fieldOfWork']) // Tambahkan fieldOfWork
            ->latest()
            ->paginate(9);

        return view('job-posting.list', compact('jobPostings'));
    }

    public function add()
    {
        try {
            $user = auth()->user();
            $companyProfile = $user->companyProfile;

            if (!$user) {
                return redirect()->route('login')
                    ->with('error', 'Please login to create a job posting.');
            }

            if (!$companyProfile) {
                return redirect()->route('company-profile.create')
                    ->with('error', 'Please complete your company profile first.');
            }

            $locations = Location::all();
            $fieldOfWorks = FieldOfWork::all();
            $categories = JobCategory::all();

            return view('job-posting.add', compact(
                'companyProfile',
                'locations',
                'fieldOfWorks',
                'categories'
            ));
        } catch (\Exception $e) {
            Log::error('Job posting add error: ' . $e->getMessage());
            return redirect()->route('job-posting.index')
                ->with('error', 'Unable to access job posting form. ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'position' => 'required|string|max:255',
                'location_id' => 'required|exists:locations,id',
                'field_of_work_id' => 'required|exists:fields_of_work,id',
                'gaji' => 'required|numeric|min:0',
                'sembunyikan_gaji' => 'sometimes|boolean',
                'job_description' => 'required|string',
                'requirements_description' => 'required|string', // We validate with the form field name
                'job_category_id' => 'required|exists:job_categories,id',
                'status' => 'required|in:active,inactive'
            ]);

            $user = auth()->user();
            $companyProfile = $user->companyProfile;

            JobPosting::create([
                'position' => $validated['position'],
                'location_id' => $validated['location_id'],
                'field_of_work_id' => $validated['field_of_work_id'],
                'company_profile_id' => $companyProfile->id,
                'job_category_id' => $validated['job_category_id'],
                'job_description' => $validated['job_description'],
                'requirements_desciption' => $validated['requirements_description'], // Match the migration field name
                'gaji' => $validated['gaji'],
                'status' => $validated['status'] === 'active' ? 1 : 0,
                'sembunyikan_gaji' => $request->boolean('sembunyikan_gaji'),
            ]);

            return redirect()->route('job-posting.index')
                ->with('success', 'Job posting has been added successfully.');
        } catch (\Exception $e) {
            Log::error('Job posting store error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create job posting. ' . $e->getMessage());
        }
    }
}
