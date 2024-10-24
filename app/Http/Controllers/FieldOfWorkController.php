<?php

namespace App\Http\Controllers;

use App\Models\FieldOfWork;
use Illuminate\Http\Request;

class FieldOfWorkController extends Controller
{
    public function index(){
        $fieldWork = FieldOfWork::all();
        return view('admin.fieldWork.list', compact('fieldWork'));
    }

    public function add(){
        return view('admin.fieldWork.add');
    }

    public function store(Request $request) {
        
        $this->validate($request, [
            'name'=>'required'
        ]);

        $fieldWork = new FieldOfWork();
        $fieldWork->name= $request->name;

        try{
            $fieldWork->save();
            return redirect(route('field-work.index'))->with('pesan',['success','Berhasil tambah fieldWork']);

        }catch (\Exception $e){
            return redirect(route('field-work.index'))->with('pesan',['danger','Gagal tambah fieldWork']);
        }
    }

    public function edit($id){
        $fieldWork = FieldOfWork::findOrFail($id);
        return view('admin.fieldWork.edit', compact('fieldWork'));
    }

    public function update(Request $request) {

        $this->validate($request, [
            'id'=>'required',
            'name'=>'required',
        ]);

        $fieldWork = FieldOfWork::findOrFail($request->id);
        $fieldWork->name= $request->name;

        try{
            $fieldWork->save();
            return redirect(route('field-work.index'))->with('pesan',['success','Berhasil ubah fieldWork']);

        }catch (\Exception $e){
            return redirect(route('field-work.index'))->with('pesan',['danger','Gagal ubah fieldWork']);
        }
    }

    public function delete($id) {

        $fieldWork = FieldOfWork::findOrFail($id);

        try{
            $fieldWork->delete();
            return redirect(route('field-work.index'))->with('pesan',['success','Berhasil hapus fieldWork']);

        }catch (\Exception $e){
            return redirect(route('field-work.index'))->with('pesan',['danger','Gagal hapus fieldWork']);
        }
    }
}
