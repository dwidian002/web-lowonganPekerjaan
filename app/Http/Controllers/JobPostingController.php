<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\FieldOfWork;
use App\Models\JobCategory;
use App\Models\JobPosting;
use App\Models\Location;
use Illuminate\Http\Request;

class JobPostingController extends Controller
{
    public function index()
    {
        $jobPostings = JobPosting::with(['companyProfile', 'Location', 'FieldOfWork', 'jobCategories'])->get();
        return view('job-posting.list', compact('jobPostings'));
    }

    public function add()
    {
        // Ambil user yang sedang login
        $user = auth()->user();

        // Cek apakah user punya company_profile_id
        if (!$user->company_profile_id) {
            return redirect()->back()->withErrors('Company profile ID not associated with user.');
        }

        // Ambil company profile yang terkait dengan user ini
        $company = CompanyProfile::find($user->company_profile_id);

        // Jika company tidak ditemukan
        if (!$company) {
            return redirect()->back()->withErrors('Company profile not found.');
        }

        // Ambil data lainnya untuk form
        $locations = Location::all();
        $fieldOfWorks = FieldOfWork::all();
        $categories = JobCategory::all();

        return view('job-posting.add', compact('company', 'locations', 'fieldOfWorks', 'categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'gaji' => 'required|numeric',
            'sembunyikan_gaji' => 'sometimes|boolean',
            'job_description' => 'required|string',
            'requirements_description' => 'required|string',
            'job_category_id' => 'required|exists:job_categories,id',
            'status' => 'required|in:active,inactive'
        ]);

        $user = auth()->user();
        $company = CompanyProfile::where('id', $user->company_profile_id)->first();

        JobPosting::create([
            'position' => $request->position,
            'location_id' => $request->location_id,
            'company_profile_id' => $company->id,
            'job_category_id' => $request->job_category_id,
            'job_description' => $request->job_description,
            'requirements_desciption' => $request->requirements_description,
            'gaji' => $request->gaji,
            'status' => $request->status == 'active' ? 1 : 0,
            'sembunyikan_gaji' => $request->sembunyikan_gaji ? 1 : 0,
        ]);

        return redirect()->route('job-posting.index')->with('success', 'Job posting has been added successfully.');
    }
}
