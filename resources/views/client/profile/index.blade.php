@extends('layouts.client')
@section('content')

<div class="container">
    <div class="col-md-10 profile-info content">
        <div class="panel panel-default">
      <div class="panel-heading">
          <h2>Profile Info</h2>
          @if ($client->status==9)
          <a class="btn btn-danger btn-sm" href="{{route('client.profileEdit')}}">Edit Profile</a>
          @endif
         
      </div>
      <div class="panel-body">
          <table class="table table-bordered  table-hover">
              <tbody>
                  <tr>
                      <th>
                        Clinet ID
                      </th>
                      <td>
                          {{ $client->id }}
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
                       {{$client->address_line_1}} <br>
                       {{$client->address_line_2}} <br>
                       {{$client->address_line_3}}
                      </td>
                   
                  </tr>
                  <tr>
                      <th>
                         Date Of Birth
                      </th>
                      <td>
                       {{$client->dob}}
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
                  
                  @if($authorizedPerson)
                  <tr>
                      <th>
                        Authorized Person
                      </th>
                      <td>
                         <table class="table table-sm">
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
                      <td>
                        
                      </td>
                  </tr>
                  @endif
                  @if ($employmentDetails)
                   <tr>
                      <th>Employment Details</th>
                      <td><table class="table table-sm">
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
                      <td></td>
                   </tr>
                   @endif
                   {{-- @if($client->has('jointHolders')->find($client->id))
                   <tr>
                      <th>Joint Holders</th>
                      <td>
                       @foreach ($client->jointHolders()->get() as $jointHolder)
                       <table class="table table-responsive">
                           <tr>
                              <td>Name</td>
                              <td>{{$jointHolder->name}}</td>
                          
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
                              <td>Residacne Address</td>
                              <td>{{$jointHolder->residence_address}}</td>
                            
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
                              <td> <a href="{{asset('/storage/uploads/'.$jointHolder->nic_front)}}" target="_blank"> 
                                  <img src="{{asset('storage/uploads/'.$jointHolder->nic_front)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                              </a></td>
                             
                           </tr>
                           @endif
                           @if ($jointHolder->nic_back!=null && $jointHolder->nic_back!='none')
                           <tr>
                              <td>NIC Back</td>
                              <td> <a href="{{asset('/storage/uploads/'.$jointHolder->nic_back)}}" target="_blank"> 
                                  <img src="{{asset('storage/uploads/'.$jointHolder->nic_back)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                              </a></td>
                           
                           </tr>
                           @endif
                           @if ($jointHolder->passport!=null && $jointHolder->passport!='none')
                           <tr>
                              <td>Passport</td>
                              <td> <a href="{{asset('/storage/uploads/'.$jointHolder->passport)}}" target="_blank"> 
                                  <img src="{{asset('storage/uploads/'.$jointHolder->passport)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                              </a></td>
                             
                           </tr>
                           @endif
                           @if ($jointHolder->signature!=null)
                           <tr>
                              <td>signature</td>
                              <td> <a href="{{asset('/storage/uploads/'.$jointHolder->signature)}}" target="_blank"> 
                                  <img src="{{asset('storage/uploads/'.$jointHolder->signature)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                              </a></td>
                             
                           </tr>
                           @endif
                       </table>
                      <br>
                       @endforeach
                      </td>
                      <td></td>
                   </tr>
                   @endif --}}
                   @if($client->has('bankParticulars')->find($client->id))
                   <tr>
                       <th>
                           Bank Particulars
                       </th> 
                       <td>
                           <table class="table table-responsive">
                               <tr>
                                   <th>Bank</th>
                                   <th>Branch</th>
                                   <th>Account Type</th>
                                   <th>Account No</th>
  
                               </tr>
                               @foreach ($client->bankParticulars()->get() as $bankParticulars)
                               <tr>
                                  <td> {{$bankParticulars->bank_name}} </td>
                                  <td> {{$bankParticulars->branch}} </td>
                                  <td> {{$bankParticulars->Account_type}} </td>
                                  <td> {{$bankParticulars->account_no}} </td>
                               
                               </tr>   
                               @endforeach
                           </table>
                       </td>
                       <td>
                       </td>  
                   </tr>   
                   @endif
                   {{-- @if($otherDetails)
                   <tr>
                    <th>Other Details</th>
                    <td>
                          <table class="table table-sm">
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
                    <td></td>
                   </tr>
                   @endif --}}
                 
                
                  {{-- @if ($client->status>=3)
                  <tr>
                      <th>
                       Videos
                      
                      </th>
                      <td>
                          
                          @foreach($client->uploads()->get() as $upload)
                           @php
                               $info = pathinfo($upload->file_name);
                              
                           @endphp
                            @if ($info['extension']=='mp4' || $info['extension']=='m4v')
                            <video width="320" height="240" controls>
                              <source src="{{asset('/storage/uploads/'.$upload->file_name)}}" type="video/mp4">
                              
                            Your browser does not support the video tag.
                            </video>
  
                            @endif
                          @endforeach
                      </td>
                  </tr>
                  @endif
                  @if ($client->status>=3)
                  <tr>
                      <th>
                       Documents
                      
                      </th>
                      <td>
                          
                          @foreach($client->uploads()->get() as $upload)
                           @php
                               $info = pathinfo($upload->file_name);
                              
                           @endphp
                          @if($info['extension']=='pdf' || $info['extension']=='docx' || $info['extension'] == 'doc')
                                
                             <img src="{{asset('/storage/uploads/'.$upload->file_name)}}" height="100" width="75" alt="{{$upload->title}}">
                           
                            &nbsp;   
                            @endif
                          @endforeach
                      </td>
                  </tr>
                  @endif  --}}
                  {{-- <tr>
                      <th>
                       Status Progress
                      </th>
                      <td>
                        
                          @foreach (Config::get('constants.CLIENT_STATUS') as $key =>$client_state)
                            @if ($key > $client->status)
                            <div class="badge bg-secondary text-wrap" style="width: 10rem;">
                              {{$client_state}}
                            </div>
                           
                            @else
                            <div class="badge bg-success text-wrap" style="width: 10rem;">
                              {{$client_state}}
                            </div>
                            @endif
                          @endforeach
                      </td>
                  </tr> --}}
                  {{-- <tr>
                      <th>
                        Current Status
                      </th>
                      <td>
                          @if ($client->verify_type==0)
                          {{ Config::get('constants.CLIENT_STATUS_PHY')[$client->status]}}
                          @else
                          {{ Config::get('constants.CLIENT_STATUS')[$client->status]}}
                          @endif
                         
                      </td>
                  </tr> --}}
                 
              </tbody>
          </table>


          <table class="table table-bordered  table-hover">
            
            @if($client->nic_front!=null)
                  <tr>
                      <th width="20%">
                        NIC Front
                      </th>
                      <td>
                          <a href="{{asset('/storage/uploads/'.$client->nic_front)}}" target="_blank"> 
                              <img src="{{asset('storage/uploads/'.$client->nic_front)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                          </a>
                      </td>
                     
                  </tr>
                  @endif
                 
                
                    @if($client->nic_back!=null)
                    <tr>
                      <th>
                        NIC Back
                      </th>
                      <td>
                        <a href="{{asset('/storage/uploads/'.$client->nic_back)}}" target="_blank"> 
                            <img src="{{asset('storage/uploads/'.$client->nic_back)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                        </a>
                    </td>
                    </tr>
                      @endif
                      @if($client->passport!=null)
                      <tr>
                      <th>
                        Passport
                      </th>
                      <a href="{{asset('/storage/uploads/'.$client->passport)}}" target="_blank"> 
                        <img src="{{asset('storage/uploads/'.$client->passport)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                    </a>
                    </tr>
                      @endif
                      @if($client->signature!=null)
                      <tr>
                      <th>
                        Signature
                       </th>
                       <td>
                        <a href="{{asset('/storage/uploads/'.$client->signature)}}" target="_blank"> 
                            <img src="{{asset('storage/uploads/'.$client->signature)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                        </a>
                    </td>
                    </tr>
                      @endif
                   
                 </table>
  
      </div>
      
       </div>
  </div>
</div>
@endsection
@section('scripts')
	@parent
		<script>
		</script>
@endsection
  		