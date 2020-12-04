<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeluhanController extends Controller
{
    public function index()
    {
        $data['state']="keluhan";
        return view('keluhan',$data);

    }
}
