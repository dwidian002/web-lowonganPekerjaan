<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $request, $token)
    {
        // Cari user berdasarkan token (bisa menggunakan token terpisah atau di kolom user)
        $user = User::where('verification_token', $token)->first();

        if ($user) {
            // Tandai email sebagai telah diverifikasi
            $user->email_verified_at = now();
            $user->save();

            // Redirect ke halaman pengisian profil yang sesuai dengan role
            if ($user->role == 'company') {
                return redirect()->route('profile.complete.company');
            } elseif ($user->role == 'applicant') {
                return redirect()->route('profile.complete.applicant');
            }
        }

        return redirect('/')->with('error', 'Invalid verification link');
    }
}
