@extends('layouts.admin-app')

@section('content')
<style>
.restore:hover{
width: 36px;
height: 32px;
}
/* img{
width: 34px;
height: 34px; 
} */
.btn{
    width: 140px;
    color: white;
    text-align: left;
}
.no_button:hover {
    
    text-decoration: none;
    background-color: rgb(0, 216, 0);
}
.no_button{
    
    background-color: green;
}
.temporary_button:hover {
    color:#fff !important;
    text-decoration: none;
    background-color: rgb(255, 46, 46);
}
.temporary_button{
    margin-right: 10px;
    background-color: rgb(178, 1, 1);
}
.trash_view{
    padding-top: 39px;
}
</style>
    <div class="trash_view">
        <div class="card" style="width:100%; border: 2px solid black">
            <div class="card-header">
                <h4 style="text-align:center; font-weight: bold">Trashed List</h4>
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
                {{--BELOW IS DEPARMENT TABLE  --}}
                <table class="table table-bordered" style=" border: 1px solid black">
                    <div class="restore_all" align="left">
                    <a class="btn btn-primary" href="/admin/restore-all-department"><img src="{{ asset('/img/file.png') }}" alt="Italian Trulli">Restore all</a>
                    </div>
                   <thead >
                        <tr >   
                            <th>ID</th>
                            <th>Department Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Restore</th>
                            <th>Delete</th>
                        </tr>
                    </thead> 
                    <tbody >
                        @foreach ($trashed_department as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->dept_name}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>                                 
                            <td>
                                <a href="{{url ('admin/restore-department/'.$item->id)}}" ><img class="restore"  src="{{ asset('/img/recycle.png') }}" alt="Italian Trulli"></a>
                            </td>
                            <td>
                                <a href="{{url ('admin/permanent-delete-department-from-trash/'.$item->id)}}" ><img class="edit" src="{{ asset('/img/delete.png') }}" alt="Italian Trulli"></a>
                            </td>
                             </tr>
                        @endforeach
                    </tbody>
                </table>
                {{--BELOW IS COURSE TABLE  --}}
                <table class="table table-bordered" style="; border: 1px solid black">
                    <div class="restore_all" align="left">
                    <a class="btn btn-primary" href="/admin/restore-all-course"><img src="{{ asset('/img/file.png') }}" alt="Italian Trulli">Restore all</a>
                    </div>
                   <thead >
                    
                        <tr >  
                            <th>ID</th>
                            <th>Course Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Restore</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($trashed_course as $delete_course)
                        <tr>
                            <td>{{$delete_course->id}}</td>
                            <td>{{$delete_course->course_name}}</td>
                            <td>{{$delete_course->created_at}}</td>
                            <td>{{$delete_course->updated_at}}</td>                                
                            <td>
                                <a href="{{url ('admin/restore-course/'.$delete_course->id)}}" ><img class="restore"  src="{{ asset('/img/recycle.png') }}" alt="Italian Trulli"></a>
                            </td>
                            <td>
                                <a href="{{url ('admin/permanent-delete-course-from-trash/'.$delete_course->id)}}" ><img class="edit" src="{{ asset('/img/delete.png') }}" alt="Italian Trulli"></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{--BELOW IS SUBJECT TABLE  --}}
                <table class="table table-bordered" style="border: 1px solid black">
                    <div class="restore_all" align="left">
                    <a class="btn btn-primary" href="/admin/restore-all-subject"><img src="{{ asset('/img/file.png') }}" alt="Italian Trulli">Restore all</a>
                    </div>
                   <thead >
                    
                        <tr >  
                            <th>ID</th>
                            <th>Subject Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Restore</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($trashed_subject as $delete_subject)
                        <tr>
                            <td>{{$delete_subject->id}}</td>
                            <td>{{$delete_subject->subj_name}}</td>
                            <td>{{$delete_subject->created_at}}</td>
                            <td>{{$delete_subject->updated_at}}</td>                                
                            <td>
                                <a href="{{url ('admin/restore-subject/'.$delete_subject->id)}}" ><img class="restore"  src="{{ asset('/img/recycle.png') }}" alt="Italian Trulli"></a>
                            </td>
                            <td>
                                <a href="{{url ('admin/permanent-delete-subject-from-trash/'.$delete_subject->id)}}" ><img class="edit" src="{{ asset('/img/delete.png') }}" alt="Italian Trulli"></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{--BELOW IS STUDENT TABLE  --}}
                <table class="table table-bordered" style=" border: 1px solid black">
                    <div class="restore_all" align="left">
                    <a class="btn btn-primary" href="/admin/restore-all-student"><img src="{{ asset('/img/file.png') }}" alt="Italian Trulli">Restore all</a>
                    </div>
                   <thead >
                    
                        <tr >  
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Restore</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($trashed_student as $delete_student)
                        <tr>
                            <td>{{$delete_student->id}}</td>
                            <td>{{$delete_student->name}}</td> 
                            <td>{{$delete_student->created_at}}</td>
                            <td>{{$delete_student->updated_at}}</td>                               
                            <td>
                                <a href="{{url ('admin/restore-student/'.$delete_student->id)}}" ><img class="restore"  src="{{ asset('/img/recycle.png') }}" alt="Italian Trulli"></a>
                            </td>
                            <td>
                                <a href="{{url ('admin/permanent-delete-student-from-trash/'.$delete_student->id)}}" ><img class="edit" src="{{ asset('/img/delete.png') }}" alt="Italian Trulli"></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{--BELOW IS ROLE TABLE  --}}
                <table class="table table-bordered" style=" border: 1px solid black">
                    <div class="restore_all" align="left">
                    <a class="btn btn-primary" href="/admin/restore-all-role"><img src="{{ asset('/img/file.png') }}" alt="Italian Trulli">Restore all</a>
                    </div>
                   <thead >
                    
                        <tr >  
                            <th>ID</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Restore</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($trashed_role as $delete_role)
                        <tr>
                            <td>{{$delete_role->id}}</td>
                            <td>{{$delete_role->role_name}}</td>
                            <td>{{$delete_role->created_at}}</td>
                            <td>{{$delete_role->updated_at}}</td>                              
                            <td>
                                <a href="{{url ('admin/restore-role/'.$delete_role->id)}}" ><img class="restore"  src="{{ asset('/img/recycle.png') }}" alt="Italian Trulli"></a>
                            </td>
                            <td>
                                <a href="{{url ('admin/permanent-delete-role-from-trash/'.$delete_role->id)}}" ><img class="edit" src="{{ asset('/img/delete.png') }}" alt="Italian Trulli"></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{--BELOW IS SIGNEE TABLE  --}}
                <table class="table table-bordered" style=" border: 1px solid black">
                    <div class="restore_all" align="left">
                    <a class="btn btn-primary" href="/admin/restore-all-signee"><img src="{{ asset('/img/file.png') }}" alt="Italian Trulli">Restore all</a>
                    </div>
                   <thead >
                    
                        <tr >  
                            <th>ID</th>
                            <th>Signee Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Restore</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($trashed_signee as $delete_signee)
                        <tr>
                            <td>{{$delete_signee->id}}</td>
                            <td>{{$delete_signee->name}}</td>
                            <td>{{$delete_signee->created_at}}</td>
                            <td>{{$delete_signee->updated_at}}</td>                               
                            <td>
                                <a href="{{url ('admin/restore-signee/'.$delete_signee->id)}}" ><img class="restore" src="{{ asset('/img/recycle.png') }}" alt="Italian Trulli"></a>
                            </td>
                            <td>
                                <a href="{{url ('admin/permanent-delete-signee-from-trash/'.$delete_signee->id)}}" ><img class="edit" src="{{ asset('/img/delete.png') }}" alt="Italian Trulli"></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>       
    </div>
@endsection