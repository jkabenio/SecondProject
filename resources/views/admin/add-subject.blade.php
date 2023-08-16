@extends('layouts.admin-app')

@section('content')
<style>
.add_subject_view{
    padding-top: 39px;
}
.add_subject_row{
    width: 100%;
}
.add_subject_column{
width: 33.33%;
float: left;
padding-left: 10px;
padding-right: 10px;
}
.add_subject_label{
    margin-left: 150px;
    font-weight: bold;
    margin-top: 10px;
}
.add_subject_submit{
    padding-top: 230px;
    padding-bottom: 10px;
    margin-left: 580px;
}
.page-item.active .page-link{
    z-index: 1;
}
.form-control{
 background-color: #e9ecef;
}
</style>
<div class="add_subject_view">
    <div class="card" style="border: 2px solid black; ">      
        <div class="card-header" style="background-color: white">
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
    <div>
        <h3 style="color:blue; text-align:center; font-weight: bold">Add New Subject</h3>
        <div class="card-body" style="padding: 0px; margin: 0px; font-size: 12px" >
            {!! Form::open(['action' => 'App\Http\Controllers\Admin\AdminController@store_subject', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                {{csrf_field()}}
            <div class="add_subject_row">
                <div class="add_subject_column">
                    <label class="add_subject_label" style="color: black">Code</label>
                    <input  style="text-align:center" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required>
                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="add_subject_column">
                    <label class="add_subject_label" style="color: black">Subject Code</label>
                    <input  style="text-align:center" type="text" class="form-control @error('subj_code') is-invalid @enderror" name="subj_code" value="{{ old('subj_code') }}" required>
                    @error('subj_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="add_subject_column">
                    <label class="add_subject_label" style="color: black">Subject Name</label>
                    <input  style="text-align:center" type="text" class="form-control @error('subj_name') is-invalid @enderror" name="subj_name" value="{{ old('subj_name') }}" required>
                    @error('subj_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="add_subject_column">
                    <label class="add_subject_label" style="color: black">Unit</label>
                    <input  style="text-align:center" type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ old('unit') }}" required>
                    @error('unit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="add_subject_column">
                    <label class="add_subject_label" style="color: black">Year Level</label>
                    <select  style="text-align:center" name="year_level" class="form-control">
                        <option selected="true" disabled="true">--Select Year Level--</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                    </select> 
                        @error('year_level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="add_subject_column">
                    <label class="add_subject_label" style="color: black">Semester</label>
                    <select  style="text-align:center" name="semester" class="form-control">
                        <option selected="true" disabled="true">--Select Semester--</option>
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                        <option value="Summer Class">Summer Class</option>
                    </select>
                </div>

                <div class="add_subject_column">
                    <label class="add_subject_label" style="color: black">Course</label>
                    <select  style="text-align:center" name="course_id" class="form-control">
                        <option selected="true" disabled="true">--Select Course--</option>
                        @foreach($course_list as $list)
                        <option value="{{$list->id}}"> {{$list->course_name}}</option>
                        @endforeach
                    </select>
                </div>

                
                <div class="add_subject_column">
                    <label class="add_subject_label" style="color: black">Section</label>
                    <select  style="text-align:center" name="section" class="form-control">
                        <option selected="true" disabled="true">--Select Section--</option>
                        <option value="Block A">Block A</option>
                        <option value="Block B">Block B</option>
                        <option value="Block C">Block C</option>
                        <option value="Block D">Block D</option>
                    </select>
                </div>
                <div class="add_subject_column">
                    <label class="add_subject_label" style="color: black">Assigned Signee</label>
                    <select  style="text-align:center" name="signee_names" class="form-control">
                        <option selected="true" disabled="true">--Choose One Signee--</option>
                        @foreach($signeelist as $list)
                        <option value="{{$list->name}}">{{$list->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="add_subject_submit">
                    <input type="submit" class="btn btn-primary"/>
                </div>
            </div>
            {!! Form::close() !!}
            </div>
        </div> 
    </div>
</div>

<div style="background-color:rgb(224, 224, 225);">
    <h3 style="color:blue; text-align:center">Activity Logs</h3>
    <table class="table table-bordered" style=" border: 1px solid black; font-size: 12px;">
        <thead >
            <tr > 
                <th>Subject Name</th>
                <th>Date Created</th>
                <th>Date Updated</th>
                <th>Date Deleted</th>
            </tr>
        </thead>
        <tbody >
            @foreach ($subject_log as $item)
            <tr  >
                <td>{{$item->subj_name}}</td>
                <td>{{date('M,d,D,Y,g:i A',strtotime($item->created_at))}}</td>
                <td>{{date('M,d,D,Y,g:i A',strtotime($item->updated_at))}}</td>
                <td>{{date('M,d,D,Y,g:i A',strtotime($item->deleted_at))}}</td>
            </tr>
            @endforeach
        </tbody>        
    </table>                   
        {{$subject_log->links()}} 
    </div>

@include('admin.user-activity')
@endsection