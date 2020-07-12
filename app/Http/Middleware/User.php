<?php

namespace App\Http\Middleware;
use Auth;
use App\Model\CurrentSession;
use Closure;

class User
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
        if (empty(Auth::guard('my_users')->user())){
            return redirect()->route('home')->withErrors(['password_error'=>'You are not Authenticated, Please Login.']);
             }else{

                $current = CurrentSession::where('department_id',Auth::guard('my_users')->user()->department_id)->where('running','1')->first();
                $current_count = CurrentSession::where('department_id',Auth::guard('my_users')->user()->department_id)->where('running','1')->count();
                if($current_count == '0'){
                    $current_session = false;
                }else{
                    $current_session = true;
                }
                view()->share(['session_set'=>$current_session,'session_data' => $current]);
                }
        return $next($request);
    }
}
