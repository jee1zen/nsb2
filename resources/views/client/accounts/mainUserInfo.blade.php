@extends('layouts.app')

@section('content')
    <div class="steps-registration">
        <div class="loader" id="loader" style="width: 3rem; height: 3rem;" role="status">
            <p> Loading...</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card ">
                    @include('client.accounts.common.registerHead')
                    <div id="msform">
                        @include('client.accounts.common.sectionProgress')
                        <fieldset id="basicinfoSection">
                            <div class="form-card">
                                <form id="basicInfoForm" method="POST" action="{{ route('client.newAccountBasicInfo.save',$account_id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @include('auth.register.mainUserInfo')

                                    {{-- @if ($account->type == 2 && !$account->hasJointHolders())
                                        @include('auth.register.jointHolder')
                                    @elseif ($account->type == 2 && $account->hasJointHolders())
                                        @include('auth.register.jointHolderswithData')
                                    @endif --}}
                                    <input type="submit" id="btnBasicInfo" name="next" class="next action-button"
                                        value="Save & Next" />
                                    <a name="previous" class="previous action-button-previous"
                                        href="{{ route('registration.staging') }}">Back</a>
                                </form>
                                {{-- @include('auth.register.signature') --}}
                            </div>

                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Modal Mobile OTP -->
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

    <!-- Modal Existing User as Joint Holder -->
    <div class="modal fade" id="existingUser" tabindex="-1" role="dialog" aria-labelledby="existingUser"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Existing User As JointHolder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {{-- <form id="formVerifyOTP" method="POST" action="{{ route('otp.check') }}" enctype="multipart/form-data"> --}}
                        <label for="">Enter the Email Address of the Joint Party</label>
                        <label for="" id="emailLabel"></label>
                        <input type="text" class="form-control" id="existingjointEmail" name="existingjointEmail">
                        {{-- <input type="hidden" id="verify_email" name="verify_email" value=""> --}}
                        {{-- </form> --}}

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnExistingUserClose"
                        data-dismiss="modal">Close</button>
                    <button type="button" id="btnExistingSubmit" class="btn btn-primary">Submit</button>
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
    {{-- <script src="{{ asset('js/saveMyForm.jquery.min.js') }}"></script> --}}
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

            var accountType = "{{ $account_type }}";
            var $loading = $('#loader').hide();
            $(document)
                .ajaxStart(function() {
                    $loading.show();
                })
                .ajaxStop(function() {
                    $loading.hide();
                });

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

            $(".progress-bar")
                .css("width", "28%");
            console.log("{{ $client->corresponding_address_line_3 ?? 'nope' }}");

            $('#title').val("{{ $client->title ?? '' }}");
            $('#name').val("{{ $client->name ?? '' }}");
            $('#name_initials').val(
                "{{ $client->name_by_initials ?? '' }}");
            $('#nic').val("{{ $client->nic ?? '' }}");

            $('#dob').val("{{ $client->dob ?? '' }}");
            $('#address_line_1').val("{{ $client->address_line_1 ?? '' }}");
            $('#address_line_2').val("{{ $client->address_line_2 ?? '' }}");
            $('#address_line_3').val(
                "{{ $client->address_line_3 ?? '' }}");
            $('#corresponding_address_line_1').val(
                "{{ $client->correspondence_address_line_1 ?? '' }}");
            $('#corresponding_address_line_2').val(
                "{{ $client->correspondence_address_line_2 ?? '' }}");
            $('#corresponding_address_line_3').val(
                "{{ $client->correspondence_address_line_3 ?? '' }}");

            if (("{{ $client->address_line_1 ?? '' }}" ===
                    "{{ $client->correspondence_address_line_1 ?? '' }}") &&

                ("{{ $client->address_line_2 ?? '' }}" ===
                    "{{ $client->correspondence_address_line_2 ?? '' }}") &&
                ("{{ $client->address_line_3 ?? '' }}" === "{{ $client->correspondence_address_line_3 ?? '' }}")
            ) {

                if (("{{ $client->address_line_1 ?? '' }}" !==
                        "") &&

                    ("{{ $client->address_line_2 ?? '' }}" !==
                        "") &&
                    ("{{ $client->address_line_3 ?? '' }}" !==
                        "")
                ) {
                    $('#sameAsAddressCheck').attr("checked", "checked");
                    $('#billing_proof_div').hide();
                    $('#billing_proof').removeClass("fieldRequired");
                }
            } else {
                $('#sameAsAddressCheck').prop("checked", false);
                $('#billing_proof_div').show();
                $('#billing_proof').addClass("fieldRequired");
            }
            $('#telephone').val("{{ $client->telephone ?? '' }}");
            $('#benefactor').hide();

            console.log("the value is " + "{{ $client->id ?? '' }}");

            if ("{{ $client->id ?? '' }}" == null) {
                $('#nic_front').prop('required', true);
                $('#nic_back').prop('required', true);
                $('#signature').prop('required', true);
                $('#profile_pic').prop('required', true);
            } else {

                $('#nic_front').prop('required', false);
                $('#nic_back').prop('required', false);
                $('#signature').prop('required', false);
                $('#profile_pic').prop('required', false);
            }
            $('#btnAddExistingJoint').click(function(event) {
                event.preventDefault();
                $('#existingUser').modal('show');
            });
            $('#basicInfoForm').submit(function(e) {
                e.preventDefault();
                OTP();
            });

            //generate OTP and show form

            function OTP() {
                // var mobile = $(this).val();
                var mobile = $('#mobile').intlTelInput("getNumber");
                console.log("mobile", mobile);
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
                    beforeSend: function() {},
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
            }


            //check OTP
            $('#btnOtpSubmit').click(function() {

                let otpVerify = $('#mobileOTP').val();
                var mobile = $('#mobile').intlTelInput("getNumber");

                var data = {
                    "mobile": mobile,
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
                            submitForm("basicInfoForm");
                        } else {
                            alertify.error(
                                "The OTP You Entered Is Invalid, Please Try again");
                            OTP();

                        }

                    }
                });

            });

            //submitting main form
            function submitForm(formId) {
                // Get form element
                const form = document.getElementById(formId);
                let fullmobile = $('#mobile').intlTelInput("getNumber");
                $('#full_mobile').val(fullmobile);


                // Get form data
                const formData = new FormData(form);
                let token = $('meta[name="csrf-token"]').attr('content');
                // Send AJAX POST request
                $.ajax({
                    url: "{{ route('client.newAccountBasicInfo.save',$account_id) }}", // Replace with your actual route
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {
                        // Handle successful response
                        console.log(response);
                        if (accountType == 2) {
                            window.location.href = "{{ route('client.newAccountJointInfo',$account_id) }}";
                        } else {
                            window.location.href = "{{ route('client.newAccountEmpInfo',$account_id) }}";
                        }
                    },
                    error: function(error) {
                        // Handle error response
                        console.error(error);
                        alert("An error occurred while submitting the form.");
                    },
                });
            }


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

            // $('#btnStatement').hide();
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
                console.log("clicked");

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
            // $(".next").click(function() {
            //     // alert($(this).parent().attr('id'));
            //     $(this).prev('div').find('.fieldRequired').each(function() {

            //         if ($(this).val() === '') {
            //             var label = $(this).prev('.fieldlabels').text();

            //             alertify.error(`${label} cannot be Empty!`);

            //             isValid = false;

            //         } else {
            //             isValid = true;

            //         }
            //         return isValid;
            //     });
            //     // if($(this).attr('id')==='btnJoint'){


            //     // }

            //     if ($(this).attr('id') === 'btnBasicInfo') {





            //         isValidDate($('#dob').val(), 'Date of Birth');

            // if ($('#mobile').val() === '') {
            //     alertify.error(`mobile  cannot be Empty!`);
            //     isValid = false;
            //     return;
            // }

            // if($('#telephone').val()===''){
            //     alertify.error(`mobile  cannot be Empty!`);
            //     isValid=false;
            //     return;
            // }            


            // if ($('#email').val() === '') {
            //     alertify.error(`email  cannot be Empty!`);
            //     isValid = false;
            //     return;
            // }
            //     if ($('#address_line_1').val() === '') {
            //         alertify.error(`address line 1   cannot be Empty!`);
            //         isValid = false;
            //         return;
            //     }

            //     if ($('#address_line_2').val() === '') {
            //         alertify.error(`address line 2   cannot be Empty!`);
            //         isValid = false;
            //         return;
            //     }

            //     if ($('#nationality').val() === 'other') {

            //         if ($('#passport').val() === '') {
            //             alertify.error(`passport image cannot be Empty!`);
            //             isValid = false;
            //             return;

            //         }
            //         if ($('#other_nationality').val() === '') {
            //             alertify.error(`Nationailty  cannot be Empty!`);
            //             isValid = false;
            //             return;

            //         }
            //         if ($('#authorized_name').val() === '') {
            //             alertify.error(`Authorized Person Name cannot be Empty!`);
            //             isValid = false;
            //             return;

            //         }
            //         if ($('#authorized_address').val() === '') {
            //             alertify.error(`Authorized Person Address cannot be Empty!`);
            //             isValid = false;
            //             return;

            //         }
            //         if ($('#authorized_telephone').val() === '') {
            //             alertify.error(`Authorized Person Telephone cannot be Empty!`);
            //             isValid = false;
            //             return;

            //         }
            //         if ($('#authorized_nic').val() === '') {
            //             alertify.error(`Authorized Person NIC cannot be Empty!`);
            //             isValid = false;
            //             return;

            //         }
            //     } else {
            //         if ($('#nic_front').val() === '' && ("{{ $client->nic_front ?? '' }}" == null)) {
            //             alertify.error(`NIC front image cannot be Empty!`);
            //             isValid = false;
            //             return;

            //         }
            //         //   console.log('nic_filesize '+ $('#nic_front').files[0].size);
            //         if ($('#nic_back').val() === '' && ("{{ $client->nic_back ?? '' }}" == null)) {
            //             alertify.error(`NIC back image cannot be Empty!`);
            //             isValid = false;
            //             return;

            //         }
            //     }

            //     if ($('#signature').val() === '' && ("{{ $client->signature ?? '' }}" == null)) {
            //         alertify.error(`Signature cannot be Empty!`);
            //         isValid = false;
            //         return;

            //     }

            //     if ($('#profile_pic').val() === '' && ("{{ $client->signature ?? '' }}" == null)) {
            //         alertify.error(`Profile cannot be Empty!`);
            //         isValid = false;
            //         return;

            //     }

            //     if (ACtype == 2) {

            //         // $('.joint_name').each(function(){
            //         //         //if statement here 
            //         //         // use $(this) to reference the current div in the loop
            //         //         //you can try something like...
            //         //         if($(this).val()===""){
            //         //             alertify.error(`Joint Holder Name Cannot be Empty`);


            //         //         isValid=false;
            //         //         return false

            //         //         }
            //         //         if(isValid){
            //         //             return true
            //         //         }else{
            //         //             return false
            //         //         }



            //         //     });

            //         if ($('.joint_name').val() === "") {
            //             alertify.error(`Joint Holder Name Cannot be Empty`);
            //             isValid = false;
            //             return;
            //         }
            //         if ($('.joint_name_by_initials').val() === "") {
            //             alertify.error(`Joint Holder Name By Initials Cannot be Empty`);
            //             isValid = false;
            //             return;
            //         }
            //         if ($('.joint_address_line_1').val() === "") {
            //             alertify.error(`Joint Holder Address Line 1  Cannot be Empty`);
            //             isValid = false;
            //             return;
            //         }
            //         if ($('.joint_address_line_2').val() === "") {
            //             alertify.error(`Joint Holder Address Line 2 Cannot be Empty`);
            //             isValid = false;
            //             return;
            //         }
            //         if ($('.joint_email').val() === "") {
            //             alertify.error(`Joint Holder Email  Cannot be Empty`);
            //             isValid = false;
            //             return;
            //         }

            //         if ($('.joint_email').val() === $('#email').val()) {

            //             alertify.error(`Joint Holder Email Cannot Be Same As Main Holder Email`);
            //             isValid = false;
            //             return;


            //         }

            //         if ($('.joint_dob').val() === "") {
            //             alertify.error(`Joint Holder Date of Birth  Cannot be Empty`);
            //             isValid = false;
            //             return;
            //         }
            //         if ($('.joint_nic').val() === "") {
            //             alertify.error(`Joint Holder NIC/Passport  Cannot be Empty`);
            //             isValid = false;
            //             return;
            //         }
            //         if ($('.joint_mobile').val() === "") {
            //             alertify.error(`Joint Holder Mobile  Cannot be Empty`);
            //             isValid = false;
            //             return;
            //         }

            //         if ($('.joint_signature').val() === "") {
            //             alertify.error(`Joint Holder Signature  Cannot be Empty`);
            //             isValid = false;
            //             return;

            //         }
            //         if ($('.joint_pro_pic').val() === "") {
            //             alertify.error(`Joint Holder Profile Picture  Cannot be Empty`);
            //             isValid = false;
            //             return;

            //         }

            //         if ($('.joint_nationality').val() === "other") {
            //             if ($('.joint_passport').val() === "") {
            //                 alertify.error(`Joint Holder passport must be uploaded`);
            //                 isValid = false;
            //                 return;
            //             }
            //             if ($('.joint_nationality_other').val() === "") {
            //                 alertify.error(`Joint Holder Nationality Must be Mentioned`);
            //                 isValid = false;
            //                 return;
            //             }

            //         } else {
            //             if ($('.joint_nic_front').val() === "") {
            //                 alertify.error(`Joint NIC front image should be uploaded`);
            //                 isValid = false;
            //                 return;
            //             }
            //             if ($('.joint_nic_back').val() === "") {
            //                 alertify.error(`Joint Holder NIC back image should be uploaded`);
            //                 isValid = false;
            //                 return;
            //             }

            //         }

            //     }

            //     //   return isValid=false;   


            //     //setting full mobile values..
            //     let _telInput = $(".OTP");
            //     _telInput.each(function() {

            //         let fullmobile = $(this).intlTelInput("getNumber");

            //         $(this).parents('div').prev().prev().val(fullmobile);
            //     });

            //     // //email verification          
            //     // if (!isValidEmailAddress($('#email').val())) {
            //     //     alertify.error(`Invalid Email Address`);

            //     //     isValid = false;
            //     // } else {

            //     //     var email_temp = $('#email').val();
            //     //     var data = {
            //     //         "email": email_temp,
            //     //         "_token": "{{ csrf_token() }}"
            //     //     }; //data to send to server
            //     //     var dataType = "json" //expected datatype from server
            //     //     //  let watchID = 0;
            //     //     var request = $.post({
            //     //         url: "{{ route('user.email.validation') }}", //url of the server which stores time data
            //     //         data: data,
            //     //         async: false,
            //     //         cache: false,
            //     //         timeout: 30000,

            //     //         success: function(data) {

            //     //             // alert(data.state);
            //     //             if (data.state === false) {
            //     //                 isValid = false;
            //     //                 alertify.error(`This Email Already Exists In NSB FMC`);
            //     //                 //    alert("email already exists in nSB FMc");
            //     //             } else {
            //     //                 isValid = true;


            //     //             }
            //     //         }
            //     //     });


            //     // }

            //     //generate OTP

            //     if (isValid) {
            //         OTP();
            //     }


            // }




            //     if ($(this).attr('id') === 'btnOther') {
            //         isValid = true;
            //     }
            //     if ($(this).attr('id') === 'btnStatement') {
            //         isValid = true;
            //     }


            //     current_fs = $(this).parent();
            //     if (current_fs.attr('id') === 'basicinfoSection' && ACtype == 3) {
            //         next_fs = $(this).parent().next().next();

            //     } else if ((current_fs.attr('id') === 'empinfoSection' && ACtype == 2) || (current_fs
            //             .attr('id') === 'empinfoSection' && ACtype == "Indivitual")) {
            //         next_fs = $(this).parent().next().next();


            //     } else {


            //         next_fs = $(this).parent().next();
            //     }

            //     if (isValid) {
            //         console.log("came here at isvaild");


            //         $('#basicInfoForm').submit();
            //     }
            // });


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
