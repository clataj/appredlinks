<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Administrator
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
        if(Auth::user()->role_id == 1) {
            return $next($request);
        }
        if(Auth::user()->role_id == 2) {
            return redirect()->route('users.enterprises.index', Auth::user()->id);
        }
        return redirect('/dashboard');
    }
}
