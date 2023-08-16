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
.edit_subject_view{
padding-top: 39px;
}
.edit_subject_row{
width: 100%;
padding-top: 30px;
}
.edit_subject_column{
    width: 33.33%;
    float: left;
    padding-left: 10px;
    padding-right: 10px;
   
}
.edit_view_label{
    margin-left: 180px;
    font-weight: bold;
}
.edit_subject_btn{
    margin-left: 550px;
    margin-top: 260px;
}
.form-control{
 background-color: #e9ecef;
}
</style>
<div class="edit_subject_view">
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
            <h4 style="text-align:center; font-weight: bold;"><b>Edit Subject</b>
                <a href="{{url('/admin/view-subject')}}" class="btn btn-danger float-end">BACK</a>
            </h4>
        </div>
        {!! Form::open(['action' => ['App\Http\Controllers\Admin\AdminController@update_subject',$subject_id->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="edit_subject_row">
            @csrf 
            @method('PUT')
           
            {{-- <div class="form-group mb-3">
                <label  for="">Course</label>
                <input type="text" name="name" value="{{$subject_id->course_id}}" class="form-control">
            </div> --}}
            <div class="edit_subject_column">
                <label class="edit_view_label">Code</label>
                <input style="text-align: center"  type="text" name="code" value="{{$subject_id->code}}" class="form-control">
            </div>

            <div class="edit_subject_column">
                <label class="edit_view_label">Subject Code</label>
                <input style="text-align: center" type="text" name="subj_code" value="{{$subject_id->subj_code}}" class="form-control">
            </div>

            <div class="edit_subject_column">
                <label class="edit_view_label">Subject Name</label>
                <input style="text-align: center" type="text" name="subj_name" value="{{$subject_id->subj_name}}" class="form-control">
            </div> 

            <div class="edit_subject_column">
                <label class="edit_view_label">Unit</label>
                <input style="text-align: center" type="text" name="unit" value="{{$subject_id->unit}}" class="form-control">
            </div> 
 
            <div class="edit_subject_column">
                <label class="edit_view_label">Semester</label>
                <select style="text-align: center" name="semester" class="form-control">
                    <option value="{{$subject_id->semester}}">{{$subject_id->semester}}</option>
                    @if($subject_id->semester !== "1st Semester")
                        <option value="1st Semester">1st Semester</option>
                    @endif
                    @if($subject_id->semester !== "2nd Semester")
                        <option value="2nd semester">2nd semester</option>
                    @endif
                    @if($subject_id->semester !== "Summer Class")
                        <option value="Summer Class">Summer Class</option>
                    @endif
                </select> 
            </div>

            <div class="edit_subject_column">
                <label class="edit_view_label">Course</label>
                <select style="text-align: center" name="course_id" class="form-control">
                    @foreach($course_list as $item)                       
                        @if($item->id == $subject_id->course_id)
                            <option value="{{$item->id}}">{{$item->course_name}} </option>
                        @endif                                    
                    @endforeach
                    @foreach($course_list as $list)
                    @if($list->id !== $subject_id->course_id)
                    <option value="{{$list->id}}"> {{$list->course_name}}</option>
                    @endif
                    @endforeach
                </select> 
            </div>

            <div class="edit_subject_column">
                <label class="edit_view_label">Signee</label>
                <select style="text-align: center" name="signee_names" class="form-control">
                    <option value="{{$subject_id->signee_names}}">{{$subject_id->signee_names}}</option>
                    @foreach($signees as $signee_list)
                        @if($signee_list->name !== $subject_id->signee_names)
                            <option value="{{$signee_list->name}}">{{$signee_list->name}}</option>
                        @endif
                    @endforeach
                </select> 
            </div>

            <div class="edit_subject_column">
                <label class="edit_view_label">Section</label>
                <select style="text-align: center" name="section" class="form-control">
                    <option value="{{$subject_id->section}}">{{$subject_id->section}}</option>
                    @if($subject_id->section !== "Block A")
                        <option value="Block A">Block A</option>
                    @endif
                    @if($subject_id->section !== "Block B")
                        <option value="Block B">Block B</option>
                    @endif
                    @if($subject_id->section !== "Block C")
                        <option value="Block C">Block C</option>
                    @endif
                    @if($subject_id->section !== "Block D")
                        <option value="Block D">Block D</option>
                    @endif
                </select> 
            </div>
                
                <div class="edit_subject_column">
                    <label class="edit_view_label">Created At</label>
                    <p style="text-align: center" class="form-control">
                        {{date('M,d,D,Y,g:i A',strtotime($subject_id->created_at))}}</p>
                </div>
                <div class="edit_subject_column">
                    <label class="edit_view_label">Updated At</label>
                    <p style="text-align: center" class="form-control">
                        {{date('M,d,D,Y,g:i A',strtotime($subject_id->updated_at))}}</p>
                </div> 
        </div>
        <div class="edit_subject_btn">
            <button type="submit" class="btn btn-primary">Update Subject</button>
        </div>
{!! Form::close() !!}
    </div>
</div>
@endsection