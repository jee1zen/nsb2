@extends('layouts.client')
@section('content')
<div class="col-md-9 content">
  	<div class="panel panel-default">
	<div class="panel-heading">
		<h2>Add Bank Account</h2>
	</div>
	<div class="panel-body">
       
            <form method="POST" action="{{ route('client.bankAccounts.add') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="">Account Type</label>
                    <select name="accountType" class="form-control @error('name') is-invalid @enderror">


                        <option value="">Select Option</option>

                        @if ($client->client_type==1 || $client->client_type==2)
                            <option value="Indivitual">Indivitual</option>
                            <option value="Joint">Joint</option>
                        @else
                        <option value="Bank">Bank</option>
                        <option value="RTGS">RTGS</option>
                        @endif
                       


                    </select>
                </div>
                <div class="form-group">
                    <label for="">Holders Name</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Bank Name</label>
                    <select name="bank_name" id="bank_name" type="text" class="form-control @error('bank_name') is-invalid @enderror">
                        <option value="0">Select Bank</option>
                        @if($banks) 
                         @foreach ($banks as $bank)
                             <option value="{{$bank->name}}">{{$bank->name}}</option>
                         @endforeach
                        @endif 
                    </select>
                    @error('bank_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Branch</label>
                    <select name="branch" id="branch" type="text" class="form-control @error('branch') is-invalid @enderror">
                    </select>    
                    @error('branch')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Account No</label>
                    <input name="account_no" type="text" class="form-control @error('account_no') is-invalid @enderror">
                    @error('account_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

               
                <div class="form-group">
                    <button type="submit" class="btn btn-primary " >Save</button>
                </div>
            </form>
</div>
@endsection
@section('scripts')
	@parent
		<script>

var banks ={!!$banksJson!!}
     
     $(document).on("change", "#bank_name" , function() {
       var selectedBank =$(this).val();
       var thisSelect = $(this);
       console.log(selectedBank);

       $.each(banks, function(key,value) {
           console.log(value.name);
           if(value.name === selectedBank){
               // alert(value.name);
               var newOptions =[];
                var branches = value.branches;
                $.each(branches, function(branchKey,branchValue) {
                  

               //   newOptions["id"] = branchValue.id;
               //   newOptions["name"] = branchValue.name;
                   var options = {"id":branchValue.id,"name":branchValue.name}
                  newOptions.push(options);
                  
                });
                console.log(newOptions);
               var $el =   $('#branch');
               $el.empty(); // remove old options
               $.each(newOptions, function(optionKey,optionValue) {
               $el.append($("<option></option>")
                   .attr("value", optionValue.name).text(optionValue.name));
           });
         }
         
       }); 

     });

     $(document).on("change", "#accountType" , function() {    

var selectedValue=$(this).val();
    if(selectedValue==='RTGS'){
        $('#bank').hide();
        $('#branch').hide();
    
    }else{
        $('#bank').show();
        $('#branch').show();
    
    }


});




		</script>
@endsection
  		