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
                            <h2 id="heading">Sign Up Your User Account</h2>
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

                    <form id="msform" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">

                        @csrf
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active" id="account"><strong> Account Type</strong></li>
                            {{-- <li id="account"><strong>Identification</strong></li> --}}
                            <li id="basic"><strong>Basic Info</strong></li>
                            <li id="employment"><strong>Employment Info</strong></li>
                            <li id="benefactor"><strong>Benefactor Info</strong></li>
                            <li id="bank"><strong>Bank Particulars</strong></li>
                            <li id="other"><strong>Other Info</strong></li>
                            <li id="KYC"><strong>KYC</strong></li>
                            <li id="confirm"><strong>Finish</strong></li>
                        </ul>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuemin="0" aria-valuemax="100"> </div>
                        </div> <br> <!-- fieldsets -->
                        <fieldset id="accountSection">
                            @include('auth.register.accountType')

                            <input type="button" id="btnJoint" name="next" class="next action-button" value="Next" />
                        </fieldset>
                        {{-- <fieldset id="investmentSection">
                      @include('auth.register.Identification')
                     <input type="button" id="btnAccount" name="next" class="next action-button" value="Next" /> 
                     <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset> --}}
                        <fieldset id="basicinfoSection">




                            <div class="form-card">



                                @include('auth.register.mainUserInfo')

                                @include('auth.register.jointHolder')

                                @include('auth.register.signature')
                            </div>

                            <input type="button" id="btnBasicInfo" name="next" class="next action-button"
                                value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>
                        <fieldset id="empinfoSection">
                            @include('auth.register.employement')
                            <input type="button" id="btnEmpInfo" name="next" class="next action-button"
                                value="Next" /> <input type="button" name="previous"
                                class="previous action-button-previous" value="Previous" />
                        </fieldset>
                        <fieldset id="benifcatorSection">
                            {{-- @include('auth.register.employement') --}}
                            <h1>Benefactor Information</h1>
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
                        </fieldset>
                        <fieldset id="otherdetailsSection">
                            @include('auth.register.otherInfo')
                            <input type="button" id="btnOther" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>
                        <fieldset id="kycSection">
                            @include('auth.register.KYC')
                            <input type="button" id="btnKYC" name="next" class="next action-button" value="Next" />
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
                        </fieldset>
                    </form>
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
                $("#msform").saveMyForm();
            });

            $(function() {
                $("#msform").saveMyForm({
                    resetOnSubmit: false
                });
            });




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
            var ACtype = 'Indivitual';

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
            $('#jointHoldersDiv').hide();
            $('#passportDiv').hide();
            $('#joint_authority_DIV').hide();
            $('#company_DIV').hide();
            $('#company_type_DIV').hide();
            $('#occupation_DIV').hide();
            $('#signatures_DIV').hide();
            $('#jointEmpInfoDIV').hide();

            //company documents initial state..
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

            //signature hides
            $('#signatureB_nationality_div').hide();
            $('#signature_passportB_div').hide();

            $('#signatureA_nationality_div').hide();
            $('#signature_passportA_div').hide();


            $('#kyc_foreign_DIV').hide();
            $('#other_visa_DIV').hide();
            $('#other_special_purpose_DIV').hide();
            $('#kyc_other_source_DIV').hide();
            $('#kyc_other_authrity_DIV').hide();


            $('#kyc_other_employement_DIV').hide();
            $('#kyc_marital_status_DIV').hide();
            $('#kyc_nature_of_business_specify_DIV').hide();



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
                                    console.log("set value to next ", $(this).parents(
                                        'div').next('input[type=hidden]'));
                                    $(this).parents('div').next('input[type=hidden]')
                                        .val(1);
                                }

                            });

                            alertify.success("OTP accepted!");
                            $('#mobileOTPModal').modal('hide');
                            OTP();

                        } else {
                            alertify.error("The OTP You Entered Is Invalid, Please Try again");
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
                            alertify.error("The OTP You Entered Is Invalid, Please Try again");
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
                    if (ACtype != 'Institute') {
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

                if ($(this).attr('id') === 'btnBasicInfo') {





                    isValidDate($('#dob').val(), 'Date of Birth');

                    if ($('#mobile').val() === '') {
                        alertify.error(`mobile  cannot be Empty!`);
                        isValid = false;
                        return;
                    }

                    // if($('#telephone').val()===''){
                    //     alertify.error(`mobile  cannot be Empty!`);
                    //     isValid=false;
                    //     return;
                    // }            


                    if ($('#email').val() === '') {
                        alertify.error(`email  cannot be Empty!`);
                        isValid = false;
                        return;
                    }
                    if ($('#address_line_1').val() === '') {
                        alertify.error(`address line 1   cannot be Empty!`);
                        isValid = false;
                        return;
                    }

                    if ($('#address_line_2').val() === '') {
                        alertify.error(`address line 2   cannot be Empty!`);
                        isValid = false;
                        return;
                    }

                    if ($('#nationality').val() === 'other') {

                        if ($('#passport').val() === '') {
                            alertify.error(`passport image cannot be Empty!`);
                            isValid = false;
                            return;

                        }
                        if ($('#other_nationality').val() === '') {
                            alertify.error(`Nationailty  cannot be Empty!`);
                            isValid = false;
                            return;

                        }
                        if ($('#authorized_name').val() === '') {
                            alertify.error(`Authorized Person Name cannot be Empty!`);
                            isValid = false;
                            return;

                        }
                        if ($('#authorized_address').val() === '') {
                            alertify.error(`Authorized Person Address cannot be Empty!`);
                            isValid = false;
                            return;

                        }
                        if ($('#authorized_telephone').val() === '') {
                            alertify.error(`Authorized Person Telephone cannot be Empty!`);
                            isValid = false;
                            return;

                        }
                        if ($('#authorized_nic').val() === '') {
                            alertify.error(`Authorized Person NIC cannot be Empty!`);
                            isValid = false;
                            return;

                        }
                    } else {
                        if ($('#nic_front').val() === '') {
                            alertify.error(`NIC front image cannot be Empty!`);
                            isValid = false;
                            return;

                        }
                        //   console.log('nic_filesize '+ $('#nic_front').files[0].size);
                        if ($('#nic_back').val() === '') {
                            alertify.error(`NIC back image cannot be Empty!`);
                            isValid = false;
                            return;

                        }
                    }

                    if ($('#signature').val() === '') {
                        alertify.error(`Signature cannot be Empty!`);
                        isValid = false;
                        return;

                    }

                    if ($('#profile_pic').val() === '') {
                        alertify.error(`Profile cannot be Empty!`);
                        isValid = false;
                        return;

                    }

                    if (ACtype === 'Joint') {

                        // $('.joint_name').each(function(){
                        //         //if statement here 
                        //         // use $(this) to reference the current div in the loop
                        //         //you can try something like...
                        //         if($(this).val()===""){
                        //             alertify.error(`Joint Holder Name Cannot be Empty`);


                        //         isValid=false;
                        //         return false

                        //         }
                        //         if(isValid){
                        //             return true
                        //         }else{
                        //             return false
                        //         }



                        //     });

                        if ($('.joint_name').val() === "") {
                            alertify.error(`Joint Holder Name Cannot be Empty`);
                            isValid = false;
                            return;
                        }
                        if ($('.joint_name_by_initials').val() === "") {
                            alertify.error(`Joint Holder Name By Initials Cannot be Empty`);
                            isValid = false;
                            return;
                        }
                        if ($('.joint_address_line_1').val() === "") {
                            alertify.error(`Joint Holder Address Line 1  Cannot be Empty`);
                            isValid = false;
                            return;
                        }
                        if ($('.joint_address_line_2').val() === "") {
                            alertify.error(`Joint Holder Address Line 2 Cannot be Empty`);
                            isValid = false;
                            return;
                        }
                        if ($('.joint_email').val() === "") {
                            alertify.error(`Joint Holder Email  Cannot be Empty`);
                            isValid = false;
                            return;
                        }

                        if ($('.joint_email').val() === $('#email').val()) {

                            alertify.error(`Joint Holder Email Cannot Be Same As Main Holder Email`);
                            isValid = false;
                            return;


                        }

                        if ($('.joint_dob').val() === "") {
                            alertify.error(`Joint Holder Date of Birth  Cannot be Empty`);
                            isValid = false;
                            return;
                        }
                        if ($('.joint_nic').val() === "") {
                            alertify.error(`Joint Holder NIC/Passport  Cannot be Empty`);
                            isValid = false;
                            return;
                        }
                        if ($('.joint_mobile').val() === "") {
                            alertify.error(`Joint Holder Mobile  Cannot be Empty`);
                            isValid = false;
                            return;
                        }

                        if ($('.joint_signature').val() === "") {
                            alertify.error(`Joint Holder Signature  Cannot be Empty`);
                            isValid = false;
                            return;

                        }
                        if ($('.joint_pro_pic').val() === "") {
                            alertify.error(`Joint Holder Profile Picture  Cannot be Empty`);
                            isValid = false;
                            return;

                        }

                        if ($('.joint_nationality').val() === "other") {
                            if ($('.joint_passport').val() === "") {
                                alertify.error(`Joint Holder passport must be uploaded`);
                                isValid = false;
                                return;
                            }
                            if ($('.joint_nationality_other').val() === "") {
                                alertify.error(`Joint Holder Nationality Must be Mentioned`);
                                isValid = false;
                                return;
                            }

                        } else {
                            if ($('.joint_nic_front').val() === "") {
                                alertify.error(`Joint NIC front image should be uploaded`);
                                isValid = false;
                                return;
                            }
                            if ($('.joint_nic_back').val() === "") {
                                alertify.error(`Joint Holder NIC back image should be uploaded`);
                                isValid = false;
                                return;
                            }

                        }
                    }

                    //   return isValid=false;   


                    //setting full mobile values..
                    let _telInput = $(".OTP");
                    _telInput.each(function() {

                        let fullmobile = $(this).intlTelInput("getNumber");

                        $(this).parents('div').prev().prev().val(fullmobile);
                    });

                    //email verification          
                    if (!isValidEmailAddress($('#email').val())) {
                        alertify.error(`Invalid Email Address`);

                        isValid = false;
                    } else {

                        var email_temp = $('#email').val();
                        var data = {
                            "email": email_temp,
                            "_token": "{{ csrf_token() }}"
                        }; //data to send to server
                        var dataType = "json" //expected datatype from server
                        //  let watchID = 0;
                        var request = $.post({
                            url: "{{ route('user.email.validation') }}", //url of the server which stores time data
                            data: data,
                            async: false,
                            cache: false,
                            timeout: 30000,

                            success: function(data) {

                                // alert(data.state);
                                if (data.state === false) {
                                    isValid = false;
                                    alertify.error(`This Email Already Exists In NSB FMC`);
                                    //    alert("email already exists in nSB FMc");
                                } else {
                                    isValid = true;


                                }
                            }
                        });


                    }

                    //generate OTP

                    if (isValid) {
                        OTP();
                    }


                }


                if ($(this).attr('id') === 'btnEmpInfo') {

                    if ($('#emp_occupation').val() === "") {
                        alertify.error(`Occupation Cannot be Empty`);
                        // alertify.alert('mention if not Applicable');
                        isValid = false;
                        return;
                    }
                    if ($('#emp_company_name').val() === "") {
                        alertify.error(`Company Cannot be Empty`);
                        isValid = false;
                        return;
                    }

                    if ($('#emp_company_address').val() === "") {
                        alertify.error(`Company Address Cannot be Empty`);
                        isValid = false;
                        return;
                    }

                    if ($('#emp_nature').val() === "") {
                        alertify.error(`Company Business Nature Cannot be Empty`);
                        isValid = false;
                        return;
                    }







                    isValid = true;
                }
                if ($(this).attr('id') === 'btnBank') {

                    if ($('.bank').val() == 0) {
                        alertify.error(`Bank  cannot be Empty!`);
                        isValid = false;
                        return;
                    }


                    if ($('.branch').val() == 0) {
                        alertify.error(`Branch  cannot be Empty!`);
                        isValid = false;
                        return;
                    }
                    if ($('.acc').val() === "") {
                        alertify.error(`Account No  cannot be Empty!`);
                        isValid = false;
                        return;
                    }
                    if ($('.accOwner').val() === "") {
                        alertify.error(`Account Holder name cannot be Empty!`);
                        isValid = false;
                        return;
                    }
                    if ($('.accountType').val() === "") {
                        alertify.error(`You must Select An Account Type`);
                        isValid = false;
                        return;
                    }

                    isValid = true;
                }

                if ($(this).attr('id') === 'btnOther') {
                    isValid = true;
                }
                if ($(this).attr('id') === 'btnStatement') {
                    isValid = true;
                }


                current_fs = $(this).parent();
                if (current_fs.attr('id') === 'basicinfoSection' && ACtype == "Institute") {
                    next_fs = $(this).parent().next().next();

                } else if ((current_fs.attr('id') === 'empinfoSection' && ACtype == "Joint") || (current_fs
                        .attr('id') === 'empinfoSection' && ACtype == "Indivitual")) {
                    next_fs = $(this).parent().next().next();


                } else {


                    next_fs = $(this).parent().next();
                }

                if (isValid) {
                    //Add Class Active
                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                    //show the next fieldset

                    next_fs.show();

                    //hide the current fieldset with style
                    current_fs.animate({
                        opacity: 0
                    }, {
                        step: function(now) {
                            // for making fielset appear animation
                            opacity = 1 - now;
                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            next_fs.css({
                                'opacity': opacity
                            });
                        },
                        duration: 500
                    });
                    setProgressBar(++current);
                }
            });

            $(".previous").click(function() {
                isValid = false;
                current_fs = $(this).parent();
                if (current_fs.attr('id') === 'benifcatorSection' && ACtype == "Institute") {
                    previous_fs = $(this).parent().prev().prev();
                } else if ((current_fs.attr('id') === 'bankparticularSection' && ACtype == "Joint") || (
                        current_fs.attr('id') === 'bankparticularSection' && ACtype == "Indivitual")) {
                    previous_fs = $(this).parent().prev().prev();
                } else {
                    previous_fs = $(this).parent().prev();
                }
                //Remove class active
                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
                //show the previous fieldset
                previous_fs.show();
                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function(now) {
                        // for making fielset appear animation
                        opacity = 1 - now;
                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        previous_fs.css({
                            'opacity': opacity
                        });
                    },
                    duration: 500
                });
                setProgressBar(--current);
            });

            function setProgressBar(curStep) {
                var percent = parseFloat(100 / steps) * curStep;
                percent = percent.toFixed();
                $(".progress-bar")
                    .css("width", percent + "%")
            }
            // $(".submit").click(function () {

            // })
            //Nationality Select on Applicant
            $('#nationality').change(function() {
                if ($(this).val() === 'other') {
                    $('#authorizedDiv').show();
                    $('#nicDiv').hide();
                    $('#passportDiv').show();
                    $('#other_nationalityDIV').show();
                } else {

                    $('#authorizedDiv').hide();
                    $('#passportDiv').hide();
                    $('#nicDiv').show();
                    $('#other_nationalityDIV').hide();
                }
            });


            //Nationality Select on SignatureB..................

            $('#cp_nationality_b').change(function() {
                if ($(this).val() === 'other') {
                    $('#signatureB_nic_div').hide();
                    $('#signatureB_nationality_div').show();
                    $('#signature_passportB_div').show();
                } else {

                    $('#signatureB_nationality_div').hide();
                    $('#signature_passportB_div').hide();
                    $('#signatureB_nic_div').show();
                }
            });
            //-------------------------------------------------------
            //Nationality Select on SignatureA..................

            $('#cp_nationality_a').change(function() {
                if ($(this).val() === 'other') {
                    $('#signatureA_nic_div').hide();
                    $('#signatureA_nationality_div').show();
                    $('#signature_passportA_div').show();
                } else {

                    $('#signatureA_nic_div').show();
                    $('#signatureA_nationality_div').hide();
                    $('#signature_passportA_div').hide();
                }
            });
            //-------------------------------------------------------










            //CLIENT TYPE DETECTION ............
            //--------------------------------------------------------------
            $('#client_type').change(function() {
                if ($(this).val() == 2) {
                    // Title set to Main Joint Holder..
                    $('#mainPersontitle').html('Main Holder Information');

                    //Joint account - Bank particulars fields..
                    ACtype = 'Joint';

                    var newOptions = {
                        "Select": "Select",
                        "individual": "individual",
                        "Joint": "Joint",
                    };

                    var $el = $(".accountType");
                    $el.empty(); // remove old options
                    $.each(newOptions, function(key, value) {
                        $el.append($("<option></option>")
                            .attr("value", value).text(key));
                    });

                    //company hide
                    $('#company_DIV').hide();
                    $('#company_type_DIV').hide();
                    $('#signatures_DIV').hide();
                    $('#occupation_DIV').hide();

                    //show Joint Fields.................................
                    $('#jointHoldersDiv').show();
                    $('#joint_authority_DIV').show();
                    $('#corresponding_address_DIV').show();
                    $('#correspondanceCheck_DIV').show();
                    $('#fieldEMPinfo').show();
                    $('#employment').show();
                    $('#benefactor').hide();
                    $('#jointEmpInfoDIV').show();

                    //....................................................

                    //........add/remove OTP........

                    $('.joint_mobile').addClass('OTP');
                    $('.joint_mobile').intlTelInput({
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


                    $('.signature_mobile').removeClass('OTP');
                    $('.joint_email').addClass('emailOTP');


                    //remove validation of  Company fields......................................
                    $('#occupation').removeClass('fieldRequired');
                    $('#company_name').removeClass('fieldRequired');
                    $('#company_address_line_1').removeClass('fieldRequired');
                    $('#company_address_line_2').removeClass('fieldRequired');
                    $('#company_address_line_3').removeClass('fieldRequired');
                    $('#company_br_no').removeClass('fieldRequired');
                    $('#company_nature_of_business').removeClass('fieldRequired');
                    $('#company_telephone_1').removeClass('fieldRequired');
                    $('#company_email_1').removeClass('fieldRequired');


                    //signatura A validate remove...
                    $('#cp_name_a').removeClass('fieldRequired');
                    $('#cp_occupation_a').removeClass('fieldRequired');
                    $('#cp_address_line1_a').removeClass('fieldRequired');
                    $('#cp_address_line_2_a').removeClass('fieldRequired');
                    $('#cp_dob_a').removeClass('fieldRequired');
                    $('#cp_nic_a').removeClass('fieldRequired');
                    $('#cp_telephone_a').removeClass('fieldRequired');
                    $('#cp_email_a').removeClass('fieldRequired');
                    $('#cp_name_a').removeClass('fieldRequired');
                    if ($('#cp_nationality_a').val() === 'other') {
                        $('#cp_passport_a').removeClass('fieldRequired');
                        $('#cp_nic_front_a').removeClass('fieldRequired');
                        $('#cp_nic_back_a').removeClass('fieldRequired');
                        $('#cp_nationality_other_a').removeClass('fieldRequired');

                    } else {
                        //is sri lankan...   
                        $('cp_passport_a').removeClass('fieldRequired');
                        $('cp_nic_front_a').removeClass('fieldRequired');
                        $('cp_nic_back_a').removeClass('fieldRequired');
                        $('#cp_nationality_other_a').removeClass('fieldRequired');

                    }
                    $('#cp_signature_a').removeClass('fieldRequired');

                    //signature b remove
                    $('#cp_name_b').removeClass('fieldRequired');
                    $('#cp_occupation_b').removeClass('fieldRequired');
                    $('#cp_address_line1_b').removeClass('fieldRequired');
                    $('#cp_address_line_2_b').removeClass('fieldRequired');
                    $('#cp_dob_b').removeClass('fieldRequired');
                    $('#cp_nic_b').removeClass('fieldRequired');
                    $('#cp_telephone_b').removeClass('fieldRequired');
                    $('#cp_email_b').removeClass('fieldRequired');
                    $('#cp_name_b').removeClass('fieldRequired');
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


                    //..................................................................

                } else if ($(this).val() == 3) {
                    //title set to Intiator 
                    $('#mainPersontitle').html('Initiator Information');
                    //change values of bank particular AC TYPE
                    ACtype = 'Institute';
                    var newOptions = {
                        "Select": "Select",
                        "Bank": "Bank",
                        "RTGS": "RTGS"
                    };
                    var $el = $(".accountType");
                    $el.empty(); // remove old options
                    $.each(newOptions, function(key, value) {
                        $el.append($("<option></option>")
                            .attr("value", value).text(key));
                    });
                    //...........................................

                    // hide   fields when institute...
                    $('#jointHoldersDiv').hide();
                    $('#joint_authority_DIV').hide();
                    $('#jointEmpInfoDIV').hide();
                    $('#company_DIV').show();
                    $('#company_type_DIV').show();
                    $('#signatures_DIV').show();
                    $('#corresponding_address_DIV').hide();
                    $('#fieldEMPinfo').hide();
                    $('#employment').hide();
                    $('#benefactor').show();
                    $('#correspondanceCheck_DIV').hide();
                    $('#occupation_DIV').show();
                    //.........................

                    //....add/Remove OTP
                    $('.joint_mobile').removeClass('OTP');
                    $('.signature_mobile').addClass('OTP');
                    $('.joint_email').removeClass('emailOTP');

                    //occupation validate..
                    $('#occupation').addClass('fieldRequired');





                    //make fields required when institute.....

                    $('#company_name').addClass('fieldRequired');
                    $('#company_address_line_1').addClass('fieldRequired');
                    $('#company_address_line_2').addClass('fieldRequired');
                    $('#company_br_no').addClass('fieldRequired');
                    $('#company_nature_of_business').addClass('fieldRequired');
                    $('#company_telephone_1').addClass('fieldRequired');
                    $('#company_email_1').addClass('fieldRequired');


                    //signatura A validate...
                    $('#cp_name_a').addClass('fieldRequired');
                    $('#cp_occupation_a').addClass('fieldRequired');
                    $('#cp_address_line1_a').addClass('fieldRequired');
                    $('#cp_address_line_2_a').addClass('fieldRequired');
                    $('#cp_dob_a').addClass('fieldRequired');
                    $('#cp_nic_a').addClass('fieldRequired');
                    $('#cp_telephone_a').addClass('fieldRequired');
                    $('#cp_email_a').addClass('fieldRequired');
                    $('#cp_name_a').addClass('fieldRequired');
                    if ($('#cp_nationality_a').val() === 'other') {
                        $('#cp_passport_a').addClass('fieldRequired');
                        $('#cp_nic_front_a').removeClass('fieldRequired');
                        $('#cp_nic_back_a').removeClass('fieldRequired');
                        $('#cp_nationality_other_a').addClass('fieldRequired');
                    } else {
                        //is sri lankan...   
                        $('cp_passport_a').removeClass('fieldRequired');
                        $('cp_nic_front_a').addClass('fieldRequired');
                        $('cp_nic_back_a').addClass('fieldRequired');
                        $('#cp_nationality_other_a').removeClass('fieldRequired');
                    }
                    $('#cp_signature_a').addClass('fieldRequired');



                    //............................................

                    //signature B status..............
                    if ($('#makeSignatureB').is(':checked')) {

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




                } else {
                    //Title Set to you 
                    $('#mainPersontitle').html('Your Information');
                    //else AC type is indivitual.......... 
                    // bank particulars account type............
                    ACtype = 'Indivitual';
                    var newOptions = {
                        "Select": "Select",
                        "individual": "individual",
                        "Joint": "Joint",
                    };

                    var $el = $(".accountType");
                    $el.empty(); // remove old options
                    $.each(newOptions, function(key, value) {
                        $el.append($("<option></option>")
                            .attr("value", value).text(key));
                    });

                    // $('#name').attr('required', 'required');
                    //.............................................

                    //........................................................

                    //Hide joint  fields.............................................
                    $('#jointHoldersDiv').hide();
                    $('#joint_authority_DIV').hide();
                    $('#jointEmpInfoDIV').hide();
                    $('#company_DIV').hide();
                    $('#company_type_DIV').hide();
                    $('#signatures_DIV').hide();
                    $('#corresponding_address_DIV').show();
                    $('#correspondanceCheck_DIV').show();
                    $('#employment').show();
                    $('#benefactor').hide();
                    $('#fieldEMPinfo').show();
                    $('#occupation_DIV').hide();
                    //........................................................

                    //....Remove Joint Classes..
                    $('.joint_mobile').removeClass('OTP');
                    $('.signature_mobile').removeClass('OTP');
                    $('.joint_email').removeClass('emailOTP');

                    // remove institute validation............................
                    $('#occupation').removeClass('fieldRequired');
                    $('#company_name').removeClass('fieldRequired');
                    $('#company_address_line_1').removeClass('fieldRequired');
                    $('#company_address_line_2').removeClass('fieldRequired');
                    $('#company_br_no').removeClass('fieldRequired');
                    $('#company_nature_of_business').removeClass('fieldRequired');
                    $('#company_telephone_1').removeClass('fieldRequired');
                    $('#company_email_1').removeClass('fieldRequired');


                    //signatura A validate remove...
                    $('#cp_name_a').removeClass('fieldRequired');
                    $('#cp_occupation_a').removeClass('fieldRequired');
                    $('#cp_address_line1_a').removeClass('fieldRequired');
                    $('#cp_address_line_2_a').removeClass('fieldRequired');
                    $('#cp_dob_a').removeClass('fieldRequired');
                    $('#cp_nic_a').removeClass('fieldRequired');
                    $('#cp_telephone_a').removeClass('fieldRequired');
                    $('#cp_email_a').removeClass('fieldRequired');
                    $('#cp_name_a').removeClass('fieldRequired');
                    if ($('#cp_nationality_a').val() === 'other') {
                        $('#cp_passport_a').removeClass('fieldRequired');
                        $('#cp_nic_front_a').removeClass('fieldRequired');
                        $('#cp_nic_back_a').removeClass('fieldRequired');
                        $('#cp_nationality_other_a').removeClass('fieldRequired');
                    } else {
                        //is sri lankan...   
                        $('cp_passport_a').removeClass('fieldRequired');
                        $('cp_nic_front_a').removeClass('fieldRequired');
                        $('cp_nic_back_a').removeClass('fieldRequired');
                        $('#cp_nationality_other_a').removeClass('fieldRequired');

                    }
                    $('#cp_signature_a').removeClass('fieldRequired');


                    //signature B remove
                    $('#cp_name_b').removeClass('fieldRequired');
                    $('#cp_occupation_b').removeClass('fieldRequired');
                    $('#cp_address_line1_b').removeClass('fieldRequired');
                    $('#cp_address_line_2_b').removeClass('fieldRequired');
                    $('#cp_dob_b').removeClass('fieldRequired');
                    $('#cp_nic_b').removeClass('fieldRequired');
                    $('#cp_telephone_b').removeClass('fieldRequired');
                    $('#cp_email_b').removeClass('fieldRequired');
                    $('#cp_name_b').removeClass('fieldRequired');
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



                    //........................................................

                }
            });



            //bank account types changes


            $(document).on("change", ".accountType", function() {

                var selectedValue = $(this).val();
                if (selectedValue === 'RTGS') {

                    $(this).closest('td').next('td').find('select').hide();
                    $(this).closest('td').next('td').next('td').find('select').hide();
                } else {

                    $(this).closest('td').next('td').find('select').show();
                    $(this).closest('td').next('td').next('td').find('select').show();
                }


            });




            //  dynamic form code
            var i = 0;
            $('#add_more').on('click', function() {
                var colorR = Math.floor((Math.random() * 256));
                var colorG = Math.floor((Math.random() * 256));
                var colorB = Math.floor((Math.random() * 256));
                i++;
                var html = '<div id="append_no_' + i + '" class="animated bounceInLeft">' +
                    '<hr/>' +
                    '<h2> Joint Holder ' + parseInt(i + 1) + ' info </h2>' +
                    '<div class="row">' +
                    '<div class="col-md-2">' +
                    '<div class="input-group">' +
                    '<label class="fieldlabels">Title </label>' +
                    '<select name="joint_title[]" id="joint_title[]" class="field Required">' +
                    '<option value="Mr.">Mr</option>' +
                    '<option value="Mrs.">Mrs</option>' +
                    '<option value="Miss.">Miss</option>' +
                    '<option value="Rev.">Rev</option>' +
                    '<option value="Dr.">Dr</option>' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-4">' +
                    '<label class="fieldlabels">Name in Full: * </label>' +
                    '<input type="text" name="joint_name[]" placeholder="Joint Holder Name" class="form-control joint_name"/>' +
                    '</div>' +
                    '  <div class="col-md-4">' +
                    '<label class="fieldlabels">Name Donated By Initials : * </label>' +
                    '<input type="text" name="joint_name_initials[]" placeholder="Name by Intitials" class="form-control joint_name_initials"/>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Address Line 1 :*</label>' +
                    '<input type="text" name="joint_address_line_1[]" placeholder="Address Line 1" class="form-control joint_address_line_1"/>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Address Line 2 :*</label>' +
                    '<input type="text" name="joint_address_line_2[]" placeholder="Address Line 2 " class="form-control joint_address_line_2"/>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Address Line 3 :*</label>' +
                    '<input type="text" name="joint_address_line_3[]" placeholder="Address Line 3 " class="form-control joint_address_line_3"/>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Email: *</label>' +
                    '<input type="text" name="joint_email[]"placeholder="email" class="form-control joint_email"/>' +
                    '<input type="hidden" value="">' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Date Of Birth: *</label>' +
                    '<input type="text" name="joint_dob[]" placeholder="YYYY-MM-DD" class="form-control jointDob"/>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">NIC/Passport: *</label>' +
                    '<input type="text" name="joint_nic[]"placeholder="nic" class="form-control joint_nic"/>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Nationality *</label>' +
                    '<select class="joint_nationality" name="joint_nationality[]">' +
                    '<option value="Sri Lankan">Sri Lankan</option>' +
                    '<option value="other">Other</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<div class="joint_nationality_div">' +
                    '<label class="fieldlabels">Nationality *</label>' +
                    '<input type="text" name="joint_nationality_other[]"placeholder="Nationality" class="form-control"/>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Land Phone: *</label>' +
                    '<input type="text" name="joint_telephone[]"placeholder="land line" class="form-control"/>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<input type="hidden" name="full_joint_mobile[]"/>' +
                    '<label class="fieldlabels">Mobile: *</label>' +
                    '<input type="tel" name="joint_mobile[]" placeholder="mobile" class="form-control joint_mobile OTP"/>' +
                    '<input type="hidden" value="">' +
                    '</div>' +
                    '</div>' +
                    '<div class ="joint_nic_div" >' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">NIC Front Side: *</label>' +
                    '<input type="file" name="joint_nic_front[]"  accept="image/*" class="imgLoad joint_nic_front">' +
                    '<img id="joint_nic_front" src="' +
                    "{{ asset('storage/images/nic_front_preview.jpg') }}" + '" class="img_preview" />' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">NIC Back Side: *</label>' +
                    '<input type="file" name="joint_nic_back[]" accept="image/*" class="imgLoad joint_nic_back">' +
                    '<img id="joint_nic_back_preview" src="' +
                    "{{ asset('storage/images/nic_back_preview.jpg') }}" + '" class="img_preview" />' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="joint_passport_div">' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Passport: *</label>' +
                    '<input type="file" name="joint_passport[]" accept="image/*" class="imgLoad joint_passport">' +
                    '<img id="joint_passport_preview" src="' +
                    "{{ asset('storage/images/nic_back_preview.jpg') }}" + '" class="img_preview" />' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Signature: *</label>' +
                    '<input type="file" name="joint_signature[]" accept="image/*" class="imgLoad joint_signature">' +
                    '<img id="joint_passport_preview" src="' +
                    "{{ asset('storage/images/signature_preview.png') }}" + '" class="img_preview" />' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Profile picture </label>' +
                    '<input type="file" id="joint_profile_pic[]" name="joint_pro_pic[]" accept="image/*"  class="imgLoad joint_profile_pic">' +
                    '<img id="signature_preview" src="' + "{{ asset('storage/images/pro_pic.png') }}" +
                    '" class="img_preview" />' +
                    '</div>' +
                    '</div>';

                var empHtml = '<div id="jappend_no_' + i + '" class="animated bounceInLeft">' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<h3> Joint Holder ' + parseInt(i + 1) + ' Employement Info</h3>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Occupation: *</label>' +
                    '<input type="text" name="joint_emp_occupation[]" id="joint_emp_occupation[]" placeholder=""  class=""/>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Company Name:*</label>' +
                    '<input type="text" name="joint_emp_company_name[]" placeholder="" class=""/>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<label class="fieldlabels">Company Address: *</label>' +
                    '<input type="text" name="joint_emp_company_address[]" placeholder="" class="" />' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Company Telephone: *</label>' +
                    '<input type="text" name="joint_emp_company_telephone[]" placeholder=""  class=""/>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Fax: *</label>' +
                    '<input type="text" name="joint_emp_fax[]" placeholder="Fax"  class=""/>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<label class="fieldlabels">Nature Of Business: *</label>' +
                    '<input type="text" name="joint_emp_nature[]" placeholder=""  class=""/>' +
                    '</div>' +
                    '</div>';




                $('#dynamic_container').append(html);
                $('.joint_mobile').intlTelInput({
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
                $('#dynamic_emp').append(empHtml);

                $('#remove_more').fadeIn(function() {
                    $(this).show();
                });
            });
            $('#remove_more').on('click', function() {

                $('#append_no_' + i).removeClass('bounceInLeft').addClass('bounceOutRight')
                    .fadeOut(function() {
                        $(this).remove();
                    });
                $('#jappend_no_' + i).removeClass('bounceInLeft').addClass('bounceOutRight')
                    .fadeOut(function() {
                        $(this).remove();
                    });
                i--;
                if (i == 0) {
                    $('#remove_more').fadeOut(function() {
                        $(this).hide()
                    });
                }


            });

            //beneficials....
            var i2 = 0;
            $('#add_bene_more').on('click', function() {
                var colorR = Math.floor((Math.random() * 256));
                var colorG = Math.floor((Math.random() * 256));
                var colorB = Math.floor((Math.random() * 256));
                i2++;
                var html_bene = '<div id="bene_append_no_' + i2 + '" class="animated bounceInLeft">' +
                    '<hr/>' +
                    '<h2> Benefactor  ' + parseInt(i2 + 1) + ' info </h2>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<div class="input-group">' +
                    '<label class="fieldlabels">Title </label>' +
                    '<select name="bene_title[]" id="bene_title[]" class="field Required">' +
                    '<option value="Mr.">Mr</option>' +
                    '<option value="Mrs.">Mrs</option>' +
                    '<option value="Miss.">Miss</option>' +
                    '<option value="Rev.">Rev</option>' +
                    '<option value="Dr.">Dr</option>' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Name in Full: * </label>' +
                    '<input type="text" name="bene_name[]" placeholder="Name" class="form-control"/>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Designation: * </label>' +
                    '<input type="text" name="bene_designation[]" placeholder="Name" class="form-control"/>' +
                    '</div>' +

                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Date Of Birth: *</label>' +
                    '<input type="text" name="bene_dob[]" placeholder="YYYY-MM-DD" class="form-control beneDob"/>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">NIC/Passport: *</label>' +
                    '<input type="text" name="bene_nic[]"placeholder="nic" class="form-control"/>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Address Line 1 :*</label>' +
                    '<input type="text" name="bene_address_line1[]" placeholder="Address Line 1" class="form-control"/>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Address Line 2 :*</label>' +
                    '<input type="text" name="bene_address_line_2[]" placeholder="Address Line 2 " class="form-control"/>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Address Line 3 :*</label>' +
                    '<input type="text" name="bene_address_line_3[]" placeholder="Address Line 3 " class="form-control"/>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels"> Country of Issue & CitizenShip *</label>' +
                    '<input type="text" name="bene_citizenship[]"placeholder="Citizenship" class="form-control"/>' +
                    ' </div>' +
                    ' </div>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels"> Source of Beneficial Ownership (Effective Control/Person on whose behalf account is operated)</label>' +
                    '<input type="text" name="bene_source_of_beneficial[]" placeholder="Citizenship" class="form-control"/>' +
                    '</div>' +
                    '<label class="fieldlabels"> Politically Exposed Person (PEP) *</label>' +
                    '<select name="bene_pep" id="bene_pep">' +
                    '<option value="0">No</option>' +
                    '<option value="1">Yes</option>' +
                    '</select>' +

                    ' </div>';




                $('#dynamic_bene').append(html_bene);


                $('#remove_bene').fadeIn(function() {
                    $(this).show();
                });
            });
            $('#remove_bene').on('click', function() {

                $('#bene_append_no_' + i2).removeClass('bounceInLeft').addClass('bounceOutRight')
                    .fadeOut(function() {
                        $(this).remove();
                    });

                i2--;
                if (i2 == 0) {
                    $('#remove_bene').fadeOut(function() {
                        $(this).hide()
                    });
                }


            });

            //..... natural person..

            var i3 = 0;
            $('#add_natural').on('click', function() {
                var colorR = Math.floor((Math.random() * 256));
                var colorG = Math.floor((Math.random() * 256));
                var colorB = Math.floor((Math.random() * 256));
                i3++;
                var html_bene = '<div id="natural_append_no_' + i3 + '" class="animated bounceInLeft">' +
                    '<hr/>' +
                    '<h2> Person  ' + parseInt(i3 + 1) + ' info </h2>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<div class="input-group">' +
                    '<label class="fieldlabels">Title </label>' +
                    '<select name="natural_title[]" id="natural_title[]" class="field Required">' +
                    '<option value="Mr.">Mr</option>' +
                    '<option value="Mrs.">Mrs</option>' +
                    '<option value="Miss.">Miss</option>' +
                    '<option value="Rev.">Rev</option>' +
                    '<option value="Dr.">Dr</option>' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Name in Full: * </label>' +
                    '<input type="text" name="natural_name[]" placeholder="Name" class="form-control"/>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Designation: * </label>' +
                    '<input type="text" name="natural_designation[]" placeholder="Designation" class="form-control"/>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Mobile: *</label>' +
                    '<input type="text" name="natural_mobile[]" placeholder="mobile" class="form-control natural_mobile"/>' +
                    '<input type="hidden" value="">' +
                    '</div>' +
                    ' </div>' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">NIC/Passport: *</label>' +
                    '<input type="text" name="natural_nic[]" placeholder="nic" class="form-control"/>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                    '<label class="fieldlabels">Signature: *</label>' +
                    '<input type="file" name="natural_signature[]" accept="image/*" class="imgLoad">' +
                    '<img id="natural_passport_preview" src="' +
                    "{{ asset('storage/images/signature_preview.png') }}" + '" class="img_preview" />' +
                    '</div>' +
                    ' </div>';




                $('#dynamic_natural').append(html_bene);


                $('#remove_natural').fadeIn(function() {
                    $(this).show();
                });
            });
            $('#remove_natural').on('click', function() {

                $('#natural_append_no_' + i3).removeClass('bounceInLeft').addClass('bounceOutRight')
                    .fadeOut(function() {
                        $(this).remove();
                    });

                i3--;
                if (i3 == 0) {
                    $('#remove_natural').fadeOut(function() {
                        $(this).hide()
                    });
                }


            });








            //  $(document).on("load",".joint_nationality_div" function(){
            //     $(this).hide();
            //  });

            // intially Joint Sri Lankan..
            $('.joint_nic_div').show();
            $('.joint_nationality_div').hide();
            $('.joint_passport_div').hide();

            $(document).on("change", ".joint_nationality", function() {
                if ($(this).val() === 'other') {
                    $(this).parent().parent().parent().children('.joint_nic_div').hide();
                    $(this).parent().next().children('.joint_nationality_div').show();
                    $(this).parent().parent().parent().children('.joint_passport_div').show();
                } else {
                    $(this).parent().parent().parent().children('.joint_nic_div').show();
                    $(this).parent().next().children('.joint_nationality_div').hide();
                    $(this).parent().parent().parent().children('.joint_passport_div').hide();

                }
            });





            $("#add_row").on("click", function() {
                // Dynamic Rows Code

                // Get max row id and set new id
                var newid = 0;
                $.each($("#tab_logic tr"), function() {
                    if (parseInt($(this).data("id")) > newid) {
                        newid = parseInt($(this).data("id"));
                    }
                });
                newid++;

                var tr = $("<tr></tr>", {
                    id: "addr" + newid,
                    "data-id": newid
                });

                // loop through each td and create new elements with name of newid
                $.each($("#tab_logic tbody tr:nth(0) td"), function() {
                    var td;
                    var cur_td = $(this);

                    var children = cur_td.children();

                    // add new td and element if it has a nane
                    if ($(this).data("name") !== undefined) {
                        td = $("<td></td>", {
                            "data-name": $(cur_td).data("name")
                        });

                        var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                        c.attr("name", $(cur_td).data("name[]"));
                        c.appendTo($(td));
                        td.appendTo($(tr));
                    } else {
                        td = $("<td></td>", {
                            'text': $('#tab_logic tr').length
                        }).appendTo($(tr));
                    }
                });


                // add the new row
                $(tr).appendTo($('#tab_logic'));

                $(tr).find("td button.row-remove").on("click", function() {
                    $(this).closest("tr").remove();
                });
            });

            //contact table
            $("#add_contact_row").on("click", function() {
                // Dynamic Rows Code
                // alert('hi there');
                // Get max row id and set new id
                var newid = 0;
                $.each($("#tab_contact tr"), function() {
                    if (parseInt($(this).data("id")) > newid) {
                        newid = parseInt($(this).data("id"));
                    }
                });
                newid++;

                var tr = $("<tr></tr>", {
                    id: "addrow" + newid,
                    "data-id": newid
                });

                // loop through each td and create new elements with name of newid
                $.each($("#tab_contact tbody tr:nth(0) td"), function() {
                    var td;
                    var cur_td = $(this);

                    var children = cur_td.children();

                    // add new td and element if it has a nane
                    if ($(this).data("name") !== undefined) {
                        td = $("<td></td>", {
                            "data-name": $(cur_td).data("name")
                        });

                        var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                        c.attr("name", $(cur_td).data("name[]"));
                        c.appendTo($(td));
                        td.appendTo($(tr));
                    } else {
                        td = $("<td></td>", {
                            'text': $('#tab_contact tr').length
                        }).appendTo($(tr));
                    }
                });


                // add the new row
                $(tr).appendTo($('#tab_contact'));

                $(tr).find("td button.row-remove").on("click", function() {
                    $(this).closest("tr").remove();
                });
            });


            var banks = {!! $banksJson !!}

            $(document).on("change", ".bank", function() {
                var selectedBank = $(this).val();
                var thisSelect = $(this);
                console.log(selectedBank);

                $.each(banks, function(key, value) {
                    console.log(value.name);
                    if (value.name === selectedBank) {
                        // alert(value.name);
                        var newOptions = [];
                        var branches = value.branches;
                        $.each(branches, function(branchKey, branchValue) {


                            //   newOptions["id"] = branchValue.id;
                            //   newOptions["name"] = branchValue.name;
                            var options = {
                                "id": branchValue.name,
                                "name": branchValue.name
                            }
                            // options.sort();

                            newOptions.push(options);

                        });
                        console.log(newOptions);
                        newOptions.sort(function(a, b) {
                            var textA = a.name.toUpperCase();
                            var textB = b.name.toUpperCase();
                            return (textA < textB) ? -1 : (textA > textB) ? 1 : 0;
                        });
                        var $el = thisSelect.closest('td').next('td').find('select');
                        $el.empty(); // remove old options
                        $.each(newOptions, function(optionKey, optionValue) {
                            $el.append($("<option></option>")
                                .attr("value", optionValue.name).text(optionValue.name));
                        });
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
