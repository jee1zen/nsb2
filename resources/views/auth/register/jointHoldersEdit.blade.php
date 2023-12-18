<div class="col-md-12">
    <div class="row">
        <div class="col-md-4">
            <label class="fieldlabels">Title </label>
            <select name="joint_title" id="joint_title" class="form-control" required>
                <option value="Mr.">Mr</option>
                <option value="Mrs.">Mrs</option>
                <option value="Miss.">Miss</option>
                <option value="Rev.">Rev</option>
                <option value="Dr.">Dr</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="fieldlabels">Name With Initials: * </label>
            <input type="text" name="joint_name" placeholder="Joint Holder Name" class="form-control joint_name"
                required />
        </div>
        <div class="col-md-4">
            <label class="fieldlabels">Name In Full : * </label>
            <input type="text" name="joint_name_initials" placeholder="Name by Intitials"
                class="form-control joint_name_by_initials" required />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="fieldlabels">Address Line 1 :*</label>
            <input type="text" name="joint_address_line_1" placeholder="Address Line 1"
                class="form-control joint_address_line_1" required />
        </div>
        <div class="col-md-6">
            <label class="fieldlabels">Address Line 2 :*</label>
            <input type="text" name="joint_address_line_2" placeholder="Address Line 2 "
                class="form-control joint_address_line_2" required />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="fieldlabels">Address Line 3 :*</label>
            <input type="text" name="joint_address_line_3" placeholder="Address Line 3 "
                class="form-control joint_address_line_3" />
        </div>
        <div class="col-md-6">
            <label class="fieldlabels">Email: *</label>
            <input type="text" id="joint_email" name="joint_email" placeholder="email" class="form-control joint_email" required />

        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="fieldlabels">Date Of Birth: *</label>
            <input type="text" id="joint_dob" name="joint_dob" placeholder="YYYY-MM-DD" class="form-control joint_dob" required />
        </div>
        <div class="col-md-6">
            <label class="fieldlabels">NIC/Passport: *</label>
            <input type="text" name="joint_nic"placeholder="nic" class="form-control joint_nic" required />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="fieldlabels">Nationality *</label>
            <select class="form-control joint_nationality" name="joint_nationality joint_nationality" required>
                <option value="Sri Lankan">Sri Lankan</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="col-md-6">
            <div class="joint_nationality_div">
                <label class="fieldlabels">Nationality *</label>
                <input type="text" name="joint_nationality_other"placeholder="Nationality"
                    class="form-control joint_nationality_other" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="fieldlabels">Land Phone: *</label>
            <input type="text" name="joint_telephone"placeholder="land line" class="form-control joint_telephone" />
        </div>
        <div class="col-md-6">
          
            <label class="fieldlabels">Mobile: *</label>
            <input type="tel" name="joint_mobile" id="joint_mobile" placeholder="mobile"
                class="form-control joint_mobile OTP" required />

            <input type="hidden" id="full_mobile" name="full_mobile" />
        </div>
    </div>
    <div class="joint_nic_div">
        <div class="row">
            <div class="col-md-6">
                <label class="fieldlabels">NIC Front Side: *</label>
                <input type="file" name="joint_nic_front" accept="image/*" class="imgLoad joint_nic_front">
                <img id="joint_nic_front" src="{{ asset('storage/images/nic_front_preview.jpg') }}"
                    class="img_preview" />
            </div>
            <div class="col-md-6">
                <label class="fieldlabels">NIC Back Side: *</label>
                <input type="file" name="joint_nic_back" accept="image/*" class="imgLoad joint_nic_back">
                <img id="joint_nic_back_preview" src="{{ asset('storage/images/nic_back_preview.jpg') }}"
                    class="img_preview" />
            </div>
        </div>
    </div>
    <div class="joint_passport_div">
        <div class="row">
            <div class="col-md-6">
                <label class="fieldlabels">Passport: *</label>
                <input type="file" name="joint_passport" accept="image/*" class="imgLoad joint_passport">
                <img id="joint_passport_preview" src="{{ asset('storage/images/nic_back_preview.jpg') }}"
                    class="img_preview" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="fieldlabels">Signature: *</label>
            <input type="file" name="joint_signature" accept="image/*" class="imgLoad joint_signature">
            <img id="joint_passport_preview" src="{{ asset('storage/images/signature_preview.png') }}"
                class="img_preview" />
        </div>
        <div class="col-md-6">
            <label class="fieldlabels">Profile picture </label>
            <input type="file" id="joint_profile_pic" name="joint_pro_pic" accept="image/*"
                class="imgLoad joint_pro_pic">
            <img id="signature_preview" src="{{ asset('storage/images/pro_pic.png') }}" class="img_preview" />
        </div>
    </div>
</div>
