@extends('layouts.admin')
@section('content')
@can('team_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
          Inquiries
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Team">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Client
                        </th>
                        <th>
                           Inquiry Type
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inquries as $key => $inquriy)
                        <tr data-entry-id="{{ $inquriy->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $inquriy->user->name ?? '' }}
                            </td>
                            <td>
                                {{ Config::get('constants.INQUIRY_TYPES')[$inquriy->type] ?? '' }}
                            </td>
                            <td>
                                {{ $inquriy->created_at ?? '' }}  &nbsp; {{($inquriy->created_at->diffForHumans()) ?? ''}}
                            </td>
                            <td>
                                @can('inquiry_access')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.inquiries.show', $inquriy->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                             

                             
                            </td>

                        </tr>
                    @endforeach
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
@can('team_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.teams.massDestroy') }}",
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
  $('.datatable-Team:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection