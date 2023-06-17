<div class="form-card">
    <div class="row">
        <div class="col-md-7">
            <h2 class="fs-title">Investment & Account Type:</h2>
        </div>
        <div class="col-md-5">
            <h2 class="steps">Step 1- 7</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label class="fieldlabels">Account Type: *</label>
            <select  name="client_type" id="client_type">
                <option value="1" > Individual </option>
                <option value="2" > Joint</option>
                {{-- <option value="3" > Institute</option> --}}
            </select>
        </div>
       
    </div>
    <div class="row">


    </div>
    <div class="row">
     
    </div>
   
    <div class="row">
    <div class="col-md-6">
        <div id="joint_authority_DIV">
            <label class="fieldlabels">Joint Account Authority: *</label>
            <select  name="joint_permission" id="joint_permission">
                <option value="0"> Main Holder Take Actions Independantly </option>
                <option value="1"> Take Actions After Accepting From All The Joint Holders </option>
            </select>
        </div>
        <div id="company_type_DIV">
           
                <label class="fieldlabels" for="">Type of Institution</label>
                <select name="type_of_company" id="type_of_company">
                    <option value="Proprietorship">Proprietorship</option>
                    <option value="Partnership">Partnership</option>
                    <option value="Public Company">Public Company</option>
                    <option value="Private Company">Private Company</option>
                    <option value="Clubs/Societies/Association">Clubs/Societies/Association</option>
                    <option value="Government/Institute/Bank">Government/Institute/Bank</option>
                    <option value="Trust/Charities">Trust/Charities</option>
                    <option value="NGO's/NPO's">NGO's/NPO's</option>
                </select>
          
        </div>
     </div>
    </div>    

    <div id="company_DIV">
        <div class="row">
            <div class="col-md-6">
                <label class="fieldlabels">Name of Institution</label> 
                <input type="text" name="company_name" id="company_name" placeholder=""  />
            </div>
            <div class="col-md-6">
                <label class="fieldlabels">Business Registration No / Act NO</label> 
                <input type="text" name="company_br_no" id="company_br_no" placeholder=""  />
            </div>  
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="fieldlabels">Address Line 1</label> 
                <input type="text" name="company_address_line_1" id="company_address_line_1" placeholder=""  />
            </div>  
            <div class="col-md-6">
                <label class="fieldlabels">Address Line 2</label> 
                <input type="text" name="company_address_line_2" id="company_address_line_2" placeholder=""  />
            </div>    
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="fieldlabels">Address Line 3</label> 
                <input type="text" name="company_address_line_3" id="company_address_line_3" placeholder=""  />
            </div>
            <div class="col-md-6">
             
                <label class="fieldlabels">Company Email</label> 
                <input type="text" name="company_email" id="company_email" placeholder=""  />
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
             
                <label class="fieldlabels">Telephone</label> 
                <input type="text" name="company_telephone_1" id="company_telephone_1" placeholder=""  />
            </div>
            <div class="col-md-6">
                <label class="fieldlabels">Fax </label> 
                <input type="text" name="company_fax_1" id="company_fax_1" placeholder=""  />
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="fieldlabels">Nature Of Business</label> 
                <input type="text" name="company_nature_of_business" id="company_nature_of_business" placeholder=""  />
            </div>
        </div>
      
   
            <div id="business_registration_DIV">
                <div class="row">
                 <div class="col-md-12">
                    <label class="fieldlabels">Business Registration Document</label> 
                    <input type="file" id="company_br" name="company_br" class="imgLoad" >
                  </div>
                </div>    
            </div>
        
            {{-- <div id="business_act_DIV">
                <label class="fieldlabels">Business Act : *</label> 
                <input type="file" id="company_act" name="company_act" class="imgLoad" >
            </div> --}}

            <div id="certificate_of_incorperation_DIV">
                <div class="row">
                    <div class="col-md-12">
                        <label class="fieldlabels">Certificate of  Incorperation</label> 
                        <input type="file" id="company_coi" name="company_coi" class="imgLoad" >
                    </div>
                </div>        
            </div>

            <div id="trust_deed_DIV">
                <div class="row">
                    <div class="col-md-12">
                        <label class="fieldlabels">Trust Deed </label> 
                        <input type="file" id="company_trust_deed" name="company_trust_deed" class="imgLoad" >
                    </div>
                </div>       
            </div>
        
            <div id="board_resolution_DIV">
                <div class="row">
                    <div class="col-md-12">
                        <label class="fieldlabels">Board of Resolution</label> 
                        <input type="file" id="company_board_resolution" name="company_board_resolution" class="imgLoad" >
                    </div>
                </div>        
            </div>

            <div id="society_constitution_DIV">
                <div class="row">
                    <div class="col-md-12">
                        <label class="fieldlabels">Society Costitution</label> 
                        <input type="file" id="company_society_constitution" name="company_society_constitution" class="imgLoad" >
                    </div>
                </div>        
            </div>

         <div id="power_attorney_DIV">
                <label class="fieldlabels">Power Of Attorney : *</label> 
                <input type="file" id="company_power_of_attorney" name="company_power_of_attorney" class="imgLoad" >
        </div> 

        <div id="partner_kyc_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">Partners KYC</label> 
                    <input type="file" id="partners_kyc" name="partners_kyc" class="imgLoad" >
                </div>
             </div>   
        </div>
        
        <div id="properitor_kyc_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">Proprietor's KYC</label> 
                    <input type="file" id="proprietors_kyc" name="proprietors_kyc" class="imgLoad" >
                </div>
            </div>     
        </div>
        <div id="certificate_of_registration_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">Certificate of  Incorperation </label> 
                    <input type="file" id="certificate_of_registration" name="certificate_of_registration" class="imgLoad" >
                </div>
            </div>   
        </div>

        <div id="declaration_of_beneficial_ownership_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">Declaration of Beneficial Ownership </label> 
                    <input type="file" id="declaration_of_beneficial_ownership" name="declaration_of_beneficial_ownership" class="imgLoad" >
                </div>
            </div>   
        </div>

        <div id="partner_deed_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">Partnership Deed/Agreement (If available) </label> 
                    <input type="file" id="partner_deed" name="partner_deed" class="imgLoad" >
                </div>
            </div>   
        </div>

        <div id="articles_of_association_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">Copy of Articles of Association </label> 
                    <input type="file" id="articles_of_association" name="articles_of_association" class="imgLoad" >
                </div>
            </div>   
        </div>

        <div id="form01_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">Copy of Form 01/ Form 40 </label> 
                    <input type="file" id="form01" name="form01" class="imgLoad" >
                </div>
            </div>   
        </div>

        <div id="form20_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">Copy of Form 01/ Form 40 </label> 
                    <input type="file" id="form20" name="form20" class="imgLoad" >
                </div>
            </div>   
        </div>

        <div id="form44_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">Copy of Form 44 (If Applicable)</label> 
                    <input type="file" id="form44" name="form44" class="imgLoad" >
                </div>
            </div>   
        </div>

        <div id="form45_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">Copy of Form 45 (If Applicable)</label> 
                    <input type="file" id="form45" name="form45" class="imgLoad" >
                </div>
            </div>   
        </div>
        <div id="certificate_commence_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">Copy of Certificate to Commence Business (If Applicable)</label> 
                    <input type="file" id="certificate_commence" name="certificate_commence" class="imgLoad" >
                </div>
            </div>   
        </div>

        <div id="export_development_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">Copy of Export Development Board Approved Letter (If Applicable)</label> 
                    <input type="file" id="export_development" name="export_development" class="imgLoad" >
                </div>
            </div>   
        </div>

        <div id="board_of_investment_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">Copy of Export Development Board Approved Letter (If Applicable)</label> 
                    <input type="file" id="export_development" name="export_development" class="imgLoad" >
                </div>
            </div>   
        </div>

        <div id="list_of_subsidiaries_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">List of Subsidiaries (If Applicable)</label> 
                    <input type="file" id="list_of_subsidiaries" name="list_of_subsidiaries" class="imgLoad" >
                </div>
            </div>   
        </div>

        <div id="directors_kyc_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">Director's KYC</label> 
                    <input type="file" id="director_kyc" name="director_kyc" class="imgLoad" >
                </div>
            </div>   
        </div>
        <div id="office_barers_kyc_DIV">
            <div class="row">
                <div class="col-md-12">
                    <label class="fieldlabels">Office Bearear's/ KYC</label> 
                    <input type="file" id="director_kyc" name="director_kyc" class="imgLoad" >
                </div>
            </div>   
        </div>



    </div>
</div>