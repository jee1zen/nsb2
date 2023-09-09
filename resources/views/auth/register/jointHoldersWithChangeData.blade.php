<div id="jointHoldersDiv">
    <hr />
    @if (!empty($jointHolders))
        @php
            $count = 0;
        @endphp
        <div id="dynamic_container">
            @foreach ($jointHolders as $jointHolder)
                @php
                    
                    $count = $count + 1;
                @endphp
                <div id="append_no_{{ $count }}" class="animated bounceInLeft">
                    <hr />
                    <h2> Joint Holder {{ $count }} info </h2>
                    <input type="hidden" name="jointHolder_info_id[]" value="{{ $jointHolder->id }}">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="input-group">
                                <label class="fieldlabels">Title </label>
                                <select name="joint_title[]" id="joint_title[]" class="field Required">
                                    <option value="Mr." {{ $jointHolder->title == 'Mr.' ? 'selected' : '' }}>Mr
                                    </option>
                                    <option value="Mrs." {{ $jointHolder->title == 'Mrs.' ? 'selected' : '' }}>Mrs
                                    </option>
                                    <option value="Miss."{{ $jointHolder->title == 'Miss.' ? 'selected' : '' }}>Miss
                                    </option>
                                    <option value="Rev." {{ $jointHolder->title == 'Rev.' ? 'selected' : '' }}>Rev
                                    </option>
                                    <option value="Dr."{{ $jointHolder->title == 'Dr.' ? 'selected' : '' }}>Dr
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="fieldlabels">Name With Initials: * </label>
                            <input type="text" name="joint_name[]" placeholder="Joint Holder Name"
                                class="form-control" value="{{ $jointHolder->name }}" />
                        </div>
                        <div class="col-md-4">
                            <label class="fieldlabels">Name In Full : * </label>
                            <input type="text" name="joint_name_initials[]" placeholder="Name by Intitials"
                                class="form-control" value="{{ $jointHolder->name_by_initials }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="fieldlabels">Address Line 1 :*</label>
                            <input type="text" name="joint_address_line_1[]" placeholder="Address Line 1"
                                class="form-control" value="{{ $jointHolder->address_line_1 }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="fieldlabels">Address Line 2 :*</label>
                            <input type="text" name="joint_address_line_2[]" placeholder="Address Line 2 "
                                class="form-control" value="{{ $jointHolder->address_line_2 }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="fieldlabels">Address Line 3 :*</label>
                            <input type="text" name="joint_address_line_3[]" placeholder="Address Line 3 "
                                class="form-control" value="{{ $jointHolder->address_line_3 }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="fieldlabels">Email: *</label>
                            <input type="text" name="joint_email[]"placeholder="email"
                                class="form-control joint_email" value="{{ $jointHolder->email }}" />
                            <input type="hidden" value="">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="fieldlabels">Date Of Birth: *</label>
                            <input type="text" name="joint_dob[]" placeholder="YYYY-MM-DD"
                                class="form-control jointDob" value="{{ $jointHolder->dob }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="fieldlabels">NIC/Passport: *</label>
                            <input type="text" name="joint_nic[]"placeholder="nic" class="form-control"
                                value="{{ $jointHolder->nic }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="fieldlabels">Nationality *</label>
                            <select class="joint_nationality" name="joint_nationality[]">
                                <option value="Sri Lankan"
                                    {{ $jointHolder->nationality == 'Sri Lankan' ? 'select' : '' }}>
                                    Sri Lankan</option>
                                <option value="other" {{ $jointHolder->nationality != 'Sri Lankan' ? 'select' : '' }}>
                                    Other
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="joint_nationality_div">
                                <label class="fieldlabels">Nationality *</label>
                                <input type="text" name="joint_nationality_other[]"placeholder="Nationality"
                                    class="form-control" value="{{ $jointHolder->nationality }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="fieldlabels">Land Phone: *</label>
                            <input type="text" name="joint_telephone[]"placeholder="land line" class="form-control"
                                value="{{ $jointHolder->telephone }}" />
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" name="full_joint_mobile[]" />
                            <label class="fieldlabels">Mobile: *</label>
                            <input type="tel" name="joint_mobile[]" placeholder="mobile"
                                class="form-control joint_mobile OTP" />
                            <input type="hidden" value="">
                        </div>
                    </div>
                    <div class="joint_nic_div">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fieldlabels">NIC Front Side: *</label>
                                <input type="file" name="joint_nic_front[]" accept="image/*" class="imgLoad">
                                <img id="joint_nic_front"
                                    src="{{ asset('storage/uploads/' . $jointHolder->nic_front) }}"
                                    class="img_preview" />
                            </div>
                            <div class="col-md-6">
                                <label class="fieldlabels">NIC Back Side: *</label>
                                <input type="file" name="joint_nic_back[]" accept="image/*" class="imgLoad">
                                <img id="joint_nic_back_preview"
                                    src="{{ asset('storage/uploads/' . $jointHolder->nic_back) }}"
                                    class="img_preview" />
                            </div>
                        </div>
                    </div>
                    <div class="joint_passport_div">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fieldlabels">Passport: *</label>
                                <input type="file" name="joint_passport[]" accept="image/*" class="imgLoad">
                                <img id="joint_passport_preview"
                                    src="{{ asset('storage/uploads/' . $jointHolder->passport) }}"
                                    class="img_preview" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="fieldlabels">Signature: *</label>
                            <input type="file" name="joint_signature[]" accept="image/*" class="imgLoad">
                            <img id="joint_passport_preview"
                                src="{{ asset('storage/uploads/' . $jointHolder->signature) }}"
                                class="img_preview" />
                        </div>
                        <div class="col-md-6">
                            <label class="fieldlabels">Profile picture </label>
                            <input type="file" id="joint_profile_pic[]" name="joint_pro_pic[]" accept="image/*"
                                class="imgLoad">
                            <img id="signature_preview" src="{{ asset('storage/uploads/' . $jointHolder->pro_pic) }}"
                                class="img_preview" />
                        </div>
                    </div>
                </div>
                <a class="btn btn-secondary btn-md" id="add_more"><i class="fas fa-plus-circle"></i>Add Joint
                    Holder</a>
                <a class="btn btn-secondary btn-md" id="remove_more"><i class="fas fa-trash-alt"></i>Remove Joint
                    Holder</a>
        </div>
    @endforeach
