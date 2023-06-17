@extends('layouts.app')

@section('content')

<style type="text/css" media="screen">
.steps-registration .card{
    padding: 20px;
}
</style>
<form id="msform" method="POST" action="{{route('client.kyc.signature',$signature->id)}}" enctype="multipart/form-data">
    @csrf
<div class="form-card" id="kyc">
    <div class="row">
        <div class="col-7">
            <h2 class="fs-title">KYC Form</h2>
        </div>
       
    </div> 
    <label class="fieldlabels">Name in Full : *</label> 
    <input type="text" id="kyc_name" name="kyc_name" placeholder="" value="{{$signature->name}}" class="fieldRequired {{ $errors->has('kyc_name') ? ' is-invalid' : '' }}" />
    @if($errors->has('kyc_name'))
    <div class="invalid-feedback">
        {{ $errors->first('kyc_name') }}
    </div>
    @endif
    <label class="fieldlabels">NIC Number / Passport Number : *</label> 
    <input type="text" id="kyc_nic" name="kyc_nic" placeholder=""  value="{{$signature->nic}}" class="fieldRequired {{ $errors->has('kyc_nic') ? ' is-invalid' : '' }}" />
    @if($errors->has('kyc_nic'))
    <div class="invalid-feedback">
        {{ $errors->first('kyc_nic') }}
    </div>
    @endif

    <label class="fieldlabels">Do you have an investment account at NSB FMC  : *</label> 
    <select name="kyc_account_at_NSB_FMC" id="kyc_account_at_NSB_FMC">
        <option value="No">No</option>
        <option value="Yes">Yes</option>
    </select>
    <label class="fieldlabels">Nature Of Business : *</label> 
      <input type="text" id="kyc_nature_of_business" name="kyc_nature_of_business" placeholder=""  class="fieldRequired {{ $errors->has('kyc_nature_of_business') ? ' is-invalid' : '' }}" />
      @if($errors->has('kyc_nature_of_business'))
      <div class="invalid-feedback">
          {{ $errors->first('kyc_nature_of_business') }}
      </div>
      @endif
      <label class="fieldlabels">Occupation/Employement/Position Held : *</label> 
      <input type="text" id="kyc_employment" name="kyc_employment" placeholder=""  class="fieldRequired {{ $errors->has('kyc_employment') ? ' is-invalid' : '' }}" />
      @if($errors->has('kyc_employment'))
      <div class="invalid-feedback">
          {{ $errors->first('kyc_employment') }}
      </div>
      @endif
      <label class="fieldlabels">Name & Address of Employer : *</label> 
      <textarea type="text" id="kyc_employer_address" name="kyc_employer_address" placeholder="" class="fieldRequired {{ $errors->has('kyc_employment') ? ' is-invalid' : '' }}" >
      
      </textarea>  
      @if($errors->has('kyc_employer_address'))
      <div class="invalid-feedback">
          {{ $errors->first('kyc_employer_address') }}
      </div>
      @endif

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
      <textarea type="text" id="kyc_permanent_address" name="kyc_permanent_address" placeholder=""  class="fieldRequired {{ $errors->has('kyc_permanent_address') ? ' is-invalid' : '' }}" >
       {{$signature->address_line_1}}
       {{$signature->address_line_2}}
       {{$signature->address_line_3}}
      </textarea>
      @if($errors->has('kyc_permanent_address'))
      <div class="invalid-feedback">
          {{ $errors->first('kyc_permanent_address') }}
      </div>
      @endif

      <label class="fieldlabels">Foriegn Address(if any) : *</label> 
      <textarea type="text" id="kyc_foreign_address " name="kyc_foreign_address" placeholder="" class=" {{ $errors->has('kyc_foreign_address') ? ' is-invalid' : '' }}" >
      </textarea>
      @if($errors->has('kyc_foreign_address'))
      <div class="invalid-feedback">
          {{ $errors->first('kyc_foreign_address') }}
      </div>
      @endif
   
      <label class="fieldlabels">Citizenship : *</label> 
      <select name="kyc_citizenship" id="kyc_citizenship" class="fieldRequired">
        <option value="Sri Lankan">Sri Lankan</option>
        <option value="Sri Lankan with dual citizenship">Sri Lankan with dual citizenship</option>
        <option value="Foreign national with dual citizenship">Foreign national with dual citizenship</option>
        <option value="Foreign National">Foreign National</option>
     </select>

     <label class="fieldlabels">Residence : *</label> 
      <select name="kyc_residence" id="kyc_residence" class="fieldRequired">
        <option value="Resident in Sri Lanka">Resident in Sri Lanka</option>
        <option value="Non-Resident">Non-Resident</option>
     </select>
     <label class="fieldlabels">Country of Residence : *</label> 
     <input type="text" id="kyc_country_of_residence" name="kyc_country_of_residence" placeholder="" class="fieldRequired {{ $errors->has('kyc_nature_of_business') ? ' is-invalid' : '' }}" />
     @if($errors->has('kyc_country_of_residence'))
      <div class="invalid-feedback">
          {{ $errors->first('kyc_country_of_residence') }}
      </div>
      @endif

      <div id="kyc_foreign_DIV">

        <label class="fieldlabels">Country of Birth : *</label> 
        <input type="text" id="kyc_country_of_birth" name="kyc_country_of_birth" placeholder="" class="fieldRequired {{ $errors->has('kyc_country_of_birth') ? ' is-invalid' : '' }}" />
        @if($errors->has('kyc_country_of_birth'))
        <div class="invalid-feedback">
            {{ $errors->first('kyc_country_of_birth') }}
        </div>
        @endif

        <label class="fieldlabels">Nationality : *</label> 
        <input type="text" id="kyc_nationality" name="kyc_nationality" placeholder=""  value="{{$signature->nationality}}" class="fieldRequired {{ $errors->has('kyc_nationality') ? ' is-invalid' : '' }}" />
        @if($errors->has('kyc_nationality'))
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
         <input type="text" id="kyc_other_visa_type" name="kyc_other_visa_type" placeholder="" class="{{ $errors->has('kyc_other_visa_type') ? ' is-invalid' : '' }}" />
         @if($errors->has('kyc_other_visa_type'))
         <div class="invalid-feedback">
             {{ $errors->first('kyc_other_visa_type') }}
         </div>
         @endif
        </div>

         <label class="fieldlabels">Expiry Date : *</label> 
         <input type="date" id="kyc_expiry_date" name="kyc_expiry_date" placeholder="" class="{{ $errors->has('kyc_expiry_date') ? ' is-invalid' : '' }}" />
         @if($errors->has('kyc_expiry_date'))
         <div class="invalid-feedback">
             {{ $errors->first('kyc_expiry_date') }}
         </div>
         @endif

      </div>   
      <label class="fieldlabels"> In case of Foreign Passport Holders, give the purpose of opening the account in the foreign jurisdiction : *</label> 
      <textarea type="text" id="kyc_purpose_account_foreign " name="kyc_purpose_account_foreign" placeholder="" class=" {{ $errors->has('kyc_purpose_account_foreign') ? ' is-invalid' : '' }}" >
        </textarea>
      @if($errors->has('kyc_purpose_account_foreign'))
      <div class="invalid-feedback">
          {{ $errors->first('kyc_purpose_account_foreign') }}
      </div>
      @endif

      <label class="fieldlabels">Purpose of Opening the Account : *</label> 
      <select name="kyc_purpose_of_opening_account" id="kyc_purpose_of_opening_account" class="fieldRequired">
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
       <input type="text" id="kyc_other_purpose" name="kyc_other_purpose" placeholder="" class="{{ $errors->has('kyc_other_purpose') ? ' is-invalid' : '' }}" />
       @if($errors->has('kyc_other_purpose'))
       <div class="invalid-feedback">
           {{ $errors->first('kyc_other_purpose') }}
       </div>
       @endif
       </div>



       <label class="fieldlabels"> Source of Funds  [Expected source and nature of credits into the account] : *</label> 
       <select name="kyc_source_of_funds" id="kyc_source_of_funds" class="fieldRequired">
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

        <div id="kyc_other_source_DIV">
            <label class="fieldlabels">Specify Other source of income : *</label> 
            <input type="text" id="kyc_other_source" name="kyc_other_source" placeholder="" class="{{ $errors->has('kyc_other_source') ? ' is-invalid' : '' }}" />
            @if($errors->has('kyc_other_source'))
            <div class="invalid-feedback">
                {{ $errors->first('kyc_other_source') }}
            </div>
            @endif

        </div>
        

      <label class="fieldlabels"> Anticipated Volumes  [Expected/Usual average volumes of deposits into the account in Rs per month]: *</label> 
       <select name="kyc_anticipated_volume" id="kyc_anticipated_volume" class="fieldRequired">
           <option value="Less than Rs.200,000 (or equivalent FC value)">Less than Rs.200,000 (or equivalent FC value)</option>
           <option value="Rs.200,001 to Rs.500,000 (or equivalent FC value)">Rs.200,001 to Rs.500,000 (or equivalent FC value)</option>
           <option value="Rs.500,001 to Rs.1,000,000 (or equivalent FC value)">Rs.500,001 to Rs.1,000,000 (or equivalent FC value)</option>
           <option value="Over Rs.1,000,000 (or equivalent FC value)">Over Rs.1,000,000 (or equivalent FC value)</option>
        </select>
       
        <label class="fieldlabels"> Expected Mode of Transactions/ Delivery Channels: *</label> 
        <select name="kyc_expected_mode_of_transacation" id="kyc_expected_mode_of_transacation" class="fieldRequired">
            <option value="Cash">Cash</option>
            <option value="Cheque">Cheque</option>
            <option value="Standing Orders">Standing Orders</option>
            <option value="SLIPS/ Wire Transfer /RTGS">SLIPS/ Wire Transfer /RTGS</option>
            <option value="Foreign Remittance">Foreign Remittance</option>
            <option value="All mode of forms">All mode of forms</option>
         </select>

        <label class="fieldlabels"> Other Connected Businesses /Professional Activities (if applicable):</label> 
         <textarea type="text" id="kyc_other_connected_businesses " name="kyc_other_connected_businesses" placeholder="" class=" {{ $errors->has('kyc_other_connected_businesses') ? ' is-invalid' : '' }}" >
        </textarea>
            @if($errors->has('kyc_other_connected_businesses'))
            <div class="invalid-feedback">
                {{ $errors->first('kyc_other_connected_businesses') }}
            </div>
            @endif

            <label class="fieldlabels">  Expected Types of Counterparties (if applicable):</label> 
            <textarea type="text" id="kyc_expected_types_of_counterparties " name="kyc_expected_types_of_counterparties" placeholder="" class=" {{ $errors->has('kyc_expected_types_of_counterparties') ? ' is-invalid' : '' }}" >
           </textarea>
               @if($errors->has('kyc_expected_types_of_counterparties'))
               <div class="invalid-feedback">
                   {{ $errors->first('kyc_expected_types_of_counterparties') }}
               </div>
               @endif   

             <div id="kyc_authority_DIV">  
               <label class="fieldlabels"> Operating Authority of the Account</label> 
               <select name="kyc_operation_authority" id="kyc_operation_authority" class="fieldRequired">
                   <option value="Myself/ Ourselves">Myself/ Ourselves</option>
                   <option value="Power of Attorney">Power of Attorney</option>
                   <option value="Guardian">Guardian</option>
                   <option value="Other">Other</option>
                </select>
                <div id="kyc_other_authrity_DIV">

                    <label class="fieldlabels">Name : *</label> 
                    <input type="text" id="kyc_other_name" name="kyc_other_name" placeholder="" class="{{ $errors->has('kyc_other_name') ? ' is-invalid' : '' }}" />
                    @if($errors->has('kyc_other_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kyc_other_name') }}
                    </div>
                    @endif

                    <label class="fieldlabels">Address : *</label> 
                    <textarea type="text" id="kyc_other_address" name="kyc_other_address" placeholder="" class="{{ $errors->has('kyc_other_address') ? ' is-invalid' : '' }}">
                    </textarea>
                    @if($errors->has('kyc_other_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kyc_other_address') }}
                    </div>
                    @endif

                    <label class="fieldlabels">NIC : *</label> 
                    <input type="text" id="kyc_other_nic" name="kyc_other_nic" placeholder="" class="{{ $errors->has('kyc_other_nic') ? ' is-invalid' : '' }}" />
                    @if($errors->has('kyc_other_nic'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kyc_other_nic') }}
                    </div>
                    @endif
                </div>   
             </div>
            
             <input type="submit" id="btnSave" name="next" class="next action-button" value="Submit" /> 
             <a href="{{route('client.kyc.index')}}" class="previous action-button-previous" > Back</a>                
 </div> 
</form>

@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script>
$( document ).ready(function() {
    
    $('#kyc_foreign_DIV').hide();
    $('#other_visa_DIV').hide();
    $('other_special_purpose_DIV').hide();
    $('#kyc_other_source_DIV').hide();
    $('#kyc_other_authrity_DIV').hide();


    $('#kyc_citizenship').change(function(){

       
        if($(this).val()!=='Sri Lankan'){

            $('#kyc_foreign_DIV').show();

        }else{
            $('#kyc_foreign_DIV').hide();
        }


    });

    $('#kyc_type_of_visa').change(function(){

        if($(this).val()==='other'){
        $('#other_visa_DIV').show()
        }else{

            $('#other_visa_DIV').hide()
        }

    });

    $('#kyc_purpose_of_opening_account').change(function(){

        if($(this).val()==='Other'){
        $('#other_special_purpose_DIV').show()
        }else{

            $('#other_special_purpose_DIV').hide()
        }

    });

    $('#kyc_source_of_funds').change(function(){

        if($(this).val()==='Other'){

        $('#kyc_other_source_DIV').show()

        }else{

            $('#kyc_other_source_DIV').hide()
        }

    });

    $('#kyc_operation_authority').change(function(){

    if($(this).val()==='Other'){

    $('#kyc_other_authrity_DIV').show()

    }else{

        $('#kyc_other_authrity_DIV').hide()
    }

    });

   
    




});


  
</script>
@endsection    
