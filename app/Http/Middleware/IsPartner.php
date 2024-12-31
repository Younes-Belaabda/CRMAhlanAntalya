<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsPartner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->partner_id != null &&  Auth::user()->role_id == 2 &&  Auth::user()->status == 1) {
            return $next($request);
        }

        return Controller::sendError( __('lang.no_have_access_yet') );
        //return $next($request);
    }
}
