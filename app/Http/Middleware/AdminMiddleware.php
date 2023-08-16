<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    //  */
    public function handle(Request $request, Closure $next)
    {
        // if(Auth::check())
        // {
        //     if(Auth::user()->role_as == '1') //1=Admin & 0=User
        //     {
        //         return $next($request);
        //     }    
        //     elseif(Auth::user()->role_as == '2'){
        //         return redirect('/signeedashboard')->with('error', 'Access Denied! As you are not an Admin');
        //     } 
        //     else
        //     {
        //        return redirect('/studentdashboard')->with('error', 'Access Denied! As you are not an Admin');
        //     }

            
        // }
        // else
        // {
        //     return redirect('/')->with('error', 'Please Login First');
        // }        
    }
}
