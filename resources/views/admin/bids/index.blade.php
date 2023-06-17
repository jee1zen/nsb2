@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
          Bids for Auction
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Transaction">
                <thead>
                    <tr>
                         <th>
                             
                         </th>
                        <th>
                            Client
                        </th>
                        <th>
                          Bids Count
                        </th>
                        <th>
                           Date
                        </th>
                        <th>
                           Status
                        </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($bids)
                    @foreach($bids as $key => $bid)
                        <tr data-entry-id="{{ $bid->id }}">
                            <td># {{ $bid->id}}</td>
                            <td>
                                {{ $bid->client->name}}
                            </td>
                            <td>
                              {{ $bid->bids()->where('status',0)->get()->count()}}
                            </td>
                          
                            <td>
                               {{$bid->created_at}} &nbsp;({{ $bid->created_at->diffForHumans()}})
                            </td>
                            <td>
                                {{Config::get('constants.WITHDRAW_REQUEST_STATUS')[$bid->status]}}
                            </td>
                            <td>
                                <a href="{{route('admin.bids.show',$bid->id)}}" class="btn btn-primary">proceed</a>
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

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 0, 'desc' ]],
    pageLength: 100,
      columnDefs: [{
          orderable: true,
          className: '',
          targets: 0
      }]
  });
  $('.datatable-Transaction:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
