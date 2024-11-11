<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\ApplicantProfile;
use App\Models\Application;
use App\Models\Log;
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

        $application->application_status = 'in_review';
        $application->save();

        Log::create([
            'previous_status' => 'applied',
            'new_status' => 'in_review',
            'application_id' => $application->id,
            'changed_at' => now(),
        ]);
        return view('company.application.detail', compact('application'));
    }


    public function confirmReview($id)
    {
        $application = Application::findOrFail($id);

        if ($application->application_status === 'applied') {
            $application->update([
                'application_status' => 'in_review',
            ]);

            Log::create([
                'previous_status' => 'applied',
                'new_status' => 'in_review',
                'application_id' => $application->id,
                'changed_at' => now(),
            ]);

            if (request()->has('remember')) {
                $minutes = 60 * 24 * 30;
                cookie()->queue('confirmed_application_' . $id, true, $minutes);
            } else {
                session()->put('confirmed_application_' . $id, true);
            }
        }

        return redirect()->route('company.application.detail', $id);
    }
}
