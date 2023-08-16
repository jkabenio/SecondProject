<?php

namespace App\Http\Controllers\Signee;
use Cache;
use App\Models\Signee;
use App\Models\User;
use App\Models\Admin;
use App\Models\Department;
use App\Models\Course;
use App\Models\Subject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use RateLimiter;
class SigneeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $subject_list = Subject::all();
        $subject_count = Subject::count();
        $assigned_subject_count = 0;
       
            foreach($subject_list as $list)
            {
                if(Auth::user()->name == $list->signee_names)
                {
                    $assigned_subject_count++;
                }
            }
        $student = User::all();
        $student_count = User::count();
        $assigned_student_count = 0;
        foreach($student as $student_list)
        {
            foreach($student_list->student_signee_names as $list)
            {
                if(Auth::user()->name == $list)
                {
                    
                    $assigned_student_count++;
                    break;
                }
                
            }
        } 
        // $status_approved = 0;
        // $status_count_to_student = 0;
        // foreach($student as $request)
        // {
        //     foreach($request->student_signee_names as $name_list)
        //     {
        //         if(Auth::user()->name == $name_list)
        //         {
        //             foreach($request->status as $status_count)
        //             {
                        
        //                 if($status_count == "APPROVED")
        //                     {
        //                         $status_approved = 0;
                          
        //                     }
        //                 elseif($status_count !== "APPROVED")
        //                 {
        //                     $status_count_to_student++;
        //                     break;
        //                 }
        //             }
        //         }
        //     }
        // }

        
        $status_count_to_student = 0;
      
        foreach($student as $user)
        {
            $stats_count = 0;
            $passed_names = array();
            $passed_status = array();
            foreach ($user->student_signee_names as $signee_list){
                $value = $signee_list; 
                array_push($passed_names, $value);
            }
            
            foreach ($user->status as $status_list){
                $value = $status_list; 
                array_push($passed_status, $value);
                $stats_count++;
            }
            foreach ($user->status as $loop => $status_list){
                if(Auth::user()->name == $passed_names[$loop])
                {
                    if(($passed_status[$loop] == "IN-PROGRESS") || ( $passed_status[$loop] == "COMPLY") || ($passed_status[$loop] == "REJECTED"))
                    {
                        $status_count_to_student++;
                    }
                }
            }
        }
        $student_org_count = 0;
        $dean_principal_count = 0;
        $same_dept = 0;
        foreach($student as $student_dept_id){
            if(Auth::user()->dept_id == $student_dept_id->dept_id){
                $same_dept++;
                if($student_dept_id->student_org_treasurer !== "APPROVED"){
                    $student_org_count++;
                }
                // for dean Principal logics
                if($student_dept_id->dean_principal !== "APPROVED"){
                    $dean_principal_count++;
                }
            }
        }
        $librarian_request = 0;
        $guidance_councilor_request = 0;
        $student_affair_request = 0;
        $registrar_request = 0;
        $assessment_request = 0;
        foreach($student as $student_list){
            if($student_list->librarian !== "APPROVED"){
                $librarian_request++;
            }
            if($student_list->dean_of_student_affair !== "APPROVED"){
                $student_affair_request++;
            }
            if($student_list->guidance_councilor !== "APPROVED"){
                $guidance_councilor_request++;
            }
            if(  $student_list->registrar !== "APPROVED"){
                $registrar_request++;
            }
            if($student_list->accounting_assessment !== "APPROVED"){
                $assessment_request++;
            }
        }
        return view('signee.signeedashboard', compact('subject_count','librarian_request','guidance_councilor_request','student_affair_request','registrar_request','assessment_request','dean_principal_count','student_org_count','same_dept','assigned_student_count','assigned_subject_count','status_count_to_student','student_count'));
    }

    public function pending_signee_request(Request  $request){
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
        $student = User::all();
        $course = Course::all();
        $student_count = User::count();
        $assigned_student_count = 0;
        foreach($student as $student_list)
        {
            foreach($student_list->student_signee_names as $list)
            {
                if(Auth::user()->name == $list)
                {
                    
                    $assigned_student_count++;
                    break;
                }
            }
        }    
        $student = User::when($request->course != null, function ($q) use ($request){
            return $q->where('course',$request->course);
        })
        ->when($request->year_lvl != null, function ($q) use ($request){
            return $q->where('year_lvl',$request->year_lvl);
        })
        ->orderBy('updated_at','desc')->get(); 
  
        return view('signee.view-signee-pending-request', compact('student','course','assigned_student_count','student_user','admin_user','signee_user'));
    }
    public function quick_view_request(Request  $request)
    {
        $student = User::all();
        $course = Course::all();
        $student_count = User::count();
        $assigned_student_count = 0;
        foreach($student as $student_list)
        {
            foreach($student_list->student_signee_names as $list)
            {
                if(Auth::user()->name == $list)
                {
                    
                    $assigned_student_count++;
                    break;
                }
                
            }
        }    

        $student = User::when($request->course != null, function ($q) use ($request){
            return $q->where('course',$request->course);
        })
        ->when($request->year_lvl != null, function ($q) use ($request){
            return $q->where('year_lvl',$request->year_lvl);
        })
        ->orderBy('updated_at','desc')->get(); 
        return view('signee.quick-view-request', compact('student','course','assigned_student_count'));
    }

 
    public function update_multiple_student(Request $request)
    {
        $ids = $request->id ?? array();


        if(strcasecmp(Auth::user()->role_as,'Instructor') == 0)
        {

            foreach ($ids as $id) {
                // foreach ($request->get('status')[$id] as $idx => $status){
                    User::where('id',$id)->update([
                        'status' => $request->get('status')[$id],
                        'description' => $request->get('description')[$id],
                    ]);  
                // }
            }
        }
        if(strcasecmp(Auth::user()->role_as,'Guidance Counselor') == 0)
        {
            foreach ($ids as $id) {
                User::where('id',$id)->update([
                    'guidance_councilor' => $request->get('guidance_councilor')[$id],
                    'guidance_councilor_description' => $request->get('guidance_councilor_description')[$id],

                ]);
            }
        }
        if(strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') == 0)
        {
            foreach ($ids as $id) {
                User::where('id',$id)->update([
                    'student_org_treasurer' => $request->get('student_org_treasurer')[$id],
                    'student_org_description' => $request->get('student_org_description')[$id],

                ]);
            }
        }
        if(strcasecmp(Auth::user()->role_as,'Librarian') == 0)
        {
            foreach ($ids as $id) {
                User::where('id',$id)->update([
                    'librarian' => $request->get('librarian')[$id],
                    'librarian_description' => $request->get('librarian_description')[$id],
                ]);
            }
        }
        if(strcasecmp(Auth::user()->role_as,'Dean of Student Affair') == 0)
        {
            foreach ($ids as $id) {
                User::where('id',$id)->update([
                    'dean_of_student_affair' => $request->get('dean_of_student_affair')[$id],
                    'dean_of_student_affair_description' => $request->get('dean_of_student_affair_description')[$id],
                ]);
            }
        }
        if(strcasecmp(Auth::user()->role_as,'Dean Principal') == 0)
        {
            foreach ($ids as $id) {
                User::where('id',$id)->update([
                    'dean_principal' => $request->get('dean_principal')[$id],
                    'dean_principal_description' => $request->get('dean_principal_description')[$id],
                ]);
            }
        }
        if(strcasecmp(Auth::user()->role_as,'Registrar') == 0)
        {
            foreach ($ids as $id) {
                User::where('id',$id)->update([
                    'registrar' => $request->get('registrar')[$id],
                    'registrar_description' => $request->get('registrar_description')[$id],
                ]);
            }
        }
        if(strcasecmp(Auth::user()->role_as,'Accounting Assessment') == 0)
        {
            foreach ($ids as $id) {
                User::where('id',$id)->update([
                    'accounting_assessment' => $request->get('accounting_assessment')[$id],
                    'accounting_assessment_description' => $request->get('accounting_assessment_description')[$id],
                ]);
            }
        }
        return back()->with('success', 'student successfully updated');
    }

    public function edit_student($id)
    {
        $student_id = User::find($id);
        $course = Course::all();
        $department = Department::all();
        $approve_count = 0;
        $approve_total = 0;
        foreach($student_id->status as $status_count){
            if($status_count == "APPROVED"){
                $approve_count++;
            }
            if($status_count !== "APPROVED" || $status_count == "APPROVED"){
                $approve_total++;
            }
          
        }
        $pass_total_value =  $approve_count; 
        $pass_status_value = $approve_total;
        // echo  $pass_total_value;
        // echo $pass_status_value;
            $stats_count = 0;
            $total_stats = 0;
            $total_approved = 0;
            $passed_names = array();
            $passed_status = array();
            foreach ($student_id->student_signee_names as $signee_list)
            {
                $value = $signee_list; 
                array_push($passed_names, $value);
            }
            foreach ($student_id->status as $status_list)
            {
                $value = $status_list; 
                array_push($passed_status, $value);
            }
            foreach ($student_id->status as $loop => $status_list){
                    
                if(Auth::user()->name == $passed_names[$loop])
                {
                    if("APPROVED" == $passed_status[$loop])
                    {
                        $total_approved++;
                    }
                }
                if(Auth::user()->name == $passed_names[$loop])
                {
                    if(($passed_status[$loop] == "APPROVED") || ("IN-PROGRESS" == $passed_status[$loop]) || ("COMPLY" == $passed_status[$loop]) || ("REJECTED" == $passed_status[$loop]))
                    {
                        $total_stats++;
                    }
                }
                // else{
                //     $total_stats--;
                // } 
            }
            // print_r ($passed_names); 
        if((strcasecmp(Auth::user()->role_as, "Instructor") == 0))
        {
            // if(in_array(Auth::user()->name,$passed_names,TRUE))
            // {
            //     if((in_array("IN-PROGRESS",$passed_status)) || (in_array("COMPLY",$passed_status)) || (in_array("REJECTED",$passed_status)))
            //     {
            //     return view('signee.edit-student', compact('student_id','course','department'));
            //     }
            //     else
            //     { 
            //         return redirect('signee/view-signee-pending-request')->with('error', 'Unauthorized Action');  
            //     }  
            // }
            // else 
            // { 
            // return redirect('signee/view-signee-pending-request')->with('error', 'Unauthorized Action');  
            // }
            if($total_approved == $total_stats){
                return redirect('signee/view-signee-pending-request')->with('error', 'Unauthorized Action');  
            }
        }
        elseif(Auth::user()->dept_id !== $student_id->dept_id &&
        ((strcasecmp(Auth::user()->role_as, "Dean Principal") == 0) ||
        (strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') == 0))){
            return redirect('signee/view-signee-pending-request')->with('error', 'Unauthorized Action');
          }
        elseif((strcasecmp(Auth::user()->role_as,'Guidance Counselor') == 0) && ($student_id->guidance_councilor == "APPROVED")){
            return redirect('signee/view-signee-pending-request')->with('error', 'Unauthorized Action');
        }
        elseif((strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') == 0) && $student_id->student_org_treasurer == "APPROVED"){
            return redirect('signee/view-signee-pending-request')->with('error', 'Unauthorized Action');
        }
        elseif((strcasecmp(Auth::user()->role_as,'librarian') == 0) && ($pass_total_value !== $pass_status_value || $student_id->guidance_councilor !== "APPROVED" ||  $student_id->student_org_treasurer !== "APPROVED" || $student_id->librarian == "APPROVED")){
            return redirect('signee/view-signee-pending-request')->with('error', 'Unauthorized Action');
        }
        elseif((strcasecmp(Auth::user()->role_as,'Dean of Student Affair') == 0) && ($pass_total_value !== $pass_status_value || $student_id->guidance_councilor !== "APPROVED" ||  $student_id->student_org_treasurer !== "APPROVED" || $student_id->librarian !== "APPROVED" || $student_id->dean_of_student_affair == "APPROVED")){
            return redirect('signee/view-signee-pending-request')->with('error', 'Unauthorized Action');
        }
        elseif(Auth::user()->dept_id == $student_id->dept_id && (strcasecmp(Auth::user()->role_as, "Dean Principal") == 0) && ($pass_total_value !== $pass_status_value || $student_id->dean_principal == "APPROVED" || $student_id->librarian !== "APPROVED" || $student_id->guidance_councilor !== "APPROVED" || $student_id->dean_of_student_affair !== "APPROVED" || $student_id->student_org_treasurer !== "APPROVED")){
            return redirect('signee/view-signee-pending-request')->with('error', 'Unauthorized Action');
        }
        elseif((strcasecmp(Auth::user()->role_as,'Registrar') == 0) && ($pass_total_value !== $pass_status_value || $student_id->dean_principal !== "APPROVED" || $student_id->librarian !== "APPROVED" || $student_id->guidance_councilor !== "APPROVED" || $student_id->dean_of_student_affair !== "APPROVED" || $student_id->student_org_treasurer !== "APPROVED" || $student_id->registrar == "APPROVED")){
            return redirect('signee/view-signee-pending-request')->with('error', 'Unauthorized Action');
        }
        elseif((strcasecmp(Auth::user()->role_as,'Accounting Assessment') == 0) && ($pass_total_value !== $pass_status_value || $student_id->dean_principal !== "APPROVED" || $student_id->librarian !== "APPROVED" || $student_id->guidance_councilor !== "APPROVED" || $student_id->dean_of_student_affair !== "APPROVED" || $student_id->student_org_treasurer !== "APPROVED" || $student_id->registrar !== "APPROVED" || $student_id->accounting_assessment == "APPROVED" )){
            return redirect('signee/view-signee-pending-request')->with('error', 'Unauthorized Action');
        }
        return view('signee.edit-student', compact('student_id','course','department'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_student(Request $request, $id)
    {
       
        $this->validate($request, [
            
            'status' => 'required',
            'description' => 'required',
        
            'librarian' => 'required',
            'librarian_description' => 'nullable',

            'dean_of_student_affair' => 'required',
            'dean_of_student_affair' => 'nullable',

            'dean_principal' => 'required',
            'dean_principal_description' => 'nullable',

            'guidance_councilor' => 'required',
            'guidance_councilor_description' => 'nullable',

            'registrar' => 'required',
            'registrar_description' => 'nullable',

            'accounting_assessment' => 'required',
            'accounting_assessment_description' => 'nullable',
        ]);
        $student_id = User::find($id);
        $student_id->status = $request->get('status');
        $student_id->description = $request->get('description');

        $student_id->student_org_treasurer = $request->get('student_org_treasurer');
        $student_id->student_org_description = $request->get('student_org_description');

        $student_id->librarian = $request->get('librarian');
        $student_id->librarian_description = $request->get('librarian_description');
        
        $student_id->dean_of_student_affair = $request->get('dean_of_student_affair');
        $student_id->dean_of_student_affair_description = $request->get('dean_of_student_affair_description');

        $student_id->dean_principal = $request->get('dean_principal');
        $student_id->dean_principal_description = $request->get('dean_principal_description');

        $student_id->guidance_councilor = $request->get('guidance_councilor');
        $student_id->guidance_councilor_description = $request->get('guidance_councilor_description');

        $student_id->registrar = $request->get('registrar');
        $student_id->registrar_description = $request->get('registrar_description');

        $student_id->accounting_assessment = $request->get('accounting_assessment');
        $student_id->accounting_assessment_description = $request->get('accounting_assessment_description');
        $student_id->save();
        
        
        // Update User Student
       return redirect('/signee/view-signee-pending-request')->with('success', 'Student User Updated');
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
    public function instructor_search(Request $request)
    {
        $course = Course::all();
        $output1="";
        $student  = User::where('name','like','%'.$request->search.'%')->orwhere('school_id','%'.$request->search.'%')->get();
        // foreach($course as $course_list){
        //     if($course_list->id == $student->course){
        //         $course_list->
        //     } 
        // }
        if((strcasecmp(Auth::user()->role_as, "Instructor") == 0))
        { 
            foreach($student as $item)
            {   
                $stats_count = 0;
                $total_stats = 0;
                $total_approved = 0;
                $passed_names = array();
                $passed_status = array();
                foreach ($item->student_signee_names as $signee_list)
                {
                    $value = $signee_list; 
                    array_push($passed_names, $value);
                }
                foreach ($item->status as $status_list)
                {
                    $value = $status_list; 
                    array_push($passed_status, $value);
                }
                foreach ($item->status as $loop => $status_list){
                    
                    if(Auth::user()->name == $passed_names[$loop])
                    {
                        if("APPROVED" == $passed_status[$loop])
                        {
                            $total_approved++;
                        }
                    }
                    if(Auth::user()->name == $passed_names[$loop])
                    {
                        if(($passed_status[$loop] == "APPROVED") || ("IN-PROGRESS" == $passed_status[$loop]) || ("COMPLY" == $passed_status[$loop]) || ("REJECTED" == $passed_status[$loop]))
                        {
                            $total_stats++;
                        }
                    }
                }
                if($total_approved !== $total_stats)               
                {     
                    $output1.=
                        '<tr>
                        <td>'.$item->name.'</td>';
                    foreach($course as $course_list){
                        if($course_list->id == $item->course){
                            $output1.=
                                '<td>'.$course_list->course_acronym.'</td>';
                        }
                    }
                    $output1.=
                        '<td>'.$item->year_lvl.'</td>';
                        $output1.=
                        '<td>'.'<a href="'.url('/signee/edit-student/'.$item->id).'"><img class="edit"  src="'.asset('img/edit.png').'" alt="Italian Trulli"></a>'.'</td>                          
                        </tr>';
                }
            }
        }
        return response($output1);
    }
    public function guidance_counselor_search(Request $request)
    {
        $course = Course::all();
        $output2="";
        $student  = User::where('name','like','%'.$request->search.'%')->orwhere('school_id','%'.$request->search.'%')->get();
        if(strcasecmp(Auth::user()->role_as, "Guidance Counselor") == 0)
        { 
            foreach($student as $item)
            {
                if($item->guidance_councilor !== "APPROVED")
                {       
                    $output2.=
                        '<tr>
                        <td>'.$item->name.'</td>';
                    foreach($course as $course_list){
                        if($course_list->id == $item->course){
                            $output2.=
                                '<td>'.$course_list->course_acronym.'</td>';
                        }
                    }
                    $output2.=
                        '<td>'.$item->year_lvl.'</td>';
                        $output2.=
                        '<td>'.'<a href="'.url('/signee/edit-student/'.$item->id).'"><img class="edit"  src="'.asset('img/edit.png').'" alt="Italian Trulli"></a>'.'</td>                          
                        </tr>';
                }
            }
        }
        return response($output2);
    }
    public function student_org_search(Request $request)
    {
        $course = Course::all();
        $output3="";
        $student  = User::where('name','like','%'.$request->search.'%')->orwhere('school_id','%'.$request->search.'%')->get();
        // foreach($course as $course_list){
        //     if($course_list->id == $student->course){
        //         $course_list->
        //     } 
        // }
        if((strcasecmp(Auth::user()->role_as, "Student Org. Treasurer") == 0))
        { 
            foreach($student as $item)
            {
                if(Auth::user()->dept_id == $item->dept_id && $item->student_org_treasurer !== "APPROVED")
                {       
                    $output3.=
                        '<tr>
                        <td>'.$item->name.'</td>';
                    foreach($course as $course_list){
                        if($course_list->id == $item->course){
                            $output3.=
                                '<td>'.$course_list->course_acronym.'</td>';
                        }
                    }
                    $output3.=
                        '<td>'.$item->year_lvl.'</td>';
                        $output3.=
                        '<td>'.'<a href="'.url('/signee/edit-student/'.$item->id).'"><img class="edit"  src="'.asset('img/edit.png').'" alt="Italian Trulli"></a>'.'</td>                          
                        </tr>';
                }
            }
        }
        return response($output3);
    }
    public function librarian_search(Request $request)
    {
        $course = Course::all();
        $output4="";
        $student  = User::where('name','like','%'.$request->search.'%')->orwhere('school_id','%'.$request->search.'%')->get();
        if(strcasecmp(Auth::user()->role_as, "Librarian") == 0)
        { 
            foreach($student as $item)
            {
                $approve_count = 0;
                $approve_total = 0;
                foreach($item->status as $status_count)
                {
                    if($status_count == "APPROVED")
                    {
                        $approve_count++;
                    }
                    if($status_count !== "APPROVED" || $status_count == "APPROVED")
                    {
                        $approve_total++;
                    }
                }
                $pass_total_value =  $approve_count;
                $pass_status_value = $approve_total;
                if($pass_total_value == $pass_status_value)
                {
                    if($item->librarian !== "APPROVED" &&  $item->guidance_councilor == "APPROVED" && $item->student_org_treasurer == "APPROVED")
                    {       
                        $output4.=
                            '<tr>
                            <td>'.$item->name.'</td>';
                        foreach($course as $course_list){
                            if($course_list->id == $item->course){
                                $output4.=
                                    '<td>'.$course_list->course_acronym.'</td>';
                            }
                        }
                        $output4.=
                            '<td>'.$item->year_lvl.'</td>';
                            $output4.=
                            '<td>'.'<a href="'.url('/signee/edit-student/'.$item->id).'"><img class="edit"  src="'.asset('img/edit.png').'" alt="Italian Trulli"></a>'.'</td>                          
                            </tr>';
                    }
                }
            }
        }
        return response($output4);
    }
    public function student_affair_search(Request $request)
    {
        $course = Course::all();
        $output5="";
        $student  = User::where('name','like','%'.$request->search.'%')->orwhere('school_id','%'.$request->search.'%')->get();
        if(strcasecmp(Auth::user()->role_as, "Dean of Student Affair") == 0)
        { 
            foreach($student as $item)
            {
                $approve_count = 0;
                $approve_total = 0;
                foreach($item->status as $status_count)
                {
                    if($status_count == "APPROVED")
                    {
                        $approve_count++;
                    }
                    if($status_count !== "APPROVED" || $status_count == "APPROVED")
                    {
                        $approve_total++;
                    }
                }
                $pass_total_value =  $approve_count;
                $pass_status_value = $approve_total;
                if($pass_total_value == $pass_status_value)
                {
                    if($item->dean_of_student_affair !== "APPROVED" && $item->librarian == "APPROVED" &&  $item->guidance_councilor == "APPROVED" && $item->student_org_treasurer == "APPROVED")
                    {       
                        $output5.=
                            '<tr>
                            <td>'.$item->name.'</td>';
                        foreach($course as $course_list){
                            if($course_list->id == $item->course){
                                $output5.=
                                    '<td>'.$course_list->course_acronym.'</td>';
                            }
                        }
                        $output5.=
                            '<td>'.$item->year_lvl.'</td>';
                            $output5.=
                            '<td>'.'<a href="'.url('/signee/edit-student/'.$item->id).'"><img class="edit"  src="'.asset('img/edit.png').'" alt="Italian Trulli"></a>'.'</td>                          
                            </tr>';
                    }
                }
            }
        }
        return response($output5);
    }
    public function dean_principal_search(Request $request)
    {
        $course = Course::all();
        $output6="";
        $student  = User::where('name','like','%'.$request->search.'%')->orwhere('school_id','%'.$request->search.'%')->get();
        if(strcasecmp(Auth::user()->role_as, "Dean Principal") == 0)
        { 
            foreach($student as $item)
            {
                if(Auth::user()->dept_id == $item->dept_id)
                {
                    $approve_count = 0;
                    $approve_total = 0;
                    foreach($item->status as $status_count)
                    {
                        if($status_count == "APPROVED")
                        {
                            $approve_count++;
                        }
                        if($status_count !== "APPROVED" || $status_count == "APPROVED")
                        {
                            $approve_total++;
                        }
                    }
                    $pass_total_value =  $approve_count;
                    $pass_status_value = $approve_total;
                    if($pass_total_value == $pass_status_value)
                    {
                        if($item->dean_principal !== "APPROVED" && $item->dean_of_student_affair == "APPROVED" && $item->librarian == "APPROVED" &&  $item->guidance_councilor == "APPROVED" && $item->student_org_treasurer == "APPROVED")
                        {       
                            $output6.=
                                '<tr>
                                <td>'.$item->name.'</td>';
                            foreach($course as $course_list)
                            {
                                if($course_list->id == $item->course)
                                {
                                    $output6.=
                                        '<td>'.$course_list->course_acronym.'</td>';
                                }
                            }
                            $output6.=
                                '<td>'.$item->year_lvl.'</td>';
                                $output6.=
                                '<td>'.'<a href="'.url('/signee/edit-student/'.$item->id).'"><img class="edit"  src="'.asset('img/edit.png').'" alt="Italian Trulli"></a>'.'</td>                          
                                </tr>';
                        }
                    }
                }
            }
        }
    return response($output6);
    }
    public function registrar_search(Request $request)
    {
        $course = Course::all();
        $output7="";
        $student  = User::where('name','like','%'.$request->search.'%')->orwhere('school_id','%'.$request->search.'%')->get();
        if(strcasecmp(Auth::user()->role_as, "Registrar") == 0)
        { 
            foreach($student as $item)
            {
                $approve_count = 0;
                $approve_total = 0;
                foreach($item->status as $status_count)
                {
                    if($status_count == "APPROVED")
                    {
                        $approve_count++;
                    }
                    if($status_count !== "APPROVED" || $status_count == "APPROVED")
                    {
                        $approve_total++;
                    }
                }
                $pass_total_value =  $approve_count;
                $pass_status_value = $approve_total;
                if($pass_total_value == $pass_status_value)
                {
                    if($item->registrar !== "APPROVED" && $item->dean_principal == "APPROVED" && $item->dean_of_student_affair == "APPROVED" && $item->librarian == "APPROVED" &&  $item->guidance_councilor == "APPROVED" && $item->student_org_treasurer == "APPROVED")
                    {       
                        $output7.=
                            '<tr>
                            <td>'.$item->name.'</td>';
                        foreach($course as $course_list)
                        {
                            if($course_list->id == $item->course)
                            {
                                $output7.=
                                    '<td>'.$course_list->course_acronym.'</td>';
                            }
                        }
                        $output7.=
                            '<td>'.$item->year_lvl.'</td>';
                            $output7.=
                            '<td>'.'<a href="'.url('/signee/edit-student/'.$item->id).'"><img class="edit"  src="'.asset('img/edit.png').'" alt="Italian Trulli"></a>'.'</td>                          
                            </tr>';
                    }
                }
            }
        }
    return response($output7);
    }
    public function assessment_search(Request $request)
    {
        $course = Course::all();
        $output8="";
        $student  = User::where('name','like','%'.$request->search.'%')->orwhere('school_id','%'.$request->search.'%')->get();
        if(strcasecmp(Auth::user()->role_as, "Accounting Assessment") == 0)
        { 
            foreach($student as $item)
            { 
                $approve_count = 0;
                $approve_total = 0;
                foreach($item->status as $status_count)
                {
                    if($status_count == "APPROVED")
                    {
                        $approve_count++;
                    }
                    if($status_count !== "APPROVED" || $status_count == "APPROVED")
                    {
                        $approve_total++;
                    }
                }
                $pass_total_value =  $approve_count;
                $pass_status_value = $approve_total;
                if($pass_total_value == $pass_status_value)
                {
                    if($item->accounting_assessment !=="APPROVED" && $item->registrar == "APPROVED" && $item->dean_principal == "APPROVED" && $item->dean_of_student_affair == "APPROVED" && $item->librarian == "APPROVED" &&  $item->guidance_councilor == "APPROVED" && $item->student_org_treasurer == "APPROVED")
                    {       
                        $output8.=
                            '<tr>
                            <td>'.$item->name.'</td>';
                        foreach($course as $course_list)
                        {
                            if($course_list->id == $item->course)
                            {
                                $output8.=
                                    '<td>'.$course_list->course_acronym.'</td>';
                            }
                        }
                        $output8.=
                            '<td>'.$item->year_lvl.'</td>';
                            $output8.=
                            '<td>'.'<a href="'.url('/signee/edit-student/'.$item->id).'"><img class="edit"  src="'.asset('img/edit.png').'" alt="Italian Trulli"></a>'.'</td>                          
                            </tr>';
                    }
                }
            }
        }
    return response($output8);
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
        // $course = Course::all();
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
    public function check(Request $request)
    { 
        $key = "login.".$request->ip();
        $retries = RateLimiter::retriesLeft($key, 3);
        $request->validate([
            // 'email' => 'required|exists:users,email',
            'password' => 'required|min:8', 
            'school_id' => 'required|string|max:255|exists:signees,school_id'
        ],[
        'school_id.exists'=>'This Account do not exist'
         ]);
        $remember_me = $request->has('remember') ? true : false; 
        $creds = $request->only('school_id','password');
        if(Auth::guard('signee')->attempt($creds,$remember_me)){
            return redirect ('signee/signeedashboard')->with('success', 'Logged In as Signee Successful');
        }else{
            return redirect()->route('signee.signee_login')->with('fail','Incorrect Credential, You Have '.$retries.' Attempt Left');
        }
    }
    public function signee_logout(Request $request) {
        Auth::logout();
        return redirect()->route('signee.signeedashboard');
    }

}
