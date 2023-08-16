@extends('layouts.admin-app')

@section('content')
 <style>
label{
    
    float: left;
}
p{
    text-align:left;
}
.change_pass_edit_view{
padding-top: 39px;
}
.change_pass_row{
    width: 50%;
    float: left;
}
</style>
<div class="change_pass_edit_view">
    <div class="card" style=" border: 2px solid black; margin-left: 0.3px;">
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
                        <div class="alert alert-success" style="margin-bottom: 0px; margin-left: 300px" style="text-align: center">
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
            <h4 style="text-align: center"><b>Edit Password</b>
                <a href="{{url('/admin/view-student-user')}}" class="btn btn-danger float-end">BACK</a>
            </h4>
        </div>
        {!! Form::open(['action' => ['App\Http\Controllers\Admin\AdminController@update_student_password',$student_id->id],'enctype' => 'multipart/form-data']) !!}
        <div class="card-body">
            @csrf 
            @method('PUT')
           
            <div class="form-group mb-3">
                <h4 style="color:red;text-align: center" ><b>Warning!</b></h4>
                <h5 style="text-align: center">You are about to change <b>{{$student_id->name}}</b> password!<br>Proceed with caution.</h5>
            </div>

            <div class="change_pass_row">
                <label style="margin-left: 270px;font-weight: bold;">New Password</label>
                <input style="text-align:center" type="text" name="password"  class="form-control" required>
            </div> 
            
            <div class="change_pass_row">
                <label style="margin-left: 270px;font-weight: bold;">Confirm New Password</label>
                <input style="text-align:center" type="text" id="password-confirm" name="password_confirmation"  class="form-control" required>
            </div>
                <div class="mb-3" style="margin-left: 540px; margin-top: 90px">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection