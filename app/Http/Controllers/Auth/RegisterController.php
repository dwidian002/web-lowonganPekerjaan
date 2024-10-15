<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\User;
use App\Models\UserVerifications;
use Illuminate\Support\Str;
use App\Models\CompanyProfile;
use App\Models\ApplicantProfile;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{

    public function showApplicantRegisterForm()
    {
        return view('auth.registerapplicant');
    }

    public function registerApplicant(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'name' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat_lengkap' => 'required|string',
            'phone_number' => 'required|string',
            'resume' => 'nullable|string',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'applicant',
        ]);

        // dd($user->id);

        ApplicantProfile::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat_lengkap' => $request->alamat_lengkap,
            'phone_number' => $request->phone_number,
            'resume' => $request->resume,
        ]);

        $token = Str::random(60);

        UserVerifications::create([
            'user_id' => $user->id,
            'token' => $token,
        ]);

        Mail::to($user->email)->send(new RegisterMail($user, $token));

        return redirect()->route('verification.notice');
    }

    public function verify()
    {
        return view('emails.notice');
    }

    public function showCompanyRegisterForm()
    {
        $location = Location::all();
        return view('auth.registercompany', compact('location'));
    }

    public function registerCompany(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'company_name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'tahun_berdiri' => 'required|integer',
            'location' => 'required|exists:locations,id',
            'alamat_lengkap' => 'required|string',
            'description' => 'required|string',
            'website' => 'required|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'company',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        // dd($user->user_id);

        $companyProfile = CompanyProfile::create([
            'user_id' => $user->id,
            'company_name' => $request->company_name,
            'industry' => $request->industry,
            'tahun_berdiri' => $request->tahun_berdiri,
            'location_id' => $request->location,
            'alamat_lengkap' => $request->alamat_lengkap,
            'description' => $request->description,
            'website' => $request->website,
            'logo' => $logoPath
        ]);

        // dd($companyProfile);

        $token = Str::random(60);

        UserVerifications::create([
            'user_id' => $user->id,
            'token' => $token,
        ]);

        Mail::to($user->email)->send(new RegisterMail($user, $token));

        return redirect()->route('verification.notice');
    }
}
