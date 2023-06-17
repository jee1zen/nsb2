@extends('layouts.admin')
@section('content')

<div class="class="container-fluid mt-8" ">
    <h2 class="mb-4">
      All Bank Records
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
                <th>Ref</th>
    
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
                    <td>{{$bank->ref_investment}}</td>
                </tr>     
           @endforeach
            </tbody>
        </table>   

        

    </div>   

</div>

<div class="class="container-fluid mt-8" ">
    <h2 class="mb-4">
       All Client Records
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