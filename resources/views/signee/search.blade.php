@extends('layouts.signee-app')

@section('content')

<style>
    td{
      white-space:nowrap;
      text-overflow:ellipsis; 
      overflow:hidden;
      
    }
</style> 
@if(strcasecmp(Auth::user()->role_as,'Student Org. Treasurer') == 0)
    <div   class="clearance_body_admin">
        <div  class="card" style="width:99%; border: 2px solid black">
            <div class="card-header">
                <h4>Student List</h4>
            </div>
            <div  class="card-body">
                <table class="table table-bordered" style="width:900px; border: 1px solid black">
                    <thead >
                        <tr >
                            {!! Form::open(['action' => 'App\Http\Controllers\Signee\SearchController@index', 'method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
                                {{csrf_field()}}
                                <div  class="col-md-4" style="padding-left: 0px; margin-right: 0px">
                                    <input type="text" class="form-control"value="" name="query" id="query" placeholder="Search by: Name or School ID"/>                                
                                </div>
                            {{-- <button class="fa fa-search">search</button> --}}
                            {!! Form::close() !!} 
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year Level</th>                              
                            <th>Status</th>
                            <th>Description</th>
                        </tr>
                    </thead> 
                    <tbody id="tbody">
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

                                            <td> @if($item->student_org_treasurer == "IN-PROGRESS")
                                                <select name="status[]" style="color:blue">
                                                @endif
                                                @if($item->student_org_treasurer == "COMPLY")
                                                <select name="status[]" style="color:orange">
                                                @endif
                                                @if($item->student_org_treasurer == "REJECTED")
                                                <select name="status[]" style="color:red">
                                                @endif
                                                @if($item->student_org_treasurer == "APPROVED")
                                                <select name="status[]" style="color:green">
                                                @endif
                                                <option style="text-align:center" value="{{$item->student_org_treasurer}}">{{$item->student_org_treasurer}}</option>

                                                @if($item->student_org_treasurer !== "IN-PROGRESS")
                                                <option style="text-align:center; color: blue"value="IN-PROGRESS">IN-PROGRESS</option>
                                                @endif
                                                @if($item->student_org_treasurer !== "COMPLY")
                                                <option style="text-align:center; color: orange"value="COMPLY">COMPLY</option>
                                                @endif
                                                @if($item->student_org_treasurer !== "APPROVED")
                                                <option style="text-align:center; color:green;"value="APPROVED">APPROVED</option>
                                                @endif
                                                @if($item->student_org_treasurer !== "REJECTED")
                                                <option style="text-align:center; color:red"value="REJECTED">REJECTED</option>
                                                @endif
                                                </select>
                                            
                                            </td>
                                            <td> 
                                                @if($item->student_org_description !== null)  
                                                    <a onclick="openForm()">View Detail</a>
                                                @endif
                                                @if($item->student_org_description == null)  
                                                    <a onclick="openForm()">Add Detail</a>
                                                @endif
                                                <div class="form-popup" id="myForm">
                                                    <textarea class="description_info" name="description[]" value="{{$item->student_org_description}}">{{$item->student_org_description}}</textarea>                                               
                                                    <button type="submit" class="btn cancel" style="background-color: #0800ff">Update User</button>
                                                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>                           
                                                </div>
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
@endsection