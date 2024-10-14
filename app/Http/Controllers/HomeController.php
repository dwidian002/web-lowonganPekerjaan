<?php

namespace App\Http\Controllers;

use App\Models\ApplicantProfile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        // Hanya untuk applicant
        if (Auth::check()) {
            $user = Auth::user();
            // dd($user);

            // Hanya untuk applicant
            if ($user && $user->role == 'applicant') {
                $profile = ApplicantProfile::query()->where('user_id',$user->user_id)->first(); // Pastikan relasi user ke profile sudah ada
                // Cek apakah profile, skills, education, atau experience kosong
                $skills = Skill::where('id_Profile', $profile->id_Profile)->count();
                $education = Education::where('id_Profile', $profile->id_Profile)->count();
                $experience = Experience::where('id_Profile', $profile->id_Profile)->count();

                if ($skills == 0 || $education == 0 || $experience == 0) {
                    session()->flash('incomplete_profile', 'Profile anda belum lengkap, lengkapi sekarang');
                }
            }
        }
        return view('homecompany');
    }

}
