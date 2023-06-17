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

    <div class="top-text text-center"><h4>Application For Bid for Treasury Bill/Bond Auction (For Personal Customers)</h4></div>
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
                <table class="table dark-table table-bordered">
                    <tr class="highlight">
                        <td colspan="2">FOR OFFICE USE ONLY	</td>
                    </tr>
                    <tr>
                        <td width="30%">
                            DATE
                        </td>
                        <td>
                            
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

            <table class="table table-bordered table-hover">
                <tbody>
                    <tr class="highlight">
                        <td colspan="4"> <h6>SECTION A - <i> Basic information of the Individual Customer</i> </h6></td>
                    </tr>
                    <tr>
                        <th width="20%">
                        NAME IN FULL
                        </th>
                        <td colspan="3">
                            {{-- {{ $client->name_by_initials }} --}}
                            {{ ucfirst(trans($client->name_by_initials)) }}
                        </td>
                     
                    </tr>
                    <tr>
                        <th>
                            RESIDENCE ADDRESS
                        </th>
                        <td colspan="3">
                            {{$client->address_line_1}} &nbsp; {{$client->address_line_2}} &nbsp; {{$client->address_line_3 }}
                        </td>
                    </tr>
                   
                        <tr>
                            <th>
                                NIC/PASSPORT NUMBER
                            </th>
                            <td colspan="3">
                                {{$client->nic}}
                            </td>
                        </tr>
                 
                    <tr aria-rowspan="4">
                        <th>
                            Nationality
                        </th>
                        <td>
                            {{$client->nationality}}
                        </td>
                        <th>
                          Date of Birth
                        </th>
                        <td>
                            {{-- {{$client->dob}} --}}
                            {{Carbon::parse($client->dob)->format('d-m-Y');}}
                        </td>
                    </tr>
                    <tr aria-rowspan="4">
                        <th>
                           Telephone
                        </th>
                        <td>
                            {{$client->telephone}}
                        </td>
                        <th>
                         Mobile
                        </th>
                        <td>
                            {{$client->mobile}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Email
                        </th>
                        <td colspan="3">
                            {{$client->user->email}}
                        </td>
                    </tr>
                   

                   

                </tbody>
            </table> 
            <table class="table table-bordered  table-hover">
                <tbody>
                    <tr class="highlight">
                        <td colspan="3"><h6> Section B – <i>Bid Details </i> </h6></td>
                    </tr>
                    <tr>
                       <table class="table table-bordered  table-hover">
                         <thead>
                            <tr>
                                <th>No Bid</th>
                                <th>Type</th>
                                <th>Auction Date</th>
                                <th>Value Date</th>
                                <th>Maturity Date</th>
                                <th>Face Value (Rs.)</th>
                                <th>Yield</th>
                                <th>Price</th>
                            </tr>
                         </thead>
                         <tbody>
                         
                             @foreach ($bidSet->bids()->get() as $key => $bid)
                             <tr>   
                                <td>
                                    {{$key+1}}
                                </td>
                                <td>
                                    {{$bid->investmentType->name}}
                                </td>
                                <td>
                                   {{$bid->auction_date ?? ""}}
                                </td>
                                <td>
                                    {{$bid->value_date}}
                                </td>
                                <td>
                                    {{$bid->maturity_date}}
                                </td>
                                <td>
                                  @money($bid->amount)
                                  
                                </td>

                                <td>
                                    {{$bid->rate}}%
                                </td>
                                <td>
                                    @php

                                        $numberOfDays =Carbon::createFromFormat('Y-m-d', $bid->value_date)->diffInDays( Carbon::createFromFormat('Y-m-d', $bid->maturity_date));
                                      
                                        $withoutPoints = strval($bid->rate * 100);
                                       

                                        
                                        if($numberOfDays<= 91){
                                            $baseNumber =  '4.'.$withoutPoints;

                                        
                                            $price = number_format(400/floatval($baseNumber),4);
                                        }elseif($numberOfDays > 91 && $numberOfDays <=182 ) {
                                            
                                            $baseNumber =  '2.'.$withoutPoints;
                                            $price = number_format(200/floatval($baseNumber),4);
                                        }else{
                                            $baseNumber =  '1.'.$withoutPoints;
                                            $price = number_format(200/floatval($baseNumber),4);

                                        }


                                    @endphp
                                      @if ($bid->investmentType->id==1)
                                      {{$price}}     
                                      @endif
                                     

                                </td>

                            </tr>
                                 
                             @endforeach
                             
                         </tbody>
                       </table>
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