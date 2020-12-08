<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function tiketPerKategori(Request $request)
    {
    	$query = "select k.id, k.kategori, count(t.id) as jumlah from kategori k, tiket t where k.id = t.kategori_id group by k.id order by jumlah desc";
    	$rekap = DB::select($query);
    	$data['rekap'] = $rekap;
    	return view('rekap_kategori',$data);
    }

	public function tiketPerItSupport(Request $request)
    {
    	$query = "select u.id, u.name, count(t.id) as jumlah from `users` u, tiket t where u.id = t.it_support group by u.id order by jumlah desc";
    	$rekap = DB::select($query);
    	$data['rekap'] = $rekap;
    	return view('rekap_it_support',$data);
    }

    public function tiketPerPegawai(Request $request)
    {
    	$query = "select p.nip, p.`name`, count(t.id) as jumlah from pegawai p, tiket t where p.nip = t.nip group by p.nip order by jumlah desc";
    	$rekap = DB::select($query);
    	$data['rekap'] = $rekap;
    	return view('rekap_pegawai',$data);
    }

    public function tiketPerDate(Request $request)
    {
    	$query = "select date(t.start_date) as tanggal, count(t.id) as jumlah from tiket t group by date(t.start_date)";
    	$rekap = DB::select($query);
    	$data['rekap'] = $rekap;
    	return view('rekap_harian',$data);
    }

    public function tiketPerMonth(Request $request)
    {
    	$query = "select month(t.start_date) as bulan, count(t.id) as jumlah from tiket t group by month(t.start_date)";
    	$rekap = DB::select($query);
    	$data['rekap'] = $rekap;
    	return view('rekap_bulanan',$data);
    }
}
