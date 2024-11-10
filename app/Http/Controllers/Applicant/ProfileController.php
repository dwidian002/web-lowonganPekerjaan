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
use Illuminate\Support\Facades\DB;

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
            'education.*.degree' => 'nullable|string',
            'education.*.institution_name' => 'nullable|string',
            'education.*.starting_year' => 'nullable|integer',
            'education.*.finishing_year' => 'nullable|integer',

            'experience.*.job_Title' => 'nullable|string',
            'experience.*.company_name' => 'nullable|string',
            'experience.*.position' => 'nullable|string',
            'experience.*.lama_bekerja' => 'nullable|string',

            'skills.*.name' => 'nullable|string',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('auth.index')
                ->with('pesan', 'Anda harus login terlebih dahulu');
        }

        $profile = ApplicantProfile::where('user_id', $user->id)->firstOrFail();

        if (isset($request->education) && is_array($request->education)) {
            foreach ($request->education as $education) {
                if (!empty(array_filter($education))) {
                    Education::create([
                        'applicant_profile_id' => $profile->id,
                        'degree' => $education['degree'] ?? null,
                        'institution_name' => $education['institution_name'] ?? null,
                        'starting_year' => $education['starting_year'] ?? null,
                        'finishing_year' => $education['finishing_year'] ?? null,
                    ]);
                }
            }
        }

        if (isset($request->experience) && is_array($request->experience)) {
            foreach ($request->experience as $experience) {
                if (!empty(array_filter($experience))) {
                    Experience::create([
                        'applicant_profile_id' => $profile->id,
                        'job_Title' => $experience['job_Title'] ?? null,
                        'company_name' => $experience['company_name'] ?? null,
                        'position' => $experience['position'] ?? null,
                        'lama_bekerja' => $experience['lama_bekerja'] ?? null,
                    ]);
                }
            }
        }

        if (isset($request->skills) && is_array($request->skills)) {
            foreach ($request->skills as $skill) {
                if (!empty(trim($skill['name'] ?? ''))) {
                    Skill::create([
                        'applicant_profile_id' => $profile->id,
                        'name' => $skill['name'],
                    ]);
                }
            }
        }

        try {
            DB::beginTransaction();

            DB::commit();
            return redirect()->route('home')
                ->with('success', 'Profile completed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'An error occurred while saving your profile. Please try again.');
        }
    }
}
