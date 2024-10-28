<?php

namespace App\Http\Controllers;

use App\Models\ApplicantProfile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\FieldOfWork;
use App\Models\JobCategory;
use App\Models\Location;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $categories = JobCategory::all();
        $locations = Location::all();
        $fields = FieldOfWork::all();
        

        if (!Auth::check()) {
            return view('applicant.home-applicant', compact('categories', 'locations', 'fields'));
        }
        
        $user = Auth::user();

        switch ($user->role) {
            case 'applicant':
                $profile = ApplicantProfile::where('user_id', $user->id)->first();

                if ($profile) {
                    $skills = Skill::where('applicant_profile_id', $profile->id)->count();
                    $education = Education::where('applicant_profile_id', $profile->id)->count();
                    $experience = Experience::where('applicant_profile_id', $profile->id)->count();

                    if ($skills == 0 || $education == 0 || $experience == 0) {
                        session()->flash('incomplete_profile', 'Profile anda belum lengkap, lengkapi sekarang');
                    }
                } else {
                    session()->flash('incomplete_profile', 'Profile belum dibuat, silakan lengkapi profile anda');
                }

                return view('applicant.home-applicant', compact('categories', 'locations', 'fields'));

            case 'company':
                return view('company.home-company', compact('categories', 'locations', 'fields'));

            case 'admin':
                return view('admin.admin', compact('categories', 'locations', 'fields'));

            default:
                return redirect()->route('auth.index')
                    ->with('pesan', 'Role tidak valid');
        }
    }
}
