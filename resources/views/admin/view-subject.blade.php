@extends('layouts.admin-app')
 
@section('content')
<style>
    .subject_view{
        padding-top: 39px;
        text-align: center;
    }
    .pagination{
        margin-left: 550px;
    }
    .page-item.active .page-link{
    z-index: 1;
}
</style>

    <div class="subject_view">
        <div class="card" style="border: 2px solid black">
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
                <h4 style="text-align:center;font-weight: bold;">Subject List</h4>
            </div>
            <div class="card-body">       
                <table class="table table-bordered" style="border: 1px solid black">
                    <thead>
                        <tr>
                            <div  class="col-md-4" style="padding-left: 0px; margin-right: 0px">
                                <input type="search" class="form-control"  name="search" id="admin-subject-search" placeholder="Search by: Code or Subject Code"/>                                              
                            </div>
                            <th>Id</th>
                            <th>Code</th>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Signee</th>
                            <th>Unit</th>
                            <th>Year Level</th>
                            <th>Semester</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr> 
                    </thead>
                    <tbody id="Admin-Subject-Content"> 
                        @foreach ($subject_table as $count_data => $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->code}}</td>
                                <td>{{$item->subj_code}}</td>
                                <td>{{$item->subj_name}}</td>
                                <td>{{$item->signee_names}}</td>  
                                <td>{{$item->unit}}</td>
                                <td>{{$item->year_level}}</td> 
                                <td>{{$item->semester}}</td>                            
                                <td>
                                    <a href="{{url ('admin/edit-subject/'.$item->id)}}" ><img class="edit" src="{{ asset('/img/edit.png') }}" alt="Italian Trulli"></a>
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
                                        <h2 style="color: rgb(248, 50, 50); text-align:center"><b>WARNING!</b></h2>
                                    </header>
                                    <div class="w3-container">
                                        <p style="text-align: left">
                                            Are you sure you want to delete<br>
                                            ID:<b>{{$item->id}}</b><br>
                                            Course ID:<b>{{$item->course_id}}</b><br>
                                            Code:<b>{{$item->code}}</b><br>
                                            subject Code:<b>{{$item->subj_code}}</b><br>
                                            Subject Name:{{$item->subj_name}}
                                            Unit:<b>{{$item->unit}}</b><br>
                                            Year Level:<b>{{$item->year_level}}</b><br>
                                            Semester:<b>{{$item->semester}}</b><br>
                                            Signee Name:<b>{{$item->signee_names}}</b><br>
                                            Section:<b>{{$item->section}}</b><br>
                                            Created At:<b>{{$item->created_at}}</b><br>
                                            Updated At: <b>{{$item->updated_at}} ?</b></p>
                                    </div>
                                    <footer class="footer_line">
                                        <p class="button_option">
                                            <b>
                                                <a class="temporary_button" href="{{url ('admin/delete-subject/'.$item->id)}}" >Temporarily!</a>
                                                <a class="temporary_button" href="{{url ('admin/permanent-delete-subject/'.$item->id)}}" >Permanently!</a>
                                                <a class="no_button" style="cursor: pointer" onclick="document.getElementById({{$item->id}}).style.display='none'">NO!</b></a>      
                                            </b>
                                        </p>       
                                    </footer>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{$subject_table->links()}} --}}
            </div>
        </div>       
    </div>
    @include('admin.user-activity')
@endsection