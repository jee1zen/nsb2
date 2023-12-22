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
                            <fieldset id="bankparticularSection">
                                @include('auth.register.bankparticulars')
                                <a id="btnBank" name="next" class="next action-button" value="Next"
                                    href="{{ route('client.resetAccountOtherInfo',$account_id) }}">Next</a>
                                <a name="previous" class="previous action-button-previous"
                                    href="{{ route('client.resetAccountEmpInfo',$account_id) }}">Back</a>
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
                    <form id="formParticularSubmit" method="POST" action="{{ route('client.resetAccountBank.save',$account_id) }}"
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
