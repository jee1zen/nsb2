@extends('layouts.client')
@section('content')
<div class="col-md-9 content">
    <div class="panel panel-default">
      <div class="panel-heading">
          <h2>Maturity Requests</h2>
      </div>
      <div class="panel-body">
        @php
        $user= Auth::user();
        $role = $user->roles()->first()->id;
        if($user->hasClient()){

            $is_signatureB =  $user->client->is_signatureB;

            }else{
            $is_signatureB = 0;
            }
        
        @endphp
        @if ($withdraws)
        @foreach($withdraws as $key => $withdraw)
      
        @if (($role==10 && $withdraw->jointNotApproved($user->jointHolder->id)==0 || $role==8 || $role==9))
    
        <div class="table-responsive">
          
            <table class=" table table-bordered table-striped table-hover">
                <tbody>
                  
                       <tr>
                            <th>
                            #ID
                            </th>
                            <td># {{ $withdraw->id}}</td>
                        </tr>
                        <tr>
                            <th>
                                Request Type
                            </th>
                            <td>
                                {{Config::get('constants.REQUEST_TYPES')[$withdraw->request_type] }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Investment
                            </th>
                            <td>
                                {{$withdraw->investment->investmentType->name}} - @money($withdraw->investment->invested_amount) - Matured -  {{$withdraw->investment->maturity_date}}
                            </td>
                        </tr> 
                        <tr>   
                            <th>
                            If Withdraw -  Amount
                            </th>
                            <td>
                                @money($withdraw->amount)
                            </td>
                        </tr>
                        <tr>  
                            <th>
                            Date
                            </th>
                            <td>
                                {{$withdraw->created_at}} &nbsp;({{ $withdraw->created_at->diffForHumans()}})
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
                                
                                    @if(($role==9 && $withdraw->status==-2) ||($is_signatureB==1 && $withdraw->status==-2) || ($role==8 && $withdraw->status==-1) ||
                                    $role==10 && $withdraw->status<0 )
                                    <form class="approvalForm" action="" method="POST" action ="" enctype="multipart/form-data">
                                        @csrf
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success btn-lg btnApprove"> Approve</button> &nbsp; &nbsp;
                                        <button type="button"  class="btn btn-danger btn-lg btnDecline"> Decline </button>
                                        <input type="hidden" name="withdraw_id" value="{{$withdraw->id}}">
                                        <input type="hidden" name="client_id" value="{{$withdraw->client->id}}">
                                        <input type="hidden" class="request_type" name="request_type" value="" >
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
        {{$withdraws->links()}}
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
            alertify.confirm('Client Approval', 'Are you sure you want to Approve the Maturity Instruction Request for further process?', function(){ 
                
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