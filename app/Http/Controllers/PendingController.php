<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pending;
use Carbon\Carbon;
use App\Tiket;
use App\Kategori;
use App\User;

class PendingController extends Controller
{
	public function getById(Request $request)
	{

		$tiket = Tiket::find($request->id);
		$data['tiket'] = $tiket;
		$data['kategoris'] = Kategori::all();
		$data['users'] = User::all();
		$data['state'] = 'pending';
		return view('pending.pending',$data);
	}

	public function storeById(Request $request)
	{
		$tiket = Tiket::find($request->id);
		$tiket->status_tiket = 'pending';
		$tiket->save();

		$pending = new Pending();
		$pending->tiket_id = $request->id;
		$pending->start = $this->getTimeNow();
		$pending->reason = $request->reason;
		$pending->action_by = $tiket->it_support;
		$pending->save();

		return redirect('dashboard');
	}

	public function getTimeNow()
    {
        return Carbon::now()->toDateTimeString();
        //return date(now());
    }

	public function continue(Request $request)
	{
		$tiket = Tiket::find($request->id);
		$data['tiket'] = $tiket;
		$data['kategoris'] = Kategori::all();
		$data['users'] = User::all();
		$data['state'] = 'pending';
		return view('pending.continue',$data);
	}

	public function storeContinue(Request $request)
	{
		$tiket = Tiket::find($request->id);
		$tiket->status_tiket = 'assigned';
		$tiket->save();

		$pending = Pending::where('tiket_id',$tiket->id)->whereNull('end')->first();
		$pending->end = $this->getTimeNow();
		$pending->save();
		return redirect('dashboard');
	}
}
