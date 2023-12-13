<div class="form-card">
    <div class="row">
        <div class="col-md-7">
            <h2 class="fs-title">Investment & Account Type:</h2>
        </div>
        <div class="col-md-5">
            @if ($account_type == 1)
                <h2 class="steps">Step 1- 7</h2>
            @else
                <h2 class="steps">Step 1- 8</h2>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="fieldlabels">Account Type: *</label>
            <select name="client_type" id="client_type" class="form-control">
                <option value="1"> Individual</option>
                <option value="2"> Joint</option>
                {{-- <option value="3"> Institute</option> --}}
            </select>
        </div>
    </div>
    <div class="row">
    </div>
    <div class="row">
        <div class="col-md-6">
            <div id="joint_authority_DIV">
                <label class="fieldlabels">Joint Account Authority: *</label>
                <select name="joint_permission" id="joint_permission" class="form-control">
                    <option value="0"> Either Of Parties Taking Actions
                        Indipendantly </option>
                    <option value="1"> Take Actions After Accepting From All The Joint Holders </option>
                </select>
            </div>

        </div>
    </div>
</div>
