<?php

namespace App\Http\Controllers;

use App\Models\ApplicantProfile;
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

        $latestJobs = JobPosting::with(['location', 'fieldOfWork', 'companyProfile', 'jobCategory'])
            ->where('status', true)
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

        if (!Auth::check()) {
            return view('applicant.home-applicant', compact('categories', 'locations', 'fields', 'latestJobs','jobPostings'));
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

                return view('applicant.home-applicant', compact('categories', 'locations', 'fields', 'latestJobs','jobPostings'));

            case 'company':
                return view('company.home-company', compact('categories', 'locations', 'fields', 'latestJobs','jobPostings'));

            case 'admin':
                return view('admin.admin', compact('categories', 'locations', 'fields', 'latestJobs','jobPostings'));

            default:
                return redirect()->route('auth.index')
                    ->with('pesan', 'Role tidak valid');
        }
    }
}
