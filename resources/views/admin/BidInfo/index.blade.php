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
        
        
        }else{
        
            $fromDate= Carbon\Carbon::now()->format('Y-m-d');
            $toDate =Carbon\Carbon::now()->format('Y-m-d');
       
       

        }
       @endphp
         <form method="GET" action="">
             @csrf
       <div class="row">
         
           <div class="col-md-3">
            <input type="date" name="fromDate"id="fromDate" value="{{$fromDate}}" class="form-control">
           </div>
           <div class="col-md-3">
            <input type="date" name="toDate" id="toDate" value="{{$toDate}}" class="form-control">
            </div>
            <div class="col-md-3">
               <button class="btn btn-primary">Submit</button>
            </div>
        
       </div>
    </form>
        
    </div>
</div>




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
                                                rate
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
                                <a href="{{route('admin.bid.application',$bidset->id)}}" target="_blank" class="btn btn-primary">View</a>

                            </td>
                        

                        </tr>
                        
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>  
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