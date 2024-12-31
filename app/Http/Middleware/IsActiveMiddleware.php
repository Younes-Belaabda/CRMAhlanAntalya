<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class IsActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next)
    {
        if (
            auth('api')->check() &&
            !auth('api')->user()->hasVerifiedEmail() &&
            !preg_match('/logout/i', url()->current())
        ) {
            return JsonResponse::create(['status' => false, 'message' => __('lang.inactive_account') , 'Error' => 'inactive_account']);
        }
        return $next($request);
    }
}
