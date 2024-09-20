<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function verify(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password, 'role' => $request->role])) {
            return redirect()->intended('/admin');
        }else{
            return redirect(route('auth.index'))->with('pesan', 'kombinasi email dan password salah');
        }
    }
}
