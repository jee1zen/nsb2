@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mx-4">
            <div class="card-body p-4">
                <h1> Thank You For Filling KYC Forms, We'll Contact You In The Future Process of Your Investment</h1>

         <h2 id="countDown"></h2>      
</div>

@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
   var count = 5;
setInterval(function(){
    count--;
    document.getElementById('countDown').innerHTML = "Redirecting in "+count;
    if (count == 0) {
        window.location = "{{route('login')}}"; 
    }
},1000);
</script>


@endsection

