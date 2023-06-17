@extends('layouts.client')
@section('content')
<div class="col-md-9 content">
  	<div class="panel panel-default">
	<div class="panel-heading">
        <a href="{{route('client.bankAccounts.add')}}" class="btn btn-primary" style="float:right">Add Bank Account</a>
		<h2>Bank Particulars</h2>
       
	</div>
	<div class="panel-body">
        <table class="table table-stripped">
          <thead>  
            <tr class="bank-row" >
                <td>
                    Type
                </td>   
                <td>
                    Holder
                </td>    
                <td>
                    Bank
                </td>
                <td>
                   Branch
                </td>   
                <td>
                   Account NO
                </td>     
              
            </tr>   
            </thead>
            <tbody>
                @foreach ($bankAccounts as $bankAccount)
                <tr>
                    <td>{{$bankAccount->Account_type}}</td>
                    <td>{{$bankAccount->name}}</td>
                    <td>{{$bankAccount->bank_name}}</td>
                    <td>{{$bankAccount->branch}}</td>
                    <td>{{$bankAccount->account_no}}</td>
            
                </tr>
                    
                @endforeach
                
            </tbody>    



        </table>   

      
	</div>
	
    </div>
</div>
@endsection
@section('scripts')
	@parent
		<script>
		</script>
@endsection
  		