<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AffiliateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()){
            if(in_array('affiliator', explode(',', Auth::user()->role))){
                return $next($request);
            }
        }
        return redirect('/');
    }
}
