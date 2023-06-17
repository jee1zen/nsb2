@extends('layouts.app')
<style>
    @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>

  
@section('content')
<div class="card">
    <div class="card-header">
        <div class="text-center">
            <img src="{{asset('storage/images/fmc.jpg')}}" class="rounded-logo" alt="...">
          </div>
      Approval  KYC of {{$client->title}} {{$client->name}} 
    </div>

    <div class="card-body">
            <h3>KYC INFO</h3>
            <div class="form-group">
                <button class="btn btn-default no-print btnPrint">
                  Print
                </button>
            </div>
            @if ($client->hasKycWithInvestmentId(0))
            <table class="table table-bordered  table-hover">
                <tbody>
                    <tr>
                        <th>
                           Client Name
                        </th>
                        <td>
                        {{$client->name}}
                        
                        </td>
                        <td>
    
                        
    
                        </td>
                    </tr>
                    <tr>
                        <th>
                          NIC/Passport
                        </th>
                        <td>
                        {{$client->nic}}
                        
                        </td>
                        <td>
    
                        
    
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Address
                        </th>
                        <td>
                        {{$client->address_line_1}} <br>
                        {{$client->address_line_2}} <br>
                        {{$client->address_line_3}} 
                        
                        </td>
                        <td>
    
                        
    
                        </td>
                    </tr>
                <tr>
                    <th>
                        Have a Investment at NSB FMC
                    </th>
                    <td>
                    {{$kyc->kyc_account_at_NSB_FMC}}
                    
                    </td>
                    <td>

                    

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
                </tr>
                <tr>
                    <th>
                        Citizenship
                    </th>
                    <td>
                    {{$kyc->kyc_citizenship}}
                    
                    </td>
                        @php
                        if($kyc->kyc_citizenship=='Sri Lankan'){
                            $rate = 0.05;
                            $color = "grey";
                            $label = "low";
                        }elseif($kyc->kyc_citizenship=="Sri Lankan"){
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
                </tr>
                <tr>
                    <th>
                        Operating Authority of the Account
                    </th>
                    <td>
                    {{$kyc->kyc_operation_authority}}
                    
                    </td>
                    <td>

                
                    </td>
                </tr>
                @if($kyc->kyc_operation_authority=="Other")
                <tr>
                    <th>
                    Name
                    </th>
                    <td>
                    {{$kyc->kyc_other_name}}
                    
                    </td>
                    <td>

                    
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
                </tr>
              @endif  
                </tbody>
            </table>
            @endif  
            {{-- @if ($client->hasJointHolders() )

            @foreach ($client->jointHolders()->get() as $jointHolder)
                
                    <h3>{{$jointHolder->name}} - Joint Holder</h3>
                    @php
                    $jkyc = $jointHolder->kycByInvestmentId($investment_id);
                @endphp


            @if($jkyc)
            <table class="table table-bordered  table-hover">
            
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
                    </tr>
                    <tr>
                        <th>
                            Status of the Residential Address:
                        </th>
                        <td>
                        {{$jkyc->kyc_ownership_of_premises}}
                        
                        </td>
                        <td>

                        

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
                    </tr>
                    <tr>
                        <th>
                            Citizenship
                        </th>
                        <td>
                        {{$jkyc->kyc_citizenship}}
                        
                        </td>
                        <td>

                        

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
                    </tr>
                    <tr>
                        <th>
                            Purpose of Opening the Account:
                        </th>
                        <td>
                        {{$jkyc->kyc_purpose_of_opening_account}}
                        
                        </td>
                        <td>

                        

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
                    </tr>
                    <tr>
                        <th>
                            Source of Funds: [Expected source and nature of credits into the account]
                        </th>
                        <td>
                        {{$jkyc->kyc_source_of_funds}}
                        
                        </td>
                        <td>

                        

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
                    </tr>
                    <tr>
                        <th>
                            Anticipated Volumes: [Expected/Usual average volumes of deposits into the account in Rs per month]
                        </th>
                        <td>
                        {{$jkyc->kyc_anticipated_volume}}
                        
                        </td>
                        <td>

                        

                        </td>
                    </tr>
                    <tr>
                        <th>
                        Expected Mode of Transactions/ Delivery Channels:
                        </th>
                        <td>
                        {{$jkyc->kyc_expected_mode_of_transacation}}
                        
                        </td>
                        <td>

                        

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
                    </tr>
                    <tr>
                        <th>
                        Name
                        </th>
                        <td>
                        {{$jkyc->kyc_other_name}}
                        
                        </td>
                        <td>

                        

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
                    </tr>
                </tbody>         
                </table> 
                @endif
                @endforeach
                @endif
                @if($client->company->hasKyc())
                @php
                $ckyc = $client->company->kycWithType($investment_id);
                @endphp
                    
            
                <h3>Company KYC - {{$client->company->name}}</h3>
            
                    <table class="table table-bordered  table-hover">
                        <tbody>
                            <tr>
                                <td>Have an investment account at NSB FMC?</td>
                                <td>{{$ckyc->kyc_account_at_NSB_FMC==1 ?"Yes" :"no" }}</td>
                                <td>
                                
                                </td>     
                            </tr>
                            <tr>
                                <td> Foreign Address (if any)</td>
                                <td>{{$ckyc->kyc_foreign_address }}</td>
                                <td>
                                
                                </td>     
                            </tr>
                            <tr>
                                <td>Countries involved in the Business (if any)</td>
                                <td>{{$ckyc->kyc_countries }}</td>
                                <td>
                                
                                </td>     
                            </tr>
                        
                            <tr>
                                <td> Purpose of Opening the Account</td>
                                <td>{{$ckyc->kyc_purpose_of_opening_account}}</td>
                                <td>
                                
                                </td>     
                            </tr>
                            <tr>
                                <td>if Other purpose</td>
                                <td>{{$ckyc->kyc_other_source }}</td>
                                <td>
                                
                                </td>     
                            </tr>
                            <tr>
                                <td>Source of Funds: [Expected source and nature of credits into the account]</td>
                                <td>{{$ckyc->kyc_source_of_funds}}</td>
                                <td>
                                
                                </td>     
                            </tr>
                            
                            <tr>
                                <td>Anticipated Volumes: [Expected/Usual average volumes of deposits into the account in Rs per month]</td>
                                <td>{{$ckyc->kyc_anticipated_volume}}</td>
                                <td>
                                
                                </td>     
                            </tr>
                            <tr>
                                <td> Expected Mode of Transactions/ Delivery Channels</td>
                                <td>{{$ckyc->kyc_expected_mode_of_transacation}}</td>
                                <td>
                                
                                </td>     
                            </tr>
                            <tr>
                                <td> Other Connected Businesses /Professional Activities / Expected Type of Counterparties:
                                    (Indicate in brief; Major Customers/Suppliers and Other Connected Parties) (if applicable). (if applicable):</td>
                                <td>{{$ckyc->kyc_other_connected_businesses}}</td>
                                <td>
                                
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
                                            
                                            </td>
                                            </tr>
                                            <tr>
                                                <th>Motor Vehicles</th>
                                                <td>{{$ckyc->kyc_motor_vehicles}}</td>
                                                <td>
                                        
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Financial Assets</th>
                                                <td>{{$ckyc->kyc_financial_assets}}</td>
                                                <td>
                                            
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Investments</th>
                                                <td>{{$ckyc->kyc_investments}}</td>
                                                <td>
                                            
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>{{$ckyc->other_assets_name}}</th>
                                                <td>{{$ckyc->other_assets_value}}</td>
                                                <td>
                                            
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td> Does the business / entity have any foreign investors?</td>
                                <td>{{$ckyc->has_foreign_investors==1 ?"Yes" :"no" }}</td>
                                <td>
                                
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
                                                <td>  </td>
                                            
                                            </tr>
                                                
                                            @endforeach
                                        
                                        </tbody>
                                    

                                    </table>
                                </td>


                            </tr>
                                
                            @endif
                        </tbody>
                    </table>

                @endif --}}
                @endsection
                @section('scripts')
                @parent
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
                <script>
                  $(document).ready(function(){
                
                    $('.btnPrint').on('click',function(){
                        window.print();
                    });
                
                
                  });
                </script>
                @endsection    
