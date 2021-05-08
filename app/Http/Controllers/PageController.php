<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiket;
use Carbon\Carbon;
use Auth;
use DB;
use App\User;
use App\HistoryPassword;
use App\Chat;

class PageController extends Controller
{
    public function index()
    {
        $auth = Auth::user()->id;
        if ($auth !== 1)
        {
            return redirect('dashboard-unit');
        }
    	$n_tiket = Tiket::whereDate('start_date',Carbon::now()->toDateString())->count();
    	$n_open = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('status_tiket','open')->count();
    	$n_assigned = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('status_tiket','assigned')->count();
    	$n_resolved = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('status_tiket','resolved')->count();

    	$tiket_open = Tiket::where('status_tiket','open')->get();
		$tiket_createitsm = Tiket::where('status_tiket','createitsm')->get();
    	$tiket_assigned = Tiket::where('status_tiket','assigned')->get();
        $tiket_pending = Tiket::where('status_tiket','pending')->get();
        
    	// assign to view
    	$data['n_open'] = $n_open;
    	$data['n_assigned'] = $n_assigned;
    	$data['n_tiket'] = $n_tiket;
    	$data['n_resolved'] = $n_resolved;
        $data['state']="dashboard";
        $data['tiket_assigned'] = $tiket_assigned;
        $data['tiket_open'] = $tiket_open;
		$data['tiket_createitsm'] = $tiket_createitsm;
        $data['tiket_pending'] = $tiket_pending;

        //$this->cekForClose();
        
        return view('dashboard',$data);
    }

    public function getTimeNow()
    {
        return Carbon::now()->toDateTimeString();
    }

    public function cekForClose()
    {
        $chat_open = DB::select("select id, TIME_TO_SEC(timediff(NOW(),start_conversation))/60 as selisih from chat where status = 'open' and TIME_TO_SEC(timediff(NOW(),start_conversation))/60 > 10");
        if(!empty($chat_open))
        {
            foreach ($chat_open as $row) 
            {
                $chat = Chat::find($row->id);
                $chat->status = "close-conversation";
                $chat->end_conversation = $this->getTimeNow();
                $chat->save();
            }
        }

    }

    public function indexUnit()
    {
        $auth = Auth::user()->sti_id;
        $n_tiket = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('sti_id',$auth)->count();
        $n_open = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('status_tiket','open')->where('sti_id',$auth)->count();
        $n_assigned = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('status_tiket','assigned')->where('sti_id',$auth)->count();
        $n_resolved = Tiket::whereDate('start_date',Carbon::now()->toDateString())->where('status_tiket','resolved')->where('sti_id',$auth)->count();

        $tiket_open = Tiket::where('status_tiket','open')->where('sti_id',$auth)->get();
		$tiket_createitsm = Tiket::where('status_tiket','createitsm')->where('sti_id',$auth)->get();
        $tiket_assigned = Tiket::where('status_tiket','assigned')->where('sti_id',$auth)->get();
        $tiket_pending = Tiket::where('status_tiket','pending')->where('sti_id',$auth)->get();
        
        // assign to view
        $data['n_open'] = $n_open;
        $data['n_assigned'] = $n_assigned;
        $data['n_tiket'] = $n_tiket;
        $data['n_resolved'] = $n_resolved;
        $data['state']="dashboard-unit";
        $data['tiket_assigned'] = $tiket_assigned;
        $data['tiket_open'] = $tiket_open;
		$data['tiket_createitsm'] = $tiket_createitsm;
        $data['tiket_pending'] = $tiket_pending;
        
        return view('dashboard',$data);
    }

    public function statistic(Request $request)
    {
        $n_tiket = Tiket::count();
        $n_open = Tiket::where('status_tiket','open')->count();
        $n_assigned = Tiket::where('status_tiket','assigned')->count();
        $n_resolved = Tiket::where('status_tiket','resolved')->count();

        $tiket_open = Tiket::where('status_tiket','open')->get();
        $tiket_assigned = Tiket::where('status_tiket','assigned')->get();

        $n_kategori = DB::select("select k.id,k.name,count(t.id) as jumlah from kategori k,tiket t where k.id = t.kategori_id and t.is_autoclose is null and k.type = 'INC' group by k.id,k.name");

        $n_autoclose = DB::select("select t.permasalahan, count(t.id) as jumlah from tiket t where t.is_autoclose = 1 group by t.permasalahan");

        $n_support = DB::select("select u.id, u.name, count(t.id) as jumlah from tiket t, users u where t.it_support = u.username group by u.id, u.name order by jumlah desc limit 3");

        $n_user = DB::select("select p.nip, p.name, count(t.id) as jumlah from pegawai p, tiket t where p.nip = t.nip group by p.nip, p.name order by jumlah desc limit 3");

        $n_service_request = DB::select("select k.id,k.name,count(t.id) as jumlah from kategori k,tiket t where k.id = t.kategori_id and t.is_autoclose is null and k.type = 'REQ' group by k.id,k.name");


        $n_unit = DB::select("SELECT p.personnel_subarea_name, count(t.id) as jumlah FROM tiket t,pegawai p where t.nip = p.nip group by p.personnel_subarea_name order by jumlah desc");


        $data['n_open'] = $n_open;
        $data['n_assigned'] = $n_assigned;
        $data['n_tiket'] = $n_tiket;
        $data['n_resolved'] = $n_resolved;
        $data['state']="statistic";
        $data['n_kategori'] = $n_kategori;
        $data['n_autoclose'] = $n_autoclose;
        $data['n_support'] = $n_support;
        $data['n_user'] = $n_user;
        $data['n_service_request'] = $n_service_request;

        $data['n_unit'] = $n_unit;

        return view('statistic',$data);
    }

