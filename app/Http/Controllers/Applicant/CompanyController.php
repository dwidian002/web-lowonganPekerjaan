<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function list()
    {
        $companies = CompanyProfile::all();
        return view('applicant.company.list', compact('companies'));
    }

    public function detail($id)
    {
        $companies = CompanyProfile::findOrFail($id);
        return view('applicant.company.detail', compact('companies'));
    }
}
