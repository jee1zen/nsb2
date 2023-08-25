<div class="form-card" id="kyc">

    <div class="row">
        <div class="col-7">
            <h2 class="fs-title">KYC Form</h2>
        </div>

    </div>




    <label for="kyc_account_at_NSB_FMC" class="form-label">Do you have an investment account at NSB FMC : *</label>

    <select name="kyc_account_at_NSB_FMC" id="kyc_account_at_NSB_FMC" class="fieldRequired">
        <option value="">Select</option>
        <option value="No">No</option>
        <option value="Yes">Yes</option>
    </select>

    <label for="kyc_employment_status" class="form-label"> Employment Status : *</label>

    <select name="kyc_employment_status" id="kyc_employment_status"
        class="form-control {{ $errors->has('kyc_employment_status') ? 'is-invalid' : '' }}"
        aria-describedby="kyc_employment_status" required>
        <option value="">Select</option>
        <option value="Self employed">Self employed</option>
        <option value="Full time employed">Full time employed</option>
        <option value="Part time employed">Part time employed</option>
        <option value="Full time employed">Full time employed</option>
        <option value="Not currently employed">Not currently employed</option>
        <option value="Not currently employed">Not currently employed</option>
        <option value="Retired">Retired</option>
        <option value="Other">Other</option>
    </select>
    @if ($errors->has('kyc_employment_status'))
        <div id="kyc_employment_status" class="invalid-feedback">
            {{ $errors->first('kyc_employment_status') }}
        </div>
    @endif



    <div id="kyc_other_employement_DIV">
        <label class="fieldlabels">Specify Other Employment Status : *</label>
        <input type="text" id="kyc_other_employement" name="kyc_other_employement" placeholder="" value=""
            {{ $errors->has('kyc_other_employement') ? ' is-invalid' : '' }}" />
        @if ($errors->has('kyc_other_employement'))
            <div class="invalid-feedback">
                {{ $errors->first('kyc_other_employement') }}
            </div>
        @endif

    </div>


    <label for="kyc_nature_of_business" class="form-label"> Nature Of Business : *</label>

    <select name="kyc_nature_of_business" id="kyc_nature_of_business"
        class="form-control {{ $errors->has('kyc_nature_of_business') ? 'is-invalid' : '' }} fieldRequired"
        aria-describedby="kyc_nature_of_business" required>
        <option value="">Select</option>
        <option value="Manufacturing">Manufacturing</option>
        <option value="Finance/Insurance">Finance/Insurance</option>
        <option value="Retail">Retail</option>
        <option value="Transport">Transport</option>
        <option value="Restaurant">Restaurant</option>
        <option value="Hotel/Boarding House">Hotel/Boarding House</option>
        <option value="Casino/ Gambling house/Night Clubs">Casino/ Gambling house/Night Clubs</option>
        <option value="Personal & Household Services">Personal & Household Services</option>
        <option value="Import /Export">Import /Export</option>
        <option value="Wholesale">Wholesale</option>
        <option value="Communications">Communications</option>
        <option value="Real State">Real State</option>
        <option value="Public service">Public service</option>
        <option value="Gem and Jewelry">Gem and Jewelry</option>
        <option value="Other">Other</option>
    </select>
    @if ($errors->has('kyc_nature_of_business'))
        <div id="kyc_nature_of_business" class="invalid-feedback">
            {{ $errors->first('kyc_nature_of_business') }}
        </div>
    @endif



    <div id="kyc_nature_of_business_specify_DIV">
        <label class="fieldlabels"> Nature Of Business Specify : *</label>
        <input type="text" id="kyc_nature_of_business_specify" name="kyc_nature_of_business_specify" placeholder=""
            value="" class="" />
        @if ($errors->has('kyc_nature_of_business_specify'))
            <div class="invalid-feedback">
                {{ $errors->first('kyc_nature_of_business_specify') }}
            </div>
        @endif
    </div>


    <label for="kyc_marital_status" class="fieldlabels">Marital Status : *</label>

    <select name="kyc_marital_status" id="kyc_marital_status"
        class="form-control {{ $errors->has('kyc_marital_status') ? 'is-invalid' : '' }} fieldRequired"
        aria-describedby="kyc_marital_status" required>
        <option value="">Select</option>
        <option value="Single">Single</option>
        <option value="Married">Married</option>
    </select>
    @if ($errors->has('kyc_marital_status'))
        <div id="kyc_marital_status" class="invalid-feedback">
            {{ $errors->first('kyc_marital_status') }}
        </div>
    @endif


    <div id="kyc_marital_status_DIV">
        <label class="fieldlabels">Name of Spouse : *</label>
        <input type="text" id="kyc_spouse_name" name="kyc_spouse_name" placeholder="" class="" />
        @if ($errors->has('kyc_spouse_name'))
            <div class="invalid-feedback">
                {{ $errors->first('kyc_spouse_name') }}
            </div>
        @endif
        <label class="fieldlabels">Spouse Occupation Held : *</label>
        <input type="text" id="kyc_spouse_job" name="kyc_spouse_job" placeholder="" class="" />
        @if ($errors->has('kyc_spouse_job'))
            <div class="invalid-feedback">
                {{ $errors->first('kyc_spouse_job') }}
            </div>
        @endif

    </div>



    <label class="fieldlabels">Status Of Residential Address : *</label>
    <select name="kyc_ownership_of_premises" id="kyc_ownership_of_premises" class="fieldRequired">
        <option value="Owner">Owner</option>
        <option value="Parent's">Parent's</option>
        <option value="Lease/Rent">Lease/Rent</option>
        <option value="Offical">Official</option>
        <option value="Friends/Relatives">Friends/Relatives</option>
        <option value="Board/Lodging">Board/Lodging</option>
    </select>


    <label class="fieldlabels">Citizenship : *</label>
    <select name="kyc_citizenship" id="kyc_citizenship" class="fieldRequired">
        <option value="Sri Lankan">Sri Lankan</option>
        <option value="Sri Lankan with dual citizenship">Sri Lankan with dual citizenship</option>
        <option value="Foreign national with dual citizenship">Foreign national with dual citizenship</option>
        <option value="Foreign National">Foreign National</option>
    </select>

    <div id="kyc_foreign_DIV">

        <label class="fieldlabels">Country of Birth : *</label>
        <input type="text" id="kyc_country_of_birth" name="kyc_country_of_birth" placeholder="" />
        @if ($errors->has('kyc_country_of_birth'))
            <div class="invalid-feedback">
                {{ $errors->first('kyc_country_of_birth') }}
            </div>
        @endif

        <label class="fieldlabels">Nationality : *</label>
        <input type="text" id="kyc_nationality" name="kyc_nationality" placeholder="" value="" />
        @if ($errors->has('kyc_nationality'))
            <div class="invalid-feedback">
                {{ $errors->first('kyc_nationality') }}
            </div>
        @endif
        <label class="fieldlabels">Type Of Visa : *</label>

        <select name="kyc_type_of_visa" id="kyc_type_of_visa" class="form-control">
            <option value="Permanent Residence">Permanent Residence</option>
            <option value="Temporary Residence">Temporary Residence</option>
            <option value="Green Card">Green Card</option>
            <option value="other">Other</option>
        </select>
        <div id="other_visa_DIV">
            <label class="fieldlabels">Specify Other Visa : *</label>
            <input type="text" id="kyc_other_visa_type" name="kyc_other_visa_type" placeholder=""
                class="form-control" />

        </div>

        <label class="fieldlabels">Expiry Date : *</label>
        <input type="date" id="kyc_expiry_date" name="kyc_expiry_date" placeholder="" />
        @if ($errors->has('kyc_expiry_date'))
            <div class="invalid-feedback">
                {{ $errors->first('kyc_expiry_date') }}
            </div>
        @endif

    </div>




    <label class="fieldlabels"> In case of Foreign Passport Holders, give the purpose of opening the account in the
        foreign jurisdiction : *</label>
    <textarea type="text" id="kyc_purpose_account_foreign " name="kyc_purpose_account_foreign" placeholder=""
        class="form-control">
        </textarea>


    <label class="fieldlabels">Purpose of Opening the Account : *</label>
    <select name="kyc_purpose_of_opening_account" id="kyc_purpose_of_opening_account" class="fieldRequired">
        <option value="">Select</option>
        <option value="Employment/Professional income">Employment/Professional income</option>
        <option value="Savings">Savings</option>
        <option value="Investment purposes">Investment purposes</option>
        <option value="Remittances">Business transactions</option>
        <option value="Business transactions">Business transactions</option>
        <option value="Social & Charity work">Social & Charity work</option>
        <option value="Other">Other</option>
    </select>


    <div id="other_special_purpose_DIV">
        <label class="fieldlabels">Specify Other Purpose : *</label>
        <input type="text" id="kyc_other_purpose" name="kyc_other_purpose" placeholder=""
            class="form-control" />

    </div>



    <label class="fieldlabels"> Source of Funds [Expected source and nature of credits into the account] : *</label>
    <select name="kyc_source_of_funds" id="kyc_source_of_funds" class="fieldRequired">
        <option value="">Select</option>
        <option value="Salary/Profit/Professional Income">Salary/Profit/Professional Income</option>
        <option value="Sales and Business Turnover">Sales and Business Turnover</option>
        <option value="Rent Income">Rent Income</option>
        <option value="Remittances">Remittances</option>
        <option value="Export Proceeds">Export Proceeds</option>
        <option value="Donations/Charities">Donations/Charities</option>
        <option value="Investment Proceeds">Investment Proceeds</option>
        <option value="Sale of Property/Assets">Sale of Property/Assets</option>
        <option value="Gifts">Gifts</option>
        <option value="Commission Income">Commission Income</option>
        <option value="Other">Other</option>
    </select>
    @if ($errors->has('kyc_source_of_funds'))
        <div class="invalid-feedback">
            {{ $errors->first('kyc_source_of_funds') }}
        </div>
    @endif

    <div id="kyc_other_source_DIV">
        <label class="fieldlabels">Specify Other source of income : *</label>
        <input type="text" id="kyc_other_source" name="kyc_other_source" placeholder="" class="form-control" />
        @if ($errors->has('kyc_other_source'))
            <div class="invalid-feedback">
                {{ $errors->first('kyc_other_source') }}
            </div>
        @endif

    </div>


    <label class="fieldlabels"> Anticipated Volumes [Expected/Usual average volumes of deposits into the account in Rs
        per month]: *</label>
    <select name="kyc_anticipated_volume" id="kyc_anticipated_volume" class="fieldRequired">
        <option value="">Select</option>
        <option value="Less than Rs.500,000 (or equivalent FC value)">Less than Rs.500,000 (or equivalent FC value)
        </option>
        <option value="Rs.500,001 to Rs.2,000,000 (or equivalent FC value)">Rs.500,001 to Rs.2,000,000 (or equivalent
            FC value)</option>
        <option value="Rs.2,000,001 to Rs.5,000,000 (or equivalent FC value)">Rs.2,000,001 to Rs.5,000,000 (or
            equivalent FC value)</option>
        <option value="Over Rs.5,000,000 (or equivalent FC value)">Over Rs.5,000,000 (or equivalent FC value)</option>
    </select>
    @if ($errors->has('kyc_anticipated_volume'))
        <div class="invalid-feedback">
            {{ $errors->first('kyc_anticipated_volume') }}
        </div>
    @endif

    <label class="fieldlabels"> Expected Mode of Transactions/ Delivery Channels: *</label>
    <select name="kyc_expected_mode_of_transacation" id="kyc_expected_mode_of_transacation" class="fieldRequired">
        <option value="">Select</option>
        <option value="Cash">Cash</option>
        <option value="Cheque">Cheque</option>
        <option value="Standing Orders">Standing Orders</option>
        <option value="SLIPS/ Wire Transfer /RTGS">SLIPS/ Wire Transfer /RTGS</option>
        <option value="Foreign Remittance">Foreign Remittance</option>
        <option value="All mode of forms">All mode of forms</option>
    </select>


    <label class="fieldlabels"> Other Connected Businesses /Professional Activities (if applicable):</label>
    <textarea type="text" id="kyc_other_connected_businesses " name="kyc_other_connected_businesses" placeholder=""
        class="fieldRequired">
        </textarea>
    @if ($errors->has('kyc_other_connected_businesses'))
        <div class="invalid-feedback">
            {{ $errors->first('kyc_other_connected_businesses') }}
        </div>
    @endif

    <label class="fieldlabels"> Expected Types of Counterparties (if applicable):</label>
    <textarea type="text" id="kyc_expected_types_of_counterparties " name="kyc_expected_types_of_counterparties"
        placeholder="" class="fieldRequired">
           </textarea>


    <div id="kyc_authority_DIV">
        <label class="fieldlabels"> Operating Authority of the Account</label>
        <select name="kyc_operation_authority" id="kyc_operation_authority" class="fieldRequired">
            <option value="">Select</option>
            <option value="Myself/ Ourselves">Myself/ Ourselves</option>
            <option value="Power of Attorney">Power of Attorney</option>
            <option value="Guardian">Guardian</option>
            <option value="Other">Other</option>
        </select>


        <div id="kyc_other_authrity_DIV">

            <label class="fieldlabels">Name : *</label>
            <input type="text" id="kyc_other_name" name="kyc_other_name" placeholder=""
                class="{{ $errors->has('kyc_other_name') ? ' is-invalid' : '' }}" />


            <label class="fieldlabels">Address : *</label>
            <textarea type="text" id="kyc_other_address" name="kyc_other_address" placeholder=""
                class="{{ $errors->has('kyc_other_address') ? ' is-invalid' : '' }}">
                    </textarea>


            <label class="fieldlabels">NIC : *</label>
            <input type="text" id="kyc_other_nic" name="kyc_other_nic" placeholder=""
                class="{{ $errors->has('kyc_other_nic') ? ' is-invalid' : '' }}" />

        </div>
    </div>
    <label class="fieldlabels"> Customers Relationship with the bank: *</label>
    <select name="kyc_relationship" id="kyc_relationship" class="fieldRequired">
        <option value="New customer">New customer</option>
        <option value="Existing customer (1 to 5 years)">Existing customer (1 to 5 years)</option>
        <option value="Existing customer (more than 5 years)">Existing customer (more than 5 years)</option>
    </select>

    <label class="fieldlabels">Are you or any member of your family a Politically Exposed person (PEP)? *</label>
    <i>Individuals in Sri Lanka or abroad who are or have been entrusted with prominent public function such as Head of
        State or of
        Government, Senior Politicians, Senior Government, Judicial or Military Officials, Senior Executives of State
        owned Corporations,
        important Political Party Officials, excluding middle ranking or junior officials in the foregoing
        categories</i>
    <select name="kyc_pep" id="kyc_pep" class="fieldRequired">
        <option value="">Select</option>
        <option value="No">No</option>
        <option value="Yes">Yes</option>
    </select>

    <label class="fieldlabels"> Are you a U.S. Person? *</label>
    <i>A citizen of U S.A. (including an individual born in the U.S. but resident in another country, who has not
        renounced U.S. citizenship). A
        lawful resident of the U.S. (including a U.S. Green Card Holder),A person residing in the U.S.,A person who
        spends a certain number of
        days in the U.S. each year, U.S. corporations estates and trusts, any entity that has a linkage ownership lo
        U.S. or to U.S territories Non-
        U.S. entities that have at least one U.S. person as a "substantial beneficial owner</i>
    <select name="kyc_us_person" id="kyc_us_person" class="fieldRequired">
        <option value="">Select</option>
        <option value="No">No</option>
        <option value="Yes">Yes</option>
    </select>


    {{-- <input type="submit" id="btnSave" name="next" class="next action-button" value="Submit" />  
             <a href="{{url()->previous()}}" class="previous action-button-previous" > Back</a>                       --}}
</div>
