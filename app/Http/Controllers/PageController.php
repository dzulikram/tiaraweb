<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $data['state']="dashboard";
        return view('dashboard',$data);
    }


}
