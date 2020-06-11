<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            if(in_array('admin', explode(',', Auth::guard()->user()->role))){
                return redirect()->route('admin.dashboard');
            }elseif(in_array('merchant', explode(',', Auth::guard()->user()->role))) {
                return redirect()->route('merchant.dashboard');
            }elseif(in_array('user', explode(',', Auth::guard()->user()->role))) {
                return redirect('employee/dashboard');
            }elseif(in_array('affiliater', explode(',', Auth::guard()->user()->role))) {
                return redirect('affiliate/dashboard');
            }
            return redirect('/');
        }

        return $next($request);
    }
}
