@extends('layouts.app')

@section('content')


    <style type="text/css" media="screen">
        .steps-registration .card {
            padding: 20px;
        }

        .loader {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        /* Transparent Overlay */
        .loader:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));

            background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loader:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .loader:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 150ms infinite linear;
            -moz-animation: spinner 150ms infinite linear;
            -ms-animation: spinner 150ms infinite linear;
            -o-animation: spinner 150ms infinite linear;
            animation: spinner 150ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>


    <div class="steps-registration">
        <div class="loader" id="loader" style="width: 3rem; height: 3rem;" role="status">
            <p> Loading...</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card ">

                    <div class="row">
                        <div class="col-md-8">
                            <h2 id="heading">Register For An Account in NSB FM</h2>
                            <p>Fill all form field to go to next step</p>
                        </div>
                        <div class="col-md-4">
                            <div class="pull-right inner-logo">
                                <img src="{{ asset('storage/images/fmc.jpg') }}" width="100%">
                            </div>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif

                    <div id="msform">

                        @csrf
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li id="account"><strong> Account Type</strong></li>
                            {{-- <li id="account"><strong>Identification</strong></li> --}}
                            <li id="basic"><strong>Basic Info</strong></li>
                            <li id="employment"><strong>Employment Info</strong></li>
                            <li id="benefactor"><strong>Benefactor Info</strong></li>
                            <li id="bank"><strong>Bank Particulars</strong></li>
                            <li id="other" class="active"><strong>Other Info</strong></li>
                            <li id="KYC"><strong>KYC</strong></li>
                            <li id="confirm"><strong>Finish</strong></li>
                        </ul>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuemin="0" aria-valuemax="100"> </div>
                        </div> <br> <!-- fieldsets -->
                        {{-- <fieldset id="accountSection">
                            <form id="accTypeForm" method="POST" action="{{ route('registration.accountType') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @include('auth.register.accountType')


                                <input type="submit" id="btnJoint" name="next" class="next action-button"
                                    value="Next" />
                            </form>

                        </fieldset> --}}

                        {{-- <fieldset id="basicinfoSection">




                            <div class="form-card">



                                @include('auth.register.mainUserInfo')


                                @if ($account->type == 2)
                                    @include('auth.register.jointHolder')
                                @endif


                                @include('auth.register.signature')
                            </div>

                            <input type="button" id="btnBasicInfo" name="next" class="next action-button"
                                value="Next" />
                            <a name="previous" class="previous action-button-previous"
                                href="{{ route('registration.staging') }}">Back</a>
                        </fieldset> --}}
                        {{-- <fieldset id="empinfoSection">
                            <form id="basicInfoForm" method="POST" action="{{ route('registration.empInfo') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @include('auth.register.employement')
                                <input type="submit" id="btnEmpInfo" name="next" class="next action-button"
                                    value="Next" />
                                <a name="previous" class="previous action-button-previous"
                                    href="{{ route('registration.basicInfo') }}">Back</a>
                            </form>
                        </fieldset> --}}
                        {{-- <fieldset id="benifcatorSection"> 

                            {{-- <h1>Benefactor Information</h1>
                            @include('auth.register.benefactor')
                            <input type="button" id="btnBenificial" name="next" class="next action-button"
                                value="Next" /> <input type="button" name="previous"
                                class="previous action-button-previous" value="Previous" />
                        </fieldset>


                        <fieldset id="bankparticularSection">
                            @include('auth.register.bankparticulars')
                            <input type="button" id="btnBank" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset> --}}
                        <fieldset id="otherdetailsSection">
                            <form id="basicInfoForm" method="POST" action="{{ route('registration.otherInfo') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @include('auth.register.otherInfo')
                                <input type="submit" id="btnOther" name="next" class="next action-button"
                                    value="Next" />
                                <a name="previous" class="previous action-button-previous"
                                    href="{{ route('registration.bank') }}">Back</a>
                            </form>
                        </fieldset>
                        {{-- <fieldset id="kycSection">
                            @include('auth.register.KYC')
                            <input type="button" id="btnKYC" name="next" class="next action-button"
                                value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>
                        <fieldset id="statementSection">
                            @include('auth.register.statement')
                            <button class="next action-button" id="btnStatement">Submit</button>
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>

                        <fieldset id="finishSection">
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Registration Steps Ended:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Done</h2>
                                    </div>
                                </div> <br><br>
                                <h2 class="purple-text text-center"><strong>Saving Your Information.. !</strong></h2> <br>
                                <div class="row justify-content-center">
                                    <div class="col-3"> <img src="{{ asset('storage/images/done.gif') }}"
                                            class="fit-image"> </div>
                                </div> <br><br>
                                <div class="row justify-content-center">
                                    <div class="col-7 text-center">
                                        <h5 class="purple-text text-center">Please Wait... </h5>
                                    </div>
                                </div>
                            </div>
                        </fieldset> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>



    </div>
    {{-- <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="mobileOTPModal" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="form-group">
             <label for="">Enter the OTP sent to Your Mobile Number</label>
             <input type="text" id="mobileOTP" name="mobileOTP">
             <button class="btn btn-primary">Done</button>
         </div>
      </div>
    </div>
  </div> --}}

    <!-- Modal -->
    <div class="modal fade" id="mobileOTPModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Mobile OTP verification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {{-- <form id="formVerifyOTP" method="POST" action="{{ route('otp.check') }}" enctype="multipart/form-data"> --}}
                        <label for="">Enter the OTP sent to Your Mobile Number</label>
                        <label for="" id="mobileNumberLabel"></label>
                        <input type="text" id="mobileOTP" name="mobileOTP">
                        <input type="hidden" id="verify_mobile" name="verify_mobile" value="">
                        {{-- </form> --}}

                        <button class="btn btn-primary">Resend</button>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnOtpSubmit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal email -->
    <div class="modal fade" id="emailOTPModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Email OTP verification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {{-- <form id="formVerifyOTP" method="POST" action="{{ route('otp.check') }}" enctype="multipart/form-data"> --}}
                        <label for="">Enter the OTP sent to Your Email Address</label>
                        <label for="" id="emailLabel"></label>
                        <input type="text" id="emailOTP" name="emailOTP">
                        <input type="hidden" id="verify_email" name="verify_email" value="">
                        {{-- </form> --}}

                        <button class="btn btn-primary">Resend</button>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnOtpEmailSubmit" class="btn btn-primary">Submit</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
    <script src="{{ asset('js/saveMyForm.jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput-jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.min.js"></script>





    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script> --}}

    <script>
        function toggleZoomScreen() {
            document.body.style.zoom = "20%";
        }
    </script>
    <script>
        $(document).ready(function() {

            // $(".otp").intlTelInput({
            //     separateDialCode:true,

            // });

            var ACtype = {{ $account->type }};
            console.log(ACtype)

            var telInput = $(".OTP");
            telInput.each(function() {

                $(this).intlTelInput({
                    initialCountry: "lk",
                    // nationalMode: false,
                    separateDialCode: true,
                    // preferredCountries: ["ua", "pl", "us"],
                    // geoIpLookup: function(success, failure) {
                    //     $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    //     var countryCode = (resp && resp.country) ? resp.country : "us";
                    //     success(countryCode);
                    //     });
                    // },

                });
            });




            var $loading = $('#loader').hide();
            $(document)
                .ajaxStart(function() {
                    $loading.show();
                })
                .ajaxStop(function() {
                    $loading.hide();
                });

            $(function() {
                // $("#msform").saveMyForm();
            });

            $(function() {
                // $("#msform").saveMyForm({
                //     resetOnSubmit: false
                // });
            });


            $(".progress-bar")
                .css("width", "70%");

            // jQuery.validator.addMethod("uploadFile", function (val, element) {

            //     var size = element.files[0].size;
            //     console.log(size);

            //     if (size > 1048576)// checks the file more than 1 MB
            //     {
            //         console.log("returning false");
            //         return false;

            //     } else {
            //         alertify.error('Max File Upload Size is 10mb, please check the size');
            //         return true;
            //     }

            //     }, "File type error");




            //    $('#loader').bind('ajaxStart', function(){
            //     $(this).show();
            //     }).bind('ajaxStop', function(){
            //         $(this).hide();
            //     });

            $('#benefactor').hide();

            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });


            //image size validation..

            // $(document).on("change", ".imgLoad", function() { 
            //  var uploadInput=$(this);
            // if(this.files[0].size > 10000000)  
            //   var label =uploadInput.prev().text();
            //   alertify.error(`${label} file size cannot be larger than 10MB`);
            //   uploadInput.val('');
            // });




            $('#btnStatement').hide();
            // var ACtype = 'Indivitual';

            alertify.set('notifier', 'position', 'bottom-center');
            //image preview function  
            $(document).on("change", ".imgLoad", function() {
                let uploadInput = $(this);
                let imageComponent = $(this).next();
                const label = uploadInput.prev().text();
                const file = this.files[0];
                if (file.size > 10000000) {
                    alertify.error(`${label} file size cannot be larger than 10MB`);
                    uploadInput.val('');
                } else {
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function(event) {
                            imageComponent
                                .attr("src", event.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            $('#dob').mask('0000-00-00');
            $('#authorizedDiv').hide();
            $('#other_nationalityDIV').hide();
            // $('#jointHoldersDiv').hide();
            $('#passportDiv').hide();
            $('#joint_authority_DIV').hide();
            $(
                '#company_DIV').hide();
            $('#company_type_DIV').hide();
            $('#occupation_DIV').hide();
            $(
                '#signatures_DIV').hide();
            $('#jointEmpInfoDIV').hide();

            //company documents initial state..
            $('#business_registration_DIV').show();
            $('#certificate_of_incorperation_DIV').hide();
            $(
                '#trust_deed_DIV').hide();
            $('#board_resolution_DIV').hide();
            $('#society_constitution_DIV')
                .hide();
            $('#partner_kyc_DIV').hide();
            $('#properitor_kyc_DIV').show();
            $(
                '#declaration_of_beneficial_ownership_DIV').show();
            $('#certificate_of_registration_DIV')
                .hide();
            $('#power_attorney_DIV').hide();
            $('#articles_of_association_DIV').hide();
            $(
                '#partner_deed_DIV').hide();
            $('#articles_of_association_DIV').hide();
            $('#form01_DIV')
                .hide();
            $('#form20_DIV').hide();
            $('#form44_DIV').hide();
            $('#form45_DIV').hide();
            $(
                '#export_development_DIV').hide();
            $('#board_of_investment_DIV').hide();
            $(
                '#list_of_subsidiaries_DIV').hide();
            $('#directors_kyc_DIV').hide();
            $(
                '#office_barers_kyc_DIV').hide();
            $('#certificate_commence_DIV').hide();
            $(
                '#society_constitution_DIV').hide();

            //signature hides
            $('#signatureB_nationality_div').hide();
            $('#signature_passportB_div').hide();

            $('#signatureA_nationality_div').hide();
            $('#signature_passportA_div').hide();


            $('#kyc_foreign_DIV').hide();
            $('#other_visa_DIV').hide();
            $('#other_special_purpose_DIV')
                .hide();
            $('#kyc_other_source_DIV').hide();
            $('#kyc_other_authrity_DIV').hide();


            $('#kyc_other_employement_DIV').hide();
            $('#kyc_marital_status_DIV').hide();
            $(
                '#kyc_nature_of_business_specify_DIV').hide();



            $('#kyc_nature_of_business').change(function() {
                if ($(this).val() == 'Other') {
                    $('#kyc_nature_of_business_specify_DIV').show();
                } else {
                    $('#kyc_nature_of_business_specify_DIV').hide();
                }
            });


            $('#kyc_marital_status').change(function() {
                if ($(this).val() == 'Married') {

                    $('#kyc_marital_status_DIV').show();

                } else {
                    $('#kyc_marital_status_DIV').hide();
                }

            });


            $('#kyc_employment_status').change(function() {
                if ($(this).val() == 'Other') {

                    $('#kyc_other_employement_DIV').show();

                } else {
                    $('#kyc_other_employement_DIV').hide();
                }

            });



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

            // $(document).on("blur",".OTP",function(){
            //     let fullmobile = $(this).intlTelInput("getNumber");

            //     $(this).parents('div').prev().prev().val(fullmobile);

            // });


            $(document).on("focus", ".jointDob", function() {
                $(this).mask('0000-00-00');
            });
            var current_fs, next_fs, previous_fs; //fieldsets
            var opacity;
            var current = 1;
            var steps = $("fieldset").length;
            setProgressBar(current);
            var isValid = true;
            //date Validation
            function isValidDate(dateString, text) {
                var regEx = /^\d{4}-\d{2}-\d{2}$/;
                if (!dateString.match(regEx)) {
                    alertify.error(`${text} is in invalid format`);
                    isValid = false; // Invalid format
                    return;
                }
                var d = new Date(dateString);
                var dNum = d.getTime();
                if (!dNum && dNum !== 0) {
                    alertify.error(`Invalid Date for ${text}`);
                    return isValid = false;

                } // NaN value, Invalid date
                return d.toISOString().slice(0, 10) === dateString;
            }
            //email validation
            function isValidEmailAddress(emailAddress) {
                var pattern =
                    /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
                return pattern.test(emailAddress);
            };



            //generate OTP and show form

            function OTP() {

                $('input').filter('.OTP').each(function() {
                    // var mobile = $(this).val();
                    var mobile = $(this).intlTelInput("getNumber");
                    console.log("mobile", mobile);
                    if ($(this).parents('div').next('input').val() === '' && isValid) {
                        console.log("came out of validation");

                        var data = {
                            "mobile": mobile,
                            "_token": "{{ csrf_token() }}"
                        }; //data to send to server
                        var dataType = "json" //expected datatype from server


                        //   $('#loader').show();
                        $.post({
                            url: "{{ route('otp') }}", //url of the server which stores time data
                            data: data,
                            beforeSend: function() {

                            },

                            success: function(data) {
                                if (data.success) {
                                    $('#mobileNumberLabel').html(mobile);
                                    $('#mobileOTPModal').modal('show');
                                    $('#verify_mobile').val(mobile);
                                    $('#mobileOTP').val("");
                                    // $('#loader').hide();
                                    // emailOTP(); 

                                } else {
                                    alertify.error(
                                        'OTP generating Error, please check the Mobile number You entered,Check whether it is in correct format'
                                    );
                                }
                            },
                        });

                        isValid = false;


                    } else {
                        emailOTP();

                    }
                    // return isValid;   

                });

            }

            //generate OTP and show form

            function emailOTP() {

                $('input').filter('.emailOTP').each(function() {
                    var email = $(this).val();

                    if ($(this).next().val() === '' && isValid) {

                        var data = {
                            "email": email,
                            "_token": "{{ csrf_token() }}"
                        }; //data to send to server
                        var dataType = "json" //expected datatype from server
                        // $('#loader').show();
                        $.post({
                            url: "{{ route('otp.email') }}", //url of the server which stores time data
                            data: data,



                            success: function(data) {
                                if (data.success) {
                                    $('#emailLabel').html(email);
                                    $('#emailOTPModal').modal('show');
                                    $('#verify_email').val(email);
                                    $('#emailOTP').val("");
                                    // $('#loader').hide();
                                } else {
                                    alertify.error(
                                        'OTP generating Error, please check the Mobile number You entered,Check whether it is in correct format'
                                    );
                                }
                            }
                        });

                        isValid = false;


                    } else {
                        isValid = true;

                    }
                    return isValid;
                });

            }
            //check OTP
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
                            $('input').filter('.OTP').each(function() {
                                if ($(this).intlTelInput("getNumber") ===
                                    verify_mobile) {
                                    console.log("set value to next ", $(this)
                                        .parents(
                                            'div').next('input[type=hidden]'));
                                    $(this).parents('div').next(
                                            'input[type=hidden]')
                                        .val(1);
                                }

                            });

                            alertify.success("OTP accepted!");
                            $('#mobileOTPModal').modal('hide');
                            OTP();

                        } else {
                            alertify.error(
                                "The OTP You Entered Is Invalid, Please Try again");
                        }


                    }
                });

            });

            //check OTP email
            $('#btnOtpEmailSubmit').click(function() {

                let verify_email = $('#verify_email').val();
                let otpVerify = $('#emailOTP').val();

                var data = {
                    "email": verify_email,
                    "otp": otpVerify,
                    "_token": "{{ csrf_token() }}"
                }; //data to send to server
                var dataType = "json" //expected datatype from server

                $.post({
                    url: "{{ route('otp.email.check') }}", //url of the server which stores time data
                    data: data,

                    success: function(data) {
                        console.log('data');
                        if (data.success) {
                            // $('#otp_mobile').val(1);
                            $('input').filter('.emailOTP').each(function() {
                                if ($(this).val() === verify_email) {
                                    $(this).next().val(1);
                                }

                            });

                            alertify.success("OTP accepted!");
                            $('#emailOTPModal').modal('hide');
                            emailOTP();

                        } else {
                            alertify.error(
                                "The OTP You Entered Is Invalid, Please Try again");
                        }


                    }
                });

            });







            //setting corresponsdece address lines same as addresslines..
            $('#sameAsAddressCheck').click(function() {

                if ($(this).is(':checked')) {

                    $('#corresponding_address_line_1').val($('#address_line_1').val());
                    $('#corresponding_address_line_2').val($('#address_line_2').val());
                    $('#corresponding_address_line_3').val($('#address_line_3').val());

                    $('#billing_proof_div').hide();
                    $('#billing_proof').removeClass("fieldRequired");


                } else {

                    $('#corresponding_address_line_1').val("");
                    $('#corresponding_address_line_2').val("");
                    $('#corresponding_address_line_3').val("");
                    if (ACtype != 3) {
                        $('#billing_proof_div').show();
                        $('#billing_proof').addClass("fieldRequired");
                    } else {
                        $('#billing_proof_div').hide();
                        $('#billing_proof').removeClass("fieldRequired");
                    }






                }


            });

            //accept to continue
            $('#acceptCheck').click(function() {
                if ($(this).is(':checked')) {
                    $('#btnStatement').show();
                } else {

                    $('#btnStatement').hide();
                }
            });


            //making initiator signatureB 
            $('#makeSignatureB').click(function() {

                if ($(this).is(':checked')) {

                    $("#signatureB_DIV").hide();
                    $('#h3_B').html("Initiator is Signature B");

                    //signatura B validate...
                    $('#cp_name_b').removeClass('fieldRequired');
                    $('#cp_occupation_b').removeClass('fieldRequired');
                    $('#cp_address_line1_b').removeClass('fieldRequired');
                    $('#cp_address_line_2_b').removeClass('fieldRequired');
                    $('#cp_dob_b').removeClass('fieldRequired');
                    $('#cp_nic_b').removeClass('fieldRequired');
                    $('#cp_telephone_b').removeClass('fieldRequired');
                    $('#cp_email_b').removeClass('fieldRequired');
                    $('#cp_name_b').removeClass('fieldRequired');
                    $('#cp_mobile_b').removeClass('fieldRequired');
                    $('#cp_mobile_b').removeClass('OTP');
                    if ($('#cp_nationality_b').val() === 'other') {
                        $('#cp_passport_b').removeClass('fieldRequired');
                        $('#cp_nic_front_b').removeClass('fieldRequired');
                        $('#cp_nic_back_b').removeClass('fieldRequired');
                        $('#cp_nationality_other_b').removeClass('fieldRequired');
                    } else {
                        //is sri lankan...   
                        $('cp_passport_b').removeClass('fieldRequired');
                        $('cp_nic_front_b').removeClass('fieldRequired');
                        $('cp_nic_back_b').removeClass('fieldRequired');
                        $('#cp_nationality_other_b').removeClass('fieldRequired');
                    }
                    $('#cp_signature_b').removeClass('fieldRequired');


                } else {

                    $("#signatureB_DIV").show();
                    $('#h3_B').html("Signature B");
                    //signatura B validate...
                    $('#cp_name_b').addClass('fieldRequired');
                    $('#cp_occupation_b').addClass('fieldRequired');
                    $('#cp_address_line1_b').addClass('fieldRequired');
                    $('#cp_address_line_2_b').addClass('fieldRequired');
                    $('#cp_dob_b').addClass('fieldRequired');
                    $('#cp_nic_b').addClass('fieldRequired');
                    $('#cp_telephone_b').addClass('fieldRequired');
                    $('#cp_email_b').addClass('fieldRequired');
                    $('#cp_name_b').addClass('fieldRequired');
                    $('#cp_mobile_b').addClass('fieldRequired');
                    $('#cp_mobile_b').addClass('OTP');
                    if ($('#cp_nationality_b').val() === 'other') {
                        $('#cp_passport_b').addClass('fieldRequired');
                        $('#cp_nic_front_b').removeClass('fieldRequired');
                        $('#cp_nic_back_b').removeClass('fieldRequired');
                        $('#cp_nationality_other_b').addClass('fieldRequired');
                    } else {
                        //is sri lankan...   
                        $('cp_passport_b').removeClass('fieldRequired');
                        $('cp_nic_front_b').addClass('fieldRequired');
                        $('cp_nic_back_b').addClass('fieldRequired');
                        $('#cp_nationality_other_b').removeClass('fieldRequired');
                    }
                    $('#cp_signature_b').addClass('fieldRequired');

                }

            });



            //notification email set as main
            $('#email').on('blur', function() {
                $('#notification_email').val($(this).val());
            })

            //notification mobile set as main
            $('#mobile').on('blur', function() {
                $('#notification_mobile').val($(this).val());
            })






            // documents upload according to company type 

            $('#type_of_company').change(function() {


                let selectedValue = $(this).val();
                // alert(selectedValue);

                if (selectedValue === 'Proprietorship') {

                    $('#business_registration_DIV').show();
                    $('#certificate_of_incorperation_DIV').hide();
                    $('#trust_deed_DIV').hide();
                    $('#board_resolution_DIV').hide();
                    $('#society_constitution_DIV').hide();
                    $('#partner_kyc_DIV').hide();
                    $('#properitor_kyc_DIV').show();
                    $('#declaration_of_beneficial_ownership_DIV').show();
                    $('#certificate_of_registration_DIV').hide();
                    $('#power_attorney_DIV').hide();
                    $('#articles_of_association_DIV').hide();
                    $('#partner_deed_DIV').hide();
                    $('#articles_of_association_DIV').hide();
                    $('#form01_DIV').hide();
                    $('#form20_DIV').hide();
                    $('#form44_DIV').hide();
                    $('#form45_DIV').hide();
                    $('#export_development_DIV').hide();
                    $('#board_of_investment_DIV').hide();
                    $('#list_of_subsidiaries_DIV').hide();
                    $('#directors_kyc_DIV').hide();
                    $('#office_barers_kyc_DIV').hide();
                    $('#certificate_commence_DIV').hide();
                    $('#society_constitution_DIV').hide();


                } else if (selectedValue === 'Partnership') {

                    $('#business_registration_DIV').show();
                    $('#certificate_of_incorperation_DIV').hide();
                    $('#trust_deed_DIV').hide();
                    $('#board_resolution_DIV').hide();
                    $('#society_constitution_DIV').hide();
                    $('#partner_kyc_DIV').show();
                    $('#properitor_kyc_DIV').hide();
                    $('#declaration_of_beneficial_ownership_DIV').show();
                    $('#certificate_of_registration_DIV').hide();
                    $('#power_attorney_DIV').hide();
                    $('#articles_of_association_DIV').hide();
                    $('#partner_deed_DIV').hide();
                    $('#articles_of_association_DIV').hide();
                    $('#form01_DIV').hide();
                    $('#form20_DIV').hide();
                    $('#form44_DIV').hide();
                    $('#form45_DIV').hide();
                    $('#export_development_DIV').hide();
                    $('#board_of_investment_DIV').hide();
                    $('#list_of_subsidiaries_DIV').hide();
                    $('#directors_kyc_DIV').hide();
                    $('#office_barers_kyc_DIV').hide();
                    $('#certificate_commence_DIV').hide();
                    $('#society_constitution_DIV').hide();

                } else if (selectedValue === 'Public Company') {

                    $('#business_registration_DIV').show();
                    $('#certificate_of_incorperation_DIV').show();
                    $('#trust_deed_DIV').hide();
                    $('#board_resolution_DIV').show();
                    $('#society_constitution_DIV').hide();
                    $('#partner_kyc_DIV').show();
                    $('#properitor_kyc_DIV').hide();
                    $('#declaration_of_beneficial_ownership_DIV').show();
                    $('#certificate_of_registration_DIV').hide();
                    $('#power_attorney_DIV').hide();
                    $('#articles_of_association_DIV').hide();
                    $('#partner_deed_DIV').hide();
                    $('#articles_of_association_DIV').hide();
                    $('#form01_DIV').show();
                    $('#form20_DIV').show();
                    $('#form44_DIV').show();
                    $('#form45_DIV').show();
                    $('#export_development_DIV').show();
                    $('#board_of_investment_DIV').show();
                    $('#list_of_subsidiaries_DIV').show();
                    $('#directors_kyc_DIV').show();
                    $('#office_barers_kyc_DIV').hide();
                    $('#certificate_commence_DIV').hide();
                    $('#society_constitution_DIV').hide();

                } else if (selectedValue === 'Private Company') {

                    $('#business_registration_DIV').show();
                    $('#certificate_of_incorperation_DIV').show();
                    $('#trust_deed_DIV').hide();
                    $('#board_resolution_DIV').show();
                    $('#society_constitution_DIV').hide();
                    $('#partner_kyc_DIV').show();
                    $('#properitor_kyc_DIV').hide();
                    $('#declaration_of_beneficial_ownership_DIV').show();
                    $('#certificate_of_registration_DIV').hide();
                    $('#power_attorney_DIV').show();
                    $('#articles_of_association_DIV').hide();
                    $('#partner_deed_DIV').hide();
                    $('#articles_of_association_DIV').hide();
                    $('#form01_DIV').show();
                    $('#form20_DIV').show();
                    $('#form44_DIV').show();
                    $('#form45_DIV').show();
                    $('#export_development_DIV').show();
                    $('#board_of_investment_DIV').show();
                    $('#list_of_subsidiaries_DIV').show();
                    $('#directors_kyc_DIV').show();
                    $('#office_barers_kyc_DIV').hide();
                    $('#certificate_commence_DIV').show();
                    $('#society_constitution_DIV').hide();

                } else if (selectedValue === 'Clubs/Societies/Association') {

                    $('#business_registration_DIV').show();
                    $('#certificate_of_incorperation_DIV').hide();
                    $('#trust_deed_DIV').hide();
                    $('#board_resolution_DIV').hide();
                    $('#society_constitution_DIV').hide();
                    $('#partner_kyc_DIV').hide();
                    $('#properitor_kyc_DIV').show();
                    $('#declaration_of_beneficial_ownership_DIV').show();
                    $('#certificate_of_registration_DIV').hide();
                    $('#power_attorney_DIV').show();
                    $('#articles_of_association_DIV').hide();
                    $('#partner_deed_DIV').hide();
                    $('#articles_of_association_DIV').hide();
                    $('#form01_DIV').hide();
                    $('#form20_DIV').hide();
                    $('#form44_DIV').hide();
                    $('#form45_DIV').hide();
                    $('#export_development_DIV').hide();
                    $('#board_of_investment_DIV').hide();
                    $('#list_of_subsidiaries_DIV').hide();
                    $('#directors_kyc_DIV').hide();
                    $('#office_barers_kyc_DIV').show();
                    $('#certificate_commence_DIV').hide();
                    $('#society_constitution_DIV').show();

                } else if (selectedValue === 'Government/Institute/Bank') {


                    $('#business_registration_DIV').show();
                    $('#certificate_of_incorperation_DIV').show();
                    $('#trust_deed_DIV').hide();
                    $('#board_resolution_DIV').show();
                    $('#society_constitution_DIV').hide();
                    $('#partner_kyc_DIV').show();
                    $('#properitor_kyc_DIV').hide();
                    $('#declaration_of_beneficial_ownership_DIV').show();
                    $('#certificate_of_registration_DIV').hide();
                    $('#power_attorney_DIV').hide();
                    $('#articles_of_association_DIV').hide();
                    $('#partner_deed_DIV').hide();
                    $('#articles_of_association_DIV').hide();
                    $('#form01_DIV').show();
                    $('#form20_DIV').show();
                    $('#form44_DIV').show();
                    $('#form45_DIV').show();
                    $('#export_development_DIV').show();
                    $('#board_of_investment_DIV').show();
                    $('#list_of_subsidiaries_DIV').show();
                    $('#directors_kyc_DIV').show();
                    $('#office_barers_kyc_DIV').hide();
                    $('#certificate_commence_DIV').show();
                    $('#society_constitution_DIV').hide();


                } else if (selectedValue === "Trust/Charities") {

                    $('#business_registration_DIV').show();
                    $('#certificate_of_incorperation_DIV').hide();
                    $('#trust_deed_DIV').hide();
                    $('#board_resolution_DIV').hide();
                    $('#society_constitution_DIV').hide();
                    $('#partner_kyc_DIV').hide();
                    $('#properitor_kyc_DIV').show();
                    $('#declaration_of_beneficial_ownership_DIV').show();
                    $('#certificate_of_registration_DIV').hide();
                    $('#power_attorney_DIV').hide();
                    $('#articles_of_association_DIV').hide();
                    $('#partner_deed_DIV').hide();
                    $('#articles_of_association_DIV').hide();
                    $('#form01_DIV').hide();
                    $('#form20_DIV').hide();
                    $('#form44_DIV').hide();
                    $('#form45_DIV').hide();
                    $('#export_development_DIV').hide();
                    $('#board_of_investment_DIV').hide();
                    $('#list_of_subsidiaries_DIV').hide();
                    $('#directors_kyc_DIV').hide();
                    $('#office_barers_kyc_DIV').show();
                    $('#certificate_commence_DIV').hide();
                    $('#society_constitution_DIV').show();

                } else if (selectedValue === "NGO's/NPO's") {

                    $('#business_registration_DIV').show();
                    $('#certificate_of_incorperation_DIV').hide();
                    $('#trust_deed_DIV').hide();
                    $('#board_resolution_DIV').hide();
                    $('#society_constitution_DIV').hide();
                    $('#partner_kyc_DIV').hide();
                    $('#properitor_kyc_DIV').show();
                    $('#declaration_of_beneficial_ownership_DIV').show();
                    $('#certificate_of_registration_DIV').hide();
                    $('#power_attorney_DIV').show();
                    $('#articles_of_association_DIV').hide();
                    $('#partner_deed_DIV').hide();
                    $('#articles_of_association_DIV').hide();
                    $('#form01_DIV').hide();
                    $('#form20_DIV').hide();
                    $('#form44_DIV').hide();
                    $('#form45_DIV').hide();
                    $('#export_development_DIV').hide();
                    $('#board_of_investment_DIV').hide();
                    $('#list_of_subsidiaries_DIV').hide();
                    $('#directors_kyc_DIV').hide();
                    $('#office_barers_kyc_DIV').show();
                    $('#certificate_commence_DIV').hide();
                    $('#society_constitution_DIV').show();

                } else {

                }

            });



            $(".next").click(function() {
                // alert($(this).parent().attr('id'));
                $(this).prev('div').find('.fieldRequired').each(function() {

                    if ($(this).val() === '') {
                        var label = $(this).prev('.fieldlabels').text();

                        alertify.error(`${label} cannot be Empty!`);

                        isValid = false;

                    } else {
                        isValid = true;

                    }
                    return isValid;
                });
                // if($(this).attr('id')==='btnJoint'){


                // }






                if ($(this).attr('id') === 'btnOther') {
                    isValid = true;
                }
                if ($(this).attr('id') === 'btnStatement') {
                    isValid = true;
                }


                current_fs = $(this).parent();
                if (current_fs.attr('id') === 'basicinfoSection' && ACtype == 3) {
                    next_fs = $(this).parent().next().next();

                } else if ((current_fs.attr('id') === 'empinfoSection' && ACtype == 2) || (current_fs
                        .attr('id') === 'empinfoSection' && ACtype == "Indivitual")) {
                    next_fs = $(this).parent().next().next();


                } else {


                    next_fs = $(this).parent().next();
                }

                if (isValid) {
                    //Add Class Active
                    // $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                    // //show the next fieldset

                    // next_fs.show();

                    // //hide the current fieldset with style
                    // current_fs.animate({
                    //     opacity: 0
                    // }, {
                    //     step: function(now) {
                    //         // for making fielset appear animation
                    //         opacity = 1 - now;
                    //         current_fs.css({
                    //             'display': 'none',
                    //             'position': 'relative'
                    //         });
                    //         next_fs.css({
                    //             'opacity': opacity
                    //         });
                    //     },
                    //     duration: 500
                    // });
                    // setProgressBar(++current);
                }
            });

            $(".previous").click(function() {
                // isValid = false;
                // current_fs = $(this).parent();
                // if (current_fs.attr('id') === 'benifcatorSection' && ACtype == 3) {
                //     previous_fs = $(this).parent().prev().prev();
                // } else if ((current_fs.attr('id') === 'bankparticularSection' && ACtype == 2) || (
                //         current_fs.attr('id') === 'bankparticularSection' && ACtype == 1)) {
                //     previous_fs = $(this).parent().prev().prev();
                // } else {
                //     previous_fs = $(this).parent().prev();
                // }
                // //Remove class active
                // $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
                // //show the previous fieldset
                // previous_fs.show();
                // //hide the current fieldset with style
                // current_fs.animate({
                //     opacity: 0
                // }, {
                //     step: function(now) {
                //         // for making fielset appear animation
                //         opacity = 1 - now;
                //         current_fs.css({
                //             'display': 'none',
                //             'position': 'relative'
                //         });
                //         previous_fs.css({
                //             'opacity': opacity
                //         });
                //     },
                //     duration: 500
                // });
                // setProgressBar(--current);
            });

            // function setProgressBar(curStep) {
            //     var percent = parseFloat(100 / steps) * curStep;
            //     percent = percent.toFixed();
            //     $(".progress-bar")
            //         .css("width", percent + "%")
            // }
            // $(".submit").click(function () {

            // })





        });
    </script>
@endsection
