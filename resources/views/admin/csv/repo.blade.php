@extends('layouts.admin')
@section('content')
<div class="container mt-5 text-center">
    <h2 class="mb-4">
       Upload the CSV For Repo
    </h2>

    <form action="{{ route('admin.csv.repo.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
            <div class="custom-file text-left">
                <input type="file" name="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
        <button class="btn btn-primary">Import data</button>
        <a class="btn  btn-danger" href="{{ route('admin.csv.repo.clean') }}">Clear</a>
        <a class="btn btn-success" href="{{ route('admin.csv.repo.sync') }}">Sync data</a>
    
    </form>
</div>
<div class="class="container-fluid mt-8" ">
    <h2 class="mb-4">
     Repo Records Today..
    </h2>
    <div class="form-group mb-12">
        <table class="table table-bordered table-striped table-hover datatable datatable-User">
            <thead>
                <tr>
                        <th width="10"></th> 
                        <th>Deal No</th> 
                        <th>Name</th>
                        <th>Nic</th>
                        <th>value date</th>
                        <th>Mat Date</th>
                        <th>Inv Amount</th>
                        <th>Mat value</th>
                        <th>ISIN</th>
                        <th>Method</th>
                </tr>
            </thead>
            <tbody>
           @foreach ($bankRecords as $bank)
                <tr>
                    <td></td>
                    <td>{{$bank->deal_no}}</td>
                    <td>{{$bank->cus_name}}</td>
                    <td>{{$bank->nic}}</td>
                    <td>{{$bank->value_date}}</td>
                    <td>{{$bank->mat_date}}</td>
                    <td>@money($bank->invested_value)</td>
                    <td>@money($bank->maturity_value)</td>
                    <td>{{$bank->isin}}</td>
                    <td>{{$bank->method}}</td>
                </tr>     
           @endforeach
            </tbody>
        </table>   

        

    </div>   

</div>

<div class="class="container-fluid mt-8" ">
    <h2 class="mb-4">
     Synced Records 
    </h2>
    <div class="form-group mb-12">
        <table class="table table-bordered table-striped table-hover datatable datatable-User">
            <thead>
           <tr>
                <th width="10"></th> 
                <th>Deal No</th> 
                <th>Name</th>
                <th>Nic</th>
                <th>value date</th>
                <th>Mat Date</th>
                <th>Inv Amount</th>
                <th>Mat value</th>
                <th>ISIN</th>
                <th>Method</th>
    
           </tr>
            </thead>
            <tbody>
           @foreach ($clientRecords as $client)
                <tr>
                    <td></td>
                    <td>{{$client->deal_no}}</td>
                    <td>{{$client->cus_name}}</td>
                    <td>{{$client->nic}}</td>
                    <td>{{$client->value_date}}</td>
                    <td>{{$client->mat_date}}</td>
                    <td>@money($client->invested_value)</td>
                    <td>@money($client->maturity_value)</td>
                    <td>{{$client->isin}}</td>
                    <td>{{$client->method}}</td>
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
     $(function () {

        $('#customFile').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            });
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)   

            $.extend(true, $.fn.dataTable.defaults, {
                     order: [[ 1, 'desc' ]],
                         pageLength: 5,
                     });
        $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });


     });
    
  
</script>
@endsection