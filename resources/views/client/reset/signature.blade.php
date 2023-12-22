<div id="signatures_DIV" >
 <div class="row">
     <div class="col-md-12">
        <div class="form-check pull-left">
            <label class="form-check-label" for="flexCheckDefault">
              Add Initiator Also  Signature B
               </label>
            <input class="form-check-input" type="checkbox" name="makeSignatureB" id="makeSignatureB" value="makeSignatureB" id="CheckDefault">
        </div>    

     </div>
 </div>   
  <div class="row">
      <div class="col-md-12">
        <h3 id="h3_B"> Signature B</h3>

      </div>
  </div>
  
    <div id="signatureB_DIV" class="company_container">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group"> 
                    <input type="hidden" name="cp_type[]" value="B">
                    <label class="fieldlabels">Title: *</label> 
                    <select name="cp_title[]" id="cp_title[]" class="field Required">
                        <option value="Mr.">Mr</option>
                        <option value="Mrs.">Mrs</option>
                        <option value="Miss.">Miss</option>
                        <option value="Rev.">Rev</option>
                        <option value="Dr.">Dr</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <label class="fieldlabels">Name in Full: *</label> 
                    <input type="text" name="cp_name[]" id="cp_name_b"
                    placeholder="Signature B Name" class="form-control"/>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <label class="fieldlabels">Occupation: *</label> 
                    <input type="text" name="cp_occupation[]" id="cp_occupation_b"
                      placeholder="" class="" />
                </div>
            </div>
            <div class="col-md-6">
            </div>
            
        </div> 
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mt-3">
                    <label class="fieldlabels">Address Line 1 :*</label> 
                    <input type="text" name="cp_address_line_1[]" id="cp_address_line_1_b"
                    placeholder="Address line 1" class="form-control"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mt-3">
                    <label class="fieldlabels">Address Line 2 :*</label> 
                    <input type="text" name="cp_address_line_2[]"  id="cp_address_line_2_b"
                    placeholder="Address" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mt-3">
                    <label class="fieldlabels">Address Line 3 :*</label> 
                    <input type="text" name="cp_address_line_3[]"  id="cp_address_line_3_b"
                    placeholder="Address" class="form-control"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mt-3">
                    <label class="fieldlabels">Email: *</label> 
                    <input type="text" name="cp_email[]"placeholder="email" id="cp_email_b"
                    class="form-control"/>
                </div>
            </div>
        </div>    
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mt-3">
                    <label class="fieldlabels">Date Of Birth: *</label> 
                    <input type="text" name="cp_dob[]" id="cp_dob_b"
                    placeholder="Date Of Birth" class="form-control jointDob"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mt-3">
                    <label class="fieldlabels">NIC/Passport: *</label>  
                    <input type="text" name="cp_nic[]" id="cp_nic_b" placeholder="nic" class="form-control"/>
                </div>
            </div>
        </div>      
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mt-3">
                    <label class="fieldlabels">Nationality *</label>   
                    <select class="joint_nationality" name="cp_nationality[]"  id="cp_nationality_b">
                        <option value="Sri Lankan">Sri Lankan</option>
                        <option value="other">Other</option>
                     </select>
                </div>
            </div>
            <div class="col-md-6">
                <div id="signatureB_nationality_div">
                    <div class="input-group mt-3">
                        <label class="fieldlabels">Nationality *</label>   
                        <input type="text" name="cp_nationality_other[]" id="cp_nationality_other_b" placeholder="nic" class="form-control"/>
                    </div>
                  </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mt-3">
                    <label class="fieldlabels">Land Phone: *</label>
                    <input type="text" name="cp_telephone[]"  id="cp_telephone_b"
                    placeholder="telephone" class="form-control"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mt-3">
                    <label class="fieldlabels">Mobile: *</label> 
                    <input type="text" name="cp_mobile[]" placeholder="77XXXXXXX" id="cp_mobile_b" class="form-control signature_mobile"/>
                    <input type="hidden" value="">
                </div>
            </div>       
        </div>
        <div id ="signatureB_nic_div" >
          <div class="row">
                <div class="col-md-6">
                    <div class="input-group mt-3" >
                        <label class="fieldlabels">NIC Front Side: *</label> 
                        <input type="file" name="cp_nic_front[]" id="cp_nic_front_b" accept="image/*" class="imgLoad">
                            <img  src="{{asset('storage/images/nic_front_preview.jpg')}}" class="img_preview" />
                        </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mt-3">
                        <label class="fieldlabels">NIC Back Side: *</label> 
                        <input type="file" name="cp_nic_back[]"  id="cp_nic_back_b"
                        accept="image/*" class="imgLoad">
                        <img  src="{{asset('storage/images/nic_back_preview.jpg')}}" class="img_preview"/>
                    </div>
                </div>
             </div>
        </div>    
        <div id="signature_passportB_div">
           <div class="row">
               <div class="col-md-6">
                    <div class="input-group mt-3">
                        <label class="fieldlabels">Passport: *</label> 
                        <input type="file" name="cp_passport[]" id="cp_passport_b" accept="image/*" class="imgLoad">
                        <img  src="{{asset('storage/images/nic_back_preview.jpg')}}" class="img_preview" />
                    </div>
               </div>
           </div> 
        </div>
        <div class="row">
            <div class="col-md-6">
            
                    <label class="fieldlabels">Signature: *</label> 
                    <input type="file" name="cp_signature[]" id="cp_signature_b" accept="image/*" class="imgLoad">
                    <img  src="{{asset('storage/images/signature_preview.png')}}" class="img_preview" />
                
            </div>
            <div class="col-md-6">
            
                <div class="form-check pull-left" >
                    <label class="form-check-label" style="margin-top: 2.7em">
                        <input class="form-check-input" type="checkbox" name="chk_key_contact_b" id="chk_key_contact_b" value="chk_key_contact_b"> 
                        Add as a key Contact Person
                    </label>
                </div>  
            </div>
        </div>
  </div>

  <hr/>
 
  <div class="row">
      <div class="col-md-12">
        <h3> Signature A</h3>
      </div>
  </div>
  <div class="row">
      <div class="col-md-6">
        <label class="fieldlabels">Title</label> 
        <input type="hidden" name="cp_type[]" value="A">
            <select name="cp_title[]" id="cp_title[]" class="field Required">
                <option value="Mr.">Mr</option>
                <option value="Mrs.">Mrs</option>
                <option value="Miss.">Miss</option>
                <option value="Rev.">Rev</option>
                <option value="Dr.">Dr</option>
            </select>
        </div>

        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                </div>
                <label class="fieldlabels">Name in Full: *</label> 
                <input type="text" name="cp_name[]" id="cp_name_a" placeholder="Signature A Name" class="form-control"/>
            </div>
        </div>
 </div>
 <div class="row">
     <div class="col-md-12">
        <div class="input-group">
            <label class="fieldlabels">Occupation: *</label> 
            <input type="text" name="cp_occupation[]" id="cp_occupation_a"  placeholder="" class="form-control" />
        </div>
     </div>
 </div>

 <div class="row">
     <div class="col-md-6">
        <div class="input-group mt-3">
           
            <label class="fieldlabels">Address Line 1 :*</label> 
            <input type="text" name="cp_address_line_1[]" id="cp_address_line1_a"  placeholder="Address" class="form-control"/>
        </div>

     </div>
     <div class="col-md-6">
        <div class="input-group mt-3">
            <label class="fieldlabels">Address Line 2 :*</label> 
            <input type="text" name="cp_address_line_2[]" id="cp_address_line_2_a"  placeholder="Address" class="form-control"/>
        </div>
    </div>
 </div>
 <div class="row">
     <div class="col-md-6">
        <div class="input-group mt-3">
            <label class="fieldlabels">Address Line 3 :*</label> 
            <input type="text" name="cp_address_line_3[]" id="cp_address_line_3_a" placeholder="Address" class="form-control"/>
        </div>
     </div>
     <div class="col-md-6">
        <div class="input-group mt-3">
            <label class="fieldlabels">Email: *</label> 
            <input type="text" name="cp_email[]" id="cp_email_a" placeholder="email"  class="form-control"/>
        </div>
    </div>
 </div>
  <div class="row">
      <div class="col-md-6">
        <div class="input-group mt-3">
            <label class="fieldlabels">Date Of Birth: *</label> 
            <input type="text" name="cp_dob[]" id="cp_dob_a" placeholder="YYYY-MM-DD"  class="form-control jointDob"/>
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-group mt-3">
            <label class="fieldlabels">NIC/Passport: *</label>  
            <input type="text" name="cp_nic[]" id="cp_nic_a" placeholder="NIC/Passport"  class="form-control"/>
        </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-6">
        <div class="input-group mt-3">
            <label class="fieldlabels">Nationality *</label>   
            <select class="form-control" name="cp_nationality[]" id="cp_nationality_a">
                <option value="Sri Lankan">Sri Lankan</option>
                <option value="other">Other</option>
             </select>
        </div>
      </div>
      <div class="col-md-6">
        <div id="signatureA_nationality_div">
            <div class="input-group mt-3">
                <label class="fieldlabels">Nationality *</label>   
                <input type="text" name="cp_nationality_other[]" id="cp_nationality_other_a" placeholder="nic"  class="form-control"/>
            </div>
         </div>
    </div>
  </div>
  <div class="row">
      <div class="col-md-6">
        <div class="input-group mt-3">
            <label class="fieldlabels">Land Phone: *</label>
            <input type="text" name="cp_telephone[]" id="cp_telephone_a" placeholder="telephone"  class="form-control"/>
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-group mt-3">
            <label class="fieldlabels">Mobile: *</label> 
            <input type="text" name="cp_mobile[]" id="cp_mobile_a" placeholder="mobile" class="form-control signature_mobile"/>
            <input type="hidden" value="">
        </div>
    </div>
  </div>
  
   <div id ="signatureA_nic_div" >
       <div class="row">
           <div class="col-md-6">
            <div class="input-group mt-3" >
                <label class="fieldlabels">NIC Front Side: *</label> 
                <input type="file" name="cp_nic_front[]"  id="cp_nic_front_a"  accept="image/*" class="imgLoad">
                <img  src="{{asset('storage/images/nic_front_preview.jpg')}}" class="img_preview" />
    
            </div>
           </div>
           <div class="col-md-6">
            <div class="input-group mt-3">
                <label class="fieldlabels">NIC Back Side: *</label> 
                <input type="file" name="cp_nic_back[]"  id="cp_nic_back_a"  accept="image/*" class="imgLoad">
                <img  src="{{asset('storage/images/nic_back_preview.jpg')}}" class="img_preview" />
            </div>
           </div>
       </div>
    </div>

  <div id="signature_passportA_div">
     <div class="row">
         <div class="col-md-6">
            <div class="input-group mt-3">
                <label class="fieldlabels">Passport: *</label> 
                <input type="file" name="cp_passport[]" id="cp_passport_a" accept="image/*"  class="imgLoad">
                <img  src="{{asset('storage/images/nic_back_preview.jpg')}}" class="img_preview" />
            </div>

         </div>
     </div>     
  </div>

   <div class="row">
       <div class="col-md-6">
        <div class="input-group mt-3">
            <label class="fieldlabels">Signature: *</label> 
            <input type="file" name="cp_signature[]" id="cp_signature_a" accept="image/*"  class="imgLoad">
            <img  src="{{asset('storage/images/signature_preview.png')}}" class="img_preview" />
        </div>
       </div>
       <div class="col-md-6">
        <div class="form-check pull-left" >
            <label class="form-check-label" style="margin-top: 2.7em">
                <input class="form-check-input" type="checkbox" name="chk_key_contact_a" id="chk_key_contact_a" value="chk_key_contact_a"> 
                Add as a key Contact Person
            </label>
        </div>  
       </div>
   </div>
   


 <div class="row" style="margin-top: 25px">
     <div class="col-md-12">
        <h3>Add Key Contact People</h3>
        <div class="col-md-12 table-responsive">
          <table class="table table-bordered table-hover table-sortable" id="tab_contact">
              <thead>
                  <tr >
                      <th class="text-center">
                         Name
                      </th>
                      <th class="text-center">
                          Designation
                      </th>
                      <th class="text-center">
                          ContactNo
                      </th>
                      <th class="text-center">
                         Email
                      </th>
                      <th class="text-center" style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
                      </th>
                  </tr>
              </thead>
              <tbody>
                  <tr id='addraw0' data-id="0" class="hidden" style="cursor: move;">
                      <td data-name="name">
                          <input type="text" name='contact_name[]'  placeholder='Name' class="form-control"/>
                      </td>
                      <td data-name="designation">
                          <input type="text" name='contact_designation[]' placeholder='designation' class="form-control"/>
                      </td>
                      <td data-name="contact_no">
                          <input type="text" name='contact_contact_no[]' placeholder='77xx' class="form-control"/>
                      </td>
                      <td data-name="conact_email">
                          <input type="text" name='contact_email[]' placeholder='user@user.com' class="form-control"/>
                      </td>
                      <td data-name="del">
                          <button name="del0" type="button" class='btn btn-danger glyphicon glyphicon-remove row-remove'><span aria-hidden="true">×</span></button>
                      </td>
                  </tr>
              </tbody>
          </table>
          <a id="add_contact_row" class="btn btn-primary float-right">Add</a>
      </div> 
     </div>
 </div>
      
 </div>