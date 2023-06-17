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
         <h2> Client Info Changes</h2> 

          {{-- {{Config::get('constants.REQUEST_TYPES')[$reversRepo->request_type] }}
    </div> --}}
    <div class="card-body">

     
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
              
                    <table class="table">
                        <head>
                            <tr>
                                <th>Field</th>
                                <th>Current</th>
                                <th>Change</th>
                            </tr>
     
                        </head>
                        <tbody>
                         @if($change->title_state)
                         <tr>
                              <th>Title</th>
                              <td>{{$change->client->title}}</td>
                              <td>{{$change->title}}</td>
                         </tr>
                         @endif
                         @if($change->name_state)
                         <tr>
                              <th>Name</th>
                              <td>{{$change->client->name}}</td>
                              <td>{{$change->name}}</td>
                         </tr>
                         <tr>
                             <th>Proof Doc</th>
                             <td colspan="2">
                                 <a href="{{asset('/storage/uploads/'.$change->name_proof_doc)}}" target="_blank">{{$change->name_proof_doc}}</a>
                             </td>
                           
                         </tr>
                         @endif
                         @if($change->address_state)
                         <tr>
                              <th>Address line 1</th>
                              <td>{{$change->client->address_line_1}}</td>
                              <td>{{$change->address_line_1}}</td>
                         </tr>
                         <tr>
                            <th>Address line 2</th>
                            <td>{{$change->client->address_line_2}}</td>
                            <td>{{$change->address_line_2}}</td>
                       </tr>
                        <tr>
                            <th>Address line 3</th>
                            <td>{{$change->client->address_line_2}}</td>
                            <td>{{$change->address_line_2}}</td>
                        </tr>
                         @endif
                         @if($change->correspondence_address_state)
                         <tr>
                              <th>Corresspondence Address line 1</th>
                              <td>{{$change->client->correspondence_address_line_1}}</td>
                              <td>{{$change->address_line_1}}</td>
                         </tr>
                         <tr>
                            <th>Corresspondence Address line 2</th>
                            <td>{{$change->client->correspondence_address_line_2}}</td>
                            <td>{{$change->address_line_2}}</td>
                       </tr>
                        <tr>
                            <th>Corresspondence Address line 3</th>
                            <td>{{$change->client->correspondence_address_line_3}}</td>
                            <td>{{$change->address_line_3}}</td>
                        </tr>
                         @endif
                         @if ($change->nic_state)

                          <tr>
                            <th>
                                NIC front
                            </th>
                            <td>
                                <a href="{{asset('/storage/uploads/'.$change->client->nic_front)}}" target="_blank"> 
                                    <img src="{{asset('storage/uploads/'.$change->client->nic_front)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                                </a>
                            </td>
                            <td>
                                <a href="{{asset('/storage/uploads/'.$change->nic_front)}}" target="_blank"> 
                                    <img src="{{asset('storage/uploads/'.$change->nic_front)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                                </a>
                            </td>
                          </tr>
                          <tr>
                            <th>
                                NIC Back
                            </th>
                            <td>
                            <a href="{{asset('/storage/uploads/'.$change->client->nic_back)}}" target="_blank"> 
                                <img src="{{asset('storage/uploads/'.$change->client->nic_back)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                            </a>
                            </td>
                            <td>
                            <a href="{{asset('/storage/uploads/'.$change->nic_back)}}" target="_blank"> 
                                <img src="{{asset('storage/uploads/'.$change->nic_back)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                            </a>
                            </td>

                          </tr>
                           
                        
                             @if($change->passport!=null || $change->passport !='')

                                <th>
                                   Passport
                                </th>
                                <td>
                                    <a href="{{asset('/storage/uploads/'.$change->client->passport)}}" target="_blank"> 
                                        <img src="{{asset('storage/uploads/'.$change->client->passport)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{asset('/storage/uploads/'.$change->passport)}}" target="_blank"> 
                                        <img src="{{asset('storage/uploads/'.$change->passport)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                                    </a>
                                </td>

                             @endif



                             
                         @endif

                        
                       
                        </tbody>



                    </table>
                   
               
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
           <form id="approvalForm"  method="POST" action ="{{route('admin.changes.process')}}" enctype="multipart/form-data">
            @csrf
            
            Approve The Changes
            @if ($officer_role->id==5 && $change->status==0 ||$officer_role->id==6 && $change->status == 0)
            <div class="form-group">
                <button type="button" id="btnApprove" class="btn btn-success btn-lg"> Approve</button> &nbsp; &nbsp;
                <button type="button" id="btnDecline" class="btn btn-danger btn-lg"> Decline </button>
                <input type="hidden" name="change_id" value="{{$change->id}}">
                <input type="hidden" name="client_id" value="{{$change->client->id}}">
                <input type="hidden" name="request_type" id="request_type" value="" >
            </div>   
            @endif
           </form>
        </div>   

        {{-- @if($reverseRepo->bank_id !=0)
        <div class="col-xs-12 col-sm-6 col-md-6">
            Account To  Tranfer 
            <table class="table table-responsive">
                <tr>
                    <td>Bank</td>
                    <td>{{$reverseRepo->bankAccount->bank_name}}</td>
                </td>   
                <tr>
                    <td>Branch</td>
                    <td>{{$reverseRepo->bankAccount->branch}}</td>
                </td>   
                <tr>
                    <td>Account No</td>
                    <td>{{$reverseRepo->bankAccount->account_no}}</td>
                </td>   
                <tr>
                    <td>Account Type</td>

                    <td>
                        {{Config::get('constants.CLIENT_TYPE') [$reverseRepo->bankAccount->Account_type]}}
                    
                    </td>
                </td>   


            </table>
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
   let nextStage = "Apply Changes to Master Records"
        $('#btnApprove').click(function(){
            alertify.confirm('Client Approval', 'Are you sure you want to Approve the Change Request for further process?', function(){ 
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
     });

</script>
@endsection
