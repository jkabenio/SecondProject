@extends('layouts.admin-app')
<style>
.add_signee{
    padding-top: 39px;
}
.page-item.active .page-link{
    z-index: 1;
}
.form-control{
    background-color: #e9ecef;
}
.add_signee_column{
    width: 50%;
    float: left;
    padding-right: 10px;
    padding-left: 10px;
}
.add_signe_btn{
 padding-top: 275px;
 margin-left: 570px;
}
.add_signee_row{
border: 3px solid black;
}
.add_signee_label{
margin-left: 270px;
font-weight: bold;
}
</style>
@section('content')
<div class="add_signee">
    <div class="card" style="border: 2px solid black; ">      
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
            <div class="add_signee_row">
                    <h3 style="color:blue;; font-weight: bold; text-align: center">Add New Signee</h3>
                    <div class="card-body" style="padding: 0px; margin: 0px; font-size: 12px" >
                        {!! Form::open(['action' => 'App\Http\Controllers\Admin\AdminController@store_signee', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            {{csrf_field()}}
                            <div class="add_signee_column">
                                <label class="add_signee_label"  style="color: black">{{ __('Name') }} </label>
                                <input style="text-align:center" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Last Name, First Name, Middle Initial">
                                
                            </div>
                           
                           
                           
                            <div class="add_signee_column">
                                <label class="add_signee_label"  style="color: black"> 
                                    {{ __('Role') }}
                                </label>                   
                                    <select style="text-align:center" name="role_as" class="form-control">
                                        <option selected="true" disabled="true">--Choose Role--</option>
                                        @foreach ($roles as $item)
                                        @if(strcasecmp($item->role_name,'Student') !== 0)
                                                <option value="{{$item->role_name}}">{{$item->role_name}}</option>
                                            @endif
                                        @endforeach                                      
                                    </select>
                            </div>


                            <div class="add_signee_column">
                                <label class="add_signee_label" style="color: black">{{ __('Department') }}</label>
                                    <select style="text-align:center" name="dept_id" class="form-control select-class from required">
                                        <option selected disabled>--Select Department--</option>
                                        <option value="0">Not Applicable</option>
                                        @foreach($dept_list as $list)
                                        <option value="{{$list->id}}"> {{$list->dept_name}}</option>                   
                                        @endforeach
                                    </select>
                            </div>



                            <div class="add_signee_column">
                                <label class="add_signee_label" for="school_id"  style="color: black">
                                    {{ __('User_ID') }}
                                </label>                   
                                    <input placeholder="Example ID: 11-23456" style="text-align:center" id="school_id" type="text"
                                        class="form-control{{ $errors->has('school_id') ? ' is-invalid' : '' }}"
                                        name="school_id" value="{{ old('school_id') }}" required>
                            </div>

                           

                            <div class="add_signee_column">
                                <label class="add_signee_label" for="password"  style="color: black">{{ __('Password') }}</label>
                                    <input style="text-align:center" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
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

                            <div class="add_signee_column">
                                <label class="add_signee_label" for="email"  style="color: black">{{ __('Email Address') }}</label>
                                    <input style="text-align:center" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                            <div class="add_signee_column">
                                <label class="add_signee_label" for="password-confirm" style="color: black">{{ __('Confirm Password') }}</label>
                                    <input style="text-align:center" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <label style="color:black; margin-bottom:10px; padding-bottom:5px; font-size:12px; margin-left: 20px; float: left;"> <input class="form-check-input"  type="checkbox" onclick="myFunction()">Show Password</label>
                            </div>

                            
                            <div class="add_signe_btn">
                                <input type="submit" class="btn btn-primary"/>
                            </div>
                        
                        {!! Form::close() !!}
                    </div>
            </div>   
                <div style="background-color:rgb(224, 224, 225);">
                    <h3 style="color:blue; text-align: center">Activity Logs</h3>
                    <table class="table table-bordered" style=" border: 1px solid black; font-size: 12px;">
                        <thead >
                            <tr > 
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($users as $item)
                            <tr  >
                                {{-- @if($item->role_as == '0') --}}
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{date('M,d,D,Y,g:i A',strtotime($item->created_at))}}</td>
                                {{-- <td>{{$item->terms}}</td> --}}
                            </tr>
                            {{-- @endif --}}
                            @endforeach
                        </tbody>        
                    </table>                   
                    {{$users->links()}} 
                </div>                
             </div>            
         </div>          
    </div>   
@include('admin.user-activity')
@endsection