    public function statisticunit(Request $request)
    {
        $auth = Auth::user()->sti_id;
        $n_tiket = Tiket::where('sti_id',$auth)->count();
        $n_open = Tiket::where('status_tiket','open')->where('sti_id',$auth)->count();
        $n_assigned = Tiket::where('status_tiket','assigned')->where('sti_id',$auth)->count();
        $n_resolved = Tiket::where('status_tiket','resolved')->where('sti_id',$auth)->count();

        $tiket_open = Tiket::where('status_tiket','open')->where('sti_id',$auth)->get();
        $tiket_assigned = Tiket::where('status_tiket','assigned')->where('sti_id',$auth)->get();

        $n_kategori = DB::select("select k.id,k.name,count(t.id) as jumlah from kategori k,tiket t where k.id = t.kategori_id and t.is_autoclose is null and k.type = 'INC' and t.sti_id = ".$auth." group by k.id,k.name");

        $n_autoclose = DB::select("select t.permasalahan, count(t.id) as jumlah from tiket t where t.is_autoclose = 1 and t.sti_id = ".$auth." group by t.permasalahan");

        $n_support = DB::select("select u.id, u.name, count(t.id) as jumlah from tiket t, users u where t.it_support = u.username and t.sti_id = ".$auth." group by u.id, u.name order by jumlah desc limit 3");

        $n_user = DB::select("select p.nip, p.name, count(t.id) as jumlah from pegawai p, tiket t where p.nip = t.nip and t.sti_id = ".$auth." group by p.nip, p.name order by jumlah desc limit 3");

        $n_service_request = DB::select("select k.id,k.name,count(t.id) as jumlah from kategori k,tiket t where k.id = t.kategori_id and t.is_autoclose is null and k.type = 'REQ' and t.sti_id = ".$auth." group by k.id,k.name");


        $n_unit = DB::select("SELECT p.personnel_subarea_name, count(t.id) as jumlah FROM tiket t,pegawai p where t.nip = p.nip and t.sti_id = ".$auth." group by p.personnel_subarea_name order by jumlah desc");


        $data['n_open'] = $n_open;
        $data['n_assigned'] = $n_assigned;
        $data['n_tiket'] = $n_tiket;
        $data['n_resolved'] = $n_resolved;
        $data['state']="statistic-unit";
        $data['n_kategori'] = $n_kategori;
        $data['n_autoclose'] = $n_autoclose;
        $data['n_support'] = $n_support;
        $data['n_user'] = $n_user;
        $data['n_service_request'] = $n_service_request;

        $data['n_unit'] = $n_unit;

        return view('statistic',$data);
    }

    public function analytics(Request $request)
    {
        $n_cost = DB::select("select is_autoclose, is_sppd, sum(biaya) as jumlah, count(t.id) as jumlah_tiket from tiket t, pegawai p, mapping m where t.nip = p.nip and p.personnel_subarea_name = m.unit group by is_autoclose, is_sppd");
        $n_user_kategori = DB::select("select count(t.id) as jumlah, nip, t.kategori_id, k.name from tiket t, kategori k where k.id = t.kategori_id group by nip, t.kategori_id, k.name order by jumlah DESC limit 5");

        $data['state']="analytics";
        $data['n_cost'] = $n_cost;
        $data['n_user_kategori'] = $n_user_kategori;
        //$n_response_time = DB::select("SELECT id,sender, TIME_TO_SEC(timediff(end_conversation,start_conversation))/60 as response_time, start_conversation, end_conversation FROM tiket order by response_time desc");

        $n_user_kategori = DB::select("select count(t.id) as jumlah, nip, t.kategori_id, k.name from tiket t, kategori k where k.id = t.kategori_id group by nip, t.kategori_id, k.name order by jumlah DESC limit 5");

        $data['state']="analytics";

        // $data['n_response_time'] = $n_response_time;

        $data['n_user_kategori'] = $n_user_kategori;

        return view('analytics',$data);
    }

