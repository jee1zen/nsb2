@extends('layouts.admin')
@section('content')
<div class="container mt-5 text-center">
    <h2 class="mb-4">
       Upload the CSV For Existing Clients
    </h2>
    @if(Session::has('message'))
    <div class="alert alert-success">
        {{Session::get('message')}}
    </div>
    @endif
    @php
    if(isset($parameters)){
     $fromDate = $parameters['fromDate'];
     $toDate   = $parameters['toDate'];
    
    }else{
    
       $fromDate= Carbon\Carbon::now()->format('Y-m-d');
       $toDate =Carbon\Carbon::now()->format('Y-m-d');
     
   

    }
   @endphp


    <form action="{{ route('admin.existing.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
            <div class="custom-file text-left">
                <input type="file" name="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Import data</button>
        {{-- <a class="btn  btn-danger" href="{{ route('admin.csv.clean') }}">Clear</a> --}}
        <button type="button" id="btnEmail" class="btn btn-success">Send Emails</button>
    
    </form>
    <form id="emailForm" action="{{ route('admin.existing.mail') }}" method="POST" enctype="multipart/form-data" >
        @csrf
       
        <input type="hidden" id="fdate" name="fdate" value="">
        <input type="hidden" id="tdate" name="tdate" value="">
    </form>

</div>
<div class="clearfix"></div>
    <div class="container mt-5 text-center">
        <div class="form-group mb-12">
            
           <div class="row">
            <form action="{{ route('admin.existing.filter') }}" method="GET" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered table-info table-sm">
                    
                    <thead>
                        <tr>
                            <th colspan="3">
                                <h3>Filter Records</h3>

                            </th>
                            
                        </tr>
                        <tr>
                            <th>
                                From Date
                            </th>
                            <th>
                               To Date
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="date" name="fromDate" id="fromDate" value="{{$fromDate}}" class="form-control"></td>
                            <td> <input type="date" name="toDate" id="toDate" value="{{$toDate}}" class="form-control"></td>
                            <td> <button class="btn btn-primary">Search</button> </td>
                        </tr>

                    </tbody>
                </table>
            </form>
                

            </div>
        
    </div>     
           
    </div>
    <div class="clearfix"></div>
<div class="class="container-fluid mt-8" ">
    <h2 class="mb-4">
    Existing Clients Records Synced 
    </h2>
    <div class="form-group mb-12">
        <table class="table table-bordered table-striped table-hover datatable datatable-User">
            <thead>
           <tr>
                 <th width="10"></th> 
                 <th>Cus ID</th> 
                 <th>Name</th>
                 <th>Nic</th>
               
                <th>Email</th>
                <th>Mobile</th>
                <th>Synched</th>
    
           </tr>
            </thead>
            <tbody>
           @foreach ($exsitingClients as $client)
                <tr>
                    <td></td>
                    <td>{{$client->cus_id}}</td>
                    <td>{{$client->customer_name}}</td>
                    <td>{{$client->nic}}</td>
                    <td>{{$client->email}}</td>
                    <td>{{$client->mobile}}</td>
                    <td>{{$client->syched}}</td>
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


            $("#fromDate").flatpickr({
                        enableTime: false,
                        dateFormat: "Y-m-d",
                        
                    });
            $("#toDate").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                
            });

            $('#btnEmail').on('click',function(e){
            

                $('#tdate').val($('#toDate').val());
                $('#fdate').val($('#fromDate').val());
                $('#emailForm').submit();

            });

     });
    
  
</script>
@endsection