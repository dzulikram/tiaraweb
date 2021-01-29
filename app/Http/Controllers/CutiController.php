<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuti;

class CutiController extends Controller
{
    public function index()
    {   
        $data['state'] = "cuti";
        $data['cutis'] = Cuti::all();
        return view('cuti.list',$data);
    }

    public function create()
    {
        $data['state'] = "cuti";
        return view('cuti.create',$data);
    }

    public function store(Request $request)
    {
        
        $cuti = new Cuti();
        $cuti->it_support = $request->it_support;
        $cuti->mulai = $request->mulai;
        $cuti->selesai = $request->selesai;
        $cuti->perihal = $request->perihal;
        $cuti->save();

        return redirect('/cuti');
    }

    public function edit(Request $request)
    {
        $data['state'] = "cuti";
        $data['cuti'] = Cuti::find($request->id);
        //$data['roles'] = Role::all();
        return view('cuti.edit',$data);
    }

    public function update(Request $request)
    {
        $cuti = Cuti::find($request->id);
        $cuti->it_support = $request->it_support;
        $cuti->mulai = $request->mulai;
        $cuti->selesai = $request->selesai;
        $cuti->perihal = $request->perihal;
        $cuti->save();

        //$user->syncRoles([$request->role]);

        return redirect('/cuti');
    }

    public function delete(Request $request)
    {
        $data['state'] = "cuti";
        Cuti::destroy($request->id);
        return redirect('/cuti');
    }
}
