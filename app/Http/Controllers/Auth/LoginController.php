<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * set login response
     * @param  Request $request [description]
     * @return [type]           [description]
     */


    public function redirectTo(){
        // User role
        $role = Auth::user()->role;
        if(in_array('admin', explode(',', Auth::user()->role))){
            return '/admin/dashboard';
        }elseif(in_array('merchant', explode(',', Auth::user()->role))){
            return '/merchant/dashboard';
        }else{
            return '/home';
        }
    }
}
