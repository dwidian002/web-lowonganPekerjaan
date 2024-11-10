<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\ApplicantProfile;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index($id)
    {
        $application = Application::with([
            'user.applicantProfile',
            'user.applicantProfile.education',
            'user.applicantProfile.skills',
            'user.applicantProfile.experiences'
        ])
            ->where('id', $id)
            ->firstOrFail();

        return view('company.application.detail', compact('application'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $request->validate([
            'status' => 'required|in:applied,in_review,interview,hired,rejected'
        ]);

        $application->update([
            'application_status' => $request->status
        ]);

        $application->logs()->create([
            'status' => $request->status,
            'changed_by' => auth()->id()
        ]);

        return back()->with('success', 'Application status updated successfully');
    }
}
