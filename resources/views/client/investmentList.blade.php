@extends('layouts.client')
@section('content')
<div class="col-md-10 content">
  	<div class="panel panel-default">
	<div class="panel-heading">
		<h2>Requested Investments</h2>
	</div>
	<div class="panel-body">
        <div class="form-group mb-12">
            <table class="table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
               <tr>
                <th width="10">
                   
                </th> 
                     <th>
                        Type
                     </th> 
                     <th>
                       Amount
                     </th>
                     <th>
                         Value Date
                     </th>
                     <th>
                         Maturity Date
                     </th>
                    
                     <th>
                         Requested At
                     </th>
                   
    
               </tr>
                </thead>
                <tbody>
               @foreach ($investments as $investment)
                    <tr>
                        <td></td>
                        <td>{{$investment->InvestmentType->name}}</td>
                        <td>@money($investment->amount)</td>
                        <td>{{$investment->value_date}}</td>
                        <td>{{$investment->maturity_date}}</td>
                        <td>{{$investment->created_at}} &nbsp;({{ $investment->created_at->diffForHumans()}})</td>
                    
                    </tr>     
               @endforeach
                </tbody>
            </table>   
        </div>  
    </div>  
          
</div>
</div>
@endsection
@section('scripts')
	@parent
		<script>
            $(function(){
           
                $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
                    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                        $($.fn.dataTable.tables(true)).DataTable()
                            .columns.adjust();
                    });

            });
		</script>
@endsection
  		