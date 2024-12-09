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
        $companyProfile = CompanyProfile::findOrFail($id);
        $industries = Industry::all();
        $companyTypes = TypeCompany::all();
        $locations = Location::all();
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
            'type_company' => 'required|exists:type_company,id',
            'tahun_berdiri' => 'required|integer|max:'.date('Y'),
            'location' => 'required|exists:locations,id',
            'alamat_lengkap' => 'required|string',
            'description' => 'required|string',
            'website' => 'required|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $companyProfile = CompanyProfile::findOrFail($request->id);

        $logoPath = $companyProfile->logo;
        if ($request->hasFile('logo')) {
            if ($logoPath && $logoPath !== 'layout/assets/images/service/default-logo.png') {
                Storage::delete('public/' . $logoPath);
            }
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $companyProfile->update([
            'company_name' => $request->company_name,
            'industry_id' => $request->industry,
            'type_company_id' => $request->type_company,
            'tahun_berdiri' => $request->tahun_berdiri,
            'location_id' => $request->location,
            'alamat_lengkap' => $request->alamat_lengkap,
            'description' => $request->description,
            'website' => $request->website,
            'logo' => $logoPath
        ]);

        return redirect()->route('profile-company')
            ->with('success', 'Profile updated successfully');
    }
}
