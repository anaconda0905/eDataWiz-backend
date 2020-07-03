<?php

namespace App\Http\Middleware;

use Closure;

class IpMiddleware
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
        // $position = \Location::get($request->ip());
        // if($position->countryCode == "CN"){
        //     return \redirect('/');
        // }
        return $next($request);
    }
}
