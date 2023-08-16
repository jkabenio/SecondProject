<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Admin;
use App\Models\Signee;
use App\Models\Department; 
use App\Models\Course;
use App\Models\Subject;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\Validator; 
use DB;
use Cache;
use RateLimiter;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
class AdminController extends Controller
{   
    // dashboard function list
    public function dashboard_index(Request  $request)
    { 
        
        $admin_user = Admin::select("*") 
            ->whereNotNull('last_seen')
            ->orderBy('last_seen','DESC') 
            ->paginate(0);
        $signee_user = Signee::select("*")
            ->whereNotNull('last_seen')
            ->orderBy('last_seen','DESC')
            ->paginate(0);
        $student_user = User::select("*")
            ->whereNotNull('last_seen')
            ->orderBy('last_seen','DESC')
            ->paginate(0);
            $student = User::count();
            $admin = Admin::count();
            $signee = Signee::count();
            $course = Course::count();
            $department = Department::count();
            $request_count = User::all();
            $results = 0;
            foreach ($request_count as $counts)
            {
                foreach($counts->status as $status_count)
                {
                    if($status_count !== "APPROVED"){
                        $results++;
                    }
                }
                if($counts->guidance_councilor !== "APPROVED"){
                    $results++;
                }
                if($counts->student_org_treasurer !== "APPROVED"){
                    $results++;
                }
                if($counts->librarian !== "APPROVED"){
                    $results++;
                }
                if($counts->dean_of_student_affair !== "APPROVED"){
                    $results++;
                }
                if($counts->dean_principal !== "APPROVED"){
                    $results++;
                }
                if($counts->registrar !== "APPROVED"){
                    $results++;
                }
                if($counts->accounting_assessment !== "APPROVED"){
                    $results++;
                }
            } 
            $total_users = $student + $admin + $signee;

            $student_user_filter = User::when($request->course != null, function ($q) use ($request){
                return $q->where('course',$request->course);
            })
            ->when($request->year_lvl != null, function ($q) use ($request){
                return $q->where('year_lvl',$request->year_lvl);
            })
            ->paginate(100);
            $total_users = $student + $admin + $signee;

            // // $signee_user = Signee::when($request->course != null, function ($q) use ($request){
            // //     return $q->where('course',$request->course);
            // // })
            // // ->when($request->year_lvl != null, function ($q) use ($request){
            // //     return $q->where('year_lvl',$request->year_lvl);
            // // })
            // ->paginate(100); 
            $course_list = Course::all();
        return view('admin/admindashboard', compact('total_users','results','course','course_list','admin','student','student_user_filter','student_user','admin_user','signee','signee_user','department'));
    }





    // student function list
    public function student_index(Request  $request)
    {
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
        // $data = DB::table('users')->simplePaginate(5);
        $query = User::query();
        $course = Course::all();
        // if($request->ajax()){
        //     if(empty($request->course)){
        //         $users = $query->get();
        //     }
        //     else{           
        //         $users = $query->where(['course'=>$request->course])->get();
        //     }
        //     return response()->json(['users'=>$users]);
        // }
        // $users = $query->get();
        
        // $sortBy = 'name';
        // $orderBy = 'asc';
        // $perPage = 150; 
        // $q = null;
        // ,'orderBy', 'sortBy', 'q', 'perPage'
        // if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        // if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
        // if ($request->has('perPage')) $perPage = $request->query('perPage');
        // if ($request->has('q')) $q = $request->query('q');
        // return view('admin.view-student-user')->with('users', $users); 
        // $users = User::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);
        $student_user = User::when($request->course != null, function ($q) use ($request){
            return $q->where('course',$request->course);
        })
        ->when($request->year_lvl != null, function ($q) use ($request){
            return $q->where('year_lvl',$request->year_lvl);
        })
        ->paginate(100);  
        return view('admin.view-student-user', compact('student_user','course','admin_user','signee_user'));
    }
    public function admin_student_search(Request $request)
    {
        $course = Course::all();
        $output1="";
        $users  = User::where('name','like','%'.$request->search.'%')->orwhere('school_id','%'.$request->search.'%')->get();
        foreach($users as $item)
        {      
            $output1.=
                '<tr>
                <td>'.$item->name.'</td>';
            foreach($course as $course_list)
            {
                if($course_list->id == $item->course)
                {
                    $output1.=
                        '<td>'.$course_list->course_acronym.'</td>';          
                }
            }
            $output1.=
                '<td>'.$item->year_lvl.'</td>
                <td>'.$item->school_id.'</td>';
                
                $output1.=
                '<td>'.'<a href="'.url('/admin/edit-student/'.$item->id).'"><img class="edit"  src="'.asset('img/edit.png').'" alt="Italian Trulli"></a>'.'</td>                          
                <td>'.'<a onclick="document.getElementById('.($item->id).').style.display='."'block'".'" ><img class="edit" src="'.asset('img/delete.png').'" alt="Italian Trulli"></a>'.'</td>
                <div id="{{$item->id}}" class="w3-modal" >
                    <div class="w3-modal-content" style="width:30%;">
                        <header class="warning_header">
                            <span onclick="document.getElementById('.($item->id).').style.display='."'none'".'"
                                class="ekis_button w3-display-topright"><b>&times;</b>
                            </span>
                            <h2 style="color: rgb(248, 50, 50)"><b>WARNING!</b></h2>
                        </header> 
                        <div class="w3-container">
                            <p style="text-align: left">
                                Are you sure you want to delete<br>
                                ID:<b>{{$item->id}}</b><br>
                                Student Name:<b>{{$item->name}}</b><br>
                                Course ID:<b>{{$item->course}}</b><br>
                                Year level:<b>{{$item->year_lvl}}</b><br>
                                School ID:<b>{{$item->school_id}} ?</b>
                            </p>
                        </div>
                        <footer class="footer_line">
                            <p class="button_option">
                                <b>
                                    <a class="temporary_button" href="'.url('/admin/delete-student/'.$item->id).'" >Temporarily!</a>
                                    <a class="temporary_button" href="'.url('/admin/permanent-delete-student/'.$item->id).'" >Permanently!</a>
                                    <a class="no_button" style="cursor: pointer" onclick="document.getElementById('.($item->id).').style.display"="none">NO!</a>      
                                </b>
                                </p>       
                        </footer>
                    </div>
                </div>
                </tr>';
        }
        return response($output1);
    }

