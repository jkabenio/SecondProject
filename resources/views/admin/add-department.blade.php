@extends('layouts.admin-app')

@section('content')

<style>
   .add_dept_css{
    padding-top: 39px;
   }
   .dept-label{
    color: black;
  margin-left: 45%; 
   }
   .form-control{
    margin-left: 300px;
    text-align: center; 
   }
   .dept_submit{
    padding-top: 5px;
    padding-bottom: 5px;
    margin-left: 570px; 
   }
   .pagination{
    margin-left: 580px; 
   }
   .page-item.active .page-link{
    z-index: 1;
}
.form-control{
 background-color: #e9ecef;
}
</style>

<div class="add_dept_css">

    <div class="card" style=" border: 2px solid black; ">      
        <div class="card-header" style="background-color: white">        
            <div class="first_row">
                <div style="border: 3px solid black ">
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
                    <h3 style="color:blue;text-align: center; font-weight: bold">Add New Department</h3>
                    <div class="card-body" style="padding: 0px; margin: 0px; font-size: 12px" >
                        {!! Form::open(['action' => 'App\Http\Controllers\Admin\AdminController@store_department', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        {{csrf_field()}}
                        <label class="dept-label">Department Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('dept_name') is-invalid @enderror" name="dept_name" value="{{ old('dept_name') }}" required>
                        </div>
                        <div class="dept_submit">
                            <input type="submit" class="btn btn-primary"/>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <div style="background-color:rgb(224, 224, 225);">
        <h3 style="color:blue;text-align: center">Activity Logs</h3>
        <table class="table table-bordered" style=" border: 1px solid black; font-size: 12px;">
            <thead >
                <tr > 
                    <th>Department Name</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th>Date Deleted</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($department as $item)
                <tr  >
                    <td>{{$item->dept_name}}</td>
                    <td>{{date('M,d,D,Y,g:i A',strtotime($item->created_at))}}</td>
                    <td>{{date('M,d,D,Y,g:i A',strtotime($item->updated_at))}}</td>
                    <td>{{date('M,d,D,Y,g:i A',strtotime($item->deleted_at))}}</td>
                </tr>
                @endforeach
            </tbody>        
        </table>                   
        {{$department->links()}} 
    </div>
@endsection
