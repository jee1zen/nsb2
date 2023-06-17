@extends('layouts.client')
@section('content')
    <div class="col-md-9 content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 id="formTitle">Maturity Instruction</h2>
            </div>
            <div class="panel-body">
                <div class="card-body">
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <select name="investment" id="investment" class="form-control" required>
                            <option value="0">Select A Option</option>

                            @foreach ($client->investments()->where('method', '!=', 'Maturity')->get() as $investment)
                                @if ($investment->invested_amount > 0)
                                    <option value="{{ $investment->id }}">{{ $investment->ref_no }} -
                                        {{ $investment->investmentType->name }} - @money($investment->invested_amount) - Maturity Date -
                                        {{ $investment->maturity_date }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="selectRequest" id="selectRequest" class="form-control">
                            <option value="0">Select A Instruction Before Proceed</option>
                            @foreach (Config::get('constants.REQUEST_TYPES') as $key => $request_type)
                                <option value="{{ $key }}">{{ $request_type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="typeFive">
                        <form method="POST" action="{{ route('client.fundRequest.post') }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <input type="hidden" class="investment_id" name="investment_id">
                            <input type="hidden" class="request_type_value" name="request_type_value">
                            <div class="form-group" id="divBankAccountFive">
                                <label for="">Bank Account</label>
                                <select name="bank_id" id="bank_id" class="form-control">
                                    @if ($client->hasBankParticulars())
                                        @foreach ($bankAccounts as $bankAccount)
                                            <option value="{{ $bankAccount->id }}">{{ $bankAccount->bank_name }} |
                                                {{ $bankAccount->account_no }} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kycModal">
                       Update KYC
                      </button> --}}
                                <button type="button" class="btn btn-primary btn_submit">
                                    Request
                                </button>
                            </div>
                        </form>
                    </div>

                    <div id="typeFour">
                        <form method="POST" action="{{ route('client.fundRequest.post') }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <input type="hidden" class="investment_id" name="investment_id">
                            <input type="hidden" class="request_type_value" name="request_type_value">

                            <div class="form-group">
                                <label class="required" for="amount">Expected Amount</label>
                                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text"
                                    data-type="currency" name="amount" id="name" value="{{ old('amount', '') }}"
                                    required>
                            </div>
                            <div class="form-group" id="divBankAccount">
                                <label for="">Bank Account</label>
                                <select name="bank_id" id="bank_id" class="form-control">
                                    @if ($client->hasBankParticulars())
                                        @foreach ($bankAccounts as $bankAccount)
                                            <option value="{{ $bankAccount->id }}">{{ $bankAccount->bank_name }} |
                                                {{ $bankAccount->account_no }} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kycModal">
                        Update KYC
                       </button> --}}
                                <button type="button" class="btn btn-primary btn_submit">
                                    Request
                                </button>
                            </div>
                        </form>
                    </div>
                    <div id="typeSix">
                        <form method="POST" action="{{ route('client.fundRequest.post') }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <input type="hidden" class="investment_id" name="investment_id">
                            <input type="hidden" class="request_type_value" name="request_type_value">

                            <div class="form-group">
                                <label class="required" for="amount">Expected Amount</label>
                                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text"
                                    data-type="currency" name="amount" id="name" value="{{ old('amount', '') }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="required" for="expected_date">Expected Date</label>
                                <input type="date" id="expected_date" name="expected_date" placeholder="YYYY-MM-DD"
                                    class="form-control">
                            </div>
                            <div class="form-group" id="divBankAccount">
                                <label for="">Bank Account</label>
                                <select name="bank_id" id="bank_id" class="form-control">
                                    @if ($client->hasBankParticulars())
                                        @foreach ($bankAccounts as $bankAccount)
                                            <option value="{{ $bankAccount->id }}">{{ $bankAccount->bank_name }} |
                                                {{ $bankAccount->account_no }} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kycModal">
                        Update KYC
                       </button> --}}
                                <button type="button" class="btn btn-primary btn_submit">
                                    Request
                                </button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>

            {{-- @include('client.kycClientModel')        --}}

            @include('client.otpModel')

        </div>

    @endsection
    @section('scripts')
        @parent
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> --}}

        <script>
            $(document).ready(function() {
                const mobile = "{{ $client->mobile }}";
                //   $('#mobileOTPModal').modal('show');
                $('#typeFive').hide();
                $('#typeFour').hide();
                $('#typeSix').hide();
                var targettedDIV = "";

                $('#selectRequest').on('change', function() {

                    $('#formTitle').html(' Request -' + $(this).find("option:selected").text());

                    var thisValue = $(this).val();
                    if (thisValue == 1 || thisValue == 2) {
                        $('#typeFive').show();
                        $('#typeFour').hide();
                        $('#typeSix').hide();
                        $('#divBankAccountFive').hide();
                        targettedDIV = "typeFive";

                    } else if (thisValue == 3) {
                        $('#typeFive').hide();
                        $('#typeFour').show();
                        $('#typeSix').hide();
                        $('#divBankAccount').show();
                        targettedDIV = "typeFour";

                    } else if (thisValue == 4) {
                        $('#typeFive').hide();
                        $('#typeFour').show();
                        $('#typeSix').hide();
                        $('#divBankAccount').hide();
                        targettedDIV = "typeFour";
                    } else if (thisValue == 5) {
                        $('#typeFive').show();
                        $('#typeFour').hide();
                        $('#typeSix').hide();
                        $('#divBankAccountFive').show();
                        targettedDIV = "typeFive";
                    } else if (thisValue == 6) {

                        $('#typeFive').hide();
                        $('#typeFour').hide();
                        $('#typeSix').show();
                        $('#divBankAccountFive').show();
                        $("#expected_date").flatpickr({
                            enableTime: false,
                            dateFormat: "Y-m-d",
                            "disable": [
                                function(date) {
                                    return (date.getDay() === 0 || date.getDay() ===
                                        6); // disable weekends
                                }
                            ],
                            "locale": {
                                "firstDayOfWeek": 1 // set start day of week to Monday
                            }
                        });

                        targettedDIV = "typeSix";

                    } else {
                        $('#typeFive').hide();
                        $('#typeFour').hide();
                        targettedDIV = "";
                    }
                    $('.investment_id').val($('#investment').val());
                    $('.request_type_value').val(thisValue);


                });

                $('#investment').on('change', function() {
                    var investmentValue = $(this).val();

                    $('.investment_id').val(investmentValue);

                });

                //Modal

                $('#kyc_foreign_DIV').hide();
                $('#other_visa_DIV').hide();
                $('other_special_purpose_DIV').hide();
                $('#kyc_other_source_DIV').hide();
                $('#kyc_other_authrity_DIV').hide();


                $('#kyc_citizenship').change(function() {


                    if ($(this).val() !== 'Sri Lankan') {

                        $('#kyc_foreign_DIV').show();

                    } else {
                        $('#kyc_foreign_DIV').hide();
                    }


                });

                $('#kyc_type_of_visa').change(function() {

                    if ($(this).val() === 'other') {
                        $('#other_visa_DIV').show()
                    } else {

                        $('#other_visa_DIV').hide()
                    }

                });

                $('#kyc_purpose_of_opening_account').change(function() {

                    if ($(this).val() === 'Other') {
                        $('#other_special_purpose_DIV').show()
                    } else {

                        $('#other_special_purpose_DIV').hide()
                    }

                });

                $('#kyc_source_of_funds').change(function() {

                    if ($(this).val() === 'Other') {

                        $('#kyc_other_source_DIV').show()

                    } else {

                        $('#kyc_other_source_DIV').hide()
                    }

                });

                $('#kyc_operation_authority').change(function() {

                    if ($(this).val() === 'Other') {

                        $('#kyc_other_authrity_DIV').show()

                    } else {

                        $('#kyc_other_authrity_DIV').hide()
                    }

                });


                $('.btn_submit').click(function() {
                    // alert('clicked submit button');
                    if ($("#investment").val() == 0) {
                        alertify.error(`You must select an investment before proceed!`);
                    } else {

                        var button = $(this);
                        OTP(button);

                    }

                });




                //generate OTP and show form

                function OTP(button) {
                    if ($('#done').val() == 0) {

                        var data = {
                            "mobile": mobile,
                            "_token": "{{ csrf_token() }}"
                        }; //data to send to server
                        var dataType = "json" //expected datatype from server

                        $.post({
                            url: "{{ route('otpt') }}", //url of the server which stores time data
                            data: data,

                            success: function(data) {
                                if (data.success) {
                                    $('#mobileNumberLabel').html(mobile);
                                    $('#verify_mobile').val(mobile);
                                    $('#mobileOTPModal').modal('show');

                                    $('#mobileOTP').val("");
                                } else {
                                    alertify.error(
                                        'OTP generating Error, please check the Mobile number You entered,Check whether it is in correct format'
                                    );
                                }
                            }
                        });




                    } else {
                        // button.closest('form').submit();

                    }


                }

                $('#btnOtpSubmit').click(function() {

                    let verify_mobile = $('#verify_mobile').val();
                    let otpVerify = $('#mobileOTP').val();

                    var data = {
                        "mobile": verify_mobile,
                        "otp": otpVerify,
                        "_token": "{{ csrf_token() }}"
                    }; //data to send to server
                    var dataType = "json" //expected datatype from server

                    $.post({
                        url: "{{ route('otp.check') }}", //url of the server which stores time data
                        data: data,

                        success: function(data) {
                            console.log('data');
                            if (data.success) {
                                // $('#otp_mobile').val(1);

                                $('#done').val(1);



                                alertify.success("OTP accepted!");
                                $('#mobileOTPModal').modal('hide');
                                // OTP();

                                if (targettedDIV !== "") {
                                    alertify.notify('Submitting Maturity Instructions', 'message',
                                        1,
                                        function() {
                                            $(`#${targettedDIV}`).find('form').submit();

                                        });



                                }


                            } else {
                                alertify.error(data.message);
                            }


                        }
                    });

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
                    if (input_val === "") {
                        return;
                    }

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
                        input_val = left_side + "." + right_side;

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
