@extends('layouts.admin-app')

@section('content')

<style>
    .student_view{
        padding-top: 39px;
    }
    .page-item.active .page-link{
    z-index: 1;
}
</style> 
    <div class="student_view">
        <div  class="card" style=" border: 2px solid black">
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
                <h4 style="text-align:center;font-weight: bold;">Student List</h4>
            </div>
            <div  class="card-body">
                <table class="table table-bordered" style="border: 1px solid black">
                    <thead >
                        <tr > 
                            
                            <form action="{{ route('admin.view-student-user') }}" method="GET">
                                {{csrf_field()}}
                                {{-- <div class="row">
                                   
                                    <div class="col-md-2 col-3">
                                        <select name="sortBy" class="form-control form-control-sm" value="{{ $sortBy }}">
                                            @foreach(['id', 'name', 'school_id','year_lvl','course'] as $col)
                                                <option @if($col == $sortBy) selected @endif value="{{ $col }}">{{ ucfirst($col) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-3">
                                        <select name="orderBy" class="form-control form-control-sm" value="{{ $orderBy }}">
                                            @foreach(['asc', 'desc'] as $order)
                                                <option @if($order == $orderBy) selected @endif value="{{ $order }}">{{ ucfirst($order) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-3">
                                        <select name="perPage" class="form-control form-control-sm" value="{{ $perPage }}">
                                            @foreach(['5','10','20','50','150','200','250','300'] as $page)
                                                <option @if($page == $perPage) selected @endif value="{{ $page }}">{{ $page }}</option>
                                            @endforeach
                                        </select>
                                    </div>                           
                                    <div style="margin-left: 130px;">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div> --}}
                                @php
                                    $result = "";
                                    $id_val = 0;
                                @endphp
                                @foreach ($course as $item)
                                    @if(Request::get('course') == $item->id)
                                    @php
                                    $result = $item->course_acronym;
                                    $id_val =  $item->id;
                                @endphp
                                    @endif
                                @endforeach
                                <div class="row">
                                    <div class="col-md-2 col-3">
                                        <select name="course" class="form-control">
                                            @if(Request::get('course') == null)
                                                <option value="">All Course</option>
                                            @endif
                                            @if(Request::get('course') !== null)
                                                <option value="{{$id_val}}" {{Request::get('course')}}>{{$result}}</option>
                                            @endif
                                            @if(Request::get('course') !== null)
                                            <option value="">All Course</option>
                                        @endif
                                            @foreach ($course as $item)
                                                @if($item->id !== $id_val)
                                                    <option  value="{{$item->id}}" {{Request::get('course') == 'course' ? 'selected':''}}>{{$item->course_acronym}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-3">
                                        <select name="year_lvl"  class="form-control">
                                            <option value="">All Level</option>
                                            <option value="1st Year" {{Request::get('year_lvl') == '1st Year' ? 'selected':''}}>1st Year</option>
                                            <option value="2nd Year" {{Request::get('year_lvl') == '2nd Year' ? 'selected':''}}>2nd Year</option>
                                            <option value="3rd Year" {{Request::get('year_lvl') == '3rd Year' ? 'selected':''}}>3rd Year</option>
                                            <option value="4th Year" {{Request::get('year_lvl') == '4th Year' ? 'selected':''}}>4th Year</option>
                                        </select>
                                    </div>
                                    <div style="margin-left: 57.55%">
                                        <button style="width: 100px" type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>
                            <div  class="col-md-4" style="padding-left: 0px; margin-right: 0px">
                                <input type="search" class="form-control"  name="search" id="admin-student-search" placeholder="Search by: Name or School ID"/>                                              
                            </div>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>School ID</th> 
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead> 
                    <tbody id="Admin-Student-Content">
                        @if(count($student_user)>0)
                            @foreach ($student_user as $count_data => $item)
                                <tr> 
                                    <td>{{$item->name}}</td>
                                        @foreach($course as $course_id)
                                            @if($course_id->id == $item->course)
                                                <td>{{$course_id->course_acronym}}</td>
                                            @endif
                                        @endforeach
                                    <td>{{$item->year_lvl}}</td>
                                    <td>{{$item->school_id}}</td>
                                    <td>
                                        <a href="{{url ('admin/edit-student/'.$item->id)}}" ><img class="edit" src="{{ asset('/img/edit.png') }}" alt="Italian Trulli"></a>
                                    </td>
                                    <td>
                                        <a onclick="document.getElementById({{$item->id}}).style.display='block'" ><img class="edit" src="{{ asset('/img/delete.png') }}" alt="Italian Trulli"></a>
                                    </td>
                                </tr>
                                <div id="{{$item->id}}" class="w3-modal" >
                                    <div class="w3-modal-content" style="width:30%;">
                                        <header class="warning_header">
                                            <span onclick="document.getElementById({{$item->id}}).style.display='none'"
                                                class="ekis_button w3-display-topright"><b>&times;</b>
                                            </span>
                                            <h2 style="color: rgb(248, 50, 50)"><b>WARNING!</b></h2>
                                        </header> 
                                        <div class="w3-container">
                                            <p style="text-align: left">
                                                Are you sure you want to delete<br>
                                                ID:<b>{{$item->id}}</b><br>
                                                Student Name:<b>{{$item->name}}</b><br>
                                                Course ID:<b>{{$item->course}}</b><br>
                                                Year level:<b>{{$item->year_lvl}}</b><br>
                                                School ID:<b>{{$item->school_id}} ?</b>
                                            </p>
                                        </div>
                                        <footer class="footer_line">
                                            <p class="button_option">
                                                <b>
                                                    <a class="temporary_button" href="{{url ('admin/delete-student/'.$item->id)}}" >Temporarily!</a>
                                                    <a class="temporary_button" href="{{url ('admin/permanent-delete-student/'.$item->id)}}" >Permanently!</a>
                                                    <a class="no_button" style="cursor: pointer" onclick="document.getElementById({{$item->id}}).style.display='none'">NO!</a>      
                                                </b>
                                                </p>       
                                        </footer>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        {{-- {{$users->links()}} --}}
                    </tbody>
                </table>
            </div>  
        </div>
    </div>       
    @include('admin.user-activity')
@endsection
