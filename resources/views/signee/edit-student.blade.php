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
}
.column_info {
    float: left;
    width: 50%;
    
}
.column_label{
    font-size: 15px;
}


/* Clear floats after the columns */
.clearance_row:after {
    content: "";
    display: table;
    clear: both;
}
.clearance_row{
    float:right;
    margin-right: 1px;

}
.clearance_row{
    border: 2px solid;
    height: auto;
    width: 100%; 
}

/* .table_content_select{
    white-space: nowrap; 
    width: 100%; 
    overflow: hidden;
    text-overflow: clip;
    cursor: pointer;
    font-size: 16px;
    text-align: center; 
} */

.signee_close_btn{
 float: right;
 background-color: red;
 color: white;
}
.signee-description-form-popup {
        display: none;
        position: fixed;
        bottom: 50%;
        right:25%;
        left: 25%;
       
        z-index: 9;
       
        width: 50%;
        height: 20%;
        margin-bottom: auto;
      }
  .signee_description_info{
    border: 3px solid #0800ff;
        height: 100%;
        width: 100%;
        background-color: rgb(212, 212, 212);
      }

  select[readonly]
{
    pointer-events: none;
}
/* irrelevent styling */
*[readonly]
{

}
</style>

<script> 
    var expanded = false;
    function showCheckboxes() {
      var checkboxes = document.getElementById("checkboxes");
      if (!expanded) {
        checkboxes.style.display = "block";
        expanded = true;
      } else {
        checkboxes.style.display = "none"; 
        expanded = false;
      }
      
    }
</script>

<script> 
    var expanded = false;
    function showselectedCheckboxes() {
      var selectedcheckboxes = document.getElementById("selectedcheckboxes");
      if (!expanded) {
        selectedcheckboxes.style.display = "block";
        expanded = true;
      } else {
        selectedcheckboxes.style.display = "none"; 
        expanded = false;
      }
      
    }
    </script>

@php
    $passed_names = array();
    foreach ($student_id->student_signee_names as $signee_list){
       
        $value = $signee_list; 
        array_push($passed_names, $value);

        // $passed_names[] =  $value;
        // echo $passed_names['text'];
        
    }
    // print_r ($passed_names);
    // print_r ($passed_names);
    // $arrayLength = count($passed_names);
    // $i = 0;
    //     while ($i < $arrayLength)
    //     {
    //         echo $passed_names[$i] ."<br />";
    //         $i++;
    //     }
     
@endphp 

