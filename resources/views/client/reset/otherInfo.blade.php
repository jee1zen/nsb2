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
                        <fieldset id="otherdetailsSection">
                            <form id="basicInfoForm" method="POST" action="{{ route('client.resetAccountOtherInfo.save',$account_id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @include('auth.register.otherInfo')
                                <input type="submit" id="btnOther" name="next" class="next action-button"
                                    value="Save & Next" />
                                <a name="previous" class="previous action-button-previous"
                                    href="{{ route('client.resetAccountBank',$account_id) }}">Back</a>
                            </form>
                        </fieldset>
                    </div>
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
    <script>
        function toggleZoomScreen() {
            document.body.style.zoom = "20%";
        }
    </script>
    <script>
        $(document).ready(function() {


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

          


            $(".progress-bar")
                .css("width", "70%");


            $('#benefactor').hide();

            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
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

        
        });
    </script>
@endsection
