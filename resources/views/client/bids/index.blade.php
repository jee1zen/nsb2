@extends('layouts.client')
@section('content')
    <div class="col-md-9 content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Bid For Auction</h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-5">

                        <form id="msform" method="POST" action="{{ route('client.bid.post') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <select name="investment" id="investment" class="form-control">
                                    @php
                                        $investmenet_types = App\InvestmentType::limit(2)->get();
                                    @endphp
                                    @foreach ($investmenet_types as $investment)
                                        <option value="{{ $investment->id }}">{{ $investment->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Auction Date</label>
                                <input type="date" id="auction_date" name="auction_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Value Date</label>
                                <input type="date" id="value_date" name="value_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Maturity Date</label>
                                <input type="date" id="maturity_date" name="maturity_date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="">Bid Amount</label>
                                <input type="number" name="bid" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="">Bid rate %</label>
                                <input type="number" max="100" name="rate" class="form-control">
                            </div>
                            <button type="button" class="btn btn-primary" id="btn_submit">Add</button>
                    </div>





                    </form>
                    <div class="col-md-5">
                        <embed src="{{ asset('storage/uploads/' . $bidDocs->doc1) }}" type="application/pdf" height="200"
                            width="500">
                        <embed src="{{ asset('storage/uploads/' . $bidDocs->doc2) }}" type="application/pdf" height="200"
                            width="500">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        @if (
                            $bidSet &&
                                !$bidSet->bids()->get()->isEmpty())
                            <table class="table table-bordered table-striped table-hover datatable datatable-User">
                                <thead>
                                    <tr>

                                        <th>
                                            NO
                                        </th>
                                        <th>
                                            Type
                                        </th>
                                        <th>
                                            Auction Date
                                        </th>
                                        <th>
                                            Value Date
                                        </th>
                                        <th>
                                            Maturity Date
                                        </th>
                                        <th>
                                            Amount
                                        </th>
                                        <th>
                                            Bid Rate
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @if ($bidSet)
                                        @forelse ($bidSet->bids()->get() as $key=>$bid)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $bid->investmentType->name }}</td>
                                                <td>{{ $bid->auction_date }}</td>
                                                <td>{{ $bid->value_date }}</td>
                                                <td>{{ $bid->maturity_date }}</td>
                                                <td>@money($bid->amount)</td>
                                                <td>{{ $bid->rate }}%</td>
                                                <td>
                                                    <form action="{{ route('client.bid.Delete', $bid->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-small">X</button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @empty
                                            No records found
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        @endif

                        @if ($bidSet)
                            <form id="bidSetForm" method="POST" action="{{ route('client.bid.set.post') }}">


                                @csrf
                                <input type="hidden" value="{{ $bidSet->id }}" name="bidset_id">
                                <div class="row" style="margin-left: 3px; margin-bottom: 5px;">
                                    <input class="form-check-input" type="checkbox" value="" id="acceptCheck"
                                        style="display: inline-block !important">
                                    <strong>Accept <a href="{{ asset('storage/images/bid_terms.pdf') }}" target="_blank"
                                            style="margin-bottom:20px;">Terms and Conditions</a></strong>
                                </div>
                                <button type="button" class="btn btn-primary btn-lg" id="btn_submit_all">Submit</button>
                            </form>
                        @endif



                    </div>

                </div>


            </div>

        </div>
    </div>

    @include('client.otpModel')


    </div>

@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            const mobile = "{{ $client->mobile }}"
            $('#btn_submit_all').prop("disabled", true);

            $("#acceptCheck").on('change', function() {
                if ($("#acceptCheck").is(':checked')) {
                    $('#btn_submit_all').prop("disabled", false);
                } else {
                    $('#btn_submit_all').prop("disabled", true);
                }

            });





            $('#btn_submit').click(function() {


                $('#msform').submit();


            });

            $('#btn_submit_all').click(function() {
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
                    $('#bidSetForm').submit();

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


            $("#auction_date").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                "disable": [
                    function(date) {
                        return (date.getDay() === 0 || date.getDay() === 6); // disable weekends
                    }
                ],
                "locale": {
                    "firstDayOfWeek": 1 // set start day of week to Monday
                }
            });


            $("#maturity_date").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                "disable": [
                    function(date) {
                        return (date.getDay() === 0 || date.getDay() === 6); // disable weekends
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
                        return (date.getDay() === 0 || date.getDay() === 6); // disable weekends
                    }
                ],
                "locale": {
                    "firstDayOfWeek": 1 // set start day of week to Monday
                }
            });





        });
    </script>
@endsection