    public function FindSubjectName(Request $request){
        $data = Subject::select('subj_name','id','section','signee_names','year_level','semester')->where('course_id',$request->id)->take(100)->get();
        return response()->json($data);
    }

    public function create_student()
    {
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
        $department = Department::all();
        $course = Course::all();
        $subjects = Subject::orderBy('subj_name')->get();
        $users = User::orderBy('created_at','desc')->paginate(4);
        $roles_list = Role::all();
        return view('admin.add-student', compact('users','roles_list','department','course','subjects','student_user','admin_user','signee_user'));
    }
    public function edit_student($id)
    {
        
        $change_value_to = "IN-PROGRESS";
        $course = Course::all();
        $student_id = User::find($id);
        $subjects = Subject::orderBy('subj_name')->get();
        $subject_count = Subject::count();
        $department = Department::all();
        return view('admin.edit-student', compact('student_id','department','change_value_to','course','subjects','subject_count'));

    }
    public function update_student(Request $request, $id)
    {
        
        $this->validate($request, [
            'name' => "required|max:40|min:10|unique:users,name,$id|unique:signees,name,$id|unique:admins,name,$id|regex:/^(?=.*[A-Z])(?=.*[a-z-.])/",
            // 'role_as' => 'required',
            'email' => "required|string|email|max:50|unique:users,email,$id|unique:signees,email,$id|unique:admins,email,$id",
            // 'subjects' => 'required',
            // 'school_id' => 'required|max:8|min:8|regex:/^(?=.*[-])(?=.*[0-9])/',
            'semester' => 'required',
            // 'status' => 'required',
            // 'description' => 'nullable',
            'course' => 'required',
            'dept_id' => 'required',
            'school_id' => "required|max:8|min:8|regex:/^(?=.*[-])(?=.*[0-9])/|unique:users,school_id,$id|unique:signees,school_id,$id|unique:admins,school_id,$id",
            // 'student_org_treasurer' => 'required',
            // 'student_org_description' => 'nullable',


            // 'librarian' => 'required',
            // 'librarian_description' => 'nullable',

            // 'dean_of_student_affair' => 'required',
            // 'dean_of_student_affair' => 'nullable',

            // 'dean_principal' => 'required',
            // 'dean_principal_description' => 'nullable',

            // 'guidance_councilor' => 'required',
            // 'guidance_councilor_description' => 'nullable',

            // 'registrar' => 'required',
            // 'registrar_description' => 'nullable',

            // 'accounting_assessment' => 'required',
            // 'accounting_assessment_description' => 'nullable',
        ]); 
        $student_id = User::find($id);
        // Update User Student
        $student_id->name = $request->input('name');
        $student_id->email = $request->input('email');
        $student_id->course = $request->input('course');
        $student_id->dept_id = $request->input('dept_id');
        // $student_id->subjects = $request->input('subjects');
        $student_id->school_id = $request->input('school_id');
        // $student_id->status = $request->get('status');
        $student_id->semester = $request->get('semester');
        // $student_id->description = $request->get('description');

        // $student_id->student_org_treasurer = $request->get('student_org_treasurer');
        // $student_id->student_org_description = $request->get('student_org_description');

        // $student_id->librarian = $request->get('librarian');
        // $student_id->librarian_description = $request->get('librarian_description');
        
        // $student_id->dean_of_student_affair = $request->get('dean_of_student_affair');
        // $student_id->dean_of_student_affair_description = $request->get('dean_of_student_affair_description');

        // $student_id->dean_principal = $request->get('dean_principal');
        // $student_id->dean_principal_description = $request->get('dean_principal_description');

        // $student_id->guidance_councilor = $request->get('guidance_councilor');
        // $student_id->guidance_councilor_description = $request->get('guidance_councilor_description');

        // $student_id->registrar = $request->get('registrar');
        // $student_id->registrar_description = $request->get('registrar_description');

        // $student_id->accounting_assessment = $request->get('accounting_assessment');
        // $student_id->accounting_assessment_description = $request->get('accounting_assessment_description');
        $student_id->save();
       return redirect('/admin/view-student-user')->with('success', 'Student User Updated');
    }
    public function store_student(Request $request)
    { 
        $this->validate($request, [
            'name' => 'required|max:40|min:10|unique:users,name|unique:signees,name|unique:admins,name|regex:/^(?=.*[A-Z])(?=.*[a-z-.])/',
            'email' => 'required|string|email|max:255|unique:users,email|unique:signees,email|unique:admins,email',
            'password' => 'required|string|min:8|max:20|confirmed|regex:/^(?=.*[-])(?=.*[0-9])(?=.*[a-z])/',
            'course' => 'required',
            'dept_id' => 'required',
            'subjects' => 'required',
            'role_as' => 'required',
            'year_lvl' => 'required',
            'semester' => 'required',
            'school_id' => 'required|max:8|min:8|regex:/^(?=.*[-])(?=.*[0-9])/|unique:users,school_id|unique:signees,school_id|unique:admins,school_id',
        ]);

        $subjects = Subject::whereIn('id',$request->get('subjects'))->get();

        $subjectNames = array();
        $subjectAssingees = array();
        $subjectDescriptions = array();
        $subjectStatus = array();
        $subjectSection = array();
        

        foreach ($subjects as $subject) {
            array_push($subjectNames,$subject['subj_name']);
            array_push($subjectAssingees,$subject['signee_names']);
            array_push($subjectDescriptions,null);
            array_push($subjectStatus,"IN-PROGRESS");
            array_push($subjectSection,$subject['section']);
        }

        $users = new User([ 
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'course' => $request->get('course'),
            'dept_id' => $request->get('dept_id'),
            'subjects' => $subjectNames,
            'role_as' => $request->get('role_as'),
            'school_id' => $request->get('school_id'),
            'status' => $subjectStatus,
            'semester' => $request->get('semester'),
            'year_lvl' => $request->get('year_lvl'),
            'description' => $subjectDescriptions,
            'student_signee_names' => $subjectAssingees,
            'student_section' => $subjectSection,

        ]);
        $users->save();
        // return redirect()->route('admin.create-user')->with('success', 'data added');
        return redirect('admin/add-student')->with('success', 'Student data successfully added');
    }
    public function destroy_student( $student_id)
    {
        $student_user = User::find($student_id);
        $student_user->delete();
      
        return redirect('/admin/view-student-user')->with('success', 'Student User Removed');
    }
    






