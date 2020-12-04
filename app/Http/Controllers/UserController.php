<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
	public function index()
	{   
        $data['state'] = "user";
		$data['users'] = User::all();
		return view('users.list',$data);
	}

    public function create(Request $request)
    {
        if(!empty($request->username_exsist))
        {
            $data['username_exsist'] = true;
        }
        if(!empty($request->email_exsist))
        {
            $data['email_exsist'] = true;
        }
        $data['roles'] = Role::all();
    	return view('users.create',$data);
    }

    public function store(Request $request)
    {
        $cek_user = User::where('username',$request->username)->first();
        if(!empty($cek_user))
        {
            return redirect('users/create?username_exsist=true');
        }
        $cek_email = User::where('email',$request->email)->first();
        if(!empty($cek_email))
        {
            return redirect('users/create?email_exsist=true');
        }
    	$user = new User();
    	$user->name = $request->name;
    	$user->username = $request->username;
    	$user->email = $request->email;
    	$user->password = \Hash::make($request->password);
    	$user->nip = $request->nip;
        $user->nohp = $request->nohp;
    	$user->save();
        $user->syncRoles([$request->role]);

    	return redirect('/users');
    }

    public function edit(Request $request)
    {
    	$data['user'] = User::find($request->id);
        $data['roles'] = Role::all();
    	return view('users.edit',$data);
    }

    public function update(Request $request)
    {
    	$user = User::find($request->id);
    	$user->name = $request->name;
    	$user->password = \Hash::make($request->password);
    	$user->nip = $request->nip;
    	$user->save();

        $user->syncRoles([$request->role]);

    	return redirect('/users');
    }
}