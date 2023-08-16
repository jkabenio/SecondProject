<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function student_index()
    // {
    //     return view('/studentdashboard');
    // }
    // public function instructor_index()
    // {
    //     return view('/instructordashboard');
    // }
    
    
}
