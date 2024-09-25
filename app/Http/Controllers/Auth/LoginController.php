<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'password' => 'required',
            'role' => 'required'
        ]);

        // Coba login dengan data yang diberikan
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password, 'role' => $request->role])) {

            // Redirect berdasarkan role
            if ($request->role === 'admin') {
                return redirect()->intended('/admin');
            } elseif ($request->role === 'company') {
                return redirect()->intended('/home'); // Halaman untuk company
            } elseif ($request->role === 'applicant') {
                return redirect()->intended('/home'); // Halaman untuk applicant
            }
        } else {
            // Jika gagal login, kembali ke halaman login dengan pesan error
            return redirect(route('auth.index'))->with('pesan', 'Kombinasi email dan password salah');
        }
    }
}
