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
                        @if ($investments)
                            @foreach ($investments as $key => $investment)
                                <tr data-entry-id="{{ $investment->id }}">
                                    <td>

                                    </td>
                                    <td>
                                        #{{ $investment->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $investment->account->client->title }} &nbsp; {{ $investment->account->client->name ?? '' }}
                                        @if ($investment->account->type == 2 && $investment->account->hasJointHolders())
                                            @foreach ($investment->account->jointHolders()->get() as $jointHolder)
                                                <br> {{ $jointHolder->title }} &nbsp;{{ $jointHolder->name }}
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        {{ Config::get('constants.CLIENT_TYPE')[$investment->account->type] }}
                                    </td>
                                    <td>
                                        {{ $investment->investmentType->short_name }}
                                    </td>
                                    <td>
                                        {{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$investment->status] }}
                                    </td>
                                    <td>
                                        {{ $investment->created_at }}
                                        &nbsp;({{ $investment->created_at->diffForHumans() }})
                                    </td>
                                    <td>
                                        @can('client_approval_access')
                                            @if ($investment->status < 8)
                                                <a class="btn btn-xs btn-primary"
                                                    href="{{ route('admin.newInvestment.show', [$investment->client->id, $investment->id]) }}">
                                                    Proceed
                                                </a>
                                            @endif
                                        @endcan


                                        {{-- @can('user_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $client->user_id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan --}}

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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('user_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.users.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            $('.datatable-User:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    </script>
@endsection
