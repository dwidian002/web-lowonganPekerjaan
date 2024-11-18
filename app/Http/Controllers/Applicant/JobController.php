<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\FieldOfWork;
use App\Models\JobCategory;
use App\Models\JobPosting;
use App\Models\Location;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
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
        $jobCategories = JobCategory::all();
        $locations = Location::all();
        $fields = FieldOfWork::all();

        return view('applicant.job.all', compact(
            'jobPostings',
            'jobCategories',
            'locations',
            'fields'
        ));
    }

    public function detail($id)
    {
        $jobPosting = JobPosting::with(['companyProfile', 'location', 'fieldOfWork', 'jobCategory'])
            ->findOrFail($id);
        return view('applicant.job.detail', compact('jobPosting'));
    }
}
