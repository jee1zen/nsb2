@extends('layouts.admin')
@section('content')
<div class="container mt-5 text-center">
    <h2 class="mb-4">
       Upload the CSV For TBill/TBond
    </h2>

    <form action="{{ route('admin.csv.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
            <div class="custom-file text-left">
                <input type="file" name="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
        <button class="btn btn-primary">Import data</button>
        <a class="btn  btn-danger" href="{{ route('admin.csv.clean') }}">Clear</a>
        <a class="btn btn-success" href="{{ route('admin.csv.sync') }}">Sync data</a>
    
    </form>
</div>
<div class="class="container-fluid mt-8" ">
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
                    <td>{{$bank->ref_no}}</td>
                    <td>{{$bank->name}}</td>
                    <td>{{$bank->nic}}</td>
                    <td>{{$bank->type}}</td>
                    <td>@money($bank->invested_amount)</td>
                    <td>@money($bank->face_value)</td>
                    <td>{{$bank->value_date}}</td>
                    <td>{{$bank->maturity_date}}</td>
                    <td>{{$bank->stock_ref}}</td>
                    <td>{{$bank->method}}</td>
                    <td>{{$bank->ref_investment}}</td>
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
                    <td>{{$client->ref_no}}</td>
                    <td>{{$client->name}}</td>
                    <td>{{$client->nic}}</td>
                    <td>{{$client->type==1?"TBIll":"TBOND"}}</td>
                    <td>@money($client->invested_amount)</td>
                    <td>@money($client->face_value)</td>
                    <td>{{$client->value_date}}</td>
                    <td>{{$client->maturity_date}}</td>
                    <td>{{$client->stock_ref}}</td>
                    <td>{{$client->method}}</td>
                    <td>{{$client->ref_investment}}</td>
                 
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