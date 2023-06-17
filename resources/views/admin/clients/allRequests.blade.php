@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            {{-- <a class="btn btn-success" href="{{ route("admin.users.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a> --}}
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-body">
        @php
        if(isset($parameters)){
         $fromDate = $parameters['fromDate'];
         $toDate   = $parameters['toDate'];
         $type = $parameters['type'];
        
        }else{
        
            $fromDate= Carbon\Carbon::now()->format('Y-m-d');
       $toDate =Carbon\Carbon::now()->format('Y-m-d');
         $type=0;
       

        }
       @endphp
         <form method="GET" action="{{route('admin.allRequest.filter')}}">
             @csrf
       <div class="row">
         
           <div class="col-md-3">
            <input type="date" name="fromDate"id="fromDate" value="{{$fromDate}}" class="form-control">
           </div>
           <div class="col-md-3">
            <input type="date" name="toDate" id="toDate" value="{{$toDate}}" class="form-control">
            </div>
            <div class="col-md-3">
                  <select name="type" id="type" class="form-control" required>
                    <option value="0" {{$type==0?"selected":""}}>Select</option>
                    <option value="1"  {{$type==1?"selected":""}}>New Investments</option>
                    <option value="2"  {{$type==2?"selected":""}}>Maturity Instruction</option>
                    <option value="3"  {{$type==3?"selected":""}}>Reverse Repo</option>
                    <option value="4"  {{$type==4?"selected":""}}>Bids</option>
                    
                  </select>
                </div>
            <div class="col-md-3">
               <button class="btn btn-primary">Submit</button>
            </div>
        
       </div>
    </form>
        
    </div>
</div>
@if($type==1)
<div class="card">
    <div class="card-header">
  <h3>New Investments</h3>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                           Ref No 
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                          Account Type
                        </th>
                        <th>
                          Type
                        </th>
                        <th>
                         Value & Maturity on
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                         Status
                        </th>
                        <th>
                        Requested At
                        </th>
                      
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($newInvestments)
                    @foreach($newInvestments as $key => $investment)
                        <tr data-entry-id="{{ $investment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $investment->ref_no ?? 'N/A' }}
                            </td>
                            <td>
                              {{$investment->client->title}} &nbsp; {{ $investment->client->name ?? '' }}
                            </td>
                          
                            <td>
                                {{ Config::get('constants.CLIENT_TYPE')[$investment->client->client_type] }}
                            </td>

                            <td>
                                {{ $investment->investmentType->name }}
                            </td>
                            <td>
                                {{$investment->value_date}} to {{$investment->maturity_date}}
                            </td>
                            <td>
                                @if ($investment->invested_amount==0)
                                    
                                @money($investment->amount)
                                @else
                                @money($investment->invested_amount)
                                @endif

                             
                            </td>
                            <td>
                             @if ($investment->is_main==0)
                              @if ($investment->status==50)
                                Synced Without Instruction
                                @else
                                {{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$investment->status]}}
                              @endif
                           
                             @else
                             {{ Config::get('constants.CLIENT_STATUS')[$investment->status]}}
                             @endif
                           
                            </td>
                            <td>
                                {{$investment->created_at}} &nbsp;({{ $investment->created_at->diffForHumans()}})
                            </td>
                            <td>
                            

                            </td>
                        

                        </tr>
                        
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@elseif ($type==2)

    <div class="card">
        <div class="card-header">
      <h3>Maturity Instructions</h3>
        </div>
    
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                            <th width="10">
    
                            </th>
                            <th>
                               Ref No 
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                              Account Type
                            </th>
                            <th>
                              Type
                            </th>
                            <th>
                             Value & Maturity on
                            </th>
                            <th>
                                Amount
                             </th>
                             <th>
                                 Instruction
                             </th>
                            <th>
                             Status
                            </th>
                            <th>
                            Requested At
                            </th>
                          
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($maturityInstruction)
                        @foreach($maturityInstruction as $key => $investment)
                            <tr data-entry-id="{{ $investment->id }}">
                                <td>
    
                                </td>
                                <td>
                                    {{ $investment->investment->ref_no ?? 'N/A' }}
                                </td>
                                <td>
                                  {{$investment->investment->client->title}} &nbsp; {{ $investment->investment->client->name ?? '' }}
                                </td>
                              
                                <td>
                                    {{ Config::get('constants.CLIENT_TYPE')[$investment->client->client_type] }}
                                </td>
    
                                <td>
                                    {{$investment->investment->investmentType->name }}
                                </td>
                                <td>
                                    {{$investment->investment->value_date}} to {{$investment->investment->maturity_date}}
                                </td>
                                <td>
                                    @if ($investment->investment->invested_amount==0)
                                        
                                    @money($investment->investment->amount)
                                    @else
                                    @money($investment->investment->invested_amount)
                                    @endif
    
                                 
                                </td>
                                <td>
                                    {{Config::get('constants.REQUEST_TYPES')[$investment->request_type]}}
                                </td>
                                <td>
                              
                                    {{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$investment->status]}}
                              
                               
                                </td>
                                <td>
                                    {{$investment->created_at}} &nbsp;({{ $investment->created_at->diffForHumans()}})
                                </td>
                                <td>
                                
    
                                </td>
                            
    
                            </tr>
                            
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

