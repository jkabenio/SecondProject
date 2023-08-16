@extends('layouts.student-app')

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
                <div class="index_title"><img class="ollcf_logo_css" src = "{{ asset('/img/Ollfc_Logo.png') }}" alt="Italian Trulli"/><b>{{ __('Student E-Clearance') }}</b></div>

                <div class="card-body">
                    {!! Form::open(['action' => 'App\Http\Controllers\Student\StudentController@check', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                        @if (Session::get('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                        @endif
                    @csrf
                    <div class="row mb-3">
                        <label for="school_id" class="col-md-4 col-form-label text-md-end login_label">
                            {{ __('User_ID') }}
                        </label>
                     
                        <div class="col-md-6">
                            <input id="school_id" type="text"
                                   class="form-control{{ $errors->has('school_id') ? ' is-invalid' : '' }}"
                                   name="school_id" value="{{ old('school_id') }}" required>
                     
                            @if ($errors->has('username'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end login_label">{{ __('Password') }}</label>

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
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember_token" id="remember_token" {{ old('remember_token') ? 'checked' : '' }}>

                                    <label class="form-check-label remember_me_label" for="remember_token">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div> 
                        </div>

                        <div class="row mb-0">
                            <button type="submit" class="login_style_btn">Login</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
