<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\Location;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companyProfiles = CompanyProfile::with('location')->get();
        return view('company.list', compact('companyProfiles'));
    }

    public function add()
    {
        $location = Location::all();
        return view('company.add', compact('location'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'tahun_berdiri' => 'required|integer',
            'location' => 'required|exists:locations,id',
            'alamat_lengkap' => 'required|string',
            'description' => 'required|string',
            'website' => 'required|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');

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

            try {
                $companyProfile->save();
                return redirect(route('company.index'))->with('pesan', ['success', 'Berhasil tambah companyProfile']);
            } catch (\Exception $se) {
                return redirect(route('company.index'))->with('pesan', ['danger', 'Gagal tambah companyProfile']);
            }
        }
    }
}
