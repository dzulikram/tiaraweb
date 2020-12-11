<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pojok;

class PojokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pojoks'] = Pojok::all();
        $data['state'] = "pojok";
        return view('pojok.list',$data);
    }

    public function indexGuest()
    {
        $data['pojoks'] = Pojok::all();
        $data['state'] = "pojok";
        return view('guest.list_pojok',$data);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['state'] = "pojok";
        return view('pojok.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pojok = new Pojok();
        $pojok->judul = $request->judul;
        $pojok->konten = $request->konten;
        $pojok->save();
        return redirect('pojok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data['state'] = "pojok";
        $data['pojok'] = Pojok::find($request->id);
        //$data['roles'] = Role::all();
        return view('pojok.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pojok = Pojok::find($request->id);
        $pojok->judul = $request->judul;
        $pojok->konten = $request->konten; 
        $pojok->save();

        //$pojok->syncRoles([$request->role]);

        return redirect('/pojok');
    }


    public function delete(Request $request)
    {
        $data['state'] = "pojok";
        Pojok::destroy($request->id);
        return redirect('/pojok');
    }
}
