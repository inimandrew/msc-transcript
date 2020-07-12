<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use App\Model\CurrentSession;
class Admin
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
        if (Auth::guard('my_users')->user()->role != '1'){

            return redirect()->back();

             }
        return $next($request);
    }


}
