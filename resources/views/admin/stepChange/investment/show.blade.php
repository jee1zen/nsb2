@extends('layouts.admin')
@section('content')
<style>
    body{padding-top:30px;}

.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

small {
display: block;
line-height: 1.428571429;
color: #999;
}
</style>    
@php
    use Carbon\Carbon;
@endphp
<div class="card">
    <div class="card-header">
        Change Investment Status
    </div>
    <div class="card-body">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="well well-sm">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <img src="{{asset('storage/uploads/'.$investment->client->pro_pic)}}" alt="" class="img-rounded img-responsive" width="50px" height="100px" />
                                
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <h4>
                                    {{$investment->client->name}}</h4>
                                    <small><cite title="San Francisco, USA">{{$investment->client->residence_address}} <i class="glyphicon glyphicon-map-marker">
                                    </i></cite></small>
                                    <p>
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <label for="">{{$investment->client->mobile}}</label>
                                        <br />
                                        <i class="fa fa-envelope"></i>{{$investment->client->user->email}}
                                        <br />
                                        <i class="fa fa-globe"></i><a href="{{route('admin.investment.info.client',$investment->client->id)}}" target="_blank">Profile</a>
                                        <br />
                                        <i class="fa fa-info" > <a href="#" data-toggle="modal" data-target="#kycModel">KYC</a></i>
                                        <br />
                                        {{-- {{dd($withdraw->client->clientRecords()->get()->last())}} --}}
                                        <i class="fa fa-dollar" ></i>@money($investment->amount)
                                        <br/>
                                    
                                    </p>
                                        
                                    <!-- Split button -->
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                  
                        <label for="">Amount @money($investment->amount)</label><br/>
                        <label for="">Yield {{$investment->yield ?? ""}}%</label><br/>
                        <label for="">{{$investment->investmentType->name}}</label><br/>
                        <label for="">Value Date :- {{$investment->value_date ?? ""}}</label><br/>
                        <label for="">Maturity Date :- {{$investment->maturity_date ?? ""}}</label><br/>
                        <label for="">Maturity Insturction :- {{$investment->instruction}}</label><br/>
                        @if($investment->bank_id!=null)
                        <label for="">Bank Account :-{{$investment->bank->bank_name}} | {{$investment->bank->account_no}}</label><br/>
                        @endif


                        <label for="">Current Status - {{Config::get('constants.WITHDRAW_REQUEST_STATUS')[$investment->status]}}</label>
                        <form id="approvalForm" action="" method="POST" action ="" enctype="multipart/form-data">
                            @csrf
                      
                        <div class="form-group">

                            <select name="status" id="status" class="form-control">
                                    <option value="0" {{$investment->status==0?"selected":""}} >Pending</option>
                                    <option value="1" {{$investment->status==1?"selected":""}}>Bank Officer or Bank Manager Verified</option>
                                    <option value="2" {{$investment->status==2?"selected":""}}>Middle Officer Verified</option>
                            </select>
                            <button type="button" id="btnApprove" class="btn btn-success btn-lg"> Update Step</button> 
                          
                        </div>   
                       
                    </form>
                    </div>  

                </div>
            </div>


