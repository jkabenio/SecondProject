@extends('layouts.admin-app')

@section('content')

<style>
.add_role_view{
padding-top: 39px;
}
.add_role_column{
    width:100%;
}
.input_role{
    margin-left: 300px;
    text-align: center; 
   }
.add_role_btn{
    margin-left: 570px;
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

<div class="add_role_view">
    <div class="card" style=" border: 2px solid black; ">      
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
<div class="add_role_row">
    <div class="add_role_column" style=" border: 3px solid black ">
        <h3 style="color:blue; text-align: center; font-weight: bold">Add New Role</h3>
        <div class="card-body" style="padding: 0px; margin: 0px; font-size: 12px" >
            {!! Form::open(['action' => 'App\Http\Controllers\Admin\AdminController@store_role', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                {{csrf_field()}}

                    <label style="color: black;margin-left: 570px;">Role Name</label>
                    <div class="col-md-6">
                        <input  type="text" class="form-control input_role @error('role_name') is-invalid @enderror" name="role_name" value="{{ old('role_name') }}" required>
                        @error('role_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                <div class="add_role_btn">
                    <input type="submit" class="btn btn-primary"/>
                </div>
            
            {!! Form::close() !!}
                </div>
        </div>
    </div>

    <div class="add_role_column" style="background-color:rgb(224, 224, 225);">
        <h3 style="color:blue; text-align: center">Activity Logs</h3>
        <table class="table table-bordered" style=" border: 1px solid black; font-size: 12px;">
            <thead >
                <tr > 
                    <th>Role Name</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th>Date Deleted</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($role_log as $item)
                <tr  >
                    {{-- @if($item->role_as == '0') --}}
                    <td>{{$item->role_name}}</td>
                    <td>{{date('M,d,D,Y,g:i A',strtotime($item->created_at))}}</td>
                    <td>{{date('M,d,D,Y,g:i A',strtotime($item->updated_at))}}</td>
                    <td>{{date('M,d,D,Y,g:i A',strtotime($item->deleted_at))}}</td>
                    {{-- <td>{{$item->terms}}</td> --}}
                </tr>
                {{-- @endif --}}
                @endforeach
            </tbody>        
        </table>                   
        {{$role_log->links()}} 
    </div>
</div>
</div>
</div>
@include('admin.user-activity')
@endsection