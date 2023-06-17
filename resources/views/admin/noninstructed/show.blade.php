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
<div class="card">
    <div class="card-header">
        <h3>Synced Uninstructed Record for {{$tempInvestment->ref_no}} </h3>
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
                                    <img src="{{asset('storage/uploads/'.$withdraw->client->pro_pic)}}" alt="" class="img-rounded img-responsive" width="50px" height="100px" />
                                
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <h4>
                                    {{$tempInvestment->client->name}}</h4>
                                    <small><cite title="San Francisco, USA">{{$tempInvestment->client->residence_address}} <i class="glyphicon glyphicon-map-marker">
                                    </i></cite></small>
                                    <p>
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <label for="">{{$tempInvestment->client->mobile}}</label>
                                        <br />
                                        <i class="fa fa-envelope"></i>{{$tempInvestment->client->user->email}}
                                        <br />
                                        <i class="fa fa-globe"></i><a href="{{route('admin.clients.profile',$tempInvestment->client->id)}}" target="_blank">Profile</a>
                                        <br />
                                     
                                        {{-- {{dd($withdraw->client->clientRecords()->get()->last())}} --}}
                                     
                                    
                                    </p>
                                        
                                    <!-- Split button -->
                                
                                </div>
                            </div>
                        </div>
                    </div>
               
                 @php
                 if(($tempInvestment->status ==1)){
                 $withdraw = App\Withdraw::where('investment_id',$tempInvestment->investment_id)->where('status','>=',1)->latest()->first();
                 }              
                @endphp

        

                    @if($officer_role->id==7 && $tempInvestment->status==1)
                
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <label for="">Invested Amount @money($withdraw->investment->invested_amount)</label></br>
                        @if ($withdraw->amount!=0)
                        <label for="">Requested Withdraw Amount @money($withdraw->amount)</label></br>
                        @endif
                        <label for="">{{$withdraw->investment->investmentType->name}}</label></br>
                        <label for="">Current Status - {{Config::get('constants.WITHDRAW_REQUEST_STATUS')[$withdraw->status]}}</label>
            
                        <form id="approvalForm" action="" method="POST" action ="" enctype="multipart/form-data">
                            @csrf
                        @if ($officer_role->id==5 && $withdraw->status==0 ||$officer_role->id==6 && $withdraw->status == 0  || $officer_role->id==7 && $withdraw->status==1)
                        <div class="form-group">
                            <button type="button" id="btnApprove" class="btn btn-success btn-lg"> Approve</button> &nbsp; &nbsp;
                            <button type="button" id="btnDecline" class="btn btn-danger btn-lg"> Decline </button>
                            <input type="hidden" name="withdraw_id" value="{{$withdraw->id}}">
                            <input type="hidden" name="client_id" value="{{$withdraw->client->id}}">
                            <input type="hidden" name="tempInvestment_id" value="{{$tempInvestment->id}}">
                            <input type="hidden" name="request_type" id="request_type" value="" >
                        </div>   
                        @endif
                       </form>
                    </div>  
                    @endif
                    <div class="col-md-12">
                        <table class="table table-borded">
                            <thead>
                                <tr>
                                    <th colspan="6" style="text-align:center">
                                        <h4> {{$tempInvestment->ref_no}} </h4>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Record</th>
                                    <th> Invested Amount</th>
                                    <th> Matured Amount</th>
                                    <th> Value Date</th>
                                    <th> Maturity Date</th>
                                    <th> Last updated</th>
                                    <th>State</th>

                                </tr>
                            </thead>
                             <tbody>
                                    <tr>
                                        <th>
                                            Current Record 
                                        </th>
                                        <td>
                                            @money($tempInvestment->investment->invested_amount)
                                        </td>
                                        <td>
                                            @money($tempInvestment->investment->matured_amount)
                                        </td>
                                        <td>
                                            {{$tempInvestment->investment->value_date}}
                                        </td>
                                        <td>
                                        {{$tempInvestment->investment->maturity_date}}
                                        </td>
                                        <td>
                                        {{$tempInvestment->investment->updated_at}}  &nbsp;({{ $tempInvestment->investment->updated_at->diffForHumans()}})
                                        </td>
                                        <td>
                                           {{$tempInvestment->investment->method}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                           Newly Synced Record Uninstructed
                                        </th>
                                        <td>
                                            @money($tempInvestment->invested_amount)
                                        </td>
                                        <td>
                                            @money($tempInvestment->matured_amount)
                                        </td>
                                        <td>
                                            {{$tempInvestment->value_date}}
                                        </td>
                                        <td>
                                        {{$tempInvestment->maturity_date}}
                                        </td>
                                        <td>
                                        {{$tempInvestment->updated_at}}  &nbsp;({{ $tempInvestment->updated_at->diffForHumans()}})
                                        </td>
                                        <td>
                                            {{$tempInvestment->method}}
                                        </td>
                                    </tr>
                                 </tbody>   
                          

                        </table>
                    </div>
                    <div class="col-md-10 content">
                        <div class="panel panel-default">
                      <div class="panel-heading">
                          <h2 id="formTitle">Maturity Instruction</h2>
                      </div>
                      @if(($officer_role->id==5 || $officer_role->id==6) && $tempInvestment->status==0 )
                      <div class="panel-body">
                          <div class="card-body">
                              @if($errors->any())
                              {{ $error}}
                              @endif
                              <div class="form-group">
                                  <select name="selectRequest" id="selectRequest" class="form-control">
                                      <option value="0">Select A Instruction Before Proceed</option>
                                      @foreach (Config::get('constants.REQUEST_TYPES') as $key=> $request_type)
                                      <option value="{{$key}}">{{$request_type}}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label for="">
                                      Investment 
                                  </label>
                                  <label for="" class="form-control">
                                    #{{$tempInvestment->investment->id}} -- {{$tempInvestment->investment->ref_no}} - {{$tempInvestment->investment->investmentType->name}} - @money($tempInvestment->investment->invested_amount) - Matured -  {{$tempInvestment->investment->maturity_date}}
                                  </label>
                                  <input type="hidden" name="investment_id" value="{{$tempInvestment->investment_id}}">
                              </div>
                           <div id="typeFive">
                              <form method="POST" action="{{ route("admin.noninstructed.store") }}" enctype="multipart/form-data">
                                  @method('POST')
                                  @csrf
                                  <input type="hidden" class="investment_id" name="investment_id" value="{{$tempInvestment->investment_id}}">
                                  <input type="hidden" id="tempInvestment_id" name="tempInvestment_id" value = "{{$tempInvestment->id}}">
                                  <input type="hidden" class="request_type_value" name="request_type_value">
                                  <div class="form-group" id="divBankAccountFive">
                                      <label for="">Bank Account</label>
                                      <select name="bank_id" id="bank_id" class="form-control">
                                         @if ($tempInvestment->client->hasBankParticulars())
                                         @php
                                             $bankAccounts = $tempInvestment->client->bankParticulars()->get();
                                         @endphp
                                          @foreach ($bankAccounts as $bankAccount)
                                          <option value="{{$bankAccount->id}}">{{$bankAccount->bank_name}} | {{$bankAccount->account_no}} </option>
                                          @endforeach
                                         @endif 
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kycModal">
                                         Update KYC
                                        </button> --}}
                                      <button type="submit" class="btn btn-primary btn_submit">
                                          Request
                                      </button>
                                  </div>
                              </form>
                           </div>       
                  
                  
                  
                          <div id="typeFour">  
                              <form method="POST" action="{{ route("admin.noninstructed.store") }}" enctype="multipart/form-data">
                                  @method('POST')
                                  @csrf
                                  <input type="hidden"  name="investment_id" value="{{$tempInvestment->investment_id}}">
                                  <input type="hidden" id="tempInvestment_id" name="tempInvestment_id" value = "{{$tempInvestment->id}}">
                                  <input type="hidden" class="request_type_value" name="request_type_value">
                            
                                  <div class="form-group">
                                      <label class="required" for="amount">Expected Amount</label>
                                      <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="name" value="{{ old('amount', '') }}" required>
                                  </div> 
                                  <div class="form-group" id="divBankAccount">
                                      <label for="">Bank Account</label>
                                      <select name="bank_id" id="bank_id" class="form-control">
                                         @if ($tempInvestment->client->hasBankParticulars())
                                          @foreach ($bankAccounts as $bankAccount)
                                          <option value="{{$bankAccount->id}}">{{$bankAccount->bank_name}} | {{$bankAccount->account_no}} </option>
                                          @endforeach
                                         @endif 
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kycModal">
                                          Update KYC
                                         </button> --}}
                                      <button type="sumbit" class="btn btn-primary btn_submit">
                                          Request
                                      </button>
                                  </div>
                              </form>
                          </div>
                          </div>  
                  
                          {{-- @include('client.kycClientModel')        --}}
                  </div>
                  @else
              
             
                   <table class="table table-borded">
                       <tr>
                           <th> Instruction</th>
                           <td>    {{Config::get('constants.REQUEST_TYPES')[$withdraw->request_type] }}</td>
                       </tr>
                       @if ($withdraw->amount!=0)
                       <tr>
                           <th>
                            Requested Withdraw Amount
                           </th>
                           <td>
                            @money($withdraw->amount)
                           </td>
                       </tr>
                       @endif
                       @if($withdraw->bank_id !=0)
                       <tr>
                        <th>Bank</th>
                        <td>{{$withdraw->bankAccount->bank_name}}</td>
                        </tr>   
                        <tr>
                            <th>Branch</th>
                            <td>{{$withdraw->bankAccount->branch}}</td>
                        </tr>   
                        <tr>
                            <th>Account No</th>
                            <td>{{$withdraw->bankAccount->account_no}}</td>
                        </tr>   
                        <tr>
                            <th>Account Type</th>
        
                            <td>
                                {{-- {{Config::get('constants.CLIENT_TYPE') [$withdraw->bankAccount->Account_type]}} --}}
                                {{$withdraw->bankAccount->Account_type}}
                            </td>
                        </tr>   
                       @endif 
                   </table>

                  @endif
                    {{-- @if (($officer_role->id==5 && $investment->status==0) ||($officer_role->id==6 && $investment->status == 0))
                    <div class="col-xs-12 col-sm-6 col-md-6">
                      
                        <form method="POST" action="">
                            @csrf
                           <table>
                              <thead>
                                <tr>
                                    <th colspan="2">  Change Investment Values</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                    <input type="hidden" name="investment_id" value="{{$investment->id}}">
                                      <th>
                                         Expected Amount
                                      </th>
                                      <td>
                                         <input type="number" name="amount" value="{{$investment->amount}}" class="form-control">
                                      </td>
                                  </tr>
                                  <tr>
                                    <th>
                                      Value Date
                                    </th>
                                    <td>
                                        <input type="date" id="value_date" name="value_date"  value="{{$investment->value_date}}"  placeholder="YYYY-MM-DD"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                       Maturity Date
                                    </th>
                                    <td>
                                        <input type="date"  id="maturity_date"   placeholder="YYYY-MM-DD" value="{{$investment->maturity_date}}"   name="maturity_date" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button class="btn btn-primary" type="submit">Update</button>

                                    </td>
                                </tr>

                              </tbody>
                           </table>
                        </form>

                    </div>
                    @endif --}}
                </div>
            </div>

   </div>

