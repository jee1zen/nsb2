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
    <div class="card-header">
      New Invetment Approval Process
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            CientID
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
                          Verification Stage
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
                    @if($investments)
                    @foreach($investments as $key => $investment)
                        <tr data-entry-id="{{ $investment->id }}">
                            <td>

                            </td>
                            <td>
                                #{{ $investment->id ?? '' }}
                            </td>
                            <td>
                              {{$investment->client->title}} &nbsp; {{ $investment->client->name ?? '' }}
                            </td>
                            <td>
                                {{ Config::get('constants.CLIENT_TYPE')[$investment->client->client_type] }}
                            </td>
                            <td>
                                {{ $investment->investmentType->short_name }}
                            </td>
                            <td>
                              {{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$investment->status]}}
                            </td>
                            <td>
                                {{$investment->created_at}} &nbsp;({{ $investment->created_at->diffForHumans()}})
                            </td>
                            <td>
                                @can('client_approval_access')
                                
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.stepControlling.investment.view',[$investment->client->id,$investment->id]) }}">
                                        Change Steps
                                     </a>
                                  
                               

                                @endcan
                                

                              
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
})

</script>
@endsection