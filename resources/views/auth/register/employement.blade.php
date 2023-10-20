<div class="form-card">
    <div class="row">
        <div class="col-7">
            <h2 class="fs-title">Employment Info:</h2>
        </div>
        <div class="col-5">
            <h2 class="steps">Step 4 - 7</h2>
        </div>
    </div>
    <div id="empInfoMainuserDIV">
        <div class="row">
            <div class="col-md-6">
                <label class="fieldlabels">Occupation: *</label>
                <input type="text" name="emp_occupation" id="emp_occupation" placeholder="" class=""
                    value="{{ $client->employmentDetails->occupation ?? '' }}" />
            </div>
            <div class="col-md-6">
                <label class="fieldlabels">Company Name:*</label>
                <input type="text" name="emp_company_name" placeholder="" class=""
                    value="{{ $client->employmentDetails->company_name ?? '' }}" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="fieldlabels">Company Address: *</label>
                <input type="text" name="emp_company_address" placeholder="" class=""
                    value="{{ $client->employmentDetails->company_address ?? '' }}" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="fieldlabels">Company Telephone: *</label>
                <input type="text" name="emp_company_telephone" placeholder="" class=""
                    value="{{ $client->employmentDetails->telephone ?? '' }}" />
            </div>
            <div class="col-md-6">
                <label class="fieldlabels">Fax: *</label>
                <input type="text" name="emp_fax" placeholder="Fax" class=""
                    value="{{ $client->employmentDetails->fax ?? '' }}" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="fieldlabels">Nature Of Business: *</label>
                <input type="text" name="emp_nature" placeholder="" class=""
                    value="{{ $client->employmentDetails->nature ?? '' }}" />
            </div>
        </div>
    </div>

    @if ($account->type == 2 && $account->hasJointHolders())

        <div id="jointEmpInfoDIV">
            <div id="dynamic_emp">

                @foreach ($account->jointHolders()->get() as $key => $jointHolder)
                    <input type="hidden" name="jointHolder_emp_id[]" value="{{ $jointHolder->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <h3> Joint Holder {{ $key + 1 }} ( {{ $jointHolder->name }} ) Employement Info </h3>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="fieldlabels">Occupation: *</label>
                            <input type="text" name="joint_emp_occupation[]" id="joint_emp_occupation[]"
                                placeholder="" class="" value="{{ $jointHolder->occupation }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="fieldlabels">Company Name:*</label>
                            <input type="text" name="joint_emp_company_name[]" placeholder="" class=""
                                value="{{ $jointHolder->company_name }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="fieldlabels">Company Address: *</label>
                            <input type="text" name="joint_emp_company_address[]" placeholder="" class=""
                                value="{{ $jointHolder->company_address }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="fieldlabels">Company Telephone: *</label>
                            <input type="text" name="joint_emp_company_telephone[]" placeholder="" class=""
                                value="{{ $jointHolder->company_telephone }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="fieldlabels">Fax: *</label>
                            <input type="text" name="joint_emp_fax[]" placeholder="Fax" class=""
                                value="{{ $jointHolder->company_fax }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="fieldlabels">Nature Of Business: *</label>
                            <input type="text" name="joint_emp_nature[]" placeholder="" class=""
                                value="{{ $jointHolder->company_nature }}" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @endif


</div>
