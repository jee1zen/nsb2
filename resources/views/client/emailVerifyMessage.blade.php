@extends('layouts.app')

@section('content')
    <div class="row justify-content-center kyc-form-client">
        <div class="col-md-12">
            <div class="card mx-4">
                <div class="card-body p-4">
                    <div class="text-center">
                        <img src="{{ asset('storage/images/fmc.jpg') }}" class="rounded-logo" alt="...">
                    </div>
                    <h1> Welcome NSB FMC Online Portal </h1>

                    @if (session('message'))
                        <div class="alert alert-info" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <p>
                        You have successfully signed up to NSB Fund Management Online Portal.
                        In order to proceed for Account Registration process <b>Please check you email & verify your email
                            address</b>
                    </p>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
        $(document).ready(function() {




        });
    </script>
@endsection
