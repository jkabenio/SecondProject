@extends('layouts.admin-app')
@section('content')
<style>
    td{
      white-space:nowrap;
      text-overflow:ellipsis; 
      overflow:hidden;     
    }
    .change_pass_signee-view{
        padding-top: 39px;
    }
    .page-item.active .page-link{
    z-index: 1;
}
</style>          
            <div class="change_pass_signee-view">
                <div class="card" style=" border: 2px solid black">
                    <div class="card-header">
                        <h4 style="text-align: center; font-weight: bold">Change Signee Password</h4>
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
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" style="border: 1px solid black">
                            <thead >
                                <tr >
                                    <th>No.</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>School ID</th>
                                    <th>Role</th>
                                    <th>Edit</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @foreach ($signee_table as $count_data => $item)
                                    <tr> 
                                        <td >{{$count_data + 1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->school_id}}</td>
                                        <td> {{ $item->role_as}}</td>                            
                                        <td>
                                            <a class="btn btn-danger"  href="{{url ('admin/edit-signee-password/'.$item->id)}}" >Change Password</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                        {{$signee_table->links()}}
                    </div>
                </div> 
    @include('admin.user-activity')
@endsection