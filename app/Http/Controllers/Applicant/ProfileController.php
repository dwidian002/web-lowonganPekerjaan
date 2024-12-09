<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\ApplicantProfile;
use App\Models\Application;
use App\Models\CompanyProfile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserVerifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();

        $applicantProfile = ApplicantProfile::where('user_id', $user->id)->first();

        return view('applicant.profile.index', [
            'applicantProfile' => $applicantProfile,
        ]);
    }

    public function edit($id)
    {
        $applicantProfile = ApplicantProfile::find($id);
        return view('applicant.profile.edit', compact('applicantProfile'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'gender' => 'required|in:Male,Female',
            'tanggal_lahir' => 'required|date',
            'alamat_lengkap' => 'required|string',
            'phone_number' => 'required|string',
            'about_me' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $applicantProfile = ApplicantProfile::where('user_id', Auth::id())->firstOrFail();

        $fotoPath = $applicantProfile->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath && $fotoPath !== 'layout/assets/images/service/default-foto.jpg') {
                Storage::delete('public/' . $fotoPath);
            }
            $fotoPath = $request->file('foto')->store('fotos', 'public');
        }

        $applicantProfile->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat_lengkap' => $request->alamat_lengkap,
            'phone_number' => $request->phone_number,
            'about_me' => $request->about_me,
            'foto' => $fotoPath
        ]);

        return redirect()->route('profile-applicant')
            ->with('success', 'Profile updated successfully');
    }


    public function information(Request $request)
    {
        $user = $request->user();
        $applicantProfile = ApplicantProfile::with(['educations', 'experiences', 'skills'])
            ->where('user_id', $user->id)
            ->first();

        return view('applicant.profile.more-info', [
            'applicantProfile' => $applicantProfile
        ]);
    }

    public function myApplication()
    {
        $applicantProfile = ApplicantProfile::where('user_id', auth()->id())->first();

        $applications = Application::where('user_id', auth()->id())
            ->with([
                'jobPosting.companyProfile',
                'jobPosting.location'
            ])
            ->orderBy('applied_at', 'desc')
            ->paginate(5);

        return view('applicant.profile.my-applications', compact('applications', 'applicantProfile'));
    }

    public function downloadResume(Application $application)
    {
        if (!$application->resume) {
            abort(404, 'Resume tidak ditemukan');
        }

        $filePath = storage_path('app/public/' . $application->resume);

        if (!file_exists($filePath)) {
            abort(404, 'File resume tidak ditemukan');
        }
        
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        $mimeTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];

        $mimeType = $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';

        $fileName = pathinfo($filePath, PATHINFO_BASENAME);

        return response()->download($filePath, $fileName, [
            'Content-Type' => $mimeType,
        ]);
    }
}
