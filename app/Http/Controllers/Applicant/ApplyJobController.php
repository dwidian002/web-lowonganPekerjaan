<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobPosting;
use App\Models\Log;
use App\Models\MasterLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApplyJobController extends Controller
{

    public function index($id)
    {
        $jobPosting = JobPosting::findOrFail($id);
        $applicantProfile = Auth::user()->applicantProfile;

        $hasApplied = Application::where('user_id', auth()->id())
            ->where('job_posting_id', $id)
            ->exists();

        if ($hasApplied) {
            return redirect()->back()->with('error', 'Anda sudah pernah melamar untuk posisi ini');
        }

        return view('applicant.apply.form', compact('jobPosting','applicantProfile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_posting_id' => 'required|exists:job_postings,id',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'portofolio' => 'required|url'
        ]);

        try {
            DB::beginTransaction();

            $resumePath = $request->file('resume')->store('resumes', 'public');
            $coverLetterPath = $request->file('cover_letter')->store('cover-letters', 'public');

            $application = Application::create([
                'job_posting_id' => $request->job_posting_id,
                'user_id' => auth()->id(),
                'resume' => $resumePath,
                'cover_letter' => $coverLetterPath,
                'portofolio' => $request->portofolio,
                'application_status' => 'applied',
                'applied_at' => now()
            ]);

            Log::create([
                'application_id' => $application->id,
                'previous_status' => 'applied',
                'new_status' => 'applied',
                'changed_at' => now()
            ]);

            MasterLog::create([
                'log_name' => 'New Application',
                'is_send_email' => false,
                'application_id' => $application->id
            ]);

            DB::commit();

            return redirect()->route('applicant.applications')
                           ->with('success', 'Aplikasi berhasil dikirim');

        } catch (\Exception $e) {
            DB::rollback();
            
            if (isset($resumePath) && Storage::disk('public')->exists($resumePath)) {
                Storage::disk('public')->delete($resumePath);
            }
            if (isset($coverLetterPath) && Storage::disk('public')->exists($coverLetterPath)) {
                Storage::disk('public')->delete($coverLetterPath);
            }

            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan. Silakan coba lagi.')
                           ->withInput();
        }
    }
}
