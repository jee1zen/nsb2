@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Live OTP Viewing
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Team">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                Phone Or Email
                            </th>
                            <th>
                                Action
                            </th>
                            <th>
                                OTP
                            </th>
                            <th>
                                Expired
                            </th>
                            <th>
                                Times Attempted
                            </th>
                            <th>
                                Generated AT
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($otps as $key => $otp)
                            <tr data-entry-id="{{ $otp->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $otp->identifier ?? '' }}
                                </td>
                                <td>
                                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                                        data-target="#collapseExample-{{ $otp->id }}" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        View
                                    </button>

                                </td>
                                <td>
                                    <div class="collapse" id="collapseExample-{{ $otp->id }}">

                                        <div
                                            class="d-inline p-2 {{ $otp->expired ? 'bg-danger' : 'bg-success' }}  font-weight-bold">
                                            {{ $otp->token }}</div>
                                    </div>
                                </td>
                                <td>
                                    {{ $otp->expired == 1 ? 'Yes' : 'NO' }}
                                </td>
                                <td>
                                    {{ $otp->no_times_attempted }}
                                </td>
                                <td>
                                    {{ $otp->generated_at }}
                                </td>
                                <td>
                                    {{-- @can('team_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.teams.show', $team->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('team_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.teams.edit', $team->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('team_delete')
                                        <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan --}}

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="btn btn-primary btn-lg" type="button" id="btnRefresh">
                    Refresh Page
                </button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {

            $('#btnRefresh').click(function() {
                location.reload();

            });
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            // @can('team_delete')
            //     let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            //     let deleteButton = {
            //         text: deleteButtonTrans,
            //         url: "{{ route('admin.teams.massDestroy') }}",
            //         className: 'btn-danger',
            //         action: function(e, dt, node, config) {
            //             var ids = $.map(dt.rows({
            //                 selected: true
            //             }).nodes(), function(entry) {
            //                 return $(entry).data('entry-id')
            //             });

            //             if (ids.length === 0) {
            //                 alert('{{ trans('global.datatables.zero_selected') }}')

            //                 return
            //             }

            //             if (confirm('{{ trans('global.areYouSure') }}')) {
            //                 $.ajax({
            //                         headers: {
            //                             'x-csrf-token': _token
            //                         },
            //                         method: 'POST',
            //                         url: config.url,
            //                         data: {
            //                             ids: ids,
            //                             _method: 'DELETE'
            //                         }
            //                     })
            //                     .done(function() {
            //                         location.reload()
            //                     })
            //             }
            //         }
            //     }
            //     dtButtons.push(deleteButton)
            // @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            $('.datatable-Team:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    </script>
@endsection
