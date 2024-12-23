<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobPosting;
use App\Models\Log;
use App\Models\MasterLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApplyJobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $user = Auth::user();

        if ($user->role !== 'applicant') {
            return redirect()->route('home')->with('error', 'Hanya pelamar yang dapat melamar pekerjaan');
        }

        $applicantProfile = $user->applicantProfile;
        if (!$applicantProfile || empty($applicantProfile->name) || empty($applicantProfile->tanggal_lahir) || empty($applicantProfile->alamat_lengkap) || empty($applicantProfile->phone_number)) {
            return redirect()->route('profile.complete')->with('error', 'Lengkapi profil Anda terlebih dahulu.');
        }

        $jobPosting = JobPosting::where('id', $id)->where('status', true)->first();
        if (!$jobPosting) {
            return redirect()->back()->with('error', 'Posisi pekerjaan tidak ditemukan atau tidak aktif.');
        }

        $hasApplied = Application::where('user_id', $user->id)
            ->where('job_posting_id', $id)
            ->exists();

        if ($hasApplied) {
            return redirect()->back()->with('error', 'Anda sudah pernah melamar untuk posisi ini.');
        }

        return view('applicant.apply.form', compact('jobPosting', 'applicantProfile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_posting_id' => 'required|exists:job_postings,id',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'portofolio' => 'required|url'
        ]);

        // dd($request->all());

        try {
            DB::beginTransaction();

            $resumePath = $request->file('resume')->store('resumes', 'public');

            $application = Application::create([
                'job_posting_id' => $request->job_posting_id,
                'user_id' => auth()->id(),
                'resume' => $resumePath,
                'portofolio' => $request->portofolio,
                'application_status' => 'applied',
                'applied_at' => now()
            ]);


            Log::create([
                'application_id' => $application->id,
                'previous_status' => 'applied',
                'new_status' => 'applied',
                'changed_at' => Carbon::now()
            ]);

            MasterLog::create([
                'log_name' => 'New Application',
                'is_send_email' => false,
                'application_id' => $application->id
            ]);

            DB::commit();

            return redirect()->route('job-detail', ['id' => $request->job_posting_id])
                ->with('success', 'Lamaran berhasil dikirim');
        } catch (\Exception $e) {
            DB::rollback();

            if (isset($resumePath) && Storage::disk('public')->exists($resumePath)) {
                Storage::disk('public')->delete($resumePath);
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi.')
                ->withInput();
        }
    }
}
