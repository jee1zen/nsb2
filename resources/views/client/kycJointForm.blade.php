@extends('layouts.app')

@section('content')
    <style type="text/css" media="screen">
        .steps-registration .card {
            padding: 20px;
        }
    </style>
    <div class="d-flex justify-content-center">
        <div class="col-md-6">
            <div class="text-center">
                <img src="{{ asset('storage/images/fmc.jpg') }}" class="rounded-logo" alt="...">
            </div>




            <form id="msform" method="POST"
                action="{{ route('client.kyc.joint.post', [$account_id, $jointHolder->id, $investment_id]) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-card" id="kyc">
                    <div class="row">
                        <div class="col-7">
                            <h2 class="fs-title">KYC Form</h2>
                        </div>

                    </div>

                    <input type="hidden" name="investment_id" value="{{ $investment_id }}" />
                    <label class="fieldlabels">Name in Full : *</label>
                    <input type="text" id="kyc_name" name="kyc_name" placeholder="" value="{{ $jointHolder->name }}"
                        class="fieldRequired {{ $errors->has('kyc_name') ? ' is-invalid' : '' }}" />
                    @if ($errors->has('kyc_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kyc_name') }}
                        </div>
                    @endif
                    <label class="fieldlabels">NIC Number / Passport Number : *</label>
                    <input type="text" id="kyc_nic" name="kyc_nic" placeholder="" value="{{ $jointHolder->nic }}"
                        class="fieldRequired {{ $errors->has('kyc_nic') ? ' is-invalid' : '' }}" />
                    @if ($errors->has('kyc_nic'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kyc_nic') }}
                        </div>
                    @endif

                    <label class="fieldlabels">Do you have an investment account at NSB FMC : *</label>
                    <select name="kyc_account_at_NSB_FMC" id="kyc_account_at_NSB_FMC"
                        class="form-control{{ $errors->has('kyc_account_at_NSB_FMC') ? ' is-invalid' : '' }}" required>
                        <option value="">Select</option>
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                    <div class="form-group">
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

                    </div>

                    <div id="kyc_other_employement_DIV">
                        <label class="fieldlabels">Specify Other Employment Status : *</label>
                        <input type="text" id="kyc_other_employement" name="kyc_other_employement" placeholder=""
                            value=""
                            class="fieldRequired {{ $errors->has('kyc_other_employement') ? ' is-invalid' : '' }}" />
                        @if ($errors->has('kyc_other_employement'))
                            <div class="invalid-feedback">
                                {{ $errors->first('kyc_other_employement') }}
                            </div>
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="kyc_account_at_NSB_FMC" class="form-label"> Nature Of Business : *</label>

                        <select name="kyc_nature_of_business" id="kyc_nature_of_business"
                            class="form-control {{ $errors->has('kyc_nature_of_business') ? 'is-invalid' : '' }}"
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

                    </div>

                    <div id="kyc_nature_of_business_specify_DIV">
                        <label class="fieldlabels"> Nature Of Business Specify : *</label>
                        <input type="text" id="kyc_nature_of_business_specify" name="kyc_nature_of_business_specify"
                            placeholder="" value=" "
                            class="fieldRequired {{ $errors->has('kyc_nature_of_business') ? ' is-invalid' : '' }}" />
                        @if ($errors->has('kyc_nature_of_business_specify'))
                            <div class="invalid-feedback">
                                {{ $errors->first('kyc_nature_of_business_specify') }}
                            </div>
                        @endif
                    </div>



                    <label class="fieldlabels">Occupation/Employement/Position Held : *</label>
                    <input type="text" id="kyc_employment" name="kyc_employment" placeholder=""
                        value="{{ $jointHolder->occupation }}"
                        class="form-control {{ $errors->has('kyc_employment') ? ' is-invalid' : '' }}" />
                    @if ($errors->has('kyc_employment'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kyc_employment') }}
                        </div>
                    @endif
                    <label class="fieldlabels">Name & Address of Employer : *</label>
                    <textarea type="text" id="kyc_employer_address" name="kyc_employer_address" placeholder=""
                        class="form-control {{ $errors->has('kyc_employment') ? ' is-invalid' : '' }}">
{{ $jointHolder->employmentDetails->company_address }}
</textarea>
                    @if ($errors->has('kyc_employer_address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kyc_employer_address') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="kyc_account_at_NSB_FMC" class="form-label">Marital Status : *</label>

                        <select name="kyc_marital_status" id="kyc_marital_status"
                            class="form-control {{ $errors->has('kyc_marital_status') ? 'is-invalid' : '' }}"
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

                    </div>
                    <div id="kyc_marital_status_DIV">
                        <label class="fieldlabels">Name of Spouse : *</label>
                        <input type="text" id="kyc_spouse_name" name="kyc_spouse_name" placeholder=""
                            class="fieldRequired {{ $errors->has('kyc_spouse_name') ? ' is-invalid' : '' }}" />
                        @if ($errors->has('kyc_spouse_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('kyc_spouse_name') }}
                            </div>
                        @endif
                        <label class="fieldlabels">Spouse Occupation Held : *</label>
                        <input type="text" id="kyc_spouse_job" name="kyc_spouse_job" placeholder=""
                            class="fieldRequired {{ $errors->has('kyc_spouse_job') ? ' is-invalid' : '' }}" />
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

                    <label class="fieldlabels">Permanet Address : *</label>
                    <textarea type="text" id="kyc_permanent_address" name="kyc_permanent_address" placeholder=""
                        class="fieldRequired {{ $errors->has('kyc_permanent_address') ? ' is-invalid' : '' }}">{{ $jointHolder->address_line_1 }}
{{ $jointHolder->address_line_2 }}
{{ $jointHolder->address_line_3 }}
      </textarea>
                    @if ($errors->has('kyc_permanent_address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kyc_permanent_address') }}
                        </div>
                    @endif

                    <label class="fieldlabels">Foriegn Address(if any) : *</label>
                    <textarea type="text" id="kyc_foreign_address " name="kyc_foreign_address" placeholder=""
                        class=" {{ $errors->has('kyc_foreign_address') ? ' is-invalid' : '' }}">
      </textarea>
                    @if ($errors->has('kyc_foreign_address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kyc_foreign_address') }}
                        </div>
                    @endif

                    <label class="fieldlabels">Citizenship : *</label>
                    <select name="kyc_citizenship" id="kyc_citizenship" class="fieldRequired">
                        <option value="Sri Lankan">Sri Lankan</option>
                        <option value="Sri Lankan with dual citizenship">Sri Lankan with dual citizenship</option>
                        <option value="Foreign national with dual citizenship">Foreign national with dual citizenship
                        </option>
                        <option value="Foreign National">Foreign National</option>
                    </select>

                    <label class="fieldlabels">Residence : *</label>
                    <select name="kyc_residence" id="kyc_residence" class="fieldRequired">
                        <option value="Resident in Sri Lanka">Resident in Sri Lanka</option>
                        <option value="Non-Resident">Non-Resident</option>
                    </select>
                    <label class="fieldlabels">Country of Residence : *</label>
                    <input type="text" id="kyc_country_of_residence" name="kyc_country_of_residence" placeholder=""
                        class="fieldRequired {{ $errors->has('kyc_nature_of_business') ? ' is-invalid' : '' }}" />
                    @if ($errors->has('kyc_country_of_residence'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kyc_country_of_residence') }}
                        </div>
                    @endif

                    <div id="kyc_foreign_DIV">

                        <label class="fieldlabels">Country of Birth : *</label>
                        <input type="text" id="kyc_country_of_birth" name="kyc_country_of_birth" placeholder=""
                            class="fieldRequired {{ $errors->has('kyc_country_of_birth') ? ' is-invalid' : '' }}" />
                        @if ($errors->has('kyc_country_of_birth'))
                            <div class="invalid-feedback">
                                {{ $errors->first('kyc_country_of_birth') }}
                            </div>
                        @endif

                        <label class="fieldlabels">Nationality : *</label>
                        <input type="text" id="kyc_nationality" name="kyc_nationality" placeholder=""
                            value="{{ $jointHolder->nationality }}"
                            class="fieldRequired {{ $errors->has('kyc_nationality') ? ' is-invalid' : '' }}" />
                        @if ($errors->has('kyc_nationality'))
                            <div class="invalid-feedback">
                                {{ $errors->first('kyc_nationality') }}
                            </div>
                        @endif
                        <label class="fieldlabels">Type Of Visa : *</label>

                        <select name="kyc_type_of_visa" id="kyc_type_of_visa" class="fieldRequired">
                            <option value="Permanent Residence">Permanent Residence</option>
                            <option value="Temporary Residence">Temporary Residence</option>
                            <option value="Green Card">Green Card</option>
                            <option value="other">Other</option>
                        </select>
                        <div id="other_visa_DIV">
                            <label class="fieldlabels">Specify Other Visa : *</label>
                            <input type="text" id="kyc_other_visa_type" name="kyc_other_visa_type" placeholder=""
                                class="{{ $errors->has('kyc_other_visa_type') ? ' is-invalid' : '' }}" />
                            @if ($errors->has('kyc_other_visa_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kyc_other_visa_type') }}
                                </div>
                            @endif
                        </div>

                        <label class="fieldlabels">Expiry Date : *</label>
                        <input type="date" id="kyc_expiry_date" name="kyc_expiry_date" placeholder=""
                            class="{{ $errors->has('kyc_expiry_date') ? ' is-invalid' : '' }}" />
                        @if ($errors->has('kyc_expiry_date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('kyc_expiry_date') }}
                            </div>
                        @endif

                    </div>
                    <label class="fieldlabels"> In case of Foreign Passport Holders, give the purpose of opening the
                        account in the foreign jurisdiction : *</label>
                    <textarea type="text" id="kyc_purpose_account_foreign " name="kyc_purpose_account_foreign" placeholder=""
                        class=" {{ $errors->has('kyc_purpose_account_foreign') ? ' is-invalid' : '' }}">
        </textarea>
                    @if ($errors->has('kyc_purpose_account_foreign'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kyc_purpose_account_foreign') }}
                        </div>
                    @endif

                    <label class="fieldlabels">Purpose of Opening the Account : *</label>
                    <select name="kyc_purpose_of_opening_account" id="kyc_purpose_of_opening_account"
                        class="form-control {{ $errors->has('kyc_purpose_of_opening_account') ? ' is-invalid' : '' }}"
                        required>
                        <option value="">Select</option>
                        <option value="Employment/Professional income">Employment/Professional income</option>
                        <option value="Savings">Savings</option>
                        <option value="Investment purposes">Investment purposes</option>
                        <option value="Remittances">Business transactions</option>
                        <option value="Business transactions">Business transactions</option>
                        <option value="Social & Charity work">Social & Charity work</option>
                        <option value="Other">Other</option>
                    </select>
                    @if ($errors->has('kyc_purpose_of_opening_account'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kyc_purpose_of_opening_account') }}
                        </div>
                    @endif

                    <div id="other_special_purpose_DIV">
                        <label class="fieldlabels">Specify Other Purpose : *</label>
                        <input type="text" id="kyc_other_purpose" name="kyc_other_purpose" placeholder=""
                            class="{{ $errors->has('kyc_other_purpose') ? ' is-invalid' : '' }}" />
                        @if ($errors->has('kyc_other_purpose'))
                            <div class="invalid-feedback">
                                {{ $errors->first('kyc_other_purpose') }}
                            </div>
                        @endif
                    </div>



                    <label class="fieldlabels"> Source of Funds [Expected source and nature of credits into the account] :
                        *</label>
                    <select name="kyc_source_of_funds" id="kyc_source_of_funds"
                        class="form-control{{ $errors->has('kyc_source_of_funds') ? ' is-invalid' : '' }}" required>
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
                        <input type="text" id="kyc_other_source" name="kyc_other_source" placeholder=""
                            class="{{ $errors->has('kyc_other_source') ? ' is-invalid' : '' }}" />
                        @if ($errors->has('kyc_other_source'))
                            <div class="invalid-feedback">
                                {{ $errors->first('kyc_other_source') }}
                            </div>
                        @endif

                    </div>


                    <label class="fieldlabels"> Anticipated Volumes [Expected/Usual average volumes of deposits into the
                        account in Rs per month]: *</label>
                    <select name="kyc_anticipated_volume"
                        id="kyc_anticipated_volume"class="form-control{{ $errors->has('kyc_anticipated_volume') ? ' is-invalid' : '' }}"
                        required>
                        <option value="">Select</option>
                        <option value="Less than Rs.500,000 (or equivalent FC value)">Less than Rs.500,000 (or equivalent
                            FC value)</option>
                        <option value="Rs.500,001 to Rs.2,000,000 (or equivalent FC value)">Rs.500,001 to Rs.2,000,000 (or
                            equivalent FC value)</option>
                        <option value="Rs.2,000,001 to Rs.5,000,000 (or equivalent FC value)">Rs.2,000,001 to Rs.5,000,000
                            (or equivalent FC value)</option>
                        <option value="Over Rs.5,000,000 (or equivalent FC value)">Over Rs.5,000,000 (or equivalent FC
                            value)</option>
                    </select>
                    @if ($errors->has('kyc_anticipated_volume'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kyc_anticipated_volume') }}
                        </div>
                    @endif
                    <label class="fieldlabels"> Expected Mode of Transactions/ Delivery Channels: *</label>
                    <select name="kyc_expected_mode_of_transacation"
                        id="kyc_expected_mode_of_transacation"class="form-control{{ $errors->has('kyc_expected_types_of_counterparties') ? ' is-invalid' : '' }}">
                        <option value="">Select</option>
                        <option value="Cash">Cash</option>
                        <option value="Cheque">Cheque</option>
                        <option value="Standing Orders">Standing Orders</option>
                        <option value="SLIPS/ Wire Transfer /RTGS">SLIPS/ Wire Transfer /RTGS</option>
                        <option value="Foreign Remittance">Foreign Remittance</option>
                        <option value="All mode of forms">All mode of forms</option>
                    </select>
                    @if ($errors->has('kyc_expected_mode_of_transacation'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kyc_expected_mode_of_transacation') }}
                        </div>
                    @endif

                    <label class="fieldlabels"> Other Connected Businesses /Professional Activities (if
                        applicable):</label>
                    <textarea type="text" id="kyc_other_connected_businesses " name="kyc_other_connected_businesses" placeholder=""
                        class=" {{ $errors->has('kyc_other_connected_businesses') ? ' is-invalid' : '' }}">
        </textarea>
                    @if ($errors->has('kyc_other_connected_businesses'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kyc_other_connected_businesses') }}
                        </div>
                    @endif

                    <label class="fieldlabels"> Expected Types of Counterparties (if applicable):</label>
                    <textarea type="text" id="kyc_expected_types_of_counterparties " name="kyc_expected_types_of_counterparties"
                        placeholder=""
                        class="form-control{{ $errors->has('kyc_expected_types_of_counterparties') ? ' is-invalid' : '' }}">
           </textarea>
                    @if ($errors->has('kyc_expected_types_of_counterparties'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kyc_expected_types_of_counterparties') }}
                        </div>
                    @endif

                    <div id="kyc_authority_DIV">
                        <label class="fieldlabels"> Operating Authority of the Account</label>
                        <select name="kyc_operation_authority" id="kyc_operation_authority"
                            class="form-control{{ $errors->has('kyc_operation_authority') ? ' is-invalid' : '' }}"
                            required>
                            <option value="">Select</option>
                            <option value="Myself/ Ourselves">Myself/ Ourselves</option>
                            <option value="Power of Attorney">Power of Attorney</option>
                            <option value="Guardian">Guardian</option>
                            <option value="Other">Other</option>
                        </select>
                        @if ($errors->has('kyc_operation_authority'))
                            <div class="invalid-feedback">
                                {{ $errors->first('kyc_operation_authority') }}
                            </div>
                        @endif

                        <div id="kyc_other_authrity_DIV">

                            <label class="fieldlabels">Name : *</label>
                            <input type="text" id="kyc_other_name" name="kyc_other_name" placeholder=""
                                class="{{ $errors->has('kyc_other_name') ? ' is-invalid' : '' }}" />
                            @if ($errors->has('kyc_other_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kyc_other_name') }}
                                </div>
                            @endif

                            <label class="fieldlabels">Address : *</label>
                            <textarea type="text" id="kyc_other_address" name="kyc_other_address" placeholder=""
                                class="{{ $errors->has('kyc_other_address') ? ' is-invalid' : '' }}">
                    </textarea>
                            @if ($errors->has('kyc_other_address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kyc_other_address') }}
                                </div>
                            @endif

                            <label class="fieldlabels">NIC : *</label>
                            <input type="text" id="kyc_other_nic" name="kyc_other_nic" placeholder=""
                                class="{{ $errors->has('kyc_other_nic') ? ' is-invalid' : '' }}" />
                            @if ($errors->has('kyc_other_nic'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kyc_other_nic') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <label class="fieldlabels"> Customers Relationship with the bank: *</label>
                    <select name="kyc_relationship" id="kyc_relationship" class="fieldRequired">
                        <option value="New customer">New customer</option>
                        <option value="Existing customer (1 to 5 years)">Existing customer (1 to 5 years)</option>
                        <option value="Existing customer (more than 5 years)">Existing customer (more than 5 years)
                        </option>
                    </select>

                    <label class="fieldlabels">Are you or any member of your family a Politically Exposed person (PEP)?
                        *</label>
                    <i>Individuals in Sri Lanka or abroad who are or have been entrusted with prominent public function such
                        as Head of State or of
                        Government, Senior Politicians, Senior Government, Judicial or Military Officials, Senior Executives
                        of State owned Corporations,
                        important Political Party Officials, excluding middle ranking or junior officials in the foregoing
                        categories</i>
                    <select name="kyc_pep" id="kyc_pep" class="fieldRequired" required>
                        <option value="">Select</option>
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>

                    <label class="fieldlabels"> Are you a U.S. Person? *</label>
                    <i>A citizen of U S.A. (including an individual born in the U.S. but resident in another country, who
                        has not renounced U.S. citizenship). A
                        lawful resident of the U.S. (including a U.S. Green Card Holder),A person residing in the U.S.,A
                        person who spends a certain number of
                        days in the U.S. each year, U.S. corporations estates and trusts, any entity that has a linkage
                        ownership lo U.S. or to U.S territories Non-
                        U.S. entities that have at least one U.S. person as a "substantial beneficial owner</i>
                    <select name="kyc_us_person" id="kyc_us_person" class="fieldRequired" required>
                        <option value="">Select</option>
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>


                    <input type="submit" id="btnSave" name="next" class="next action-button" value="Submit" />
                    <a href="{{ route('client.kyc.index') }}" class="previous action-button-previous"> Back</a>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#kyc_foreign_DIV').hide();
            $('#other_visa_DIV').hide();
            $('other_special_purpose_DIV').hide();
            $('#kyc_other_source_DIV').hide();
            $('#kyc_other_authrity_DIV').hide();
            $('#kyc_other_employement_DIV').hide();
            $('#kyc_marital_status_DIV').hide();
            $('#kyc_nature_of_business_specify_DIV').hide();



            $('#kyc_nature_of_business').change(function() {
                if ($(this).val() == 'Other') {
                    $('#kyc_nature_of_business_specify_DIV').show();
                } else {
                    $('#kyc_nature_of_business_specify_DIV').hide();
                }
            });


            $('#kyc_marital_status').change(function() {
                if ($(this).val() == 'Married') {

                    $('#kyc_marital_status_DIV').show();

                } else {
                    $('#kyc_marital_status_DIV').hide();
                }

            });


            $('#kyc_employment_status').change(function() {
                if ($(this).val() == 'Other') {

                    $('#kyc_other_employement_DIV').show();

                } else {
                    $('#kyc_other_employement_DIV').hide();
                }

            });


            $('#kyc_citizenship').change(function() {


                if ($(this).val() !== 'Sri Lankan') {

                    $('#kyc_foreign_DIV').show();

                } else {
                    $('#kyc_foreign_DIV').hide();
                }


            });

            $('#kyc_type_of_visa').change(function() {

                if ($(this).val() === 'other') {
                    $('#other_visa_DIV').show()
                } else {

                    $('#other_visa_DIV').hide()
                }

            });

            $('#kyc_purpose_of_opening_account').change(function() {

                if ($(this).val() === 'Other') {
                    $('#other_special_purpose_DIV').show()
                } else {

                    $('#other_special_purpose_DIV').hide()
                }

            });

            $('#kyc_source_of_funds').change(function() {

                if ($(this).val() === 'Other') {

                    $('#kyc_other_source_DIV').show()

                } else {

                    $('#kyc_other_source_DIV').hide()
                }

            });

            $('#kyc_operation_authority').change(function() {

                if ($(this).val() === 'Other') {

                    $('#kyc_other_authrity_DIV').show()

                } else {

                    $('#kyc_other_authrity_DIV').hide()
                }

            });







        });
    </script>
@endsection
