<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\Location;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(){
        $location = Location::all();
        return view('company.all', compact('location'));
    }

    public function add(){
        return view('company.add');
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name'=>'required'
        ]);

        $company = new CompanyProfile();
        $company->name= $request->name;

        try{
            $company->save();
            return redirect(route('company.index'))->with('pesan',['success','Berhasil tambah company']);

        }catch (\Exception $e){
            return redirect(route('company.index'))->with('pesan',['danger','Gagal tambah company']);
        }
    }

    public function edit($id){
        $company = Company::findOrFail($id);
        return view('company.edit', compact('company'));
    }

    public function update(Request $request) {

        $this->validate($request, [
            'name'=>'required',
        ]);

        $company = Company::findOrFail($request->id);
        $company->name= $request->name;

        try{
            $company->save();
            return redirect(route('company.index'))->with('pesan',['success','Berhasil ubah company']);

        }catch (\Exception $e){
            return redirect(route('company.index'))->with('pesan',['danger','Gagal ubah company']);
        }
    }

    public function delete($id) {

        $company = Company::findOrFail($id);

        try{
            $company->delete();
            return redirect(route('company.index'))->with('pesan',['success','Berhasil hapus company']);

        }catch (\Exception $e){
            return redirect(route('company.index'))->with('pesan',['danger','Gagal hapus company']);
        }
    }
}
