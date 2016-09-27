<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckProveedor
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

        if (Auth::guard('web_proveedor')->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('log');
            }
        }

        return $next($request);
    }
}
