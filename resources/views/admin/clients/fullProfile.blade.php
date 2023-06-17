@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{$client->name}} - Profile
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clients.management') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered  table-hover">
                <tbody>
                    <tr>
                        <th>
                          Clinet ID
                        </th>
                        <td>
                            {{ $client->id }}
                        </td>
                        <td> &nbsp;</td>
                    </tr>
                    <tr>
                        <th>
                         Client Name
                        </th>
                        <td>
                            {{ $client->name }}
                        </td>
                        <td>
                            <input type="checkbox" class="checkBoxVerify" {{$client->name_verify==0?"":'checked'}}  disabled />
                            <label for="checkbox"></label>   
                        </td>
                    </tr>
                    <tr>
                        <th>
                         Client Email
                        </th>
                        <td>
                            {{ $client->user->email }}
                        </td>
                        <td>
                            {{-- <input type="checkbox" class="checkBoxVerify" {{$client->name_verify==0?"":'checked'}} {{$client->status > 2 ?"disabled":""}} />
                            <input type="hidden" value="{{base64_encode(serialize(array("clients","name_verify",$client->name_verify,$client->id)))}}">
                            <label for="checkbox"></label>    --}}
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
                        <td>
                            <input type="checkbox" class="checkBoxVerify" {{$client->address_line_1==0?"":'checked'}}  disabled />
                            <label for="checkbox"></label>
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Date Of Birth
                        </th>
                        <td>
                         {{$client->dob}}
                        </td>
                        <td>
                            <input type="checkbox" class="checkBoxVerify" {{$client->dob_verify==0?"":'checked'}}  disabled />
                            <label for="checkbox"></label>
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Nationality
                        </th>
                        <td>
                         {{$client->nationality}}
                        </td>
                        <td>
                            <input type="checkbox" class="checkBoxVerify" {{$client->nationality_verify==0?"":'checked'}}  disabled />
                            <label for="checkbox"></label>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            National ID
                        </th>
                        <td>
                         {{$client->nic}}
                        </td>
                        <td>
                            <input type="checkbox" class="checkBoxVerify" {{$client->nic_verify==0?"":'checked'}}  disabled />
                            <label for="checkbox"></label>
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Account Type
                        </th>
                        <td>
                            {{ Config::get('constants.CLIENT_TYPE')[$client->client_type] }}
                        </td>
                        <td>
                            <input type="checkbox" class="checkBoxVerify" {{$client->client_type_verify==0?"":'checked'}} disabled />
                            <label for="checkbox"></label>
                        </td>
                    </tr>
                    @if($client->nic_front!=null)
                    <tr>
                        <th>
                          NIC Front
                        </th>
                        <td>
                            <a href="{{asset('/storage/uploads/'.$client->nic_front)}}" target="_blank"> 
                                <img src="{{asset('storage/uploads/'.$client->nic_front)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                            </a>
                        </td>
                        <td>
                            <input type="checkbox" class="checkBoxVerify" {{$client->nic_front_verify==0?"":'checked'}}  disabled />
                            <label for="checkbox"></label>
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
                        <td>
                            <input type="checkbox" class="checkBoxVerify" {{$client->nic_back_verify==0?"":'checked'}}  disabled />
                            <label for="checkbox"></label>
                        </td>
                    </tr>
                    @endif
                    @if($client->passport!=null)
                    <tr>
                        <th>
                          Passport
                        </th>
                        <td>
                            <a href="{{asset('/storage/uploads/'.$client->passport)}}" target="_blank"> 
                                <img src="{{asset('storage/uploads/'.$client->passport)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                            </a>
                        </td>
                        <td>
                            <input type="checkbox" class="checkBoxVerify" {{$client->passport_verify==0?"":'checked'}} disabled/>
                            <label for="checkbox"></label>
                        </td>
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
                        <td>
                            <input type="checkbox" class="checkBoxVerify" {{$client->signature_verify==0?"":'checked'}}  disabled />
                            <label for="checkbox"></label>
                        </td>
                    </tr>
                    @endif
                    @if($authorizedPerson)
                    <tr>
                        <th>
                          Authorized Person
                        </th>
                        <td>
                           <table>
                            <tr>
                                <td>Name</td>
                                <td>{{$authorizedPerson->name}}</td>
                                <td> 
                                    <input type="checkbox" class="checkBoxVerify" {{$authorizedPerson->name_verify==0?"":'checked'}} disabled />
                                  
                                    <label for="checkbox"></label>
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{$authorizedPerson->address}}</td>
                                <td> 
                                    <input type="checkbox" class="checkBoxVerify" {{$authorizedPerson->address_verify==0?"":'checked'}}  disabled  />
                                    <label for="checkbox"></label>
                                </td>
                            </tr>
                            <tr>
                                <td>NIC</td>
                                <td>{{$authorizedPerson->nic}}</td>
                                <td> 
                                    <input type="checkbox" class="checkBoxVerify" {{$authorizedPerson->nic_verify==0?"":'checked'}}  disabled />
                                    <label for="checkbox"></label>
                                </td>
                            </tr>
                            <tr>
                                <td>Telephone</td>
                                <td>{{$authorizedPerson->telephone}}</td>
                                <td> 
                                    <input type="checkbox" class="checkBoxVerify" {{$authorizedPerson->telephone_verify==0?"":'checked'}} disabled  />
                                  
                                    <label for="checkbox"></label>
                                </td>
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
                        <td><table>
                            <tr>
                                <td>Occupation</td>
                                <td>{{$employmentDetails->occupation}}</td>
                                <td> 
                                    <input type="checkbox" class="checkBoxVerify" {{$employmentDetails->occupation_verify==0?"":'checked'}} disabled />

                                    <label for="checkbox"></label>
                                </td>
                            </tr>
                            <tr>
                                <td>Company Name</td>
                                <td>{{$employmentDetails->company_name}}</td>
                                <td> 
                                    <input type="checkbox" class="checkBoxVerify" {{$employmentDetails->company_name_verify==0?"":'checked'}} disabled />
                                  
                                    <label for="checkbox"></label>
                                </td>
                            </tr>
                            <tr>
                                <td>Company Address</td>
                                <td>{{$employmentDetails->company_address}}</td>
                                <td> 
                                    <input type="checkbox" class="checkBoxVerify" {{$employmentDetails->company_address_verify==0?"":'checked'}} disabled />
                                 
                                    <label for="checkbox"></label>
                                </td>
                            </tr>
                            <tr>
                                <td>Telephone</td>
                                <td>{{$employmentDetails->telephone}}</td>
                                <td> 
                                    <input type="checkbox" class="checkBoxVerify" {{$employmentDetails->telephone_verify==0?"":'checked'}} disabled />
                                    <label for="checkbox"></label>
                                </td>
                            </tr>
                            <tr>
                                <td>Fax</td>
                                <td>{{$employmentDetails->fax}}</td>
                                <td> 
                                    <input type="checkbox" class="checkBoxVerify" {{$employmentDetails->fax_verify==0?"":'checked'}}  disabled />
                                 
                                    <label for="checkbox"></label>
                                </td>
                            </tr>
                            <tr>
                                <td>Nature</td>
                                <td>{{$employmentDetails->nature}}</td>
                                <td> 
                                    <input type="checkbox" class="checkBoxVerify" {{$employmentDetails->nature_verify==0?"":'checked'}}  disabled />
    
                                    <label for="checkbox"></label>
                                </td>
                            </tr>
                        </table>
                        </td>
                        <td></td>
                     </tr>
                     @endif
                     @if($client->has('jointHolders')->find($client->id))
                     <tr>
                        <th>Joint Holders</th>
                        <td>
                         @foreach ($client->jointHolders()->get() as $jointHolder)
                         <table>
                             <tr>
                                <td>Name</td>
                                <td>{{$jointHolder->name}}</td>
                                <td>
                                    <input type="checkbox" class="checkBoxVerify" {{$jointHolder->name_verify==0?"":'checked'}}  disabled />
                               
                                    <label for="checkbox"></label>
                                </td>
                             </tr>
                             <tr>
                                <td>Date Of  Birth</td>
                                <td>{{$jointHolder->dob}}</td>
                                <td>
                                    <input type="checkbox" class="checkBoxVerify" {{$jointHolder->dob_verify==0?"":'checked'}}  disabled />
                                  
                                    <label for="checkbox"></label>
                                </td>
                             </tr>
                             <tr>
                                <td>NIC/Passport</td>
                                <td>{{$jointHolder->nic}}</td>
                                <td>
                                    <input type="checkbox" class="checkBoxVerify" {{$jointHolder->nic_verify==0?"":'checked'}} disabled />
                              
                                    <label for="checkbox"></label>
                                </td>
                             </tr>
                             <tr>
                                <td>Nationality</td>
                                <td>{{$jointHolder->nationality}}</td>
                                <td>
                                    <input type="checkbox" class="checkBoxVerify" {{$jointHolder->nationality_verify==0?"":'checked'}}  disabled />
                                   
                                    <label for="checkbox"></label>
                                </td>
                             </tr>
                             <tr>
                                <td>Residacne Address</td>
                                <td>{{$jointHolder->residence_address}}</td>
                                <td>
                                    <input type="checkbox" class="checkBoxVerify" {{$jointHolder->residence_address_verify==0?"":'checked'}}   disabled />
                                    <label for="checkbox"></label>
                                </td>
                             </tr>
                             <tr>
                                <td>Telephone</td>
                                <td>{{$jointHolder->telephone}}</td>
                                <td>
                                    <input type="checkbox" class="checkBoxVerify" {{$jointHolder->telephone_verify==0?"":'checked'}} disabled />
                                   
                                    <label for="checkbox"></label>
                                </td>
                             </tr>
                             <tr>
                                <td>Mobile</td>
                                <td>{{$jointHolder->mobile}}</td>
                                <td>
                                    <input type="checkbox" class="checkBoxVerify" {{$jointHolder->mobile_verify==0?"":'checked'}}  disabled />
                                  
                                    <label for="checkbox"></label>
                                </td>
                             </tr>
                             @if ($jointHolder->nic_front!=null && $jointHolder->nic_front!='none')
                             <tr>
                                <td>NIC Front</td>
                                <td> <a href="{{asset('/storage/uploads/'.$jointHolder->nic_front)}}" target="_blank"> 
                                    <img src="{{asset('storage/uploads/'.$jointHolder->nic_front)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                                </a></td>
                                <td>
                                    <input type="checkbox" class="checkBoxVerify" {{$jointHolder->nic_front_verify==0?"":'checked'}} disabled />
                                  
                                    <label for="checkbox"></label>
                                </td>
                             </tr>
                             @endif
                             @if ($jointHolder->nic_back!=null && $jointHolder->nic_back!='none')
                             <tr>
                                <td>NIC Back</td>
                                <td> <a href="{{asset('/storage/uploads/'.$jointHolder->nic_back)}}" target="_blank"> 
                                    <img src="{{asset('storage/uploads/'.$jointHolder->nic_back)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                                </a></td>
                                <td>
                                    <input type="checkbox" class="checkBoxVerify" {{$jointHolder->nic_back_verify==0?"":'checked'}}  disabled />
                                   
                                    <label for="checkbox"></label>
                                </td>
                             </tr>
                             @endif
                             @if ($jointHolder->passport!=null && $jointHolder->passport!='none')
                             <tr>
                                <td>Passport</td>
                                <td> <a href="{{asset('/storage/uploads/'.$jointHolder->passport)}}" target="_blank"> 
                                    <img src="{{asset('storage/uploads/'.$jointHolder->passport)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                                </a></td>
                                <td>
                                    <input type="checkbox" class="checkBoxVerify" {{$jointHolder->passport_verify==0?"":'checked'}}  disabled />
                                    
                                    <label for="checkbox"></label>
                                </td>
                             </tr>
                             @endif
                             @if ($jointHolder->signature!=null)
                             <tr>
                                <td>signature</td>
                                <td> <a href="{{asset('/storage/uploads/'.$jointHolder->signature)}}" target="_blank"> 
                                    <img src="{{asset('storage/uploads/'.$jointHolder->signature)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                                </a></td>
                                <td>
                                    <input type="checkbox" class="checkBoxVerify" {{$jointHolder->signature_verify==0?"":'checked'}} disabled/>
                                   
                                    <label for="checkbox"></label>
                                </td>
                             </tr>
                             @endif
                         </table>
                        <br>
                         @endforeach
                        </td>
                        <td></td>
                     </tr>

                     @endif
                     @if($client->has('bankParticulars')->find($client->id))
                     <tr>
                         <th>
                             Bank Particulars
                         </th> 
                         <td>
                             <table>
                                 <tr>
                                     <th>Bank</th>
                                     <th>Branch</th>
                                     <th>Account Type</th>
                                     <th>Account No</th>
                                     <th> Verify </th>
                                 </tr>
                                 @foreach ($client->bankParticulars()->get() as $bankParticulars)
                                 @php
                                     $bankAccountType = "Indivitual";
                                     if($bankParticulars->Account_type==1){
                                         $bankAccountType = "Indivitual";
                                     }elseif ($bankParticulars->Account_type==2) {
                                        $bankAccountType = "Joint";
                                     }elseif ($bankParticulars->Account_type==3) {
                                        $bankAccountType = "Institute";
                                     }else{
                                        $bankAccountType = "Not Mentioned";
                                     }
                                 @endphp

                                 <tr>
                                    <td> {{$bankParticulars->bank_name}} </td>
                                    <td> {{$bankParticulars->branch}} </td>
                                    <td> {{$bankAccountType}} </td>
                                    <td> {{$bankParticulars->account_no}} </td>
                                    <td> 
                                        <input type="checkbox" class="checkBoxVerify" {{$bankParticulars->verified==0?"":'checked'}} disabled/>
                                       
                                        <label for="checkbox"></label>
                                    </td>
                                 </tr>   
                                 @endforeach
                             </table>
                         </td>
                         <td>
                         </td>  
                     </tr>   
                     @endif
                     @if($otherDetails)
                     <tr>
                      <th>Other Details</th>
                      <td>
                            <table>
                                <tr>
                                    <td>Are you a Director or Staff of NSB Fund Management Company Ltd?</td>
                                    <td>{{$otherDetails->nsb_staff_fund_management==1?"Yes":"No"}}</td>
                                    <td><input type="checkbox" class="checkBoxVerify" {{$otherDetails->nsb_staff_fund_management_verify==0?"":'checked'}}  {{$client->status > 2 ?"disabled":""}}/>
                                       
                                        <label for="checkbox"></label></td>
                                </tr>
                                <tr>
                                    <td>Are you related to any Director or Staff of NSB Fund Management Company Ltd?</td>
                                    <td>{{$otherDetails->related_nsb_staff==1?"Yes":"No"}}</td>
                                    <td><input type="checkbox" class="checkBoxVerify" {{$otherDetails->related_nsb_staff_verify==0?"":'checked'}}   disabled/>
                                      
                                        <label for="checkbox"></label></td>
                                </tr>
                                <tr>
                                    <td>Are you a Director or Staff of NSB?</td>
                                    <td>{{$otherDetails->nsb_staff==1?"Yes":"No"}}</td>
                                    <td><input type="checkbox" class="checkBoxVerify" {{$otherDetails->nsb_staff_verify==0?"":'checked'}} disabled />
                                        <input type="hidden" value="{{base64_encode(serialize(array("other_details","nsb_staff_verify",$otherDetails->nsb_staff_verify,
                                       $otherDetails->id)))}}">
                                        <label for="checkbox"></label></td>
                                </tr>

                                <tr>
                                    <td>If “Yes”, please state the Relationship</td>
                                    <td>{{$otherDetails->staff_relationship}}</td>
                                    <td><input type="checkbox" class="checkBoxVerify" {{$otherDetails->staff_relationship_verify==0?"":'checked'}}  disabled  />
                                        <label for="checkbox"></label></td>
                                </tr>
                                <tr>
                                    <td>Are you a Director/Employee of another Primary Dealer/ Holding Company and/or an associate of the Primary Dealer?</td>
                                    <td>{{$otherDetails->member_holding_company==1?"Yes":"No"}}</td>
                                    <td><input type="checkbox" class="checkBoxVerify" {{$otherDetails->member_holding_company_verify==0?"":'checked'}} disabled />
                                       
                                        <label for="checkbox"></label></td>
                                </tr>

                                <tr>
                                    <td>If yes, please state the Prior written concern</td>
                                    <td>{{$otherDetails->member_holding_company_state}}</td>
                                    <td><input type="checkbox" class="checkBoxVerify" {{$otherDetails->member_holding_company_state_verify==0?"":'checked'}} disabled />
                                        
                                        <label for="checkbox"></label></td>
                                </tr>
                            </table>
                      </td>
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
                      <td>

                      </td>
                      @endif
                      <td></td>
                     </tr>
                     @endif
                     @if ($client->status==1)
                     <tr>
                         <td colspan="3" align="center">
                             <button id="btnSelectAll" class="btn btn-primary" >Verify All</button>
                         </td>
                     </tr>
                     @endif
                     <tr>
                         <td colspan="3" id="tdVerifyInfo" align="center">
                         </td>
                     </tr>
                    @if ($client->status>=3)
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
                                  
                               <a href="{{asset('/storage/uploads/'.$upload->file_name)}}" target="_blank">{{$upload->file_name}}</a>
                             
                              &nbsp;   
                              @endif
                            @endforeach
                        </td>
                    </tr>
                    @endif

            
                    <tr>
                        
                        <th>
                         Status Progress
                        </th>
                        <td>
                       @if ($client->status ==100)
                        
                       <div class="badge bg-danger text-wrap" style="width: 10rem;">
                           User Declined
                      </div>
                            
                       @else
                          
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
                        @endif
                    </tr>
                    <tr>
                        <th>
                          Current Status
                        </th>
                        <td>
                            @if ($client->status ==100)
                            Declined 
                            @else
                            {{ Config::get('constants.CLIENT_STATUS')[$client->status]}}
                            @endif
                        </td>
                    </tr>
                   
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
<div>
    @php
    //  dd($client->process()->get())
    @endphp
    <table class="table table-success table-striped">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Officer</th>
              <th scope="col">status</th>
              <th scope="col">Action</th>
              <th scope="col">comment</th>
              <th scope="col">Updated</th>
            </tr>
          </thead>
          <tbody>
             @foreach($client->process()->get() as $process)
             <tr>
                 <td>{{$process->id}}</td>
                 <td>{{$process->users()->first()->name}} - {{$process->users()->first()->roles()->first()->title }}</td>
                 <td>{{ Config::get('constants.CLIENT_STATUS') [$process->current_state]}}</td>
                 <td>{{$process->previous_state!=$process->current_state?"Approved" : "Declined"}}</td>
                 <td>{{$process->comment}}</td>
                 <td>{{$process->updated_at}}</td>
            </tr>
             @endforeach         
          </tbody>
      </table>
</div>
@endsection
@section('scripts')
@parent

<script>
   

</script>


@endsection