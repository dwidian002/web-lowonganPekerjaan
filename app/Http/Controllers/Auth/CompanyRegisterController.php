<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class CompanyRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.company-register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    protected function validator(array $data)
    {
        return FacadesValidator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'company_name' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function create(array $data)
    {
        // Create the user with role 'company'
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'company',
        ]);

        // Create the company profile
        CompanyProfile::create([
            'user_id' => $user->id,
            'company_name' => $data['company_name'],
            'industry' => $data['industry'] ?? null,  // Optional fields
            'location' => $data['location'] ?? null, 
            'description' => $data['description'] ?? null, 
        ]);

        return $user;
    }

}
