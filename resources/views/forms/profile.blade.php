<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<style>

    p {
        font-size: 8px;
    }

    h2 {
        font-size: 16px;
    }

    h3 {
        font-size: 14px;
    }
    h4 {
        font-size: 12px;
    }

    h5 {
        font-size: 10px;
    }
    h6 {
        font-size: 9px;
    }

    .bullet {
        margin: 0 0 0 20px;
        list-style: disc;
    }

    .sublist {
        margin: 0 0 0 20px;
        list-style: none;

    }

    h6 {
        font-size: 14px;
        font-weight: bold;
    }
.customImage {
    display: block;
    width: 100%;
    max-width: 150px;
    height: auto;
    }
    .table_data{
        font-size: small;

      }

      ul.no_bullet{
        list-style-type:none;
      }

      ul.number_bullet{
          list-style-type:decimal;
      }
      ul.alpha_bullet{
        list-style-type: lower-alpha;
      }

      ul.no_bullet li{
          margin-bottom: 3px;
      }
      ul.number_bullet li{
          margin-bottom: 3px;
      }
      ul.alpha_bullet li{
        margin-bottom: 3px;

      }
      
      .page-break-a {
        page-break-before:avoid;
        page-break-after:always;
        page-break-inside: auto;
        font-size: 8px;
      }
      .page-break-b {
        page-break-before:auto;
        page-break-after:avoid;
        page-break-inside: auto;
        font-size: 8px;
      }
       .page-break-a h3{
          font-size:9px;
      }
      .page-break-b h3{
          font-size:9px;
      }

      p {
        margin: 0 0 10px 0;
      }
      ul {
        margin: 0;
        padding: 0;
      }
      li {
        margin: 0;
        padding: 0;
      }

      .table {
        margin: 50px 0 0 0; 
        width: 90%;
        border: 0 !important;
        max-width: 400px;
      }
      .table tr {
        border: 0 !important;
        padding: 0;
        margin: 0;
      }
      .table td {
        width: 40%;
        padding: 0;
        margin: 0;
        border: 0 !important;

      }
      th, td {
        margin: 0;
      }

