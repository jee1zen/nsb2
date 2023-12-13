@extends('layouts.app')
@section('content')
    <div class="login-screen">
        <div class="loader" id="loader" style="width: 3rem; height: 3rem;" role="status">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-6">
                    <div class="card-body p-4">
                        {{-- <h1>{{ trans('panel.site_title') }}</h1> --}}
                        <div class="text-center">
                            <img src="{{ asset('storage/images/fmc.jpg') }}" class="rounded-logo" alt="...">
                        </div>

                        <h3 class="text-muted">
                            {{-- {{ trans('global.login') }} --}}
                        </h3>

                        @if (session('message'))
                            <div class="alert alert-info" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form id="signUpForm" method="POST" autocomplete="off" action="{{ route('register') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="off"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required
                                    placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input id="password" name="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required
                                    placeholder="{{ trans('global.login_password') }}">

                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>

                                <input id="password-confirm" name="password_confirmation" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required
                                    placeholder=" Confirm Password">

                                @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password_confirmation') }}
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-md-6 col-sm-12">
                                    <button type="submit" id="btnSignUp" class="btn btn-primary px-4"
                                        style="background-color:orange">
                                        SignUp
                                    </button>
                                </div>
                                <div class="col-3"></div>

                            </div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6 col-sm-12 text-center">
                                    <a class="btn btn-secondary btn-signup px-0" href="{{ route('login') }}">
                                        Go To Login
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
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#loader').hide();
            $('#signUpForm').submit(function(e) {
                e.preventDefault();
                $('#loader').show();
                $.ajax({
                    url: '{{ route('register') }}',
                    method: 'post',
                    data: $('#signUpForm').serialize(),
                    success: function() {
                        $('#loader').hide();
                        window.location.href = "{{ route('verifyEmail.message') }}";
                    },
                    error: function(xhr) {
                        $('#loader').hide();
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            var errorHTML = '';

                            for (var field in errors) {
                                var errorMessages = errors[field];
                                var fieldName = $('#' + field).attr('name');
                                errorHTML += "<ul>";
                                for (var i = 0; i < errorMessages.length; i++) {
                                    errorHTML += '<li>' + fieldName + ': ' + errorMessages[i] +
                                        '</li>';
                                }
                                errorHTML += "</ul>";

                            }
                            Swal.fire({
                                // iconHtml: '<img src="{{ asset('storage/images/fmc.jpg') }}" class="rounded-logo" >',
                                html: errorHTML,
                                icon: "error",
                                title: "Error",
                            });
                            // $('#error-container').html(errorHTML);
                        } else {
                            Swal.fire({
                                html: "Error, Couldn't SignUp , Try Again",
                                icon: "error",
                                title: "Error",
                            });
                        }
                    }
                });
            });

        });
    </script>
@endsection
