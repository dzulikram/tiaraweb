<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ReportController extends Controller
{
    public function tiketPerKategori(Request $request)
    {

    	$data['state'] = "report";
    	if(!empty($request->bulan))
    	{
    		$query = "select k.id, k.name, count(t.id) as jumlah from kategori k, tiket t where k.id = t.kategori_id and month(t.start_date) = '".$request->bulan."' and year(t.start_date) = '".$request->tahun."' group by k.id order by jumlah desc";
    		$rekap = DB::select($query);
    		$data['bulan'] = $request->bulan;
    		$data['tahun'] = $request->tahun;
    		$data['rekap'] = $rekap;
    	}
    	else
    	{
    		$query = "select k.id, k.name, count(t.id) as jumlah from kategori k, tiket t where k.id = t.kategori_id group by k.id order by jumlah desc";
    		$rekap = DB::select($query);
    		$data['rekap'] = $rekap;	
    	}
    	return view('report.kategori',$data);
    }

    public function filterPerKategori(Request $request)
    {
    	return redirect("report-kategori?bulan=".$request->bulan."&tahun=".$request->tahun);
    }

	public function tiketPerItSupport(Request $request)
    {
    	$data['state'] = "report";
    	if(!empty($request->bulan))
    	{
    		$query = "select u.id, u.name, count(t.id) as jumlah from users u, tiket t where u.username = t.it_support and month(t.start_date) = '".$request->bulan."' and year(t.start_date) = '".$request->tahun."' group by u.id order by jumlah desc";
	    	$rekap = DB::select($query);
	    	$data['rekap'] = $rekap;
	    	$data['bulan'] = $request->bulan;
    		$data['tahun'] = $request->tahun;
    	}
    	else
    	{
    		$query = "select u.id, u.name, count(t.id) as jumlah from users u, tiket t where u.username = t.it_support  group by u.id order by jumlah desc";
	    	$rekap = DB::select($query);
	    	$data['rekap'] = $rekap;
    	}
    	return view('report.itsupport',$data);
    }

    public function filterPerItSupport(Request $request)
    {
    	return redirect("report-itsupport?bulan=".$request->bulan."&tahun=".$request->tahun);
    }

    public function tiketPerPegawai(Request $request)
    {
    	$data['state'] = "report";
    	if(!empty($request->bulan))
    	{
    		$query = "select p.nip, p.name, count(t.id) as jumlah from pegawai p, tiket t where p.nip = t.nip and month(t.start_date) = '".$request->bulan."' and year(t.start_date) = '".$request->tahun."' group by p.nip,p.name order by jumlah desc";
    		$rekap = DB::select($query);
    		$data['bulan'] = $request->bulan;
    		$data['tahun'] = $request->tahun;
    		$data['rekap'] = $rekap;
    	}
    	else
    	{
    		$query = "select p.nip, p.name, count(t.id) as jumlah from pegawai p, tiket t where p.nip = t.nip group by p.nip, p.name order by jumlah desc";
    		$rekap = DB::select($query);
    		$data['rekap'] = $rekap;
    	}
    	return view('report.pegawai',$data);
    }

    public function filterPerPegawai(Request $request)
    {
    	return redirect("report-pegawai?bulan=".$request->bulan."&tahun=".$request->tahun);
    }

    public function tiketPerDate(Request $request)
    {
    	if(!empty($request->bulan))
    	{
    		$query = "select date(t.start_date) as tanggal, count(t.id) as jumlah from tiket t where month(t.start_date) = '".$request->bulan."' and year(t.start_date) = '".$request->tahun."' group by date(t.start_date)";
    		$rekap = DB::select($query);
    		$data['bulan'] = $request->bulan;
    		$data['tahun'] = $request->tahun;
    		$data['rekap'] = $rekap;
    	}
    	$data['state'] = "report";
    	return view('report.harian',$data);
    }

    public function filterPerDate(Request $request)
    {
    	return redirect("report-harian?bulan=".$request->bulan."&tahun=".$request->tahun);
    }

    public function tiketPerMonth(Request $request)
    {
    	if(!empty($request->tahun))
    	{
    		$query = "select month(t.start_date) as bulan, count(t.id) as jumlah from tiket t where year(t.start_date) = '".$request->tahun."' group by month(t.start_date)";
    		$data['tahun'] = $request->tahun;
    		$rekap = DB::select($query);
    		$data['rekap'] = $rekap;
    	}
    	$data['state'] = "report";
    	return view('report.bulanan',$data);
    }

    public function filterPerMonth(Request $request)
    {
    	return redirect("report-bulanan?tahun=".$request->tahun);
    }

	public function tiketPerKategoriunit(Request $request)
    {
		$auth = Auth::user()->sti_id;
    	$data['state'] = "report-unit";
    	if(!empty($request->bulan))
    	{
    		$query = "select k.id, k.name, count(t.id) as jumlah from kategori k, tiket t where k.id = t.kategori_id and month(t.start_date) = '".$request->bulan."' and year(t.start_date) = '".$request->tahun."' and t.sti_id = ".$auth." group by k.id order by jumlah desc";
    		$rekap = DB::select($query);
    		$data['bulan'] = $request->bulan;
    		$data['tahun'] = $request->tahun;
    		$data['rekap'] = $rekap;
    	}
    	else
    	{
    		$query = "select k.id, k.name, count(t.id) as jumlah from kategori k, tiket t where k.id = t.kategori_id and t.sti_id = ".$auth." group by k.id order by jumlah desc";
    		$rekap = DB::select($query);
    		$data['rekap'] = $rekap;	
    	}
    	return view('report.kategori',$data);
    }

    public function filterPerKategoriunit(Request $request)
    {
    	return redirect("report-kategori-unit?bulan=".$request->bulan."&tahun=".$request->tahun);
    }

	public function tiketPerItSupportunit(Request $request)
    {
		$auth = Auth::user()->sti_id;
    	$data['state'] = "report-unit";
    	if(!empty($request->bulan))
    	{
    		$query = "select u.id, u.name, count(t.id) as jumlah from users u, tiket t where u.username = t.it_support and month(t.start_date) = '".$request->bulan."' and year(t.start_date) = '".$request->tahun."' and t.sti_id = ".$auth." group by u.id order by jumlah desc";
	    	$rekap = DB::select($query);
	    	$data['rekap'] = $rekap;
	    	$data['bulan'] = $request->bulan;
    		$data['tahun'] = $request->tahun;
    	}
    	else
    	{
    		$query = "select u.id, u.name, count(t.id) as jumlah from users u, tiket t where u.username = t.it_support and t.sti_id = ".$auth." group by u.id order by jumlah desc";
	    	$rekap = DB::select($query);
	    	$data['rekap'] = $rekap;
    	}
    	return view('report.itsupport',$data);
    }

    public function filterPerItSupportunit(Request $request)
    {
    	return redirect("report-itsupport-unit?bulan=".$request->bulan."&tahun=".$request->tahun);
    }

    public function tiketPerPegawaiunit(Request $request)
    {
		$auth = Auth::user()->sti_id;
    	$data['state'] = "report-unit";
    	if(!empty($request->bulan))
    	{
    		$query = "select p.nip, p.name, count(t.id) as jumlah from pegawai p, tiket t where p.nip = t.nip and month(t.start_date) = '".$request->bulan."' and year(t.start_date) = '".$request->tahun."' and t.sti_id = ".$auth." group by p.nip, p.name order by jumlah desc";
    		$rekap = DB::select($query);
    		$data['bulan'] = $request->bulan;
    		$data['tahun'] = $request->tahun;
    		$data['rekap'] = $rekap;
    	}
    	else
    	{
    		$query = "select p.nip, p.name, count(t.id) as jumlah from pegawai p, tiket t where p.nip = t.nip and t.sti_id = ".$auth." group by p.nip, p.name order by jumlah desc";
    		$rekap = DB::select($query);
    		$data['rekap'] = $rekap;
    	}
    	return view('report.pegawai',$data);
    }

    public function filterPerPegawaiunit(Request $request)
    {
    	return redirect("report-pegawai-unit?bulan=".$request->bulan."&tahun=".$request->tahun);
    }

    public function tiketPerDateunit(Request $request)
    {
		$auth = Auth::user()->sti_id;
    	if(!empty($request->bulan))
    	{
    		$query = "select date(t.start_date) as tanggal, count(t.id) as jumlah from tiket t where month(t.start_date) = '".$request->bulan."' and year(t.start_date) = '".$request->tahun."' and t.sti_id = ".$auth." group by date(t.start_date)";
    		$rekap = DB::select($query);
    		$data['bulan'] = $request->bulan;
    		$data['tahun'] = $request->tahun;
    		$data['rekap'] = $rekap;
    	}
    	$data['state'] = "report-unit";
    	return view('report.harian',$data);
    }

    public function filterPerDateunit(Request $request)
    {
    	return redirect("report-harian-unit?bulan=".$request->bulan."&tahun=".$request->tahun);
    }

    public function tiketPerMonthunit(Request $request)
    {
    	if(!empty($request->tahun))
    	{
			$auth = Auth::user()->sti_id;
    		$query = "select month(t.start_date) as bulan, count(t.id) as jumlah from tiket t where year(t.start_date) = '".$request->tahun."' and t.sti_id = ".$auth." group by month(t.start_date)";
    		$data['tahun'] = $request->tahun;
    		$rekap = DB::select($query);
    		$data['rekap'] = $rekap;
    	}
    	$data['state'] = "report-unit";
    	return view('report.bulanan',$data);
    }

    public function filterPerMonthunit(Request $request)
    {
    	return redirect("report-bulanan-unit?tahun=".$request->tahun);
    }
}
