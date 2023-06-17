@extends('layouts.client')
@section('content')
@php
$activeReverseRepos = $client->reverseRepos()->where('status',3)->get()
@endphp

<div class="col-md-10 content">
  <div class="panel panel-default">
	<div class="panel-heading">
		<h2>Settle Reverse Repo</h2>
	</div>
	<div class="panel-body">
     
       @if($activeReverseRepos->first())
       <form  method="POST" action="" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <select name="reverseRepo" id="reverseRepo" class="form-control">
                      
                        @foreach ($activeReverseRepos as $reverseRepo)
                        <option value="{{$reverseRepo->id}}">{{$reverseRepo->investment->ref_no}}-{{$reverseRepo->investment->investmentType->name}} - @money($reverseRepo->amount) - Matured -  {{$reverseRepo->maturity_date}}</option>
                        @endforeach
                      
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select name="instruction" id="instruction" class="form-control">
                        @php
                            $instructions = Config::get('constants.SETTLE_REPO_TYPES')
                         
                        @endphp
                    
                        @foreach ($instructions as $key => $instruction)
                        <option value="{{$key}}">{{$instruction}}</option>
                        @endforeach
                      
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" id="amount_DIV">
                    <label class="required" for="amount"> Amount</label>
                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="name" value="{{ old('amount', '') }}">
                </div>         
            </div>
        </div>
        
        
        
        <button type="button" class="btn btn-primary" id="btn_submit">
            Request
        </button>
       </form>
       @else
       <p>You Have No Active ReverseRepos To Settle</p>
       @endif
	 </div>
   </div>
</div>
@include('client.otpModel')
@endsection
@section('scripts')
	@parent
		<script>
              $(document).ready(function() {
               
                $('#amount_DIV').hide();

                $('#instruction').change(function(){
                   let investment =$(this).val();

                   if(investment==5 || investment==6){

                    $('#amount_DIV').show();
                   }else{

                    $('#amount_DIV').hide();
                   }


                });




               const mobile = "{{$client->mobile}}"
              
              $('#btn_submit').click(function(){
                        // alert('clicked submit button');
                        var button = $(this);
                        OTP(button);

                    });
                    function OTP(button){
                        if($('#done').val()==0){
                                                                                                                                
                                            var data = {"mobile": mobile,"_token": "{{ csrf_token() }}"}; //data to send to server
                                            var dataType = "json"//expected datatype from server
                                        
                                                $.post({
                                                    url: "{{route('otpt')}}",   //url of the server which stores time data
                                                    data: data,

                                                success: function(data){
                                                    if(data.success){
                                                        $('#mobileNumberLabel').html('94'+mobile);
                                                        $('#verify_mobile').val(mobile);   
                                                        $('#mobileOTPModal').modal('show');
                                                 
                                                        $('#mobileOTP').val("");
                                                    }else{
                                                        alertify.error('OTP generating Error, please check the Mobile number You entered,Check whether it is in correct format');
                                                    }
                                                }
                                            });    

                                      
                                            
                                            
                                    }else{
                                           button.closest('form').submit();
                                            
                                        }
                                        
                                   
                            }

                            $('#btnOtpSubmit').click(function(){

                                let verify_mobile = $('#verify_mobile').val();
                                let otpVerify = $('#mobileOTP').val();

                                var data = {"mobile": verify_mobile, "otp":otpVerify, "_token": "{{ csrf_token() }}"}; //data to send to server
                                                var dataType = "json"//expected datatype from server
                                            
                                                $.post({
                                                    url: "{{route('otp.check')}}",   //url of the server which stores time data
                                                    data: data,

                                                success: function(data){
                                                    console.log('data');
                                                        if(data.success){
                                                            // $('#otp_mobile').val(1);
                                                      
                                                               $('#done').val(1);

                                                         

                                                            alertify.success("OTP accepted!");
                                                            $('#mobileOTPModal').modal('hide');
                                                            OTP();

                                                        }else{
                                                            alertify.error(data.message);
                                                        }
                                                }
                                            });    

                                       });               

                                 });

		</script>
@endsection
  		