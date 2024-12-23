<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\JobPosting;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $companyProfile = CompanyProfile::findOrFail($id);

            if (!$companyProfile->user) {
                return redirect()->back()->with('error', 'Data user tidak ditemukan');
            }

            if ($companyProfile->jobPostings->count() > 0) {
                $companyProfile->jobPostings()->delete();
            }

            $companyProfile->user->delete();

            DB::commit();
            return redirect()->route('company.index')->with('success', 'Profile company berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus profile company');
        }
    }
}
