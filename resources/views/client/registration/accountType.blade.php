@extends('layouts.app')
@section('content')
    <div class="steps-registration">
        <div class="loader" id="loader" style="width: 3rem; height: 3rem;" role="status">
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card ">
                    @include('client.registration.common.registerHead')
                    <div id="msform">
                        @include('client.registration.common.sectionProgress')
                        <!-- fieldsets -->
                        <fieldset id="accountSection">
                            <form id="accTypeForm" method="POST" action="{{ route('registration.accountType') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @include('auth.register.accountType')
                                <input type="submit" id="btnJoint" name="next" class="next action-button"
                                    value="Save & Next" />
                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script>
        function toggleZoomScreen() {
            document.body.style.zoom = "20%";
        }
    </script>
    <script>
        $(document).ready(function() {

            $(".progress-bar")
                .css("width", "14%");
            //Adjusting Progress bar to proper length
            // if ("{{ $account_type }}" == 1) {
            //     $("#progressbar li")
            //         .css("width", "12%")
            // }

            //progress percentage
            //must be coded here..

            //loader
            var $loading = $('#loader').hide();
            $(document)
                .ajaxStart(function() {
                    $loading.show();
                })
                .ajaxStop(function() {
                    $loading.hide();
                });

            //Joint Holder Decision Make showing..
            $('#joint_authority_DIV').hide();
            $('#client_type').val("{{ $account_type ?? 1 }}");
            if ("{{ $account_type }}" == 2) {
                $("#joint_authority_DIV").show();
            } else {

                $("#joint_authority_DIV").hide();
            }
            $('#joint_permission').val("{{ $account->joint_permission ?? 0 }}")

            //accountType change function
            $('#client_type').change(function() {
                if ($(this).val() == 2) {
                    $('#joint_authority_DIV').show();
                } else {
                    $('#joint_authority_DIV').hide();
                }
            });
        });
    </script>
@endsection
