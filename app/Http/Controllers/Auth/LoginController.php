<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/dashboard";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        // check is expired
        $user = User::where('username',$request->username)->first();
        if(empty($user))
        {
            $error_message = "Username tidak ditemukan";
            \Session::flash('error_message',$error_message);
            return redirect('login');  
        }

        if($user->wrong >= 5 || $user->is_aktif == 1)
        {
            return redirect('locked');
        }

        if(empty($user->last_reset))
        {
            return redirect('reset-password?username='.$request->username);
        }

        $diff = (abs(strtotime(date('Y-m-d')) - strtotime($user->last_reset)))/(60*60*24);
        if($diff >= 30)
        {
            return redirect('reset-password?username='.$request->username);   
        }
        //dd($request->username);

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $user->wrong = $user->wrong + 1;
        if($user->wrong == 5)
        {
            $user->is_aktif = 1;
        }
        $user->save();
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|captcha'
        ]);
    }

    public function checkIsLogin()
    {
        return redirect('dashboard');
    }

}
