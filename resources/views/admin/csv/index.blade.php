@extends('layouts.admin')
@section('content')
    <div class="loader" id="loader" style="width: 3rem; height: 3rem;" role="status">
        <p> Loading...</p>
    </div>
    <div class="container mt-5 text-center">
        <h2 class="mb-4">
            Upload the CSV For TBill/TBond
        </h2>
        <form id="importForm" action="{{ route('admin.csv.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <button class="btn btn-primary">Import data</button>
            <button id="btnClear" class="btn  btn-danger" href="{{ route('admin.csv.clean') }}">Clear</button>
            <button id="btnSync" class="btn btn-success" href="{{ route('admin.csv.sync') }}">Sync data</button>
        </form>
    </div>
    <div class="container-fluid mt-8">
        <h2 class="mb-4">
            TBill/TBond Records Today..
        </h2>
        <div class="form-group mb-12">
            <table class="table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>REF NO</th>
                        <th>Name</th>
                        <th>Nic</th>
                        <th>Type</th>
                        <th>Inv Amount</th>
                        <th>Mat amount</th>
                        <th>Val Date</th>
                        <th>Mat Date</th>
                        <th>Stock Ref</th>
                        <th>Method</th>
                        <th>Ref Invest</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bankRecords as $bank)
                        <tr>
                            <td></td>
                            <td>{{ $bank->ref_no }}</td>
                            <td>{{ $bank->name }}</td>
                            <td>{{ $bank->nic }}</td>
                            <td>{{ $bank->type }}</td>
                            <td>@money($bank->invested_amount)</td>
                            <td>@money($bank->face_value)</td>
                            <td>{{ $bank->value_date }}</td>
                            <td>{{ $bank->maturity_date }}</td>
                            <td>{{ $bank->stock_ref }}</td>
                            <td>{{ $bank->method }}</td>
                            <td>{{ $bank->ref_investment }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="container-fluid mt-8">
        <h2 class="mb-4">
            Synced Records
        </h2>
        <div class="form-group mb-12">
            <table class="table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>REF NO</th>
                        <th>Name</th>
                        <th>Nic</th>
                        <th>Type</th>
                        <th>Inv Amount</th>
                        <th>Mat amount</th>
                        <th>Val Date</th>
                        <th>Mat Date</th>
                        <th>Stock Ref</th>
                        <th>Method</th>
                        <th>Ref</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientRecords as $client)
                        <tr>
                            <td></td>
                            <td>{{ $client->ref_no }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->nic }}</td>
                            <td>{{ $client->type == 1 ? 'TBIll' : 'TBOND' }}</td>
                            <td>@money($client->invested_amount)</td>
                            <td>@money($client->face_value)</td>
                            <td>{{ $client->value_date }}</td>
                            <td>{{ $client->maturity_date }}</td>
                            <td>{{ $client->stock_ref }}</td>
                            <td>{{ $client->method }}</td>
                            <td>{{ $client->ref_investment }}</td>

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


            $('#customFile').on('change', function() {
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            });
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

            $('#importForm').submit(function(e) {
                e.preventDefault();

                if ($('#customFile').val() == '') {
                    Swal.fire({
                        html: "CSV file is not selected ,Please Select The CSV File",
                        icon: "error",
                        title: "Error",
                    });
                    return;
                }

                var formData = new FormData(this);
                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: " {{ route('admin.csv.import') }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {
                        window.location.reload();
                        console.log('File uploaded successfully!', response);
                    },
                    error: function(xhr) {
                        console.log(xhr);
                        if(xhr.status==422){
                            let errorData = xhr.responseJSON;
                            Swal.fire({
                                html:  errorData.errors.map(error => `<p>${error[0]}</p>`).join(''),
                                icon: "error",
                                title: "Error",
                            });
                        }else{

                            let errorData = xhr.responseJSON;

                          Swal.fire({
                                html:  errorData.message,
                                icon: "error",
                                title: "Error",
                            });

                        }
                      

                    }
                });

            });

            $('#btnClear').click(function(e) {
                e.preventDefault();
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: " {{ route('admin.csv.clean') }}",
                    method: 'get',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {

                        window.location.reload();


                        console.log('File uploaded successfully!', response);
                    },
                    error: function(error) {
                        Swal.fire({
                            html: "Error Occured!",
                            icon: "error",
                            title: "Error",

                        });
                    }
                });
            })

            $('#btnSync').click(function(e) {
                e.preventDefault();
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: " {{ route('admin.csv.sync') }}",
                    method: 'get',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {

                        Swal.fire(
                            "Synced with Investments, Relevant Confirmations Generated and Emailed Successfully!",
                            function() {
                                window.location.reload();
                            }
                        );

                    },
                    error: function(xhr) {
                        Swal.fire({
                            html: xhr.responseJSON.message,
                            icon: "error",
                            title: "Error",

                        });

                    }
                });
            })
        });
    </script>
@endsection
