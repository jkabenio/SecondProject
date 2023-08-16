@extends('layouts.admin-app')

@section('content')
<style>
    .role_view{
padding-top: 39px;
    }
    .page-item.active .page-link{
    z-index: 1;
}
</style>
    
    {{-- <form method="post" action="{{url('users')}}"> --}}
        <div class="role_view">
            <div class="card" style="width:100%; border: 2px solid black">
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
                                <div class="alert alert-success"style="text-align: center">
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
                    <h4 style="text-align: center;font-weight: bold;">Role List</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" style="border: 1px solid black">
                        <thead >
                            <tr >
                                <th>Id</th> 
                                <th>Role Name</th>    
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($role_table as $count_data => $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->role_name}}</td>                             
                                <td>
                                    <a href="{{url ('admin/edit-role/'.$item->id)}}"><img class="edit" src="{{ asset('/img/edit.png') }}" alt="Italian Trulli"></a>
                                </td>
                                <td>
                                    <a onclick="document.getElementById({{$item->id}}).style.display='block'" ><img class="edit" src="{{ asset('/img/delete.png') }}" alt="Italian Trulli"></a>
                                </td>
                            </tr>
                            <div id="{{$item->id}}" class="w3-modal" >
                                <div class="w3-modal-content" style="width:30%;">
                                    <header class="warning_header">
                                        <span onclick="document.getElementById({{$item->id}}).style.display='none'"
                                        class="ekis_button w3-display-topright"><b>&times;</b></span>
                                        <h2 style="color: rgb(248, 50, 50)"><b>WARNING!</b></h2>
                                    </header>
                                    <div class="w3-container">
                                        <p style="text-align: left">
                                            Are you sure you want to delete<br>
                                            ID:<b>{{$item->id}}</b><br>
                                            Role Name:<b>{{$item->role_name}}</b><br> 
                                            Created At:<b>{{$item->created_at}}</b><br>
                                            Updated At:<b>{{$item->updated_at}} ?</b> 
                                        </p>
                                    </div>
                                    <footer class="footer_line">
                                        <p class="button_option">
                                            <b>
                                                <a class="temporary_button" href="{{url ('admin/delete-role/'.$item->id)}}">Temporarily!</a>
                                                <a class="temporary_button" href="{{url ('admin/permanent-delete-role/'.$item->id)}}">Permanently!</a>
                                                <a class="no_button" style="cursor: pointer" onclick="document.getElementById({{$item->id}}).style.display='none'">NO!</a>
                                            </b>
                                        </p>       
                                    </footer>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
            
                    </table>
                    {{$role_table->links()}}
                </div>
            </div>       
        </div>
     @include('admin.user-activity')
@endsection