    // signee function list
    public function signee_index()
    {  
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
      
        $user_table = Signee::orderBy('created_at','DESC')->paginate(10);
        return view('admin.view-signee-user', compact('student_user','user_table','admin_user','signee_user'));
    }
    public function admin_signee_search(Request $request)
    {
        $output2="";
        $signees  = Signee::where('name','like','%'.$request->search.'%')->orwhere('school_id','like','%'.$request->search.'%')->get();
        foreach($signees as $item)
        {      
            $output2.=
                '<tr>
                <td>'.$item->id.'</td>
                <td>'.$item->name.'</td>
                <td>'.$item->email.'</td>
                <td>'.$item->school_id.'</td>
                <td>'.$item->role_as.'</td>
                <td>'.'<a href="'.url('/admin/edit-signee/'.$item->id).'"><img class="edit"  src="'.asset('img/edit.png').'" alt="Italian Trulli"></a>'.'</td>                          
                <td>'.'<a onclick="document.getElementById('.($item->id).').style.display='."'block'".'" ><img class="edit" src="'.asset('img/delete.png').'" alt="Italian Trulli"></a>'.'</td>
                <div id="{{$item->id}}" class="w3-modal" >
                    <div class="w3-modal-content" style="width:30%;">
                        <header class="warning_header">
                            <span onclick="document.getElementById('.($item->id).').style.display='."'none'".'"
                                class="ekis_button w3-display-topright"><b>&times;</b>
                            </span>
                            <h2 style="color: rgb(248, 50, 50)"><b>WARNING!</b></h2>
                        </header> 
                        <div class="w3-container">
                            <p style="text-align: left">
                                Are you sure you want to delete<br>
                                ID:<b>{{$item->id}}</b><br>
                                Student Name:<b>{{$item->name}}</b><br>
                                Course ID:<b>{{$item->course}}</b><br>
                                Year level:<b>{{$item->year_lvl}}</b><br>
                                School ID:<b>{{$item->school_id}} ?</b>
                            </p>
                        </div>
                        <footer class="footer_line">
                            <p class="button_option">
                                <b>
                                    <a class="temporary_button" href="'.url('/admin/delete-signee/'.$item->id).'" >Temporarily!</a>
                                    <a class="temporary_button" href="'.url('/admin/permanent-delete-signee/'.$item->id).'" >Permanently!</a>
                                    <a class="no_button" style="cursor: pointer" onclick="document.getElementById('.($item->id).').style.display"="none">NO!</a>      
                                </b>
                                </p>       
                        </footer>
                    </div>
                </div>
                </tr>';
        } 
        return response($output2);
    }
    public function create_signee()
    {
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
        $roles = Role::all();
        $dept_list = Department::all();
        $users = Signee::orderBy('created_at','desc')->paginate(10);
        return view('admin.add-signee', compact('users','dept_list','roles','student_user','admin_user','signee_user'));
    }
    public function store_signee(Request $request)
    { 
        $this->validate($request, [
            'name' => 'required|max:40|min:10|unique:users,name|unique:signees,name|unique:admins,name|regex:/^(?=.*[A-Z])(?=.*[a-z-.])/',
            'email' => 'required|string|email|max:255|unique:users,email|unique:signees,email|unique:admins,email',
            'password' => 'required|string|min:8|max:20|confirmed|regex:/^(?=.*[-])(?=.*[0-9])(?=.*[a-z])/',
            'role_as' => 'required',
            'dept_id' => 'required',
            'school_id' => 'required|max:10|min:10|regex:/^(?=.*[-])(?=.*[0-9])/|unique:users,school_id|unique:signees,school_id|unique:admins,school_id',
        ]);
 
        $users = new Signee([ 
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role_as' => $request->get('role_as'),
            'school_id' => $request->get('school_id'),
            'dept_id' => $request->get('dept_id')
        ]);
        $users->save();
        // return redirect()->route('admin.create-user')->with('success', 'data added');
        return redirect('admin/add-signee')->with('success', 'Signee data successfully added');
    }

