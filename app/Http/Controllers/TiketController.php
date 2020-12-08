<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiket;
use Carbon\Carbon;
use App\User;

class TiketController extends Controller
{

	public function getTimeNow()
    {
        return Carbon::now()->toDateTimeString();
        //return date(now());
    }

    public function index(Request $request)
    {
    	$tikets = Tiket::all();
    	$data['tikets'] = $tikets;
        $data['state'] = 'tiket';
    	return view('tiket.list',$data);
    }

    public function indexOpen(Request $request)
    {
    	$tikets = Tiket::where('status_tiket','open')->get();
    	$data['tikets'] = $tikets;
        $data['state'] = 'tiket';
    	return view('tiket.list_open',$data);
    }

    public function indexAssigned(Request $request)
    {
    	$tikets = Tiket::where('status_tiket','assigned')->get();
    	$data['tikets'] = $tikets;
        $data['state'] = 'tiket';
    	return view('tiket.list_assigned',$data);
    }

    public function indexResolved(Request $request)
    {
    	$tikets = Tiket::where('status_tiket','resolved')->get();
    	$data['tikets'] = $tikets;
        $data['state'] = 'tiket';
    	return view('tiket.list_resolved',$data);
    }

    public function assignTiket(Request $request)
    {
    	$tiket = Tiket::find($request->id);
        $users = User::where('is_itsupport',1)->get();
        $data['users'] = $users;
        $data['tiket'] = $tiket;
        $data['state'] = 'tiket';
    	return view('tiket.assign_tiket',$data);
    }

    public function storeAssignTiket(Request $request)
    {
    	$tiket = Tiket::find($request->id);
    	$tiket->it_support = $request->it_support;
    	$tiket->assignment_date = $this->getTimeNow();
        $tiket->status_tiket = 'assigned';
    	$tiket->save();

        return redirect('tiket-assigned');
    }


}
