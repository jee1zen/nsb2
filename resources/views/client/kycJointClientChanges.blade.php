@extends('layouts.app')

@section('content')
    <div class="row justify-content-center kyc-form-client">
        <div class="col-md-12">
            <div class="card mx-4">
                <div class="card-body p-4">
                    <div class="text-center">
                        <img src="{{ asset('storage/images/fmc.jpg') }}" class="rounded-logo" alt="...">
                    </div>
                    <h1> Welcome {{ $jointHolder->name }} to NSB KYC FORMS</h1>

                    @if (session('message'))
                        <div class="alert alert-info" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <p>
                        You have successfully registered to NSB Fund Management System.
                        In order to proceed for verification process you need to fill the NSB KYC Form for you as you are a
                        joint holder of an editing of a existing account.
                    </p>

                    @if (!$jointHolder->hasKyc())
                        <div name="nsbTerms" class="overflow-auto">



                            <h3>GENERAL TERMS AND CONDITIONS</h3>
                            <h4>NSB FUND MANAGEMENT CO.LTD ONLINE PORTAL</h4>
                            <a class="btn btn-primary btn-lg" href="{{ asset('storage/images/termsconditions.pdf') }}"
                                target="_blank" style="margin-bottom:20px;">Terms and Conditions</a>

                        </div>
                        <input class="form-check-input" type="checkbox" value="" id="acceptCheck"
                            style="display: inline-block !important">
                        <label class="form-check-label" for="acceptCheck" style="display: inline-block!important">
                            I accept Terms and Conditions
                        </label>
                    @endif





                    @if (!$jointHolder->hasKyc())
                        <div id="kycDIV" style="margin-bottom:10px;">
                            <a class="btn btn-primary btn-lg" id="btnKyc"
                                href="{{ route('client.kyc.jointChange', [$jointHolder->id, $investment_id]) }}"> Fill
                                {{ $jointHolder->name }} 's KYC FORM</a> <br>
                        </div>
                    @else
                        <p>You have Filled The KYC form for {{ $jointHolder->name }}</p>
                        <form id="logoutform" action="{{ route('logout') }}" method="POST">
                            <button class="btn btn-primary btn-lg"> &nbsp; &nbsp; Leave This Page &nbsp; &nbsp; </button>
                            {{ csrf_field() }}
                            <p>Your Password will be sent to your email once NSB board approve your investment</p>
                        </form>
                    @endif

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
            $('#kycDIV').hide();
            $('#acceptCheck').click(function() {
                if ($(this).is(':checked')) {
                    $('#kycDIV').show();
                } else {

                    $('#kycDIV').hide();
                }
            });


        });
    </script>
@endsection
