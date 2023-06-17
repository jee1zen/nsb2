@extends('layouts.admin')
@section('content')



<div class="container-fluid mt-8">
    <h2 class="mb-4">
        All Sychned TBILL/TBOND Records
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
            </thead>
            <tbody>
           @foreach ($clientRecords as $client)
            <tr>
                <td></td>
                <td>{{$client->ref_no}}</td>
                <td>{{$client->name}}</td>
                <td>{{$client->nic}}</td>
                <td>{{$client->type}}</td>
                <td>@money($client->invested_amount)</td>
                <td>@money($client->face_value)</td>
                <td>{{$client->value_date}}</td>
                <td>{{$client->maturity_date}}</td>
                <td>{{$client->stock_ref}}</td>
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
                         pageLength: 100,
                     });
        $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });


     });
    
  
</script>
@endsection