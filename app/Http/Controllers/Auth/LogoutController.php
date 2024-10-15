<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }
        return  redirect(route('auth.index'));
    }
}
