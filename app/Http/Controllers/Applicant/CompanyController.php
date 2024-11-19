<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\Industry;
use App\Models\Location;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function list(Request $request)
    {
        $query = CompanyProfile::with([
            'industry',
            'location'
        ]);

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('company_name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('lokasi') && $request->lokasi) {
            $query->where('location_id', $request->lokasi);
        }

        if ($request->has('industry') && $request->industry) {
            $query->where('industry_id', $request->industry);
        }

        $companies = $query->paginate(9);
        $industries = Industry::all();
        $locations = Location::all();

        return view('applicant.company.list', compact('companies', 'industries', 'locations'));
    }

    public function detail($id)
    {
        $companies = CompanyProfile::findOrFail($id);
        return view('applicant.company.detail', compact('companies'));
    }
}