    public function edit_signee($id)
    {
        $roles = Role::all();
        $dept_list = Department::all();
        $signee_id = Signee::find($id);
        return view('admin.edit-signee', compact('signee_id','dept_list','roles'));

    }
 
    public function update_signee(Request $request, $id)
    {
        $this->validate($request, [
            'name' => "required|max:40|min:10|regex:/^(?=.*[A-Z])(?=.*[a-z-.])/|unique:users,name,$id|unique:signees,name,$id|unique:admins,name,$id",
            'email' => "required|string|email|max:255|unique:users,email,$id|unique:signees,email,$id|unique:admins,email,$id",
            'role_as' => 'required',
            'dept_id' => 'required',
            'school_id' => "required|max:10|min:10|regex:/^(?=.*[-])(?=.*[0-9])/|unique:users,school_id,$id|unique:signees,school_id,$id|unique:admins,school_id,$id",
        ]);
        $signee_id = Signee::find($id);
        // Update User Student
        $signee_id->name = $request->input('name');
        $signee_id->email = $request->input('email');
        $signee_id->role_as = $request->input('role_as');
        $signee_id->school_id = $request->input('school_id');
        $signee_id->dept_id = $request->input('dept_id');
        $signee_id->save();
       return redirect('/admin/view-signee-user')->with('success', 'Signee User Updated');
    }
    public function destroy_signee($signee_id)
    {
        $signee_user = Signee::find($signee_id);
        $signee_user->delete();
      
        return back()->with('success', 'Signee User Removed');
    }





    // department function list
    public function department_index()
    {  
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
        $department_table = Department::orderBy('created_at')->paginate(5);
        return view('admin.view-department', compact('student_user','department_table','admin_user','signee_user'));
    }
    public function create_department(){
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
        $department = Department::orderBy('created_at','desc')->paginate(4);
        return view('admin.add-department', compact('department','student_user','admin_user','signee_user'));
    }
    public function store_department(Request $request){
        $this->validate($request, [
            'dept_name' => 'required|string|max:50|min:15|unique:departments,dept_name||regex:/^(?=.*[A-Z])(?=.*[a-z])/',
        ]);

                
        $department = new Department([ 
            'dept_name' => $request->get('dept_name'),
        ]);
        $department->save();
        return redirect('admin/add-department')->with('success', 'New department data successfully added');
    }
    public function edit_department($id)
    {
        $dept_id = Department::find($id);
        return view('admin.edit-department', compact('dept_id'));

    }
    public function update_department(Request $request, $id)
    {
        $this->validate($request, [
            'dept_name' => "required|string|max:50|min:15|unique:departments,dept_name,$id||regex:/^(?=.*[A-Z])(?=.*[a-z])/", 
        ]);
        $dept_id = Department::find($id);
        $dept_id->dept_name = $request->input('dept_name');
        $dept_id->save();
        return redirect('/admin/view-department')->with('success', 'Department Updated');
    } 
    public function destroy_department($id)
    {
        $department = Department::find($id);
        $department->delete();     
        return back()->with('success', 'Department temporarily Removed');
    }



   
 

    // course function list
    public function course_index()
    {  
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
        $department = Department::all();
        $course_table = Course::orderBy('created_at')->paginate(20);
        return view('admin.view-course', compact('student_user','course_table','admin_user','signee_user','department'));
    }
    public function create_course()
    {
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
            $dept_list = Department::orderBy('dept_name')->get();
            $course_log = Course::orderBy('created_at','desc')->paginate(4);
        return view('admin.add-course', compact('dept_list','student_user','admin_user','signee_user','course_log')); 
    }
    public function store_course(Request $request){
        $this->validate($request, [
            'course_name' => 'required|string|max:50|min:20|unique:courses,course_name||regex:/^(?=.*[A-Z])(?=.*[a-z])/',
            // 'belong_to' => 'required|string|max:255',
            'course_acronym' => 'required|string|max:8|min:3|unique:courses,course_acronym||regex:/^(?=.*[A-Z])/',
            'dept_id' => 'required|integer',
        ]);
        
        $course = new Course([ 
            'course_name' => $request->get('course_name'),
            'course_acronym' => $request->get('course_acronym'),
            // 'belong_to' => $request->get('belong_to'),
            'dept_id' => $request->get('dept_id'),
         
        ]);
        $course->save();
        return redirect('admin/add-course')->with('success', 'New course data successfully added');
    }
    
    public function edit_course($id)
    {
        $course_id = Course::find($id);
        // $course = Course::orderBy('course_name')->get();
        $dept_list = Department::orderBy('dept_name')->get();
        return view('admin.edit-course', compact('course_id','dept_list'));

    }
    public function update_course(Request $request, $id)
    {
        $this->validate($request, [
            'course_name' => "required|string|max:50|min:20|unique:courses,course_name,$id||regex:/^(?=.*[A-Z])(?=.*[a-z])/",
            'course_acronym' => "required|string|max:8|min:3|unique:courses,course_acronym,$id||regex:/^(?=.*[A-Z])/", 
            'dept_id' => 'required',
        ]);
        $course_id = Course::find($id);
        $course_id->course_name = $request->input('course_name');
        $course_id->course_acronym = $request->input('course_acronym');
        $course_id->dept_id = $request->input('dept_id');
        $course_id->save();
        return redirect('/admin/view-course')->with('success', 'Course Updated');
    } 
    public function destroy_course($course_id)
    {
        $course = Course::find($course_id);
        $course->delete();     
        return redirect('/admin/view-course')->with('success', 'Course  Removed');
    }
    
   




