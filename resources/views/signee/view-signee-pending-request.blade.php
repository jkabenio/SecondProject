@extends('layouts.signee-app')

@section('content')


@if(strcasecmp(Auth::user()->role_as, "Instructor") == 0)

    <div class="clearance_body_signee">
        <div  class="card">
            <div class="card-header">
                @if (session('success'))
                    <div style="text-align:center" class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div style="text-align:center" class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <h4 class="signee_view_title"><b>Student List</b></h4>
            </div>
            <div  class="card-body" >
                 <table id="students"  class="table table-bordered">
                    <thead >
                        <tr >
                            <form action="{{ route('signee.view-signee-pending-request') }}" method="GET">
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
                                    <div class="col-md-1 col-3">
                                        <button type="submit" class="btn btn-primary filter_btn">Filter</button>
                                    </div>
                                    <div class="col-md-2 col-3 filtering_font">
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
                                    <div class="col-md-2 col-3">
                                        <input type="search" class="form-control"  name="search" id="instructor-search" placeholder="Search:"/>                                              
                                    </div>
                                </div>
                            </form>
                                <th >Name</th>
                                <th >Course</th>
                                <th >Year Level</th>                              
                                <th >Edit</th>
                        </tr>
                    </thead> 
                    <tbody id="Instructor-Content">
                        @foreach($student as $item)
                           @php
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
                           @endphp                            
                            <tr>
                                @if($total_approved !== $total_stats) 
                                    {{-- @if((in_array("IN-PROGRESS",$passed_status)) || (in_array("COMPLY",$passed_status)) || (in_array("REJECTED",$passed_status)))   --}}
                                        <td>{{$item->name}}</td>
                                        @foreach($course as $course_list)
                                            @if($course_list->id == $item->course)
                                                <td>{{$course_list->course_acronym}}</td>
                                            @endif
                                        @endforeach
                                        <td>{{$item->year_lvl}}</td>
                                        <td>
                                            <a href="{{url ('signee/edit-student/'.$item->id)}}" ><img class="edit"  src="{{ asset('/img/edit.png') }}" alt="Italian Trulli"></a>
                                        </td>
                                    {{-- @endif --}}
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>     
        </div>
    </div>    
@endif 
@if(strcasecmp(Auth::user()->role_as,'Guidance Counselor') == 0)
    <div   class="clearance_body_signee">
        <div  class="card" >
            <div class="card-header">
                @if (session('success'))
                    <div style="text-align:center"  class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div style="text-align:center"  class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <h4 class="signee_view_title"><b>Student List</b></h4>
            </div>
            <div  class="card-body">
                <table class="table table-bordered" style="border: 1px solid black">
                    <thead >
                        <tr >
                            <form action="{{ route('signee.view-signee-pending-request') }}" method="GET">
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
                                    <div class="col-md-1 col-3">
                                        <button type="submit" class="btn btn-primary filter_btn">Filter</button>
                                    </div>
                                    <div class="col-md-2 col-3 filtering_font">
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
                                    <div class="col-md-2 col-3">
                                        <input type="search" class="form-control"  name="search" id="guidance-counselor-search" placeholder="Search:"/>                                              
                                    </div>
                                </div>
                            </form>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year Level</th>                              
                            <th>Edit</th>
                        </tr>
                    </thead> 
                    <tbody id="Guidance-Counselor-Content">
                        
                        @foreach($student as $item)
                            @if($item->guidance_councilor !== "APPROVED")    
                                <tr> 
                                    <td>{{$item->name}}</td>
                                    @foreach($course as $course_list)
                                        @if($course_list->id == $item->course)
                                            <td>{{$course_list->course_acronym}}</td>
                                        @endif
                                    @endforeach
                                        <td>{{$item->year_lvl}}</td>
                                        <td> 
                                            <a href="{{url ('signee/edit-student/'.$item->id)}}" ><img class="edit" src="/img/edit.png" alt="Italian Trulli"></a>   
                                        </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>     
        </div>
    </div>    
