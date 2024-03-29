<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use App\Saran;

class SaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sarans'] = Saran::all();
        $data['state'] = "saran";
        return view('saran.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGuest()
    {
        $data['state'] = "saran";
        return view('guest.create_saran',$data);
    }

    public function create()
    {
        $data['state'] = "saran";
        return view('saran.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $saran = new Saran();
        $saran->name = $request->name;
        $saran->saran = $request->saran;
        $saran->save();
        return redirect('thanks');
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
        $saran = Saran::find($request->id);
        return view('saran.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function thanks()
    {
        return view('guest.thanks');
    }

    public function thanksFeed()
    {
        return view('guest.thanksfeed');
    }


    public function landingDesktop()
    {
        return view('guest.alert');
    }

    public function landingDesktopUip()
    {
        return view('guest.alertuip');
    }

}
