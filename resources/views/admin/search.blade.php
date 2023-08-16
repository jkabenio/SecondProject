@extends('layouts.admin-app')

@section('content')

<style>
    td{
      white-space:nowrap;
      text-overflow:ellipsis; 
      overflow:hidden;
      
    }
</style> 
        <div class="clearance_body_admin">
            <div class="card" style="width:99%; border: 2px solid black">
                <div class="card-header">
                    <h4>Student List</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" style="width:900px; border: 1px solid black">
                        <thead >
                            <tr >
                                {!! Form::open(['action' => 'App\Http\Controllers\Admin\SearchController@index', 'method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
                                {{csrf_field()}}
                                <div class="col-md-4" style="padding-left: 0px">
                                    <input type="text" class="form-control" value="" name="query" id="query"  placeholder="Search by: Name or School ID"/>
                                </div>
                                {!! Form::close() !!}
                                {{-- <button class="fa fa-search">search</button> --}}
                                <th>No.</th>
                                <th>name</th>
                                <th>email</th>
                                <th>School ID</th>
                                {{-- <th>Password</th> --}}
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead> 
                        <tbody >
                            @foreach ($student as $count_data => $item)                      
                            <tr> 
                                <td >{{$count_data + 1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->school_id}}</td>
                                {{-- <td >{{$item->password}}</td> --}}
                                {{-- <td>{{$item->terms}}</td> --}}
                                <td>
                                    {{ $item->role_as == '0' ? 'Student' : ''}}
                                    
                                    {{$item->role_as == '1' ? 'Admin':''}}
                                    {{ $item->role_as == '2' ? 'Instructor' : ''}}
                                </td>                                
                                <td>
                                    <a class="w3-button w3-green"  href="{{url ('admin/edit-student/'.$item->id)}}" ><i class="material-icons">&#xe22b;</i></a>
                                </td>
                                <td>
                                    <button onclick="document.getElementById({{$item->id}}).style.display='block'" class="w3-button w3-red"><i style="font-size:24px" class="fa">&#xf014;</i></button>
                                    {{-- <a href="{{url ('admin/delete-student/'.$item->id)}}" ><i style="font-size:24px" class="fa">&#xf014;</i></a> --}}
                                    {{-- <button type="button" class="btn btn-danger" data-target="deleteModal" data-toggle="modal" value="{{$item->id}}">Delete</button> --}}
                                </td>
                            </tr>
                            {{-- data-target="#ModalDelete{{$item->id}}" data-toggle="modal" --}}
                        </div>
                        <div id="{{$item->id}}" class="w3-modal" >
                            <div class="w3-modal-content" style="width:30%;">
                          
                              <header class="w3-container w3-blue">
                                <span onclick="document.getElementById({{$item->id}}).style.display='none'"
                                class="w3-button w3-display-topright">&times;</span>
                                <b><h2 style="color: rgb(248, 50, 50)">WARNING!</h2>
                              </header>
                          
                              <div class="w3-container">
                                <p>Are you sure you want to delete<br>ID:{{$item->id}}<br>Student Name:{{$item->name}} ?</p>

                                
                              </div>
                          
                              <footer class="w3-container w3-blue">
                                <p><a style="background-color: red" href="{{url ('admin/delete-student/'.$item->id)}}" >YES</a> <a style="background-color: green" href="{{url ('/admin/view-student-user')}}" >NO </b></a></p>
                              
                              </footer>
                          
                            </div>
                          </div>
                            @endforeach
                        </tbody> 
            
                    </table>
                    {{$student->links()}}
                    {{-- {{$student->links()}} --}}
                </div>
            </div>       
{{-- @include('admin.user-activity') --}}
@endsection