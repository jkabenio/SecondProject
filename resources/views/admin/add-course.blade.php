@extends('layouts.admin-app')

@section('content')
<style> 
.course_add_view{
    padding-top: 39px;
    /* background-color:rgb(204, 201, 201); */
    border: 3px solid black;
  
} 
.course_row{
    width:100%;
}
.course_column{
    width:50%;
    float:left;
    padding: 10px;
}
.course_label{
 margin-left: 260px;
 font-weight: bold;
}
.course_select_label{
 margin-left: 590px;
 font-weight: bold;
}
.course_submit_btn{
    margin-left: 600px;
    padding-top: 10px;
    padding-bottom: 10px;
}
.page-item.active .page-link{
    z-index: 1;
}
.form-control{
 background-color: #e9ecef;
}
</style>
<div class="course_add_view"> 
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
    <h3 style="color:blue; text-align: center; font-weight: bold">Add New Course</h3>
    {!! Form::open(['action' => 'App\Http\Controllers\Admin\AdminController@store_course', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    {{csrf_field()}}
    <div class="course_row">
        <div class="course_column">
            <label  class="course_label" style="color: black">Course Name</label>
            <input style="text-align: center" type="text" class="form-control @error('course_name') is-invalid @enderror" name="course_name" value="{{ old('course_name') }}" required>
        </div>
        <div class="course_column">
            <label class="course_label" style="color: black">Acronym</label>
            <input style="text-align: center"  type="text" class="form-control @error('course_acronym') is-invalid @enderror" name="course_acronym" value="{{ old('course_acronym') }}" required>
        </div>
    </div>
    <label class="course_select_label"  style="color: black">Department</label>
    <select name="dept_id" class="form-control" style="width:50%; margin-left: 350px; text-align: center">
        <option selected disabled>--Select Department--</option>
        @foreach($dept_list as $list)
            <option value="{{$list->id}}"> {{$list->dept_name}}</option>                   
        @endforeach
    </select>                 
    <div class="course_submit_btn">
        <input type="submit" class="btn btn-primary"/>
    </div>
    {!! Form::close() !!}
</div>

    <div style="background-color:rgb(224, 224, 225);">
        <h3 style="color:blue; text-align: center">Activity Logs</h3>
        <table class="table table-bordered" style=" border: 1px solid black; font-size: 12px;">
            <thead >
                <tr > 
                    <th>Course Name</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th>Date Deleted</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($course_log as $item)
                <tr>

                    <td>{{$item->course_name}}</td>
                    <td>{{date('M,d,D,Y,g:i A',strtotime($item->created_at))}}</td>
                    <td>{{date('M,d,D,Y,g:i A',strtotime($item->updated_at))}}</td>
                    <td>{{date('M,d,D,Y,g:i A',strtotime($item->deleted_at))}}</td>
                </tr>

                @endforeach
            </tbody>        
        </table>                   
        {{$course_log->links()}} 
    </div>


@include('admin.user-activity')
@endsection