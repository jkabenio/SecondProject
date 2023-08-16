@extends('layouts.admin-app')

@section('content')
 <style>
.dept_label{
    margin-left: 250px;
    font-weight: bold;
}
p{
    text-align:center;
}
.dept_edit{
padding-top: 39px;
}
.dept_row{
width: 100%;
}
.dept_column{
width: 50%;
float: left;
padding-right: 10px;
} 
.dept_update_btn{
margin-left: 530px;
}
.form-control{
 background-color: #e9ecef;
}
</style>
<div class="dept_edit">
    <div class="card" style="border: 2px solid black;">
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
            <h4 style="text-align:center"> <b>Edit Department</b>
                <a href="{{url('admin/view-department')}}" class="btn btn-danger float-end">BACK</a>
            </h4>
        </div>
        {!! Form::open(['action' => ['App\Http\Controllers\Admin\AdminController@update_department',$dept_id->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="card-body">
            @csrf 
            @method('PUT')
           
          
                <div class="dept_column">
                    <label class="dept_label">Department Name</label>
                    <input type="text" style="text-align:center" name="dept_name" value="{{$dept_id->dept_name}}" class="form-control">
                </div>  
                <div class="dept_row">  
                    <div class="dept_column">
                        <label class="dept_label">Created At</label>
                        <p class="form-control">
                            {{date('M,d,D,Y,g:i A',strtotime($dept_id->created_at))}}</p>
                    </div>
                    <div class="dept_column">
                        <label class="dept_label">Updated At</label>
                        <p class="form-control">
                            {{date('M,d,D,Y,g:i A',strtotime($dept_id->updated_at))}}</p>
                    </div>
                    <div class="dept_column">
                        <label class="dept_label">Deleted At</label>
                        <p class="form-control">
                            {{date('M,d,D,Y,g:i A',strtotime($dept_id->deleted_at))}}</p>
                    </div>  
                    <div class="dept_update_btn">
                        <button type="submit" class="btn btn-primary">Update Department</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection