<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(){
        $location = Location::all();
        return view('location.list', compact('location'));
    }

    public function add(){
        return view('location.add');
    }

    public function store(Request $request) {
        
        $this->validate($request, [
            'name'=>'required'
        ]);

        $location = new Location();
        $location->name= $request->name;

        try{
            $location->save();
            return redirect(route('location.index'))->with('pesan',['success','Berhasil tambah location']);

        }catch (\Exception $e){
            return redirect(route('location.index'))->with('pesan',['danger','Gagal tambah location']);
        }
    }

    public function edit($id){
        $location = Location::findOrFail($id);
        return view('location.edit', compact('location'));
    }

    public function update(Request $request) {

        $this->validate($request, [
            'id'=>'required',
            'name'=>'required',
        ]);

        $location = Location::findOrFail($request->id);
        $location->name= $request->name;

        try{
            $location->save();
            return redirect(route('location.index'))->with('pesan',['success','Berhasil ubah location']);

        }catch (\Exception $e){
            return redirect(route('location.index'))->with('pesan',['danger','Gagal ubah location']);
        }
    }

    public function delete($id) {

        $location = Location::findOrFail($id);

        try{
            $location->delete();
            return redirect(route('location.index'))->with('pesan',['success','Berhasil hapus location']);

        }catch (\Exception $e){
            return redirect(route('location.index'))->with('pesan',['danger','Gagal hapus location']);
        }
    }

}
