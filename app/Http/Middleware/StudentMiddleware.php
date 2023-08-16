<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Request;

class StudentMiddleware
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
        // if(Auth::check())
        // {
        //     if(Auth::user()->role_as == '0') //1=Admin & 0=User
        //     {
        //         return $next($request);
        //     }
        //     elseif(Auth::user()->role_as == '1'){
        //         return redirect('/admindashboard')->with('error', 'Access Denied! As you are not an Student');
        //     }

        //     else
        //     {
        //        return redirect('/signeedashboard')->with('error', 'Access Denied! As you are not an Student');
        //     }

            
        // }
        // else
        // {
        //     return redirect('/')->with('error', 'Please Login First');
        // }        
    }
}
