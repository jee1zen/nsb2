<div class="form-card" id="AccountDiv">
    <div class="row">
        <div class="col-7">
            <h2 class="fs-title">Identification</h2>
        </div>
        <div class="col-5">
            <h2 class="steps">Step 2 - 7</h2>
        </div>
    </div>

    <label class="fieldlabels">Email </label>
    <input type="email" id="email" name="email" placeholder=""
        class="fieldRequired {{ $errors->has('email') ? ' is-invalid' : '' }}" />
    @if ($errors->has('email'))
        <div class="invalid-feedback">
            {{ $errors->first('email') }}
        </div>
    @endif
    <label class="fieldlabels">NIC/Passport</label>
    <input type="text" name="nic"placeholder="" class="fieldRequired" />
</div>
