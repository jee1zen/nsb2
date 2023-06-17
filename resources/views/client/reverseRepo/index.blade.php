@extends('layouts.client')
@section('content')
<div class="col-md-10 content">
  <div class="panel panel-default">
	<div class="panel-heading">
		<h2>Obtain A Reverse Repo</h2>
	</div>
	<div class="panel-body">
       <form  id="ReverseRepoForm" method="POST" action="" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="required" for="investment">Select Investment</label>

                    <select name="investment" id="investment" class="form-control">
                        @foreach ( $client->investments()->where('method','!=','Maturity')->get() as $investment)
                        @if($investment->invested_amount>0)
                        <option value="{{$investment->id}}">{{$investment->investmentType->name}} - @money($investment->invested_amount) - Maturity Date -  {{$investment->maturity_date}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="required" for="amount">Expected Amount</label>
                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text"  data-type="currency" name="amount" id="name" value="{{ old('amount', '') }}" required>
                </div> 
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="required" for="amount">Expected Date</label>
                    <input class="form-control {{ $errors->has('maturity_date') ? 'is-invalid' : '' }}" type="date" name="maturity_date" id="maturity_date" value="{{ old('maturity_date', '') }}" required>
                </div>
            </div>
        </div>
        
       
       
        <button type="button" class="btn btn-primary" id="btn_submit">
            Request
        </button>
       </form>
	 </div>
   </div>
</div>
@include('client.otpModel')
@endsection
@section('scripts')
	@parent
		<script>
              $(document).ready(function() {
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
                                          $('#ReverseRepoForm').submit();
                                            
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
                                       
                                       
                                       $("#maturity_date").flatpickr({
                                        enableTime: false,
                                        dateFormat: "Y-m-d",
                                        "disable": [
                                            function(date) {
                                            return (date.getDay() === 0 || date.getDay() === 6);  // disable weekends
                                            }
                                        ],
                                        "locale": {
                                            "firstDayOfWeek": 1 // set start day of week to Monday
                                        }
                                    });

                                      //money format
            $("input[data-type='currency']").on({
                keyup: function() {
                formatCurrency($(this));
                },
                blur: function() { 
                formatCurrency($(this), "blur");
                }
            });


            function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            }


            function formatCurrency(input, blur) {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.
            
            // get input value
            var input_val = input.val();
            
            // don't validate empty input
            if (input_val === "") { return; }
            
            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");
                
            // check for decimal
            if (input_val.indexOf(".") >= 0) {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);
                
                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                right_side += "00";
                }
                
                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val =  left_side + "." + right_side;

            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = input_val;
                
                // final formatting
                if (blur === "blur") {
                input_val += ".00";
                }
            }
            
            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
            }



                                 });

		</script>
@endsection
  		