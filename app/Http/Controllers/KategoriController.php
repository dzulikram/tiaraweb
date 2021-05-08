<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kategoris'] = Kategori::all();
        $data['state'] = "kategori";
        return view('kategori.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['state'] = "kategori";
        return view('kategori.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kategori = new Kategori();
        $kategori->kategori = $request->kategori;
        $kategori->save();
        return redirect('kategori');
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
        $data['state'] = "kategori";
        $data['kategori'] = Kategori::find($request->id);
        //$data['roles'] = Role::all();
        return view('kategori.edit',$data);
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
        $kategori = Kategori::find($request->id);
        $kategori->name = $request->name;
        $kategori->save();

        //$kategori->syncRoles([$request->role]);

        return redirect('/kategori');
    }


    public function delete(Request $request)
    {
        $data['state'] = "kategori";
        Kategori::destroy($request->id);
        return redirect('/kategori');
    }
}