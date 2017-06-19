<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
      return $next($request)
    ->header('Access-Control-Allow-Origin', '*')
    ->header('Access-Control-Allow-Credentials','true')
    ->header('Access-Control-Allow','GET,POST,PUT,PATCH,DELELE,OPTIONS')
    ->header('Access-Control-Allow-Headers','Content-Type, Authorization,X-XSRF-TOKEN,X-CSRF-TOKEN','CSRF-TOKEN','XSRF-TOKEN');
    }
}
