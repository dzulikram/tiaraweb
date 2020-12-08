<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
//use Spatie\Permission\Models\Role;

class PegawaiController extends Controller
{
    public function index()
    {   
        $data['state'] = "pegawai";
        $data['pegawais'] = Pegawai::all();
        return view('pegawai.list',$data);
    }

    public function create()
    {
        $data['state'] = "pegawai";
        return view('pegawai.create',$data);
    }

    public function store(Request $request)
    {
        
        $pegawai = new Pegawai();
        $pegawai->name = $request->name;
        $pegawai->nip = $request->nip;
        $pegawai->username = $request->username;
        $pegawai->personnel_area = $request->personnel_area;
        $pegawai->personnel_subarea = $request->personnel_subarea;
        $pegawai->personnel_area_name = $request->personnel_area_name;
        $pegawai->personnel_subarea_name = $request->personnel_subarea_name;
        $pegawai->position = $request->position;
        $pegawai->email = $request->email;
        $pegawai->sender = $request->sender;
        $pegawai->save();

        return redirect('/pegawai');
    }

    public function edit(Request $request)
    {
        $data['state'] = "pegawai";
        $data['pegawai'] = Pegawai::find($request->id);
        //$data['roles'] = Role::all();
        return view('pegawai.edit',$data);
    }

    public function update(Request $request)
    {
        $pegawai = Pegawai::find($request->id);
        $pegawai->name = $request->name;
        $pegawai->nip = $request->nip;
        $pegawai->username = $request->username;
        $pegawai->personnel_area = $request->personnel_area;
        $pegawai->personnel_subarea = $request->personnel_subarea;
        $pegawai->personnel_area_name = $request->personnel_area_name;
        $pegawai->personnel_subarea_name = $request->personnel_subarea_name;
        $pegawai->position = $request->position;
        $pegawai->email = $request->email;
        $pegawai->sender = $request->sender;
        $pegawai->save();

        //$user->syncRoles([$request->role]);

        return redirect('/pegawai');
    }

    public function delete(Request $request)
    {
        $data['state'] = "pegawai";
        Pegawai::destroy($request->id);
        return redirect('/pegawai');
    }
}