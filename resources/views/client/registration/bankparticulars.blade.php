@extends('layouts.app')

@section('content')



    <div class="steps-registration">
        <div class="loader" id="loader" style="width: 3rem; height: 3rem;" role="status">
            <p> Loading...</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card ">
                    @include('client.registration.common.registerHead')
                    <div id="msform">
                        @include('client.registration.common.sectionProgress')
                     
                          
                            <fieldset id="bankparticularSection">
                                @include('auth.register.bankparticulars')
                                <a id="btnBank" name="next" class="next action-button" value="Next"
                                    href="{{ route('registration.otherInfo') }}">Next</a>
                                <a name="previous" class="previous action-button-previous"
                                    href="{{ route('registration.empInfo') }}">Back</a>
                            </fieldset>
                       

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addBankParticularModal" tabindex="-1" aria-labelledby="addBankParticularModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBankParticularModalLabel">Add Bank Particular</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formParticularSubmit" method="POST" action="{{ route('registration.bank.save') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="accountType" class="form-label">A/C Type</label>
                            <select name="accountType" id="accountType" class="form-control" required>
                                <option value="">Select</option>
                                <option value="Individual">Individual</option>
                                <option value="Joint">Joint</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="holdersName" class="form-label">Holders Name</label>
                            <input type="text" name="holder_name" class="form-control" id="holdersName"
                                placeholder="Enter holders name" required>
                        </div>
                        <div class="mb-3">
                            <label for="bankName" class="form-label">Bank Name</label>
                            <select name="bank_name" id="bank_name" type="text"
                                class="form-control @error('bank_name') is-invalid @enderror" required>
                                <option value="0">Select Bank</option>
                                @if ($banks)
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->name }}">{{ $bank->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('bank_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="branch" class="form-label">Branch</label>
                            <select name="branch" id="branch" type="text"
                                class="form-control @error('branch') is-invalid @enderror" required>
                            </select>
                            @error('branch')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="accountNo" class="form-label">Account No</label>
                            <input type="text" class="form-control" id="accountNo" name="accountNo"
                                placeholder="Enter account number" required>
                        </div>
                        <div class="mb-3">
                            <label for="passbook" class="form-label">PassBook</label>
                            <input type="file" class="form-control" id="passbook" name="passbook">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnBankModalClose" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btnBankFormSubmit" class="btn btn-primary">Save</button>
                </div>
            @endsection
            @section('scripts')
                @parent
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
                <script src="{{ asset('js/saveMyForm.jquery.min.js') }}"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput-jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>


                {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script> --}}

                <script>
                    function toggleZoomScreen() {
                        document.body.style.zoom = "20%";
                    }
                </script>
                <script>
                    $(document).ready(function() {
                        var banks = {!! $banksJson !!}

                        $(document).on("change", "#bank_name", function() {
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
                                            "id": branchValue.id,
                                            "name": branchValue.name
                                        }
                                        newOptions.push(options);

                                    });
                                    console.log(newOptions);
                                    var $el = $('#branch');
                                    $el.empty(); // remove old options
                                    $.each(newOptions, function(optionKey, optionValue) {
                                        $el.append($("<option></option>")
                                            .attr("value", optionValue.name).text(optionValue.name));
                                    });
                                }

                            });

                        });

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
                            .css("width", "56%");


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

                        $('#btnAddBankParticular').click(function() {
                            $('#addBankParticularModal').modal('show');
                        });

                        $('#btnBankModalClose').click(function() {
                            $('#addBankParticularModal').modal('hide');
                        });

                        $("#btnBankFormSubmit").validate({
                            rules: {
                                accountType: {
                                    required: true,
                                    messages: {
                                        required: "Please Select An Account Type"
                                    }
                                },
                                holder_name: {
                                    required: true,
                                    messages: {
                                        required: "Please Enter Account Holders' Name"
                                    }
                                },

                                bank_name: {
                                    required: true,
                                    messages: {
                                        required: "Please Select A Bank"
                                    }

                                },
                                branch: {
                                    required: true,
                                    messages: {
                                        required: "Please Select A Branch"
                                    }

                                }


                            }
                        });

                        $('#btnBankFormSubmit').click(function() {

                            if ($('#formParticularSubmit').validate().valid()) {
                                $("#formParticularSubmit").submit();
                            }


                        });






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


                            // current_fs = $(this).parent();
                            // if (current_fs.attr('id') === 'basicinfoSection' && ACtype == 3) {
                            //     next_fs = $(this).parent().next().next();

                            // } else if ((current_fs.attr('id') === 'empinfoSection' && ACtype == 2) || (current_fs
                            //         .attr('id') === 'empinfoSection' && ACtype == "Indivitual")) {
                            //     next_fs = $(this).parent().next().next();


                            // } else {


                            //     // next_fs = $(this).parent().next();
                            // }

                            if (isValid) {
                                //Add Class Active
                                $('#bankForm').submit();

                            }
                        });



                        // function setProgressBar(curStep) {
                        //     var percent = parseFloat(100 / steps) * curStep;
                        //     percent = percent.toFixed();
                        //     $(".progress-bar")
                        //         .css("width", percent + "%")
                        // }


                        if (ACtype == 1 || ACtype == 2) {
                            var newOptions = {
                                "Select": "Select",
                                "Individual": "Individual",
                                "Joint": "Joint",
                            };

                            var $el = $(".accountType");
                            $el.empty(); // remove old options
                            $.each(newOptions, function(key, value) {
                                $el.append($("<option></option>")
                                    .attr("value", value).text(key));
                            });

                        }

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
                                "{{ asset('storage/images/nic_front_preview.jpg') }}" +
                                '" class="img_preview" />' +
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
                                "{{ asset('storage/images/signature_preview.png') }}" +
                                '" class="img_preview" />' +
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
                            var html_bene = '<div id="natural_append_no_' + i3 +
                                '" class="animated bounceInLeft">' +
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
                                "{{ asset('storage/images/signature_preview.png') }}" +
                                '" class="img_preview" />' +
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
