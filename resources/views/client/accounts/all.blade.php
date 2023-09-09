@extends('layouts.client')
@section('content')
    <div class="col-md-10 content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{ route('client.newAccountStaging', 0) }}" class="btn btn-danger" style="float:right">Create New
                    Account</a>
                <h2>All Accounts</h2>





            </div>

            @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="panel-body">
                <div class="form-group mb-12">

                    <table class="table table-bordered table-striped table-hover datatable datatable-User">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    Account ID
                                </th>
                                <th>
                                    Account Name
                                </th>
                                <th>
                                    Account Type
                                </th>
                                <th>
                                    Created ON
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Action
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($accounts as $key=> $account)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>#{{ $account->id }}</td>
                                    <td>
                                        {{ $account->client->name }}
                                        @if ($account->type == 2 && $account->hasJointHolders())
                                            @foreach ($account->jointHolders as $joinHolder)
                                                <br> {{ $joinHolder->name }}
                                            @endforeach
                                        @endif

                                    </td>
                                    <td> {{ Config::get('constants.CLIENT_TYPE')[$account->type] }} </td>
                                    <td>{{ $account->created_at }}</td>
                                    <td>
                                        @if ($account->status > 0 && $account->status < 8)
                                            Under Approval Process
                                        @elseif ($account->status == 8)
                                            waiting for first Investment
                                        @elseif ($account->status == 9)
                                            Active
                                        @elseif($account->pre == 1)
                                            Pre Submission
                                        @else
                                            Submitted
                                        @endif

                                    </td>
                                    <td>
                                        @if ($account->status == 9)
                                            <a class="btn btn-warning"
                                                href="{{ route('client.changeAccountStaging', $account->id) }}">Edit</a>
                                        @endif

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" style="text-align:center"><strong>
                                            NO Accounts
                                        </strong></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>


            </div>
        </div>

        {{-- <div class="panel-body">
	<div>
		@foreach ($investmentTypes as $investmentType)

				<button class="btn btn-primary btn-lg">{{$investmentType->name}}</button>

		@endforeach
	</div>
</div> --}}
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            $('.datatable-User:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });
    </script>
@endsection
