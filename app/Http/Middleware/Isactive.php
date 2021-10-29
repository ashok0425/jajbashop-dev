<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class Isactive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()&&Auth::user()->isactive!=1){
            Auth::logout();
            session()->flush();
            $notification=array(
                'alert-type'=>'error',
                'messege'=>'You hadbeen blocked.Please contact Baratodeal.com',
               
             );
             return redirect()->route('/')->with($notification);
        }
        return $next($request);
    }
}
