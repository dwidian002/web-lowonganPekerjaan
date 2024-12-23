<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicantProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{
    public function index()
    {
        $applicantProfiles = ApplicantProfile::latest()->paginate(10);

        return view('admin.applicant.list', compact('applicantProfiles'));
    }

    public function detail($id)
    {
        $applicant = ApplicantProfile::with([
            'user',
            'experiences',
            'educations',
            'skills',
            'applications.jobPosting.companyProfile',
        ])->findOrFail($id);

        return view('admin.applicant.detail', [
            'applicant' => $applicant
        ]);
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $applicantProfile = ApplicantProfile::findOrFail($id);

            if (!$applicantProfile->user) {
                return redirect()->back()->with('error', 'Data user tidak ditemukan');
            }

            if ($applicantProfile->applications->count() > 0) {
                $applicantProfile->applications()->delete();
            }

            $applicantProfile->user->delete();

            DB::commit();
            return redirect()->route('applicant.index')->with('success', 'Profile applicant berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus profile applicant');
        }
    }
}
