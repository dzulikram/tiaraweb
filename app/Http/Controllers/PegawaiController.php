<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\RegionalSti;
use App\Unit;
use Auth;
use DB;
//use Spatie\Permission\Models\Role;

class PegawaiController extends Controller
{
    public function index()
    {   
        $data['state'] = "pegawai";
        $data['pegawais'] = Pegawai::all();
        return view('pegawai.list',$data);
    }

    public function indexunit()
    {   
        $auth = Auth::user()->sti_id;
        $data['state'] = "pegawai";
        $data['pegawais'] = Pegawai::where('sti_id',$auth)->get();
        return view('pegawai.list',$data);
    }
    
    public function create()
    {
        $auth = Auth::user()->sti_id;
        $data['state'] = "pegawai";
        $data['sti'] = RegionalSti::all();
        $data['unit_induk'] = DB::select("select unit_induk, sti_id from unit where sti_id = ".$auth." group by unit_induk, sti_id");
        $data['unit_pelaksana'] = DB::select("select unit_pelaksana, sti_id from unit where sti_id = ".$auth." group by unit_pelaksana, sti_id");
        $data['unit_subpelaksana'] = DB::select("select unit_subpelaksana, sti_id from unit where sti_id = ".$auth." and unit_subpelaksana<>'' ");
        return view('pegawai.create',$data);
    }

    public function store(Request $request)
    {
        $auth = Auth::user()->id;
        $sti = Auth::user()->sti_id; 
        
        if($sti == 2)
        {$sender = 2;}
        else
        {$sender = 0;}

        $pegawai = new Pegawai();
        $pegawai->name = $request->name;
        $pegawai->nip = $request->nip;
        // $pegawai->username = $request->username;
        // $pegawai->personnel_area = $request->personnel_area;
        // $pegawai->business_area = $request->business_area;
        // $pegawai->personnel_subarea = $request->personnel_subarea;
        $pegawai->personnel_area_name = $request->personnel_area_name;
        $pegawai->business_area_name = $request->business_area_name;
        $pegawai->personnel_subarea_name = $request->personnel_subarea_name;
        $pegawai->unit_induk = $request->unit_induk;
        $pegawai->unit = $request->unit;
        $pegawai->position = $request->position;
        $pegawai->email = $request->email;
        $pegawai->sender = $sender;
        if($auth == 1)
        {
            $pegawai->sti_id = $request->sti_id;
        }
        else
        {
            $pegawai->sti_id = $sti;
        }
        $pegawai->save();
        
        if($auth == 1)
        {
            return redirect('/pegawai');
        }
        else
        {
            return redirect('/pegawai-unit');
        }
    }

    public function edit(Request $request)
    {
        $auth = Auth::user()->sti_id;
        $data['state'] = "pegawai";
        $data['pegawai'] = Pegawai::find($request->id);
        $data['sti'] = RegionalSti::all();
        $data['unit_induk'] = DB::select("select unit_induk, sti_id from unit where sti_id = ".$auth." group by unit_induk,sti_id");
        $data['unit_pelaksana'] = DB::select("select unit_pelaksana, sti_id from unit where sti_id = ".$auth." group by unit_pelaksana,sti_id");
        $data['unit_subpelaksana'] = DB::select("select unit_subpelaksana, sti_id from unit where sti_id = ".$auth." and unit_subpelaksana<>'' ");
        //$data['roles'] = Role::all();
        return view('pegawai.edit',$data);
    }

    public function update(Request $request)
    {
        $auth = Auth::user()->id; 
        $pegawai = Pegawai::find($request->id);
        $pegawai->name = $request->name;
        $pegawai->nip = $request->nip;
        // $pegawai->username = $request->username;
        // $pegawai->personnel_area = $request->personnel_area;
        // $pegawai->business_area = $request->business_area;
        // $pegawai->personnel_subarea = $request->personnel_subarea;
        $pegawai->personnel_area_name = $request->personnel_area_name;
        $pegawai->business_area_name = $request->business_area_name;
        $pegawai->personnel_subarea_name = $request->personnel_subarea_name;
        $pegawai->unit_induk = $request->unit_induk;
        $pegawai->unit = $request->unit;
        $pegawai->position = $request->position;
        $pegawai->email = $request->email;
        if($auth == 1)
        {
            $pegawai->sti_id = $request->sti_id;
        }
        $pegawai->save();

        //$user->syncRoles([$request->role]);

        if($auth == 1)
        {
            return redirect('/pegawai');
        }
        else
        {
            return redirect('/pegawai-unit');
        }
    }

    public function delete(Request $request)
    {
        $auth = Auth::user()->id; 
        $data['state'] = "pegawai";
        Pegawai::destroy($request->id);
        if($auth == 1)
        {
            return redirect('/pegawai');
        }
        else
        {
            return redirect('/pegawai-unit');
        }
    }
}