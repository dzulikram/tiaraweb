<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;

class ChatController extends Controller
{
    public function index(Request $request)
    {
    	$chats = Chat::all();
    	$data['chats'] = $chats;
    	$data['state'] = "chat";
    	foreach ($chats as $row) 
    	{
    		// dd($row->pegawai);
    	}
    	return view('chat.list',$data);
    }

}
