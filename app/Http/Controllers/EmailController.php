<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use App\Tiket;

class EmailController extends Controller
{
    public function email(Request $request)
    {
        $tikets = Tiket::find($request->id);
        Mail::to("dzul.ikram@pln.co.id")->send(new Email($tikets->id,$tikets->call_type,$tikets->permasalahan,$tikets->pegawai->nip,$tikets->pegawai->name,$tikets->pegawai->personnel_subarea_name,$tikets->pegawai->email,$tikets->kategori->kategori));
        $tikets->status_tiket = 'createitsm';
    	$tikets->save();
        return redirect('tiket-open'); 
    }
}