</div>
<div class="modal fade" id="kycModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">KYC Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h3>KYC INFO</h3>
            @if ($client->hasKycWithInvestmentId($investment_id))
               <table class="table table-bordered  table-hover">
                   <tbody>
                <tr>
                    <th>
                        Have a Investment at NSB FMC
                    </th>
                    <td>
                     {{$kyc->kyc_account_at_NSB_FMC}}
                    
                    </td>
                 
                </tr>
                <tr>
                    <th>
                        Status of the Residential Address:
                    </th>
                    <td>
                     {{$kyc->kyc_ownership_of_premises}}
                    
                    </td>
                 
                </tr>
                <tr>
                    <th>
                        Foreign Address (if any):
                    </th>
                    <td>
                     {{$kyc->kyc_foreign_address}}
                    
                    </td>
                  
                </tr>
                <tr>
                    <th>
                        Citizenship
                    </th>
                    <td>
                     {{$kyc->kyc_citizenship}}
                    
                    </td>
                
                </tr>
                <tr>
                    <th>
                        Country of Residence
                    </th>
                    <td>
                     {{$kyc->kyc_country_of_residence}}
                    
                    </td>
                   
                </tr>
                <tr>
                    <th>
                        Country of Birth:
                    </th>
                    <td>
                     {{$kyc->kyc_country_of_birth}}
                    
                    </td>
                  
                </tr>
                <tr>
                    <th>
                        Nationality:
                    </th>
                    <td>
                     {{$kyc->kyc_nationality}}
                    
                    </td>
                 
                </tr>
                <tr>
                    <th>
                        Type of Visa
                    </th>
                    <td>
                     {{$kyc->kyc_type_of_visa}}
                    
                    </td>
                
                </tr>
                <tr>
                    <th>
                        Expiry Date
                    </th>
                    <td>
                     {{$kyc->kyc_expiry_date}}
                    
                    </td>
                 
                </tr>
                <tr>
                    <th>
                        In case of Foreign Passport Holders, give the purpose of opening the account in the foreign jurisdiction:
                    </th>
                    <td>
                     {{$kyc->kyc_purpose_account_foreign}}
                    
                    </td>
                  
                </tr>
                <tr>
                    <th>
                        Purpose of Opening the Account:
                    </th>
                    <td>
                     {{$kyc->kyc_purpose_of_opening_account}}
                    
                    </td>
                  
                </tr>
            
                <tr>
                    <th>
                       Other Purpose
                    </th>
                    <td>
                     {{$kyc->kyc_other_purpose}}
                    
                    </td>
                   
                </tr>
                <tr>
                    <th>
                        Source of Funds: [Expected source and nature of credits into the account]
                    </th>
                    <td>
                     {{$kyc->kyc_source_of_funds}}
                    
                    </td>
                    
                </tr>
                <tr>
                    <th>
                        Other Source Of fund
                    </th>
                    <td>
                     {{$kyc->kyc_other_source}}
                    
                    </td>
                   
                </tr>
                <tr>
                    <th>
                        Anticipated Volumes: [Expected/Usual average volumes of deposits into the account in Rs per month]
                    </th>
                    <td>
                     {{$kyc->kyc_anticipated_volume}}
                    
                    </td>
                    
                </tr>
             
                <tr>
                    <th>
                      Expected Mode of Transactions/ Delivery Channels:
                    </th>
                    <td>
                     {{$kyc->kyc_expected_mode_of_transacation}}
                    
                    </td>
                 
                </tr>
                <tr>
                    <th>
                        Other Connected Businesses /Professional Activities (if applicable):
                    </th>
                    <td>
                     {{$kyc->kyc_other_connected_businesses}}
                    
                    </td>
                   
                </tr>
                <tr>
                    <th>
                        Expected Types of Counterparties (if applicable)
                    </th>
                    <td>
                     {{$kyc->kyc_expected_types_of_counterparties}}
                    
                    </td>
                   
                </tr>
                <tr>
                    <th>
                        Operating Authority of the Account
                    </th>
                    <td>
                     {{$kyc->kyc_operation_authority}}
                    
                    </td>
                
                </tr>
                <tr>
                    <th>
                        Is PEP
                    </th>
                    <td>
                     {{$kyc->kyc_pep}}
                    
                    </td>
               
                </tr>
                <tr>
                    <th>
                        Is US Citizen
                    </th>
                    <td>
                     {{$kyc->kyc_us_person}}
                    
                    </td>
                
                </tr>
                @if ($kyc->kyc_other_name!=null)
                    
               
                <tr>
                    <th>
                       Name
                    </th>
                    <td>
                     {{$kyc->kyc_other_name}}
                    
                    </td>
                  
                </tr>
                <tr>
                    <th>
                        Address
                    </th>
                    <td>
                     {{$kyc->kyc_other_address}}
                    
                    </td>
                
                </tr>
                <tr>
                    <th>
                        NIC
                    </th>
                    <td>
                     {{$kyc->kyc_other_nic}}
                    
                    </td>
                 
                </tr>
                @endif
                </tbody>
               </table>
             @endif  
             @if ($client->hasJointHolders() )

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

                    </tr>
                    <tr>
                        <th>
                            Nature Of Businesss
                        </th>
                        <td>
                         {{$jkyc->kyc_nature_of_business}} 
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                           Employment
                        </th>
                        <td>
                         {{$jkyc->kyc_employment}} 
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                           Employment Address
                        </th>
                        <td>
                         {{$jkyc->kyc_employer_address}} 
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Status of the Residential Address:
                        </th>
                        <td>
                         {{$jkyc->kyc_ownership_of_premises}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Foreign Address (if any):
                        </th>
                        <td>
                         {{$jkyc->kyc_foreign_address}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Citizenship
                        </th>
                        <td>
                         {{$jkyc->kyc_citizenship}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Country of Residence
                        </th>
                        <td>
                         {{$jkyc->kyc_country_of_residence}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Country of Birth:
                        </th>
                        <td>
                         {{$jkyc->kyc_country_of_birth}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Nationality:
                        </th>
                        <td>
                         {{$jkyc->kyc_nationality}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Type of Visa
                        </th>
                        <td>
                         {{$jkyc->kyc_type_of_visa}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Expiry Date
                        </th>
                        <td>
                         {{$jkyc->kyc_expiry_date}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            In case of Foreign Passport Holders, give the purpose of opening the account in the foreign jurisdiction:
                        </th>
                        <td>
                         {{$jkyc->kyc_purpose_account_foreign}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Purpose of Opening the Account:
                        </th>
                        <td>
                         {{$jkyc->kyc_purpose_of_opening_account}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                           Other Purpose
                        </th>
                        <td>
                         {{$jkyc->kyc_other_purpose}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Source of Funds: [Expected source and nature of credits into the account]
                        </th>
                        <td>
                         {{$jkyc->kyc_source_of_funds}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Other Source Of fund
                        </th>
                        <td>
                         {{$jkyc->kyc_other_source}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Anticipated Volumes: [Expected/Usual average volumes of deposits into the account in Rs per month]
                        </th>
                        <td>
                         {{$jkyc->kyc_anticipated_volume}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                          Expected Mode of Transactions/ Delivery Channels:
                        </th>
                        <td>
                         {{$jkyc->kyc_expected_mode_of_transacation}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Other Connected Businesses /Professional Activities (if applicable):
                        </th>
                        <td>
                         {{$jkyc->kyc_other_connected_businesses}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Expected Types of Counterparties (if applicable)
                        </th>
                        <td>
                         {{$jkyc->kyc_expected_types_of_counterparties}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Operating Authority of the Account
                        </th>
                        <td>
                         {{$jkyc->kyc_operation_authority}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Is PEP
                        </th>
                        <td>
                         {{$jkyc->kyc_pep}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                           Is US Citizen
                        </th>
                        <td>
                         {{$jkyc->kyc_us_person}}
                        
                        </td>

                    </tr>
                   @if($jkyc->kyc_other_name!=null) 
                    <tr>
                        <th>
                           Name
                        </th>
                        <td>
                         {{$jkyc->kyc_other_name}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            Address
                        </th>
                        <td>
                         {{$jkyc->kyc_other_address}}
                        
                        </td>

                    </tr>
                    <tr>
                        <th>
                            NIC
                        </th>
                        <td>
                         {{$jkyc->kyc_other_nic}}
                        
                        </td>

                    </tr>
                  @endif  
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
   
                            </tr>
                            <tr>
                                <td> Foreign Address (if any)</td>
                                <td>{{$ckyc->kyc_foreign_address }}</td>
  
                            </tr>
                            <tr>
                                <td>Countries involved in the Business (if any)</td>
                                <td>{{$ckyc->kyc_countries }}</td>
   
                            </tr>
                           
                            <tr>
                                <td> Purpose of Opening the Account</td>
                                <td>{{$ckyc->kyc_purpose_of_opening_account}}</td>

                            </tr>
                            <tr>
                                <td>if Other purpose</td>
                                <td>{{$ckyc->kyc_other_source }}</td>
  
                            </tr>
                            <tr>
                                <td>Source of Funds: [Expected source and nature of credits into the account]</td>
                                <td>{{$ckyc->kyc_source_of_funds}}</td>
 
                            </tr>
                            
                            <tr>
                                <td>Anticipated Volumes: [Expected/Usual average volumes of deposits into the account in Rs per month]</td>
                                <td>{{$ckyc->kyc_anticipated_volume}}</td>
 
                            </tr>
                            <tr>
                                <td> Expected Mode of Transactions/ Delivery Channels</td>
                                <td>{{$ckyc->kyc_expected_mode_of_transacation}}</td>
   
                            </tr>
                            <tr>
                                <td> Other Connected Businesses /Professional Activities / Expected Type of Counterparties:
                                    (Indicate in brief; Major Customers/Suppliers and Other Connected Parties) (if applicable). (if applicable):</td>
                                <td>{{$ckyc->kyc_other_connected_businesses}}</td>
     
                            </tr>
                           
                            <tr>
                                <td>Assets owned by the Business / Organization and the value</td>
                                <td>
                                    <table>
                                        <tbody>
                                            <tr>
                                               <th>Property / Premises</th>
                                               <td>{{$ckyc->kyc_property}}</td>

                                            </tr>
                                            <tr>
                                                <th>Motor Vehicles</th>
                                                <td>{{$ckyc->kyc_motor_vehicles}}</td>

                                             </tr>
                                             <tr>
                                                <th>Financial Assets</th>
                                                <td>{{$ckyc->kyc_financial_assets}}</td>

                                             </tr>
                                             <tr>
                                                <th>Investments</th>
                                                <td>{{$ckyc->kyc_investments}}</td>

                                             </tr>
                                             <tr>
                                                <th>{{$ckyc->other_assets_name}}</th>
                                                <td>{{$ckyc->other_assets_value}}</td>

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

                @endif

         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
@section('scripts')
@parent
<script>
     $(function () {
   let nextStage = "{{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$investment->status+1]}}"
        $('#btnApprove').click(function(){
            alertify.confirm('Stepping Change', 'Are you sure you want to Step Update?', function(){ 
                $('#request_type').val(1);
             
                $('#approvalForm').submit();
               }
                , function(){ alertify.error('Action Cancelled')});
        });

        $('#btnDecline').click(function(){
            alertify.prompt( 'Decline From Further Process', 'Reason for Decline', ''
               , function(evt, value) { 
                   $('#request_comment').val(value);
                   $('#request_type').val(0);
                   alertify.error("You've Decliend Further Process!") 
                   $('#approvalForm').submit();
                   }
               , function() { alertify.error('Action Cancelled') });

        });

        $("#maturity_date").flatpickr({
                        enableTime: false,
                        dateFormat: "Y-m-d",
                        // "disable": [
                        //     function(date) {
                        //     return (date.getDay() === 0 || date.getDay() === 6);  // disable weekends
                        //     }
                        // ],
                        "locale": {
                            "firstDayOfWeek": 1 // set start day of week to Monday
                        }
                    });
                    $("#value_date").flatpickr({
                        enableTime: false,
                        dateFormat: "Y-m-d",
                        // "disable": [
                        //     function(date) {
                        //     return (date.getDay() === 0 || date.getDay() === 6);  // disable weekends
                        //     }
                        // ],
                        "locale": {
                            "firstDayOfWeek": 1 // set start day of week to Monday
                        }
                    });

                
                    



             //money format
            $("input[data-type='currency']").on({
                keyup: function() {
                formatCurrency($(this));
                },
                blur: function() { 
                formatCurrency($(this), "blur");
                }
            });


            function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            }


            function formatCurrency(input, blur) {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.
            
            // get input value
            var input_val = input.val();
            
            // don't validate empty input
            if (input_val === "") { return; }
            
            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");
                
            // check for decimal
            if (input_val.indexOf(".") >= 0) {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);
                
                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                right_side += "00";
                }
                
                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val =  left_side + "." + right_side;

            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = input_val;
                
                // final formatting
                if (blur === "blur") {
                input_val += ".00";
                }
            }
            
            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
            }       

     });

</script>
@endsection
