@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Withdraw Requests
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Transaction">
                    <thead>
                        <tr>
                            <th>
                                Ref No
                            </th>
                            <th>
                                Type
                            </th>
                            <th>
                                Client
                            </th>
                            <th>
                                Instruction
                            </th>
                            <th>
                                Invested
                            </th>
                            <th>
                                Maturity
                            </th>
                            <th>
                                Maturity Date
                            </th>
                            <th>
                                Status
                            </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($withdraws)
                            @foreach ($withdraws as $key => $withdraw)
                                <tr data-entry-id="{{ $withdraw->id }}">
                                    <td>{{ $withdraw->investment->ref_no ?? '' }}</td>
                                    <td>{{ $withdraw->investment->InvestmentType->short_name ?? '' }}</td>
                                    <td>
                                        {{ $withdraw->client->name }}
                                    </td>
                                    <td>{{ Config::get('constants.REQUEST_TYPES')[$withdraw->request_type] }}</td>
                                    <td>
                                        @money($withdraw->investment->invested_amount ?? 0)
                                    </td>
                                    <td>
                                        @money($withdraw->investment->matured_amount ?? 0)
                                    </td>
                                    <td>
                                        {{ $withdraw->investment->maturity_date ?? '' }}
                                    </td>
                                    <td>
                                        {{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$withdraw->status] }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.withdraw.show', $withdraw->id) }}"
                                            class="btn btn-primary">proceed</a>
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

            $.extend(true, $.fn.dataTable.defaults, {
                order: [
                    [0, 'desc']
                ],
                pageLength: 100,
                columnDefs: [{
                    orderable: true,
                    className: '',
                    targets: 0
                }]
            });
            $('.datatable-Transaction:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    </script>
@endsection
