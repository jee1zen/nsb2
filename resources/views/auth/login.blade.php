@extends('layouts.app')
@section('content')
<div class="login-screen">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mx-6">
                <div class="card-body p-4">
                    {{-- <h1>{{ trans('panel.site_title') }}</h1> --}}
                    <div class="text-center">
                        <img src="{{asset('storage/images/fmc.jpg')}}" class="rounded-logo" alt="...">
                      </div>
    
                    <h3 class="text-muted">
                        {{-- {{ trans('global.login') }} --}}
                    </h3>
    
                    @if(session('message'))
                        <div class="alert alert-info" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
    
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
    
                            <input id="email" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
    
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
    
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
    
                            <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
    
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
    
                        <div class="input-group mb-4">
                            <div class="form-check-box checkbox">
                                <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;" />
                                <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                    {{ trans('global.remember_me') }}
                                </label>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-md-6 col-sm-12">
                                <button type="submit" class="btn btn-primary px-4" style ="background-color:orange">
                                    {{ trans('global.login') }}
                                </button>
                            </div>
                            <div class="col-3"></div> 

                        </div>
                        <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 col-sm-12 text-center">
                                <a class="btn btn-secondary btn-signup px-0" href="{{ route('register') }}">
                                        Sign Up
                                </a><br>
                                @if(Route::has('password.request'))
                                <a class="btn btn-secondary btn-forgot px-0" href="{{ route('password.request') }}">
                                    {{ trans('global.forgot_password') }}
                                </a><br>
                            @endif
                            @php
                            $userGuide = App\UserManual::find(1);
                        @endphp
                            <a class="btn btn-secondary btn-signup px-0" href="{{asset('/storage/uploads/'.$userGuide->doc)}}" target="_blank" >
                                User Guide
                        </a><br>
                        </div>
                        <div class="col-md-3"></div>
                        </div>
                    </form>
                    {{-- important notice --}}
                    {{-- <div class="border border-danger rounded" style="margin-top: 10px; ">
                        <h5 style="color: red; margin-top: 10px !important; text-align: center;" >Important Notice!</h5>
                        <p style="color: red" class="text-center">
                          NSB FMC online portal service will be  unavailable from  2022.12.17 (Saturday) 02.00:00  to  2022.12.18 (Sunday) 23:59:00 as the IT team will be performing scheduled maintenance during this time.
                            We apologize for any inconvenience!    
                      
                        </p>

                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection