<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CompanyProfile;
use App\Models\ApplicantProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    // Menampilkan form pemilihan role (applicant/company)
    public function showRoleSelection()
    {
        return view('auth.role-select'); // Menampilkan form pemilihan role
    }

    // Menampilkan form registrasi berdasarkan role
    public function showRegistrationForm($role)
    {
        if (!in_array($role, ['applicant', 'company'])) {
            abort(404); // Menghentikan jika role tidak sesuai
        }
        return view('auth.register', ['role' => $role]); // Menampilkan form registrasi sesuai role
    }

    // Handle registrasi user berdasarkan role
    public function handleRegistration(Request $request, $role)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role, // Role 'company' atau 'applicant'
        ]);

        event(new Registered($user)); // Kirim email aktivasi

        return redirect()->route('verification.notice'); // Arahan ke halaman notifikasi verifikasi
    }

    // Verifikasi email setelah link aktivasi diklik
    public function verifyEmail($id, $hash)
    {
        $user = User::find($id);

        if (Hash::check($user->email, $hash)) {
            $user->email_verified_at = now(); // Menandai email sebagai sudah diverifikasi
            $user->save();

            return redirect()->route('profile.complete', ['role' => $user->role]); // Arahkan ke form profil
        }

        return abort(403, 'Link aktivasi tidak valid.'); // Gagal verifikasi
    }

    // Menampilkan form untuk melengkapi profil setelah verifikasi
    public function showProfileCompletion($role)
    {
        if (!in_array($role, ['applicant', 'company'])) {
            abort(404); // Jika role tidak valid
        }

        return view('auth.complete-profile', ['role' => $role]); // Tampilkan form lengkap profil sesuai role
    }
}
