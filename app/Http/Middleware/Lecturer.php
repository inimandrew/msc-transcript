<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class Lecturer
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
        if (Auth::guard('my_users')->user()->role != '6'){

            return redirect()->route('home');

             }
        return $next($request);
    }
}