</div>


@endsection
@section('scripts')
@parent
<script>
     $(function () {
   let nextStage = "{{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$tempInvestment->status+1]}}"
        $('#btnApprove').click(function(){
            alertify.confirm('Client Approval', 'Are you sure you want to Approve the New Investment Request for further process?', function(){ 
                $('#request_type').val(1);
                alertify.success("Approved! NEXT STEP - "+nextStage) ;
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
                        "disable": [
                            function(date) {
                            return (date.getDay() === 0 || date.getDay() === 6);  // disable weekends
                            }
                        ],
                        "locale": {
                            "firstDayOfWeek": 1 // set start day of week to Monday
                        }
                    });
                    $("#value_date").flatpickr({
                        enableTime: false,
                        dateFormat: "Y-m-d",
                        "disable": [
                            function(date) {
                            return (date.getDay() === 0 || date.getDay() === 6);  // disable weekends
                            }
                        ],
                        "locale": {
                            "firstDayOfWeek": 1 // set start day of week to Monday
                        }
                    });

                  //forms
                $('#typeFive').hide();
               $('#typeFour').hide();

                $('#selectRequest').on('change',function(){

                 $('#formTitle').html(' Request -'+$(this).find("option:selected").text());

                     var thisValue = $(this).val();
                    if(thisValue ==1 || thisValue ==2){
                        $('#typeFive').show();
                        $('#typeFour').hide();
                        $('#divBankAccountFive').hide();
                       
                    }else if (thisValue==3 ){
                        $('#typeFive').hide();
                        $('#typeFour').show();
                        $('#divBankAccount').show();

                    }else if(thisValue==4){
                        $('#typeFive').hide();
                        $('#typeFour').show();
                        $('#divBankAccount').hide();
                    }else if(thisValue == 5){
                        $('#typeFive').show();
                        $('#typeFour').hide();
                        $('#divBankAccountFive').show();

                    }else{
                        $('#typeFive').hide();
                        $('#typeFour').hide();
                    }
                    // $('.investment_id').val($('#investment').val());
                    $('.request_type_value').val(thisValue);


                });  



     });

</script>
@endsection
