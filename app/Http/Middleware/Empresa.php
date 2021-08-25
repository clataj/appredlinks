<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Empresa
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
        if(Auth::user()->role_id == 2) {
            return $next($request);
        }
        if(Auth::user()->role_id == 1) {
            return redirect('/dashboard');
        }
        return redirect('/enterprises');
    }
}
