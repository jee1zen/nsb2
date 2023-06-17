<div class="modal fade" id="mobileOTPModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <label for="" >Enter the OTP sent to Your Mobile Number</label>
                <label for="" id="mobileNumberLabel"></label>
                <input type="text" id="mobileOTP" name="mobileOTP">
                <input type="hidden" id="verify_mobile" name="verify_mobile" value="0">
                <input type="hidden" id="done" value="0">
                {{-- </form> --}}

                {{-- <button class="btn btn-primary">Resend</button> --}}

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="btnOtpSubmit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
</div>