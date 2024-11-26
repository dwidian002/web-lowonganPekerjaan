<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\Industry;
use App\Models\Location;
use App\Models\TypeCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $companyProfile = $user->companyProfile;

        return view('company.profile.index', [
            'companyProfile' => $companyProfile,
        ]);
    }

    public function edit($id)
    {
        $companyProfile = CompanyProfile::find($id);
        $industries = Industry::find($id);
        $companyTypes = TypeCompany::find($id);
        $locations = Location::find($id);
        return view('company.profile.edit', compact(
            'companyProfile',
            'industries',
            'companyTypes',
            'locations'
        ));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required|string|max:255',
            'industry' => 'required|exists:industry,id',
            'typeCompany' => 'required|exists:typeCompany,id',
            'tahun_berdiri' => 'required|integer',
            'location' => 'required|exists:locations,id',
            'alamat_lengkap' => 'required|string',
            'description' => 'required|string',
            'website' => 'required|url',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $companyProfile = CompanyProfile::where('user_id', Auth::id())->firstOrFail();

        $logoPath = $companyProfile->logo;
        if ($request->hasFile('logo')) {
            if ($logoPath && $logoPath !== 'layout/assets/images/service/default-logo.png') {
                Storage::delete('public/' . $logoPath);
            }
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $companyProfile->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat_lengkap' => $request->alamat_lengkap,
            'phone_number' => $request->phone_number,
            'about_me' => $request->about_me,
            'logo' => $logoPath
        ]);

        return redirect()->route('company.profile')
            ->with('success', 'Profile updated successfully');
    }
}
