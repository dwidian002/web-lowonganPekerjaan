<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $category = JobCategory::all();
        return view('admin.category.list', compact('category'));
    }

    public function add(){
        return view('admin.category.add');
    }

    public function store(Request $request) {
        
        $this->validate($request, [
            'name'=>'required'
        ]);

        $category = new JobCategory();
        $category->name= $request->name;

        try{
            $category->save();
            return redirect(route('category.index'))->with('pesan',['success','Berhasil tambah category']);

        }catch (\Exception $e){
            return redirect(route('category.index'))->with('pesan',['danger','Gagal tambah category']);
        }
    }

    public function edit($id){
        $category = JobCategory::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request) {

        $this->validate($request, [
            'id'=>'required',
            'name'=>'required',
        ]);

        $category = JobCategory::findOrFail($request->id);
        $category->name= $request->name;

        try{
            $category->save();
            return redirect(route('category.index'))->with('pesan',['success','Berhasil ubah category']);

        }catch (\Exception $e){
            return redirect(route('category.index'))->with('pesan',['danger','Gagal ubah category']);
        }
    }

    public function delete($id) {

        $category = JobCategory::findOrFail($id);

        try{
            $category->delete();
            return redirect(route('category.index'))->with('pesan',['success','Berhasil hapus category']);

        }catch (\Exception $e){
            return redirect(route('category.index'))->with('pesan',['danger','Gagal hapus category']);
        }
    }
}
