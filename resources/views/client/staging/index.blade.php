@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mx-4">
            <div class="card-body p-4">
                <div class="text-center">
                    <img src="{{asset('storage/images/fmc.jpg')}}" class="rounded-logo" alt="...">
                  </div>
                <h1> Thank You  {{$client_name}} For Registering With NSB FMC</h1>

                {{-- @if(session('message'))
                    <div class="alert alert-info" role="alert">
                        {{ session('message') }}
                    </div>
                @endif --}}

                <p>
                    You have successfully registered to NSB Fund Management Online Portal. NSB FMC team will verify your information and contact you for further proceedings
                </p>
                <form id="logoutform" name="logoutform" action="{{ route('logout') }}" method="POST">
                    <button class="btn btn-primary">Leave This Page</button>
                    {{ csrf_field() }}
    {{-- <p>Your Password has been sent to your email, once your investment is fully approved by NSB FMC team</p> --}}
    </form>
                   

              
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  var wait=setTimeout("document.logoutform.submit();",5000);
</script>
@endsection