<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiket;
use Carbon\Carbon;
use DB;

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

    public function analytics(Request $request)
    {
        $n_tiket = Tiket::count();
        $n_open = Tiket::where('status_tiket','open')->count();
        $n_assigned = Tiket::where('status_tiket','assigned')->count();
        $n_resolved = Tiket::where('status_tiket','resolved')->count();

        $tiket_open = Tiket::where('status_tiket','open')->get();
        $tiket_assigned = Tiket::where('status_tiket','assigned')->get();

        $n_kategori = DB::select('select k.id,k.kategori,count(t.id) as jumlah from kategori k,tiket t where k.id = t.kategori_id and t.is_autoclose is null group by k.id,k.kategori');

        $n_autoclose = DB::select("select t.permasalahan, count(t.id) as jumlah from tiket t where t.is_autoclose = 1 group by t.permasalahan");

        $n_support = DB::select("select u.id, u.`name`, count(t.id) as jumlah from tiket t, users u where t.it_support = u.id group by u.id, u.name order by jumlah desc limit 3");

        $n_user = DB::select("select p.nip, p.name, count(t.id) as jumlah from pegawai p, tiket t where p.nip = t.nip group by p.nip, p.name order by jumlah desc limit 3");

        $data['n_open'] = $n_open;
        $data['n_assigned'] = $n_assigned;
        $data['n_tiket'] = $n_tiket;
        $data['n_resolved'] = $n_resolved;
        $data['state']="analytics";
        $data['n_kategori'] = $n_kategori;
        $data['n_autoclose'] = $n_autoclose;
        $data['n_support'] = $n_support;
        $data['n_user'] = $n_user;

        return view('analytics',$data);
    }


}
