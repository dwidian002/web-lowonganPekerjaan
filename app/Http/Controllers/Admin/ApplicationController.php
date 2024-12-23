<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function list()
    {
        $applications = Application::with([
            'applicantProfile',
            'jobPosting.companyProfile'
        ])->latest()
            ->paginate(10);

        return view ('admin.application.list', compact('applications'));
    }

    public function detail($id) {
        $application = Application::with([
            'applicantProfile',
            'applicantProfile.experiences',
            'applicantProfile.educations',
            'applicantProfile.skills',
            'jobPosting.companyProfile',
            'jobPosting.location',
            'jobPosting.fieldOfWork',
            'jobPosting.jobCategory',
            'user'
        ])->findOrFail($id);

        return view('admin.application.detail', compact('application'));
    }
}
