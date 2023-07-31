@extends('layouts.client')
@section('content')
    <div class="col-md-10 content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Dashboard</h2>
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
                                    Instrument Type
                                </th>
                                <th>
                                    Reference Number
                                </th>
                                <th>
                                    Value Date
                                </th>
                                <th>
                                    Maturity Date
                                </th>
                                <th>
                                    Yield
                                </th>
                                <th>
                                    Investment Amount
                                </th>
                                <th>
                                    Interest
                                </th>
                                <th>
                                    Maturity Amount
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($investments as $key=> $investment)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $investment->InvestmentType->name }}</td>
                                    <td>{{ $investment->ref_no }}</td>
                                    <td>{{ $investment->value_date }}</td>
                                    <td>{{ $investment->maturity_date }}</td>
                                    <td>{{ $investment->yield }}</td>
                                    <td>@money($investment->invested_amount)</td>

                                    <td>@money($investment->matured_amount - $investment->invested_amount)</td>
                                    <td>@money($investment->matured_amount)</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" style="text-align:center"><strong>
                                            Currently No Investments
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
