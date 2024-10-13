<?php

namespace App\Http\Controllers;

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
        $user_id = Auth::guard('user')->user()->user_id;
        $user = User::findOrFail($user_id);
        $profile = ApplicantProfile::where('user_id', $user->user_id)->first();

        // Return view untuk melengkapi profile
        return view('profile.exs', ['profile' => $profile]);
    }

    public function storeExs(Request $request)
    {

        // Validasi input
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

        $user_id = Auth::guard('user')->user()->user_id;
        $user = User::findOrFail($user_id);
        $profile = ApplicantProfile::where('user_id', $user->user_id)->firstOrFail();

        // dd($token);
        // Simpan education (gunakan perulangan jika ada banyak data)
        if (isset($request->education) && is_array($request->education)) {
            foreach ($request->education as $education) {
                Education::create([
                    'id_Profile' => $profile->id_Profile,
                    'degree' => $education['degree'],
                    'institution_name' => $education['institution_name'],
                    'starting_year' => $education['starting_year'],
                    'finishing_year' => $education['finishing_year'],
                ]);
            }
        }

        // Simpan experience
        foreach ($request->experience as $experience) {
            Experience::create([
                'id_Profile' => $profile->id_Profile,
                'job_Title' => $experience['job_Title'],
                'company_name' => $experience['company_name'],
                'position' => $experience['position'],
                'lama_bekerja' => $experience['lama_bekerja'],
            ]);
        }

        // Simpan skills
        foreach ($request->skills as $skill) {
            Skill::create([
                'id_Profile' => $profile->id_Profile,
                'name' => $skill['name'],
            ]);
        }

        // Redirect ke halaman sukses atau halaman lain
        return redirect()->route('indexUser')->with('pesan', 'Profile completed successfully!');
    }
}
