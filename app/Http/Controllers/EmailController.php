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
        if($tikets->call_type=="incident")
        {
            $kategorimail = "incident";
        }
        else
        {
            $kategorimail = $tikets->kategori->kategori;
        }
        Mail::to("dzul.ikram@pln.co.id")->send(new Email($tikets->id,$tikets->call_type,$tikets->permasalahan,$tikets->pegawai->nip,$tikets->pegawai->name,$tikets->pegawai->personnel_subarea_name,$tikets->pegawai->email,$kategorimail));
        $tikets->status_tiket = 'createitsm';
    	$tikets->save();
        return redirect('tiket-open'); 
    }
}
