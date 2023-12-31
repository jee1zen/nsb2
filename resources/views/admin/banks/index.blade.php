@extends('layouts.admin')
@section('content')
@can('client_management_access')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.banks.create") }}">
               Create Bank
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
     Banks
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                           Bank ID
                        </th>
                        <th>
                           Bank Name
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($banks)
                    @foreach($banks as $key => $bank)
                        <tr data-entry-id="{{ $bank->id }}">
                            <td>

                            </td>
                            <td>
                                #{{ $bank->id ?? '' }}
                            </td>
                            <td>
                                {{$bank->name}}
                            </td>
                            <td>
                             
                                

                                @can('client_management_access')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.banks.edit', $bank->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('client_management_access')
                                <a class="btn btn-xs btn-info" href="{{ route('admin.banks.branches', $bank->id) }}">
                                   Add Branches 
                                </a>
                                @endcan


                                {{-- @can('user_delete')
                                    <form action="{{ route('admin.users.destroy', $client->user_id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan --}}

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