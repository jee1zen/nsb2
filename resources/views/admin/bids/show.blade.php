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
      Bid For Auction
    </div>
    <div class="card-body">

     
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="{{asset('storage/uploads/'.$bid->client->pro_pic)}}" alt="" class="img-rounded img-responsive" width="100px" height="150px" />
                      
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>
                           {{$bid->client->name}}</h4>
                        <small><cite title="San Francisco, USA">{{$bid->client->residence_address}} <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p>
                            <i class="fa fa-phone">{{$bid->client->mobile}}</i>
                            <br />
                            <i class="fa fa-envelope"></i>{{$bid->client->user->email}}
                            <br />
                            <i class="fa fa-globe"></i><a href="{{route('admin.clients.profile',$bid->client->id)}}" target="_blank">Profile</a>
                            <br />
                            {{-- {{dd($withdraw->client->clientRecords()->get()->last())}} --}}
                            {{-- <i class="fa fa-dollar"></i>@money($bid->amount)</p> --}}
                            
                        <!-- Split button -->
                      
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
           <form id="approvalForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
          

            <table class="table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
               <tr>
               
                    <th>
                        NO
                    </th>
                     <th>
                        Type
                     </th> 
                     <th>
                        Auction Date
                     </th>
                     <th>
                        Value Date
                     </th>
                     <th>
                        Mat Date
                     </th>
                     <th>
                       Amount
                     </th>
                     <th>
                         Bid Rate
                     </th>
                </tr>
                </thead>


                <tbody>
               @if($bid) 
               @forelse ($bid->bids()->where('status',0)->get() as $key=>$set)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$set->investmentType->name}}</td>
                        <td>{{$set->auction_date}}</td>
                        <td>{{$set->value_date}}</td>
                        <td>{{$set->maturity_date}}</td>
                        <td>@money($set->amount)</td>
                        <td>{{$set->rate}}</td>
                     
                    </tr> 
                    @empty
                    No records found
               @endforelse
             @endif
                </tbody>
            </table>   
          
            @if (($officer_role->id==5 && $bid->status==0) || ($officer_role->id==6 && $bid->status == 0)  
            || $officer_role->id==7 && $bid->status==1)
            <div class="form-group">
                <button type="button" id="btnApprove" class="btn btn-success btn-lg"> Approve</button> &nbsp; &nbsp;
                <button type="button" id="btnDecline" class="btn btn-danger btn-lg"> Decline </button>
                <input type="hidden" name="bid_id" value="{{$bid->id}}">
                <input type="hidden" name="client_id" value="{{$bid->client_id}}">
                <input type="hidden" name="request_type" id="request_type" value="" >
            </div>   
            @endif
           </form>
        </div>   

    </div>
</div>

</div>
</div>
@endsection
@section('scripts')
@parent
<script>
     $(function () {
   let nextStage = "{{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$bid->status+1]}}"
        $('#btnApprove').click(function(){
            alertify.confirm('Client Approval', 'Are you sure you want to Approve the Bid Request for further process?', function(){ 
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
