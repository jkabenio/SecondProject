@extends('layouts.admin-app')

@section('content')

<div class="dashboard_view">
    <div class="card" >
        <div class="card-header" style="text-align: center"><b>ADMIN DASHBOARD</b></div>
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
        <div class="first_row" style="margin-top: 5%;z-index: 0"> 
            <div class="two_column">
                <div class="card bg-primary text-white mb-4" >                       
                        <div class="cards_logo"><img class="image_design" src="{{ asset('/img/people.png') }}" alt="Italian Trulli"></div>
                        <p class="users_count"><b>{{$total_users}}&nbsp;Users</b></p>
                        <p class="description">You have {{$total_users}} users in the database.<br>
                                this are the sum of all student, signee, and admin user.</p>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white" href="#"></a>
                        <div class="small text-white"><i class="fa fa-caret-down"></i></div>
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
            <div class="two_column">
                <div class="card  text-white mb-4" style="background-color: brown">
                    <div class="cards_logo"><img class="image_design" src="{{ asset('/img/students.png') }}" alt="Italian Trulli" style="width: 75px; height: 75px; padding-top: 10px;"></div>
                    <p class="users_count"><b>{{$student}}&nbsp;Students</b></p>
                    <p class="description">You have {{$student}} students in the database.<br>
                    Click the link below to view all the students.</p>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="view_details" href="{{url('/admin/view-student-user')}}">View Details</a>
                        <div class="small text-white"><i class="fa fa-caret-down"></i></div>
                    </div>
                </div>
            </div>
 
            <div class="two_column">
                <div class="card text-white mb-4" style="background-color: rgb(86, 5, 124)">
                    <div class="cards_logo"><img class="image_design" src="{{ asset('/img/signature.png') }}" alt="Italian Trulli"></div>
                        <p class="users_count"><b>{{$signee}}&nbsp;Signee</b></p>
                        <p class="description">You have {{$signee}} signees in the database.<br>
                         Click the link below to view all the signee.</p>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="view_details" href="{{url('/admin/view-signee-user')}}">View Details</a>
                        <div class="small text-white"><i class="fa fa-caret-down"></i></div>
                    </div>
                </div>
            </div>
 
            <div class="two_column">
                <div class="card bg-warning text-white mb-4">
                    <div class="cards_logo"><img class="image_design" src="{{ asset('/img/request.png') }}" alt="Italian Trulli" style="width: 65px; height: 65px; padding-top: 15px; margin-left: 10px;"></div>
                        <p class="users_count"><b>{{$results}}&nbsp;Request</b></p>
                        <p class="description">There are {{$results}} request.<br>
                         Click the link below to view all the pending request.</p>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="view_details" href="{{url('/admin/view-pending-request')}}">View Details</a>
                        <div class="small text-white"><i class="fa fa-caret-down"></i></div>
                    </div>
                </div>
            </div>
            <div class="two_column">
                <div class="card bg-success text-white mb-4">
                    <div class="cards_logo"><img class="ollcf_logo_css" src="{{ asset('/img/school.png') }}" alt="Italian Trulli" style="width: 60px; height: 50px; margin-top: 12px"></div>
                        <p class="users_count"><b>{{$department}}&nbsp;Department</b></p>
                        <p class="description">You have {{$department}} department in the database.<br>
                         Click the link below to view all the department.</p>                
                        <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="view_details" href="{{url('/admin/view-department')}}">View Details</a>
                        <div class="small text-white"><i class="fa fa-caret-down"></i></div>
                    </div>
                </div>
            </div>
            <div class="two_column">
                <div class="card bg-danger text-white mb-4">
                    <div class="cards_logo"><img class="ollcf_logo_css" src="{{ asset('/img/education.png') }}" alt="Italian Trulli" style="width: 60px; height: 50px; margin-top: 12px"></div>
                        <p class="users_count"><b>{{$course}}&nbsp;Course</b></p>
                        <p class="description">You have {{$course}} course in the database.<br>
                         Click the link below to view all the courses.</p>    
                        <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="view_details" href="{{url('/admin/view-course')}}">View Details</a>
                        <div class="small text-white"><i class="fa fa-caret-down"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .description{
        font-size: 10px;
        text-align: center;
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
    .dashboard_view{
padding-top: 40px;
    }
    </style> 







 
{{-- <style> 
    .scroll_tbody_user_activity {
        margin: auto !important;
        width: 100% !important;
        height: 300px !important;
        overflow-x: hidden;
        overflow-y: auto;
        /* way to prevent an element from scrolling its parent. */
        overscroll-behavior: contain;
    } 
    

    /* Add a red background color to the cancel button */
    .form-container-activity .cancel {
        background-color: red !important;
        width: 50px !important;
        font-size: 12px !important;
        height: 24px !important;
        padding-top: 2px!important;
        margin-top: 0px !important;
        margin-bottom: 0px!important;
        border-radius: 0px!important;
      
      /* position: fixed; */
    }
    .active_user_column{
        width: 50%;
        float: left;
        padding: 10px;
    }
    th{
        background-color: rgb(226, 224, 224);
    }
    tr:nth-child(even) {
        background-color: #D6EEEE;
}
.filter_column{
 float: left;
 width: 20%;
 margin-right: 10px;
 margin-top: 10px;
 margin-bottom: 10px;
}
</style> 

<div>
    <div class="active_user_column">
        <p style="text-align:center; color:rgb(255, 255, 255);font-size: 16px; background-color:rgb(4, 4, 181);margin-bottom: 0px"><b>SIGNEES</b></p>
        
        <div class="scroll_tbody_user_activity" style="border: 2px solid black">
            <table class="table scroll_tbody_user_activity" style=" font-size: 10px; color: rgb(0, 0, 0)">
                <tbody>
                    @foreach ($signee_user as $item_activity)
                    <tr class="">
                        <td>{{$item_activity->name}}</td>
                        <td>
                            {{ Carbon\Carbon::parse($item_activity->last_seen)->diffForHumans()}}
                        </td>
                        <td>
                            @if(Cache::has('signee-is-online-' . $item_activity->id))
                            <span class="text-success"><b>Online</b></span>
                            @else
                                <span class="text-secondary">Offline</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  
    </div>
    <div class="active_user_column">
        <p style="text-align:center; color:rgb(255, 255, 255);font-size: 16px; background-color:rgb(4, 4, 181);margin-bottom: 0px"><b>STUDENTS</b></p>
        <form action="{{ route('admin.admindashboard') }}" method="GET">
            {{csrf_field()}}
            @php
                $result = ""; 
                $id_val = 0;
            @endphp
            @foreach ($course_list as $item)
                @if(Request::get('course') == $item->id)
                @php
                $result = $item->course_acronym;
                $id_val =  $item->id;
            @endphp
                @endif
            @endforeach
            <div>
                <button style="height: 31px; font-size: 12px;border-radius: 2px" type="submit" class="btn btn-primary filter_column">Filter</button>
                <div class="filter_column">
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
                        @foreach ($course_list as $item)
                            @if($item->id !== $id_val)
                                <option  value="{{$item->id}}" {{Request::get('course') == 'course' ? 'selected':''}}>{{$item->course_acronym}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="filter_column">
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
        <div class="scroll_tbody_user_activity" style="border: 2px solid black">
            <table class="table" style=" font-size: 10px; background-color: rgb(255, 255, 255)">
                <tbody >
                    <thead >
                        <tr >                
                            <th>Name</th>
                            <th>last Seen</th>
                            <th>Status</th>
                        </tr> 
                    </thead>
                    @foreach ($student_user as $item_activity)
                    <tr > 
                        <td>{{$item_activity->name}}</td>
                        
                        <td>{{ Carbon\Carbon::parse($item_activity->last_seen)->diffForHumans()}}</td>
                        <td>
                            @if(Cache::has('user-is-online-' . $item_activity->id))
                            <span class="text-success"><b>Online</b></span>
                            @else
                            <span class="text-secondary">Offline</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> 
</div> --}}
@include('admin.user-activity')
@endsection
