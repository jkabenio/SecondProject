@extends('layouts.admin-app')
<style>
.course_view{
    padding-top: 39px;
}
.page-item.active .page-link{
    z-index: 1;
}
</style>
@section('content')
        <div class="course_view">
            <div class="card" style="border: 2px solid black">
                <div class="card-header">
                    <h4 style="text-align:center;font-weight: bold;">Course List</h4>
                </div>
                <div class="card-body">
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
                    <table class="table table-bordered">
                        <thead >
                            <tr >
                                <th>Id</th>
                                <th>Course Name</th>
                                <th>Department</th>
                                <th>Acronym</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($course_table as $count_data => $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->course_name}}</td>
                                @foreach($department as $dept_list)
                                    @if($dept_list->id == $item->dept_id)
                                        <td>{{$dept_list->dept_name}}</td>
                                    @endif
                                @endforeach   
                                <td>{{$item->course_acronym}}</td>                             
                                <td>
                                    <a href="{{url ('admin/edit-course/'.$item->id)}}"><img class="edit" src="{{ asset('/img/edit.png') }}" alt="Italian Trulli"></a>
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
                                        <p style="text-align: left"> Are you sure you want to delete<br>
                                            ID:<b>{{$item->id}}</b><br>
                                            Course Name:<b>{{$item->course_name}}</b><br>
                                            Department ID:<b>{{$item->dept_id}}</b><br>
                                            Course Acronym:<b>{{$item->course_acronym}}</b><br>
                                            Created At: <b>{{$item->created_at}}</b><br>
                                            Updated At: <b>{{$item->updated_at}} ?</b></p>
                                    </div>
                                    <footer class="footer_line">
                                        <p class="button_option">
                                            <b>
                                                <a class="temporary_button" href="{{url ('admin/delete-course/'.$item->id)}}" >Temporarily!</a>
                                                <a class="temporary_button" href="{{url ('admin/permanent-delete-course/'.$item->id)}}" >Permanently!</a>
                                                <a class="no_button" style="cursor: pointer" onclick="document.getElementById({{$item->id}}).style.display='none'">NO!</a></p>       
                                            </b>
                                    </footer>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
            
                    </table>
                    {{$course_table->links()}}
                </div>
            </div>       
        </div>

@include('admin.user-activity')
@endsection