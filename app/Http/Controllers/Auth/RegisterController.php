<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\User;
use App\Models\UserVerifications;
use Illuminate\Support\Str;
use App\Models\CompanyProfile;
use App\Models\ApplicantProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Menampilkan form registrasi
    }

    public function register(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required',
        ]);

        // Buat user baru
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Token verifikasi
        $token = Str::random(40);

        // Simpan token ke tabel user_verifications
        UserVerifications::create([
            'user_id' => $user->user_id,
            'token' => $token,
        ]);

        // Kirim email verifikasi
        Mail::to($user->email)->send(new RegisterMail($user, $token));

        // Redirect ke halaman notifikasi bahwa email telah dikirim
        return redirect()->route('verification.notice');
    }

    public function verify()
    {
        return view('emails.notice');
    }
}
