<?php

namespace App\Http\Controllers;

use App\Models\ApplicantProfile;
use App\Models\Application;
use App\Models\CompanyProfile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\FieldOfWork;
use App\Models\JobCategory;
use App\Models\JobPosting;
use App\Models\Location;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = JobCategory::all();
        $locations = Location::all();
        $fields = FieldOfWork::all();

        $totalCompany = CompanyProfile::count();
        $totalJobPosting = JobPosting::count();
        $totalApplication = Application::count();
        $totalApplicant = ApplicantProfile::count();

        $latestJobs = JobPosting::with([
            'location',
            'fieldOfWork',
            'companyProfile',
            'jobCategory'
        ])
            ->where('status', true)
            ->orderBy('created_at', 'desc')
            ->take(6)->get();

        $latestApplication = Application::with([
            'applicantProfile',
            'jobPosting.companyProfile'
        ])
            ->orderBy('created_at', 'desc')
            ->take(6)->get();

        $query = JobPosting::with([
            'companyProfile',
            'jobCategory',
            'location',
            'fieldOfWork'
        ])->where('status', true);

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('position', 'like', '%' . $request->search . '%')
                    ->orWhereHas('companyProfile', function ($company) use ($request) {
                        $company->where('company_name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        if ($request->has('category') && $request->category) {
            $query->where('job_category_id', $request->category);
        }

        if ($request->has('lokasi') && $request->lokasi) {
            $query->where('location_id', $request->lokasi);
        }

        if ($request->has('bidang') && $request->bidang) {
            $query->where('field_of_work_id', $request->bidang);
        }

        $jobPostings = $query->paginate(9);

        $selectedField = $request->input('bidang');

        if (!Auth::check()) {
            return view('applicant.home-applicant', compact(
                'categories',
                'selectedField',
                'locations',
                'fields',
                'latestJobs',
                'jobPostings',
                'totalCompany',
                'totalJobPosting',
                'totalApplication',
                'totalApplicant'
            ));
        }

        $user = Auth::user();

        switch ($user->role) {
            case 'applicant':
                $profile = ApplicantProfile::where('user_id', $user->id)->first();

                if ($profile) {
                    $skills = Skill::where('applicant_profile_id', $profile->id)->count();
                    $education = Education::where('applicant_profile_id', $profile->id)->count();
                    $experience = Experience::where('applicant_profile_id', $profile->id)->count();

                    if ($skills == 0 || $education == 0 || $experience == 0) {
                        session()->flash('incomplete_profile', 'Profile anda belum lengkap, lengkapi sekarang');
                    }
                } else {
                    session()->flash('incomplete_profile', 'Profile belum dibuat, silakan lengkapi profile anda');
                }

                return view('applicant.home-applicant', compact(
                    'selectedField',
                    'profile',
                    'categories',
                    'locations',
                    'fields',
                    'latestJobs',
                    'jobPostings',
                    'totalCompany',
                    'totalJobPosting',
                    'totalApplication',
                    'totalApplicant'
                ));

            case 'company':
                $companyProfile = CompanyProfile::where('user_id', $user->id)->first();

                if ($companyProfile) {

                    $latestJobs = JobPosting::with(['location', 'fieldOfWork', 'companyProfile', 'jobCategory'])
                        ->where('status', true)
                        ->where('company_profile_id', $companyProfile->id)
                        ->orderBy('created_at', 'desc')
                        ->take(6)
                        ->get();

                    $latestApplications = Application::with(['user.applicantProfile', 'jobPosting'])
                        ->whereHas('jobPosting', function ($query) use ($companyProfile) {
                            $query->where('company_profile_id', $companyProfile->id);
                        })
                        ->orderBy('applied_at', 'desc')
                        ->take(6)
                        ->get();

                    $jobPostings = JobPosting::where('company_profile_id', $companyProfile->id)
                        ->paginate(9);

                    $totalJobPosting = JobPosting::where('company_profile_id', $companyProfile->id)
                        ->count();

                    $totalApplication = Application::whereHas('jobPosting', function ($query) use ($companyProfile) {
                        $query->where('company_profile_id', $companyProfile->id);
                    })->count();

                    $totalAcceptedApplication = Application::whereHas('jobPosting', function ($query) use ($companyProfile) {
                        $query->where('company_profile_id', $companyProfile->id);
                    })->whereIn('application_status', ['hired'])
                        ->count();

                    $totalApplicant = Application::whereHas('jobPosting', function ($query) use ($companyProfile) {
                        $query->where('company_profile_id', $companyProfile->id);
                    })->distinct('user_id')->count('user_id');
                } else {
                    $latestJobs = collect();
                    $latestApplications = collect();
                    $jobPostings = collect();
                    $totalJobPosting = 0;
                    $totalApplication = 0;
                    $totalAcceptedApplication = 0;
                    $totalApplicant = 0;
                }

                return view('company.home-company', compact(
                    'companyProfile',
                    'selectedField',
                    'categories',
                    'locations',
                    'fields',
                    'latestJobs',
                    'latestApplications',
                    'jobPostings',
                    'totalJobPosting',
                    'totalApplication',
                    'totalAcceptedApplication',
                    'totalApplicant'
                ));

            case 'admin':
                return view('admin.admin', compact(
                    'categories',
                    'locations',
                    'fields',
                    'latestJobs',
                    'latestApplication',
                    'jobPostings',
                    'jobPostings',
                    'totalCompany',
                    'totalJobPosting',
                    'totalApplication',
                    'totalApplicant'
                ));

            default:
                return redirect()->route('auth.index')
                    ->with('pesan', 'Role tidak valid');
        }
    }
}
