<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiket;
use Carbon\Carbon;
use App\User;
use App\Kategori;
use DB;

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

    public function indexCreateitsm(Request $request)
    {
    	$tikets = Tiket::where('status_tiket','createitsm')->get();
    	$data['tikets'] = $tikets;
        $data['state'] = 'tiket';
    	return view('tiket.list_createitsm',$data);
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

    public function performRequestCurl($uri,$method,$param)
    {
        // persiapkan curl
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $uri);
        // return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'accept: application/json',
            'content-type: application/json',
          ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($param));

        // $output contains the output string 
        $output = curl_exec($ch); 
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // tutup curl 
        curl_close($ch);      

        // menampilkan hasil curl
        return ['response' => $output,'statusCode' => $status_code ];
    }

    public function assignTiket(Request $request)
    {
    	$tiket = Tiket::find($request->id);

        $kategoris = Kategori::all();
        try {
            $recid = $tiket->pegawai->mapping->regional->recid;
            $url = "https://ensomsit.iconpln.co.id/api/tiara_getabsen";
            $param = array(
                "team" => $recid
            );
            $response = $this->performRequestCurl($url,"POST",$param);
            $users = json_decode($response['response']);
            //dd($recid);
        } catch (\Exception $e) {
            $users = User::where('is_itsupport',1)->get();    
        }

        $data['users'] = $users;
        $data['tiket'] = $tiket;
        $data['state'] = 'tiket';
        $data['kategoris'] = $kategoris;
        //print_r($users);
    	return view('tiket.assign_tiket',$data);
    }

    public function storeAssignTiket(Request $request)
    {
    	$tiket = Tiket::find($request->id);
    	$tiket->it_support_username = $request->it_support_username;
    	$tiket->assignment_date = $this->getTimeNow();
        $tiket->status_tiket = 'assigned';
        $tiket->no_tiket = $request->no_tiket;
        $tiket->kategori_id = $request->kategori_id;
    	$tiket->save();
        return redirect('tiket-assigned');
    }

    public function harian(Request $request)
    {
    	$harian = Tiket::all();
    	$data['harians'] = $harian;
        $data['state'] = 'tiket';
    	return view('rekap.harian',$data);
    }

    public function resolve(Request $request)
    {
        $tiket = Tiket::find($request->id);
        $kategoris = Kategori::all();
        $data['state'] = "tiket";
        $data['tiket'] = $tiket;
        return view('tiket.resolve',$data);
    }

    public function storeResolve(Request $request)
    {
        $tiket = Tiket::find($request->id);
        $tiket->status_tiket = 'resolved';
        $tiket->save();
        return redirect('tiket-resolved');
    }

    public function today()
    {
        $tikets = Tiket::whereDate('start_date',Carbon::now()->toDateString())->get();
        $data['tikets'] = $tikets;
        $data['state'] = 'tiket';
        return view('tiket.list',$data);
    }

    public function todayOpen()
    {
        $tikets = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('status_tiket','open')->get();
        $data['tikets'] = $tikets;
        $data['state'] = 'tiket';
        return view('tiket.list_open',$data);
    } 

    public function todayAssigned()
    {
        $tikets = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('status_tiket','assigned')->get();
        $data['tikets'] = $tikets;
        $data['state'] = 'tiket';
        return view('tiket.list_assigned',$data);
    }    

    public function todayResolved()
    {
        $tikets = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('status_tiket','resolved')->get();
        $data['tikets'] = $tikets;
        $data['state'] = 'tiket';
        return view('tiket.list_resolved',$data);
    }

    public function tiketByKategori(Request $request)
    {
        $tikets = Tiket::where('kategori_id',$request->kategori_id)->get();
        $data['tikets'] = $tikets;
        $data['state'] = 'tiket';
        return view('tiket.list',$data);
    }

    public function tiketByPermasalahan(Request $request)
    {
        $tikets = Tiket::where('permasalahan',$request->permasalahan)->get();
        $data['tikets'] = $tikets;
        $data['state'] = 'tiket';
        return view('tiket.list',$data);
    }

    public function tiketByUser(Request $request)
    {
        $tikets = Tiket::where('nip',$request->nip)->get();
        $data['tikets'] = $tikets;
        $data['state'] = 'tiket';
        return view('tiket.list',$data);
    }

    public function tiketByUnit(Request $request)
    {
        $tikets = DB::select("SELECT * FROM `tiket` t,pegawai p where t.nip = p.nip and p.personnel_subarea_name = '".$request->unit."'");
        $data['tikets'] = $tikets;
        $data['state'] = 'tiket';
        return view('tiket.list_unit',$data);
    }

    public function tiketBySupport(Request $request)
    {
        $tikets = Tiket::where('it_support',$request->it_support)->get();
        $data['tikets'] = $tikets;
        $data['state'] = 'tiket';
        return view('tiket.list',$data);
    }

    public function feedback(Request $request)
    {   
        
        $tikets = Tiket::find($request->id);
        $data['tikets'] = $tikets;
        $data['state'] = 'feedback';
    	return view('tiket.feedback',$data);
    }

    public function storeFeedback(Request $request)
    {
        $tikets = Tiket::find($request->id);
        $tikets->feedback = $request->feedback;
        $tikets->save();
        return redirect('/thanksfeed');
    }

}
