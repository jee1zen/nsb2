<div id="beneDIV" >
    <hr/>
    <h3> Benefactor 1 Information</h3>
      <div id="dynamic_bene">
       <div class="row">
           <div class="col-md-6">
            <div class="input-group"> 
                <label class="fieldlabels">Title </label> 
                <select name="bene_title[]" id="bene_title[]" class="field Required">
                    <option value="Mr.">Mr</option>
                    <option value="Mrs.">Mrs</option>
                    <option value="Miss.">Miss</option>
                    <option value="Rev.">Rev</option>
                    <option value="Dr.">Dr</option>
                </select>
            </div> 
           </div>
           <div class="col-md-6">
                <label class="fieldlabels">Name in Full: * </label> 
                <input type="text" name="bene_name[]" placeholder="Name" class="form-control"/>
           </div>
       </div> 
       <div class="row">
           <div class="col-md-6">
                <label class="fieldlabels">Designation: * </label> 
                <input type="text" name="bene_designation[]" placeholder="Name" class="form-control"/>
           </div>    

       </div>
       <div class="row">
        <div class="col-md-6">
                <label class="fieldlabels">Date Of Birth: *</label> 
                <input type="text" name="bene_dob[]" placeholder="YYYY-MM-DD" class="form-control beneDob"/>
        </div>
        <div class="col-md-6">
                <label class="fieldlabels">NIC/Passport: *</label>  
                <input type="text" name="bene_nic[]"placeholder="nic" class="form-control"/>
        </div>
     </div>
       <div class="row">
           <div class="col-md-6">          
                <label class="fieldlabels">Address Line 1 :*</label> 
                <input type="text" name="bene_address_line1[]" placeholder="Address Line 1" class="form-control"/>
           </div>
           <div class="col-md-6">
                <label class="fieldlabels">Address Line 2 :*</label> 
                <input type="text" name="bene_address_line2[]" placeholder="Address Line 2 " class="form-control"/>
           </div>
       </div>
       <div class="row">
         <div class="col-md-6">
             <label class="fieldlabels">Address Line 3 :*</label> 
              <input type="text" name="bene_address_line3[]" placeholder="Address Line 3 " class="form-control"/>
          </div>
          <div class="col-md-6">
             <label class="fieldlabels"> Country of Issue & CitizenShip *</label>   
              <input type="text" name="bene_citizenship[]" placeholder="Citizenship" class="form-control"/>
          </div>
     
     </div>
    
     <div class="row">
        <div class="col-md-6">
                <label class="fieldlabels"> Source of Beneficial Ownership (Effective Control/Person on whose behalf account is operated)</label>   
                 <input type="text" name="bene_source_of_beneficial[]" placeholder="" class="form-control"/>
             </div>
             <div class="col-md-6">
                <label class="fieldlabels"> Politically Exposed Person (PEP) *</label>   
                <select name="bene_pep" id="bene_pep">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
             </div>
     
     </div>

    

    </div>
    <a class="btn btn-secondary btn-md" id="add_bene_more"><i class="fas fa-plus-circle"></i>Add </a>
    <a class="btn btn-secondary btn-md" id="remove_bene"><i class="fas fa-trash-alt"></i>Remove</a>
    <div class="row">
        <div class="col-md-12">
           <label class="fieldlabels"> I declare that</label>   
           <select name="bene_declare" id="bene_declare" class="form-control">
                   <option value="0">I am the sole beneficial owner of the customer for this account</option>
                   <option value="1"> I am not the beneficial owner of the customer of this account. Complete identifying information for all beneficial owners that own or control 10% or more of the customer's equity, beneficial owners on whose behalf the account is being operated, and at least one person who exercises effective control of the legal entity regardless of whether such person is already listed.</option>
           </select>
          
        </div>
     

</div>


 </div> 
 <div id="natural_div" >
        <hr/>
        <div class="row">
               <h2>Details of the Natural Person Authorized to Act on behalf of the Customer</h2> 
        </div>
        <div class ="row">
                <div class="col-md-12">
                        <p>
                                I/We hereby declare and confirm all details provided herein are complete, valid and accurate disclosure of the Ultimate Beneficial Owner(s) of the above account and effective and binding. Further I/We undertake to notify the Bank immediately in writing of any change in the beneficial owners of the account.     
                        </p>

                </div>

        </div>
        <h3> Person 1</h3>
          <div id="dynamic_natural">
           <div class="row">
               <div class="col-md-6">
                <div class="input-group"> 
                    <label class="fieldlabels">Title </label> 
                    <select name="natural_title[]" id="natural_title[]" class="field Required">
                        <option value="Mr.">Mr</option>
                        <option value="Mrs.">Mrs</option>
                        <option value="Miss.">Miss</option>
                        <option value="Rev.">Rev</option>
                        <option value="Dr.">Dr</option>
                    </select>
                </div> 
               </div>
               <div class="col-md-6">
                    <label class="fieldlabels">Name in Full: * </label> 
                    <input type="text" name="natural_name[]" placeholder="Name" class="form-control"/>
               </div>
           </div> 
           <div class="row">
                <div class="col-md-6">
                        <label class="fieldlabels">Designation: * </label> 
                        <input type="text" name="natural_designation[]" placeholder="Designation" class="form-control"/>
                </div>  
                <div class="col-md-6">
                        <label class="fieldlabels">Mobile: *</label> 
                        <input type="text" name="natural_mobile[]" placeholder="mobile" class="form-control natural_mobile"/>
                        <input type="hidden" value="">
                </div>
           </div>
         <div class="row">
            <div class="col-md-6">
                    <label class="fieldlabels">NIC/Passport: *</label>  
                    <input type="text" name="natural_nic[]" placeholder="nic" class="form-control"/>
            </div>
            <div class="col-md-6">
                <label class="fieldlabels">Signature: *</label> 
                <input type="file" name="natural_signature[]" accept="image/*" class="imgLoad">
                <img id="natural_passport_preview" src="{{asset('storage/images/signature_preview.png')}}" class="img_preview" />
           </div>
         </div>
        
        </div>
        <a class="btn btn-secondary btn-md" id="add_natural"><i class="fas fa-plus-circle"></i>Add </a>
        <a class="btn btn-secondary btn-md" id="remove_natural"><i class="fas fa-trash-alt"></i>Remove </a>
     </div>   