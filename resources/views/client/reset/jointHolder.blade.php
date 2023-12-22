@extends('layouts.app')
@section('content')
    <div class="steps-registration">
        <div class="loader" id="loader" style="width: 3rem; height: 3rem;" role="status">
            <p> Loading...</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card ">
                    @include('client.reset.common.registerHead')
                    <div id="msform">
                        @include('client.reset.common.sectionProgress')
                        <fieldset id="basicinfoSection">
                            <div class="form-card">
                                <h4>Add Joint Holders</h4>

                                <button class="btn btn-danger btn-md" id="add_new"><i class="fas fa-plus-circle"></i>Add
                                    New Joint Holder</button>
                                <button class="btn btn-success btn-md" id="add_existing"><i
                                        class="fas fa-plus-circle"></i>Add Existing User</button>
                                @include('auth.register.jointHolderswithData')

                                {{-- @include('auth.register.signature') --}}
                            </div>
                            <a type="submit" id="jontinfoNext" name="next" class="next action-button"
                                href="{{ route('client.resetAccountEmpInfo',$account_id) }}"> Next</a>
                            <a name="previous" class="previous action-button-previous"
                                href="{{ route('client.newAccountBasicInfo',$account_id) }}">Back</a>
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
                        <label for="">Enter the OTP sent to Joint Holders Mobile Number</label>
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

    <!-- Modal Mobile For Existing  OTP -->
    <div class="modal fade" id="existingMobileOTPModal" tabindex="-1" role="dialog"
        aria-labelledby="existingMobileOTPModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Mobile OTP verification of Existing User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {{-- <form id="formVerifyOTP" method="POST" action="{{ route('otp.check') }}" enctype="multipart/form-data"> --}}
                        <label for="">Enter the OTP sent to Joint Holders Mobile Number</label>
                        <label for="" id="exMobileNumber"></label>
                        <input type="text" id="existingMobileOTP" name="existingMobileOTP">
                        <input type="hidden" id="existingVerifyMobile">

                        {{-- </form> --}}

                        <button class="btn btn-primary">Resend</button>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnExistingOtpSubmit" class="btn btn-primary">Submit</button>
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

    <!-- Modal New User as Joint Holder -->
    <div class="modal fade " id="newUserModal" role="dialog" aria-labelledby="newUserModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="jointform" method="POST" action="{{ route('client.resetAccountJointInfo.save',$account_id) }}"
                enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Joint Holder</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('auth.register.jointHolder')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btnNewModalClose"
                            data-dismiss="modal">Close</button>
                        <button type="submit" id="btnNewSubmit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Existing User as Joint Holder -->
    <div class="modal fade" id="existingUserModal" tabindex="-1" role="dialog" aria-labelledby="existingUserModal"
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script> --}}

    <script>
        function toggleZoomScreen() {
            document.body.style.zoom = "20%";
        }
    </script>
    <script>
        $(document).ready(function() {
            var $loading = $('#loader').hide();
            var existingEmail = "";
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
                .css("width", "42%");



            $('#benefactor').hide();


            //adding exsiting use as joint holder..

            $('#add_existing').click(function(event) {
                event.preventDefault();

                $('#existingUserModal').modal('show');

            });


            


            $('.btnJointRemove').click(function() {
                let id = $(this).prev().val();
                let jointName = $(this).prev().prev().val();

                Swal.fire({
                        title: "Are you sure?",
                        text: "Remove This JointHolder "+jointName +" ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText:"Yes",
                        cancelButtonText: "No",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }).then(function(result) {
                        if (result.value) {
                            var data = {
                                        "id": id,
                                        "_token": "{{ csrf_token() }}"
                                    }; //data to send to server
                                    var dataType = "json" //expected datatype from server
                                    //   $('#loader').show();
                                        $.post({
                                            url: "{{ route('client.jointInfo.delete',$account_id) }}", //url of the server which stores time data
                                            data: data,
                                            beforeSend: function() {

                                            },
                                            success: function(data) {
                                                if (data.success) {
                                                    Swal.fire("Removed!", jointName+" - Joint Holder Has Been Removed!", "success");
                                                    window.location.reload();
                                                
                                                } else {
                                                    swal("Error", "Cannot Delete", "error");
                                                }
                                            },
                                        });
                        
                        } else if (result.dismiss === "cancel") {
                      
                        }
                        });
                });

               

                $('.btnJointEdit').on('click', function() {
                    let buttonId = $(this).attr('id');
                        // Extract the part after "-"
                    let modalIdSuffix = buttonId.substring(buttonId.indexOf('-') + 1);

                    let jointHolderInformationArray =  JSON.parse('{!! json_encode($jointHolders ?? '') !!}');
                  
                    // console.log('email is',jointEmail)
                    console.log(jointHolderInformationArray);

                    let  filteredData = jointHolderInformationArray.filter(holder => holder.id == modalIdSuffix);
                   let jointHolderData = filteredData[0];
                 
                 //loading data
                    $('#joint_title').val(jointHolderData.title);
                    $('#joint_name').val(jointHolderData.name);
                    $('#joint_name_initials').val(jointHolderData.name_by_initials);
                    $('#joint_address_line_1').val(jointHolderData.address_line_1);
                    $('#joint_address_line_2').val(jointHolderData.address_line_2);
                    $('#joint_address_line_3').val(jointHolderData.address_line_3);
                     $('#joint_email').val(jointHolderData.user.email);
                    $('#joint_dob').val(jointHolderData.dob);
                    $('#joint_nic').val(jointHolderData.nic);
                    $('#joint_nationality').val(jointHolderData.nationality);
                    $('#joint_telephone').val(jointHolderData.telephone);
                    $('#joint_nic_front_preview').attr("src","{{asset('storage/uploads/')}}/"+jointHolderData.nic_front);
                    $('#joint_nic_back_preview').attr("src","{{asset('storage/uploads/')}}/"+jointHolderData.nic_back);
                    $('#joint_passport_preview').attr("src","{{asset('storage/uploads/')}}/"+jointHolderData.passport);
                    $('#joint_signature_preview').attr("src","{{asset('storage/uploads/')}}/"+jointHolderData.signature);
                    $('#pro_pic_preview').attr("src","{{asset('storage/uploads/')}}/"+jointHolderData.pro_pic);
                    //show Modal
                    $('#newUserModal').modal('show');

                
                   
                });




            //submitting exising user
            $('#btnExistingSubmit').click(function(event) {
                existingEmail = $('#existingjointEmail').val();
                if (existingEmail === "") {
                    alertify.error(
                        'The Email You Entered Is Invaid, Please Enter A proper Email Address!'
                    );
                } else {
                    otpForExisting();
                }
            });

            function otpForExisting() {
                var data = {
                    "existingjointEmail": existingEmail,
                    "_token": "{{ csrf_token() }}"
                }; //data to send to server
                var dataType = "json" //expected datatype from server
                //   $('#loader').show();
                $.post({
                    url: "{{ route('registration.checkJointUser') }}", //url of the server which stores time data
                    data: data,
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if (data.success) {
                            $('#existingUserModal').modal('hide');
                            $('#exMobileNumber').text(data.mobile);
                            $('#existingVerifyMobile').val(data.mobile);
                            $('#existingMobileOTPModal').modal('show');
                        } else {
                            alertify.error(
                                'The Email You Entered Does Not Exists in NSB FMC , Please Re-Enter the Email'
                            );
                        }
                    },
                });
            }

            $('#btnExistingOtpSubmit').click(function() {
                console.log("clicked here");

                let otpVerify = $('#existingMobileOTP').val();
                var mobile = $('#existingVerifyMobile').val();
                console.log("mobile value " + mobile);

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
                            existingUserAdd();
                        } else {
                            alertify.error(
                                "The OTP You Entered Is Invalid, Please Try again");
                            otpForExisting();
                        }
                    }
                });
            });

            function existingUserAdd() {

                var data = {
                    "existingjointEmail": existingEmail,
                    "_token": "{{ csrf_token() }}"
                }; //data to send to server
                var dataType = "json" //expected datatype from server
                //   $('#loader').show();
                $.post({
                    url: "{{ route('client.resetAddExistingUser',$account->id) }}", //url of the server which stores time data
                    data: data,
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alertify.error(
                                'Cannot add User Please Try Again!'
                            );
                        }
                    },
                });
            }

            $('#add_new').click(function(event) {
                event.preventDefault();


                   $('#joint_title').val("");
                    $('#joint_name').val("");
                    $('#joint_name_initials').val("");
                    $('#joint_address_line_1').val("");
                    $('#joint_address_line_2').val("");
                    $('#joint_address_line_3').val("");
                    $('#joint_email').val("");
                    $('#joint_dob').val("");
                    $('#joint_nic').val("");
                    $('#joint_nationality').val("");
                    $('#joint_telephone').val("");
                    $('#joint_nic_front_preview').attr("src","{{asset('storage/images/nic_front_preview.jpg')}}");
                    $('#joint_nic_back_preview').attr("src","{{asset('storage/images/nic_back_preview.jpg')}}");
                    $('#joint_passport_preview').attr("src","{{asset('storage/images/nic_back_preview.jpg')}}");
                    $('#joint_signature_preview').attr("src","{{asset('storage/images/signature_preview.png')}}");
                    $('#pro_pic_preview').attr("src","{{asset('storage/images/pro_pic.png')}}");



                $('#newUserModal').modal('show');

            });

            $('#btnNewModalClose').click(function(event) {
                $('#newUserModal').modal('hide');
            });

            $('#jointform').submit(function(e) {
                e.preventDefault();
                $('#newUserModal').modal('hide');
                OTP();
            });


            function OTP() {
                // var mobile = $(this).val();
                var mobile = $('#joint_mobile').intlTelInput("getNumber");
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


            //when mobile otp entered and proceed
            $('#btnOtpSubmit').click(function() {
                let otpVerify = $('#mobileOTP').val();
                var mobile = $('#joint_mobile').intlTelInput("getNumber");

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
                            // submitForm("basicInfoForm");
                            $('#mobileOTPModal').modal('hide');
                            emailOTP();

                        } else {
                            alertify.error(
                                "The OTP You Entered Is Invalid, Please Try again");
                            OTP();

                        }

                    }
                });

            });





            //

            //generate OTP and show form
            function emailOTP() {
                var email = $('#joint_email').val();
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
                        } else {
                            alertify.error(
                                'OTP generating Error, please check the Mobile number You entered,Check whether it is in correct format'
                            );
                        }
                    }
                });
            }
            //check OTP


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
                            $('#emailOTPModal').modal('hide');
                            submitForm("jointform");
                        } else {
                            alertify.error(
                                "The OTP You Entered Is Invalid, Please Try again");
                            emailOTP();

                        }


                    }
                });

            });

            //submitting main form
            function submitForm(formId) {
                // Get form element
                const form = document.getElementById(formId);
                let fullmobile = $('#joint_mobile').intlTelInput("getNumber");
                $('#full_mobile').val(fullmobile);
                // Get form data
                const formData = new FormData(form);
                let token = $('meta[name="csrf-token"]').attr('content');
                // Send AJAX POST request
                $.ajax({
                    url: "{{ route('client.resetAccountJointInfo.save',$account_id) }}", // Replace with your actual route
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
                        location.reload();

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

            $('#joint_dob').mask('0000-00-00');
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
            // setProgressBar(current);
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

            //accept to continue
            $('#acceptCheck').click(function() {
                if ($(this).is(':checked')) {
                    $('#btnStatement').show();
                } else {

                    $('#btnStatement').hide();
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


            $(document).on("blur", ".joint_email", function() {
                // alert("Email checking now....");

            });

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
        });
    </script>
@endsection
