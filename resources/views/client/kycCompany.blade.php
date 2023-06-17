@extends('layouts.app')

@section('content')

<style type="text/css" media="screen">
.steps-registration .card{
    padding: 20px;
}
</style>
<form id="msform" method="POST" action="" enctype="multipart/form-data">
    @csrf
<div class="form-card" id="kyc">
    <div class="row">
        <div class="col-7">
            <h2 class="fs-title">KYC Form</h2>
        </div>
       
    </div> 
    <label class="fieldlabels">Name Of the Organization : *</label> 
    <input type="hidden" name="investment_type" value="{{$type}}"/>
    <input type="text" id="kyc_name" name="kyc_name" placeholder="" value="{{$company->name}}" class="fieldRequired {{ $errors->has('kyc_name') ? ' is-invalid' : '' }}" />
    @if($errors->has('kyc_name'))
    <div class="invalid-feedback">
        {{ $errors->first('kyc_name') }}
    </div>
    @endif
    <label class="fieldlabels"> Business Registration No : *</label> 
    <input type="text" id="kyc_registration_no" name="kyc_registration_no" placeholder=""  value="{{$company->business_registration_no}}" class="fieldRequired {{ $errors->has('kyc_registration_no') ? ' is-invalid' : '' }}" />
    @if($errors->has('kyc_registration_no'))
    <div class="invalid-feedback">
        {{ $errors->first('kyc_nic') }}
    </div>
    @endif

    <label class="fieldlabels">Do you have an investment account at NSB FMC  : *</label> 
    <select name="kyc_account_at_NSB_FMC" id="kyc_account_at_NSB_FMC" class="form-control{{$errors->has('kyc_account_at_NSB_FMC') ? ' is-invalid' : '' }}">
        <option value="">Select</option>
        <option value="No">No</option>
        <option value="Yes">Yes</option>
    </select>
    @if($errors->has('kyc_account_at_NSB_FMC'))
    <div class="invalid-feedback">
        {{ $errors->first('kyc_nic') }}
    </div>
    @endif

    <label class="fieldlabels">Nature Of Business : *</label> 
      <input type="text" id="kyc_nature_of_business" name="kyc_nature_of_business" placeholder="" value="{{$company->nature_of_business}}"  class="fieldRequired {{ $errors->has('kyc_nature_of_business') ? ' is-invalid' : '' }}" />
      @if($errors->has('kyc_nature_of_business'))
      <div class="invalid-feedback">
          {{ $errors->first('kyc_nature_of_business') }}
      </div>
      @endif
      
      <label class="fieldlabels">Local Address : *</label> 
      <textarea type="text" id="kyc_permanent_address" name="kyc_permanent_address" placeholder=""  class="fieldRequired {{ $errors->has('kyc_permanent_address') ? ' is-invalid' : '' }}" >
       {{$company->address_line_1}}
       {{$company->address_line_2}}
       {{$company->address_line_3}}
      </textarea>
      @if($errors->has('kyc_permanent_address'))
      <div class="invalid-feedback">
          {{ $errors->first('kyc_permanent_address') }}
      </div>
      @endif

      <label class="fieldlabels">Foriegn Address(if any) : *</label> 
      <textarea type="text" id="kyc_foreign_address " name="kyc_foreign_address" placeholder="" class="form-control {{ $errors->has('kyc_foreign_address') ? ' is-invalid' : '' }}" >
      </textarea>
      @if($errors->has('kyc_foreign_address'))
      <div class="invalid-feedback">
          {{ $errors->first('kyc_foreign_address') }}
      </div>
      @endif

      <label class="fieldlabels">Other  countries involved in business (if any) : *</label> 
      <textarea type="text" id="kyc_other_countries" name="kyc_other_countries" placeholder="" class="form-control {{ $errors->has('kyc_other_countries') ? ' is-invalid' : '' }}" >
      </textarea>
      @if($errors->has('kyc_other_countries'))
      <div class="invalid-feedback">
          {{ $errors->first('kyc_other_countries') }}
      </div>
      @endif

      <label class="fieldlabels">Purpose of Opening the Account : *</label> 
      <select name="kyc_purpose_of_opening_account" id="kyc_purpose_of_opening_account" class=" form-control{{ $errors->has('kyc_purpose_of_opening_account') ? ' is-invalid' : '' }}">
        <option value="">Select</option>
          <option value="Business">Business</option>
          <option value="Investment">Investment</option>
          <option value="Social & Charity">Social & Charity</option>
          <option value="Remittances">Investment</option>
          <option value="Trust">Trust</option>
          <option value="Other">Other</option>
       </select>
       @if($errors->has('kyc_purpose_of_opening_account'))
       <div class="invalid-feedback">
           {{ $errors->first('kyc_purpose_of_opening_account') }}
       </div>
       @endif

       <div id="other_special_purpose_DIV">
       <label class="fieldlabels">Specify Other Purpose : *</label> 
       <input type="text" id="kyc_other_purpose" name="kyc_other_purpose" placeholder="" class="form-control{{ $errors->has('kyc_other_purpose') ? ' is-invalid' : '' }}" />
       @if($errors->has('kyc_other_purpose'))
       <div class="invalid-feedback">
           {{ $errors->first('kyc_other_purpose') }}
       </div>
       @endif
       </div>

       <label class="fieldlabels"> Source of Funds  [Expected source and nature of credits into the account] : *</label> 
       <select name="kyc_source_of_funds" id="kyc_source_of_funds" class="form-control{{$errors->has('kyc_source_of_funds') ? ' is-invalid' : '' }}">
           <option value="">Select</option>
           <option value="Sales and Business Turnover">Sales and Business Turnover</option>
           <option value="Commission Income">Commission Income</option>
           <option value="Export Proceeds">Export Proceeds</option>
           <option value="Contract Proceeds">Contract Proceeds</option>
           <option value="Donations/Charities">Donations/Charities</option>
           <option value="Sale of Property/Assets">Sale of Property/Assets</option>
           <option value="Donations/Charities (Local/Foreign)">Donations/Charities (Local/Foreign)</option>
           <option value="Profit/Professional Income">Profit/Professional Income</option>
           <option value="Investment Proceeds">Investment Proceeds</option>
           <option value="Membership Contributions">Membership Contributions</option>
        </select>
        @if($errors->has('kyc_source_of_funds'))
        <div class="invalid-feedback">
            {{ $errors->first('kyc_source_of_funds') }}
        </div>
        @endif

        <div id="kyc_other_source_DIV">
            <label class="fieldlabels">Specify Other source of income : *</label> 
            <input type="text" id="kyc_other_source" name="kyc_other_source" placeholder="" class="form-control{{$errors->has('kyc_other_source') ? ' is-invalid' : '' }}" />
            @if($errors->has('kyc_other_source'))
            <div class="invalid-feedback">
                {{ $errors->first('kyc_other_source') }}
            </div>
            @endif
        </div>
    
      <label class="fieldlabels"> Anticipated Volumes  [Expected/Usual average volumes of deposits into the account in Rs per month]: *</label> 
       <select name="kyc_anticipated_volume" id="kyc_anticipated_volume" class="form-control{{$errors->has('kyc_anticipated_volume') ? ' is-invalid' : '' }}" >
           <option value="">Select</option>
           <option value="Less than Rs.500,000 (or equivalent FC value)">Less than Rs.500,000 (or equivalent FC value)</option>
           <option value="Rs.500,001 to Rs.1,000,000 (or equivalent FC value)">Rs.500,001 to Rs.1,000,000 (or equivalent FC value)</option>
           <option value="Rs.1,000,001 to Rs.1,500,000 (or equivalent FC value)">Rs.1,000,001 to Rs.1,500,000 (or equivalent FC value)</option>
           <option value="Over Rs.1,500,000 (or equivalent FC value)">Over Rs.1,500,000 (or equivalent FC value)</option>
        </select>
        @if($errors->has('kyc_anticipated_volume'))
        <div class="invalid-feedback">
            {{ $errors->first('kyc_anticipated_volume') }}
        </div>
        @endif

       
        <label class="fieldlabels"> Expected Mode of Transactions/ Delivery Channels: *</label> 
        <select name="kyc_expected_mode_of_transacation" id="kyc_expected_mode_of_transacation" class="form-control{{$errors->has('kyc_anticipated_volume') ? ' is-invalid' : '' }}">
            <option value="">Select</option>
            <option value="Cash">Cash</option>
            <option value="Cheque">Cheque</option>
            <option value="Standing Orders">Standing Orders</option>
            <option value="SLIPS/ Wire Transfer /RTGS">SLIPS/ Wire Transfer /RTGS</option>
            <option value="Foreign Remittance">Foreign Remittance</option>
            <option value="All mode of forms">All mode of forms</option>
         </select>
         @if($errors->has('kyc_expected_mode_of_transacation'))
         <div class="invalid-feedback">
             {{ $errors->first('kyc_expected_mode_of_transacation') }}
         </div>
         @endif

        <label class="fieldlabels">. Other Connected Businesses /Professional Activities / Expected Type of Counterparties:
            (Indicate in brief; Major Customers/Suppliers and Other Connected Parties) (if applicable). (if applicable):</label> 
         <textarea type="text" id="kyc_other_connected_businesses " name="kyc_other_connected_businesses" placeholder="" class="form-control {{ $errors->has('kyc_other_connected_businesses') ? ' is-invalid' : '' }}" >
        </textarea>
            @if($errors->has('kyc_other_connected_businesses'))
            <div class="invalid-feedback">
                {{ $errors->first('kyc_other_connected_businesses') }}
            </div>
            @endif

      
             <table>
                 <tbody>
                    <tr>
                        <th>
                            Property / Premises
                        </th>
                        <td>
                            <input type="number" name="kyc_property" class="form-control{{ $errors->has('kyc_property') ? ' is-invalid' : '' }}"/>
                            @if($errors->has('kyc_property'))
                            <div class="invalid-feedback">
                                {{ $errors->first('kyc_property') }}
                            </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Motor Vehicles
                        </th>
                        <td>
                            <input type="number" name="kyc_motor_vehicles" class="form-control{{ $errors->has('kyc_motor_vehicles') ? ' is-invalid' : '' }}"/>
                            @if($errors->has('kyc_motor_vehicles'))
                            <div class="invalid-feedback">
                                {{ $errors->first('kyc_motor_vehicles') }}
                            </div>
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Financial Assets
                        </th>
                        <td>
                            <input type="number" name="kyc_financial_assets"  class="form-control{{ $errors->has('kyc_financial_assets') ? ' is-invalid' : '' }}"/>
                            @if($errors->has('kyc_financial_assets'))
                            <div class="invalid-feedback">
                                {{ $errors->first('kyc_financial_assets') }}
                            </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Investments
                        </th>
                        <td>
                            <input type="number" name="kyc_investments"   class="form-control{{ $errors->has('kyc_investments') ? ' is-invalid' : '' }}"/>
                            @if($errors->has('kyc_investments'))
                            <div class="invalid-feedback">
                                {{ $errors->first('kyc_investments') }}
                            </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <input type="text" placeholder="Other Investment Name" name="other_assets_name"/>
                        </th>
                        <td>
                            <input type="number" name="other_assets_value" class="form-control"/>
                        </td>
                    </tr>
                 </tbody>
             </table>

             <label class="fieldlabels"> Does the business / entity have any foreign investors? ((i.e. a Foreign Citizen / Dual Citizen/ Non-Resident)  : *</label> 
    <select name="has_foreign_investors" id="has_foreign_investors">
        <option value="0">No</option>
        <option value="1">Yes</option>
    </select>
    <div id="foreign_investers_DIV">
        <div class="col-md-12 table-responsive">
            <table class="table table-bordered table-hover table-sortable" id="tab_logic">
                <thead>
                    <tr >
                        <th class="text-center">
                           Name
                        </th>
                        <th class="text-center">
                            Country
                        </th>
                        <th class="text-center">
                            Percentage of Investment
                        </th>
                        <th class="text-center" style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr id='addr0' data-id="0" class="hidden" style="cursor: move;">
                        <td data-name="Name">
                            <input type="text" name='foreign_investor_name[]'  placeholder=' Name' class="form-control"/>
                        </td>
                        <td data-name="country">
                            <input type="text" name='country[]' placeholder='country' class="form-control"/>
                        </td>
                        <td data-name="percentage">
                            <input type="text" name='percentage[]' placeholder='Percentage' class="form-control"/>
                        </td>
                       
                        <td data-name="del">
                            <button name="del0" type="button" class='btn btn-danger glyphicon glyphicon-remove row-remove'><span aria-hidden="true">×</span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a id="add_row" class="btn btn-primary float-right">Add</a>
        </div>
        <br>
        </div>
    </div> 
    <input type="submit" id="btnSave" name="next" class="next action-button" value="Submit" />  
    <a href="{{route('client.kyc.index')}}" class="previous action-button-previous" > Back</a>       
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
    
 
    $('other_special_purpose_DIV').hide();
    $('#kyc_other_source_DIV').hide();
    $('#foreign_investers_DIV').hide();

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

    $('#has_foreign_investors').change(function(){

        if($(this).val()==1){

        $('#foreign_investers_DIV').show()

        }else{

            $('#foreign_investers_DIV').hide()
        }

});




    $("#add_row").on("click", function() {
        // Dynamic Rows Code
        
        // Get max row id and set new id
        var newid = 0;
        $.each($("#tab_logic tr"), function() {
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
        });
        newid++;
        
        var tr = $("<tr></tr>", {
            id: "addr"+newid,
            "data-id": newid
        });
        
        // loop through each td and create new elements with name of newid
        $.each($("#tab_logic tbody tr:nth(0) td"), function() {
            var td;
            var cur_td = $(this);
            
            var children = cur_td.children();
            
            // add new td and element if it has a nane
            if ($(this).data("name") !== undefined) {
                td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.attr("name", $(cur_td).data("name[]"));
                c.appendTo($(td));
                td.appendTo($(tr));
            } else {
                td = $("<td></td>", {
                    'text': $('#tab_logic tr').length
                }).appendTo($(tr));
            }
        });
        
        // add delete button and td
        /*
        $("<td></td>").append(
            $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
                .click(function() {
                    $(this).closest("tr").remove();
                })
        ).appendTo($(tr));
        */
        
        // add the new row
        $(tr).appendTo($('#tab_logic'));
        
        $(tr).find("td button.row-remove").on("click", function() {
             $(this).closest("tr").remove();
        });
      });
    // Sortable Code
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
    
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        
        return $helper;
    };
  
    $(".table-sortable tbody").sortable({
        helper: fixHelperModified      
    }).disableSelection();
    $(".table-sortable thead").disableSelection();
    $("#add_row").trigger("click");
    });
 




  
</script>
@endsection    
