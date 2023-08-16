@extends('layouts.admin-app')

@section('content')
 <style>
* {
    box-sizing: border-box;
}

/* Create three equal columns that floats next to each other */
.column {
    float: left !important;
    width: 20%;
}

/* Clear floats after the columns */
.clearance_row:after {
    content: "";
    display: table;
    clear: both;
}
.clearance_row{
    width:100%;
    

}
.clearance_row{
    border: 1px solid;
    width:100%;
}
.table_content{
    white-space: nowrap; 
    width: 100%; 
    overflow: hidden;
    text-overflow: clip; 
}
.edit_student_view{
    padding-top: 39px;
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

<script type="text/javascript">
    $(document).ready(function(){
        
        $(document).on('change','.courselist',function(){
            // console.log("hmm nag bago na");

            var course_id=$(this).val();
            // console.log(course_id);
            var div=$(this).parent();
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('/admin/FindSubjectName')!!}',
                data:{'id':course_id},
                success:function(data){
                    // console.log('success');

                    // console.log(data);

                    // console.log(data.length);
                    op+='<label><option  value="0" selected disabled>Select subjects</option></label>';
                    for(var i=0;i<data.length;i++){
                        op+='<label><input type="checkbox" name="subjects[]" value="'+data[i].subj_name+'"><b>'+data[i].subj_name+'</b><br><input type="text" readonly="readonly" name="student_section[]" value="'+data[i].section+'"><input type="text" readonly="readonly" name="student_signee_names[]" value="'+data[i].signee_names+'"><input type="text" readonly="readonly" name="description[]" value="None"><input type="text" readonly="readonly" name="status[]" value="In-progress"></label>';
                    }
                    div.find('.subjectlist').html("");
                    div.find('.subjectlist').append(op);
                },
                error:function(){

                }
            });
        });
    });
</script>
<style>
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
  .form-container-activity .btn_cancel:hover, .open-button:hover {
    opacity: 1;
  } 
   /* Remove scrollbar space */
    /* Optional: just make scrollbar invisible */
  ::-webkit-scrollbar {
  width: 0; 
  background: transparent; 
  }
  .btn.cancel{
   
    background-color: red;
    color: white;

  }
  .description_info{
    height: 155px;
    width: 490px;
  }

  select[readonly]
{
    pointer-events: none;
}
/* irrelevent styling */
*[readonly]
{

}

.edit_student_column{
    width: 50%;
    float: left;
    padding: 5px;
}
.form-control{
 background-color: #e9ecef;
}
.edit_user_label{
font-weight: bold;
margin-left: 250px;
}
.edit_student_column_header{
    font-weight: bold;
}
</style>

<?php
$total_count = 0;
$status_count = 0;
foreach ($student_id->status as $status_list) { 
    if($status_list !== "APPROVED"){
        $status_count--;
    }
    if($status_list == "APPROVED"){
        $status_count++;
    }
    $total_count++;
}

