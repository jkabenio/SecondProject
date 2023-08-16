@extends('layouts.signee-app')

@section('content')



<style>

  
    * {
        box-sizing: border-box;
    }
    
    /* Create three equal columns that floats next to each other */
    .column {
        float: left;
        width: 20%;
        height: auto;
        background-color: #e9ecef;
       
    }
    .general_signee_column {
        float: left;
        width: 50%;
        height: auto;
        background-color: #e9ecef;
    }
    
    /* Clear floats after the columns */
    /* .clearance_row:after {
        content: "";
        display: table;
        clear: both;
    } */
    .clearance_row{
        float:right;
        margin-right: 1px;
        height: auto;
        margin-bottom: 20px;
        width: 100% !important;
    }
    p{
        white-space: nowrap; 
        width: auto;
        height: auto; 
        overflow: hidden;
        text-overflow: clip;
        text-align: center;
 
    }
    .signee-description-form-popup {
        display: none;
        position: fixed;
        bottom: 50%;
        right:25%;
        left: 25%;
        border: 3px solid #0800ff;
        z-index: 9;
        background-color: rgb(212, 212, 212);
        width: 50%;
        height: 20%;
        margin-bottom: auto;
      }
      
      /* Add styles to the form container */
      .form-container-activity {
        
        margin: auto !important;
      width: 300px !important;
      height: 300px !important;
      overflow: auto !important;
      /* way to prevent an element from scrolling its parent. */
      overscroll-behavior: contain;
      }
      
      /* Set a style for the submit/login button */
      .form-container-activity .btn_cancel {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom:10px;
        opacity: 0.8;
      }
      
      /* Add a red background color to the cancel button */
      .form-container-activity .cancel {
        background-color: red;
        width: 50px;
        font-size: 12px;
        height: 24px;
        padding-top: 2px;
        margin-top: 0px;
        margin-bottom: 0px;
        border-radius: 0px;
        margin-left: 250px;
        /* position: fixed; */
      }
    .signee_close_btn{
        float: right;
        background-color: red;
        color: white;
    }
      /* Add some hover effects to buttons */
    .form-container-activity .btn_cancel:hover, .open-button:hover {
        opacity: 1;
    } 
      .btn.cancel{
        background-color: red;
        color: white;
      }
      .signee_description_info{
        height: 100%;
        width: 100%;
      }
select[readonly]
{
    pointer-events: none;
}
/* irrelevent styling */
*[readonly]
{

}
.signee_quick_view_title{
    background-color: rgb(4, 4, 181);
     color: white;
     text-align: center;
     margin-top: 1px;
     padding-top: 10px;
     height: 50px;
     /* border:solid 3px black; */
}
.scroll_div {
        margin-top: 10px;
        margin-bottom: 10px;
        width: 100%;
        height: 400px;
        overflow-x: hidden;
        overflow-y: auto;
        text-align: center;
         border: solid rgb(4, 4, 181) 3px;
      }
</style>


 
 

<h4 class="signee_quick_view_title"><b>Student List</b></h4>
@if (session('success'))
    <div style="text-align:center"  class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div style="text-align:center"  class="alert alert-danger">{{ session('error') }}</div>
