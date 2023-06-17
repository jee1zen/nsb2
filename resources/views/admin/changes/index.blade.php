@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Info Change Requests
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
                         Changes
                        </th>
                        <th>
                           Date
                        </th>
                     
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($changes)
                    @foreach($changes as $key => $change)
                        <tr data-entry-id="{{ $change->id }}">
                            <td># {{ $change->id}}</td>
                            <td>
                                {{$change->client->name}}
                            </td>
                            <td>
                                @if ($change->title_state==1)
                                <span class="badge badge badge-pill badge-warning">Title</span>
                                @endif
                                @if ($change->name_state==1)
                                <span class="badge badge badge-pill badge-warning">Name</span>
                                @endif
                                @if ($change->address_state==1)
                                <span class="badge badge badge-pill badge-warning">Address</span>
                                @endif
                                @if ($change->correspendence_address_state==1)
                                <span class="badge badge badge-pill badge-warning">Address</span>
                                @endif
                                @if ($change->nic_state==1)
                                <span class="badge badge badge-pill badge-warning">NIC</span>
                                @endif
                              
                            </td>
                         
                            <td>
                               {{$change->created_at}} &nbsp;({{ $change->created_at->diffForHumans()}})
                            </td>
                         
                            <td>
                                <a href="{{route('admin.changes.show',$change->id)}}" class="btn btn-primary">proceed</a>
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