    // subject function list
    public function subject_index()
    {  
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
        $subject_table = Subject::all();
        return view('admin.view-subject', compact('student_user','subject_table','admin_user','signee_user'));
    }
    public function admin_subject_search(Request $request)
    {
        $output3="";
        $subject_table = Subject::where('subj_name','like','%'.$request->search.'%')->orwhere('code','like','%'.$request->search.'%')->orwhere('subj_code','like','%'.$request->search.'%')->get();
        foreach($subject_table as $item)
        {      
            $output3.=
                '<tr>
                <td>'.$item->id.'</td>
                <td>'.$item->code.'</td>
                <td>'.$item->subj_code.'</td>
                <td>'.$item->subj_name.'</td>
                <td>'.$item->signee_names.'</td>
                <td>'.$item->unit.'</td>
                <td>'.$item->year_level.'</td>
                <td>'.$item->semester.'</td>
                <td>'.'<a href="'.url('/admin/edit-subject/'.$item->id).'"><img class="edit"  src="'.asset('img/edit.png').'" alt="Italian Trulli"></a>'.'</td>                          
                <td>'.'<a onclick="document.getElementById('.($item->id).').style.display='."'block'".'" ><img class="edit" src="'.asset('img/delete.png').'" alt="Italian Trulli"></a>'.'</td>
                <div id="{{$item->id}}" class="w3-modal" >
                    <div class="w3-modal-content" style="width:30%;">
                        <header class="warning_header">
                            <span onclick="document.getElementById('.($item->id).').style.display='."'none'".'"
                                class="ekis_button w3-display-topright"><b>&times;</b>
                            </span>
                            <h2 style="color: rgb(248, 50, 50)"><b>WARNING!</b></h2>
                        </header> 
                        <div class="w3-container"> 
                            <p style="text-align: left">
                            Are you sure you want to delete<br>
                            ID:<b>{{$item->id}}</b><br>
                            Course ID:<b>{{$item->course_id}}</b><br>
                            Code:<b>{{$item->code}}</b><br>
                            subject Code:<b>{{$item->subj_code}}</b><br>
                            Subject Name:{{$item->subj_name}}
                            Unit:<b>{{$item->unit}}</b><br>
                            Year Level:<b>{{$item->year_level}}</b><br>
                            Semester:<b>{{$item->semester}}</b><br>
                            Signee Name:<b>{{$item->signee_names}}</b><br>
                            Section:<b>{{$item->section}}</b><br>
                            Created At:<b>{{$item->created_at}}</b><br>
                            Updated At: <b>{{$item->updated_at}} ?</b></p>
                            </p>
                        </div>
                        <footer class="footer_line">
                            <p class="button_option">
                                <b>
                                    <a class="temporary_button" href="'.url('/admin/delete-subject/'.$item->id).'" >Temporarily!</a>
                                    <a class="temporary_button" href="'.url('/admin/permanent-delete-subject/'.$item->id).'" >Permanently!</a>
                                    <a class="no_button" style="cursor: pointer" onclick="document.getElementById('.($item->id).').style.display"="none">NO!</a>      
                                </b>
                                </p>       
                        </footer>
                    </div>
                </div>
                </tr>';
        } 
        return response($output3);
    }
    public function create_subject(){
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
        $signeelist = Signee::orderBy('name')->get();
        $course_list = Course::orderBy('course_name')->get();
        $subject_log = Subject::orderBy('created_at','desc')->paginate(4);
        return view('admin.add-subject', compact('signeelist','course_list','subject_log','student_user','admin_user','signee_user'));
        }
    public function store_subject(Request $request){
        $this->validate($request, [
            'course_id' => 'required|integer',
            'code' => 'required|string|max:5|min:3|regex:/^(?=.*[A-Z])(?=.*[0-9])/',
            'subj_code' => 'required|string|min:3|max:20|regex:/^(?=.*[A-Z-])(?=.*[0-9])/',
            'subj_name' => 'required|string|min:10|max:60|regex:/^(?=.*[A-Z])(?=.*[a-z0-9])/',
            'unit' => 'required|integer|min:1|max:15|regex:/^(?=.*[0-9])/',
            'year_level' => 'required|string|min:8|max:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])/',
            'semester' => 'required|string|min:12|max:12|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])/',
            'section' => 'required|string|min:7|max:7|regex:/^(?=.*[A-Z])(?=.*[a-z])/',
            'signee_names' => 'required|max:40|min:10|regex:/^(?=.*[A-Z])(?=.*[a-z-.])/',
        ]);     
        $subject = new Subject([ 
            'course_id' => $request->get('course_id'),
            'code' => $request->get('code'),
            'subj_code' => $request->get('subj_code'),
            'subj_name' => $request->get('subj_name'),
            'unit' => $request->get('unit'),
            'year_level' => $request->get('year_level'),
            'semester' => $request->get('semester'),
            'section' => $request->get('section'),
            'signee_names' =>  $request->get('signee_names'),
        ]);
        $subject->save();
        return redirect('admin/add-subject')->with('success', 'New Subject data successfully added');
    }

    public function edit_subject($id)
    {
        $signees = Signee::all();
        $subject_id = Subject::find($id);
        $subjects = Subject::orderBy('subj_name')->get();
        $course_list = Course::orderBy('course_name')->get();
        return view('admin.edit-subject', compact('subject_id','signees','subjects','course_list'));

    }
    
