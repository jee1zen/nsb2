@extends('layouts.app')

@section('content')

    <div class="login-screen">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-6">
                    <div class="card-body p-4">
                        {{-- <h1>{{ trans('panel.site_title') }}</h1> --}}
                        <div class="text-center">
                            <img src="{{ asset('storage/images/fmc.jpg') }}" class="rounded-logo" alt="...">
                        </div>


                        @if (session('message'))
                            <div class="alert alert-info" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        <h2>You have Submitted The KYC as Joint Holder Successfully, Will redirect Soon!</h2>
                        <h2 id="countDown"></h2>

                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        var count = 5;
        setInterval(function() {
            count--;
            document.getElementById('countDown').innerHTML = "Redirecting in " + count;
            if (count == 0) {
                window.location = "{{ route('login') }}";
            }
        }, 1000);
    </script>


@endsection