</div>
@elseif($type==3)
<div class="card">
    <div class="card-header">
  <h3>Reverse Repo</h3>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                           Ref No 
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                          Account Type
                        </th>
                        <th>
                          Type
                        </th>
                        <th>
                         Value & Maturity on
                        </th>
                        <th>
                            Amount
                         </th>
                        <th>
                         Status
                        </th>
                        <th>
                        Requested At
                        </th>
                      
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($reverseRepo)
                    @foreach($reverseRepo as $key => $investment)
                        <tr data-entry-id="{{ $investment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $investment->investment->ref_no ?? 'N/A' }}
                            </td>
                            <td>
                              {{$investment->investment->client->title}} &nbsp; {{ $investment->investment->client->name ?? '' }}
                            </td>
                          
                            <td>
                                {{ Config::get('constants.CLIENT_TYPE')[$investment->client->client_type] }}
                            </td>

                            <td>
                                {{$investment->investment->investmentType->name }}
                            </td>
                            <td>
                                {{$investment->investment->value_date}} to {{$investment->investment->maturity_date}}
                            </td>
                            <td>
                                @if ($investment->investment->invested_amount==0)
                                    
                                @money($investment->investment->amount)
                                @else
                                @money($investment->investment->invested_amount)
                                @endif

                             
                            </td>
                        
                            <td>
                          
                                {{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$investment->status]}}
                          
                           
                            </td>
                            <td>
                                {{$investment->created_at}} &nbsp;({{ $investment->created_at->diffForHumans()}})
                            </td>
                            <td>
                            

                            </td>
                        

                        </tr>
                        
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@elseif ($type==4)
<div class="card">
    <div class="card-header">
  <h3>Bid For Auction</h3>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                         Client
                        </th>
                        <th width="10">
                            Account Type
                        </th>
                        <th>
                          Bids
                        </th>
                        <th>
                         Status
                        </th>
                        <th>
                        Requested At
                        </th>
                      
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($bidsets)
                    @foreach($bidsets as $key => $bidset)
                        <tr data-entry-id="{{ $bidset->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $bidset->client->name }}
                            </td>
                            <td>
                                {{ Config::get('constants.CLIENT_TYPE')[$bidset->client->client_type] }}
                            </td>
                            <td>
                                <table class="table  table-bordered table-compact">
                                    <thead>
                                        <tr>
                                            <td>

                                            </td>
                                            <th>
                                                Investment
                                            </th>
                                            <th>
                                                Amount
                                            </th>
                                            <th>
                                                Rate
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($bidset->bids()->where('status',0)->get() as $key => $bid )


                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$bid->investmentType->name}}</td>
                                            <td>@money($bid->amount)</td>
                                            <td>{{$bid->rate}}%</td>
                                            <td>{{$bid->auction_date}}</td>
                                            <td>{{$bid->value_date}}</td>
                                            <td>{{$bid->maturity_date}}</td>
                                        </tr>  
                                        @empty
                                        No records found
                                        @endforelse
                                       




                                    </tbody>
                                 



                                </table>


                            </td>    
                          
                            <td>
                               
                          
                                {{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$bidset->status]}}
                          
                           
                            </td>
                            <td>
                                {{$bidset->created_at}} &nbsp;({{ $bidset->created_at->diffForHumans()}})
                            </td>
                            <td>
                            

                            </td>
                        

                        </tr>
                        
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<div class="card">
    <div class="card-header">
  <h3>View Request</h3>
    </div>

    <div class="card-body">
        <p>Please Select A Date Range and A Type of Request to view </p>
        </div>
    </div>
</div>
@endif   
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    $("#fromDate").flatpickr({
                        enableTime: false,
                        dateFormat: "Y-m-d",
                        
                    });
            $("#toDate").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                
            });


})

</script>
@endsection