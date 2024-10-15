<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function verify(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Ambil user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect(route('auth.index'))->with('pesan', 'Email tidak terdaftar');
        }

        // Lakukan autentikasi
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin');
            } elseif ($user->role === 'company') {
                return redirect()->intended('/home'); // Halaman untuk company
            } elseif ($user->role === 'applicant') {
                return redirect()->intended('/home'); // Halaman untuk applicant
            }
        }

        // Jika gagal login, kembali ke halaman login dengan pesan error
        return redirect(route('auth.index'))->with('pesan', 'Kombinasi email dan password salah');
    }
}
