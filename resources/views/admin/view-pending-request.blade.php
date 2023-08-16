@extends('layouts.admin-app')

@section('content')
<style>
    
/* Create three equal columns that floats next to each other */
.column {
    float: left;
    width: 20%;
    height: auto;
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
        border: 2px solid;
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
        background-color: #e9ecef;
    }
.form-popup {
    display: none;
    position: fixed;
    bottom: 300px;
    right: 250px;
    border: 3px solid #0800ff;
    z-index: 9;
    background-color: rgb(212, 212, 212);
    width: 500px;
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
    /* Add some hover effects to buttons */
    .form-container-activity .btn_cancel:hover, .open-button:hover{
    opacity: 1;
    } 
    .btn.cancel{
    background-color: red;
    color: white;
    }
    .description_info{
    height: 155px;
    width: 490px;
    }
    .clearance_body{
        padding-top: 30px;
        width:100%;
    }
    select[readonly]
{
    pointer-events: none;
}
/* irrelevent styling */
*[readonly]
{

}

    .scroll_div{
    margin-right: 0px;
        margin-top: 10px;
        margin-bottom: 10px;
        width: 100% !important;
        height: 500px;
        overflow-x: hidden;
        overflow-y: auto;
        text-align: center;
         border: solid rgb(0, 0, 0) 3px;
    }
    .admin_pending_update_btn{
        float: left !important;
        margin-top: 8px;
        border-radius: 5px !important;
    }
    
      .pending_counts_column{
        width: 12.5%;
        float: left;
        font-size: 12px;
       padding: 0px;
        border-radius: 1px;
        height: 40px;
    }
    .pending_counts_row{
        width:100%;
        height: 3px;
        /* margin-left: 10px; */
        /* padding-right: 15px !important; */
    }
    .count-signee_style{
        background-color: rgb(220, 213, 2);
        border: solid rgb(0, 0, 0) 1px;
    }
    .filter_div{
        margin-top: 10px;
        margin-left: 20px;
    }
    .filter_div_column{
        width: 20%;
        padding-right: 10px;
        float: right !important;
    }
    .filter_div_column_btn{
        float: right !important;
        padding-right: 10px;
    }
    .update_btn{
        height: 38px;
        border-radius: 0px !important;
    }
    </style>
   
 
<div class="clearance_body">
    <h3 style="text-align:center; color:white; background-color: rgb(3, 3, 142); width: 100%"><b>All Pending Request</b></h3>
    @if (session('success'))
        <div style="text-align:center" class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="text-align:center" class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('admin.view-pending-request') }}" method="GET">
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
        <div class="row filter_div">
            <div  class="filter_div_column_btn">
                <button type="submit" class="btn btn-primary form-control" style="width:100px">Filter</button>
            </div>
            <div class="filter_div_column">
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
            <div class="filter_div_column">
                <select name="year_lvl"  class="form-control">
                    <option value="">All Level</option>
                    <option value="1st Year" {{Request::get('year_lvl') == '1st Year' ? 'selected':''}}>1st Year</option>
                    <option value="2nd Year" {{Request::get('year_lvl') == '2nd Year' ? 'selected':''}}>2nd Year</option>
                    <option value="3rd Year" {{Request::get('year_lvl') == '3rd Year' ? 'selected':''}}>3rd Year</option>
                    <option value="4th Year" {{Request::get('year_lvl') == '4th Year' ? 'selected':''}}>4th Year</option>
                </select>
            </div>
            
        </div>
    </form>
    {{-- <form action="/admin/update-multiple-student" method="POST">
        {{csrf_field()}}
        @method('PUT') --}}
        <br>    
        <div class="pending_counts_row">
            
            <div class="pending_counts_column">
                <p class="count-signee_style">Instructor<br>({{$signee}})</p>
            </div>
            <div class="pending_counts_column">
                <p class="count-signee_style">Guidance Counselor<br>({{$counselor}})</p>
            </div>
            <div class="pending_counts_column">
                <p class="count-signee_style">Student Org. treasurer<br>({{$treasurer}})</p>
            </div>
            <div class="pending_counts_column">
                <p class="count-signee_style">Librarian<br>({{$librarian}})</p>
            </div>
            <div class="pending_counts_column">
                <p class="count-signee_style">Dean of Student Affair<br>({{$affair}})</p>
            </div>
            <div class="pending_counts_column">
                <p class="count-signee_style">Dean Principal<br>({{$dean}})</p>
            </div>
            <div class="pending_counts_column">
                <p class="count-signee_style">Registrar<br>({{$registrar}})</p>
            </div>
            <div class="pending_counts_column">
                <p class="count-signee_style">Accounting Assessment<br>({{$assessment}})</p>
            </div>
            {{-- <div class="pending_counts_column">
                <button type="submit" class="btn btn-primary form-control update_btn" style="">Update User</button>
            </div> --}}
        </div>
        
        <div class="scroll_div">
            @foreach($users_pending_request as $index_count => $user)
                    <?php
                        $approve_count = 0;
                        $status_total = 0;
                    ?>
                    @foreach($user->status as $instructor_status_count)
                        @if($instructor_status_count == "APPROVED")
                            <?php
                                $approve_count++;
                            ?>
                        @endif
                        @if($instructor_status_count !== "APPROVED" || $instructor_status_count == "APPROVED")
                            <?php
                                $status_total++;
                            ?>
                        @endif
                    @endforeach
                    <?php
                    if($user->guidance_councilor == "APPROVED"){
                        $approve_count++;
                    }
                    if($user->student_org_treasurer == "APPROVED"){
                        $approve_count++;
                    }
                    if($user->librarian == "APPROVED"){
                        $approve_count++;
                    }
                    if($user->dean_of_student_affair == "APPROVED"){
                        $approve_count++;
                    }
                    if($user->dean_principal == "APPROVED"){
                        $approve_count++;
                    }
                    if($user->registrar == "APPROVED"){
                        $approve_count++;
                    }
                    if($user->accounting_assessment == "APPROVED"){
                        $approve_count++;
                    }
                    //
                    if($user->guidance_councilor == "APPROVED" || $user->guidance_councilor !== "APPROVED"){
                        $status_total++;
                    }
                    if($user->student_org_treasurer == "APPROVED" || $user->student_org_treasurer !== "APPROVED"){
                        $status_total++;
                    }
                    if($user->librarian == "APPROVED" || $user->librarian !== "APPROVED"){
                        $status_total++;
                    }
                    if($user->dean_of_student_affair == "APPROVED" || $user->dean_of_student_affair !== "APPROVED"){
                        $status_total++;
                    }
                    if($user->dean_principal == "APPROVED" || $user->dean_principal !== "APPROVED"){
                        $status_total++;
                    }
                    if($user->registrar == "APPROVED" || $user->registrar !== "APPROVED"){
                        $status_total++;
                    }
                    if($user->accounting_assessment == "APPROVED" || $user->accounting_assessment !== "APPROVED"){
                        $status_total++;
                    }
                        $pass_approved_total_value =  $approve_count;
                        $pass_status__total_value = $status_total;
                    // echo $pass_total_value;
                    // echo $pass_status_value;
                    ?>
                     @if($pass_approved_total_value !== $pass_status__total_value)
                        <div class="clearance_row">
                            @foreach($course as $list)
                            @if($user->course == $list->id)
                            <h5 style="text-align:center; background-color: blue; color:white"><b>{{$user->name}} ({{$user->year_lvl}}-{{$list->course_acronym}})&nbsp;E-Clearance </b></h5>
                            @endif
                            @endforeach
                            {{-- <p style="margin-bottom: 0px"><input type="checkbox" id="id[{{$user->id}}]" name="id[{{$user->id}}]" value="{{$user->id}}" ></p> --}}
                            <div class="column" >
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Instructor</b></h6>     
                                    @foreach ($user->student_signee_names as $signee)
                                        <div style="border: 1px solid #dee2e6">
                                            <p>{{$signee}}</p>
                                        </div>
                                    @endforeach    
                            </div>
                            <div class="column">
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Subject</b></h6>
                                
                                    @foreach ($user->subjects as $subject_list)
                                        <div style="border: 1px solid #dee2e6"> 
                                            <p>{{$subject_list}}</p>
                                        </div>
                                    @endforeach
                            </div>
                            <div class="column" >
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Section</b></h6>
                                @foreach ($user->student_section as $section_list)
                                    <div style="border: 1px solid #dee2e6"> 
                                        <p style="text-align:center;">{{$section_list}}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="column" >
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Status</b></h6>
                                    @foreach ($user->status as $status_list) 
                                    <div style="border: 1px solid #dee2e6">  
                                        <p style="text-align:center">
                                            @if($status_list == "IN-PROGRESS")
                                            <select style="color:blue" readonly tabindex="-1">
                                            @endif
                                            @if($status_list == "COMPLY")
                                            <select style="color:orange" readonly tabindex="-1">
                                            @endif
                                            @if($status_list == "REJECTED")
                                            <select  style="color:red" readonly tabindex="-1">
                                            @endif
                                            @if($status_list == "APPROVED")
                                            <select style="color:green" readonly tabindex="-1">
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
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Description</b></h6>
                                    @foreach ($user->description as $index => $description_list)
                                        <div style="border: 1px solid #dee2e6;">
                                        @if($description_list !== null)  
                                            <p style="text-align:center;"><a onclick="open_signee_pending_Form({{$index}},{{$user->id}})">View Detail</a></p>
                                        @endif
                                        @if($description_list == null)  
                                            <p style="text-align:center;"><a onclick="open_signee_pending_Form({{$index}},{{$user->id}})">Add Detail</a></p>
                                        @endif
                                        </div>
                                        <div class="form-popup" id="signee_pending_Form-{{$index}}-{{$user->id}}">
                                            <textarea class="description_info" readonly onchange="OnChangeHandler({{$user->id}})" value="{{$description_list}}">{{$description_list}}</textarea>
                                            <button type="button" class="btn cancel" onclick="close_signee_pending_Form({{$index}},{{$user->id}})">Close</button>
                                        </div>
                                    @endforeach     
                            </div>
                            <div class="column" >
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Guidance Counselor</b></h6>
                                    <div style="border: 1px solid #dee2e6">  
                                        <p style="text-align:center">
                                            @if($user->guidance_councilor == "IN-PROGRESS")
                                            <select  style="color:blue" readonly tabindex="-1">
                                            @endif
                                            @if($user->guidance_councilor == "COMPLY")
                                            <select  style="color:orange" readonly tabindex="-1">
                                            @endif
                                            @if($user->guidance_councilor == "REJECTED")
                                            <select  style="color:red" readonly tabindex="-1">
                                            @endif
                                            @if($user->guidance_councilor == "APPROVED")
                                            <select  style="color:green" readonly tabindex="-1">
                                            @endif

                                                <option style="text-align:center" value="{{$user->guidance_councilor}}">{{$user->guidance_councilor}}</option>
                                            
                                            @if($user->guidance_councilor !== "IN-PROGRESS")
                                                <option style="text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                            @endif
                                            @if($user->guidance_councilor !== "COMPLY")
                                                <option style="text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                            @endif
                                            @if($user->guidance_councilor!== "APPROVED")
                                                <option style="text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                            @endif
                                            @if($user->guidance_councilor !== "REJECTED")
                                                <option style="text-align:center; color:red"value="REJECTED">REJECTED</option>
                                            @endif
                                            </select>
                                        </p>
                                    </div>
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Description</b></h6>
                                <div style="border: 1px solid #dee2e6;">
                                    @if($user->guidance_councilor_description !== null)  
                                        <p style="text-align:center;"><a onclick="open_guidance_councilor_pending_Form({{$index_count}},{{$user->id}})">View Detail</a></p>
                                    @endif
                                    @if($user->guidance_councilor_description == null)  
                                        <p style="text-align:center;"><a onclick="open_guidance_councilor_pending_Form({{$index_count}},{{$user->id}})">Add Detail</a></p>
                                    @endif
                                </div>
                                <div class="form-popup" id="guidance_councilor_pending_Form-{{$index_count}}-{{$user->id}}">
                                    <textarea class="description_info" readonly value="{{$user->guidance_councilor_description}}">{{$user->guidance_councilor_description}}</textarea>
                                    <button type="button" class="btn cancel" onclick="close_guidance_councilor_pending_Form({{$index_count}},{{$user->id}})">Close</button>
                                </div> 
                            </div>
                            <div class="column" >
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Student Org. Treasurer</b></h6>
                                    <div style="border: 1px solid #dee2e6">  
                                        <p style="text-align:center">
                                            @if($user->student_org_treasurer == "IN-PROGRESS")
                                            <select readonly tabindex="-1" style="color:blue">
                                            @endif
                                            @if($user->student_org_treasurer == "COMPLY")
                                            <select readonly tabindex="-1" style="color:orange">
                                            @endif
                                            @if($user->student_org_treasurer == "REJECTED")
                                            <select readonly tabindex="-1" style="color:red">
                                            @endif
                                            @if($user->student_org_treasurer == "APPROVED")
                                            <select readonly tabindex="-1" style="color:green">
                                            @endif
                                            <option style="text-align:center" value="{{$user->student_org_treasurer}}">{{$user->student_org_treasurer}}</option>

                                            @if($user->student_org_treasurer !== "IN-PROGRESS")
                                                <option style="text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                            @endif
                                            @if($user->student_org_treasurer !== "COMPLY")
                                                <option style="text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                            @endif
                                            @if($user->student_org_treasurer!== "APPROVED")
                                                <option style="text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                            @endif
                                            @if($user->student_org_treasurer !== "REJECTED")
                                                <option style="text-align:center; color:red"value="REJECTED">REJECTED</option>
                                            @endif
                                            </select>
                                        </p>
                                    </div>
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Description</b></h6>
                                <div style="border: 1px solid #dee2e6;">
                                    @if($user->student_org_description !== null)  
                                        <p style="text-align:center;"><a onclick="open_student_org_pending_Form({{$index_count}},{{$user->id}})">View Detail</a></p>
                                    @endif
                                    @if($user->student_org_description == null)  
                                        <p style="text-align:center;"><a onclick="open_student_org_pending_Form({{$index_count}},{{$user->id}})">Add Detail</a></p>
                                    @endif
                                </div>
                                <div class="form-popup" id="student_org_pending_Form-{{$index_count}}-{{$user->id}}">
                                    <textarea class="description_info" readonly value="{{$user->student_org_description}}">{{$user->student_org_description}}</textarea>
                                    <button type="button" class="btn cancel" onclick="close_student_org_pending_Form({{$index_count}},{{$user->id}})">Close</button>
                                </div> 
                            </div>
                            <div class="column" >
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Librarian</b></h6>
                                    <div style="border: 1px solid #dee2e6">  
                                        <p style="text-align:center">
                                            @if($user->librarian == "IN-PROGRESS")
                                            <select readonly tabindex="-1" style="color:blue">
                                            @endif
                                            @if($user->librarian == "COMPLY")
                                            <select readonly tabindex="-1" style="color:orange">
                                            @endif
                                            @if($user->librarian == "REJECTED")
                                            <select readonly tabindex="-1" style="color:red">
                                            @endif
                                            @if($user->librarian == "APPROVED")
                                            <select readonly tabindex="-1" style="color:green">
                                            @endif
                                            <option style="text-align:center" value="{{$user->librarian}}">{{$user->librarian}}</option>

                                            @if($user->librarian !== "IN-PROGRESS")
                                                <option style="text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                            @endif
                                            @if($user->librarian !== "COMPLY")
                                                <option style="text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                            @endif
                                            @if($user->librarian!== "APPROVED")
                                                <option style="text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                            @endif
                                            @if($user->librarian !== "REJECTED")
                                                <option style="text-align:center; color:red"value="REJECTED">REJECTED</option>
                                            @endif
                                            </select>
                                        </p>
                                    </div>
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Description</b></h6>
                                <div style="border: 1px solid #dee2e6;">
                                    @if($user->librarian_description !== null)  
                                        <p style="text-align:center;"><a onclick="open_librarian_pending_Form({{$index_count}},{{$user->id}})">View Detail</a></p>
                                    @endif
                                    @if($user->librarian_description == null)  
                                        <p style="text-align:center;"><a onclick="open_librarian_pending_Form({{$index_count}},{{$user->id}})">Add Detail</a></p>
                                    @endif
                                </div>
                                <div class="form-popup" id="librarian_pending_Form-{{$index_count}}-{{$user->id}}">
                                    <textarea class="description_info" readonly value="{{$user->librarian_description}}">{{$user->librarian_description}}</textarea>
                                    <button type="button" class="btn cancel" onclick="close_librarian_pending_Form({{$index_count}},{{$user->id}})">Close</button>
                                </div> 
                            </div>
                            <div class="column" >
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Dean of student Affair</b></h6>
                                    <div style="border: 1px solid #dee2e6">  
                                        <p style="text-align:center">
                                            @if($user->dean_of_student_affair == "IN-PROGRESS")
                                            <select readonly tabindex="-1" style="color:blue">
                                            @endif
                                            @if($user->dean_of_student_affair == "COMPLY")
                                            <select readonly tabindex="-1" style="color:orange">
                                            @endif
                                            @if($user->dean_of_student_affair == "REJECTED")
                                            <select readonly tabindex="-1" style="color:red">
                                            @endif
                                            @if($user->dean_of_student_affair == "APPROVED")
                                            <select readonly tabindex="-1" style="color:green">
                                            @endif
                                            <option style="text-align:center" value="{{$user->dean_of_student_affair}}">{{$user->dean_of_student_affair}}</option>

                                            @if($user->dean_of_student_affair !== "IN-PROGRESS")
                                                <option style="text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                            @endif
                                            @if($user->dean_of_student_affair !== "COMPLY")
                                                <option style="text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                            @endif
                                            @if($user->dean_of_student_affair!== "APPROVED")
                                                <option style="text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                            @endif
                                            @if($user->dean_of_student_affair !== "REJECTED")
                                                <option style="text-align:center; color:red"value="REJECTED">REJECTED</option>
                                            @endif
                                            </select>
                                        </p>
                                    </div>
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Description</b></h6>
                                    <div style="border: 1px solid #dee2e6;">
                                        @if($user->dean_of_student_affair_description !== null)  
                                            <p style="text-align:center;"><a onclick="open_student_affair_pending_Form({{$index_count}},{{$user->id}})">View Detail</a></p>
                                        @endif
                                        @if($user->dean_of_student_affair_description == null)  
                                            <p style="text-align:center;"><a onclick="open_student_affair_pending_Form({{$index_count}},{{$user->id}})">Add Detail</a></p>
                                        @endif
                                    </div>
                                    <div class="form-popup" id="student_affair_pending_Form-{{$index_count}}-{{$user->id}}">
                                        <textarea class="description_info" readonly value="{{$user->dean_of_student_affair_description}}">{{$user->dean_of_student_affair_description}}</textarea>
                                        <button type="button" class="btn cancel" onclick="close_student_affair_pending_Form({{$index_count}},{{$user->id}})">Close</button>
                                    </div> 
                            </div>
                            <div class="column" >
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Dean Principal</b></h6>
                                    <div style="border: 1px solid #dee2e6">  
                                        <p style="text-align:center">
                                            @if($user->dean_principal == "IN-PROGRESS")
                                            <select readonly tabindex="-1" style="color:blue">
                                            @endif
                                            @if($user->dean_principal == "COMPLY")
                                            <select readonly tabindex="-1" style="color:orange">
                                            @endif
                                            @if($user->dean_principal == "REJECTED")
                                            <select readonly tabindex="-1" style="color:red">
                                            @endif
                                            @if($user->dean_principal == "APPROVED")
                                            <select readonly tabindex="-1" style="color:green">
                                            @endif
                                            <option style="text-align:center" value="{{$user->dean_principal}}">{{$user->dean_principal}}</option>

                                            @if($user->dean_principal !== "IN-PROGRESS")
                                                <option style="text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                            @endif
                                            @if($user->dean_principal !== "COMPLY")
                                                <option style="text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                            @endif
                                            @if($user->dean_principal!== "APPROVED")
                                                <option style="text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                            @endif
                                            @if($user->dean_principal !== "REJECTED")
                                                <option style="text-align:center; color:red"value="REJECTED">REJECTED</option>
                                            @endif
                                            </select>
                                        </p>
                                    </div>
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Description</b></h6>
                                <div style="border: 1px solid #dee2e6;">
                                    @if($user->dean_principal_description !== null)  
                                        <p style="text-align:center;"><a onclick="open_dean_principal_pending_Form({{$index_count}},{{$user->id}})">View Detail</a></p>
                                    @endif
                                    @if($user->dean_principal_description == null)  
                                        <p style="text-align:center;"><a onclick="open_dean_principal_pending_Form({{$index_count}},{{$user->id}})">Add Detail</a></p>
                                    @endif
                                </div>
                                <div class="form-popup" id="dean_principal_pending_Form-{{$index_count}}-{{$user->id}}">
                                    <textarea class="description_info" readonly value="{{$user->dean_principal_description}}">{{$user->dean_principal_description}}</textarea>
                                    <button type="button" class="btn cancel" onclick="close_dean_principal_pending_Form({{$index_count}},{{$user->id}})">Close</button>
                                </div> 
                            </div>
                            <div class="column" >
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Registrar</b></h6>
                                    <div style="border: 1px solid #dee2e6">  
                                        <p style="text-align:center">
                                            @if($user->registrar == "IN-PROGRESS")
                                            <select readonly tabindex="-1" style="color:blue">
                                            @endif
                                            @if($user->registrar == "COMPLY")
                                            <select readonly tabindex="-1" style="color:orange">
                                            @endif
                                            @if($user->registrar == "REJECTED")
                                            <select readonly tabindex="-1" style="color:red">
                                            @endif
                                            @if($user->registrar == "APPROVED")
                                            <select readonly tabindex="-1" style="color:green">
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
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Description</b></h6>
                                <div style="border: 1px solid #dee2e6;">
                                    @if($user->registrar_description !== null)  
                                        <p style="text-align:center;"><a onclick="open_registrar_pending_Form({{$index_count}},{{$user->id}})">View Detail</a></p>
                                    @endif
                                    @if($user->registrar_description == null)  
                                        <p style="text-align:center;"><a onclick="open_registrar_pending_Form({{$index_count}},{{$user->id}})">Add Detail</a></p>
                                    @endif
                                </div>
                                <div class="form-popup" id="registrar_pending_Form-{{$index_count}}-{{$user->id}}">
                                    <textarea class="description_info" readonly value="{{$user->registrar_description}}">{{$user->registrar_description}}</textarea>
                                    <button type="button" class="btn cancel" onclick="close_registrar_pending_Form({{$index_count}},{{$user->id}})">Close</button>
                                </div> 
                            </div>
                            <div class="column" >
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Accounting Assessment</b></h6>
                                    <div style="border: 1px solid #dee2e6">  
                                        <p style="text-align:center">
                                            @if($user->accounting_assessment == "IN-PROGRESS")
                                            <select readonly tabindex="-1" style="color:blue">
                                            @endif
                                            @if($user->accounting_assessment == "COMPLY")
                                            <select readonly tabindex="-1" style="color:orange">
                                            @endif
                                            @if($user->accounting_assessment == "REJECTED")
                                            <select readonly tabindex="-1" style="color:red">
                                            @endif
                                            @if($user->accounting_assessment == "APPROVED")
                                            <select readonly tabindex="-1" style="color:green">
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
                                <h6 style="border: 1px solid #dee2e6; text-align:center;"><b>Description</b></h6>
                                <div style="border: 1px solid #dee2e6;">
                                    @if($user->accounting_assessment_description !== null)  
                                        <p style="text-align:center;"><a onclick="open_assessment_pending_Form({{$index_count}},{{$user->id}})">View Detail</a></p>
                                    @endif
                                    @if($user->accounting_assessment_description == null)  
                                        <p style="text-align:center;"><a onclick="open_assessment_pending_Form({{$index_count}},{{$user->id}})">Add Detail</a></p>
                                    @endif
                                </div>
                                <div class="form-popup" id="assessment_pending_Form-{{$index_count}}-{{$user->id}}">
                                    <textarea class="description_info" readonly value="{{$user->accounting_assessment_description}}">{{$user->accounting_assessment_description}}</textarea>
                                    <button type="button" class="btn cancel" onclick="close_assessment_pending_Form({{$index_count}},{{$user->id}})">Close</button>
                                </div> 
                            </div>
                        </div>     
                    @endif     
                @endforeach
            </div>
        {{-- </form> --}}
        {{-- @include('admin.user-activity') --}}
    @endsection
</div>
<script>
    function OnChangeHandler(userId) {
        document.getElementById(`id[${userId}]`).checked = true;
    }
</script>
