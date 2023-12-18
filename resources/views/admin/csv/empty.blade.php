@extends('layouts.admin')
@section('content')
    @php

        $fromDate = $parameters['fromDate'];
        $toDate = $parameters['toDate'];

        // dd($fromDate);

    @endphp

    <div class="loader" id="loader" style="width: 3rem; height: 3rem;" role="status">
        <p> Loading...</p>
    </div>
    <div class="container mt-5 text-center">
        <h2 class="mb-4">
            Empty Email Records
        </h2>

    </div>
    <div class="container-fluid mt-8">
        <h2 class="mb-4">
            Empty Email Records NON-CMS Customers
        </h2>
        <div class="container mt-5 ">
            <div class="col-md-12">
                <div class="row justify-content-center">
                    <form action="{{ route('admin.empty.index') }}" method="GET" enctype="multipart/form-data">
                        @csrf
                        <table class="table table-info table-sm mx-auto">

                            <thead>

                                <tr>
                                    <th>
                                        From Date
                                    </th>
                                    <th>
                                        To Date
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="date" name="fromDate" id="fromDate" value="{{ $fromDate }}"
                                            class="form-control"></td>
                                    <td> <input type="date" name="toDate" id="toDate" value="{{ $toDate }}"
                                            class="form-control"></td>
                                    <td> <button class="btn btn-primary">Search</button> </td>
                                </tr>

                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group mb-12">
            <table class="table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>REF NO</th>
                        <th>Name</th>
                        <th>FMC NO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emptyRecords as $record)
                        <tr>
                            <td></td>
                            <td>{{ $record->ref }}</td>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->cus_id }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {

            var $loading = $('#loader').hide();



            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                order: [
                    [1, 'desc']
                ],
                pageLength: 5,
            });
            $('.datatable-User:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            $(document)
                .ajaxStart(function() {
                    $loading.show();
                })
                .ajaxStop(function() {
                    $loading.hide();
                });


            $("#fromDate").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",

            });
            $("#toDate").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",

            });

        });
    </script>
@endsection
