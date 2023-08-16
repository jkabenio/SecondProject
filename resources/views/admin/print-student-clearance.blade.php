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
    table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #D6EEEE;
}
    </style>
            <div class="clearance_body">
                <div  class="card" style=" border: 2px solid black">
                    <div class="card-header">
                        <div class="container">
                            <div class="error">
                                @if(count($errors) > 0)
                                    @foreach($errors->all() as $error)
                                        <div class="alert alert-danger" style="text-align: center">
                                            {{$error}}
                                        </div>
                                    @endforeach
                                @endif
                        
                                @if(session('success'))
                                    <div class="alert alert-success" style="text-align: center">
                                        {{session('success')}}
                                    </div>
                                @endif
                        
                                @if(session('error'))
                                    <div class="alert alert-danger" style="text-align: center">
                                        {{session('error')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <h4 style="text-align:center;font-weight: bold;">Student List</h4>
                    </div>
                    <div  class="card-body">
                        <table class="table table-bordered" style="border: 1px solid black">
                            <thead >
                                <tr >
                                    {{-- <form action="{{ route('admin.print-student-clearance') }}" method="GET">
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
                                    </form> --}}
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Year Level</th>
                                    <th>Semester</th>
                                    <th>School ID</th>
                                    <th>Clearance</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @php
                                    $index_count = 1;
                                @endphp 
                                @foreach($complete_request as $user)
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
                                    ?>
                                    @if($pass_approved_total_value == $pass_status__total_value)
                                        <tr>
                                            
                                            <td>{{$index_count++}}</td>
                                            <td>{{$user->name}}</td>
                                                @foreach($course as $course_id)
                                                    @if($course_id->id == $user->course)
                                                        <td>{{$course_id->course_acronym}}</td>
                                                    @endif
                                                @endforeach
                                            <td>{{$user->year_lvl}}</td>
                                            <td>{{$user->semester}}</td>
                                            <td>{{$user->school_id}}</td>
                                            <td style="color: green"><b>Completed</b></td>          
                                        </tr>
                                    @endif
                                @endforeach 
                                <a href="{{url ('admin/view-generate-pdf')}}" class="btn btn-success" style="float: right"><i class="fa fa-print"></i> Generate PDF</a>
                        </tbody>
                    </table>
                </div>  
            </div>
        </div>
        <div class="clearance_body">
            <div  class="card" style=" border: 2px solid black">
                <div class="card-header">
                    <div class="container">
                        <div class="error">
                            @if(count($errors) > 0)
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger" style="text-align: center">
                                        {{$error}}
                                    </div>
                                @endforeach
                            @endif
                    
                            @if(session('success'))
                                <div class="alert alert-success" style="text-align: center">
                                    {{session('success')}}
                                </div>
                            @endif
                    
                            @if(session('error'))
                                <div class="alert alert-danger" style="text-align: center">
                                    {{session('error')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <h4 style="text-align:center;font-weight: bold;">Student List</h4>
                </div>
                <div  class="card-body">
                    <table class="table table-bordered" style="border: 1px solid black">
                        <thead >
                            <tr >
                                <th>No.</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Year Level</th>
                                <th>Semester</th>
                                <th>School ID</th>
                                <th>Clearance</th>
                            </tr>
                        </thead> 
                        <tbody>
                            @php
                                $index_count = 1;
                            @endphp 
                            @foreach($complete_request as $user)
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
                                ?>
                                @if($pass_approved_total_value !== $pass_status__total_value)
                                    <tr>
                                        
                                        <td>{{$index_count++}}</td>
                                        <td>{{$user->name}}</td>
                                            @foreach($course as $course_id)
                                                @if($course_id->id == $user->course)
                                                    <td>{{$course_id->course_acronym}}</td>
                                                @endif
                                            @endforeach
                                        <td>{{$user->year_lvl}}</td>
                                        <td>{{$user->semester}}</td>
                                        <td>{{$user->school_id}}</td>
                                        <td style="color: red"><b>Incomplete</b></td>          
                                    </tr>
                                @endif
                            @endforeach 
                    </tbody>
                </table>
            </div>  
        </div>
    </div>  
@endsection
