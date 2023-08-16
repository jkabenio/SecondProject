<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    // protected function authenticated(Request $request, $users)
    // {
    //     if(Auth::user()->role_as=='0'){
    //         return redirect ('/studentdashboard')->with('success', 'Logged In as student Successful');
    //     }
    //     else  if(Auth::user()->role_as =='1')
    //         {
    //             return redirect ('/admindashboard')->with('success', 'Logged In as admin Successful');
    //         }
    //         else  if(Auth::user()->role_as =='2')
    //         {
    //             return redirect ('/instructordashboard')->with('success', 'Logged In as instructor Successful');
    //         }
    //     else
    //     {
    //         return redirect('/');
    //     }
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // protected $school_id;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // $this->school_id = $this->findSchoolId();
    }

    

    // public function findSchoolId()
    // {
    //     $login = request()->input('login');
 
    //     $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'school_id';
 
    //     request()->merge([$fieldType => $login]);
 
    //     return $fieldType;
    // }
 
    /**
     * Get school_id property.
     *
     * @return string
     */
    // public function school_id()
    // {
    //     return $this->school_id;
    // }

    // public function login(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'required',
    //         'password' => 'required|min:6'
    //     ]);

    //     $email = $request->get('email');
    //     $password = $request->get('password');
    //     $remember_me = $request->remember;

    //     $login_type = filter_var($email, FILTER_VALIDATE_EMAIL) ? 'email' : 'school_id';

    //     if (Auth::attempt([$login_type => $email, 'password' => $password], $remember_me)) {
    //         //Auth successful here
    //         if(Auth::user()->role_as=='0'){
    //             return redirect ('/studentdashboard')->with('success', 'Logged In as student Successful');
    //         }
    //         else  if(Auth::user()->role_as =='1')
    //             {
    //                 return redirect ('/admindashboard')->with('success', 'Logged In as admin Successful');
    //             }
    //             else  if(Auth::user()->role_as =='2')
    //             {
    //                 return redirect ('/signeedashboard')->with('success', 'Logged In as signee Successful');
    //             }
    //         else
    //         {
    //             return redirect('/');
    //         }
    //     }

    //     return redirect()->back()
    //         ->withInput()
    //         ->withErrors([
    //             'login_error' => 'These credentials do not match our records.',
    //         ]);
    // }
}