@else
    <hr />
    <h3> Joint Holder 1 Information</h3>
    <div id="dynamic_container">
        <div class="row">
            <div class="col-md-2">
                <div class="input-group">
                    <label class="fieldlabels">Title </label>
                    <select name="joint_title[]" id="joint_title[]" class="field Required">
                        <option value="Mr.">Mr</option>
                        <option value="Mrs.">Mrs</option>
                        <option value="Miss.">Miss</option>
                        <option value="Rev.">Rev</option>
                        <option value="Dr.">Dr</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <label class="fieldlabels">Name With Initials: * </label>
                <input type="text" name="joint_name[]" placeholder="Joint Holder Name"
                    class="form-control joint_name" />
            </div>
            <div class="col-md-4">
                <label class="fieldlabels">Name In Full : * </label>
                <input type="text" name="joint_name_initials[]" placeholder="Name by Intitials"
                    class="form-control joint_name_by_initials" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="fieldlabels">Address Line 1 :*</label>
                <input type="text" name="joint_address_line_1[]" placeholder="Address Line 1"
                    class="form-control joint_address_line_1" />
            </div>
            <div class="col-md-6">
                <label class="fieldlabels">Address Line 2 :*</label>
                <input type="text" name="joint_address_line_2[]" placeholder="Address Line 2 "
                    class="form-control joint_address_line_2" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="fieldlabels">Address Line 3 :*</label>
                <input type="text" name="joint_address_line_3[]" placeholder="Address Line 3 "
                    class="form-control joint_address_line_3" />
            </div>
            <div class="col-md-6">
                <label class="fieldlabels">Email: *</label>
                <input type="text" name="joint_email[]"placeholder="email" class="form-control joint_email" />
                <input type="hidden" value="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="fieldlabels">Date Of Birth: *</label>
                <input type="text" name="joint_dob[]" placeholder="YYYY-MM-DD" class="form-control joint_dob" />
            </div>
            <div class="col-md-6">
                <label class="fieldlabels">NIC/Passport: *</label>
                <input type="text" name="joint_nic[]"placeholder="nic" class="form-control joint_nic" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="fieldlabels">Nationality *</label>
                <select class="joint_nationality" name="joint_nationality[]">
                    <option value="Sri Lankan">Sri Lankan</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <div class="joint_nationality_div">
                    <label class="fieldlabels">Nationality *</label>
                    <input type="text" name="joint_nationality_other[]"placeholder="Nationality"
                        class="form-control joint_nationality_other" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="fieldlabels">Land Phone: *</label>
                <input type="text" name="joint_telephone[]"placeholder="land line"
                    class="form-control joint_telephone" />
            </div>
            <div class="col-md-6">
                <input type="hidden" name="full_joint_mobile[]" />
                <label class="fieldlabels">Mobile: *</label>
                <input type="tel" name="joint_mobile[]"placeholder="mobile"
                    class="form-control joint_mobile OTP" />
                <input type="hidden" value="">
            </div>
        </div>
        <div class="joint_nic_div">
            <div class="row">
                <div class="col-md-6">
                    <label class="fieldlabels">NIC Front Side: *</label>
                    <input type="file" name="joint_nic_front[]" accept="image/*" class="imgLoad joint_nic_front">
                    <img id="joint_nic_front" src="{{ asset('storage/images/nic_front_preview.jpg') }}"
                        class="img_preview" />
                </div>
                <div class="col-md-6">
                    <label class="fieldlabels">NIC Back Side: *</label>
                    <input type="file" name="joint_nic_back[]" accept="image/*" class="imgLoad joint_nic_back">
                    <img id="joint_nic_back_preview" src="{{ asset('storage/images/nic_back_preview.jpg') }}"
                        class="img_preview" />
                </div>
            </div>
        </div>
        <div class="joint_passport_div">
            <div class="row">
                <div class="col-md-6">
                    <label class="fieldlabels">Passport: *</label>
                    <input type="file" name="joint_passport[]" accept="image/*" class="imgLoad joint_passport">
                    <img id="joint_passport_preview" src="{{ asset('storage/images/nic_back_preview.jpg') }}"
                        class="img_preview" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="fieldlabels">Signature: *</label>
                <input type="file" name="joint_signature[]" accept="image/*" class="imgLoad joint_signature">
                <img id="joint_passport_preview" src="{{ asset('storage/images/signature_preview.png') }}"
                    class="img_preview" />
            </div>
            <div class="col-md-6">
                <label class="fieldlabels">Profile picture </label>
                <input type="file" id="joint_profile_pic[]" name="joint_pro_pic[]" accept="image/*"
                    class="imgLoad joint_pro_pic">
                <img id="signature_preview" src="{{ asset('storage/images/pro_pic.png') }}" class="img_preview" />
            </div>
        </div>
        <a class="btn btn-secondary btn-md" id="add_more"><i class="fas fa-plus-circle"></i>Add Joint
            Holder</a>
        <a class="btn btn-secondary btn-md" id="remove_more"><i class="fas fa-trash-alt"></i>Remove Joint
            Holder</a>
    </div>
    @endif

</div>
