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
                if (isset($parameters)) {
                    $fromDate = $parameters['fromDate'];
                    $toDate = $parameters['toDate'];
                } else {
                    $fromDate = Carbon\Carbon::now()->format('Y-m-d');
                    $toDate = Carbon\Carbon::now()->format('Y-m-d');
                }
            @endphp
            <form method="get" action="{{ route('admin.investment.info.filter') }}">
                @csrf
                <div class="row">

                    <div class="col-md-4">
                        <input type="date" name="fromDate" value="{{ $fromDate }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="toDate" value="{{ $toDate }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary">Submit</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3>Investment Information</h3>
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
                                Value Date
                            </th>
                            <th>
                                Mat Date
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Old Ref
                            </th>
                            <th>
                                Action
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
                                        {{ $investment->ref_no ?? 'N/A' }}
                                    </td>
                                    <td>

                                        {{ $investment->client->title ?? '' }} &nbsp; {{ $investment->client->name ?? '' }}
                                        <br>
                                        @if ($investment->client->client_type == 2)
                                            @if ($investment->client->hasJointHolders())
                                                @foreach ($investment->client->jointHolders()->get() as $jointHolder)
                                                    {{ $jointHolder->title }} &nbsp; {{ $jointHolder->name }} (Joint Holder)
                                                    <br>
                                                @endforeach
                                            @endif
                                        @endif



                                    </td>

                                    <td>
                                        {{ isset($investment->client->client_type) ? Config::get('constants.CLIENT_TYPE')[$investment->client->client_type] : '' }}
                                    </td>

                                    <td>
                                        {{ $investment->investmentType->short_name }}
                                    </td>
                                    <td>
                                        {{ $investment->value_date }}
                                    </td>
                                    <td>
                                        {{ $investment->maturity_date }}
                                    </td>
                                    <td>
                                        @if ($investment->invested_amount == 0)
                                            @money($investment->amount)
                                        @else
                                            @money($investment->invested_amount)
                                        @endif


                                    </td>
                                    <td>
                                        @if ($investment->is_main == 0)
                                            @if ($investment->status == 50)
                                                Synced Without Instruction
                                            @else
                                                {{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$investment->status] }}
                                            @endif
                                        @else
                                            {{ Config::get('constants.CLIENT_STATUS')[$investment->status] }}
                                        @endif

                                    </td>
                                    <td>
                                        {{ $investment->ref_investment }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.investment.info.client', $investment->account_id) }}"
                                            target="_blank" class="btn btn-primary btn-sm">Client</a> &nbsp;
                                        <a href="{{ route('admin.investment.info.investment', [$investment->client_id, $investment->id]) }}"
                                            target="_blank"class="btn btn-success btn-sm">Investment</a>&nbsp;
                                        <a href="{{ route('admin.investment.info.kyc', [$investment->account_id, $investment->id]) }}"
                                            target="_blank" class="btn btn-warning btn-sm">KYC</a>
                                        <a href="{{ route('admin.clients.dashboard', $investment->account_id) }}"
                                            target="_blank" class="btn btn-xs btn-info">DBoard</a>
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