</style>



    <div class="page-break">
            {{-- <table class="table table-bordered table-sm w-auto" style="font-size:8px !important">
                <thead>
                    <tr>
                   <th colspan="2">NSB Fund Management Customer Form</th>
                   </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" style="text-align: center">
                            
                                <img src="{{public_path("storage/images/certificate_head_logo.png")}}" class="rounded-logo" alt="nsbfm" style="width:200px; height: 70px; margin-bottom:0px; margin-top:0px;">
                           
                        </td>
                    </tr>

                    
                    <tr>
                        <th>
                         Client Name
                        </th>
                        <td>
                            {{ $client->name }}
                        </td>
                     
                    </tr>
                    <tr>
                        <th>
                        Name By Initials
                        </th>
                        <td>
                            {{ $client->name_by_initials }}
                        </td>
                     
                    </tr>
                    <tr>
                        <th>
                         Mobile
                        </th>
                        <td>
                            {{ $client->mobile }}
                        </td>
                       
                    </tr>
                    <tr>
                        <th>
                         Client Email
                        </th>
                        <td>
                            {{ $client->user->email }}
                        </td>
                       
                    </tr>
                    <tr>
                        <th>
                           Residance Address
                        </th>
                        <td>
                            {{ $client->address_line_1}} <br>
                            {{ $client->address_line_2}} <br>
                            {{ $client->address_line_3}} <br>

                        </td>
                     
                    </tr>
                    <tr>
                        <th>
                           Date Of Birth
                        </th>
                        <td>
                     
                         {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$client->dob)->format('Y-m-d') }}
                        </td>
                      
                    </tr>
                    <tr>
                        <th>
                           Nationality
                        </th>
                        <td>
                         {{$client->nationality}}
                        </td>
                      
                    </tr>
                    <tr>
                        <th>
                            National ID
                        </th>
                        <td>
                         {{$client->nic}}
                        </td>
                      
                    </tr>
                    <tr>
                        <th>
                          Account Type
                        </th>
                        <td>
                            {{ Config::get('constants.CLIENT_TYPE')[$client->client_type] }}
                        </td>
                      
                    </tr>
                    @if($client->nic_front!=null)
                    <tr>
                        <th>
                          NIC Front
                        </th>
                        <td>
                               <br>
                                <img src="{{public_path('storage/uploads/'.$client->nic_front)}}"  class="customImage"    alt="nic front">
                           
                        </td>
                       
                    </tr>
                    @endif
                    @if($client->nic_back!=null)
                    <tr>
                        <th>
                          NIC Back
                        </th>
                        <td>
                            <br>
                                <img src="{{public_path('storage/uploads/'.$client->nic_back)}}" class="customImage"   alt="nic back">
                            
                        </td>
                     
                    </tr>
                    @endif
                    @if($client->passport!=null)
                    <tr>
                        <th>
                          Passport
                        </th>
                        <td>
                            <br>
                                <img src="{{public_path('storage/uploads/'.$client->passport)}}" class="customImage"   alt="passport">
                          
                        </td>
                     
                    </tr>
                    @endif
                  
                    @if($client->hasAuthorizedPerson())
                    <tr>
                        <th>
                          Authorized Person
                        </th>
                        <td>
                           <table>
                            <tr>
                                <td>Name</td>
                                <td>{{$authorizedPerson->name}}</td>
                              
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{$authorizedPerson->address}}</td>
                              
                            </tr>
                            <tr>
                                <td>NIC</td>
                                <td>{{$authorizedPerson->nic}}</td>
                               
                            </tr>
                            <tr>
                                <td>Telephone</td>
                                <td>{{$authorizedPerson->telephone}}</td>
                               
                            </tr>

                           </table>
                        </td>
                      
                    </tr>
                    @endif
                    @if ($client->hasEmploymenDetails())
                     @php
                       $employmentDetails = $client->employmentDetails;
                     @endphp
                     <tr>
                        <th>Employment Details</th>
                        <td><table class="table table-bordered table-sm w-auto" style="font-size:8px !important">
                            <tr>
                                <td>Occupation</td>
                                <td>{{$employmentDetails->occupation}}</td>
                              
                            </tr>
                            <tr>
                                <td>Company Name</td>
                                <td>{{$employmentDetails->company_name}}</td>
                               
                            </tr>
                            <tr>
                                <td>Company Address</td>
                                <td>{{$employmentDetails->company_address}}</td>
                               
                            </tr>
                            <tr>
                                <td>Telephone</td>
                                <td>{{$employmentDetails->telephone}}</td>
                           
                            </tr>
                            <tr>
                                <td>Fax</td>
                                <td>{{$employmentDetails->fax}}</td>
                              
                            </tr>
                            <tr>
                                <td>Nature</td>
                                <td>{{$employmentDetails->nature}}</td>
                               
                            </tr>
                        </table>
                        </td>
                        
                     </tr>
                     @endif
                     @if($client->has('jointHolders')->find($client->id))
                     <tr>
                        <td colspan="2">
                         @foreach ($client->jointHolders()->get() as $jointHolder)
                         <table class="table table-bordered table-sm w-auto" style="font-size:8px !important">
                            <tr>
                                <td colspan="2">
                                    Joint Holders
                                </td>
                                
                              
                             </tr>
                             <tr>
                                <td>Name</td>
                                <td>{{$jointHolder->name}}</td>
                              
                             </tr>
                             <tr>
                                <td>Name By Initials</td>
                                <td>{{$jointHolder->name_by_initials}}</td>
                              
                             </tr>
                             <tr>
                                <td>Date Of  Birth</td>
                                <td>{{$jointHolder->dob}}</td>
                               
                             </tr>
                             <tr>
                                <td>NIC/Passport</td>
                                <td>{{$jointHolder->nic}}</td>
                              
                             </tr>
                             <tr>
                                <td>Nationality</td>
                                <td>{{$jointHolder->nationality}}</td>
                               
                             </tr>
                             <tr>
                                <td>Residence Address</td>
                                <td>{{$jointHolder->address_line_1}},
                                    {{$jointHolder->address_line_2}},
                                    {{$jointHolder->address_line_3}}
                                </td>
                             </tr>
                             <tr>
                                <td>Telephone</td>
                                <td>{{$jointHolder->telephone}}</td>
                               
                             </tr>
                             <tr>
                                <td>Mobile</td>
                                <td>{{$jointHolder->mobile}}</td>
                              
                             </tr>
                             @if ($jointHolder->nic_front!=null && $jointHolder->nic_front!='none')
                             <tr>
                                <td>NIC Front</td>
                                <td> 
                                   
                                    <img src="{{public_path('storage/uploads/'.$jointHolder->nic_front)}}"  class="customImage"  alt="Responsive image">
                                </td>
                                
                             </tr>
                             @endif
                             @if ($jointHolder->nic_back!=null && $jointHolder->nic_back!='none')
                             <tr>
                                <td>NIC Back</td>
                                <td> 
                                   
                                    <img src="{{public_path('storage/uploads/'.$jointHolder->nic_back)}}"  class="customImage"  alt="Responsive image">
                                    <br>
                               </td>
                                
                             </tr>
                             @endif
                             @if ($jointHolder->passport!=null && $jointHolder->passport!='none')
                             <tr>
                                <td>Passport</td>
                                <td>
                                   
                                    <img src="{{public_path('storage/uploads/'.$jointHolder->passport)}}"  class="customImage"  alt="Responsive image">
                               </td>
                              
                             </tr>
                             @endif
                             
                         </table>
                    
                         @endforeach
                        </td>
                    
                     </tr>

                     @endif
                     @if($client->has('bankParticulars')->find($client->id))
                     <tr>
                         <th>
                             Bank Particulars
                         </th> 
                         <td>
                             <table class="table table-bordered table-sm w-auto" style="font-size:8px !important">
                                 <tr>
                                     <th>Bank</th>
                                     <th>Account Holder</th>
                                     <th>Branch</th>
                                     <th>Account Type</th>
                                     <th>Account No</th>
                                   
                                 </tr>
                                 @foreach ($client->bankParticulars()->get() as $bankParticulars)
                               

                                 <tr>
                                    <td> {{$bankParticulars->bank_name}} </td>
                                    <td> {{$bankParticulars->name}} </td>
                                    <td> {{$bankParticulars->branch}} </td>
                                    <td> {{$bankParticulars->Account_type}} </td>
                                    <td> {{$bankParticulars->account_no}} </td>
                                  
                                 </tr>   
                                 @endforeach
                             </table>
                         </td>
                        
                     </tr>   
                     @endif
                     @if($client->hasOtherDetails())
                      @php
                        $otherDetails = $client->otherDetails;
                      @endphp
                     <tr>
                     
                      <td colspan="2">
                            <table>
                                <tr>
                                    <th colspan="2">
                                        Other Details
                                    </th>

                                </tr>
                                
                                <tr>
                                    <td>Are you a Director or Staff of NSB Fund Management Company Ltd?</td>
                                    <td>{{$otherDetails->nsb_staff_fund_management==1?"Yes":"No"}}</td>
                                    
                                </tr>
                                <tr>
                                    <td>Are you related to any Director or Staff of NSB Fund Management Company Ltd?</td>
                                    <td>{{$otherDetails->related_nsb_staff==1?"Yes":"No"}}</td>
                                    
                                </tr>
                                <tr>
                                    <td>Are you a Director or Staff of NSB?</td>
                                    <td>{{$otherDetails->nsb_staff==1?"Yes":"No"}}</td>
                                  
                                </tr>

                                <tr>
                                    <td>If “Yes”, please state the Relationship</td>
                                    <td>{{$otherDetails->staff_relationship}}</td>
                                    
                                </tr>
                                <tr>
                                    <td>Are you a Director/Employee of another Primary Dealer/ Holding Company and/or an associate of the Primary Dealer?</td>
                                    <td>{{$otherDetails->member_holding_company==1?"Yes":"No"}}</td>
                                 
                                </tr>

                                <tr>
                                    <td>If yes, please state the Prior written concern</td>
                                    <td>{{$otherDetails->member_holding_company_state}}</td>
                                 
                                </tr>
                            </table>
                      </td>
                   
                    </tr>
                    @endif
                    <tr>
                      @if($client->hasRealTimeNotification())
                      <th>
                          Real Time Notification
                      </th>
                      <td>
                         <table>
                            
                             <tbody>
                                 @if ($client->realTimeNotification->on_email==1)
                                     <tr>  
                                         <th>
                                             ON Email
                                         </th>
                                         <td>
                                             {{$client->realTimeNotification->email}}
                                         </td>
                                     </tr> 
                                @endif 
                                @if ($client->realTimeNotification->on_mobile==1)
                                <tr>  
                                    <th>
                                        ON Mobile
                                    </th>
                                    <td>
                                        {{$client->realTimeNotification->mobile}}
                                    </td>
                                </tr> 
                           @endif 
                               
                             </tbody>
                            

                         </table>
                      </td>
                    </tr>
                      @endif
                    <tr>
                        <th>
                         {{$client->name}} signature
                        <td>

                          <br>
                          <br>
                          -------------------------------
                          <br>
                          <br>
                          <p>date:-</p>
                           
                           
                        </td>
                       

                    </tr>
                    @if($client->hasJointHolders())
                    @foreach ($client->jointHolders()->get() as $jointHolder)
                    <tr>
                        <th>
                        {{$jointHolder->name }} Signature
                        </th>
                        <td>
                            <br>
                            <br>
                            -------------------------------
                            <br>
                            <br>
                            <p>date:-</p>
                           
                          
                           
                        </td>

                    </tr>
                     @endforeach
                    @endif


                    
                   
                </tbody>
            </table> --}}
       
             {{-- @include('forms.authorization') --}}
            @include('forms.customerAgreement')
          
            @include('forms.masterRepurchase')
            {{-- @include('forms.standardService') --}}
     
    </div>

 </body>
</html>



