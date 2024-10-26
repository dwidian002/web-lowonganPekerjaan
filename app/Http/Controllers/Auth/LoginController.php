<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserVerifications;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function verifyEmail(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            return redirect()->route('auth.index')
                ->with('pesan', 'Token verifikasi tidak valid');
        }

        $verification = UserVerifications::where('token', $token)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$verification) {
            return redirect()->route('auth.index')
                ->with('pesan', 'Token verifikasi tidak valid atau sudah kadaluarsa');
        }

        $user = User::find($verification->user_id);
        if (!$user) {
            return redirect()->route('auth.index')
                ->with('pesan', 'User tidak ditemukan');
        }

        $user->email_verified_at = Carbon::now();
        $user->save();

        $verification->delete();

        return redirect()->route('auth.index')
            ->with('pesan', 'Email berhasil diverifikasi. Silakan login.');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('auth.index')
                ->with('pesan', 'Email tidak terdaftar');
        }

        if (is_null($user->email_verified_at)) {
            $this->resendVerificationIfNeeded($user);

            return redirect()->route('auth.index')
                ->with('pesan', 'Email belum diverifikasi, silakan cek email Anda.')
                ->with('unverified_email', $user->email);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            switch ($user->role) {
                case 'admin':
                    return redirect()->intended('/admin');
                case 'company':
                case 'applicant':
                    return redirect()->intended('/home');
                default:
                    return redirect()->route('auth.index');
            }
        }

        return redirect()->route('auth.index')
            ->with('pesan', 'Kombinasi email dan password salah');
    }

    protected function resendVerificationIfNeeded(User $user)
    {
        $existingVerification = UserVerifications::where('user_id', $user->id)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (
            !$existingVerification ||
            $existingVerification->updated_at->diffInMinutes(Carbon::now()) > 5
        ) {
            UserVerifications::where('user_id', $user->id)->delete();

            $token = Str::random(60);
            UserVerifications::create([
                'user_id' => $user->id,
                'token' => $token,
                'expires_at' => Carbon::now()->addHours(24)
            ]);

            Mail::to($user->email)->send(new RegisterMail($user, $token));
        }
    }

    public function resendVerification(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('auth.index')
                ->with('pesan', 'Email tidak terdaftar');
        }

        if (!is_null($user->email_verified_at)) {
            return redirect()->route('auth.index')
                ->with('pesan', 'Email sudah terverifikasi, silakan login');
        }

        $this->resendVerificationIfNeeded($user);

        return redirect()->route('auth.index')
            ->with('pesan', 'Email verifikasi telah dikirim ulang, silakan cek email Anda');
    }
}
