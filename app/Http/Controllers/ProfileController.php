<?php

namespace App\Http\Controllers;

use App\Models\ApplicantProfile;
use App\Models\CompanyProfile;
use App\Models\User;
use App\Models\UserVerifications;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Melengkapi profil company
    public function completeCompanyProfile($token)
    {
        // Cari token verifikasi di tabel user_verifications
        $verification = UserVerifications::where('token', $token)->first();

        if (!$verification) {
            // Token tidak valid, tampilkan pesan error atau redirect
            return redirect()->route('auth.index')->with('error', 'Invalid token!');
        }

        // Dapatkan user berdasarkan user_id di tabel user_verifications
        $user = User::find($verification->user_id);

        // Jika token valid, tampilkan form pelengkapan profil company
        return view('profile.complate-company', compact('user'));
    }

    // Melengkapi profil applicant
    public function completeApplicantProfile($token)
    {
        // Cari token verifikasi di tabel user_verifications
        $verification = UserVerifications::where('token', $token)->first();

        if (!$verification) {
            // Token tidak valid, tampilkan pesan error atau redirect
            return redirect()->route('auth.index')->with('error', 'Invalid token!');
        }

        // Dapatkan user berdasarkan user_id di tabel user_verifications
        $user = User::find($verification->user_id);

        // Jika token valid, tampilkan form pelengkapan profil applicant
        return view('profile.complete-applicant', compact('user'));
    }

    // Menyimpan profil company
    public function storeCompanyProfile(Request $request, $token)
    {
        $verification = UserVerifications::where('token', $token)->first();

        if (!$verification) {
            // Jika token tidak valid
            return redirect()->route('auth.index')->with('error', 'Invalid token!');
        }

        $user = User::find($verification->user_id);

        $request->validate([
            'company_name' => 'required',
            'industry' => 'required',
            'location' => 'required',
            'description' => 'required',
            'website' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Validasi untuk logo (opsional)
        ]);

        CompanyProfile::create([
            'user_id' => $user->id,
            'company_name' => $request->company_name,
            'industry' => $request->industry,
            'location' => $request->location,
            'description' => $request->description,
            'website' => $request->website,
            'logo' => $request->logo // Simpan path logo ke database
        ]);

        $verification->delete();

        return redirect()->route('indexUser')->with('success', 'Profile completed successfully');
    }

    // Menyimpan profil applicant
    public function storeApplicantProfile(Request $request, $token)
    {
        $verification = UserVerifications::where('token', $token)->first();

        if (!$verification) {
            // Jika token tidak valid
            return redirect()->route('auth.index')->with('error', 'Invalid token!');
        }

        $user = User::find($verification->user_id);

        $request->validate([
            'name' => 'required',
            'ttl' => 'required',
            'alamat' => 'required',
            'phone_number' => 'required',
            'education' => 'required',
            'experience' => 'required',
            'skills' => 'required',
            'resume' => 'required'
        ]);

        ApplicantProfile::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'ttl' => $request->ttl,
            'alamat' => $request->alamat,
            'phone_number' => $request->phone_number,
            'education' => $request->education,
            'experience' => $request->experience,
            'skills' => $request->skills,
            'resume' => $request->resume
        ]);

        $verification->delete();

        return redirect()->route('indexUser')->with('success', 'Profile completed successfully');
    }
}
