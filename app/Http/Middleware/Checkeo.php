<?php

namespace App\Http\Middleware;

use Closure;

class Checkeo
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
       //Url a la que se le dará acceso en las peticiones
       ->header('Access-Control-Allow-Origin', '*')
       ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

        
    }
}
