<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiket;
use Carbon\Carbon;
use App\User;
use App\Kategori;
use App\RegionalSti;
use Auth;
use DB;
use DateTime;
use DatePeriod;
use DateInterval;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Export;

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

    public function apiTiket(Request $request)
	{
		$data = $request->json()->all();

        $notiket = $data['no_tiket'];
        $assignment_date = $data['assignment_date'];
        $end_date = $data['end_date'];
        $status_tiket = $data['status_tiket'];
        $resolution = $data['resolution'];
        $reason_stop = $data['reason_stop'];
        $stop_duration = $data['stop_duration'];
        $sla_duration = $data['sla_duration'];

        $date1 = new DateTime($assignment_date);
        $date1 = $date1->modify("+7 hours");

        $date2 = new DateTime($end_date);
        $date2 = $date2->modify("+7 hours");

        $tiket = Tiket::where('no_tiket',$notiket)->first();

        if($tiket->regional->timezone == 'wib')
        {
        $date1 = new DateTime($assignment_date);
        $date1 = $date1->modify("+7 hours");
        $date2 = new DateTime($end_date);
        $date2 = $date2->modify("+7 hours");
        }
        if($tiket->regional->timezone == 'wita')
        {
        $date1 = new DateTime($assignment_date);
        $date1 = $date1->modify("+8 hours");
        $date2 = new DateTime($end_date);
        $date2 = $date2->modify("+8 hours");
        }

        $tiket->assignment_date = $date1;
        $tiket->end_date = $date2;
        if($status_tiket=="Assigned")
        {
            $tiket->status_tiket = "assigned";
        }
        if($status_tiket=="Resolved")
        {
            $tiket->status_tiket = "resolved";
        }
        if($status_tiket=="Stop Clock")
        {
            $tiket->status_tiket = "pending";
        }
        $tiket->resolution = $resolution;
        $tiket->reason_stop = $reason_stop;
        $tiket->stop_duration = $stop_duration;
        $tiket->sla_duration = $sla_duration;
        $tiket->save();

        if(!empty($tiket))
        {
            $status = $notiket."-success";
        }
        else
        {
            $status = "failed";
        }

		return response()->json([
            'replies' => $status,
          ], 200)->withHeaders([
            "Content-type" => "application/json",
            "Access-Control-Allow-Origin" => "*"
          ]);
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

    public function indexunit(Request $request)
    {
        $auth = Auth::user()->sti_id;
        $tikets = Tiket::where('sti_id',$auth)->get();
    	$data['tikets'] = $tikets;
        $data['state'] = 'tiket-unit';
    	return view('tiket.list',$data);
    }

    public function indexOpenunit(Request $request)
    {
        $auth = Auth::user()->sti_id;
    	$tikets = Tiket::where('status_tiket','open')->where('sti_id',$auth)->get();
    	$data['tikets'] = $tikets;
        $data['state'] = 'tiket-unit';
    	return view('tiket.list_open',$data);
    }

    public function indexCreateitsmunit(Request $request)
    {
        $auth = Auth::user()->sti_id;
    	$tikets = Tiket::where('status_tiket','createitsm')->where('sti_id',$auth)->get();
    	$data['tikets'] = $tikets;
        $data['state'] = 'tiket-unit';
    	return view('tiket.list_createitsm',$data);
    }

    public function indexAssignedunit(Request $request)
    {
        $auth = Auth::user()->sti_id;
    	$tikets = Tiket::where('status_tiket','assigned')->where('sti_id',$auth)->get();
    	$data['tikets'] = $tikets;
        $data['state'] = 'tiket-unit';
    	return view('tiket.list_assigned',$data);
    }

    public function indexResolvedunit(Request $request)
    {
        $auth = Auth::user()->sti_id;
    	$tikets = Tiket::where('status_tiket','resolved')->where('sti_id',$auth)->get();
    	$data['tikets'] = $tikets;
        $data['state'] = 'tiket-unit';
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

    public function Createitsm(Request $request)
    {
        $auth = Auth::user()->sti_id;
    	$tiket = Tiket::find($request->id);
        $kategoris = Kategori::all();
    	$data['tiket'] = $tiket;
        $data['state'] = 'tiket';
        $data['kategoris'] = $kategoris;
    	return view('tiket.create_itsm',$data);
    }

    public function emailTiket(Request $request)
    {
        $auth = Auth::user()->sti_id;
    	$tiket = Tiket::find($request->id);
        $kategoris = Kategori::where('type','APP')->get();
    	$data['tiket'] = $tiket;
        $data['state'] = 'tiket';
        $data['kategoris'] = $kategoris;
    	return view('tiket.email_tiket',$data);
    }

    public function incidentTiket(Request $request)
    {
        $auth = Auth::user()->sti_id;
    	$tiket = Tiket::find($request->id);        
        try {
            $recid = $tiket->regional->recid;
            $url = "http://10.68.35.241:7004/api/tiara_getabsen";
            $param = array(
                "team" => $recid
            );
            $response = $this->performRequestCurl($url,"POST",$param);
            
            if($tiket->pegawai->sender == 2){$users = User::where('is_itsupport',2)->get();}
            elseif($tiket->pegawai->sender == 4){$users = User::where('is_itsupport',4)->get();}
            elseif($tiket->pegawai->sender == 21){$users = User::where('is_itsupport',21)->get();}
            else{$users = json_decode($response['response']);}                
            //dd($users);
        } catch (\Exception $e) {
            $users = User::where('is_itsupport',1)->get();    
        }
 
        $kategoris = Kategori::where('type','INC')->get();

        $data['users'] = $users;
        $data['tiket'] = $tiket;
        $data['state'] = 'tiket';
        $data['kategoris'] = $kategoris;
    	return view('tiket.incident_tiket',$data);
    }

    public function storeIncidentTiket(Request $request)
    {
        $auth = Auth::user()->id;

    	$tiket = Tiket::find($request->id);
    	$tiket->it_support_username = $request->it_support_username;
        $tiket->it_support = $request->it_support_username;
    	$tiket->assignment_date = $this->getTimeNow();
        $tiket->status_tiket = 'assigned';
        $tiket->kategori_id = $request->kategori_id;
        $tiket->priority = $request->priority;
        $tiket->urgency = $request->urgency;
    	$tiket->save();
        
        $its = $tiket->its->is_itsupport;
        
        if($auth == 421 || $auth == 435 || $its == 21)
        {
            $no_tiket = $request->id;
            $tiket->no_tiket = $no_tiket;
            $tiket->save();
            
        }
        else
        {
            $inc_timezone = $tiket->regional->timezone;
            $inc_serviceid = $tiket->kategori->service_id;
            $inc_category_id = $tiket->kategori->category_id;
            $inc_owner = $tiket->pegawai->name;
            $inc_owneremail = $tiket->pegawai->email;
            $inc_priority = $request->priority;
            $inc_urgency = $request->urgency;
            $inc_subject = $tiket->kategori->name;
            $inc_description = $tiket->permasalahan;
            $inc_support = $request->it_support_username;
            $inc_team = $tiket->regional->team;
            $inc_unitinduk = $tiket->pegawai->personnel_area_name;
            $inc_unitpel = $tiket->pegawai->business_area_name;
            $inc_unitsubpel = $tiket->pegawai->personnel_subarea_name;    

            $url = "http://10.68.35.241:7004/api/CreateTicket";
            $param = array(
                "type"=>"inc",
                "timezone"=> $inc_timezone,
                "Service_id"=> $inc_serviceid,
                "Category_id"=> $inc_category_id,
                "Owner"=> $inc_owner,
                "OwnerEmail"=> $inc_owneremail,
                "Status"=> "New",
                "Priority"=> $inc_priority,
                "Urgency"=> $inc_urgency,
                "Subject"=> $inc_subject,
                "Description"=> $inc_description,
                "Source"=>"Chat",
                "SupportName"=> $inc_support,
                "TeamSupport"=> $inc_team,
                "UnitInduk"=> $inc_unitinduk,
                "UnitPelaksana"=> $inc_unitpel,
                "UnitSubPelaksana"=> $inc_unitsubpel
            );
            $response = $this->performRequestCurl($url,"POST",$param);
            $output = json_decode($response['response']);
            // echo "<pre>";
            // print_r($output);
            // echo "</pre>";
            $no_tiket = $output->IncidentNumber;
            $tiket->no_tiket = $no_tiket;
            $tiket->save();
        }

        if (!empty($no_tiket))
             {$message='success';}
        else
             {$message='error';}

        if($auth != 1)
            {return redirect('dashboard-unit')->with([$message => 'Message']);}
        else
            {return redirect('dashboard')->with([$message => 'Message']);}
    }

    public function srqTiket(Request $request)
    {
    	$auth = Auth::user()->sti_id;
    	$tiket = Tiket::find($request->id);        
        try {
            $recid = $tiket->regional->recid;
            $url = "http://10.68.35.241:7004/api/tiara_getabsen";
            $param = array(
                "team" => $recid
            );
            $response = $this->performRequestCurl($url,"POST",$param);
            
            if($tiket->pegawai->sender == 2){$users = User::where('is_itsupport',2)->get();}
            elseif($tiket->pegawai->sender == 4){$users = User::where('is_itsupport',4)->get();}
            elseif($tiket->pegawai->sender == 21){$users = User::where('is_itsupport',21)->get();}
            else{$users = json_decode($response['response']);}                
            //dd($recid);
            } catch (\Exception $e) {
                $users = User::where('is_itsupport',1)->get();    
            }
 
        $kategoris = Kategori::where('type','REQ')->get();

        $data['users'] = $users;
        $data['tiket'] = $tiket;
        $data['state'] = 'tiket';
        $data['kategoris'] = $kategoris;
    	return view('tiket.srq_tiket',$data);
    }

    public function storeSrqTiket(Request $request)
    {
        $auth = Auth::user()->id;

    	$tiket = Tiket::find($request->id);
    	$tiket->it_support_username = $request->it_support_username;
        $tiket->it_support = $request->it_support_username;
    	$tiket->assignment_date = $this->getTimeNow();
        $tiket->status_tiket = 'assigned';
        $tiket->kategori_id = $request->kategori_id;
        $tiket->priority = $request->priority;
        $tiket->urgency = $request->urgency;
    	$tiket->save();

        $its = $tiket->its->is_itsupport;
        
        if($auth == 421 || $auth == 435 || $its == 21)
        {
            $no_tiket = $request->id;
            $tiket->no_tiket = $no_tiket;
            $tiket->save();
            
        }
        else
        {
            $srq_timezone = $tiket->regional->timezone;
            $srq_serviceid = $tiket->kategori->service_id;
            $srq_category_id = $tiket->kategori->category_id;
            $srq_owner = $tiket->pegawai->name;
            $srq_owneremail = $tiket->pegawai->email;
            $srq_priority = $request->priority;
            $srq_urgency = $request->urgency;
            $srq_subject = $tiket->kategori->name;
            $srq_description = $tiket->permasalahan;
            $srq_support = $request->it_support_username;
            $srq_team = $tiket->regional->team;
            $srq_unitinduk = $tiket->pegawai->personnel_area_name;
            $srq_unitpel = $tiket->pegawai->business_area_name;
            $srq_subunitpel = $tiket->pegawai->personnel_subarea_name;

            $url = "http://10.68.35.241:7004/api/CreateTicket";
            $param = array(
                "type"=>"request",
                "timezone"=> $srq_timezone,
                "Service_id"=> $srq_serviceid,
                "Category_id"=> $srq_category_id,
                "Owner"=> $srq_owner,
                "OwnerEmail"=> $srq_owneremail,
                "Status"=> "New",
                "Priority"=> $srq_priority,
                "Urgency"=> $srq_urgency,
                "Subject"=> $srq_subject,
                "Description"=> $srq_description,
                "Source"=>"Chat",
                "SupportName"=> $srq_support,
                "TeamSupport"=> $srq_team,
                "UnitInduk"=> $srq_unitinduk,
                "UnitPelaksana"=> $srq_unitpel,
                "UnitSubPelaksana"=> $srq_subunitpel
            );
            $response = $this->performRequestCurl($url,"POST",$param);
            $output = json_decode($response['response']);
            // echo "<pre>";
            // print_r($output);
            // echo "</pre>";
            $no_tiket = $output->ServiceReqNumber;
            $tiket->no_tiket = $no_tiket;
            $tiket->save();
        }

        if (!empty($no_tiket))
             {$message='success';}
        else
             {$message='error';}

        if($auth != 1)
            {return redirect('dashboard-unit')->with([$message => 'Message']);}
        else
            {return redirect('dashboard')->with([$message => 'Message']);}
    }

    public function assignTiket(Request $request)
    {
    	$tiket = Tiket::find($request->id);

        $kategoris = Kategori::all();
        try {
            $recid = $tiket->regional->recid;
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
        $auth = Auth::user()->id;
    	$tiket = Tiket::find($request->id);
    	$tiket->it_support_username = $request->it_support_username;
        $tiket->it_support = $request->it_support_username;
    	$tiket->assignment_date = $this->getTimeNow();
        $tiket->status_tiket = 'assigned';
        $tiket->no_tiket = $request->no_tiket;
        $tiket->kategori_id = $request->kategori_id;
    	$tiket->save();
        if($auth != 1)
            {return redirect('dashboard-unit');}
        else
            {return redirect('dashboard');}
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
        //echo $tiket->its->name;
        return view('tiket.resolve',$data);
    }

    public function storeResolve(Request $request)
    {
        $auth = Auth::user()->id;
        $tiket = Tiket::find($request->id);
        $tiket->no_tiket = $request->no_tiket;
        $tiket->resolution = $request->resolution;
        $tiket->status_tiket = 'resolved';
        $tiket->save();
        if($auth != 1)
            {return redirect('dashboard-unit');}
        else
            {return redirect('dashboard');}
    }

    public function today()
    {
        $tikets = Tiket::whereDate('start_date',Carbon::now()->toDateString())->get();
        $data['tikets'] = $tikets;
        $data['state'] = 'tiket';
        return view('tiket.list',$data);
    }

    public function todayunit()
    {
        $auth = Auth::user()->sti_id;
        $tikets = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('sti_id',$auth)->get();
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

    public function todayOpenunit()
    {
        $auth = Auth::user()->sti_id;
        $tikets = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('status_tiket','open')->where('sti_id',$auth)->get();
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

    public function todayAssignedunit()
    {
        $auth = Auth::user()->sti_id;
        $tikets = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('status_tiket','assigned')->where('sti_id',$auth)->get();
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

    public function todayResolvedunit()
    {
        $auth = Auth::user()->sti_id;
        $tikets = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('status_tiket','resolved')->where('sti_id',$auth)->get();
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

    public function tiketByKategoriunit(Request $request)
    {
        $auth = Auth::user()->sti_id;
        $tikets = Tiket::where('kategori_id',$request->kategori_id)->where('sti_id',$auth)->get();
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

    public function export()
    {
        $auth = Auth::user()->sti_id;
        
        return Excel::download(new Export($auth), 'tiket-TIARA.xlsx');
    }

    public function auth()
    {
        $user = Auth::user()->sti_id;
        echo $user;
    }

    public function testApi(Request $request)
    {
    	$tiket = Tiket::find($request->id);        
        
            
            $url = "https://ensomsit.iconpln.co.id/api/CreateTicket";
            $param = array(
                "type"=>"request",
                "timezone"=>"wib",
                "Service_id"=> "D29A5302A3A246D2A75B85FA58AD2130",
                "Category_id"=> "72A09DD5B45D41579F726D7D2A6C70FC",
                "Owner"=> "Darma",
                "OwnerEmail"=> "esraldi.2@gmail.com",
                "Status"=> "New",
                "Priority"=> "1",
                "Urgency"=> "High",
                "Subject"=> "Test SR API 20210507 No 1 with tiara",
                "Description"=> "Test API from CI PHP",
                "Source"=>"Chat",
                "SupportName"=> "abdur.rachim",
                "TeamSupport"=> "STI REGIONAL JAKARTA 2",
                "UnitInduk"=> "PUSDIKLAT",
                "UnitPelaksana"=> "UDIKLAT BOGOR"
            );
            $response = $this->performRequestCurl($url,"POST",$param);
            $users = json_decode($response['response']);
            echo "<pre>";
            print_r($users);
            echo "</pre>";
    }
}