    public function update_subject(Request $request, $id)
    {
        $this->validate($request, [
            'course_id' => 'required',           
            'code' => 'required',
            'subj_code' => 'required',
            'subj_name' => 'required',
            'unit' => 'required',
            'semester' => 'required',
            'signee_names' => 'required', 
            'section' => 'required', 
        ]);
        $subject_id = Subject::find($id);
        // Update User Student
        $subject_id->course_id = $request->input('course_id');
        $subject_id->code = $request->input('code');
        $subject_id->subj_code = $request->input('subj_code');
        $subject_id->subj_name = $request->input('subj_name');
        $subject_id->semester = $request->input('semester');
        $subject_id->signee_names = $request->input('signee_names');
        $subject_id->section = $request->input('section');
        $subject_id->save();
        return redirect('/admin/view-subject')->with('success', 'Subject Updated');
    }
    public function destroy_subject($subject_id)
    {
        $subject = Subject::find($subject_id);
        $subject->delete();
      
        return back()->with('success', 'Subject  Removed');
    }







    public function role_index(Request $request)
    {
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
        $role_table = Role::orderBy('created_at')->paginate(5);
        return view('admin.view-role', compact('role_table','student_user','admin_user','signee_user'));
    }

    public function create_role(Request $request){
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
        $role_log = Role::orderBy('created_at','desc')->paginate(5);
        return view('admin.add-role', compact('role_log','student_user','admin_user','signee_user'));
        }

    public function store_role(Request $request){
        $this->validate($request, [
            'role_name' => 'required|string|min:5|max:30|unique:roles,role_name',           
        ]);     
        $role = new Role([ 
            'role_name' =>  $request->get('role_name'),
        ]);
        $role->save();
        return redirect('admin/add-role')->with('success', 'New Role data successfully added');
    }
    public function edit_role($id)
    {
        $role_id = Role::find($id);
        return view('admin.edit-role', compact('role_id'));

    }
    public function update_role(Request $request, $id)
    {
        $this->validate($request, [
            'role_name' => "required|string|min:5|max:30|unique:roles,role_name,$id" 
        ]);
        $role_id = Role::find($id);
        // Update Role
        $role_id->role_name = $request->input('role_name');
        $role_id->save();
        return redirect('/admin/view-role')->with('success', 'Role Updated');
    }
    public function destroy_role($role_id)
    {
        $role = Role::find($role_id);
        $role->delete();
      
        return back()->with('success', 'Role Removed');
    }







 







    public function admin_check(Request $request)
    { 
        $key = "login.".$request->ip();
        $retries = RateLimiter::retriesLeft($key, 3);
        $request->validate([
            // 'email' => 'required|exists:admins,email',
            'password' => 'required|min:8', 
            'school_id' => 'required|max:30|exists:admins,school_id'
        ],[
        'school_id.exists'=>'This ID is not exists on users table' 
         ]);
        $remember_me = $request->has('remember_token') ? true : false;
        $creds = $request->only('school_id','password');
        if(Auth::guard('admin')->attempt($creds,$remember_me)){
            return redirect ('admin/admindashboard')->with('success', 'Logged In as Admin Successful');
        }else{
            return redirect()->route('admin.admin_login')->with('fail','Incorrect Credential, You Have '.$retries.' Attempt Left');
        }
    } 
   //put this code in controller
// public function admin_logout()
// {
//     $user = Auth::guard('admin')->token();
//     $user->revoke();
//     return response()->json('Successfully logged out');
// } 
public function admin_logout(Request $request) {
    Auth::logout();
    return redirect()->route('admin.admindashboard')->with('success', 'Logout is Successful');
}
    // change user password function
    //this is  change student password functions
    public function change_student_password_index(Request  $request)
    {
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
        $student_table = User::orderBy('created_at','DESC')->paginate(5);
        $signee_table = Signee::orderBy('created_at','DESC')->paginate(5);
        // return view('admin.view-student-user')->with('users', $users);      
        return view('admin.change-student-password', compact('student_user','signee_table','student_table','admin_user','signee_user'));
    }
    public function edit_student_password($id)
    {
        $student_id = User::find($id);
        return view('admin.edit-student-password', compact('student_id'));

    }
    public function update_student_password(Request $request, $id)
    {
        $this->validate($request, [ 
            'password' => 'required|string|min:8|max:20|confirmed|regex:/^(?=.*[-])(?=.*[0-9])(?=.*[a-z])/',
        ]);
        $student_id = User::find($id);
        $student_id->password = Hash::make($request->input('password'));
        $student_id->save();
       return redirect('/admin/change-student-password')->with('success', 'Student Password Successfully changed');
    }




    //this is  change signee password functions
    public function change_signee_password_index(Request  $request)
    {
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
        $signee_table = Signee::orderBy('created_at','DESC')->paginate(5);
        // return view('admin.view-student-user')->with('users', $users);      
        return view('admin.change-signee-password', compact('student_user','signee_table','admin_user','signee_user'));
    }
    public function edit_signee_password($id)
    {
        $signee_id = Signee::find($id);
        return view('admin.edit-signee-password', compact('signee_id'));
    }
    public function update_signee_password(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|string|min:8|max:20|confirmed|regex:/^(?=.*[-])(?=.*[0-9])(?=.*[a-z])/',
        ]);
        $signee_id = Signee::find($id);
        $signee_id->password = Hash::make($request->input('password'));
        $signee_id->save();
       return redirect('/admin/change-signee-password')->with('success', 'Signee Password Successfully changed');
    }







 



    public function trashed()
    {
       
        $trashed_course = Course::onlyTrashed()->get();
        $trashed_department = Department::onlyTrashed()->get();
        $trashed_subject = Subject::onlyTrashed()->get();
        $trashed_student = User::onlyTrashed()->get();
        $trashed_role = Role::onlyTrashed()->get();
        $trashed_signee = Signee::onlyTrashed()->get();
        return view('admin.trash', compact('trashed_department','trashed_course','trashed_subject','trashed_student','trashed_role','trashed_signee'));
    }
