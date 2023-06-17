@extends('layouts.client')
@section('content')
@php
$user= Auth::user();
$role = $user->roles()->first()->id;
if($user->hasClient()){

    $is_signatureB =  $user->client->is_signatureB;

    }else{
    $is_signatureB = 0;
    }

@endphp
<div class="col-md-9 content">
    <div class="panel panel-default">
      <div class="panel-heading">
          <h2>Settle Reverse Repo</h2>
      </div>
      <div class="panel-body">
  @if ($reverseRepos)
  @foreach($reverseRepos as $key => $reverseRepo)
 @if (($role==10 && $reverseRepo->jointNotApproved($user->jointHolder->id)==0 || $role==8 || $role==9))
  <div class="table-responsive">
    
      <table class=" table table-bordered table-striped table-hover">
          <tbody>
            
                 <tr>
                      <th>
                      #ID
                      </th>
                      <td># {{ $reverseRepo->id}}</td>
                  </tr>
                  <tr>
                    <th>
                       Instruction
                    </th>
                    <td>
                        {{ Config::get('constants.SETTLE_REPO_TYPES')[$reverseRepo->instruction] }}
                    </td>
                </tr> 
                  <tr>
                      <th>
                          Investment
                      </th>
                      <td>
                        {{$reverseRepo->reverseRepo->investment->ref_no}} {{$reverseRepo->reverseRepo->investment->InvestmentType->name}} - @money($reverseRepo->reverseRepo->investment->invested_amount) - Matured -  {{$reverseRepo->reverseRepo->investment->maturity_date}}
                      </td>
                  </tr>
                  <tr>
                      <th>
                         Amount
                      </th>
                      <td>
                          {{$reverseRepo->amount}}
                      </td>
                  </tr> 
                  <tr>  
                      <th>
                      Date
                      </th>
                      <td>
                          {{$reverseRepo->created_at}} &nbsp;({{ $reverseRepo->created_at->diffForHumans()}})
                      </td>
                  </tr>
                  <tr>     
                      <th>
                      Status
                      </th>
                      <td>
                          YOU NEED TO ACCEPT IF THIS TO BE PROCEEDED.
                      </td>
                  </tr> 
                  <tr>
                          <th>Action</th>
                          <td>
                              @php
                                  $user= Auth::user();
                                  $role = $user->roles()->first()->id;
                                  if($user->hasClient()){

                                      $is_signatureB =  $user->client->is_signatureB;

                                      }else{
                                      $is_signatureB = 0;
                                      }
                                  
                              @endphp
                              @if(($role==9 && $reverseRepo->status==-2) ||($is_signatureB==1 && $reverseRepo->status==-2) || ($role==8 && $reverseRepo->status==-1) ||
                              $role==10 && $reverseRepo->status<0 )
                              <form class="approvalForm" method="POST" action ="{{route('client.settleReverseRepo.process')}}" enctype="multipart/form-data">
                                  @csrf
                              <div class="form-group">
                                  <button type="button"  class="btn btn-success btn-lg btnApprove"> Approve</button> &nbsp; &nbsp;
                                  <button type="button"  class="btn btn-danger btn-lg btnDecline"> Decline </button>
                                  <input type="hidden" name="settle_reverse_repo_id" value="{{$reverseRepo->id}}">
                                  <input type="hidden" name="client_id" value="{{$reverseRepo->client->id}}">
                                  <input type="hidden" name="request_type" class="request_type" value="" >
                              </div>   
                             </form>
                             @endif
                          </td>
                      </tr>       
          </tbody>
        
      </table>
    
  </div>
  @endif
  @endforeach

  @else
   NO Requests found Currently.
  @endif

  {{$reverseRepos->links()}}
  </div>
 </div>
</div>
@endsection
@section('scripts')
@parent
<script>
       $(function () {
         
         let nextStage = " ";


        $('.btnApprove').click(function(){
            var approveButton = $(this);
            alertify.confirm('Client Approval', 'Are you sure you want to Approve the SettleReverseRepo Request for further process?', function(){ 
                
                approveButton.closest('form').find('.request_type').val(1);
                alertify.success("Approved! NEXT STEP - "+nextStage) ;
                approveButton.closest('form').submit();
               }
                , function(){ alertify.error('Action Cancelled')});
        });

        $('.btnDecline').click(function(){
            var declineButton = $(this);
            alertify.prompt( 'Decline From Further Process', 'Reason for Decline', ''
               , function(evt, value) { 
                approveButton.closest('form').find('.request_comment').val(value);
                approveButton.closest('form').find('.request_type').val(0);
                   alertify.error("You've Decliend Further Process!") 
                   approveButton.closest('form').submit();
                   }
               , function() { alertify.error('Action Cancelled') });

        });
     });
 </script>
 @endsection