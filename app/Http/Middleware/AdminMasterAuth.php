<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMasterAuth
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
        if ((Auth::check()) && ((Auth::user()->nivel_acesso == "admin") || (Auth::user()->nivel_acesso == "master"))) {
            return $next($request);
        }
        return redirect()->route('home');
    }
}