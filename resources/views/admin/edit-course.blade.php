@extends('layouts.admin-app')

@section('content')
 <style>
label{
    
    float: left;
    text-align: left;
}
p{
    text-align:left;
}
.course_edit_view{
    padding-top: 39px;
}
.course_row{
    width: 100%;
}
.course_column{
    width: 50%;
    float: left;
    padding-right: 10px;
}
.course_update_btn{
    margin-left: 550px;
}
.course_edit_label{
    margin-left: 280px;
    font-weight:bold;
}
.form-control{
 background-color: #e9ecef;
}
</style>
<div class="course_edit_view">
    <div class="card" style="border: 2px solid black; margin-left: 0.3px;">
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
                        <div class="alert alert-success"  style="text-align: center">
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
            <h4 style="text-align:center; font-weight: bold"><b>Edit Course</b>
                <a href="{{url('/admin/view-course')}}" class="btn btn-danger float-end">BACK</a>
            </h4>
        </div>
        {!! Form::open(['action' => ['App\Http\Controllers\Admin\AdminController@update_course',$course_id->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="card-body">
            @csrf 
            @method('PUT')
            <div class="course_row">
                <div class="course_column">
                    <label class="course_edit_label">Course Name</label>
                    <input style="text-align:center" type="text" name="course_name" value="{{$course_id->course_name}}" class="form-control">
                </div> 
                <div class="course_column">
                    <label class="course_edit_label">Acronym</label>
                    <input style="text-align:center" type="text" name="course_acronym" value="{{$course_id->course_acronym}}" class="form-control">
                </div>  

                <div class="course_column">
                    <label class="course_edit_label">Department</label>
                    <select name="dept_id" class="form-control"  style="text-align:center">
                        @foreach($dept_list as $item)                       
                            @if($item->id == $course_id->dept_id)
                                <option value="{{$item->id}}">{{$item->dept_name}} </option>
                            @endif                                     
                        @endforeach
                        @foreach($dept_list as $list)
                        @if($list->id !== $course_id->dept_id)
                        <option value="{{$list->id}}"> {{$list->dept_name}}</option>
                        @endif
                        @endforeach
                    </select> 
                </div>
                    
                    <div class="course_column">
                        <label class="course_edit_label">Created At</label>
                        <p class="form-control" style="text-align:center">
                            {{date('M,d,D,Y,g:i A',strtotime($course_id->created_at))}}</p>
                    </div>
                    <div class="course_column">
                        <label class="course_edit_label">Updated At</label>
                        <p class="form-control" style="text-align:center">
                            {{date('M,d,D,Y,g:i A',strtotime($course_id->updated_at))}}</p>
                    </div> 
                    <div class="course_column">
                        <label class="course_edit_label">Deleted At</label>
                        <p class="form-control" style="text-align:center">
                            {{date('M,d,D,Y,g:i A',strtotime($course_id->deleted_at))}}</p>
                    </div> 
                        <div class="course_update_btn">
                            <button type="submit" class="btn btn-primary">Update Course</button>
                        </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection