<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiket;
use Carbon\Carbon;

class PageController extends Controller
{
    public function index()
    {
    	$n_tiket = Tiket::whereDate('start_date',Carbon::now()->toDateString())->count();
    	$n_open = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('status_tiket','open')->count();
    	$n_assigned = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('status_tiket','assigned')->count();
    	$n_resolved = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('status_tiket','resolved')->count();

    	$tiket_open = Tiket::where('status_tiket','open')->get();
    	$tiket_assigned = Tiket::where('status_tiket','assigned')->get();

    	// assign to view
    	$data['n_open'] = $n_open;
    	$data['n_assigned'] = $n_assigned;
    	$data['n_tiket'] = $n_tiket;
    	$data['n_resolved'] = $n_resolved;
        $data['state']="dashboard";
        $data['tiket_assigned'] = $tiket_assigned;
        $data['tiket_open'] = $tiket_open;
        return view('dashboard',$data);
    }


}
