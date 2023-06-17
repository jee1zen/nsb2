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
         <h2> Settle ReverseRepo {{ Config::get('constants.SETTLE_REPO_TYPES')[$reverseRepo->instruction]}}</h2> 

          {{-- {{Config::get('constants.REQUEST_TYPES')[$reversRepo->request_type] }}
    </div> --}}
    <div class="card-body">

     
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        @if ($reverseRepo->client->nationality=="other")
                        <img src="{{asset('storage/uploads/'.$reverseRepo->client->passport)}}" alt="" class="img-rounded img-responsive" width="50px" height="100px" />
                        @else
                        <img src="{{asset('storage/uploads/'.$reverseRepo->client->nic_front)}}" alt="" class="img-rounded img-responsive" width="100px" height="150px" />
                        @endif
                      
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>
                           {{$reverseRepo->client->name}}</h4>
                        <small><cite title="San Francisco, USA">{{$reverseRepo->client->residence_address}} <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p>
                            <i class="fa fa-phone">{{$reverseRepo->client->mobile}}</i>
                            <br />
                            <i class="fa fa-envelope"></i>{{$reverseRepo->client->user->email}}
                            <br />
                            <i class="fa fa-globe"></i><a href="{{route('admin.clients.profile',$reverseRepo->client->id)}}" target="_blank">Profile</a>
                            <br />
                            {{-- {{dd($reverseRepo->client->clientRecords()->get()->last())}} --}}
                            <i class="fa fa-dollar"></i> {{$reverseRepo->reverseRepo->investment->ref_no}}- @money($reverseRepo->reverseRepo->investment->invested_amount)</p>
                            
                        <!-- Split button -->
                      
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
           <form id="approvalForm" action="" method="POST" action ="" enctype="multipart/form-data">
            @csrf
            <label for="">Available Balance @money($reverseRepo->reverseRepo->investment->invested_amount)</label></br>
            @if ($reverseRepo->amount!=0)
            <label for="">Requested SettleReverseRepo Amount @money($reverseRepo->amount)</label></br>
            @endif
            <label for="">{{$reverseRepo->reverseRepo->investment->InvestmentType->name}}</label></br>
            <label for="">Current Status - {{Config::get('constants.WITHDRAW_REQUEST_STATUS')[$reverseRepo->status]}}</label>
            @if ($officer_role->id==5 && $reverseRepo->status==0 ||$officer_role->id==6 && $reverseRepo->status == 0 
            || $officer_role->id==7 && $reverseRepo->status==1)
            <div class="form-group">
                <button type="button" id="btnApprove" class="btn btn-success btn-lg"> Approve</button> &nbsp; &nbsp;
                <button type="button" id="btnDecline" class="btn btn-danger btn-lg"> Decline </button>
                <input type="hidden" name="reverseRepo_id" value="{{$reverseRepo->id}}">
                <input type="hidden" name="client_id" value="{{$reverseRepo->client->id}}">
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
   let nextStage = "{{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$reverseRepo->status+1]}}"
        $('#btnApprove').click(function(){
            alertify.confirm('Client Approval', 'Are you sure you want to Approve the reverseRepo Request for further process?', function(){ 
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
