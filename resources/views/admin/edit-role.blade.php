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
.edit_role_view{
padding-top: 39px;
}
.role_edit_column{
    width: 50%;
    float: left;
    padding-right: 10px;
}
.role_edit_label{
margin-left: 280px;
font-weight: bold;
}
.form-control{
 background-color: #e9ecef;
}
</style>
<div class="edit_role_view">
    <div class="card" style="width:100%; border: 2px solid black; margin-left: 0.3px;">
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
            <h4 style="text-align: center"> <b> Edit Role </b>
                <a href="{{url('/admin/view-role')}}" class="btn btn-danger float-end">BACK</a>
            </h4>
        </div>
        {!! Form::open(['action' => ['App\Http\Controllers\Admin\AdminController@update_role',$role_id->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="card-body">
            @csrf 
            @method('PUT')
           
            <div class="role_edit_column">
                <label class="role_edit_label">Role Name</label>
                <input style="text-align: center" type="text" name="role_name" value="{{$role_id->role_name}}" class="form-control">
            </div>   
 
                <div class="role_edit_column">
                    <label class="role_edit_label">Created At</label>
                    <p style="text-align: center" class="form-control">
                        {{date('M,d,D,Y,g:i A',strtotime($role_id->created_at))}}</p>
                </div>
                <div class="role_edit_column">
                    <label class="role_edit_label">Updated At</label>
                    <p style="text-align: center" class="form-control">
                        {{date('M,d,D,Y,g:i A',strtotime($role_id->updated_at))}}</p>
                </div> 
                <div class="role_edit_column">
                    <label class="role_edit_label">Deleted At</label>
                    <p style="text-align: center" class="form-control">
                        {{date('M,d,D,Y,g:i A',strtotime($role_id->deleted_at))}}</p>
                </div> 

                    <div class="mb-3" style="margin-left: 555px">
                        <button type="submit" class="btn btn-primary">Update Role</button>
                    </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection