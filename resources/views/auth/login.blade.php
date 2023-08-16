@extends('layouts.app')

@section('content')
<div class="container_center">
    <div class="row justify-content-center">
        <div class="">
            <div class="card_login">
                <div class="card-header"><b>{{ __('E-Clearance') }}</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('User ID or Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="login" class="col-sm-4 col-form-label text-md-right">
                                {{ __('school_id or Email') }}
                            </label>
                         
                            <div class="col-md-6">
                                <input id="login" type="text"
                                       class="form-control{{ $errors->has('school_id') || $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="login" value="{{ old('school_id') ?: old('email') }}" required autofocus>
                         
                                @if ($errors->has('school_id') || $errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('school_id') ?: $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}
                        

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

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
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="login_style">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
