<div class="row">
    <div class="col-7">
        <h2 class="fs-title">Basic Information</h2>
    </div>
    <div class="col-5">
        <h2 class="steps">Step 3 - 7</h2>
    </div>
</div> 
<div class="row">
    <div class="col-md-12">
        <h3 id="mainPersontitle"> Your Details</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <label class="fieldlabels">Title</label> 
        <select name="title" id="title" class="field Required">
            <option value="Mr.">Mr</option>
            <option value="Mrs.">Mrs</option>
            <option value="Miss.">Miss</option>
            <option value="Rev.">Rev</option>
            <option value="Dr.">Dr</option>
        </select>
    </div>
    <div class="col-md-4">
        <label class="fieldlabels">Name With Initials</label> 
        <input type="text" name="name"placeholder="" id="name" class="fieldRequired" />
    </div>
    <div class="col-md-6">
        <label class="fieldlabels">Name In Full</label> 
        <input type="text" name="name_initials" placeholder="" id="name_initials" class="fieldRequired" />
    </div>
</div>
<div>
    <div class="row">
      
        <div class="col-md-6">
            <label class="fieldlabels">Email  <i> (This is the main Email  for NSB FMC)</i> </label> 
            <input type="email" id="email" name="email" placeholder="" class="fieldRequired emailOTP" />
            <input type="hidden" value="">
        </div>
        <div class="col-md-6">
            <label class="fieldlabels">NIC Or Passport</label> 
            <input type="text" name="nic"placeholder="" class="fieldRequired" />  
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
     <div id="occupation_DIV">
        <label class="fieldlabels">Occupation</label> 
        <input type="text" name="occupation" id="occupation" placeholder="" class="" />
      </div>
    </div>
    <div class="col-md-6">
        <label class="fieldlabels">Date Of Birth</label> 
        <input type="text" name="dob" id="dob" placeholder="YYYY-MM-DD"  data-inputmask="'alias': 'date'"  class="fieldRequired" /> 
    </div>    
</div>
<div class="row">
    <div class="col-md-6">
        <label class="fieldlabels">Address Line 1</label>
        <input type="text"  name="address_line_1"  id="address_line_1" placeholder="" class="fieldRequired" /> 
    </div>
    <div class="col-md-6">
        <label class="fieldlabels">Address Line 2</label>
        <input type="text" name="address_line_2" id="address_line_2" placeholder="" class="fieldRequired" /> 
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label class="fieldlabels">Address Line 3 (Optional) </label>
        <input type="text" name="address_line_3" id="address_line_3" placeholder=""  /> 
    </div>
    <div class="col-md-6">
        <div id ="correspondanceCheck_DIV">
            <div class="form-check pull-left" >
                <label class="form-check-label" style="margin-top: 2.7em" >
                    <input class="form-check-input" type="checkbox" name="sameAsAddressCheck" id="sameAsAddressCheck" value="" id="CheckDefault"> 
                    Corresponding Address same as Permenant Address
                </label>
            </div>  
        </div>
      
    </div>
</div>    

<div id="corresponding_address_DIV">
    <div class="row">
        <div class="col-md-6">
            <label class="fieldlabels">Corresponding Address Line 1</label>
            <input type="text" name="corresponding_address_line_1" id="corresponding_address_line_1" placeholder="" class="" /> 
        </div>
        <div class="col-md-6">
            <label class="fieldlabels">Corresponding Address Line 2</label>
            <input type="text" name="corresponding_address_line_2" id="corresponding_address_line_2" placeholder="" class="" /> 
        </div>
    </div>   
    <div class="row">
        <div class="col-md-6">
            <label class="fieldlabels">Corresponding Address Line 3 (Optional) </label>
            <input type="text" name="corresponding_address_line_3" id="corresponding_address_line_3" placeholder=""  /> 
        </div>
       <div id="billing_proof_div">
            <div class="col-md-6">
                <label class="fieldlabels"> Billing Proof </label> 
                <input type="file" id="billing_proof" name="billing_proof" class="imgLoad" accept="image/*">
                <img id="billing_proof_preview" src="{{asset('storage/images/doc.png')}}" class="img_preview"/>
        </div>
       </div> 
    </div>  
