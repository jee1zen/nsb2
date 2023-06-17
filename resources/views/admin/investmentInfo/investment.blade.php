@extends('layouts.app')
<style>
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
    
}
@media print {
    body {
        margin-top: 0px !important;
    }
}

.top-text{
    background-color: #24282c;
    color: #fff;
    font-size: 16px;
    margin: 20px auto;
    width: 100%;
    padding-top:5px; 
}
</style>
@php
    use Carbon\Carbon;
@endphp
  
@section('content')
<div class="card print-form" style="margin-top: 0px">

    <div class="top-text text-center"><h4>APPLICATION FORM FOR PURCHASE OF TREASURY BILLS/BONDS/REPO</h4></div>
    <div class="form-header-nsb-pdf">
        <div class="row">
            <div class="col-md-6">
                <div class="logo-left">
                    <img src="{{asset('storage/images/fmc.jpg')}}" class="rounded-logo" alt="...">
                </div>
                <p>No.400, Galle Road, Colombo 03 <br>
                    Tel: 0112425010 I Fax: 0112574387
                    </p>
                
            </div>
            <div class="col-md-6">
                <table class="table dark-table">
                    <tr class="highlight">
                        <td colspan="2">FOR OFFICE USE ONLY	</td>
                    </tr>
                    <tr>
                        <td>
                            DATE
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            CUSTOMER REFERANCE NO
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            YIELD
                        </td>
                        <td>
                            {{$investment->yield}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            COST PER RS.100/-
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            DATE OF SALE
                        </td>
                        <td>
                            {{$investment->value_date}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            DAYS TO MATURITY
                        </td>
                        <td>
                            {{Carbon::createFromFormat('Y-m-d', $investment->value_date)->diffInDays( Carbon::createFromFormat('Y-m-d', $investment->maturity_date))}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            CUSTOMER RISK RATING
                        </td>
                        <td>
                           {{$totalRiskRate}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            CUSTOMER RISK SCORE
                        </td>
                        <td>
                            {{$rateLabel}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            OFFICER SIGNATURE
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            MANAGER SIGNATURE
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>

    <div class="">
        <div class="form-group">
            <div class="form-group">
                <button class="btn btn-default no-print btnPrint">
                  Print
                </button>
            </div>

            <table class="table table-bordered  table-hover">
                <tbody>
                    <tr class="highlight">
                        <td colspan="2">SECTION A - BASIC INFORMATION OF THE CUSTOMER</td>
                    </tr>
                    <tr>
                        <th>
                          NAME WITH INITIALS
                        </th>
                        <td>
                            {{ $client->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        NAME IN FULL
                        </th>
                        <td>
                            {{ $client->name_by_initials }}
                        </td>
                     
                    </tr>
                    <tr>
                        <th>
                            ADDRESS
                        </th>
                        <td>
                            {{$client->address_line_1}} &nbsp; {{$client->address_line_2}} &nbsp; {{$client->address_line_3 }}
                        </td>
                    </tr>
                   
                        <tr>
                            <th>
                                NIC/PASSPORT NUMBER
                            </th>
                            <td>
                                {{$client->nic}}
                            </td>
                        </tr>
                 
                    <tr>
                        <th>
                            EMAIL
                        </th>
                        <td>
                            {{$client->user->email}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            FAX
                        </th>
                        <td>
                           {{$client->employmentDetails->fax}}
                     
                        </td>
                    </tr>
                    <tr>
                        <th>
                            OCCUPATION/PROFESSION
                        </th>
                        <td>
                          {{$client->employmentDetails->occupation}}
                        
                        </td>
                    </tr>
                    <tr>
                        <th>
                            ADDRESS OF THE EMPLOYER / COMPANY / BUSINESS
                        </th>
                        <td>
                         {{$client->employmentDetails->company_name}}&nbsp;{{$client->employmentDetails->company_address}}
                        </td>
                    </tr>

                     @if ($client->hasJointHolders())
                        @foreach ($client->jointHolders()->get() as $key=> $jointHolder)
                        <tr>
                            <th colspan="2">
                               
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2" style="text-align: center">
                                JOINT HOLDER  {{$key+1}}
                            </th>
                        </tr>
                        <tr>
                            <th>
                              NAME WITH INITIALS
                            </th>
                            <td>
                                {{ $jointHolder->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                            NAME IN FULL
                            </th>
                            <td>
                                {{ $jointHolder->name_by_initials }}
                            </td>
                         
                        </tr>
                        <tr>
                            <th>
                                ADDRESS
                            </th>
                            <td>
                                {{$jointHolder->address_line_1}} &nbsp; {{$jointHolder->address_line_2}} &nbsp; {{$jointHolder->address_line_3 }}
                            </td>
                        </tr>
                       
                            <tr>
                                <th>
                                    NIC/PASSPORT NUMBER
                                </th>
                                <td>
                                    {{$jointHolder->nic}}
                                </td>
                            </tr>
                     
                        <tr>
                            <th>
                                EMAIL
                            </th>
                            <td>
                                {{$jointHolder->email}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                FAX
                            </th>
                            <td>
                               {{$jointHolder->company_fax}}
                         
                            </td>
                        </tr>
                        <tr>
                            <th>
                                OCCUPATION/PROFESSION
                            </th>
                            <td>
                              {{$jointHolder->occupation}}
                            
                            </td>
                        </tr>
                        <tr>
                            <th>
                                ADDRESS OF THE EMPLOYER / COMPANY / BUSINESS
                            </th>
                            <td>
                             {{$jointHolder->company_name}}&nbsp;{{$jointHolder->company_address}}
                            </td>
                        </tr>

                            
                        @endforeach
                         
                     @endif   

                </tbody>
            </table>
            <table class="table table-bordered  table-hover">
                <tbody>
                    <tr class="highlight">
                        <td colspan="3">SECTION B - INVESTMENT INFORMATION OF THE CUSTOMER</td>
                    </tr>
                    <tr>
                        <th>
                            FACE VALUE OF THE TREASURY BILL / BOND
                        </th>
                        <td colspan="2">
                            @if($investment->matured_amount)  @money($investment->matured_amount) @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            PERIOD OF INVESTMENT
                        </th>
                        <td colspan="2">
                            {{Carbon::createFromFormat('Y-m-d', $investment->value_date)->diffInDays( Carbon::createFromFormat('Y-m-d', $investment->maturity_date))}}
                        </td>
                     
                    </tr>
                    <tr>
                        <th>
                            AMOUNT INVESTED
                        </th>
                        <td colspan="2">
                            @if($investment->invested_amount)  @money($investment->invested_amount) @else  @money($investment->amount) @endif
                        </td>
                    </tr>
                  
                        <tr>
                            <th>
                                MODE OF PAYMENT
                            </th>
                            <td colspan="2">
                              
                            </td>
                        </tr>
                    <tr>
                        <td rowspan="3">Cheque</td>
                        <td>CHEQUE NO</td>
                        <td  style="width: 250px"></td>
                    </tr>
                    <tr>
                        <td>BANK</td>
                        <td  style="width: 250px"></td>
                    </tr>
                    <tr>
                        <td>BRANCH</td>
                        <td  style="width: 250px"></td>
                    </tr>
                    <tr>
                        <th>
                           Fund Transfer
                        </th>
                        <td>
                          Account
                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            OPERATING INSTRUCTIONS
                        </th>
                        <td colspan="2">
                          @if ($investment->client->client_type==2)

                                {{$investment->client->joint_permission==0 ?"My Self (Main User)":"Both of us"}}
                              
                          @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            INSTRUCTIONS AT MATURITY
                        </th>
                        <td colspan="2">
                           {{$investment->instruction}}
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="3">MATURITY PROCEED / INTEREST TO BE PAID</td>
                        <td>ACCOUNT NO</td>
                        <td  style="width: 250px">
                          @if ($investment->bank_id!=null)
                              {{$investment->bank->account_no}}
                          @endif
                        </td>
                    </tr>
                    <tr>
                        <td>BANK</td>
                        <td  style="width: 250px">
                            @if ($investment->bank_id!=null)
                            {{$investment->bank->bank_name}}
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td>BRANCH</td>
                        <td  style="width: 250px">
                            @if ($investment->bank_id!=null)
                            {{$investment->bank->branch}}
                        @endif
                        </td>
                    </tr>
                   
                </tbody>
            </table>
            <div class="form-group">
                <button class="btn btn-default no-print btnPrint">
                  Print
                </button>
            </div>
        </div>
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
  $(document).ready(function(){

    $('.btnPrint').on('click',function(){
        window.print();
    });


  });
</script>
@endsection    