@endif
<form action="{{ route('signee.quick-view-request') }}" method="GET">
    {{csrf_field()}}
    @php
        $result = "";
        $id_val = 0;
    @endphp
    @foreach ($course as $item)
        @if(Request::get('course') == $item->id)
        @php
        $result = $item->course_acronym;
        $id_val =  $item->id;
    @endphp
        @endif
    @endforeach
    <div class="row">
        <div class="col-md-2 col-3">
            <select name="course" class="form-control">
                @if(Request::get('course') == null)
                    <option value="">All Course</option>
                @endif
                @if(Request::get('course') !== null)
                    <option value="{{$id_val}}" {{Request::get('course')}}>{{$result}}</option>
                @endif
                @if(Request::get('course') !== null)
                <option value="">All Course</option>
            @endif
                @foreach ($course as $item)
                    @if($item->id !== $id_val)
                        <option  value="{{$item->id}}" {{Request::get('course') == 'course' ? 'selected':''}}>{{$item->course_acronym}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-3">
            <select name="year_lvl"  class="form-control">
                <option value="">All Level</option>
                <option value="1st Year" {{Request::get('year_lvl') == '1st Year' ? 'selected':''}}>1st Year</option>
                <option value="2nd Year" {{Request::get('year_lvl') == '2nd Year' ? 'selected':''}}>2nd Year</option>
                <option value="3rd Year" {{Request::get('year_lvl') == '3rd Year' ? 'selected':''}}>3rd Year</option>
                <option value="4th Year" {{Request::get('year_lvl') == '4th Year' ? 'selected':''}}>4th Year</option>
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-success quick_signee_filter_btn">Filter</button>
        </div>
    </div>
</form>
<form action="{{ route('signee.update-multiple-student') }}" method="POST">
    <button type="submit" class="btn btn-primary quick_signee_update_btn">Update User</button>
    {{csrf_field()}}
    @method('PUT')
    <div class="scroll_div">  
        @foreach($student as $index_count => $user)

        @php
        $approve_count = 0;
        $approve_total = 0;
       
        foreach($user->status as $status_count)
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
            // print_r ($pass_total_value);
    @endphp
            @if(strcasecmp(Auth::user()->role_as, "Instructor") == 0)
                @php
                    $stats_count = 0;
                    $total_stats = 0;
                    $total_approved = 0;
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
                    // print_r ($total_approved);
                    // print_r ($total_stats);
                @endphp
                @if($total_approved !== $total_stats) 
                    {{-- @if((in_array("IN-PROGRESS",$passed_status)) || (in_array("COMPLY",$passed_status)) || (in_array("REJECTED",$passed_status))) --}}
                        <div class="clearance_body"> 
                            <div class="clearance_row">
                                @foreach($course as $course_list)
                                    @if($user->course == $course_list->id)
                                    <h5 class="quick_view_table_content_header" style="text-align:center; background-color: blue; color:white"><b>{{$user->name}} ({{$course_list->course_acronym}}-{{$user->year_lvl}}) E-Clearance</b></h5>
                                    @endif
                                @endforeach
                                <p  style="margin: 0px; padding:0px;text-align: left"><input type="checkbox" id="id[{{$user->id}}]" name="id[{{$user->id}}]" value="{{$user->id}}" ></p>
                                <div class="column" >
                                    <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Instructor</b></h5>     
                                        @foreach ($user->student_signee_names as $signee)
                                            <div style="border: 1px solid #000000">
                                                <p class="table_content">{{$signee}}</p>
                                            </div>
                                        @endforeach    
                                </div>
                                <div class="column">
                                    <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Subject</b></h5>
                                    
                                        @foreach ($user->subjects as $subject_list)
                                            <div style="border: 1px solid #000000"> 
                                                <p class="table_content">{{$subject_list}}</p>
                                            </div>
                                        @endforeach
                                </div>
                                <div class="column" >
                                    <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Section</b></h5>
                                    
                                        @foreach ($user->student_section as $section_list)
                                            <div style="border: 1px solid #000000"> 
                                                <p class="table_content" style="text-align:center;">{{$section_list}}</p>
                                            </div>
                                        @endforeach
                                </div>
                                <div class="column" >
                                    <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Status</b></h5>
                                    @foreach ($user->status as $count_data => $status_list) 
                                        <div style="border: 1px solid #000000">  
                                            <p  class="table_content" style="text-align:center">
                                                @if($status_list == "IN-PROGRESS" && Auth::user()->name == $passed_names[$count_data])
                                                    <select class="table_content_select" name="status[{{$user->id}}][]" onchange="OnChangeHandler({{$user->id}})" style="color:blue">
                                                @endif
                                                @if($status_list == "COMPLY" && Auth::user()->name == $passed_names[$count_data])
                                                    <select class="table_content_select" name="status[{{$user->id}}][]" onchange="OnChangeHandler({{$user->id}})" style="color:orange">
                                                @endif
                                                @if($status_list == "REJECTED" && Auth::user()->name == $passed_names[$count_data])
                                                    <select class="table_content_select" name="status[{{$user->id}}][]" onchange="OnChangeHandler({{$user->id}})" style="color:red">
                                                @endif
                                                @if($status_list == "APPROVED" && Auth::user()->name == $passed_names[$count_data])
                                                    <select class="table_content_select" name="status[{{$user->id}}][]" onchange="OnChangeHandler({{$user->id}})" style="color:green">
                                                @endif

                                                @if($status_list == "IN-PROGRESS" &&  Auth::user()->name !== $passed_names[$count_data])
                                                <select class="table_content_select" name="status[{{$user->id}}][]" style="color:blue" readonly tabindex="-1">
                                                @endif
                                                @if($status_list == "COMPLY" &&  Auth::user()->name !== $passed_names[$count_data])
                                                    <select class="table_content_select" name="status[{{$user->id}}][]" style="color:orange" readonly tabindex="-1">
                                                @endif
                                                @if($status_list == "REJECTED" &&  Auth::user()->name !== $passed_names[$count_data])
                                                    <select class="table_content_select" name="status[{{$user->id}}][]" style="color:red" readonly tabindex="-1">
                                                @endif
                                                @if($status_list == "APPROVED" &&  Auth::user()->name !== $passed_names[$count_data]) 
                                                    <select class="table_content_select" name="status[{{$user->id}}][]" style="color:green" readonly tabindex="-1">
                                                @endif
                                            
                                                <option style="text-align:center" value="{{$status_list}}">{{$status_list}}</option>

                                                @if($status_list !== "IN-PROGRESS")
                                                    <option style="text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                                @endif
                                                @if($status_list !== "COMPLY")
                                                    <option style="text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                                @endif
                                                @if($status_list !== "APPROVED")
                                                    <option style="text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                                @endif
                                                @if($status_list !== "REJECTED")
                                                    <option style="text-align:center; color:red"value="REJECTED">REJECTED</option>
                                                @endif
                                                </select>
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="column" >
                                    <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Description</b></h5>
                                        @foreach ($user->description as $index => $description_list)
                                            <div style="border: 1px solid #000000;">
                                                @if(Auth::user()->name !== $passed_names[$index])
                                                    <p class="table_content" style="text-align:center;"><a style="color:red">Restricted!</a></p>
                                                @endif
                                                @if((Auth::user()->name == $passed_names[$index]) && ($description_list == null))
                                                    <p class="table_content" style= "text-align:center;"><a onclick="opensigneeForm({{$index}},{{$user->id}})">Add Detail</a></p>
                                                @endif
                                                @if((Auth::user()->name == $passed_names[$index]) && ($description_list !== null))
                                                    <p class="table_content" style="text-align:center;"><a onclick="opensigneeForm({{$index}},{{$user->id}})">View Detail</a></p>
                                                @endif  
                                            </div>
                                            <div class="signee-description-form-popup" id="signeeForm-{{$index}}-{{$user->id}}">
                                                <textarea class="signee_description_info" name="description[{{$user->id}}][]" onchange="OnChangeHandler({{$user->id}})" value="{{$description_list}}">{{$description_list}}</textarea>
                                                <button type="button" class="btn cancel" onclick="closesigneeForm({{$index}},{{$user->id}})">Close</button>  
                                            </div>
                                        @endforeach     
                                </div>
                            </div> 
                        </div>
                    {{-- @endif --}}
                @endif
            @endif
            @if(strcasecmp(Auth::user()->role_as, "Guidance Counselor") == 0)
                @if($user->guidance_councilor !== "APPROVED")
                    <div class="clearance_body"> 
                        <div class="clearance_row">
                            @foreach($course as $course_list)
                                @if($user->course == $course_list->id)
                                <h5 class="quick_view_table_content_header" style="text-align:center; background-color: blue; color:white"><b>{{$user->name}} ({{$course_list->course_acronym}}-{{$user->year_lvl}}) E-Clearance</b></h5>
                                @endif
                            @endforeach
                            <p  style="margin: 0px; padding:0px;text-align: left"><input type="checkbox" id="id[{{$user->id}}]" name="id[{{$user->id}}]" value="{{$user->id}}" ></p>
                            <div class="general_signee_column" >
                                <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Status</b></h5>
                                    <div style="border: 1px solid #000000">  
                                        <p  class="table_content" style="text-align:center">
                                            @if($user->guidance_councilor == "IN-PROGRESS")
                                                <select class="table_content_select" name="guidance_councilor[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:blue">
                                            @endif
                                            @if($user->guidance_councilor == "COMPLY")
                                                <select class="table_content_select" name="guidance_councilor[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:orange">
                                            @endif
                                            @if($user->guidance_councilor == "REJECTED")
                                                <select class="table_content_select" name="guidance_councilor[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:red">
                                            @endif
                                            @if($user->guidance_councilor == "APPROVED")
                                                <select class="table_content_select" name="guidance_councilor[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:green">
                                            @endif
                                        
                                                <option style="text-align:center" value="{{$user->guidance_councilor}}">{{$user->guidance_councilor}}</option>

                                                @if($user->guidance_councilor !== "IN-PROGRESS")
                                                    <option style="text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                                @endif
                                                @if($user->guidance_councilor !== "COMPLY")
                                                    <option style="text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                                @endif
                                                @if($user->guidance_councilor !== "APPROVED")
                                                    <option style="text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                                @endif
                                                @if($user->guidance_councilor !== "REJECTED")
                                                    <option style="text-align:center; color:red"value="REJECTED">REJECTED</option>
                                                @endif
                                            </select>
                                        </p> 
                                    </div>
                            </div>
                            <div class="general_signee_column" >
                                <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Description</b></h5>
                                <div style="border: 1px solid #000000;">
                                    @if($user->guidance_councilor_description == null)
                                        <p class="table_content" style= "text-align:center;"><a onclick="open_guidance_councilor_Form({{$index_count}},{{$user->id}})">Add Details</a></p>
                                    @endif
                                    @if($user->guidance_councilor_description == !null)
                                    <p class="table_content" style= "text-align:center;"><a onclick="open_guidance_councilor_Form({{$index_count}},{{$user->id}})">View Details</a></p>
                                @endif 
                                </div>
                                <div class="signee-description-form-popup" id="guidance_councilor_form-{{$index_count}}-{{$user->id}}">
                                    <textarea class="signee_description_info" name="guidance_councilor_description[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" value="{{$user->guidance_councilor_description }}">{{$user->guidance_councilor_description }}</textarea>
                                    <button type="button" class="btn cancel" onclick="close_guidance_councilor_Form({{$index_count}},{{$user->id}})">Close</button>  
                                </div>   
                            </div>
                        </div> 
                    </div>
                @endif
            @endif
            @if(strcasecmp(Auth::user()->role_as, "Student Org. Treasurer") == 0)
                @if($user->student_org_treasurer !== "APPROVED")
                    @if(Auth::user()->dept_id == $user->dept_id)
                        <div class="clearance_body"> 
                            <div class="clearance_row">
                                @foreach($course as $course_list)
                                    @if($user->course == $course_list->id)
                                    <h5 class="quick_view_table_content_header" style="text-align:center; background-color: blue; color:white"><b>{{$user->name}} ({{$course_list->course_acronym}}-{{$user->year_lvl}}) E-Clearance</b></h5>
                                    @endif
                                @endforeach
                                <p  style="margin: 0px; padding:0px;text-align: left"><input type="checkbox" id="id[{{$user->id}}]" name="id[{{$user->id}}]" value="{{$user->id}}" ></p>
                                <div class="general_signee_column" >
                                    <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Status</b></h5>
                                        <div style="border: 1px solid #000000">  
                                            <p  class="table_content" style="text-align:center">
                                                @if($user->student_org_treasurer == "IN-PROGRESS")
                                                    <select class="table_content_select" name="student_org_treasurer[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:blue">
                                                @endif
                                                @if($user->student_org_treasurer == "COMPLY")
                                                    <select class="table_content_select" name="student_org_treasurer[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:orange">
                                                @endif
                                                @if($user->student_org_treasurer == "REJECTED")
                                                    <select class="table_content_select" name="student_org_treasurer[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:red">
                                                @endif
                                                @if($user->student_org_treasurer == "APPROVED")
                                                    <select class="table_content_select" name="student_org_treasurer[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:green">
                                                @endif
                                             
                                                    <option style="text-align:center" value="{{$user->student_org_treasurer}}">{{$user->student_org_treasurer}}</option>

                                                    @if($user->student_org_treasurer !== "IN-PROGRESS")
                                                        <option style="text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                                    @endif
                                                    @if($user->student_org_treasurer !== "COMPLY")
                                                        <option style="text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                                    @endif
                                                    @if($user->student_org_treasurer !== "APPROVED")
                                                        <option style="text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                                    @endif
                                                    @if($user->student_org_treasurer !== "REJECTED")
                                                        <option style="text-align:center; color:red"value="REJECTED">REJECTED</option>
                                                    @endif
                                                </select>
                                            </p> 
                                        </div>
                                </div>
                                <div class="general_signee_column" >
                                    <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Description</b></h5>
                                    <div style="border: 1px solid #000000;">
                                        @if($user->student_org_description == null)
                                            <p class="table_content" style= "text-align:center;"><a onclick="open_treasurer_Form({{$index_count}},{{$user->id}})">Add Details</a></p>
                                        @endif
                                        @if($user->student_org_description == !null)
                                        <p class="table_content" style= "text-align:center;"><a onclick="open_treasurer_Form({{$index_count}},{{$user->id}})">View Details</a></p>
                                    @endif 
                                    </div>
                                    <div class="signee-description-form-popup" id="student_org-{{$index_count}}-{{$user->id}}">
                                        <textarea class="signee_description_info" name="student_org_description[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" value="{{$user->student_org_description }}">{{$user->student_org_description }}</textarea>
                                        <button type="button" class="btn cancel" onclick="close_treasurer_Form({{$index_count}},{{$user->id}})">Close</button>  
                                    </div>   
                                </div>
                            </div> 
                        </div>
                    @endif
                @endif
            @endif
            @if(strcasecmp(Auth::user()->role_as, "Librarian") == 0)
                @if($user->librarian !== "APPROVED"&&
                $user->student_org_treasurer == "APPROVED" &&
                $user->guidance_councilor == "APPROVED" &&
                $pass_total_value == $pass_status_value)
                    <div class="clearance_body"> 
                        <div class="clearance_row">
                            @foreach($course as $course_list)
                                @if($user->course == $course_list->id)
                                <h5 class="quick_view_table_content_header" style="text-align:center; background-color: blue; color:white"><b>{{$user->name}} ({{$course_list->course_acronym}}-{{$user->year_lvl}}) E-Clearance</b></h5>
                                @endif
                            @endforeach
                            <p  style="margin: 0px; padding:0px;text-align: left"><input type="checkbox" id="id[{{$user->id}}]" name="id[{{$user->id}}]" value="{{$user->id}}" ></p>
                            <div class="general_signee_column" >
                                <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Status</b></h5>
                                    <div style="border: 1px solid #000000">  
                                        <p  class="table_content" style="text-align:center">
                                            @if($user->librarian == "IN-PROGRESS")
                                                <select class="table_content_select" name="librarian[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:blue">
                                            @endif
                                            @if($user->librarian == "COMPLY")
                                                <select class="table_content_select" name="librarian[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:orange">
                                            @endif
                                            @if($user->librarian == "REJECTED")
                                                <select class="table_content_select" name="librarian[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:red">
                                            @endif
                                            @if($user->librarian == "APPROVED")
                                                <select class="table_content_select" name="librarian[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:green">
                                            @endif
                                        
                                                <option style="text-align:center" value="{{$user->librarian}}">{{$user->librarian}}</option>

                                                @if($user->librarian !== "IN-PROGRESS")
                                                    <option style="text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                                @endif
                                                @if($user->librarian !== "COMPLY")
                                                    <option style="text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                                @endif
                                                @if($user->librarian !== "APPROVED")
                                                    <option style="text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                                @endif
                                                @if($user->librarian !== "REJECTED")
                                                    <option style="text-align:center; color:red"value="REJECTED">REJECTED</option>
                                                @endif
                                            </select>
                                        </p> 
                                    </div>
                            </div>
                            <div class="general_signee_column" >
                                <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Description</b></h5>
                                <div style="border: 1px solid #000000;">
                                    @if($user->librarian_description == null)
                                        <p class="table_content" style= "text-align:center;"><a onclick="open_librarian_Form({{$index_count}},{{$user->id}})">Add Details</a></p>
                                    @endif
                                    @if($user->librarian_description == !null)
                                    <p class="table_content" style= "text-align:center;"><a onclick="open_librarian_Form({{$index_count}},{{$user->id}})">View Details</a></p>
                                @endif 
                                </div>
                                <div class="signee-description-form-popup" id="librarian_form-{{$index_count}}-{{$user->id}}">
                                    <textarea class="signee_description_info" name="librarian_description[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" value="{{$user->librarian_description }}">{{$user->librarian_description }}</textarea>
                                    <button type="button" class="btn cancel" onclick="close_librarian_Form({{$index_count}},{{$user->id}})">Close</button>  
                                </div>   
                            </div>
                        </div> 
                    </div>
                @endif
            @endif
            @if(strcasecmp(Auth::user()->role_as, "Dean of Student Affair") == 0)
                @if($user->dean_of_student_affair !== "APPROVED"&&
                $user->librarian == "APPROVED" &&
                $user->student_org_treasurer == "APPROVED" &&
                $user->guidance_councilor == "APPROVED" &&
                $pass_total_value == $pass_status_value)
                    <div class="clearance_body"> 
                        <div class="clearance_row">
                            @foreach($course as $course_list)
                                @if($user->course == $course_list->id)
                                <h5 class="quick_view_table_content_header" style="text-align:center; background-color: blue; color:white"><b>{{$user->name}} ({{$course_list->course_acronym}}-{{$user->year_lvl}}) E-Clearance</b></h5>
                                @endif
                            @endforeach
                            <p  style="margin: 0px; padding:0px;text-align: left"><input type="checkbox" id="id[{{$user->id}}]" name="id[{{$user->id}}]" value="{{$user->id}}" ></p>
                            <div class="general_signee_column" >
                                <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Status</b></h5>
                                    <div style="border: 1px solid #000000">  
                                        <p  class="table_content" style="text-align:center">
                                            @if($user->dean_of_student_affair == "IN-PROGRESS")
                                                <select class="table_content_select" name="dean_of_student_affair[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:blue">
                                            @endif
                                            @if($user->dean_of_student_affair == "COMPLY")
                                                <select class="table_content_select" name="dean_of_student_affair[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:orange">
                                            @endif
                                            @if($user->dean_of_student_affair == "REJECTED")
                                                <select class="table_content_select" name="dean_of_student_affair[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:red">
                                            @endif
                                            @if($user->dean_of_student_affair == "APPROVED")
                                                <select class="table_content_select" name="dean_of_student_affair[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:green">
                                            @endif
                                        
                                                <option style="text-align:center" value="{{$user->dean_of_student_affair}}">{{$user->dean_of_student_affair}}</option>

                                                @if($user->dean_of_student_affair !== "IN-PROGRESS")
                                                    <option style="text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                                @endif
                                                @if($user->dean_of_student_affair !== "COMPLY")
                                                    <option style="text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                                @endif
                                                @if($user->dean_of_student_affair !== "APPROVED")
                                                    <option style="text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                                @endif
                                                @if($user->dean_of_student_affair !== "REJECTED")
                                                    <option style="text-align:center; color:red"value="REJECTED">REJECTED</option>
                                                @endif
                                            </select>
                                        </p> 
                                    </div>
                            </div>
                            <div class="general_signee_column" >
                                <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Description</b></h5>
                                <div style="border: 1px solid #000000;">
                                    @if($user->dean_of_student_affair_description == null)
                                        <p class="table_content" style= "text-align:center;"><a onclick="open_studentaffair_Form({{$index_count}},{{$user->id}})">Add Details</a></p>
                                    @endif
                                    @if($user->dean_of_student_affair_description == !null)
                                    <p class="table_content" style= "text-align:center;"><a onclick="open_studentaffair_Form({{$index_count}},{{$user->id}})">View Details</a></p>
                                @endif 
                                </div>
                                <div class="signee-description-form-popup" id="studentaffair_form-{{$index_count}}-{{$user->id}}">
                                    <textarea class="signee_description_info" name="dean_of_student_affair_description[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" value="{{$user->dean_of_student_affair_description }}">{{$user->dean_of_student_affair_description }}</textarea>
                                    <button type="button" class="btn cancel" onclick="close_studentaffair_Form({{$index_count}},{{$user->id}})">Close</button>  
                                </div>   
                            </div>
                        </div> 
                    </div>
                @endif
            @endif
            @if(strcasecmp(Auth::user()->role_as, "Dean Principal") == 0)
                @if($user->dean_principal !== "APPROVED" &&
                $user->dean_of_student_affair == "APPROVED" &&
                $user->librarian == "APPROVED" &&
                $user->student_org_treasurer == "APPROVED" &&
                $user->guidance_councilor == "APPROVED" &&
                $pass_total_value == $pass_status_value)
                    @if(Auth::user()->dept_id == $user->dept_id)
                        <div class="clearance_body"> 
                            <div class="clearance_row">
                                @foreach($course as $course_list)
                                    @if($user->course == $course_list->id)
                                    <h5 class="quick_view_table_content_header" style="text-align:center; background-color: blue; color:white"><b>{{$user->name}} ({{$course_list->course_acronym}}-{{$user->year_lvl}}) E-Clearance</b></h5>
                                    @endif
                                @endforeach
                                <p  style="margin: 0px; padding:0px;text-align: left"><input type="checkbox" id="id[{{$user->id}}]" name="id[{{$user->id}}]" value="{{$user->id}}" ></p>
                                <div class="general_signee_column" >
                                    <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Status</b></h5>
                                        <div style="border: 1px solid #000000">  
                                            <p  class="table_content" style="text-align:center">
                                                @if($user->dean_principal == "IN-PROGRESS")
                                                    <select class="table_content_select" name="dean_principal[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:blue">
                                                @endif
                                                @if($user->dean_principal == "COMPLY")
                                                    <select class="table_content_select" name="dean_principal[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:orange">
                                                @endif
                                                @if($user->dean_principal == "REJECTED")
                                                    <select class="table_content_select" name="dean_principal[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:red">
                                                @endif
                                                @if($user->dean_principal == "APPROVED")
                                                    <select class="table_content_select" name="dean_principal[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:green">
                                                @endif
                                            
                                                    <option style="text-align:center" value="{{$user->dean_principal}}">{{$user->dean_principal}}</option>

                                                    @if($user->dean_principal !== "IN-PROGRESS")
                                                        <option style="text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                                    @endif
                                                    @if($user->dean_principal !== "COMPLY")
                                                        <option style="text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                                    @endif
                                                    @if($user->dean_principal !== "APPROVED")
                                                        <option style="text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                                    @endif
                                                    @if($user->dean_principal !== "REJECTED")
                                                        <option style="text-align:center; color:red"value="REJECTED">REJECTED</option>
                                                    @endif
                                                </select>
                                            </p> 
                                        </div>
                                </div>
                                <div class="general_signee_column" >
                                    <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Description</b></h5>
                                    <div style="border: 1px solid #000000;">
                                        @if($user->dean_principal_description == null)
                                            <p class="table_content" style= "text-align:center;"><a onclick="open_deanprincipal_Form({{$index_count}},{{$user->id}})">Add Details</a></p>
                                        @endif
                                        @if($user->dean_principal_description == !null)
                                        <p class="table_content" style= "text-align:center;"><a onclick="open_deanprincipal_Form({{$index_count}},{{$user->id}})">View Details</a></p>
                                    @endif 
                                    </div>
                                    <div class="signee-description-form-popup" id="deanprincipal_form-{{$index_count}}-{{$user->id}}">
                                        <textarea class="signee_description_info" name="dean_principal_description[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" value="{{$user->dean_principal_description }}">{{$user->dean_principal_description }}</textarea>
                                        <button type="button" class="btn cancel" onclick="close_deanprincipal_Form({{$index_count}},{{$user->id}})">Close</button>  
                                    </div>   
                                </div>
                            </div> 
                        </div>
                    @endif
                @endif
            @endif
            @if(strcasecmp(Auth::user()->role_as, "Registrar") == 0)
                @if($user->registrar !== "APPROVED" &&
                $user->dean_principal == "APPROVED" &&
                $user->dean_of_student_affair == "APPROVED" &&
                $user->librarian == "APPROVED" &&
                $user->student_org_treasurer == "APPROVED" &&
                $user->guidance_councilor == "APPROVED" &&
                $pass_total_value == $pass_status_value)
                    <div class="clearance_body"> 
                        <div class="clearance_row">
                            @foreach($course as $course_list)
                                @if($user->course == $course_list->id)
                                <h5 class="quick_view_table_content_header" style="text-align:center; background-color: blue; color:white"><b>{{$user->name}} ({{$course_list->course_acronym}}-{{$user->year_lvl}}) E-Clearance</b></h5>
                                @endif
                            @endforeach
                            <p  style="margin: 0px; padding:0px;text-align: left"><input type="checkbox" id="id[{{$user->id}}]" name="id[{{$user->id}}]" value="{{$user->id}}" ></p>
                            <div class="general_signee_column" >
                                <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Status</b></h5>
                                    <div style="border: 1px solid #000000">  
                                        <p  class="table_content" style="text-align:center">
                                            @if($user->registrar == "IN-PROGRESS")
                                                <select class="table_content_select" name="registrar[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:blue">
                                            @endif
                                            @if($user->registrar == "COMPLY")
                                                <select class="table_content_select" name="registrar[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:orange">
                                            @endif
                                            @if($user->registrar == "REJECTED")
                                                <select class="table_content_select" name="registrar[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:red">
                                            @endif
                                            @if($user->registrar == "APPROVED")
                                                <select class="table_content_select" name="registrar[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:green">
                                            @endif
                                        
                                                <option style="text-align:center" value="{{$user->registrar}}">{{$user->registrar}}</option>

                                                @if($user->registrar !== "IN-PROGRESS")
                                                    <option style="text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                                @endif
                                                @if($user->registrar !== "COMPLY")
                                                    <option style="text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                                @endif
                                                @if($user->registrar !== "APPROVED")
                                                    <option style="text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                                @endif
                                                @if($user->registrar !== "REJECTED")
                                                    <option style="text-align:center; color:red"value="REJECTED">REJECTED</option>
                                                @endif
                                            </select>
                                        </p> 
                                    </div>
                            </div>
                            <div class="general_signee_column" >
                                <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Description</b></h5>
                                <div style="border: 1px solid #000000;">
                                    @if($user->registrar_description == null)
                                        <p class="table_content" style= "text-align:center;"><a onclick="open_registrar_Form({{$index_count}},{{$user->id}})">Add Details</a></p>
                                    @endif
                                    @if($user->registrar_description == !null)
                                    <p class="table_content" style= "text-align:center;"><a onclick="open_registrar_Form({{$index_count}},{{$user->id}})">View Details</a></p>
                                @endif 
                                </div>
                                <div class="signee-description-form-popup" id="registrar_form-{{$index_count}}-{{$user->id}}">
                                    <textarea class="signee_description_info" name="registrar_description[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" value="{{$user->registrar_description }}">{{$user->registrar_description }}</textarea>
                                    <button type="button" class="btn cancel" onclick="close_registrar_Form({{$index_count}},{{$user->id}})">Close</button>  
                                </div>   
                            </div>
                        </div> 
                    </div>
                @endif
            @endif
            @if(strcasecmp(Auth::user()->role_as, "Accounting Assessment") == 0)
                @if(
                    $user->accounting_assessment !== "APPROVED" &&
                    $user->registrar == "APPROVED" &&
                    $user->dean_principal == "APPROVED" &&
                    $user->dean_of_student_affair == "APPROVED" &&
                    $user->librarian == "APPROVED" &&
                    $user->student_org_treasurer == "APPROVED" &&
                    $user->guidance_councilor == "APPROVED" &&
                    $pass_total_value == $pass_status_value)
                    <div class="clearance_body"> 
                        <div class="clearance_row">
                            @foreach($course as $course_list)
                                @if($user->course == $course_list->id)
                                <h5 class="quick_view_table_content_header" style="text-align:center; background-color: blue; color:white"><b>{{$user->name}} ({{$course_list->course_acronym}}-{{$user->year_lvl}}) E-Clearance</b></h5>
                                @endif
                            @endforeach 
                            <p  style="margin: 0px; padding:0px;text-align: left"><input type="checkbox" id="id[{{$user->id}}]" name="id[{{$user->id}}]" value="{{$user->id}}" ></p>
                            <div class="general_signee_column" >
                                <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Status</b></h5>
                                    <div style="border: 1px solid #000000">  
                                        <p  class="table_content" style="text-align:center">
                                            @if($user->accounting_assessment == "IN-PROGRESS")
                                                <select class="table_content_select" name="accounting_assessment[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:blue">
                                            @endif
                                            @if($user->accounting_assessment == "COMPLY")
                                                <select class="table_content_select" name="accounting_assessment[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:orange">
                                            @endif
                                            @if($user->accounting_assessment == "REJECTED")
                                                <select class="table_content_select" name="accounting_assessment[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:red">
                                            @endif
                                            @if($user->accounting_assessment == "APPROVED")
                                                <select class="table_content_select" name="accounting_assessment[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" style="color:green">
                                            @endif
                                        
                                                <option style="text-align:center" value="{{$user->accounting_assessment}}">{{$user->accounting_assessment}}</option>

                                                @if($user->accounting_assessment !== "IN-PROGRESS")
                                                    <option style="text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                                @endif
                                                @if($user->accounting_assessment !== "COMPLY")
                                                    <option style="text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                                @endif
                                                @if($user->accounting_assessment !== "APPROVED")
                                                    <option style="text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                                @endif
                                                @if($user->accounting_assessment !== "REJECTED")
                                                    <option style="text-align:center; color:red"value="REJECTED">REJECTED</option>
                                                @endif
                                            </select>
                                        </p> 
                                    </div>
                            </div>
                            <div class="general_signee_column" >
                                <h5 class="table_content_header" style="border: 1px solid #000000; text-align:center;"><b>Description</b></h5>
                                <div style="border: 1px solid #000000;">
                                    @if($user->accounting_assessment_description == null)
                                        <p class="table_content" style= "text-align:center;"><a onclick="open_assessment_Form({{$index_count}},{{$user->id}})">Add Details</a></p>
                                    @endif
                                    @if($user->accounting_assessment_description == !null)
                                    <p class="table_content" style= "text-align:center;"><a onclick="open_assessment_Form({{$index_count}},{{$user->id}})">View Details</a></p>
                                @endif 
                                </div>
                                <div class="signee-description-form-popup" id="assessment_form-{{$index_count}}-{{$user->id}}">
                                    <textarea class="signee_description_info" name="accounting_assessment_description[{{$user->id}}]" onchange="OnChangeHandler({{$user->id}})" value="{{$user->accounting_assessment_description }}">{{$user->accounting_assessment_description }}</textarea>
                                    <button type="button" class="btn cancel" onclick="close_assessment_Form({{$index_count}},{{$user->id}})">Close</button>  
                                </div>   
                            </div>
                        </div> 
                    </div>
                @endif
            @endif
        @endforeach
    </div>
</form>
<script>
    function OnChangeHandler(userId) {
        document.getElementById(`id[${userId}]`).checked = true;
    }
    </script> 
@endsection
