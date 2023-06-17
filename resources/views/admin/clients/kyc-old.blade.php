<div class="tab-pane" id="2a">
    <h3>KYC INFO</h3>
  @if ($client->hasKyc())
     <table class="table table-bordered  table-hover">
         <tbody>
      <tr>
          <th>
              Have a Investment at NSB FMC
          </th>
          <td>
           {{$kyc->kyc_account_at_NSB_FMC}}
          
          </td>
          <td>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_account_at_NSB_FMC_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_account_at_NSB_FMC_verify",$kyc->kyc_account_at_NSB_FMC_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              Status of the Residential Address:
          </th>
          <td>
           {{$kyc->kyc_ownership_of_premises}}
          
          </td>
          @php
          if($kyc->kyc_ownership_of_premises=='Owner' || $kyc->kyc_ownership_of_premises=="Parent's"){
              $rate = 0.05;
              $color = "grey";
              $label = "low";
          }elseif($kyc->kyc_ownership_of_premises=="Lease/Rent" || $kyc->kyc_ownership_of_premises=="Official"){
              $rate = 0.10;
              $color = "yellow";
              $label = "Medium";
          }else{
              $rate = 0.15;
              $color = "red";
              $label = "high";
          }
         @endphp
          <td style="background-color: {{$color}}">
          

             <b>{{$label}}</b><br>
             <b class="rateB"> {{$rate}}</b>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_ownership_of_premises_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_ownership_of_premises_verify",$kyc->kyc_ownership_of_premises_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              Foreign Address (if any):
          </th>
          <td>
           {{$kyc->kyc_foreign_address}}
          
          </td>
          <td>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_foreign_address_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_foreign_address_verify",$kyc->kyc_foreign_address_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              Citizenship
          </th>
          <td>
           {{$kyc->kyc_citizenship}}
          
          </td>
          @php
          if($kyc->kyc_citizenship=='Sri Lankan' && $kyc->kyc_residence=="Resident in Sri Lanka"){
              $rate = 0.05;
              $color = "grey";
              $label = "low";
          }elseif($kyc->kyc_citizenship=="Sri Lankan" &&  $kyc->kyc_residence=="Non-Resident"){
              $rate = 0.10;
              $color = "yellow";
              $label = "Medium";
          }elseif($kyc->kyc_citizenship=="Sri Lankan with dual citizenship"){
              $rate = 0.10;
              $color = "yellow";
              $label = "Medium";
          }else{
              $rate = 0.15;
              $color = "red";
              $label = "high";
          }
         @endphp
          <td style="background-color: {{$color}}">
              <b>{{$label}}</b><br>
              <b class="rateB"> {{$rate}}</b>
          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_citizenship_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_citizenship_verify",$kyc->kyc_citizenship_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              Residence
          </th>
          <td>{{$kyc->kyc_residence}}</td>
          <td></td>
          <td><input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_residence_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_residence_verify",$kyc->kyc_residence_verify,
             $kyc->id)))}}">
          </td>
      </tr>
      <tr>
          <th>
              Country of Residence
          </th>
          <td>
           {{$kyc->kyc_country_of_residence}}
          
          </td>
          <td>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_country_of_residence_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_country_of_residence_verify",$kyc->kyc_country_of_residence_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              Country of Birth:
          </th>
          <td>
           {{$kyc->kyc_country_of_birth}}
          
          </td>
          <td>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_country_of_birth_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_country_of_birth_verify",$kyc->kyc_country_of_birth_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              Nationality:
          </th>
          <td>
           {{$kyc->kyc_nationality}}
          
          </td>
          <td>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_nationality_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_nationality_verify",$kyc->kyc_nationality_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              Type of Visa
          </th>
          <td>
           {{$kyc->kyc_type_of_visa}}
          
          </td>
          <td>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_type_of_visa_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_type_of_visa_verify",$kyc->kyc_type_of_visa_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              Expiry Date
          </th>
          <td>
           {{$kyc->kyc_expiry_date}}
          
          </td>
          <td>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_expiry_date_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_expiry_date_verify",$kyc->kyc_expiry_date_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              In case of Foreign Passport Holders, give the purpose of opening the account in the foreign jurisdiction:
          </th>
          <td>
           {{$kyc->kyc_purpose_account_foreign}}
          
          </td>
          <td>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_purpose_account_foreign_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_purpose_account_foreign_verify",$kyc->kyc_purpose_account_foreign_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              Purpose of Opening the Account:
          </th>
          <td>
           {{$kyc->kyc_purpose_of_opening_account}}
          
          </td>
          @php
          if($kyc->kyc_purpose_of_opening_account=="Employment/Professional income"){
              $rate = 0.20;
              $color = "grey";
              $label = "low";
          }elseif($kyc->kyc_purpose_of_opening_account=="Savings" || 
           $kyc->kyc_purpose_of_opening_account=="Investment purposes" ||
           $kyc->kyc_purpose_of_opening_account=="Remittances" ){
              $rate = 0.0;
              $color = "yellow";
              $label = "Medium";
          
          }else{
              $rate = 0.60;
              $color = "red";
              $label = "high";
          }
         @endphp
          <td style="background-color: {{$color}}">
              <b>{{$label}}</b><br>
              <b class="rateB"> {{$rate}}</b>
          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_purpose_of_opening_account_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_purpose_of_opening_account_verify",$kyc->kyc_purpose_of_opening_account_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
  
      <tr>
          <th>
             Other Purpose
          </th>
          <td>
           {{$kyc->kyc_other_purpose}}
          
          </td>
          <td>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_other_purpose_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_account_at_NSB_FMC",$kyc->kyc_other_purpose_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              Source of Funds: [Expected source and nature of credits into the account]
          </th>
          <td>
           {{$kyc->kyc_source_of_funds}}
          
          </td>
          @php
          if($kyc->kyc_source_of_funds=="Salary/Profit/Professional Income"){
              $rate = 0.25;
              $color = "grey";
              $label = "low";
          }elseif($kyc->kyc_source_of_funds=="Sales and Business Turnover" || 
           $kyc->kyc_source_of_funds=="Sale of Property/Assets" ||
           $kyc->kyc_source_of_funds=="Sales and Business Turnover" ||
           $kyc->kyc_source_of_funds =="Rent Income" ||
           $kyc->kyc_source_of_funds =="Remittances" ||
           $kyc->kyc_source_of_funds =="Investment Proceeds" ||
           $kyc->kyc_source_of_funds =="Export Proceeds" ){
              $rate = 0.50;
              $color = "yellow";
              $label = "Medium";
          
          }else{
              $rate = 0.75;
              $color = "red";
              $label = "high";
          }
         @endphp
          <td style="background-color: {{$color}}">
              <b>{{$label}}</b><br>
              <b class="rateB"> {{$rate}}</b>
          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_source_of_funds_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_source_of_funds_verify",$kyc->kyc_source_of_funds_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              Other Source Of fund
          </th>
          <td>
           {{$kyc->kyc_other_source}}
          
          </td>
          <td>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_other_source_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_other_source_verify",$kyc->kyc_other_source_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              Anticipated Volumes: [Expected/Usual average volumes of deposits into the account in Rs per month]
          </th>
          <td>
           {{$kyc->kyc_anticipated_volume}}
          
          </td>
          @php
          if($kyc->kyc_anticipated_volume=="Less than Rs.200,000 (or equivalent FC value)" ||
             $kyc->kyc_anticipated_volume=="Rs.200,001 to Rs.500,000 (or equivalent FC value)"){
              $rate = 0.20;
              $color = "grey";
              $label = "low";
          }elseif($kyc->kyc_anticipated_volume=="Rs.500,001 to Rs.1,000,000 (or equivalent FC value"){
              $rate = 0.20;
              $color = "yellow";
              $label = "Medium";
          
          }else{
              $rate = 0.30;
              $color = "red";
              $label = "high";
          }
         @endphp

          <td style="background-color: {{$color}}">
              <b>{{$label}}</b><br>
              <b class="rateB"> {{$rate}}</b>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_anticipated_volume_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_anticipated_volume_verify",$kyc->kyc_anticipated_volume_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
   
      <tr>
          <th>
            Expected Mode of Transactions/ Delivery Channels:
          </th>
          <td>
           {{$kyc->kyc_expected_mode_of_transacation}}
          
          </td>
          @php
          if($kyc->kyc_expected_mode_of_transacation=="Cheque" ||
             $kyc->kyc_expected_mode_of_transacation=="Standing Orders"){
              $rate = 0.15;
              $color = "grey";
              $label = "low";
          }elseif($kyc->kyc_expected_mode_of_transacation=="Cash"){
              $rate = 0.30;
              $color = "yellow";
              $label = "Medium";

          }else{
              $rate = 0.45;
              $color = "red";
              $label = "high";
          }
         @endphp
          <td style="background-color: {{$color}}">
              <b>{{$label}}</b><br>
              <b class="rateB"> {{$rate}}</b>
          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_expected_mode_of_transacation_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_expected_mode_of_transacation_verify",$kyc->kyc_expected_mode_of_transacation_verify,
                             $kyc->id)))}}">
           </td>
      </tr>
      <tr>
          <th>
              Other Connected Businesses /Professional Activities (if applicable):
          </th>
          <td>
           {{$kyc->kyc_other_connected_businesses}}
          
          </td>
          <td>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_other_connected_businesses_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_other_connected_businesses_verify",$kyc->kyc_other_connected_businesses_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              Expected Types of Counterparties (if applicable)
          </th>
          <td>
           {{$kyc->kyc_expected_types_of_counterparties}}
          
          </td>
          <td>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_expected_types_of_counterparties_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_expected_types_of_counterparties_verify",$kyc->kyc_expected_types_of_counterparties_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th> Customer Type</th>
          <td>   {{ Config::get('constants.CLIENT_TYPE')[$client->client_type] }}   </td>
          @php
          if($client->client_type==1){
              $rate = 0.05;
              $color = "grey";
              $label = "low";
          }elseif($client->client_type==2){
              $rate = 0.10;
              $color = "yellow";
              $label = "Medium";

          }else{
              $rate = 0.15;
              $color = "red";
              $label = "high";
          }
         @endphp
          <td style="background-color: {{$color}}">
              <b>{{$label}}</b><br>
              <b class="rateB"> {{$rate}}</b>
          </td>
          <td></td>
      </tr>
      <tr>
          <th>
              Relationship With Bank

          </th>
          <td>
              {{$kyc->kyc_relationship}}
          </td>
          @php
              if($kyc->kyc_relationship=='Existing customer (more than 5 years)'){
                  $rate = 0.05;
                  $color = "grey";
                  $label = "low";

              }elseif($kyc->kyc_relationship=='Existing customer (1 to 5 years)'){
                  $rate = 0.10;
                  $color = "yellow";
                  $label = "Medium";

              }else{
                  $rate = 0.15;
                  $color = "red";
                  $label = "high";

              }
          @endphp
          <td style="background-color: {{$color}}">
              <b>{{$label}}</b><br>
              <b class="rateB"> {{$rate}}</b>
          </td>
          <td>
              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_relationship_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","relationship_verify",$kyc->kyc_relationship_verify,
             $kyc->id)))}}">

          </td>

      </tr>
      <tr>
          <th>
              Politically exposed person

          </th>
          <td>
              {{$kyc->kyc_pep}}
          </td>
          @php
              if($kyc->kyc_pep=='Yes'){
                  $rate = 0.05;
                  $color = "red";
                  $label = "high";

              

              }else{
                  $rate = "";
                  $color = "";
                  $label = "";

              }
          @endphp
          <td style="background-color: {{$color}}">
              <b>{{$label}}</b><br>
              <b class="rateB"> {{$rate==$rate?$rate:""}}</b>
          </td>
          <td>
              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_pep_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","pep_verify",$kyc->kyc_pep_verify,
             $kyc->id)))}}">

          </td>

      </tr>
      <tr>
          <th>
              Customer Identification & Bill Verification
          </th>
          <td> Done!</td>
          @php
              $rate=0.1;
              $color='grey';
              $label='low'
          @endphp
          <td style="background-color: {{$color}}">
              <b>{{$label}}</b><br>
              <b class="rateB"> {{$rate==$rate?$rate:""}}</b>
          </td>
          <td></td>
      </tr>
      <tr>
          <th>
              Operating Authority of the Account
          </th>
          <td>
           {{$kyc->kyc_operation_authority}}
          
          </td>
          <td></td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_operation_authority_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_operation_authority_verify",$kyc->kyc_operation_authority_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
    
      <tr>
          <th>
             Name
          </th>
          <td>
           {{$kyc->kyc_other_name}}
          
          </td>
          <td>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_other_name_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_other_name_verify",$kyc->kyc_other_name_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              Address
          </th>
          <td>
           {{$kyc->kyc_other_address}}
          
          </td>
          <td>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_other_address_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_other_address_verify",$kyc->kyc_other_address_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      <tr>
          <th>
              NIC
          </th>
          <td>
           {{$kyc->kyc_other_nic}}
          
          </td>
          <td>

          </td>
           <td>

              <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_other_nic_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                              <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_forms","kyc_other_nic_verify",$kyc->kyc_other_nic_verify,
                             $kyc->id)))}}">

           </td>
      </tr>
      </tbody>
     </table>
   @endif  
   @if ($client->hasJointHolders())

   @foreach ($client->jointHolders()->get() as $jointHolder)
       
          <h3>{{$jointHolder->name}} - Joint Holder</h3>

   <table class="table table-bordered  table-hover">
       @php
           $jkyc = $jointHolder->kycByInvestmentId($client->returnMainInvestmentId());
       @endphp
      <tbody>
          <tr>
              <th>
                  Have a Investment at NSB FMC
              </th>
              <td>
               {{$jkyc->kyc_account_at_NSB_FMC}} 
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_account_at_NSB_FMC_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_account_at_NSB_FMC_verify",$jkyc->kyc_account_at_NSB_FMC_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Nature Of Businesss
              </th>
              <td>
               {{$jkyc->kyc_nature_of_business}} 
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_nature_of_business_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_nature_of_business_verify",$jkyc->kyc_nature_of_business_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                 Employment
              </th>
              <td>
               {{$jkyc->kyc_employment}} 
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_employment_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_employment_verify",$jkyc->kyc_employment_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                 Employment Address
              </th>
              <td>
               {{$jkyc->kyc_employer_address}} 
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_employer_address_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_employer_address_verify",$jkyc->kyc_employer_address_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Status of the Residential Address:
              </th>
              <td>
               {{$jkyc->kyc_ownership_of_premises}}
              
              </td>
              @php
              if($jkyc->kyc_ownership_of_premises=='Owner' || $kyc->kyc_ownership_of_premises=="Parent's"){
                  $rate = 0.05;
                  $color = "grey";
                  $label = "low";
              }elseif($jkyc->kyc_ownership_of_premises=="Lease/Rent" || $kyc->kyc_ownership_of_premises=="Official"){
                  $rate = 0.10;
                  $color = "yellow";
                  $label = "Medium";
              }else{
                  $rate = 0.15;
                  $color = "red";
                  $label = "high";
              }
             @endphp
              <td style="background-color: {{$color}}">
              

                 <b>{{$label}}</b><br>
                 <b class="rateB"> {{$rate}}</b>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_ownership_of_premises_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_ownership_of_premises_verify",$jkyc->kyc_ownership_of_premises_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Foreign Address (if any):
              </th>
              <td>
               {{$jkyc->kyc_foreign_address}}
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_foreign_address_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_foreign_address_verify",$jkyc->kyc_foreign_address_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Citizenship
              </th>
              <td>
               {{$jkyc->kyc_citizenship}}
              
              </td>
              @php
              if($jkyc->kyc_citizenship=='Sri Lankan' && $kyc->kyc_residence=="Resident in Sri Lanka"){
                  $rate = 0.05;
                  $color = "grey";
                  $label = "low";
              }elseif($jkyc->kyc_citizenship=="Sri Lankan" &&  $kyc->kyc_residence=="Non-Resident"){
                  $rate = 0.10;
                  $color = "yellow";
                  $label = "Medium";
              }elseif($jkyc->kyc_citizenship=="Sri Lankan with dual citizenship"){
                  $rate = 0.10;
                  $color = "yellow";
                  $label = "Medium";
              }else{
                  $rate = 0.15;
                  $color = "red";
                  $label = "high";
              }
             @endphp
              <td style="background-color: {{$color}}">
                  <b>{{$label}}</b><br>
                  <b class="rateB"> {{$rate}}</b>
              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_citizenship_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_citizenship_verify",$jkyc->kyc_citizenship_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Country of Residence
              </th>
              <td>
               {{$jkyc->kyc_country_of_residence}}
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_country_of_residence_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_country_of_residence_verify",$jkyc->kyc_country_of_residence_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Country of Birth:
              </th>
              <td>
               {{$jkyc->kyc_country_of_birth}}
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_country_of_birth_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_country_of_birth_verify",$jkyc->kyc_country_of_birth_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Nationality:
              </th>
              <td>
               {{$jkyc->kyc_nationality}}
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_nationality_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_nationality_verify",$jkyc->kyc_nationality_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Type of Visa
              </th>
              <td>
               {{$jkyc->kyc_type_of_visa}}
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_type_of_visa_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_type_of_visa_verify",$jkyc->kyc_type_of_visa_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Expiry Date
              </th>
              <td>
               {{$jkyc->kyc_expiry_date}}
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_expiry_date_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_expiry_date_verify",$jkyc->kyc_expiry_date_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  In case of Foreign Passport Holders, give the purpose of opening the account in the foreign jurisdiction:
              </th>
              <td>
               {{$jkyc->kyc_purpose_account_foreign}}
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_purpose_account_foreign_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_purpose_account_foreign_verify",$jkyc->kyc_purpose_account_foreign_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Purpose of Opening the Account:
              </th>
              <td>
               {{$jkyc->kyc_purpose_of_opening_account}}
              
              </td>
              @php
              if($jkyc->kyc_purpose_of_opening_account=="Employment/Professional income"){
                  $rate = 0.20;
                  $color = "grey";
                  $label = "low";
              }elseif($jkyc->kyc_purpose_of_opening_account=="Savings" || 
               $jkyc->kyc_purpose_of_opening_account=="Investment purposes" ||
               $jkyc->kyc_purpose_of_opening_account=="Remittances" ){
                  $rate = 0.0;
                  $color = "yellow";
                  $label = "Medium";
              
              }else{
                  $rate = 0.60;
                  $color = "red";
                  $label = "high";
              }
             @endphp
              <td style="background-color: {{$color}}">
                  <b>{{$label}}</b><br>
                  <b class="rateB"> {{$rate}}</b>
              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_purpose_of_opening_account_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_purpose_of_opening_account_verify",$jkyc->kyc_purpose_of_opening_account_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                 Other Purpose
              </th>
              <td>
               {{$jkyc->kyc_other_purpose}}
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_other_purpose_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_account_at_NSB_FMC",$jkyc->kyc_other_purpose_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Source of Funds: [Expected source and nature of credits into the account]
              </th>
              <td>
               {{$jkyc->kyc_source_of_funds}}
              
              </td>
              @php
              if($jkyc->kyc_source_of_funds=="Salary/Profit/Professional Income"){
                  $rate = 0.25;
                  $color = "grey";
                  $label = "low";
              }elseif($jkyc->kyc_source_of_funds=="Sales and Business Turnover" || 
               $jkyc->kyc_source_of_funds=="Sale of Property/Assets" ||
               $jkyc->kyc_source_of_funds=="Sales and Business Turnover" ||
               $jkyc->kyc_source_of_funds =="Rent Income" ||
               $jkyc->kyc_source_of_funds =="Remittances" ||
               $jkyc->kyc_source_of_funds =="Investment Proceeds" ||
               $jkyc->kyc_source_of_funds =="Export Proceeds" ){
                  $rate = 0.50;
                  $color = "yellow";
                  $label = "Medium";
              
              }else{
                  $rate = 0.75;
                  $color = "red";
                  $label = "high";
              }
             @endphp
              <td style="background-color: {{$color}}">
                  <b>{{$label}}</b><br>
                  <b class="rateB"> {{$rate}}</b>
              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_source_of_funds_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_source_of_funds_verify",$jkyc->kyc_source_of_funds_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Other Source Of fund
              </th>
              <td>
               {{$jkyc->kyc_other_source}}
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_other_source_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_other_source_verify",$jkyc->kyc_other_source_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Anticipated Volumes: [Expected/Usual average volumes of deposits into the account in Rs per month]
              </th>
              <td>
               {{$jkyc->kyc_anticipated_volume}}
              
              </td>
              @php
              if($jkyc->kyc_anticipated_volume=="Less than Rs.200,000 (or equivalent FC value)" ||
                 $jkyc->kyc_anticipated_volume=="Rs.200,001 to Rs.500,000 (or equivalent FC value)"){
                  $rate = 0.20;
                  $color = "grey";
                  $label = "low";
              }elseif($jkyc->kyc_anticipated_volume=="Rs.500,001 to Rs.1,000,000 (or equivalent FC value"){
                  $rate = 0.20;
                  $color = "yellow";
                  $label = "Medium";
              
              }else{
                  $rate = 0.30;
                  $color = "red";
                  $label = "high";
              }
             @endphp

              <td style="background-color: {{$color}}">
                  <b>{{$label}}</b><br>
                  <b class="rateB"> {{$rate}}</b>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_anticipated_volume_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_anticipated_volume_verify",$jkyc->kyc_anticipated_volume_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                Expected Mode of Transactions/ Delivery Channels:
              </th>
              <td>
               {{$jkyc->kyc_expected_mode_of_transacation}}
              
              </td>
              @php
              if($jkyc->kyc_expected_mode_of_transacation=="Cheque" ||
                 $jkyc->kyc_expected_mode_of_transacation=="Standing Orders"){
                  $rate = 0.15;
                  $color = "grey";
                  $label = "low";
              }elseif($jkyc->kyc_expected_mode_of_transacation=="Cash"){
                  $rate = 0.30;
                  $color = "yellow";
                  $label = "Medium";

              }else{
                  $rate = 0.45;
                  $color = "red";
                  $label = "high";
              }
             @endphp
              <td style="background-color: {{$color}}">
                  <b>{{$label}}</b><br>
                  <b class="rateB"> {{$rate}}</b>
              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_expected_mode_of_transacation_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_expected_mode_of_transacation_verify",$jkyc->kyc_expected_mode_of_transacation_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Other Connected Businesses /Professional Activities (if applicable):
              </th>
              <td>
               {{$jkyc->kyc_other_connected_businesses}}
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_other_connected_businesses_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_other_connected_businesses_verify",$jkyc->kyc_other_connected_businesses_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Expected Types of Counterparties (if applicable)
              </th>
              <td>
               {{$jkyc->kyc_expected_types_of_counterparties}}
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_expected_types_of_counterparties_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_expected_types_of_counterparties_verify",$jkyc->kyc_expected_types_of_counterparties_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Operating Authority of the Account
              </th>
              <td>
               {{$jkyc->kyc_operation_authority}}
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$kyc->kyc_operation_authority_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_operation_authority_verify",$kyc->kyc_operation_authority_verify,
                                 $kyc->id)))}}">

               </td>
          </tr>
          <tr>
              <tr>
                  <th> Customer Type</th>
                  <td>   {{ Config::get('constants.CLIENT_TYPE')[$client->client_type] }}   </td>
                  @php
                  if($client->client_type==1){
                      $rate = 0.05;
                      $color = "grey";
                      $label = "low";
                  }elseif($client->client_type==2){
                      $rate = 0.10;
                      $color = "yellow";
                      $label = "Medium";

                  }else{
                      $rate = 0.15;
                      $color = "red";
                      $label = "high";
                  }
                 @endphp
                  <td style="background-color: {{$color}}">
                      <b>{{$label}}</b><br>
                      <b class="rateB"> {{$rate}}</b>
                  </td>
                  <td></td>
              </tr>
              <tr>
                  <th>
                      Relationship With Bank

                  </th>
                  <td>
                      {{$jkyc->kyc_relationship}}
                  </td>
                  @php
                      if($jkyc->kyc_relationship=='Existing customer (more than 5 years)'){
                          $rate = 0.05;
                          $color = "grey";
                          $label = "low";

                      }elseif($jkyc->kyc_relationship=='Existing customer (1 to 5 years)'){
                          $rate = 0.10;
                          $color = "yellow";
                          $label = "Medium";

                      }else{
                          $rate = 0.15;
                          $color = "red";
                          $label = "high";

                      }
                  @endphp
                  <td style="background-color: {{$color}}">
                      <b>{{$label}}</b><br>
                      <b class="rateB"> {{$rate}}</b>
                  </td>
                  <td>
                      <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_relationship_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                      <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","relationship_verify",$jkyc->kyc_relationship_verify,
                     $kyc->id)))}}">

                  </td>

              </tr>
              <tr>
                  <th>
                      Politically exposed person

                  </th>
                  <td>
                      {{$jkyc->kyc_pep}}
                  </td>
                  @php
                      if($jkyc->kyc_pep=='Yes'){
                          $rate = 0.05;
                          $color = "red";
                          $label = "high";

                      

                      }else{
                          $rate = "";
                          $color = "";
                          $label = "";

                      }
                  @endphp
                  <td style="background-color: {{$color}}">
                      <b>{{$label}}</b><br>
                      <b class="rateB"> {{$rate==$rate?$rate:""}}</b>
                  </td>
                  <td>
                      <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_pep_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                      <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","pep_verify",$jkyc->kyc_pep_verify,
                     $kyc->id)))}}">

                  </td>

              </tr>
              <tr>
                  <th>
                      Customer Identification & Bill Verification
                  </th>
                  <td> Done!</td>
                  @php
                      $rate=0.1;
                      $color='grey';
                      $label='low'
                  @endphp
                  <td style="background-color: {{$color}}">
                      <b>{{$label}}</b><br>
                      <b class="rateB"> {{$rate==$rate?$rate:""}}</b>
                  </td>
                  <td></td>
              </tr>
              <th>
                 Name
              </th>
              <td>
               {{$jkyc->kyc_other_name}}
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_other_name_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_other_name_verify",$jkyc->kyc_other_name_verify,
                                 $jkyc->id)))}}">

               </td>
          </tr>
          <tr>
              <th>
                  Address
              </th>
              <td>
               {{$jkyc->kyc_other_address}}
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_other_address_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_other_address_verify",$jkyc->kyc_other_address_verify,
                                 $jkyc->id)))}}">
               </td>
          </tr>
          <tr>
              <th>
                  NIC
              </th>
              <td>
               {{$jkyc->kyc_other_nic}}
              
              </td>
              <td>

              </td>
               <td>

                  <input type="checkbox" class="checkBoxVerify" {{$jkyc->kyc_other_nic_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_joint_forms","kyc_other_nic_verify",$jkyc->kyc_other_nic_verify,
                                 $kyc->id)))}}">
               </td>
          </tr>
        </tbody>         
      </table>       
      @endforeach
      @endif
      @if($client->company->hasKyc())
      @php
         $ckyc = $client->company->kycWithType($client->investments()->first()->investment_type_id);
      @endphp
           
    
         <h3>Company KYC - {{$client->company->name}}</h3>
     
             <table class="table table-bordered  table-hover">
                <tbody>
                  <tr>
                      <td>Have an investment account at NSB FMC?</td>
                      <td>{{$ckyc->kyc_account_at_NSB_FMC==1 ?"Yes" :"no" }}</td>
                      <td>

                      </td>
                      <td>
                          <input type="checkbox" class="checkBoxVerify" {{$ckyc->kyc_account_at_NSB_FMC_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                          <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_companies","kyc_account_at_NSB_FMC_verify",$ckyc->kyc_account_at_NSB_FMC_verify,
                         $ckyc->id)))}}">
                      </td>     
                  </tr>
                  <tr>
                      <td> Foreign Address (if any)</td>
                      <td>{{$ckyc->kyc_foreign_address }}</td>
                      <td>

                      </td>
                      <td>
                          <input type="checkbox" class="checkBoxVerify" {{$ckyc->kyc_foreign_address_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                          <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_companies","kyc_foreign_address_verify",$ckyc->kyc_foreign_address_verify,
                         $ckyc->id)))}}">
                      </td>     
                  </tr>
                  <tr>
                      <td>Countries involved in the Business (if any)</td>
                      <td>{{$ckyc->kyc_countries }}</td>
                      <td>

                      </td>
                      <td>
                          <input type="checkbox" class="checkBoxVerify" {{$ckyc->kyc_countries_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                          <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_companies","kyc_countries_verify",$ckyc->kyc_countries_verify,
                         $ckyc->id)))}}">
                      </td>     
                  </tr>
                 
                  <tr>
                      <td> Purpose of Opening the Account</td>
                      <td>{{$ckyc->kyc_purpose_of_opening_account}}</td>
                      <td>

                      </td>
                      <td>
                          <input type="checkbox" class="checkBoxVerify" {{$ckyc->kyc_purpose_of_opening_account_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                          <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_companies","kyc_purpose_of_opening_account_verify",$ckyc->kyc_purpose_of_opening_account_verify,
                         $ckyc->id)))}}">
                      </td>     
                  </tr>
                  <tr>
                      <td>if Other purpose</td>
                      <td>{{$ckyc->kyc_other_source }}</td>
                      <td>

                      </td>
                      <td>
                          <input type="checkbox" class="checkBoxVerify" {{$ckyc->kyc_other_source_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                          <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_companies","kyc_other_source_verify",$ckyc->kyc_other_source_verify,
                         $ckyc->id)))}}">
                      </td>     
                  </tr>
                  <tr>
                      <td>Source of Funds: [Expected source and nature of credits into the account]</td>
                      <td>{{$ckyc->kyc_source_of_funds}}</td>
                      <td>
                          <input type="checkbox" class="checkBoxVerify" {{$ckyc->kyc_source_of_funds_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                          <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_companies","kyc_source_of_funds_verify",$ckyc->kyc_source_of_funds_verify,
                         $ckyc->id)))}}">
                      </td>     
                  </tr>
                  
                  <tr>
                      <td>Anticipated Volumes: [Expected/Usual average volumes of deposits into the account in Rs per month]</td>
                      <td>{{$ckyc->kyc_anticipated_volume}}</td>
                      <td>

                      </td>
                      <td>
                          <input type="checkbox" class="checkBoxVerify" {{$ckyc->kyc_anticipated_volume_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                          <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_companies","kyc_anticipated_volume_verify",$ckyc->kyc_anticipated_volume_verify,
                         $ckyc->id)))}}">
                      </td>     
                  </tr>
                  <tr>
                      <td> Expected Mode of Transactions/ Delivery Channels</td>
                      <td>{{$ckyc->kyc_expected_mode_of_transacation}}</td>
                      <td>

                      </td>
                      <td>
                          <input type="checkbox" class="checkBoxVerify" {{$ckyc->kyc_expected_mode_of_transacation_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                          <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_companies","kyc_expected_mode_of_transacation_verify",$ckyc->kyc_expected_mode_of_transacation_verify,
                         $ckyc->id)))}}">
                      </td>     
                  </tr>
                  <tr>
                      <td> Other Connected Businesses /Professional Activities / Expected Type of Counterparties:
                          (Indicate in brief; Major Customers/Suppliers and Other Connected Parties) (if applicable). (if applicable):</td>
                      <td>{{$ckyc->kyc_other_connected_businesses}}</td>
                      <td>

                      </td>
                      <td>
                          <input type="checkbox" class="checkBoxVerify" {{$ckyc->kyc_other_connected_businesses_verify==0?"":"checked"}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                          <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_companies","kyc_other_connected_businesses_verify",$ckyc->kyc_other_connected_businesses_verify,
                         $ckyc->id)))}}">
                      </td>     
                  </tr>
                 
                  <tr>
                      <td>Assets owned by the Business / Organization and the value</td>
                      <td>
                          <table>
                              <tbody>
                                  <tr>
                                     <th>Property / Premises</th>
                                     <td>{{$ckyc->kyc_property}}</td>
                                     <td>
                                      <input type="checkbox" class="checkBoxVerify" {{$ckyc->kyc_property_verify==0?"":"checked"}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                      <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_companies","kyc_property_verify",$ckyc->kyc_property_verify,
                                     $ckyc->id)))}}">
                                     </td>
                                  </tr>
                                  <tr>
                                      <th>Motor Vehicles</th>
                                      <td>{{$ckyc->kyc_motor_vehicles}}</td>
                                      <td>
                                       <input type="checkbox" class="checkBoxVerify" {{$ckyc->kyc_motor_vehicles_verify==0?"":"checked"}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                       <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_companies","kyc_motor_vehicles_verify",$ckyc->kyc_motor_vehicles_verify,
                                      $ckyc->id)))}}">
                                      </td>
                                   </tr>
                                   <tr>
                                      <th>Financial Assets</th>
                                      <td>{{$ckyc->kyc_financial_assets}}</td>
                                      <td>
                                       <input type="checkbox" class="checkBoxVerify" {{$ckyc->kyc_financial_assets_verify==0?"":"checked"}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                       <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_companies","kyc_financial_assets_verify",$ckyc->kyc_financial_assets_verify,
                                      $ckyc->id)))}}">
                                      </td>
                                   </tr>
                                   <tr>
                                      <th>Investments</th>
                                      <td>{{$ckyc->kyc_investments}}</td>
                                      <td>
                                       <input type="checkbox" class="checkBoxVerify" {{$ckyc->kyc_investments_verify==0?"":"checked"}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                       <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_companies","kyc_investments_verify",$ckyc->kyc_investments_verify,
                                      $ckyc->id)))}}">
                                      </td>
                                   </tr>
                                   <tr>
                                      <th>{{$ckyc->other_assets_name}}</th>
                                      <td>{{$ckyc->other_assets_value}}</td>
                                      <td>
                                       <input type="checkbox" class="checkBoxVerify" {{$ckyc->other_asset_verify==0?"":"checked"}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                       <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_companies","other_asset_verify",$ckyc->other_asset_verify,
                                      $ckyc->id)))}}">
                                      </td>
                                   </tr>

                              </tbody>

                          </table>
                      </td>
                      <td>

                      </td>
                  </tr>
                  <tr>
                      <td> Does the business / entity have any foreign investors?</td>
                      <td>{{$ckyc->has_foreign_investors==1 ?"Yes" :"no" }}</td>
                      <td>
                          <input type="checkbox" class="checkBoxVerify" {{$ckyc->has_foreign_investors_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                          <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_companies","has_foreign_investors_verify",$ckyc->has_foreign_investors_verify,
                         $ckyc->id)))}}">
                      </td>     
                  </tr>
                  @if ($ckyc->has_foreign_investors==1 && $ckyc->hasKycForiegnInvestors())
                  <tr>
                      <th>Foreign Investors</th>
                      <td>
                          <table>
                              <thead>
                                  <tr>
                                      <th>Name</th>
                                      <th>Country</th>
                                      <th>Percentage</th>
                                      <th>Verify</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($ckyc->kycForiegnInvestors()->get() as $investor )
                                  <tr>
                                      <td>{{$investor->name}}</td>
                                      <td>{{$investor->country}}</td>
                                      <td>{{$investor->percentage}}</td>
                                      <td>  <input type="checkbox" class="checkBoxVerify" {{$investor->verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                          <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_foreign_investors","verify",$investor->verify,
                                         $investor->id)))}}"></td>
                                  
                                  </tr>
                                      
                                  @endforeach
                                 
                              </tbody>
                             

                          </table>
                      </td>
                      <td>

                      </td>


                    </tr>
                  
                      
                  @endif
                </tbody>
             </table>

      @endif


  {{-- @if ($client->hasCompanySignatures() && $client->companySignatures->haskyc())

      @foreach ($client->companySignatures()->get() as $signature)
          
             <h3>{{$signature->name}} - Signature</h3>

      <table class="table table-bordered  table-hover">
          @php
              $skyc = $signature->kyc;
          @endphp
         <tbody>
             <tr>
                 <th>
                     Have a Investment at NSB FMC
                 </th>
                 <td>
                  {{$skyc->kyc_account_at_NSB_FMC}} 
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_account_at_NSB_FMC_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_account_at_NSB_FMC_verify",$skyc->kyc_account_at_NSB_FMC_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Nature Of Businesss
                 </th>
                 <td>
                  {{$skyc->kyc_nature_of_business}} 
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_nature_of_business_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_nature_of_business_verify",$skyc->kyc_nature_of_business_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                    Employment
                 </th>
                 <td>
                  {{$skyc->kyc_employment}} 
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_employment_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_employment_verify",$skyc->kyc_employment_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                    Employment Address
                 </th>
                 <td>
                  {{$skyc->kyc_employer_address}} 
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_employer_address_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_employer_address_verify",$skyc->kyc_employer_address_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Status of the Residential Address:
                 </th>
                 <td>
                  {{$skyc->kyc_ownership_of_premises}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_ownership_of_premises_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_ownership_of_premises_verify",$skyc->kyc_ownership_of_premises_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Foreign Address (if any):
                 </th>
                 <td>
                  {{$skyc->kyc_foreign_address}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_foreign_address_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_foreign_address_verify",$skyc->kyc_foreign_address_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Citizenship
                 </th>
                 <td>
                  {{$skyc->kyc_citizenship}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_citizenship_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_citizenship_verify",$skyc->kyc_citizenship_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Country of Residence
                 </th>
                 <td>
                  {{$skyc->kyc_country_of_residence}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_country_of_residence_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_country_of_residence_verify",$skyc->kyc_country_of_residence_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Country of Birth:
                 </th>
                 <td>
                  {{$skyc->kyc_country_of_birth}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_country_of_birth_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_country_of_birth_verify",$skyc->kyc_country_of_birth_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Nationality:
                 </th>
                 <td>
                  {{$skyc->kyc_nationality}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_nationality_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_nationality_verify",$skyc->kyc_nationality_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Type of Visa
                 </th>
                 <td>
                  {{$skyc->kyc_type_of_visa}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_type_of_visa_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_type_of_visa_verify",$skyc->kyc_type_of_visa_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Expiry Date
                 </th>
                 <td>
                  {{$skyc->kyc_expiry_date}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_expiry_date_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_expiry_date_verify",$skyc->kyc_expiry_date_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     In case of Foreign Passport Holders, give the purpose of opening the account in the foreign jurisdiction:
                 </th>
                 <td>
                  {{$skyc->kyc_purpose_account_foreign}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_purpose_account_foreign_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_purpose_account_foreign_verify",$skyc->kyc_purpose_account_foreign_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Purpose of Opening the Account:
                 </th>
                 <td>
                  {{$skyc->kyc_purpose_of_opening_account}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_purpose_of_opening_account_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_purpose_of_opening_account_verify",$skyc->kyc_purpose_of_opening_account_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                    Other Purpose
                 </th>
                 <td>
                  {{$skyc->kyc_other_purpose}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_other_purpose_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_account_at_NSB_FMC",$skyc->kyc_other_purpose_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Source of Funds: [Expected source and nature of credits into the account]
                 </th>
                 <td>
                  {{$skyc->kyc_source_of_funds}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_source_of_funds_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_source_of_funds_verify",$skyc->kyc_source_of_funds_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Other Source Of fund
                 </th>
                 <td>
                  {{$skyc->kyc_other_source}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_other_source_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_other_source_verify",$skyc->kyc_other_source_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Anticipated Volumes: [Expected/Usual average volumes of deposits into the account in Rs per month]
                 </th>
                 <td>
                  {{$skyc->kyc_anticipated_volume}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_anticipated_volume_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_anticipated_volume_verify",$skyc->kyc_anticipated_volume_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                   Expected Mode of Transactions/ Delivery Channels:
                 </th>
                 <td>
                  {{$skyc->kyc_expected_mode_of_transacation}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_expected_mode_of_transacation_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_expected_mode_of_transacation_verify",$skyc->kyc_expected_mode_of_transacation_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Other Connected Businesses /Professional Activities (if applicable):
                 </th>
                 <td>
                  {{$skyc->kyc_other_connected_businesses}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_other_connected_businesses_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_other_connected_businesses_verify",$skyc->kyc_other_connected_businesses_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Expected Types of Counterparties (if applicable)
                 </th>
                 <td>
                  {{$skyc->kyc_expected_types_of_counterparties}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_expected_types_of_counterparties_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_expected_types_of_counterparties_verify",$skyc->kyc_expected_types_of_counterparties_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Operating Authority of the Account
                 </th>
                 <td>
                  {{$skyc->kyc_operation_authority}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_operation_authority_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_operation_authority_verify",$skyc->kyc_operation_authority_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                    Name
                 </th>
                 <td>
                  {{$skyc->kyc_other_name}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_other_name_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_other_name_verify",$skyc->kyc_other_name_verify,
                                    $skyc->id)))}}">

                  </td>
             </tr>
             <tr>
                 <th>
                     Address
                 </th>
                 <td>
                  {{$skyc->kyc_other_address}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_other_address_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_other_address_verify",$skyc->kyc_other_address_verify,
                                    $skyc->id)))}}">
                  </td>
             </tr>
             <tr>
                 <th>
                     NIC
                 </th>
                 <td>
                  {{$skyc->kyc_other_nic}}
                 
                 </td>
                  <td>

                     <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_other_nic_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                     <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_other_nic_verify",$skyc->kyc_other_nic_verify,
                                    $skyc->id)))}}">
                  </td>
             </tr>
           </tbody>         
         </table>       
         @endforeach
        @endif --}}
      {{-- @endif --}}
  </div>
</div>