@endif
{{-- student org tresurer view --}}
@if(strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') == 0)
    <div   class="clearance_body_signee">
        <div  class="card">
            <div class="card-header">
                <div class="card-header">
                    @if (session('success'))
                        <div style="text-align:center"  class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div style="text-align:center"  class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <h4 class="signee_view_title"><b>Student List</b></h4>
                </div>
            </div>
            <div  class="card-body">
                <table class="table table-bordered" style="border: 1px solid black">
                    <thead >
                        <tr>
                            <form action="{{ route('signee.view-signee-pending-request') }}" method="GET">
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
                                    <div class="col-md-1 col-3">
                                        <button type="submit" class="btn btn-primary filter_btn">Filter</button>
                                    </div>
                                    <div class="col-md-2 col-3 filtering_font">
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
                                    <div class="col-md-2 col-3">
                                        <input type="search" class="form-control"  name="search" id="student-org-search" placeholder="Search by: Name or School ID"/>                                              
                                    </div>
                                </div>
                            </form>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year Level</th>                              
                            <th>Edit</th>
                        </tr>
                    </thead> 
                    <tbody id="Student-Org-Content">  
                        @foreach($student as $item)
                            @if(Auth::user()->dept_id == $item->dept_id)
                                @if($item->student_org_treasurer !== "APPROVED")
                                <tr> 
                                    <td>{{$item->name}}</td>
                                    @foreach($course as $course_list)
                                        @if($course_list->id == $item->course)
                                            <td>{{$course_list->course_acronym}}</td>
                                        @endif
                                    @endforeach
                                        <td>{{$item->year_lvl}}</td>
                                        <td> 
                                            <a href="{{url ('signee/edit-student/'.$item->id)}}" ><img class="edit" src="/img/edit.png" alt="Italian Trulli"></a>
                                        </td>
                                @endif 
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>     
        </div>
    </div>    
@endif
@if(strcasecmp(Auth::user()->role_as,'Librarian') == 0)
<div   class="clearance_body_signee">
    <div  class="card">
        <div class="card-header">
            @if (session('success'))
            <div style="text-align:center"  class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div style="text-align:center"  class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <h4 class="signee_view_title"><b>Student List</b></h4>
        </div>
        <div  class="card-body">
            <table class="table table-bordered" style="border: 1px solid black">
                <thead >
                    <tr >
                        <form action="{{ route('signee.view-signee-pending-request') }}" method="GET">
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
                                <div class="col-md-1 col-3">
                                    <button type="submit" class="btn btn-primary filter_btn">Filter</button>
                                </div>
                                <div class="col-md-2 col-3 filtering_font">
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
                                <div class="col-md-2 col-3">
                                    <input type="search" class="form-control"  name="search" id="librarian-search" placeholder="Search:"/>                                              
                                </div>
                            </div>
                        </form>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Year Level</th>                              
                        <th>Edit</th>
                    </tr>
                </thead> 
                <tbody id="Librarian-Content">
                    
                    @foreach($student as $item)
                            <?php
                                $approve_count = 0;
                                $approve_total = 0;
                             ?>
                            @foreach($item->status as $status_count)
                                @if($status_count == "APPROVED")
                                    <?php
                                        $approve_count++;
                                    ?>
                                @endif
                                @if($status_count !== "APPROVED" || $status_count == "APPROVED")
                                    <?php
                                        $approve_total++;
                                    ?>
                                @endif
                            @endforeach
                            <?php
                                $pass_total_value =  $approve_count;
                                $pass_status_value = $approve_total;
                            ?>
                            @if($pass_total_value == $pass_status_value)
                                @if($item->student_org_treasurer == "APPROVED"  && $item->guidance_councilor == "APPROVED" && $item->librarian !== "APPROVED")
                                    <tr> 
                                        <td>{{$item->name}}</td>
                                        @foreach($course as $course_list)
                                            @if($course_list->id == $item->course)
                                                <td>{{$course_list->course_acronym}}</td>
                                            @endif
                                        @endforeach
                                        <td>{{$item->year_lvl}}</td>
                                        <td> 
                                            <a href="{{url ('signee/edit-student/'.$item->id)}}" ><img class="edit" src="/img/edit.png" alt="Italian Trulli"></a>
                                        </td>
                                    </tr>
                                @endif 
                            @endif
                        
                    @endforeach
                </tbody>
            </table>
        </div>     
    </div>
</div>  
@endif
@if(strcasecmp(Auth::user()->role_as,'Dean of Student Affair') == 0)
    <div   class="clearance_body_signee">
        <div  class="card">
            <div class="card-header">
                @if (session('success'))
            <div style="text-align:center"  class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div style="text-align:center"  class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <h4 class="signee_view_title"><b>Student List</b></h4>
            </div>
            <div  class="card-body">
                <table class="table table-bordered" style="border: 1px solid black">
                    <thead >
                        <tr >
                            <form action="{{ route('signee.view-signee-pending-request') }}" method="GET">
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
                                    <div class="col-md-1 col-3">
                                        <button type="submit" class="btn btn-primary filter_btn">Filter</button>
                                    </div>
                                    <div class="col-md-2 col-3 filtering_font">
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
                                    <div class="col-md-2 col-3">
                                        <input type="search" class="form-control"  name="search" id="student-affair-search" placeholder="Search:"/>                                              
                                    </div>
                                </div>
                            </form>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year Level</th>                              
                            <th>Edit</th>
                        </tr>
                    </thead> 
                    <tbody id="Student-Affair-Content">
                        
                        @foreach($student as $item)
                                <?php
                                    $approve_count = 0;
                                    $approve_total = 0;
                                 ?>
                                @foreach($item->status as $status_count)
                                    @if($status_count == "APPROVED")
                                        <?php
                                            $approve_count++;
                                        ?>
                                    @endif
                                    @if($status_count !== "APPROVED" || $status_count == "APPROVED")
                                        <?php
                                            $approve_total++;
                                        ?>
                                    @endif
                                @endforeach
                                <?php
                                    $pass_total_value =  $approve_count;
                                    $pass_status_value = $approve_total;
                                ?>
                                @if($pass_total_value == $pass_status_value)
                                    @if($item->student_org_treasurer == "APPROVED" && $item->guidance_councilor == "APPROVED" && $item->librarian == "APPROVED" && $item->dean_of_student_affair !== "APPROVED")
                                        <tr> 
                                            <td>{{$item->name}}</td>
                                            @foreach($course as $course_list)
                                                @if($course_list->id == $item->course)
                                                    <td>{{$course_list->course_acronym}}</td>
                                                @endif
                                            @endforeach
                                            <td>{{$item->year_lvl}}</td>
                                            <td> 
                                                <a href="{{url ('signee/edit-student/'.$item->id)}}" ><img class="edit" src="/img/edit.png" alt="Italian Trulli"></a>
                                            </td>
                                        </tr>
                                    @endif 
                                 @endif
                            
                        @endforeach
                    </tbody>
                </table>
            </div>     
        </div>
    </div>    
@endif
@if(strcasecmp(Auth::user()->role_as,'Dean Principal') == 0)
    <div   class="clearance_body_signee">
        <div  class="card">
            <div class="card-header"> 
                @if (session('success'))
                    <div style="text-align:center"  class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div style="text-align:center"  class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <h4 class="signee_view_title"><b>Student List</b></h4>
            </div>
            <div  class="card-body">
                <table class="table table-bordered" style="border: 1px solid black">
                    <thead >
                        <tr >
                            <form action="{{ route('signee.view-signee-pending-request') }}" method="GET">
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
                                    <div class="col-md-1 col-3">
                                        <button type="submit" class="btn btn-primary filter_btn">Filter</button>
                                    </div>
                                    <div class="col-md-2 col-3 filtering_font">
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
                                    <div class="col-md-2 col-3">
                                        <input type="search" class="form-control"  name="search" id="dean-principal-search" placeholder="Search:"/>                                              
                                    </div>
                                </div>
                            </form> 
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year Level</th>                              
                            <th>Edit</th>
                        </tr>
                    </thead> 
                    <tbody id="Dean-Principal-Content">
                        
                        @foreach($student as $item)
                            @if(Auth::user()->dept_id == $item->dept_id)
                                <?php
                                    $approve_count = 0;
                                    $approve_total = 0;
                                 ?>
                                @foreach($item->status as $status_count)
                                    @if($status_count == "APPROVED")
                                        <?php
                                            $approve_count++;
                                        ?>
                                    @endif
                                    @if($status_count !== "APPROVED" || $status_count == "APPROVED")
                                        <?php
                                            $approve_total++;
                                        ?>
                                    @endif
                                @endforeach
                                <?php
                                    $pass_total_value =  $approve_count;
                                    $pass_status_value = $approve_total;
                                ?>
                                @if($pass_total_value == $pass_status_value)
                                        @if($item->student_org_treasurer == "APPROVED" && $item->dean_principal !== "APPROVED" && $item->librarian == "APPROVED" && $item->guidance_councilor == "APPROVED" && $item->dean_of_student_affair == "APPROVED")
                                        <tr> 
                                            <td>{{$item->name}}</td>
                                            @foreach($course as $course_list)
                                                @if($course_list->id == $item->course)
                                                    <td>{{$course_list->course_acronym}}</td>
                                                @endif
                                            @endforeach
                                                <td>{{$item->year_lvl}}</td>
                                                <td> 
                                                    <a href="{{url ('signee/edit-student/'.$item->id)}}" ><img class="edit" src="/img/edit.png" alt="Italian Trulli"></a>
                                                </td>
                                        @endif 
                                        </tr>
                                    @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>     
        </div>
    </div>    
@endif
@if(strcasecmp(Auth::user()->role_as,'Registrar') == 0)
    <div   class="clearance_body_signee">
        <div  class="card">
            @if (session('success'))
                <div style="text-align:center"  class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div style="text-align:center"  class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="card-header">
                <h4 class="signee_view_title"><b>Student List</b></h4>
            </div>
            <div  class="card-body">
                <table class="table table-bordered" style="border: 1px solid black">
                    <thead >
                        <tr >
                            <form action="{{ route('signee.view-signee-pending-request') }}" method="GET">
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
                                    <div class="col-md-1 col-3">
                                        <button type="submit" class="btn btn-primary filter_btn">Filter</button>
                                    </div>
                                    <div class="col-md-2 col-3 filtering_font">
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
                                    <div class="col-md-2 col-3">
                                        <input type="search" class="form-control"  name="search" id="registrar-search" placeholder="Search:"/>                                              
                                    </div>
                                </div>
                            </form>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year Level</th>                              
                            <th>Edit</th>
                        </tr>
                    </thead> 
                    <tbody id="Registrar-Content">
                        
                        @foreach($student as $item)
                                <?php
                                    $approve_count = 0;
                                    $approve_total = 0;
                                 ?>
                                @foreach($item->status as $status_count)
                                    @if($status_count == "APPROVED")
                                        <?php
                                            $approve_count++;
                                        ?>
                                    @endif
                                    @if($status_count !== "APPROVED" || $status_count == "APPROVED")
                                        <?php
                                            $approve_total++;
                                        ?>
                                    @endif
                                @endforeach
                                <?php
                                    $pass_total_value =  $approve_count;
                                    $pass_status_value = $approve_total;
                                ?>
                                @if($pass_total_value == $pass_status_value)
                                    @if($item->student_org_treasurer == "APPROVED" && $item->dean_principal == "APPROVED" && $item->guidance_councilor == "APPROVED" && $item->librarian == "APPROVED" && $item->dean_of_student_affair == "APPROVED" && $item->registrar !== "APPROVED")
                                        <tr> 
                                            <td>{{$item->name}}</td>
                                            @foreach($course as $course_list)
                                                @if($course_list->id == $item->course)
                                                    <td>{{$course_list->course_acronym}}</td>
                                                @endif
                                            @endforeach
                                            <td>{{$item->year_lvl}}</td>
                                            <td> 
                                                <a href="{{url ('signee/edit-student/'.$item->id)}}" ><img class="edit" src="/img/edit.png" alt="Italian Trulli"></a>
                                            </td>
                                        </tr>
                                    @endif 
                                 @endif
                            
                        @endforeach
                    </tbody>
                </table>
            </div>     
        </div>
    </div>    
@endif
@if(strcasecmp(Auth::user()->role_as,'Accounting Assessment') == 0)
    <div   class="clearance_body_signee">
        <div  class="card">
            <div class="card-header">
                @if (session('success'))
                    <div style="text-align:center"  class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div style="text-align:center"  class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <h4 class="signee_view_title"><b>Student List</b></h4>
            </div>
            <div  class="card-body">
                <table class="table table-bordered" style="border: 1px solid black">
                    <thead >
                        <tr >
                            <form action="{{ route('signee.view-signee-pending-request') }}" method="GET">
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
                                    <div class="col-md-1 col-3">
                                        <button type="submit" class="btn btn-primary filter_btn">Filter</button>
                                    </div>
                                    <div class="col-md-2 col-3 filtering_font">
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
                                    <div class="col-md-2 col-3">
                                        <input type="search" class="form-control"  name="search" id="assessment-search" placeholder="Search:"/>                                              
                                    </div>
                                </div>
                            </form>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year Level</th>                              
                            <th>Edit</th>
                        </tr>
                    </thead> 
                    <tbody id="Assessment-Content">
                        
                        @foreach($student as $item)
                                <?php
                                    $approve_count = 0;
                                    $approve_total = 0;
                                 ?>
                                @foreach($item->status as $status_count)
                                    @if($status_count == "APPROVED")
                                        <?php
                                            $approve_count++;
                                        ?>
                                    @endif
                                    @if($status_count !== "APPROVED" || $status_count == "APPROVED")
                                        <?php
                                            $approve_total++;
                                        ?>
                                    @endif
                                @endforeach
                                <?php
                                    $pass_total_value =  $approve_count;
                                    $pass_status_value = $approve_total;
                                ?>
                                @if($pass_total_value == $pass_status_value)
                                    @if($item->student_org_treasurer == "APPROVED" && $item->dean_principal == "APPROVED" && $item->guidance_councilor == "APPROVED" && $item->librarian == "APPROVED" && $item->dean_of_student_affair == "APPROVED" && $item->registrar == "APPROVED" && $item->accounting_assessment !== "APPROVED")
                                        <tr> 
                                            <td>{{$item->name}}</td>
                                            @foreach($course as $course_list)
                                                @if($course_list->id == $item->course)
                                                    <td>{{$course_list->course_acronym}}</td>
                                                @endif
                                            @endforeach
                                            <td>{{$item->year_lvl}}</td>
                                            <td> 
                                                <a href="{{url ('signee/edit-student/'.$item->id)}}" ><img class="edit" src="/img/edit.png" alt="Italian Trulli"></a>
                                            </td>
                                        </tr>
                                    @endif 
                                 @endif
                        @endforeach
                    </tbody>
                </table>
            </div>     
        </div>
    </div>
@endif
@include('signee.user-activity')   
@endsection
