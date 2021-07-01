<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use App\Tiket;
use App\Kategori;
use Auth;

class EmailController extends Controller
{
    public function email(Request $request)
    {
        $auth = Auth::user()->id;
        $tiket = Tiket::find($request->id);
        $tiket->kategori_id = $request->kategori_id;
        
        $tiket->save();          
        $kategorimail = $tiket->kategori->name;
        Mail::to("servicedesk@pln.co.id")->send(new Email($tiket->id,$tiket->call_type,$tiket->permasalahan,$tiket->pegawai->nip,$tiket->pegawai->name,$tiket->pegawai->position,$tiket->pegawai->unit,$tiket->pegawai->email,$kategorimail));
        $tiket->status_tiket = 'assigned';
    	$tiket->save();
        if($auth != 1)
            {return redirect('dashboard-unit')->with(['success' => 'Message']);}
        else
            {return redirect('dashboard')->with(['success' => 'Message']);}
    }
}
