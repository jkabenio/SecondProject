@extends('layouts.admin-app')

@section('content')
<style>
label{
    text-align:left;
    margin-left: 8%;
    
}
.add_student{
    padding-top: 28px;
    background-color:rgb(255, 255, 255);
}
.add_student_row{
width: 100%;
border-color: solid black;
    border: 2px solid;
}
.add_student_column{
width: 50%;
float: left;
padding: 10px;
}
.add_student_label{
    margin-left: 270px;
}
.add_student_btn{
    padding-top: 435px !important;
    margin-left: 590px !important;
    padding-bottom: 10px;
;
}
.page-item.active .page-link{
    z-index: 1;
}
.form-control{
    background-color: #e9ecef;
}
</style>


<script>
    $('div.alert').delay(10000).slideUp(1000);
</script>
<script>
    $(document).ready(function(){
        $('.subjects_list').select2({
            placeholder:'select subject',
            allowClear:true,
        });
        $("#subjects_list").select2({
            ajax:{
                url:"{{ route('admin.get-subjects') }}",
                type:"post",
                delay:250,
                dataType:'json',
                data: function(params){
                    return{
                        signee_names:params.term,
                        section:params.term,
                        subj_name:params.term,
                       
                        "_token":"{{csrf_token() }}",
                    };
                },
                processResults:function(data){
                    return {
                        results: $.map(data,function (item){
                            return {
                                text:`${item.subj_name} (${item.section}) (${item.signee_names})`,
                                label:item.signee_names,
                                id:item.id,
                                title:item.subj_code,
                                
                            }
                        })
                    };
                },

            },
        });
    });

</script>


<div class="add_student">
    @if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" style="text-align:center">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success" style="text-align:center">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" style="text-align:center">
        {{session('error')}}
    </div> 
@endif
                   
                    <div class="card-body" style="padding: 0px; margin: 0px; font-size: 12px;" >
                        
                        {!! Form::open(['action' => 'App\Http\Controllers\Admin\AdminController@store_student', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            {{csrf_field()}}
                        <div class="add_student_row">
                            <h3 style="color:white; text-align:center; font-weight: bold; background-color: rgb(3, 3, 142);"><b>Add New Student</b></h3>
                            <div class="add_student_column">
                                <label class="add_student_label" style="color: black"><b>Name</b></label>
                                    <input style="text-align:center" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('email') }}" name="name" placeholder="Last Name, First Name, Middle Initial"  required>
                                    {{-- @error('name')
                                        <span class="invalid-feedback" role="alert" style="text-align:center">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                            </div>
                            <div class="add_student_column">
                                <label class="add_student_label" style="color: black"><b>Department</b></label>
                                <select style="text-align:center" name="dept_id" class="form-control">
                                    <option selected="true" disabled="true">--Select Department--</option>
                                    @foreach($department as $list)
                                    <option value="{{$list->id}}">{{$list->dept_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="add_student_column">
                                <label class="add_student_label" style="color: black"><b>Email Address</b></label>
                                    <input style="text-align:center" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                    {{-- @error('email')
                                        <span class="invalid-feedback" role="alert" style="text-align:center">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                            </div>
                            <div class="add_student_column">
                                <label class="add_student_label" style="color: black"><b>{{ __('Course') }}</b></label>
                                <select style="text-align:center" name="course" class="form-control" id="course_id">
                                    <option selected="true" disabled="true">Select Course</option>
                                        @foreach ($course as $list)
                                        <option value="{{$list->id}}"><b>{{$list->course_acronym}}- ({{$list->course_name}})</b></option>
                                        @endforeach
                                </select>
                            </div>

                            <div class="add_student_column">
                                <label class="add_student_label" style="color: black"><b>User_ID</b></label>                   
                                    <input style="text-align:center" type="text" class="form-control @error('school_id') is-invalid @enderror" placeholder="Example ID: 11-23456"   name="school_id" value="{{ old('school_id') }}" required>        
                                    {{-- @error('school_id')
                                        <span class="invalid-feedback" role="alert" style="text-align:center">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                            </div>

                            
                        
                            <div class="add_student_column">
                                <label class="add_student_label" style="color: black"><b>Password</b></label>
                                    <input style="text-align:center" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off" required>
                                    {{-- @error('password')
                                        <span class="invalid-feedback" role="alert" style="text-align:center">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                    <script>
                                        function myFunction() { 
                                            var x = document.getElementById("password");
                                            var y = document.getElementById("password-confirm");
                                            if (x.type == "password" || y.type == "password-confirm") {
                                            x.type = "text";
                                            y.type = "text";
                                            } else {
                                            x.type = "password";
                                            y.type = "password";
                                            }
                                        }
                                        </script>    
                            </div>
                            <div class="add_student_column">
                                <label class="add_student_label" style="color: black"><b>Year Level</b></label>
                                     <select style="text-align:center" name="year_lvl" class="form-control">
                                        <option selected="true" disabled="true">--Select Year Level--</option>
                                        <option value="1st Year">1st Year</option>
                                        <option value="2nd Year">2nd Year</option>
                                        <option value="3rd Year">3rd Year</option>
                                        <option value="4th Year">4th Year</option>
                                    </select> 
                                    {{-- @error('year_lvl')
                                        <span class="invalid-feedback" role="alert" style="text-align:center">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                            </div>
                            <div class="add_student_column">
                                <label class="add_student_label" style="color: black"><b>Confirm Password</b></label>
                                    <input style="text-align:center" id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="off" required>
                                    <label style="color:black; margin-bottom:10px; padding-bottom:5px; font-size:12px; margin-left: 20px; float: left;"> <input class="form-check-input"  type="checkbox" onclick="myFunction()"><b>Show Password</b></label>
                                    {{-- @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert" style="text-align:center">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                            </div>
                            <div class="add_student_column">
                                <label class="add_student_label" style="color: black"><b>{{ __('Semester:') }}</b></label>
                                <select style="text-align:center" name="semester" class="form-control">
                                    <option selected="true" disabled="true">--Select Semester--</option>
                                    <option value="1st semester">1st semester</option>
                                    <option value="2nd semester">2nd semester</option>
                                    <option value="summer class">summer class</option>
                                </select>
                            </div>

                            <div class="add_student_column">
                                <label class="add_student_label" style="color: black"><b>Subjects</b></label>
                                <select style="text-align:center" class="subjects_list form-control" id="subjects_list" name="subjects[]" multiple="multiple">
                                    <option></option>
                                </select>
                            </div>
                            @foreach($roles_list as $list)
                                @if(strcasecmp($list->role_name,'Student') == 0)
                                    <input type="hidden" value="{{$list->id}}" name="role_as">
                                @endif
                            @endforeach   
                            <div class="add_student_btn">
                                <input type="submit" class="btn btn-primary"/>
                            </div>
                        
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>          
                <div  style="background-color:rgb(224, 224, 225);">
                    <h3 style="color:blue; text-align:center">Activity Logs</h3>
                    <table class="table table-bordered" style=" border: 1px solid black; font-size: 12px;">
                        <thead>
                            <tr> 
                                <th>Name</th>
                                <th>Date Created</th>
                                <th>Date Updated</th>
                                <th>Date Deleted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{date('M,d,D,Y,g:i A',strtotime($item->created_at))}}</td>
                                    <td>{{date('M,d,D,Y,g:i A',strtotime($item->updated_at))}}</td>
                                    <td>{{date('M,d,D,Y,g:i A',strtotime($item->deleted_at))}}</td>
                                </tr>
                            @endforeach
                        </tbody>        
                    </table>                   
                    {{$users->links()}} 
                </div>
@include('admin.user-activity')
@endsection