?>
<div class="edit_student_view">
    <div class="card" style="width:100%; border: 2px solid black;">
        <div class="card-header">
            <div class="error">
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger" style="text-align: center;">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
        
                @if(session('success'))
                    <div class="alert alert-success" style="text-align: center;">
                        {{session('success')}}
                    </div>
                @endif
        
                @if(session('error'))
                    <div class="alert alert-danger" style="text-align: center;">
                        {{session('error')}}
                    </div>
                @endif
            </div>
            <h4 style="text-align:center;font-weight: bold;"> <b> Edit User </b>
                <a href="{{url('/admin/view-student-user')}}" class="btn btn-danger float-end">BACK</a>
            </h4>
        </div>
        
        {!! Form::open(['action' => ['App\Http\Controllers\Admin\AdminController@update_student',$student_id->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="card-body">
            @csrf 
            @method('PUT')
           
            <div class="edit_student_column">
                <label  class="edit_user_label">Student Name <span style="font-weight: normal; font-size: 10px">(Editable)</span></label>
                <input style="text-align: center" type="text" name="name" value="{{$student_id->name}}" class="form-control">
            </div>
            <div class="edit_student_column">
                <label class="edit_user_label">Student Email<span style="font-weight: normal; font-size: 10px">(Editable) </span></label>
                <input style="text-align: center" type="text" name="email" value="{{$student_id->email}}" class="form-control">
            </div>

            <div class="edit_student_column">
                <label class="edit_user_label">Student School ID<span style="font-weight: normal; font-size: 10px">(Editable) </span></label>
                <input style="text-align: center" name="school_id" type="text" value="{{$student_id->school_id}}" class="form-control">
            </div> 

            <div class="edit_student_column">
                <label class="edit_user_label">Department <span style="font-weight: normal; font-size: 10px">(Editable) </span></label>
                <select style="text-align: center" name="dept_id" class="form-control">
                    @foreach($department as $list)
                        @if($student_id->dept_id == $list->id)
                            <option value={{$student_id->dept_id}}>{{$list->dept_name}}</option>
                        @endif
                    @endforeach
                    @foreach($department as $list)
                    @if($student_id->dept_id !== $list->id)
                        <option value="{{$list->id}}">{{$list->dept_name}}</option>
                    @endif
                    @endforeach
                </select>  
            </div>


            <div class="edit_student_column">
                <label class="edit_user_label">Course <span style="font-weight: normal; font-size: 10px">(Editable) </span></label>
                <select style="text-align: center" name="course" class="form-control">
                    @foreach ($course as $list)
                        @if($list->id == $student_id->course)
                            <option value="{{$list->id}}">{{$list->course_name}}</option>
                        @endif
                        @if($list->id !== $student_id->course)
                            <option  value="{{$list->id}}">{{$list->course_name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            

            <div class="edit_student_column">
                <label class="edit_user_label">Year Level <span style="font-weight: normal; font-size: 10px">(Editable) </span></label>
                <select style="text-align: center" name="year_lvl" class="form-control">
                    <option value="{{$student_id->year_lvl}}">{{$student_id->year_lvl}}</option>
                    @if($student_id->year_lvl !== "1st Year")
                        <option value="1st Year">1st Year</option>
                    @endif
                    @if($student_id->year_lvl !== "2nd Year Year")
                        <option value="2nd Year">2nd Year</option>
                    @endif
                    @if($student_id->year_lvl !== "3rd Year")
                        <option value="3rd Year">3rd Year</option>
                    @endif
                    @if($student_id->year_lvl !== "4th Year")
                        <option value="4th Year">4th Year</option>
                    @endif
                </select> 
            </div>

            <div class="edit_student_column">
                <label class="edit_user_label">Semester <span style="font-weight: normal; font-size: 10px">(Editable) </span></label>
                <select style="text-align: center" name="semester" class="form-control">
                    <option value="{{$student_id->semester}}">{{$student_id->semester}}</option>
                    @if($student_id->semester !== "1st semester")
                        <option value="1st semester">1st semester</option>
                    @endif
                    @if($student_id->semester !== "2nd semester")
                        <option value="2nd semester">2nd semester</option>
                    @endif
                    @if($student_id->semester !== "summer class")
                        <option value="summer class">summer class</option>
                    @endif
                </select>
            </div>

            
            {{-- <div class="edit_student_column">
                <label class="edit_user_label">Updated At</label>
                <p style="text-align: center" class="form-control">
                    {{date('M,d,D,Y,g:i A',strtotime($student_id->updated_at))}}</p>
            </div>
            <div class="edit_student_column">
                <label class="edit_user_label">Created At</label>
                <p style="text-align: center" class="form-control">
                    {{date('M,d,D,Y,g:i A',strtotime($student_id->created_at))}}</p>
            </div> --}}
            <div class="edit_student_column">
                <label class="edit_user_label">Enrolled Subjects</label>
                {{-- <select style="text-align: center" name="subjectsp[]" class="form-control"> --}}
                    {{-- <option type="checkbox" selected="true" disabled="true">Select subjects</option> --}}
                    @foreach ($student_id->subjects as $subject_list)  
                    <input style="text-align: center; width: 50%; float: left" type="text" readonly class="form-control" value="{{$subject_list}}"/>
                @endforeach
                {{-- </select> --}}
            </div>
        <div class="clearance_row">
            <div class="column">
                <h5 class="edit_student_column_header" style="border: 1px solid black; text-align:center; height:50px">Instructor</h5>
                @foreach ($student_id->student_signee_names as $signee_list)  
                    <p class="table_content" style="border: 1px solid black">{{$signee_list}}</p>
                @endforeach
            </div>
            <div class="column" >
                <h5 class="edit_student_column_header" style="border: 1px solid black; text-align:center; height:50px">Subject</h5>
                @foreach ($student_id->subjects as $subject_list)  
                    <p class="table_content" style="border: 1px solid black">{{$subject_list}}</p>
                @endforeach
            </div>
            <div class="column" >
                <h5 class="edit_student_column_header" style="border: 1px solid black; text-align:center; height:50px">Section</h5>
                @foreach ($student_id->student_section as $section_list)  
                    <p class="table_content" style="border: 1px solid black; text-align:center;">{{$section_list}}</p>
                @endforeach
            </div>
            <div class="column" >
                <h5 class="edit_student_column_header" style="border: 1px solid black; text-align:center; height:50px">Status</h5>
                @foreach ($student_id->status as $status_list)  
                    <p class="table_content" style="border: 1px solid black; text-align:center;">
                        @if($status_list == "IN-PROGRESS")
                        <select  readonly tabindex="-1" style="color:blue; padding: 0px; margin: 0px;font-size: 14px;">
                        @endif
                        @if($status_list == "COMPLY")
                        <select  readonly tabindex="-1" style="color:orange; padding: 0px; margin: 0px;font-size: 14px;">
                        @endif
                        @if($status_list == "REJECTED")
                        <select readonly tabindex="-1" style="color:red; padding: 0px; margin: 0px;font-size: 14px;">
                        @endif
                        @if($status_list == "APPROVED")
                        <select  readonly tabindex="-1" style="color:green; padding: 0px; margin: 0px;font-size: 14px;">
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
            <div class="column" > 
                <h5 class="edit_student_column_header" style="border:1px solid black; text-align:center; height:50px">Description</h5>
                @foreach ($student_id->description as $index => $description_list)
                    @if($description_list !== null)  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="opensigneeForm({{$index}})">View Detail</a></p>
                    @endif
                    @if($description_list == null)  
                    <p class="table_content" style="border: 1px solid black; text-align:center;"><a value="{{$description_list}}" onclick="opensigneeForm({{$index}})">Add Detail</a></p>
                    @endif
                    <div class="form-popup" id="signeeForm{{$index}}">
                            <textarea class="description_info" value="{{$description_list}}">{{$description_list}}</textarea>
                          <button type="button" class="btn cancel" onclick="closesigneeForm({{$index}})">Close</button>
                      </div>
                @endforeach
            </div>
        </div>
        <div class="clearance_row">
            <div class="column">
                <h5 class="edit_student_column_header" style="border: 1px solid black; text-align:center; height:50px">Guidance Councilor</h5>
                    <p class="table_content" style="border: 1px solid black; text-align:center">
                        @if($student_id->guidance_councilor == "IN-PROGRESS")
                        <select readonly tabindex="-1" name="guidance_councilor" style="color:blue">
                        @endif
                        @if($student_id->guidance_councilor == "COMPLY")
                        <select readonly tabindex="-1" name="guidance_councilor" style="color:orange">
                        @endif
                        @if($student_id->guidance_councilor == "REJECTED")
                        <select readonly tabindex="-1" name="guidance_councilor" style="color:red">
                        @endif
                        @if($student_id->guidance_councilor == "APPROVED")
                        <select readonly tabindex="-1" name="guidance_councilor" style="color:green">
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
                    @if(($student_id->guidance_councilor == "REJECTED" || $student_id->guidance_councilor == "COMPLY") && ($student_id->guidance_councilor_description !== null || $student_id->guidance_councilor_description == null))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_guidance_councilor_Form()">View Detail</a></p>
                    @endif
                    @if(($student_id->guidance_councilor_description == null || $student_id->guidance_councilor_description !== null) && ($student_id->guidance_councilor == "IN-PROGRESS"))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_guidance_councilor_Form()">Add Detail</a></p>
                    @endif
                    <div class="form-popup" id="guidance_councilor_form">
                        <textarea class="description_info" name="guidance_councilor_description" value="{{$student_id->guidance_councilor_description}}">{{$student_id->guidance_councilor_description}}</textarea>
                        <button type="button" class="btn cancel" onclick="close_guidance_councilor_Form()">Close</button>  
                    </div>
            </div>
                
            <div class="column" >
                <h5 class="edit_student_column_header" style="border: 1px solid black; text-align:center; height:50px">Student Org. Treasurer</h5>
                    <p class="table_content" style="border: 1px solid black; text-align:center">
                        @if($student_id->student_org_treasurer == "IN-PROGRESS")
                        <select readonly tabindex="-1" name="student_org_treasurer" style="color:blue">
                        @endif
                        @if($student_id->student_org_treasurer == "COMPLY")
                            <select readonly tabindex="-1" name="student_org_treasurer" style="color:orange">
                        @endif
                        @if($student_id->student_org_treasurer == "REJECTED")
                            <select readonly tabindex="-1" name="student_org_treasurer" style="color:red">
                        @endif
                        @if($student_id->student_org_treasurer == "APPROVED")
                            <select readonly tabindex="-1" name="student_org_treasurer" style="color:green">
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
                    @if(($student_id->student_org_treasurer == "REJECTED" || $student_id->student_org_treasurer == "COMPLY") && ($student_id->student_org_description == null || $student_id->student_org_description !== null))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_treasurer_Form()">View Detail</a></p>
                    @endif
                    @if(($student_id->student_org_description == null || $student_id->student_org_description !== null) && ($student_id->student_org_treasurer == "IN-PROGRESS"))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_treasurer_Form()">Add Detail</a></p>
                    @endif
                    <div class="form-popup" id="student_org">
                            <textarea class="description_info" name="student_org_description" value="{{$student_id->student_org_description}}">{{$student_id->student_org_description}}</textarea>
                            <button type="button" class="btn cancel" onclick="close_treasurer_Form()">Close</button>
                    </div>
            </div>
        
            <div class="column" >
                <h5 class="edit_student_column_header" style="border: 1px solid black; text-align:center; height:50px">Librarian</h5>
                    <p class="table_content" style="border: 1px solid black; text-align:center">
                        @if($student_id->librarian == "IN-PROGRESS")
                            <select readonly tabindex="-1" name="librarian" style="color:blue" >
                        @endif
                        @if($student_id->librarian == "COMPLY")
                            <select readonly tabindex="-1" name="librarian" style="color:orange">
                        @endif
                        @if($student_id->librarian == "REJECTED")
                            <select readonly tabindex="-1" name="librarian" style="color:red">
                        @endif
                        @if($student_id->librarian == "APPROVED")
                            <select readonly tabindex="-1" name="librarian" style="color:green">
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
                    @if(($student_id->librarian == "REJECTED" || $student_id->librarian == "COMPLY") && ($student_id->librarian_description !== null || $student_id->librarian_description == null))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_librarian_Form()">View Detail</a></p>
                    @endif
                    @if(($student_id->librarian_description == null || $student_id->librarian_description !== null) && ($student_id->librarian == "IN-PROGRESS"))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_librarian_Form()">Add Detail</a></p>
                    @endif
                    <div class="form-popup" id="librarian_form">
                        <textarea class="description_info" name="librarian_description" value="{{$student_id->librarian_description}}">{{$student_id->librarian_description}}</textarea>
                        <button type="button" class="btn cancel" onclick="close_librarian_Form()">Close</button>  
                    </div>
            </div>
            <div class="column" >
                <h5 class="edit_student_column_header" style="border: 1px solid black; text-align:center; height:50px">Dean of Student Affair</h5>
                    <p class="table_content" style="border: 1px solid black; text-align:center">
                        @if($student_id->dean_of_student_affair == "IN-PROGRESS")
                        <select readonly tabindex="-1" name="dean_of_student_affair" style="color:blue">
                        @endif
                        @if($student_id->dean_of_student_affair == "COMPLY")
                        <select readonly tabindex="-1" name="dean_of_student_affair" style="color:orange">
                        @endif
                        @if($student_id->dean_of_student_affair == "REJECTED")
                        <select readonly tabindex="-1" name="dean_of_student_affair" style="color:red">
                        @endif
                        @if($student_id->dean_of_student_affair == "APPROVED")
                        <select readonly tabindex="-1" name="dean_of_student_affair" style="color:green">
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
                    @if(($student_id->dean_of_student_affair == "REJECTED" || $student_id->dean_of_student_affair == "COMPLY") && ($student_id->dean_of_student_affair_description !== null || $student_id->dean_of_student_affair_description == null)) 
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_studentaffair_Form()">View Detail</a></p>
                    @endif
                    @if(($student_id->dean_of_student_affair_description == null || $student_id->dean_of_student_affair_description !== null) && ($student_id->dean_of_student_affair == "IN-PROGRESS"))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_studentaffair_Form()">Add Detail</a></p>
                    @endif
                        <div class="form-popup" id="studentaffair_form">
                        <textarea class="description_info" name="dean_of_student_affair_description" value="{{$student_id->dean_of_student_affair_description}}">{{$student_id->dean_of_student_affair_description}}</textarea>
                        <button type="button" class="btn cancel" onclick="close_studentaffair_Form()">Close</button>  
                    </div>
            </div>
            <div class="column" >
                <h5 class="edit_student_column_header" style="border: 1px solid black; text-align:center; height:50px">Dean Principal</h5>
                    <p class="table_content" style="border: 1px solid black; text-align:center">
                        @if($student_id->dean_principal == "IN-PROGRESS")
                        <select readonly tabindex="-1" name="dean_principal" style="color:blue">
                        @endif
                        @if($student_id->dean_principal == "COMPLY")
                        <select readonly tabindex="-1" name="dean_principal" style="color:orange">
                        @endif
                        @if($student_id->dean_principal == "REJECTED")
                        <select readonly tabindex="-1" name="dean_principal" style="color:red">
                        @endif
                        @if($student_id->dean_principal == "APPROVED")
                        <select readonly tabindex="-1" name="dean_principal" style="color:green">
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
                    @if(($student_id->dean_principal == "REJECTED" || $student_id->dean_principal == "COMPLY") && ($student_id->dean_principal_description !== null || $student_id->dean_principal_description == null)) 
                    <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_deanprincipal_Form()">View Detail</a></p>
                    @endif
                    @if(($student_id->dean_principal_description == null || $student_id->dean_principal_description !== null) && ($student_id->dean_principal == "IN-PROGRESS"))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_deanprincipal_Form()">Add Detail</a></p>
                    @endif
                    <div class="form-popup" id="deanprincipal_form">
                    <textarea class="description_info" name="dean_principal_description" value="{{$student_id->dean_principal_description}}">{{$student_id->dean_principal_description}}</textarea>
                    <button type="button" class="btn cancel" onclick="close_deanprincipal_Form()">Close</button>  
                </div>
            </div>
            <div class="column" >
                <h5 class="edit_student_column_header" style="border: 1px solid black; text-align:center; height:50px">Registrar</h5>
                    <p class="table_content" style="border: 1px solid black; text-align:center">
                        @if($student_id->registrar == "IN-PROGRESS")
                        <select readonly tabindex="-1" name="registrar" style="color:blue">
                        @endif
                        @if($student_id->registrar == "COMPLY")
                        <select readonly tabindex="-1" name="registrar" style="color:orange">
                        @endif
                        @if($student_id->registrar == "REJECTED")
                        <select readonly tabindex="-1" name="registrar" style="color:red">
                        @endif
                        @if($student_id->registrar == "APPROVED")
                        <select readonly tabindex="-1" name="registrar" style="color:green">
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
                    @if(($student_id->registrar == "REJECTED" || $student_id->registrar == "COMPLY") && ($student_id->registrar_description !== null || $student_id->registrar_description == null)) 
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_registrar_Form()">View Detail</a></p>
                    @endif
                    @if(($student_id->registrar_description == null || $student_id->registrar_description !== null) && ($student_id->registrar == "IN-PROGRESS"))  
                        <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_registrar_Form()">Add Detail</a></p>
                    @endif
                    <div class="form-popup" id="registrar_form">
                        <textarea class="description_info" name="registrar_description" value="{{$student_id->registrar_description}}">{{$student_id->registrar_description}}</textarea>
                        <button type="button" class="btn cancel" onclick="close_registrar_Form()">Close</button>  
                    </div>
            </div>
            <div class="column" >
                <h5 class="edit_student_column_header" style="border: 1px solid black; text-align:center; height:50px">Accounting Assessment</h5>
                    <p class="table_content" style="border: 1px solid black; text-align:center">
                        @if($student_id->accounting_assessment == "IN-PROGRESS")
                        <select readonly tabindex="-1" name="accounting_assessment" style="color:blue">
                        @endif
                        @if($student_id->accounting_assessment == "COMPLY")
                        <select readonly tabindex="-1" name="accounting_assessment" style="color:orange">
                        @endif
                        @if($student_id->accounting_assessment == "REJECTED")
                        <select readonly tabindex="-1" name="accounting_assessment" style="color:red">
                        @endif
                        @if($student_id->accounting_assessment == "APPROVED")
                        <select readonly tabindex="-1" name="accounting_assessment" style="color:green">
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
                        @if(($student_id->accounting_assessment == "REJECTED" || $student_id->accounting_assessment == "COMPLY") && ($student_id->accounting_assessment_description !== null || $student_id->accounting_assessment_description == null))  
                            <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_assessment_Form()">View Detail</a></p>
                        @endif
                        @if(($student_id->accounting_assessment_description == null || $student_id->accounting_assessment_description !== null) && ($student_id->accounting_assessment == "IN-PROGRESS"))  
                            <p class="table_content" style="border: 1px solid black; text-align:center;"><a onclick="open_assessment_Form()">Add Detail</a></p>
                        @endif
                        <div class="form-popup" id="assessment_form">
                            <textarea class="description_info" name="accounting_assessment_description" value="{{$student_id->accounting_assessment_description}}">{{$student_id->accounting_assessment_description}}</textarea>
                            <button type="button" class="btn cancel" onclick="close_assessment_Form()">Close</button>  
                        </div>
            </div>
    </div>
        <div>
            <button type="submit" class="btn btn-primary" style="margin-left: 560px; margin-top: 5px;margin-bottom: 0px">Update User</button>
        </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<br>



@endsection