<div class="clearance_body_signee">
    <div class="card" style="width:100%; border: 2px solid black; margin-left: 0.3px;">
        <div class="card-header">
            <h4 class="signee_view_title"> <b>Change Status</b>
                <a href="{{url('/signee/view-signee-pending-request')}}" class="btn btn-danger float-end">BACK</a>
            </h4>
        </div>
        {!! Form::open(['action' => ['App\Http\Controllers\Signee\SigneeController@update_student',$student_id->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="card-body">
            @csrf 
            @method('PUT')
            <div class="clearance_row">
                <div class="column_info">
                    <label class="column_label"><b>Student Name</b></label>
                    <input type="text" readonly value="{{$student_id->name}}" class="form-control">
                </div>
                <div class="column_info">
                    <label class="column_label"><b>Student Email</b></label>
                
                        <input type="text" readonly value="{{$student_id->email}}" class="form-control">
                    
                     </div>
                <div class="column_info">
                    <label class="column_label"><b>Student Department</b></label>
                    @foreach ($department as $list)
                        @if($list->id == $student_id->dept_id)
                            <input type="text" readonly value="{{$list->dept_name}}" class="form-control">
                        @endif
                    @endforeach
                    </div>  
                <div class="column_info">
                    <label class="column_label"><b>Student Course</b></label>
                    @foreach ($course as $list)
                        @if($list->id == $student_id->course)
                            <input type="text" readonly value="{{$list->course_name}} ({{$list->course_acronym}})" class="form-control">
                        @endif
                    @endforeach
                </div>       
            </div>
            <div class="clearance_row">
                    <div class="column">
                        <h5 class="table_content_header"  style="border: 1px solid black; text-align:center">Instructor</h5>
                        {{-- @php
                        echo ($passed_names[2]); 
                        // print_r ($passed_names);
                        @endphp --}}
                        @foreach ($student_id->student_signee_names as $count_data => $signee_list)    
                            {{-- @if( Auth::user()->name == $passed_names[$count_data]) --}}
                                <p class="table_content" style="border: 1px solid black">{{$signee_list}}</p>
                            {{-- @endif --}}
                        @endforeach
                    </div>
                    <div class="column" >
                        <h5 class="table_content_header"  style="border: 1px solid black; text-align:center">Subject</h5>
                        @foreach ($student_id->subjects as $subject_list)                    
                                <p class="table_content" title="{{$subject_list}}" style="border: 1px solid black">{{$subject_list}}</p>
                        @endforeach
                    </div>
                    <div class="column" >
                        <h5 class="table_content_header"  style="border: 1px solid black;text-align:center">Section</h5>
                        @foreach ($student_id->student_section as $section_list)  
                            <p class="table_content" style="border: 1px solid black;">{{$section_list}}</p>
                        @endforeach
                    </div>
                    <div class="column" >
                        <h5 class="table_content_header"  style="border: 1px solid black; text-align:center">Status</h5>
                        @foreach ($student_id->status as $count_data => $status_list)  
                            <p class="table_content" style="border: 1px solid black;">
                                @if($status_list == "IN-PROGRESS" &&  Auth::user()->name == $passed_names[$count_data])
                                    <select class="table_content_select"  name="status[]" style="color:blue">
                                @endif
                                @if($status_list == "COMPLY" &&  Auth::user()->name == $passed_names[$count_data])
                                    <select class="table_content_select"  name="status[]" style="color:orange">
                                @endif
                                @if($status_list == "REJECTED" &&  Auth::user()->name == $passed_names[$count_data])
                                    <select class="table_content_select"  name="status[]" style="color:red">
                                @endif
                                @if($status_list == "APPROVED" &&  Auth::user()->name == $passed_names[$count_data]) 
                                    <select class="table_content_select" name="status[]" style="color:green">
                                @endif

                                @if($status_list == "IN-PROGRESS" &&  Auth::user()->name !== $passed_names[$count_data])
                                    <select class="table_content_select"  name="status[]" style="color:blue" readonly tabindex="-1">
                                @endif
                                @if($status_list == "COMPLY" &&  Auth::user()->name !== $passed_names[$count_data])
                                    <select class="table_content_select" name="status[]" style="color:orange" readonly tabindex="-1">
                                @endif
                                @if($status_list == "REJECTED" &&  Auth::user()->name !== $passed_names[$count_data])
                                    <select class="table_content_select"  name="status[]" style="color:red" readonly tabindex="-1">
                                @endif
                                @if($status_list == "APPROVED" &&  Auth::user()->name !== $passed_names[$count_data]) 
                                    <select class="table_content_select"  name="status[]" style="color:green" readonly tabindex="-1">
                                @endif
                                <option style="border: 1px solid black; text-align:center" value="{{$status_list}}">{{$status_list}}</option>
                            

                                @if($status_list !== "IN-PROGRESS")
                                <option style="border: 1px solid black; text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                @endif
                                @if($status_list !== "COMPLY")
                                <option style="border: 1px solid black; text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                @endif
                                @if($status_list !== "APPROVED")
                                <option style="border: 1px solid black; text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                @endif
                                @if($status_list !== "REJECTED")
                                <option style="border: 1px solid black; text-align:center; color:red"value="REJECTED">REJECTED</option>
                                @endif
                                </select>
                            </p>
                        @endforeach
                    </div> 
                    <div class="column"> 
                        <h5 class="table_content_header"  style="border: 1px solid black; text-align:center">Description</h5>
                        @foreach ($student_id->description as $count_data => $description_list)
                            @if(Auth::user()->name !== $passed_names[$count_data])
                            <p class="table_content" style="border: 1px solid black; text-align:center;"><a style="color:red">Restricted!</a></p>
                            @endif
                            @if((Auth::user()->name == $passed_names[$count_data]) && ($description_list == null))
                            <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_signeeForm({{$count_data}})">Add Detail</a></p>
                            @endif
                            @if((Auth::user()->name == $passed_names[$count_data]) && ($description_list !== null))
                            <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_signeeForm({{$count_data}})">View Detail</a></p>
                            @endif
                            <div class="signee-description-form-popup" id="edit_signeeForm{{$count_data}}">
                                <textarea class="signee_description_info" name="description[]" value="{{$description_list}}">{{$description_list}}</textarea>
                                <button type="button" class="btn cancel signee_close_btn" onclick="close_edit_signeeForm({{$count_data}})">Close</button>  
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="clearance_row">
    
                    <div class="column" >
                        <h5 class="table_content_header"  style="border: 1px solid black; text-align:center">Guidance Councilor</h5>
                            <p class="table_content_select" style="border: 1px solid black; text-align:center">
                                @if($student_id->guidance_councilor == "IN-PROGRESS" && strcasecmp(Auth::user()->role_as,'Guidance Counselor') == 0)
                                <select class="table_content_select" name="guidance_councilor" style="color:blue">
                                @endif
                                @if($student_id->guidance_councilor == "COMPLY" && strcasecmp(Auth::user()->role_as,'Guidance Counselor') == 0)
                                <select class="table_content_select" name="guidance_councilor" style="color:orange">
                                @endif
                                @if($student_id->guidance_councilor == "REJECTED" && strcasecmp(Auth::user()->role_as,'Guidance Counselor') == 0)
                                <select class="table_content_select" name="guidance_councilor" style="color:red">
                                @endif
                                @if($student_id->guidance_councilor == "APPROVED" && strcasecmp(Auth::user()->role_as,'Guidance Counselor') == 0)
                                <select class="table_content_select" name="guidance_councilor" style="color:green">
                                @endif

                                @if($student_id->guidance_councilor == "IN-PROGRESS" && strcasecmp(Auth::user()->role_as,'Guidance Counselor') !== 0)
                                <select class="table_content_select" name="guidance_councilor" style="color:blue" readonly tabindex="-1">
                                @endif
                                @if($student_id->guidance_councilor == "COMPLY" && strcasecmp(Auth::user()->role_as,'Guidance Counselor') !== 0)
                                <select name="guidance_councilor" style="color:orange" readonly tabindex="-1">
                                @endif
                                @if($student_id->guidance_councilor == "REJECTED" && strcasecmp(Auth::user()->role_as,'Guidance Counselor') !== 0)
                                <select class="table_content_select" name="guidance_councilor" style="color:red" readonly tabindex="-1">
                                @endif
                                @if($student_id->guidance_councilor == "APPROVED" && strcasecmp(Auth::user()->role_as,'Guidance Counselor') !== 0)
                                <select class="table_content_select" name="guidance_councilor" style="color:green" readonly tabindex="-1">
                                @endif

                                <option style="border: 1px solid black; text-align:center" value="{{$student_id->guidance_councilor}}">{{$student_id->guidance_councilor}}</option>
                                
                                @if($student_id->guidance_councilor !== "IN-PROGRESS")
                                <option style="border: 1px solid black; text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                @endif
                                @if($student_id->guidance_councilor !== "COMPLY")
                                <option style="border: 1px solid black; text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                @endif
                                @if($student_id->guidance_councilor !== "APPROVED")
                                <option style="border: 1px solid black; text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                @endif
                                @if($student_id->guidance_councilor !== "REJECTED")
                                <option style="border: 1px solid black; text-align:center; color:red"value="REJECTED">REJECTED</option>
                                @endif
                                </select>
                            </p> 
                            @if((strcasecmp(Auth::user()->role_as,'Guidance Counselor') == 0) && ($student_id->guidance_councilor == "REJECTED" || $student_id->guidance_councilor == "COMPLY") && ($student_id->guidance_councilor_description !== null || $student_id->guidance_councilor_description == null))  
                                <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_guidance_councilor_Form()">View Detail</a></p>
                            @endif
                            @if((strcasecmp(Auth::user()->role_as,'Guidance Counselor') == 0) && ($student_id->guidance_councilor_description == null || $student_id->guidance_councilor_description !== null) && ($student_id->guidance_councilor == "IN-PROGRESS"))  
                                <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_guidance_councilor_Form()">Add Detail</a></p>
                            @endif
                            <div class="signee-description-form-popup" id="edit_guidance_councilor_form">
                                <textarea class="signee_description_info" name="guidance_councilor_description" value="{{$student_id->guidance_councilor_description}}">{{$student_id->guidance_councilor_description}}</textarea>
                                <button type="button" class="btn cancel signee_close_btn" onclick="close_edit_guidance_councilor_Form()">Close</button>  
                            </div>
                    </div>
                    
            <div class="column" >
                <h5 class="table_content_header"  style="border: 1px solid black; text-align:center">Student Org. Treasurer</h5>
                    <p class="table_content_select" style="border: 1px solid black; text-align:center">
                        @if($student_id->student_org_treasurer == "IN-PROGRESS" && strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') == 0)
                        <select class="table_content_select" name="student_org_treasurer" style="color:blue">
                        @endif
                        @if($student_id->student_org_treasurer == "COMPLY" && strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') == 0)
                            <select class="table_content_select" name="student_org_treasurer" style="color:orange">
                        @endif
                        @if($student_id->student_org_treasurer == "REJECTED" && strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') == 0)
                            <select class="table_content_select" name="student_org_treasurer" style="color:red">
                        @endif
                        @if($student_id->student_org_treasurer == "APPROVED" && strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') == 0)
                            <select class="table_content_select" name="student_org_treasurer" style="color:green">
                        @endif

                        @if($student_id->student_org_treasurer == "IN-PROGRESS" && strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') !== 0)
                        <select class="table_content_select" name="student_org_treasurer" style="color:blue" readonly tabindex="-1">
                        @endif
                        @if($student_id->student_org_treasurer == "COMPLY" && strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') !== 0)
                            <select class="table_content_select" name="student_org_treasurer" style="color:orange" readonly tabindex="-1">
                        @endif
                        @if($student_id->student_org_treasurer == "REJECTED" && strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') !== 0)
                            <select class="table_content_select" name="student_org_treasurer" style="color:red" readonly tabindex="-1">
                        @endif
                        @if($student_id->student_org_treasurer == "APPROVED" && strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') !== 0)
                            <select class="table_content_select" name="student_org_treasurer" style="color:green" readonly tabindex="-1">
                        @endif
    
    
                            <option style="border: 1px solid black; text-align:center" value="{{$student_id->student_org_treasurer}}">{{$student_id->student_org_treasurer}}</option>
    
    
                        @if($student_id->student_org_treasurer !== "IN-PROGRESS")
                            <option style="border: 1px solid black; text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                        @endif
                        @if($student_id->student_org_treasurer !== "COMPLY")
                            <option style="border: 1px solid black; text-align:center; color: orange"value="COMPLY">COMPLY</option>
                        @endif
                        @if($student_id->student_org_treasurer !== "APPROVED")
                            <option style="border: 1px solid black; text-align:center; color:green;"value="APPROVED">APPROVED</option>
                        @endif
                        @if($student_id->student_org_treasurer !== "REJECTED")
                            <option style="border: 1px solid black; text-align:center; color:red"value="REJECTED">REJECTED</option>
                        @endif
                        </select>
                    </p>
                    @if((strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') == 0) && ($student_id->student_org_treasurer == "REJECTED" || $student_id->student_org_treasurer == "COMPLY") && ($student_id->student_org_description == null || $student_id->student_org_description !== null))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_treasurer_Form()">View Detail</a></p>
                    @endif
                    @if((strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') == 0) && ($student_id->student_org_description == null || $student_id->student_org_description !== null) && ($student_id->student_org_treasurer == "IN-PROGRESS"))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_treasurer_Form()">Add Detail</a></p>
                    @endif
                    <div class="signee-description-form-popup" id="edit_student_org">
                            <textarea class="signee_description_info" name="student_org_description" value="{{$student_id->student_org_description}}">{{$student_id->student_org_description}}</textarea>
                          <button type="button" class="btn cancel signee_close_btn" onclick="close_edit_treasurer_Form()">Close</button>
                        
                      </div>
            </div>
            
            <div class="column" >
                <h5 class="table_content_header"  style="border: 1px solid black; text-align:center">Librarian</h5>
                    <p class="table_content_select" style="border: 1px solid black; text-align:center">
                        @if($student_id->librarian == "IN-PROGRESS" && strcasecmp(Auth::user()->role_as,'Librarian') == 0)
                            <select class="table_content_select" name="librarian" style="color:blue" >
                        @endif
                        @if($student_id->librarian == "COMPLY" && strcasecmp(Auth::user()->role_as,'Librarian') == 0)
                            <select class="table_content_select" name="librarian" style="color:orange">
                        @endif
                        @if($student_id->librarian == "REJECTED" && strcasecmp(Auth::user()->role_as,'Librarian') == 0)
                            <select class="table_content_select" name="librarian" style="color:red">
                        @endif
                        @if($student_id->librarian == "APPROVED" && strcasecmp(Auth::user()->role_as,'Librarian') == 0)
                            <select class="table_content_select" name="librarian" style="color:green">
                        @endif
                        
                        @if($student_id->librarian == "IN-PROGRESS" && strcasecmp(Auth::user()->role_as,'Librarian') !== 0)
                            <select class="table_content_select" name="librarian" style="color:blue" readonly tabindex="-1">
                        @endif
                        @if($student_id->librarian == "COMPLY" && strcasecmp(Auth::user()->role_as,'Librarian') !== 0)
                            <select class="table_content_select" name="librarian" style="color:orange" readonly tabindex="-1">
                        @endif
                        @if($student_id->librarian == "REJECTED" && strcasecmp(Auth::user()->role_as,'Librarian') !== 0)
                            <select class="table_content_select" name="librarian" style="color:red" readonly tabindex="-1">
                        @endif
                        @if($student_id->librarian == "APPROVED" && strcasecmp(Auth::user()->role_as,'Librarian') !== 0)
                            <select class="table_content_select" name="librarian" style="color:green" readonly tabindex="-1">
                        @endif 
                        
    
                            <option style="border: 1px solid black; text-align:center" value="{{$student_id->librarian}}">{{$student_id->librarian}}</option>
    
    
                        @if($student_id->librarian !== "IN-PROGRESS")
                            <option style="border: 1px solid black; text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                        @endif
                        @if($student_id->librarian !== "COMPLY")
                            <option style="border: 1px solid black; text-align:center; color: orange"value="COMPLY">COMPLY</option>
                        @endif
                        @if($student_id->librarian !== "APPROVED")
                            <option style="border: 1px solid black; text-align:center; color:green;"value="APPROVED">APPROVED</option>
                        @endif
                        @if($student_id->librarian !== "REJECTED")
                            <option style="border: 1px solid black; text-align:center; color:red"value="REJECTED">REJECTED</option>
                        @endif
                    </select>
                    </p>
                    @if((strcasecmp(Auth::user()->role_as,'Librarian') == 0) && ($student_id->librarian == "REJECTED" || $student_id->librarian == "COMPLY") && ($student_id->librarian_description !== null || $student_id->librarian_description == null))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_librarian_Form()">View Detail</a></p>
                    @endif
                    @if((strcasecmp(Auth::user()->role_as,'Librarian') == 0) && ($student_id->librarian_description == null || $student_id->librarian_description !== null) && ($student_id->librarian == "IN-PROGRESS"))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_librarian_Form()">Add Detail</a></p>
                    @endif
                    <div class="signee-description-form-popup" id="edit_librarian_form">
                        <textarea class="signee_description_info" name="librarian_description" value="{{$student_id->librarian_description}}">{{$student_id->librarian_description}}</textarea>
                        <button type="button" class="btn cancel signee_close_btn" onclick="close_edit_librarian_Form()">Close</button>  
                    </div>
            </div>
            <div class="column" >
                <h5 class="table_content_header"  style="border: 1px solid black; text-align:center">Dean of Student Affair</h5>
                    <p class="table_content_select" style="border: 1px solid black; text-align:center">
                        @if($student_id->dean_of_student_affair == "IN-PROGRESS" && strcasecmp(Auth::user()->role_as,'Dean of Student Affair') == 0)
                            <select class="table_content_select" name="dean_of_student_affair" style="color:blue">
                        @endif
                        @if($student_id->dean_of_student_affair == "COMPLY" && strcasecmp(Auth::user()->role_as,'Dean of Student Affair') == 0)
                            <select class="table_content_select" name="dean_of_student_affair" style="color:orange">
                        @endif
                        @if($student_id->dean_of_student_affair == "REJECTED" && strcasecmp(Auth::user()->role_as,'Dean of Student Affair') == 0)
                            <select class="table_content_select" name="dean_of_student_affair" style="color:red">
                        @endif
                        @if($student_id->dean_of_student_affair == "APPROVED" && strcasecmp(Auth::user()->role_as,'Dean of Student Affair') == 0)
                            <select class="table_content_select" name="dean_of_student_affair" style="color:green">
                        @endif

                        @if($student_id->dean_of_student_affair == "IN-PROGRESS" && strcasecmp(Auth::user()->role_as,'Dean of Student Affair') !== 0)
                            <select class="table_content_select" name="dean_of_student_affair" style="color:blue" readonly tabindex="-1">
                        @endif
                        @if($student_id->dean_of_student_affair == "COMPLY" && strcasecmp(Auth::user()->role_as,'Dean of Student Affair') !== 0)
                            <select class="table_content_select" name="dean_of_student_affair" style="color:orange" readonly tabindex="-1">
                        @endif
                        @if($student_id->dean_of_student_affair == "REJECTED" && strcasecmp(Auth::user()->role_as,'Dean of Student Affair') !== 0)
                            <select class="table_content_select" name="dean_of_student_affair" style="color:red" readonly tabindex="-1">
                        @endif
                        @if($student_id->dean_of_student_affair == "APPROVED" && strcasecmp(Auth::user()->role_as,'Dean of Student Affair') !== 0)
                            <select class="table_content_select" name="dean_of_student_affair" style="color:green" readonly tabindex="-1">
                        @endif
                        <option style="border: 1px solid black; text-align:center" value="{{$student_id->dean_of_student_affair}}">{{$student_id->dean_of_student_affair}}</option>
                       
                        
                        @if($student_id->dean_of_student_affair !== "IN-PROGRESS")
                        <option style="border: 1px solid black; text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                        @endif
                        @if($student_id->dean_of_student_affair !== "COMPLY")
                        <option style="border: 1px solid black; text-align:center; color: orange"value="COMPLY">COMPLY</option>
                        @endif
                        @if($student_id->dean_of_student_affair !== "APPROVED")
                        <option style="border: 1px solid black; text-align:center; color:green;"value="APPROVED">APPROVED</option>
                        @endif
                        @if($student_id->dean_of_student_affair !== "REJECTED")
                        <option style="border: 1px solid black; text-align:center; color:red"value="REJECTED">REJECTED</option>
                        @endif
                        </select>
                    </p>
                    @if(( strcasecmp(Auth::user()->role_as,'Dean of Student Affair') == 0) && ($student_id->dean_of_student_affair == "REJECTED" || $student_id->dean_of_student_affair == "COMPLY") && ($student_id->dean_of_student_affair_description !== null || $student_id->dean_of_student_affair_description == null)) 
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_studentaffair_Form()">View Detail</a></p>
                    @endif
                    @if(( strcasecmp(Auth::user()->role_as,'Dean of Student Affair') == 0) && ($student_id->dean_of_student_affair_description == null || $student_id->dean_of_student_affair_description !== null) && ($student_id->dean_of_student_affair == "IN-PROGRESS"))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_studentaffair_Form()">Add Detail</a></p>
                    @endif
                        <div class="signee-description-form-popup" id="edit_studentaffair_form">
                        <textarea class="signee_description_info" name="dean_of_student_affair_description" value="{{$student_id->dean_of_student_affair_description}}">{{$student_id->dean_of_student_affair_description}}</textarea>
                        <button type="button" class="btn cancel signee_close_btn" onclick="close_edit_studentaffair_Form()">Close</button>  
                    </div>
            </div>
            <div class="column" >
                <h5 class="table_content_header"  style="border: 1px solid black; text-align:center">Dean Principal</h5>
                    <p class="table_content_select" style="border: 1px solid black; text-align:center">
                        @if($student_id->dean_principal == "IN-PROGRESS" && strcasecmp(Auth::user()->role_as,'Dean Principal') == 0)
                        <select class="table_content_select" name="dean_principal" style="color:blue">
                        @endif
                        @if($student_id->dean_principal == "COMPLY" && strcasecmp(Auth::user()->role_as,'Dean Principal') == 0)
                        <select class="table_content_select" name="dean_principal" style="color:orange">
                        @endif
                        @if($student_id->dean_principal == "REJECTED" && strcasecmp(Auth::user()->role_as,'Dean Principal') == 0)
                        <select class="table_content_select" name="dean_principal" style="color:red">
                        @endif
                        @if($student_id->dean_principal == "APPROVED" && strcasecmp(Auth::user()->role_as,'Dean Principal') == 0)
                        <select class="table_content_select" name="dean_principal" style="color:green">
                        @endif

                        @if($student_id->dean_principal == "IN-PROGRESS" && strcasecmp(Auth::user()->role_as,'Dean Principal') !== 0)
                        <select class="table_content_select" name="dean_principal" style="color:blue" readonly tabindex="-1">
                        @endif
                        @if($student_id->dean_principal == "COMPLY" && strcasecmp(Auth::user()->role_as,'Dean Principal') !== 0)
                        <select class="table_content_select" name="dean_principal" style="color:orange" readonly tabindex="-1">
                        @endif
                        @if($student_id->dean_principal == "REJECTED" && strcasecmp(Auth::user()->role_as,'Dean Principal') !== 0)
                        <select class="table_content_select" name="dean_principal" style="color:red" readonly tabindex="-1">
                        @endif
                        @if($student_id->dean_principal == "APPROVED" && strcasecmp(Auth::user()->role_as,'Dean Principal') !== 0)
                        <select class="table_content_select" name="dean_principal" style="color:green" readonly tabindex="-1">
                        @endif
                        <option style="border: 1px solid black; text-align:center" value="{{$student_id->dean_principal}}">{{$student_id->dean_principal}}</option>
                       
                        
                        @if($student_id->dean_principal !== "IN-PROGRESS")
                        <option style="border: 1px solid black; text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                        @endif
                        @if($student_id->dean_principal !== "COMPLY")
                        <option style="border: 1px solid black; text-align:center; color: orange"value="COMPLY">COMPLY</option>
                        @endif
                        @if($student_id->dean_principal !== "APPROVED")
                        <option style="border: 1px solid black; text-align:center; color:green;"value="APPROVED">APPROVED</option>
                        @endif
                        @if($student_id->dean_principal !== "REJECTED")
                        <option style="border: 1px solid black; text-align:center; color:red"value="REJECTED">REJECTED</option>
                        @endif
                        </select> 
                    </p>
                    @if((strcasecmp(Auth::user()->role_as,'Dean Principal') == 0) && ($student_id->dean_principal == "REJECTED" || $student_id->dean_principal == "COMPLY") && ($student_id->dean_principal_description !== null || $student_id->dean_principal_description == null)) 
                    <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_deanprincipal_Form()">View Detail</a></p>
                    @endif
                    @if(( strcasecmp(Auth::user()->role_as,'Dean Principal') == 0) && ($student_id->dean_principal_description == null || $student_id->dean_principal_description !== null) && ($student_id->dean_principal == "IN-PROGRESS"))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_deanprincipal_Form()">Add Detail</a></p>
                    @endif
                    <div class="signee-description-form-popup" id="edit_deanprincipal_form">
                    <textarea class="signee_description_info" name="dean_principal_description" value="{{$student_id->dean_principal_description}}">{{$student_id->dean_principal_description}}</textarea>
                    <button type="button" class="btn cancel signee_close_btn" onclick="close_edit_deanprincipal_Form()">Close</button>  
                </div>
            </div>
            <div class="column" >
                <h5 class="table_content_header"  style="border: 1px solid black; text-align:center">Registrar</h5>
                    <p class="table_content_select" style="border: 1px solid black; text-align:center">
                        @if($student_id->registrar == "IN-PROGRESS" && strcasecmp(Auth::user()->role_as,'Registrar') == 0)
                            <select class="table_content_select" name="registrar" style="color:blue">
                        @endif
                        @if($student_id->registrar == "COMPLY" && strcasecmp(Auth::user()->role_as,'Registrar') == 0)
                            <select class="table_content_select" name="registrar" style="color:orange">
                        @endif
                        @if($student_id->registrar == "REJECTED" && strcasecmp(Auth::user()->role_as,'Registrar') == 0)
                            <select class="table_content_select" name="registrar" style="color:red">
                        @endif
                        @if($student_id->registrar == "APPROVED" && strcasecmp(Auth::user()->role_as,'Registrar') == 0)
                            <select class="table_content_select" name="registrar" style="color:green">
                        @endif

                        @if($student_id->registrar == "IN-PROGRESS" && strcasecmp(Auth::user()->role_as,'Registrar') !== 0)
                            <select class="table_content_select" name="registrar" style="color:blue" readonly tabindex="-1">
                        @endif
                        @if($student_id->registrar == "COMPLY" && strcasecmp(Auth::user()->role_as,'Registrar') !== 0)
                            <select class="table_content_select" name="registrar" style="color:orange" readonly tabindex="-1">
                        @endif
                        @if($student_id->registrar == "REJECTED" && strcasecmp(Auth::user()->role_as,'Registrar') !== 0)
                            <select class="table_content_select" name="registrar" style="color:red" readonly tabindex="-1">
                        @endif
                        @if($student_id->registrar == "APPROVED" && strcasecmp(Auth::user()->role_as,'Registrar') !== 0)
                            <select class="table_content_select" name="registrar" style="color:green" readonly tabindex="-1">
                        @endif
                        <option style="border: 1px solid black; text-align:center" value="{{$student_id->registrar}}">{{$student_id->registrar}}</option>
                       
                        
                        @if($student_id->registrar !== "IN-PROGRESS")
                        <option style="border: 1px solid black; text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                        @endif
                        @if($student_id->registrar !== "COMPLY")
                        <option style="border: 1px solid black; text-align:center; color: orange"value="COMPLY">COMPLY</option>
                        @endif
                        @if($student_id->registrar !== "APPROVED")
                        <option style="border: 1px solid black; text-align:center; color:green;"value="APPROVED">APPROVED</option>
                        @endif
                        @if($student_id->registrar !== "REJECTED")
                        <option style="border: 1px solid black; text-align:center; color:red"value="REJECTED">REJECTED</option>
                        @endif
                        </select>
                    </p>
                    @if((strcasecmp(Auth::user()->role_as,'Registrar') == 0) && ($student_id->registrar == "REJECTED" || $student_id->registrar == "COMPLY") && ($student_id->registrar_description !== null || $student_id->registrar_description == null)) 
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_registrar_Form()">View Detail</a></p>
                    @endif
                    @if((strcasecmp(Auth::user()->role_as,'Registrar') == 0) && ($student_id->registrar_description == null || $student_id->registrar_description !== null) && ($student_id->registrar == "IN-PROGRESS"))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_registrar_Form()">Add Detail</a></p>
                    @endif
                    <div class="signee-description-form-popup" id="edit_registrar_form">
                        <textarea class="signee_description_info" name="registrar_description" value="{{$student_id->registrar_description}}">{{$student_id->registrar_description}}</textarea>
                        <button type="button" class="btn cancel signee_close_btn" onclick="close_edit_registrar_Form()">Close</button>  
                    </div>
            </div>
            <div class="column" >
                <h5 class="table_content_header"  style="border: 1px solid black; text-align:center">Accounting Assessment</h5>
                    <p class="table_content_select" style="border: 1px solid black; text-align:center">
                        @if($student_id->accounting_assessment == "IN-PROGRESS" && strcasecmp(Auth::user()->role_as,'Accounting Assessment') == 0)
                            <select class="table_content_select" name="accounting_assessment" style="color:blue">
                        @endif
                        @if($student_id->accounting_assessment == "COMPLY" && strcasecmp(Auth::user()->role_as,'Accounting Assessment') == 0)
                            <select class="table_content_select" name="accounting_assessment" style="color:orange">
                        @endif
                        @if($student_id->accounting_assessment == "REJECTED" && strcasecmp(Auth::user()->role_as,'Accounting Assessment') == 0)
                            <select class="table_content_select" name="accounting_assessment" style="color:red">
                        @endif
                        @if($student_id->accounting_assessment == "APPROVED" && strcasecmp(Auth::user()->role_as,'Accounting Assessment') == 0)
                            <select class="table_content_select" name="accounting_assessment" style="color:green">
                        @endif

                        @if($student_id->accounting_assessment == "IN-PROGRESS" && strcasecmp(Auth::user()->role_as,'Accounting Assessment') !== 0)
                            <select class="table_content_select" name="accounting_assessment" style="color:blue" readonly tabindex="-1">
                        @endif
                        @if($student_id->accounting_assessment == "COMPLY" && strcasecmp(Auth::user()->role_as,'Accounting Assessment') !== 0)
                            <select class="table_content_select" name="accounting_assessment" style="color:orange" readonly tabindex="-1">
                        @endif
                        @if($student_id->accounting_assessment == "REJECTED" && strcasecmp(Auth::user()->role_as,'Accounting Assessment') !== 0)
                            <select class="table_content_select" name="accounting_assessment" style="color:red" readonly tabindex="-1">
                        @endif
                        @if($student_id->accounting_assessment == "APPROVED" && strcasecmp(Auth::user()->role_as,'Accounting Assessment') !== 0)
                            <select class="table_content_select" name="accounting_assessment" style="color:green" readonly tabindex="-1">
                        @endif
                        <option style="border: 1px solid black; text-align:center" value="{{$student_id->accounting_assessment}}">{{$student_id->accounting_assessment}}</option>
                       
                        
                        @if($student_id->accounting_assessment !== "IN-PROGRESS")
                        <option style="border: 1px solid black; text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                        @endif
                        @if($student_id->accounting_assessment !== "COMPLY")
                        <option style="border: 1px solid black; text-align:center; color: orange"value="COMPLY">COMPLY</option>
                        @endif
                        @if($student_id->accounting_assessment !== "APPROVED")
                        <option style="border: 1px solid black; text-align:center; color:green;"value="APPROVED">APPROVED</option>
                        @endif
                        @if($student_id->accounting_assessment !== "REJECTED")
                        <option style="border: 1px solid black; text-align:center; color:red"value="REJECTED">REJECTED</option>
                        @endif
                        </select>
                    </p>
                        @if((strcasecmp(Auth::user()->role_as,'Accounting Assessment') == 0) && ($student_id->accounting_assessment == "REJECTED" || $student_id->accounting_assessment == "COMPLY") && ($student_id->accounting_assessment_description !== null || $student_id->accounting_assessment_description == null))  
                            <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_assessment_Form()">View Detail</a></p>
                        @endif
                        @if(( strcasecmp(Auth::user()->role_as,'Accounting Assessment') == 0) && ($student_id->accounting_assessment_description == null || $student_id->accounting_assessment_description !== null) && ($student_id->accounting_assessment == "IN-PROGRESS"))  
                            <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_edit_assessment_Form()">Add Detail</a></p>
                        @endif
                        <div class="signee-description-form-popup" id="edit_assessment_form">
                            <textarea class="signee_description_info" name="accounting_assessment_description" value="{{$student_id->accounting_assessment_description}}">{{$student_id->accounting_assessment_description}}</textarea>
                            <button type="button" class="btn cancel signee_close_btn" onclick="close_edit_assessment_Form()">Close</button>  
                        </div>
            </div>
        </div>
        </div>
            <button type="submit" style="border-radius: 2px" class="btn_update_signee btn-primary">Update User</button>
    {!! Form::close() !!}
    </div>
    

</div>    
               
 
@endsection