<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use App\Models\FieldOfWork;
use App\Models\JobCategory;
use App\Models\JobPosting;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JobPostingController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $companyProfile = $user->companyProfile;

        if (!$companyProfile) {
            return redirect()->route('register.company')
                ->with('error', 'Please complete your company profile first.');
        }

        $query = JobPosting::where('company_profile_id', $companyProfile->id)
            ->with(['location', 'jobCategory', 'companyProfile', 'fieldOfWork'])
            ->latest()
            ->where('status', true);


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

        $jobPostings = $query->paginate(12);
        $jobCategories = JobCategory::all();
        $locations = Location::all();
        $fields = FieldOfWork::all();

        return view('company.job-posting.list', data: compact(
            'jobPostings',
            'jobCategories',
            'locations',
            'fields',
        ));
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

            return view('company.job-posting.add', compact(
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
                'sembunyikan_gaji' => 'nullable|boolean',
                'job_description' => 'required|string',
                'requirements_description' => 'required|string',
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
                'requirements_desciption' => $validated['requirements_description'],
                'gaji' => $validated['gaji'],
                'status' => $validated['status'] === 'active' ? 1 : 0,
                'sembunyikan_gaji' => $request->has('sembunyikan_gaji'),
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

    public function detail($id)
    {
        $jobPosting = JobPosting::with([
            'companyProfile',
            'location',
            'fieldOfWork',
            'jobCategory',
            'applications.user.applicantProfile'
        ])
            ->findOrFail($id);

        return view('company.job-posting.detail', compact('jobPosting'));
    }

    public function edit($id)
    {
        $jobPosting = JobPosting::findOrFail($id);

        $locations = Location::all();
        $field_of_work = FieldOfWork::all();
        $jobCategories = JobCategory::all();
        $companyProfiles = CompanyProfile::all();

        return view('company.job-posting.edit', compact(
            'jobPosting',
            'locations',
            'field_of_work',
            'jobCategories',
            'companyProfiles'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'field_of_work_id' => 'required|exists:fields_of_work,id',
            'job_category_id' => 'required|exists:job_categories,id',
            'job_description' => 'required|string',
            'requirements_desciption' => 'required|string',
            'gaji' => 'required|numeric',
            'status' => 'required|boolean',
            'sembunyikan_gaji' => 'boolean'
        ]);

        try {
            $jobPosting = JobPosting::findOrFail($id);

            $status = filter_var($request->status, FILTER_VALIDATE_BOOLEAN);
            $sembunyikan_gaji = $request->has('sembunyikan_gaji');

            $jobPosting->update([
                'position' => $request->position,
                'location_id' => $request->location_id,
                'field_of_work_id' => $request->field_of_work_id,
                'job_category_id' => $request->job_category_id,
                'job_description' => $request->job_description,
                'requirements_desciption' => $request->requirements_desciption,
                'gaji' => $request->gaji,
                'status' => $status,
                'sembunyikan_gaji' => $sembunyikan_gaji
            ]);

            return redirect()
                ->route('job-posting.index')
                ->with('success', 'Job posting berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui job posting: ' . $e->getMessage());
        }
    }

    public function close($id)
    {
        $jobPosting = JobPosting::findOrFail($id);
        $jobPosting->status = 0;
        $jobPosting->save();

        return redirect()->route('job-posting.index')->with('success', 'Job posting has been closed.');
    }

    public function open($id)
    {
        $jobPosting = JobPosting::findOrFail($id);
        $jobPosting->status = 1;
        $jobPosting->save();

        return redirect()->route('job-posting.index')->with('success', 'Job posting has been opened.');
    }

    public function delete($id)
    {
        try {
            $jobPosting = JobPosting::findOrFail($id);
            $jobPosting->delete();

            return redirect()->route('job-posting.index')
                ->with('success', 'Job berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus job: ' . $e->getMessage());
        }
    }
}
