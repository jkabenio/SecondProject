@extends('layouts.signee-app')
 
@section('content')
<div class="clearance_body_signee">
    <div class="card"> 
       
        <div class="card-header" style="text-align: center"><b>SIGNEE DASHBOARD</b></div>
        @if (session('success'))
        <div style="text-align:center"  class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div style="text-align:center"  class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="first_row" style="margin-top: 5%">
            @if(Auth::user()->role_as == "Instructor")
                <div class="two_column_signee_dashboard">
                    <div class="card bg-primary text-white mb-4">                       
                            <div class="cards_logo"><img class="image_design" src="{{ asset('/img/people.png') }}"  alt="Italian Trulli"></div>
                            <p class="users_count"><b>{{$assigned_subject_count}}&nbsp;Subjects</b></p>
                            <p class="description" style="text-align: center">You have {{$assigned_subject_count}} subjects at this semester.</p>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="view_details" href="#"></a>
                            <div class="small text-white"><i class="fa fa-caret-down"></i></div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="two_column_signee_dashboard">
                <div class="card text-white mb-4" style="background-color: rgb(86, 5, 124)">
                    <div class="cards_logo"><img class="image_design" src="{{ asset('/img/students.png') }}"  alt="Italian Trulli" style="width: 75px; height: 75px; padding-top: 10px;"></div>
                   
                    @if((strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') == 0) || (strcasecmp(Auth::user()->role_as,'Dean Principal')== 0))
                    
                        <p class="users_count"><b>{{$same_dept}}&nbsp;Student</b></p>
                        <p class="description" style="text-align: center">You have {{$same_dept}} at this semester.</p>
                    @endif
                    @if(strcasecmp(Auth::user()->role_as, "Instructor") == 0)
                        <p class="users_count"><b>{{  $assigned_student_count}}&nbsp;Student</b></p>
                        <p class="description" style="text-align: center">You have {{  $assigned_student_count}} at this semester.</p>
                    @endif
                    
                    @if((strcasecmp(Auth::user()->role_as,'Librarian') == 0) || 
                    (strcasecmp(Auth::user()->role_as,'Dean of Student Affair')== 0) || 
                    (strcasecmp(Auth::user()->role_as,'Guidance Counselor')== 0) || 
                    (strcasecmp(Auth::user()->role_as,'Registrar')== 0) || 
                    (strcasecmp(Auth::user()->role_as,'Accounting Assessment')== 0))
                    
                        <p class="users_count"><b>{{$student_count}}&nbsp;Student</b></p>
                        <p class="description" style="text-align: center">You have {{$student_count}} student at this semester.</p>
                    @endif
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="view_details" href="{{url('/signee/view-signee-pending-request')}}">View Details</a>
                        <div class="small text-white"><i class="fa fa-caret-down"></i></i></div>
                    </div>
                </div>
            </div>

            <div class="two_column_signee_dashboard">
                <div class="card text-white mb-4" style="background-color: brown">
                    <div class="cards_logo"><img class="image_design" src = "{{ asset('/img/signature.png') }}" alt="Italian Trulli"></div>
                    
                    @if(strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') == 0)
                        <p class="users_count"><b>{{ $student_org_count}}&nbsp;Request</b></p>
                        <p class="description" style="text-align: center">You have {{$student_org_count}} request at this semester.</p>
                    @endif

                    @if(strcasecmp(Auth::user()->role_as, "Dean Principal") == 0)
                        <p class="users_count"><b>{{$dean_principal_count}}&nbsp;Request</b></p>
                        <p class="description" style="text-align: center">You have {{$dean_principal_count}} request at this semester.</p>
                    @endif

                    @if(strcasecmp(Auth::user()->role_as, "Instructor") == 0)
                        <p class="users_count"><b>{{$status_count_to_student}}&nbsp;Request</b></p>
                        <p class="description" style="text-align: center">You have {{$status_count_to_student}} request at this semester.</p>
                    @endif

                    @if(strcasecmp(Auth::user()->role_as,'Librarian') == 0)
                        <p class="users_count"><b>{{ $librarian_request}}&nbsp;Request</b></p>
                        <p class="description" style="text-align: center">You have {{$librarian_request}} request at this semester.</p>
                    @endif

                    @if(strcasecmp(Auth::user()->role_as,'Dean of Student Affair')== 0)
                        <p class="users_count"><b>{{ $student_affair_request}}&nbsp;Request</b></p>
                        <p class="description" style="text-align: center">You have {{$student_affair_request}} request at this semester.</p>
                    @endif

                    @if(strcasecmp(Auth::user()->role_as,'Guidance Counselor')== 0)
                        <p class="users_count"><b>{{ $guidance_councilor_request}}&nbsp;Request</b></p>
                        <p class="description" style="text-align: center">You have {{$guidance_councilor_request}} request at this semester.</p>
                    @endif

                    @if(strcasecmp(Auth::user()->role_as,'Registrar')== 0)
                        <p class="users_count"><b>{{ $registrar_request}}&nbsp;Request</b></p>
                        <p class="description" style="text-align: center">You have {{$registrar_request}} request at this semester.</p>
                    @endif
                    @if(strcasecmp(Auth::user()->role_as,'Accounting Assessment')== 0)
                        <p class="users_count"><b>{{ $assessment_request}}&nbsp;Request</b></p>
                        <p class="description" style="text-align: center">You have {{$assessment_request}} request at this semester.</p>
                    @endif                   
                        <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="view_details" href="{{url('/signee/view-signee-pending-request')}}">View Details</a>
                        <div class="small text-white"><i class="fa fa-caret-down"></i></div>
                    </div>
                </div>
            </div> 
        </div> 
    </div>
</div>
<style>
    .view_details:hover{
        color:rgb(3, 3, 201) !important;
        background-color:rgba(0, 0, 255, 0);
    }
    .view_details{
        font-size: 80%;
        color:white;
    }
   </style>

<style>
    .description{
        font-size: 10px;
    }
    .users_count{
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 0px; 
    margin-top: 0px;
    }
    .image_design{
        width: 75px;
        height: 75px;
        padding:5px;
    }
    .cards_logo{
    width: 85px;
    height: 85px;
    border: solid;
    border-radius: 100px;
    border-color: black;
    margin-left: auto;
    margin-right: auto;
    margin-top: 15px;          
    background-color: rgba(226, 223, 223, 0.605);
    }
     
    </style> 
@endsection
