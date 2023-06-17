@extends('layouts.client')
@section('content')
    <div class="col-md-9 content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Add Investment </h2>
            </div>
            <div class="panel-body">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <form method="POST" id="newInvestmentForm" action="{{ route('client.investment.form.post', $investment->id) }}"
                    enctype="multipart/form-data">
                    @method('POST')
                    @csrf

                    <table class="table table-stripped table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    Investment Type
                                </td>
                                <td>
                                    {{ $investment->InvestmentType->name }}
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Investing Amount
                                </td>
                                <td>
                                    @money($investment->amount)
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Value Date
                                </td>
                                <td>
                                    {{ $investment->value_date }}
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Maturity Date
                                </td>
                                <td>
                                    {{ $investment->maturity_date }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Maturity Instruction
                                </td>
                                <td>
                                    {{ $investment->instruction }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Bank Particular
                                </td>
                                <td>
                                    {{ $investment->bank->bank_name }} | {{ $investment->bank->account_no }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    @if (!$client->hasKycWithInvestmentId($investment->id) && $client->client_type != 3)
                        <p>You are about to request a new Investment type, before sending request you must submit KYC
                            form(s)</p>
                        <div style="margin-bottom:10px;">
                            <a class="btn btn-primary" href="{{ route('client.kyc.client', $investment->id) }}"> Fill
                                {{ $client->name }} 's KYC FORM</a> <br>
                        </div>
                    @else
                        @if ($client->client_type != 3)
                            <p>You have Filled The KYC form for {{ $client->name }}</p>
                        @endif
                    @endif


                    <div style="margin-bottom:10px;">
                        @if ($client->client_type == 3 && !$client->company->hasKycWithInvestmentId($investment->id))
                            <a class="btn btn-primary"
                                href="{{ route('client.kyc.company', [$client->id, $investment->id]) }}"> Fill -
                                {{ $client->company->name }} 's KYC FORM</a>
                        @else
                            @if ($client->client_type == 3)
                                <p>You have Filled The KYC form for {{ $client->company->name }}</p>
                            @endif
                        @endif
                    </div>

                    @if ($client->hasKycWithInvestmentId($investment->id))
                        <button class="btn btn-default" type="button" id="btn_submit">
                            Submit Request To Add Investment
                        </button>
                    @endif
                    {{-- @if ($client->investmentsWithType($investmentType->id)->kyc == 1)
          
            @endif --}}

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
            const mobile = "{{ $client->mobile }}"

            $('#btn_submit').click(function() {
                // alert('clicked submit button');
                var button = $(this);
                OTP(button);

            });

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
                    $('#newInvestmentForm').submit();

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
                            OTP();



                        } else {
                            alertify.error(data.message);
                        }
                    }
                });

            });

        });
    </script>
@endsection
