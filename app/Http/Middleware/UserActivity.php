<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Cache;
use App\Models\User;
use App\Models\Signee;
use App\Models\Admin;
class UserActivity
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
        if(Auth::check()){
            $expiresAt = now()->addSeconds(30); /*already given time here we */
            Cache::put('user-is-online-' . Auth::guard('web')->id(), true, $expiresAt);
            Cache::put('admin-is-online-' . Auth::guard('admin')->id(), true, $expiresAt);
            Cache::put('signee-is-online-' . Auth::guard('signee')->id(), true, $expiresAt);
           
            // user last seen
            User::where('id', Auth::guard('web')->id())->update(['last_seen' =>(new \DateTime())->format("Y-m-d H:i:s")]);
            Admin::where('id', Auth::guard('admin')->id())->update(['last_seen' =>(new \DateTime())->format("Y-m-d H:i:s")]);
            Signee::where('id', Auth::guard('signee')->id())->update(['last_seen' =>(new \DateTime())->format("Y-m-d H:i:s")]);
            
        }
        return $next($request);
    }
}
