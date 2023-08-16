<?php
 
namespace App\Http\Controllers\Student;
use App\Models\User;
use App\Models\Admin;
use App\Models\Signee;
use App\Models\Course;
use Illuminate\Support\facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RateLimiter;
use Cache;
class StudentController extends Controller
{
    
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentDateTime = Carbon::now();
        $newDateTime = Carbon::now()->addYear();


        $student_user = User::select("*")
        ->whereNotNull('last_seen')
        ->orderBy('last_seen','DESC')
        ->paginate(0);
    $admin_user = Admin::select("*")
        ->whereNotNull('last_seen')
        ->orderBy('last_seen','DESC')
        ->paginate(0);
    $signee_user = Signee::select("*")
        ->whereNotNull('last_seen')
        ->orderBy('last_seen','DESC')
        ->paginate(0);
        $users = User::select("*")
        ->whereNotNull('last_seen')
        ->orderBy('last_seen','DESC')
        ->paginate(0);
        $student = User::all();
        $course = Course::all();
        return view('student.studentdashboard', compact('users','student','course','newDateTime','student_user','admin_user','signee_user'));
        // return view('pages.student.studentdashboard');
    } 
    public function check(Request $request)
    { 
        $key = "login.".$request->ip();
        $retries = RateLimiter::retriesLeft($key, 3);
        $request->validate([
            // 'email' => 'required|exists:users,email',
            'password' => 'required|min:8', 
            'school_id' => 'required|string|max:255|exists:users,school_id'
        ],[
        'school_id.exists'=>'This Account do not exist'
         ]);
        $remember_me = $request->has('remember_token') ? true : false; 
        $creds = $request->only('school_id','password');
        if(Auth::guard('web')->attempt($creds,$remember_me)){
            return redirect ('student/studentdashboard')->with('success', 'Logged In Successful');
        }else{
            return redirect()->route('student.student_login')->with('fail','Incorrect Credential, You Have '.$retries.' Attempt Left');
        }
    }  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
 
    // public function user_activity(Request $request)
    // { 
       
    //     $users = User::select("*")
    //         ->whereNotNull('last_seen');
    //         // ->orderBy('last_seen','DESC')
    //         // ->paginate(15);
    //         return view('pages.student.studentdashboard', compact('users'));
    // }
    public function student_search_active_user(Request $request)
    {
        // $course = Course::all();
        $output1= " ";
        $student_user  = User::where('name','like','%'.$request->search.'%')->orwhere('school_id','%'.$request->search.'%')->orderBy('last_seen', 'desc')->get();
        foreach($student_user as $student_item)
        {     
            if (Cache::has('user-is-online-' . $student_item->id))
            { 
                $output1.= 
                    '<tr>
                    <td>'.$student_item->name.'</td>';
                $output1.=
                    '<td>'."Carbon\Carbon::parse"($student_item->last_seen)->diffForHumans().'</td>
                            <td>';
                if (Cache::has('user-is-online-' . $student_item->id))
                        $output1.=
                        '<span class="text-success">Online</span>
                        </td>';
                else
                    $output1.=
                    '<span class="text-danger">Offline</span>
                    </td>
                    </tr>';  
            } 
        }
        return response($output1);
    }
    public function student_search_active_signee_user(Request $request)
    {
        // $course = Course::all();
        $output2= " ";
        $signee_user  = Signee::where('name','like','%'.$request->search.'%')->orwhere('school_id','%'.$request->search.'%')->orderBy('last_seen', 'desc')->get();
        foreach($signee_user as $item)
        {      
            if (Cache::has('signee-is-online-' . $item->id))
            {
                $output2.= 
                    '<tr>
                    <td>'.$item->name.'</td>';
                $output2.=
                    '<td>'."Carbon\Carbon::parse"($item->last_seen)->diffForHumans().'</td>
                            <td>';
                if (Cache::has('signee-is-online-' . $item->id))
                        $output2.=
                        '<span class="text-success">Online</span>
                        </td>';
                else
                    $output2.=
                    '<span class="text-danger">Offline</span>
                    </td>
                    </tr>';
            }   
        }
        return response($output2);
    }
}
