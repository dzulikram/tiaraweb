<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mapping;
use App\User;
use DB;

class MappingController extends Controller
{
    public function index(Request $request)
    {
    	$mapping = Mapping::all();
    	$data['mapping'] = $mapping;
    	$data['state'] = 'mapping';
    	return view('mapping.list',$data);
    }

    public function create(Request $request)
    {
    	$user = User::all();
    	$unit = DB::select("SELECT p.personnel_subarea_name FROM `pegawai` p group by p.personnel_subarea_name");

    	$data['user'] = $user;
    	$data['unit'] = $unit;
    	$data['state'] = 'mapping';
    	return view('mapping.create',$data);
    }

    public function store(Request $request)
    {
    	$mapping = new Mapping();
    	$mapping->it_support = $request->it_support;
    	$mapping->unit = $request->unit;
    	$mapping->save();

    	return redirect('mapping');
    }

    public function edit(Request $request)
    {
    	$mapping = Mapping::find($request->id);
    	$user = User::all();
    	$unit = DB::select("SELECT p.personnel_subarea_name FROM `pegawai` p group by p.personnel_subarea_name");
    	$data['user'] = $user;
    	$data['unit'] = $unit;
    	$data['mapping'] = $mapping;
    	$data['state'] = 'mapping';
    	return view('mapping.edit',$data);
    }

    public function update(Request $request)
    {
    	$mapping = Mapping::find($request->id);
    	$mapping->it_support = $request->it_support;
    	$mapping->unit = $request->unit;
    	$mapping->save();

    	return redirect('mapping');
    }
}
