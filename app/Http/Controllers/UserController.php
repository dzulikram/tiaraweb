<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use App\HistoryPassword;

class UserController extends Controller
{
	public function index()
	{   
        $data['state'] = "user";
		$data['users'] = User::all();
		return view('user.list',$data);
	}

    public function create()
    {
        $data['state'] = "user";
        return view('user.create',$data);
    }

    public function store(Request $request)
    {
        // $cek_user = User::where('username',$request->username)->first();
        // if(!empty($cek_user))
        // {
        //     return redirect('users/create?username_exsist=true');
        // }
        
    	$user = new User();
    	$user->name = $request->name;
        $user->email = $request->email; 
    	$user->password = \Hash::make($request->password);
        $user->username = $request->username;
        $user->no_wa = $request->no_wa;
    	$user->save();

    	return redirect('/user');
    }

    public function edit(Request $request)
    {
        $data['state'] = "user";
    	$data['user'] = User::find($request->id);
        $data['roles'] = Role::all();
    	//dd($data['roles']);
        return view('user.edit',$data);
    }

    public function update(Request $request)
    {
    	$user = User::find($request->id);
    	$user->name = $request->name;
        $user->email = $request->email; 
        $user->username = $request->username;
        $user->no_wa = $request->no_wa;
    	$user->save();
        $user->syncRoles([$request->role]);

    	return redirect('/user');
    }

    public function delete(Request $request)
    {
        $data['state'] = "user";
        User::destroy($request->id);
        return redirect('/user');
    }

    public function password(Request $request)
    {
        $data['state'] = "user";
        $user = User::find($request->id);
        $data['user'] = User::find($request->id);

        return view('user.password',$data);
    }

    public function resetPassword(Request $request)
    {
        $user = User::find($request->id);
        $user->password = \Hash::make($request->password);
        $new_password = $request->new_password;
        $confirm_new_password = $request->confirm_new_password;   

        if(strlen($new_password) < 8)
        {
            // jika panjang password kurang dari 8
            \Session::flash('error_message','Password harus lebih dari 8 karakter');
            return redirect('user/password/'.$request->id);
        }

        if( !preg_match("#[0-9]+#", $new_password) ) {
            $error_message = "Password minimal harus terdiri dari 1 angka";
            \Session::flash('error_message',$error_message);
            return redirect('user/password/'.$request->id);
        }

        if( !preg_match("#[a-z]+#", $new_password) ) {
            
            $error_message = "Password minimal harus terdiri dari 1 huruf kecil";
            \Session::flash('error_message',$error_message);
            return redirect('user/password/'.$request->id);
        }

        if( !preg_match("#[A-Z]+#", $new_password) ) {
            $error_message = "Password minimal harus terdiri dari 1 huruf besar";
            \Session::flash('error_message',$error_message);
            return redirect('user/password/'.$request->id);
        }

        if( !preg_match("#\W+#", $new_password) ) {
            $error_message = "Password minimal harus terdiri dari 1 symbol";
            \Session::flash('error_message',$error_message);
            return redirect('user/password/'.$request->id);
        }

        $history = HistoryPassword::where('user_id',$request->id)->orderBy('created_at','desc')->take(15)->get();
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
                    return redirect('user/password/');
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

        return redirect('/user');
    }
}