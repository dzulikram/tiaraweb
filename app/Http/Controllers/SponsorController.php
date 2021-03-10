<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sponsor;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sponsor'] = Sponsor::all();
        $data['state'] = "sponsor";
        return view('sponsor.list',$data);
    }

    public function edit(Request $request)
    {
        $data['state'] = "sponsor";
    	$data['sponsor'] = Sponsor::find($request->id);
    	return view('sponsor.edit',$data);
    }

    public function update(Request $request)
    {
    	$sponsor = Sponsor::find($request->id);
    	$sponsor->sponsor = $request->sponsor;
        $sponsor->save();

    	return redirect('/sponsor');
    }
}