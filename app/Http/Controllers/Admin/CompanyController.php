<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\JobPosting;
use App\Models\Location;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companyProfiles = CompanyProfile::with([
            'location',
            'industry',
            'typeCompany'
        ])
            ->latest()
            ->paginate(10);

        return view('admin.company.list', compact('companyProfiles'));
    }

    public function detail($id)
    {
        $company = CompanyProfile::with([
            'location',
            'industry',
            'typeCompany',
            'jobPostings' => function ($query) {
                $query->with([
                    'location',
                    'fieldOfWork',
                    'jobCategory'
                ]);
            }
        ])->findOrFail($id);

        return view('admin.company.detail', compact('company'));
    }


    public function add()
    {
        $location = Location::all();
        return view('admin.company.add', compact('location'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'tahun_berdiri' => 'required|integer',
            'location' => 'required|exists:locations,id',
            'alamat_lengkap' => 'required|string',
            'description' => 'required|string',
            'website' => 'required|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');

            $companyProfile = CompanyProfile::create([
                'user_id' => $user->id,
                'company_name' => $request->company_name,
                'industry' => $request->industry,
                'tahun_berdiri' => $request->tahun_berdiri,
                'location_id' => $request->location,
                'alamat_lengkap' => $request->alamat_lengkap,
                'description' => $request->description,
                'website' => $request->website,
                'logo' => $logoPath
            ]);

            try {
                $companyProfile->save();
                return redirect(route('company.index'))->with('pesan', ['success', 'Berhasil tambah companyProfile']);
            } catch (\Exception $se) {
                return redirect(route('company.index'))->with('pesan', ['danger', 'Gagal tambah companyProfile']);
            }
        }
    }
    public function jobPostingDetail($id)
    {
        $jobPosting = JobPosting::with([
            'companyProfile',
            'location',
            'fieldOfWork',
            'jobCategory'
        ])->findOrFail($id);

        return view('admin.company.job-detail', compact('jobPosting'));
    }

    public function delete($id)
    {
        $jobPosting = JobPosting::findOrFail($id);
        $companyId = $jobPosting->company_profile_id;

        $jobPosting->delete();

        return redirect()->route('company.detail', $companyId)
            ->with('pesan', ['success', 'Job posting deleted successfully']);
    }
}
