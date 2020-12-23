<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChatKategori;

class ChatKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['chatkategoris'] = ChatKategori::all();
        $data['state'] = "chatkategori";
        return view('chatkategori.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['state'] = "chatkategori";
        return view('chatkategori.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chatkategori = new ChatKategori();
        $chatkategori->chatkategori = $request->chatkategori;
        $chatkategori->save();
        return redirect('chatkategori');
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
        $data['state'] = "chatkategori";
        $data['chatkategori'] = ChatKategori::find($request->id);
        //$data['roles'] = Role::all();
        return view('chatkategori.edit',$data);
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
        $chatkategori = ChatKategori::find($request->id);
        $chatkategori->chatkategori = $request->chatkategori;
        $chatkategori->save();

        //$chatkategori->syncRoles([$request->role]);

        return redirect('/chatkategori');
    }


    public function delete(Request $request)
    {
        $data['state'] = "chatkategori";
        ChatKategori::destroy($request->id);
        return redirect('/chatkategori');
    }
}