<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public function index(){
        $industry = Industry::all();
        return view('admin.industry.list', compact('industry'));
    }

    public function add(){
        return view('admin.industry.add');
    }

    public function store(Request $request) {
        
        $this->validate($request, [
            'name'=>'required'
        ]);

        $industry = new Industry();
        $industry->name= $request->name;

        try{
            $industry->save();
            return redirect(route('industry.index'))->with('pesan',['success','Berhasil tambah industry']);

        }catch (\Exception $e){
            return redirect(route('industry.index'))->with('pesan',['danger','Gagal tambah industry']);
        }
    }

    public function edit($id){
        $industry = Industry::findOrFail($id);
        return view('admin.industry.edit', compact('industry'));
    }

    public function update(Request $request) {

        $this->validate($request, [
            'id'=>'required',
            'name'=>'required',
        ]);

        $industry = Industry::findOrFail($request->id);
        $industry->name= $request->name;

        try{
            $industry->save();
            return redirect(route('industry.index'))->with('pesan',['success','Berhasil ubah industry']);

        }catch (\Exception $e){
            return redirect(route('industry.index'))->with('pesan',['danger','Gagal ubah industry']);
        }
    }

    public function delete($id) {

        $industry = Industry::findOrFail($id);

        try{
            $industry->delete();
            return redirect(route('industry.index'))->with('pesan',['success','Berhasil hapus industry']);

        }catch (\Exception $e){
            return redirect(route('industry.index'))->with('pesan',['danger','Gagal hapus industry']);
        }
    }
}
