<?php

namespace App\Http\Middleware;

use Closure;

class PicAdminOnly
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
        if(session('role')=='pic' || session('role')=='admin')
            return $next($request);
        return redirect()->route('home');
    }
}
