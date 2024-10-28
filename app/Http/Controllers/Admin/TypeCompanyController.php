<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeCompany;
use Illuminate\Http\Request;

class TypeCompanyController extends Controller
{
    public function index(){
        $typeCompany = TypeCompany::all();
        return view('admin.typeCompany.list', compact('typeCompany'));
    }

    public function add(){
        return view('admin.typeCompany.add');
    }

    public function store(Request $request) {
        
        $this->validate($request, [
            'name'=>'required'
        ]);

        $typeCompany = new TypeCompany();
        $typeCompany->name= $request->name;

        try{
            $typeCompany->save();
            return redirect(route('type-company.index'))->with('pesan',['success','Berhasil tambah typeCompany']);

        }catch (\Exception $e){
            return redirect(route('type-company.index'))->with('pesan',['danger','Gagal tambah typeCompany']);
        }
    }

    public function edit($id){
        $typeCompany = TypeCompany::findOrFail($id);
        return view('admin.typeCompany.edit', compact('typeCompany'));
    }

    public function update(Request $request) {

        $this->validate($request, [
            'id'=>'required',
            'name'=>'required',
        ]);

        $typeCompany = TypeCompany::findOrFail($request->id);
        $typeCompany->name= $request->name;

        try{
            $typeCompany->save();
            return redirect(route('type-company.index'))->with('pesan',['success','Berhasil ubah typeCompany']);

        }catch (\Exception $e){
            return redirect(route('type-company.index'))->with('pesan',['danger','Gagal ubah typeCompany']);
        }
    }

    public function delete($id) {

        $typeCompany = TypeCompany::findOrFail($id);

        try{
            $typeCompany->delete();
            return redirect(route('type-company.index'))->with('pesan',['success','Berhasil hapus typeCompany']);

        }catch (\Exception $e){
            return redirect(route('type-company.index'))->with('pesan',['danger','Gagal hapus typeCompany']);
        }
    }
}
