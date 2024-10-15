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

        if (Auth::check() && $user && $user->role == 'applicant') {
            // Ambil profil berdasarkan user_id
            $profile = ApplicantProfile::where('user_id', $user->id)->first();

            if ($profile) {
                // Cari skills, education, dan experience berdasarkan applicant_profile_id
                $skills = Skill::where('applicant_profile_id', $profile->id)->count();
                $education = Education::where('applicant_profile_id', $profile->id)->count();
                $experience = Experience::where('applicant_profile_id', $profile->id)->count();

                // Cek apakah ada bagian yang kosong
                if ($skills == 0 || $education == 0 || $experience == 0) {
                    session()->flash('incomplete_profile', 'Profile anda belum lengkap, lengkapi sekarang');
                }
            } else {
                session()->flash('incomplete_profile', 'Profile belum dibuat, silakan lengkapi profile anda');
            }
        }

        return view('homecompany');
    }
}
