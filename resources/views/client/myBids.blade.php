@extends('layouts.client')
@section('content')
<div class="col-md-6 content">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2>My Bids</h2>
    </div>
      <div class="panel-body">
        @php
         if(isset($parameters)){
          $fromDate = $parameters['fromDate'];
          $toDate   = $parameters['toDate'];
          $type = $parameters['type'];
         }else{
         
            $fromDate= Carbon\Carbon::now()->format('Y-m-d');
            $toDate =Carbon\Carbon::now()->format('Y-m-d');
            $type  = '';
        

         }
        @endphp
      
        <form method="POST" action="{{route('client.bid.filter')}}">
          @csrf
          <table class="table table-stripped table-borded">
            <tbody>
            <tr>
              <th width>Investment Type</th>
                <td>
                <select name="investment_type" id="investment_type" class="form-control" required>
                  @php
                      $investmenet_types = App\InvestmentType::limit(2)->get();
                    
                  @endphp
                      <option value='' selected >Select Investment</option>
                  {{-- <option value="0" {{$type==0? 'selected' : ''}}  >Any</option> --}}
                  @foreach ( $investmenet_types as $investment)
                  <option value="{{$investment->id}}"  {{$type==$investment->id? 'selected' : ''}}  >{{$investment->name}}</option>
                  @endforeach
                  </select>
                </td>
            </tr>
            <tr>
              <th>From Date</th>
              <td>
                <input type="date" id="fromDate" name="fromDate" value="{{$fromDate}}" class="form-control">
              </td>
            </tr>
              <tr>
                <th>To Date</th>
                <td>
                  <input type="date" id="toDate" name="toDate" value="{{$toDate}}" class="form-control">
                </td>
              </tr>
              <tr>
                <td colspan="2"><button class="btn btn-primary">Submit</button></td>
              </tr>
            </tbody>
          </table>
      </form>
      </div>
 </div>
</div>
<div class="col-md-9 content">
  <div class="panel panel-default">
	<div class="panel-heading">
		<h2>Bids</h2>
	</div>
	<div class="panel-body">
        <table class="table table-stripped">
            <thead>  
              <tr class="bank-row">
                <td>
                  NO
                </td>
                  <td>
                    Instrument Type
                  </td>
                  <td>
                   Value Date
                   </td> 
                   <td>
                    Maturity Date
                    </td>          
                   <td>
                   Bid Amount
                   </td> 
                   <td>
                    Bid Rate
                   </td>   
                  
              </tr>   
              </thead>
              <tbody>
                  @foreach ($bids as $key=> $bid)
                
                  <tr>
                    <td>{{$key+1}}</td>
                      <td>{{$bid->name}}</td>
                      <td> {{$bid->value_date}} </td>
                      <td> {{$bid->maturity_date}} </td>
                       <td> @money($bid->amount)</td>
                       <td> {{$bid->rate}}%</td>
                  </tr>
                 
                  @endforeach
                  
              </tbody>    
    
    
    
          </table>   
    
          {{$bids->links()}}
	 </div>
   </div>
</div>

@endsection
@section('scripts')
	@parent
		<script>

$("#fromDate").flatpickr({
                        enableTime: false,
                        dateFormat: "Y-m-d",
                       
                    });

                                 
                    $("#toDate").flatpickr({
                        enableTime: false,
                        dateFormat: "Y-m-d",
                      
                    });



		</script>
@endsection
  		