    public function analyticsunit(Request $request)
    {
        $auth = Auth::user()->sti_id;
        $n_cost = DB::select("select is_autoclose, is_sppd, sum(biaya) as jumlah, count(t.id) as jumlah_tiket from tiket t, pegawai p, mapping m where t.nip = p.nip and p.personnel_subarea_name = m.unit and t.sti_id = ".$auth." group by is_autoclose, is_sppd");
        $n_user_kategori = DB::select("select count(t.id) as jumlah, nip, t.kategori_id, k.name from tiket t, kategori k where k.id = t.kategori_id and t.sti_id = ".$auth." group by nip, t.kategori_id, k.name order by jumlah DESC limit 5");
        $data['n_cost'] = $n_cost;
        $data['n_user_kategori'] = $n_user_kategori;
        //$n_response_time = DB::select("SELECT id,sender, TIME_TO_SEC(timediff(end_conversation,start_conversation))/60 as response_time, start_conversation, end_conversation FROM tiket order by response_time desc");

        $n_user_kategori = DB::select("select count(t.id) as jumlah, nip, t.kategori_id, k.name from tiket t, kategori k where k.id = t.kategori_id and t.sti_id = ".$auth." group by nip, t.kategori_id, k.name order by jumlah DESC limit 5");

        $data['state']="analytics-unit";

        // $data['n_response_time'] = $n_response_time;

        $data['n_user_kategori'] = $n_user_kategori;

        return view('analytics',$data);
    }


    public function resetPassword(Request $request)
    {
    	$data['username'] = $request->username;
    	return view('auth.reset_password',$data);
    }

    public function storeResetPassword(Request $request)
    {
    	$username = $request->username;
    	$old_password = $request->old_password;
    	$new_password = $request->new_password;
    	$confirm_new_password = $request->confirm_new_password;


    	$user = User::where('username',$request->username)->first();
    	$cek = \Hash::check($old_password,$user->password);
    	
    	if($cek == false)
    	{
    		// jika old password salah
    		\Session::flash('error_message','Password lama anda salah');
    		return redirect('reset-password?username='.$username);
    	}
    	
    	if($new_password != $confirm_new_password)
    	{
    		// jika password tidak sama
    		\Session::flash('error_message','Password tidak sama');
    		return redirect('reset-password?username='.$username);	
    	}

		if(strlen($new_password) < 8)
    	{
    		// jika panjang password kurang dari 8
    		\Session::flash('error_message','Password harus lebih dari 8 karakter');
    		return redirect('reset-password?username='.$username);
    	}

    	if( !preg_match("#[0-9]+#", $new_password) ) {
			$error_message = "Password minimal harus terdiri dari 1 angka";
			\Session::flash('error_message',$error_message);
			return redirect('reset-password?username='.$username);
		}

		if( !preg_match("#[a-z]+#", $new_password) ) {
			
			$error_message = "Password minimal harus terdiri dari 1 huruf kecil";
			\Session::flash('error_message',$error_message);
			return redirect('reset-password?username='.$username);
		}

		if( !preg_match("#[A-Z]+#", $new_password) ) {
			$error_message = "Password minimal harus terdiri dari 1 huruf besar";
			\Session::flash('error_message',$error_message);
			return redirect('reset-password?username='.$username);
		}

		if( !preg_match("#\W+#", $new_password) ) {
			$error_message = "Password minimal harus terdiri dari 1 symbol";
			\Session::flash('error_message',$error_message);
			return redirect('reset-password?username='.$username);
		}

    	$history = HistoryPassword::where('user_id',$user->id)->orderBy('created_at','desc')->take(15)->get();
    	$n_password = count($history);

    	if($n_password > 0)
    	{
    		foreach ($history as $row) 
			{
				$cek_history = \Hash::check($new_password,$row->password);
				if($cek_history == true)
				{
					// jika ada yang sama
					$error_message = "Password harus berbeda dengan 15 password sebelumnya";
					\Session::flash('error_message',$error_message);
					return redirect('reset-password?username='.$username);
				}
			}
    	}

    	$user->password = \Hash::make($new_password);
    	$user->last_reset = date("Y-m-d");
    	$user->save();

    	$historyPassword = new HistoryPassword();
    	$historyPassword->password = $user->password;
    	$historyPassword->user_id = $user->id;
    	$historyPassword->save();


    	$error_message = "Ubah password berhasil";
		\Session::flash('error_message',$error_message);
    	return redirect('login');
    }
}
