@extends('layouts.admin')
@section('content')
    @can('user_create')
        <div style="margin-bottom: 10px;" class="row">
            <!-- <div class="col-lg-12">
                                                                                    {{-- <a class="btn btn-success" href="{{ route("admin.users.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a> --}}
                                                                                </div> -->
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            All Applicants
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                            <th>

                            </th>
                            <th>
                                NIC
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Mobile
                            </th>
                            <th>
                                Type
                            </th>
                            {{-- <th>
                           Verification Stage
                         </th> --}}
                            <th>
                                Date
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($accounts != '')
                            @foreach ($accounts as $key => $account)
                                <tr data-entry-id="{{ $account->id }}">
                                    <td>

                                    </td>
                                    <td>
                                        {{ $account->client->nic ?? '' }}
                                    </td>
                                    <td>
                                        {{ $account->client->title ?? '' }} {{ $account->client->name ?? '' }} <br>
                                        @if ($account->hasJointHolders())
                                            @foreach ($account->jointHolders()->get() as $jointHolder)
                                                {{ $jointHolder->title }}{{ $jointHolder->name }} (JointHolder)
                                                @if ($jointHolder->hasKycByInvestmentId(0))
                                                    <label class="badge kyc-badge badge-success">KYC</label>
                                                @else
                                                    <label class="badge kyc-badge badge-warning">No KYC</label>
                                                @endif
                                                <br>
                                            @endforeach
                                        @endif

                                    </td>
                                    <td>
                                        {{ $account->client->user->email ?? '' }}

                                    </td>
                                    <td>
                                        {{ $account->client->mobile ?? '' }}

                                    </td>
                                    <td>
                                        {{ Config::get('constants.CLIENT_TYPE')[$account->type] }}
                                    </td>
                                    {{-- <td>
                              @if ($client->verify_type == 0)
                              {{Config::get('constants.CLIENT_STATUS_PHY')[$client->status]}}
                              @else
                              {{ Config::get('constants.CLIENT_STATUS')[$client->status]}}
                              @endif  
                             
                            </td> --}}
                                    <td>
                                        {{ $account->created_at->todatestring() }}
                                    </td>
                                    <td>

                                        @can('client_approval_access')
                                            @if ($account->client->officer_id == null && ($officer_role->id == 5 || $officer_role->id == 6) && $account->status == 0)
                                                <a class="btn btn-xs btn-primary"
                                                    href="{{ route('admin.clients.management.pick', $account->id) }}">
                                                    Take This client
                                                </a>
                                            @endif
                                            @if ($account->status < 2)
                                                <a class="btn btn-xs btn-primary"
                                                    href="{{ route('admin.clients.management.edit', $account->id) }}">
                                                    Edit
                                                </a>
                                            @endif

                                            <a class="btn btn-xs btn-primary" target="_blank"
                                                href="{{ route('admin.investment.info.client', $account->id) }}">Profile</a>
                                            &nbsp;
                                            <a href="{{ route('admin.investment.info.kyc', [$account->id, 0]) }}"
                                                target="_blank" class="btn btn-xs btn-warning">KYC</a>
                                            <a href="{{ route('admin.clients.dashboard', $account->id) }}" target="_blank"
                                                class="btn btn-xs btn-info">DBoard</a>
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
                    [7, 'desc']
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
