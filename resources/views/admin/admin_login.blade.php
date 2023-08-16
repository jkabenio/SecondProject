@extends('layouts.admin-app')

@section('content')
<style>
body{
    position: static;
    background-image: url(/img/Picsart_22-12-06_10-22-15-215.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    height: 100%;
    width: 100%;
    
  }
  @media only screen and (max-width:768px){
  
    body{
    position: static;
    background-image: url(/img/20221206_104807.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    height: 100%;
    width: 100%;
    
  }
  
  
  }
</style>
<div class="container_center">
    <div class="row justify-content-center">
        <div class="">
            <div class="card_login">
                <div class="index_title"><img class="ollcf_logo_css" src = "{{ asset('/img/Ollfc_Logo.png') }}" alt="Italian Trulli"/><b>Admin E-Clearance</b></div>

                <div class="card-body">
                    {!! Form::open(['action' => 'App\Http\Controllers\Admin\AdminController@admin_check', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                     @endif 
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }} 
                        </div>
                    @endif
                    @csrf

                    {{-- <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('User ID or Email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> --}}


                    <div class="row mb-3">
                        <label for="school_id" class="col-md-4 col-form-label text-md-end login_label">
                            User_ID
                        </label>
                     
                        <div class="col-md-6">
                            <input id="school_id" type="text"
                                   class="form-control{{ $errors->has('school_id') ? ' is-invalid' : '' }}"
                                   name="school_id" value="{{ old('school_id') }}" required>
                     
                            @if ($errors->has('school_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('school_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end login_label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember_token" id="remembe_token" {{ old('remember_token') ? 'checked' : '' }}>
 
                                    <label class="form-check-label remember_me_label"  for="remember_token">Remember Me</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            
                                <button type="submit" class="login_style_btn">Login</button>
                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div> 
        </div>
    </div>
</div>  
@endsection
