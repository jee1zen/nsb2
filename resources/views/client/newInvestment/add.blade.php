@extends('layouts.client')
@section('content')
<div class="col-md-10 content">
  <div class="panel panel-default">
	<div class="panel-heading">
		<h2>Add Investment</h2>
	</div>
	<div class="panel-body">
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif
        <div class="row">
      
            {{-- {{dd($client->hasInvestmentsWithType($investmentType->id))}} --}} 
            <div class="col-md-12">
                <form method="POST" id="addInvestmentForm" action="{{ route("client.investment.post") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Investment Type</label>
                                    <select required name="investment_type" id="investment_type" class="form-control">
                                        <option value="" readonly>Select option</option>
                                        @php
                                            $investmenet_types = App\InvestmentType::get();
                                        @endphp
                                        @foreach ( $investmenet_types as $investment)
                                    
                                        
                                        <option value="{{$investment->id}}">{{$investment->name}}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
        
                            </div>
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label for="">Value Date</label>
                                    <input type="date" id="value_date" name="value_date"   placeholder="YYYY-MM-DD"  class="form-control" required>
                                 </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Maturity Date</label>
                                    <input type="date"  id="maturity_date"   placeholder="YYYY-MM-DD"  name="maturity_date" class="form-control" required>
                                 </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Investment Amount</label>
                                    <input type="text"  data-type="currency" placeholder="10,000 (minimum amount)" name="amount" id="amount" class="form-control" required>
                                 </div>
        
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Maturity Instruction</label>
                                    <select name="instruction" id="instuction" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="Reinvest principal with interest">Reinvest principal with interest</option>
                                        <option value="Reinvest principal without interest">Reinvest principal without interest</option>
                                        <option value="Reinvest the same Face Value & Pay the upfront interest">Reinvest the same Face Value & Pay the upfront interest</option>
                                        <option value="Do not reinvest">Do not reinvest</option>
                                    </select>
                                 </div>
                            </div>
                            <div class="col-md-3">
                            <div class="form-group" id="divBankAccount">
                                <label for="">Bank Account</label>
                                <select name="bank_id" id="bank_id" class="form-control">
                                   @if ($account->hasBankParticulars())
                                    @foreach ($bankAccounts as $bankAccount)
                                    <option value="{{$bankAccount->id}}">{{$bankAccount->bank_name}} | {{$bankAccount->account_no}} </option>
                                    @endforeach
                                   @endif 
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                         <div class="form-group" style="margin-top: 23px!important">
                           <button class="btn btn-primary btn-lg">Submit</button>     
                         </div>
                        </div>
                </form>
            </div>   
        
        </div>
      
	 </div>
   </div>
</div>

@endsection
@section('scripts')
	@parent
		<script>
                $(document).ready(function() {
                   
                    // $('#addInvestmentForm').submit(function(event) {
                    //     event.preventDefault();
                    //     if(parseFloat($('#amount').val().replace(",", "")) < 10000){
                    //         // alertify.error(`Investment Amount Cannot Be Less Than 10,000!`);
                    //         alertify.alert('Invaild Amount','Investment Amount Cannot Be Less Than 10,000!').set('autoReset', false); 


                    //          return;
                    //         }else{

                    //             $(this).unbind('submit').submit();
                    //         }
                    //     });




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
                    $("#value_date").flatpickr({
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
  		