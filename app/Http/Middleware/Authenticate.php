<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            if($request->routeIs('admin.*')){
                return route('admin.admin_login');
            }
            if($request->routeIs('signee.*')){
                return route('signee.signee_login');
            }
            if($request->routeIs('web.*')){
                return route('student.student_login');
            }
            // return route('student.student_login');
            // return route('login');
        }
    } 
}