</div>

<div class="row">
    <div class="col-md-6">
        <label class="fieldlabels">Land phone</label> 
        <input type="text" name="telephone" id="telephone" placeholder=""  /> 
    </div>
    <div class="col-md-6">
        <input type="hidden"  name="full_mobile" >
        <label class="fieldlabels">Mobile</label>
        <input type="tel"  name="mobile" id="mobile"  class="fieldRequired OTP"/>
        <input type="hidden"  value="">
    </div>
</div>       


<div class="row">
    <div class="col-md-6">
        <label class="fieldlabels">Nationality</label>
        <select id="nationality" name="nationality">
        <option value="Sri Lankan">Sri Lankan</option>
        <option value="other">Other</option>
        </select>
    </div>
    <div class="col-md-6">
        <div id="other_nationalityDIV">
            <label class="fieldlabels">Nationailty</label> 
            <input type="text" id="other_nationality" name="other_nationality" id="other_nationality" placeholder="">
        </div>
    </div>
</div>       

<div id="nicDiv">
    <div class="row">
        <div class="col-md-6">
            <label class="fieldlabels">NIC Front Image</label> 
            <input type="file" id="nic_front" name="nic_front" class="imgLoad" accept="image/*">
            <img id="nic_front_preview" src="{{asset('storage/images/nic_front_preview.jpg')}}" class="img_preview"/>
        </div>
        <div class="col-md-6">
            <label class="fieldlabels">NIC Back Image </label> 
            <input type="file" id="nic_back" name="nic_back"  class="imgLoad" accept="image/*">
            <img id="nic_back_preview" src="{{asset('storage/images/nic_back_preview.jpg')}}" class="img_preview"  />
        </div>
    </div>    
</div>
<div id="passportDiv">
    <div class="row">
        <div class="col-md-6">
            <label class="fieldlabels">Passport Image </label> 
            <input type="file" id="passport" name="passport"  class="imgLoad" accept="image/*">
            <img id="passport_preview" src="{{asset('storage/images/nic_back_preview.jpg')}}" class="img_preview" />
        </div>  
    </div>      
</div>
<div id="signatureDiv">
    <div class="row">
        <div class="col-md-6">
            <label class="fieldlabels">Signature </label> 
            <input type="file" id="signature" name="signature" accept="image/*"  class="imgLoad">
            <img id="signature_preview" src="{{asset('storage/images/signature_preview.png')}}" class="img_preview" />
        </div>
        <div class="col-md-6">
            <label class="fieldlabels">Profile picture </label> 
            <input type="file" id="profile_pic" name="pro_pic" accept="image/*"  class="imgLoad">
            <img id="signature_preview" src="{{asset('storage/images/pro_pic.png')}}" class="img_preview" />
        </div>
    </div>     
</div>

<div id="authorizedDiv">
    <div class="row">
        <div class="col-md-6">
            <label class="fieldlabels">Authorized Person Full Name</label> 
            <input type="text" id="authorized_name" name="authorized_name" placeholder="" />
        </div>
        <div class="col-md-6">
            <label class="fieldlabels">Authorized Person Address</label> 
            <input type="text" id="authorized_address" name="authorized_address" placeholder="" />
        </div>    
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="fieldlabels">Authorized Person Telelphone</label> 
            <input type="text" id="authorized_telephone" name="authorized_telephone" placeholder="" />
        </div>
        <div class="col-md-6">
            <label class="fieldlabels">Authorized Person NIC No</label> 
            <input type="text" id="authorized_nic" name="authorized_nic" placeholder="" />
        </div>    
    </div>
</div>