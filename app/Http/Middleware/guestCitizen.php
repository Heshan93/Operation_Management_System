<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class guestCitizen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
/* 
        if(!session()->exists('is_clogin'))
        {
            return redirect('citizen-login');
        }
        return $next($request); */
    }
}
