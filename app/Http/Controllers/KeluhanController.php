<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeluhanController extends Controller
{
    public function index()
    {
        $data['state']="keluhan";
        $data['keluhan'] = User::all();
        return view('keluhan',$data);

    }

    public function create()
    {
        $data['state'] = "keluhan";
        return view('keluhan.create',$data);
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
        //$data['roles'] = Role::all();
    	return view('user.edit',$data);
    }

    public function update(Request $request)
    {
    	$user = User::find($request->id);
    	$user->name = $request->name;
        $user->email = $request->email; 
    	$user->password = \Hash::make($request->password);
        $user->username = $request->username;
        $user->no_wa = $request->no_wa;
    	$user->save();

        //$user->syncRoles([$request->role]);

    	return redirect('/user');
    }

    public function delete(Request $request)
    {
        $data['state'] = "user";
        User::destroy($request->id);
        return redirect('/user');
    }
}
