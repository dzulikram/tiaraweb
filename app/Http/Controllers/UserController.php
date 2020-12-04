<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $data['state']="user";
        $data['users']=User::all();
        return view('user',$data);

    }
}
