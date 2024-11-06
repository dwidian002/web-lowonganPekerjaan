<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\ApplicantProfile;
use App\Models\CompanyProfile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserVerifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function exsForm()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth.index')->with('pesan', 'Anda harus login terlebih dahulu');
        }

        $profile = ApplicantProfile::where('user_id', $user->id)->first();

        return view('applicant.profile.exs', ['profile' => $profile]);
    }

    public function storeExs(Request $request)
    {
        $this->validate($request, [
            'education.*.degree' => 'required|string',
            'education.*.institution_name' => 'required|string',
            'education.*.starting_year' => 'required|integer',
            'education.*.finishing_year' => 'required|integer',

            'experience.*.job_Title' => 'required|string',
            'experience.*.company_name' => 'required|string',
            'experience.*.position' => 'required|string',
            'experience.*.lama_bekerja' => 'required|string',

            'skills.*.name' => 'required|string',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth.index')->with('pesan', 'Anda harus login terlebih dahulu');
        }

        $profile = ApplicantProfile::where('user_id', $user->id)->firstOrFail();

        if (isset($request->education) && is_array($request->education)) {
            foreach ($request->education as $education) {
                Education::create([
                    'applicant_profile_id' => $profile->id,
                    'degree' => $education['degree'],
                    'institution_name' => $education['institution_name'],
                    'starting_year' => $education['starting_year'],
                    'finishing_year' => $education['finishing_year'],
                ]);
            }
        }

        if (isset($request->experience) && is_array($request->experience)) {
            foreach ($request->experience as $experience) {
                Experience::create([
                    'applicant_profile_id' => $profile->id,
                    'job_Title' => $experience['job_Title'],
                    'company_name' => $experience['company_name'],
                    'position' => $experience['position'],
                    'lama_bekerja' => $experience['lama_bekerja'],
                ]);
            }
        }

        if (isset($request->skills) && is_array($request->skills)) {
            foreach ($request->skills as $skill) {
                Skill::create([
                    'applicant_profile_id' => $profile->id,
                    'name' => $skill['name'],
                ]);
            }
        }

        return redirect()->route('home')->with('pesan', 'Profile completed successfully!');
    }
}