// below are Department restore and permanent delete functions
    public function restore_department($id)
    {
        Department::whereId($id)->restore();
        return back()->with('success', 'Department  successfully restored');
    }

    public function restore_all_department()
    {
        Department::onlyTrashed()->restore();
        return back()->with('success', 'all Department  successfully restored');
    }
    
    public function permanent_destroy_department($id)
    {
       
        Department::find($id)->forceDelete();
        return back()->with('success', 'Department  Permanently Deleted');
    }
    public function permanent_destroy_department_from_trash($id)
    {
        Department::onlyTrashed()->find($id)->forceDelete();
        return back()->with('success', 'Department Permanently Deleted');
    }
// below are course restore and permanent delete functions
    public function restore_course($id)
    {
        Course::whereId($id)->restore();
        return back()->with('success', 'Course  successfully restored');
    }

    public function restore_all_course()
    {
        Course::onlyTrashed()->restore();
        return back()->with('success', 'all Course  successfully restored');
    }
    
    public function permanent_destroy_course($id)
    {
        Course::find($id)->forceDelete();
        return back()->with('success', 'Course  Permanently Deleted');
    }

    public function permanent_destroy_course_from_trash($id)
    {
        Course::onlyTrashed()->find($id)->forceDelete();
        return back()->with('success', 'Course Permanently Deleted');
    }
// below are subject restore and permanent delete functions
    public function restore_subject($id)
    {
        Subject::whereId($id)->restore();
        return back()->with('success', 'Subject  successfully restored');
    }

    public function restore_all_subject()
    {
        Subject::onlyTrashed()->restore();
        return back()->with('success', 'all Subject  successfully restored');
    }
    
    public function permanent_destroy_subject($id)
    {
        Subject::find($id)->forceDelete();
        return back()->with('success', 'Subject Permanently Deleted');
    }
    public function permanent_destroy_subject_from_trash($id)
    {
        Subject::onlyTrashed()->find($id)->forceDelete();
        return back()->with('success', 'Subject Permanently Deleted');
    }
// below are student restore and permanent delete functions
    public function restore_student($id)
    {
        User::whereId($id)->restore();
        return back()->with('success', 'student  successfully restored');
    }

    public function restore_all_student()
    {
        User::onlyTrashed()->restore();
        return back()->with('success', 'all student  successfully restored');
    }
    
    public function permanent_destroy_student($id)
    {
        User::find($id)->forceDelete();
        return back()->with('success', 'student Permanently Deleted');
    }
    public function permanent_destroy_student_from_trash($id)
    {
        User::onlyTrashed()->find($id)->forceDelete();
        return back()->with('success', 'Student Permanently Deleted');
    }
// below are role restore and permanent delete functions
    public function restore_role($id)
    {
        Role::whereId($id)->restore();
        return back()->with('success', 'role  successfully restored');
    }

    public function restore_all_role()
    {
        Role::onlyTrashed()->restore();
        return back()->with('success', 'all role  successfully restored');
    }
    
    public function permanent_destroy_role($id)
    {
        Role::find($id)->forceDelete();
        return back()->with('success', 'role Permanently Deleted');
    }
    public function permanent_destroy_role_from_trash($id)
    {
        Role::onlyTrashed()->find($id)->forceDelete();
        return back()->with('success', 'Role Permanently Deleted');
    }
// below are signee restore and permanent delete functions
    public function restore_signee($id)
    {
        Signee::whereId($id)->restore();
        return back()->with('success', 'signee  successfully restored');
    }

    public function restore_all_signee()
    {
        Signee::onlyTrashed()->restore();
        return back()->with('success', 'all signee  successfully restored');
    }
    
    public function permanent_destroy_signee($id)
    {
        Signee::find($id)->forceDelete();
        return back()->with('success', 'signee Permanently Deleted');
    }
    public function permanent_destroy_signee_from_trash($id)
    {
        Signee::onlyTrashed()->find($id)->forceDelete();
        return back()->with('success', 'Signee Permanently Deleted');
    }












    public function getsubject(Request $request){
        $subjects_list=[];
        if($search=$request->subj_name){
            $subjects_list=Subject::where('subj_code','LIKE',"%$search%")->orwhere('subj_name','LIKE',"%$search%")->orwhere('section','LIKE',"%$search%")->orwhere('signee_names','LIKE',"%$search%")->get();

        }
        return response()->json($subjects_list);
          
    }

 
















    public function complete_request(Request $request)
    { 
        $complete_request = User::all();
        $complete_request = User::when($request->course != null, function ($q) use ($request){
            return $q->where('course',$request->course);
        })
        ->when($request->year_lvl != null, function ($q) use ($request){
            return $q->where('year_lvl',$request->year_lvl);
        })
        ->paginate(100);
        $course = Course::all();
        return view('admin.complete-request', compact('complete_request','course'));
   
    }
 
    public function print_student_clearance(Request $request)
    { 
        $complete_request = User::all();
        $complete_request = User::when($request->course != null, function ($q) use ($request){
            return $q->where('course',$request->course);
        })
        ->when($request->year_lvl != null, function ($q) use ($request){
            return $q->where('year_lvl',$request->year_lvl);
        })
        ->paginate(100); 
        $course = Course::all();
        return view('admin.print-student-clearance', compact('complete_request','course'));
   
    }
    public function view_generate_pdf(Request $request)
    {      
        $complete_request = User::orderBy('name','asc')->get();
        $course = Course::get();
        $pdf = Pdf::loadView('admin.view-generate-pdf',[
            // 'today_date' => $today_date,
            'complete_request' => $complete_request,
            'course' => $course
        ]);
        $today_date = Carbon::now()->format('d-m-Y');
        return $pdf->download('Clearance-List-'.$today_date.'.pdf');
    }




    public function view_pending_request(Request $request)
    { 
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
        $users_pending_request = User::all();
        $signee = 0;
        $counselor = 0;
        $treasurer = 0;
        $librarian = 0;
        $affair = 0;
        $dean = 0;
        $registrar = 0;
        $assessment = 0;
        foreach($users_pending_request as $counts){
            foreach($counts->status as $subject_count){
                if($subject_count !== "APPROVED"){
                    $signee++; 
                }
            }
            if($counts->guidance_councilor !== "APPROVED"){
                $counselor++;
            }
            if($counts->student_org_treasurer !== "APPROVED"){
                $treasurer++;
            }
            if($counts->librarian !== "APPROVED"){
                $librarian++;
            }
            if($counts->dean_of_student_affair !== "APPROVED"){
                $affair++;
            }
            if($counts->dean_principal !== "APPROVED"){
                $dean++;
            }
            if($counts->registrar !== "APPROVED"){
                $registrar++;
            }
            if($counts->accounting_assessment !== "APPROVED"){
                $assessment++;
            }
        }
        $users_pending_request = User::when($request->course != null, function ($q) use ($request){
            return $q->where('course',$request->course);
        })
        ->when($request->year_lvl != null, function ($q) use ($request){
            return $q->where('year_lvl',$request->year_lvl);
        })
        ->paginate(100);
        $course = Course::all();
        return view('admin.view-pending-request', compact('users_pending_request','course','signee','counselor','treasurer','librarian','affair','dean','registrar','assessment','student_user','admin_user','signee_user'));
    }

    public function update_multiple_student(Request $request)
    {
        $ids = $request->id ?? array();
 
        // foreach ($ids as $id) {
        //     User::where('id',$id)->update([
        //         'status' => $request->get('status')[$id],
        //         'guidance_councilor' => $request->get('guidance_councilor')[$id],
        //         'student_org_treasurer' => $request->get('student_org_treasurer')[$id],
        //         'librarian' => $request->get('librarian')[$id],
        //         'dean_of_student_affair' => $request->get('dean_of_student_affair')[$id],
        //         'dean_principal' => $request->get('dean_principal')[$id],
        //         'registrar' => $request->get('registrar')[$id],
        //         'accounting_assessment' => $request->get('accounting_assessment')[$id],

        //         'description' => $request->get('description')[$id],
        //         'guidance_councilor_description' => $request->get('guidance_councilor_description')[$id],
        //         'student_org_description' => $request->get('student_org_description')[$id],
        //         'librarian_description' => $request->get('librarian_description')[$id],
        //         'dean_of_student_affair_description' => $request->get('dean_of_student_affair_description')[$id],
        //         'dean_principal_description' => $request->get('dean_principal_description')[$id],
        //         'registrar_description' => $request->get('registrar_description')[$id],
        //         'accounting_assessment_description' => $request->get('accounting_assessment_description')[$id],
        //     ]);
        // }
 
        return back()->with('success', 'student successfully updated');
        // save();
        // $users_pending_request->status = $request->get('status');
        // $users_pending_request->description = $request->get('description');
        // $users_pending_request->save();
    //    return back()->with('success', 'Student User Updated');
    }





    public function signee_search_active_user(Request $request)
    {
        // $course = Course::all();
        $output10= " ";
        $student_user  = User::where('name','like','%'.$request->search.'%')->orwhere('school_id','%'.$request->search.'%')->orderBy('last_seen', 'desc')->get();
        foreach($student_user as $student_item)
        {     
            if (Cache::has('user-is-online-' . $student_item->id))
            { 
                $output10.= 
                    '<tr>
                    <td>'.$student_item->name.'</td>';
                $output10.=
                    '<td>'."Carbon\Carbon::parse"($student_item->last_seen)->diffForHumans().'</td>
                            <td>';
                if (Cache::has('user-is-online-' . $student_item->id))
                        $output10.=
                        '<span class="text-success">Online</span>
                        </td>';
                else
                    $output10.=
                    '<span class="text-danger">Offline</span>
                    </td>
                    </tr>';  
            } 
        }
        return response($output10);
    }
    public function signee_search_active_signee_user(Request $request)
    {
        $output11= " ";
        $signee_user  = Signee::where('name','like','%'.$request->search.'%')->orwhere('school_id','%'.$request->search.'%')->orderBy('last_seen', 'desc')->get();
        foreach($signee_user as $item)
        {      
            if (Cache::has('signee-is-online-' . $item->id))
            {
                $output11.= 
                    '<tr>
                    <td>'.$item->name.'</td>';
                $output11.=
                    '<td>'."Carbon\Carbon::parse"($item->last_seen)->diffForHumans().'</td>
                            <td>';
                if (Cache::has('signee-is-online-' . $item->id))
                        $output11.=
                        '<span class="text-success">Online</span>
                        </td>';
                else
                    $output11.=
                    '<span class="text-danger">Offline</span>
                    </td>
                    </tr>';
            }   
        }
        return response($output11);
    }
}
 