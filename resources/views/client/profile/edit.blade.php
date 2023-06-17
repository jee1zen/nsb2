@extends('layouts.client')
@section('content')
<div class="col-md-9 content">
  	<div class="panel panel-default">
	<div class="panel-heading" style="background:black;">
		<h2 >Edit Your Profile</h2>
	</div>
	<div class="panel-body" style="background: rgb(155, 144, 125)">
        <div class="card-body">
            <form method="POST" action="{{ route('client.basicInfo.update', [$client->id]) }}" enctype="multipart/form-data">
                <h3>Basic Information</h3>
                
                @csrf
                <div class="form-group">
                    <label class="fieldlabels">Title</label> 
                    <select name="title" id="title" class="form-control">
                        <option value="Mr." {{$client->title=="Mr."? "selected" :""}}>Mr</option>
                        <option value="Mrs." {{$client->title=="Mrs."? "selected" :""}}>Mrs</option>
                        <option value="Miss." {{$client->title=="Miss."? "selected" :""}}>Miss</option>
                        <option value="Rev." {{$client->title=="Rev."? "selected" :""}}>Rev</option>
                        <option value="Dr." {{$client->title=="Dr."? "selected" :""}}>Dr</option>
                    </select>

                </div>

                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $client->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                </div>
                <div class ="form-group" id="signatureDiv">
                    <label class="required" for="signature">Name Change Proof Doc</label> 
                    <br>
                    {{-- <a href="{{asset('/storage/uploads/'.$client->signature)}}" target="_blank"> 
                        <img src="{{asset('storage/uploads/'.$client->signature)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                    </a> --}}
                     
                    <input type="file" id="name_proof_doc" name="name_proof_doc"  class="imgLoad" accept="image/*">
                </div> 
                
                <h4>Residence Address</h4>
                <div class="form-group">
                    <label class= "required" for="residence_address">Address Line 1</label>
                    <input class="form-control {{ $errors->has('address_line_1') ? 'is-invalid' : ''}}"  type="text" name="address_line_1" id="address_line_1" value="{{ old('address_line_1', $client->address_line_1) }}" required>
                    @if ($errors->has('address_line_1'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address_line_1')}}
                        </div>
                        
                    @endif
                </div>
                <div class="form-group">
                    <label class= "required" for="residence_address">Address Line 2</label>
                    <input class="form-control {{ $errors->has('address_line_2') ? 'is-invalid' : ''}}"  type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2', $client->address_line_2) }}" required>
                    @if ($errors->has('address_line_2'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address_line_2')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label class= "required" for="residence_address">Address Line 3</label>
                    <input class="form-control {{ $errors->has('address_line_3') ? 'is-invalid' : ''}}"  type="text" name="address_line_3" id="address_line_3" value="{{ old('address_line_3', $client->address_line_3) }}" required>
                    @if ($errors->has('address_line_3'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address_line_3')}}
                        </div>
                        
                    @endif
                </div>
               
                <h4>Correspondence Address</h4>
                <div class="form-group">
                    <label class= "required" for="residence_address">Address Line 1</label>
                    <input class="form-control {{ $errors->has('correspondence_address_line_1') ? 'is-invalid' : ''}}"  type="text" name="correspondence_address_line_1" id="address_line_2" value="{{ old('address_line_2', $client->correspondence_address_line_2) }}" required>
                    @if ($errors->has('correspondence_address_line_2'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address_line_2')}}
                        </div>
                        
                    @endif
                </div>
                <div class="form-group">
                    <label class= "required" for="residence_address">Address Line 2</label>
                    <input class="form-control {{ $errors->has('correspondence_address_line_2') ? 'is-invalid' : ''}}"  type="text" name="correspondence_address_line_2" id="correspondence_address_line_2" value="{{ old('correspondence_address_line_1', $client->correspondence_address_line_2) }}" required>
                    @if ($errors->has('correspondence_address_line_2'))
                        <div class="invalid-feedback">
                            {{ $errors->first('correspondence_address_line_2')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label class= "required" for="residence_address">Address Line 3</label>
                    <input class="form-control {{ $errors->has('correspondence_address_line_3') ? 'is-invalid' : ''}}"  type="text" name="correspondence_address_line_3" id="correspondence_address_line_3" value="{{ old('correspondence_address_line_3', $client->correspondence_address_line_3) }}" required>
                    @if ($errors->has('correspondence_address_line_3'))
                        <div class="invalid-feedback">
                            {{ $errors->first('correspondence_address_line_3')}}
                        </div>
                        
                    @endif
                </div>

            </div>                    
            <div class="form-group">
                    <label class="required" for="nic">National ID</label>
                    <input class="form-control {{ $errors->has('nic') ? 'is-invalid' : '' }}" type="nic" name="nic" id="nic" value="{{ old('nic', $client->nic) }}" required>
                    @if($errors->has('nic'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nic') }}
                        </div>
                    @endif
                    {{-- <span class="help-block">nic</span> --}}
            </div>

                @if ($client->nic_front!=null)
                <div class ="form-group" id="nicDiv">
                    <label class="required" for="nic_front">NIC Front Image</label> 
                    <br>
                    <a href="{{asset('/storage/uploads/'.$client->nic_front)}}" target="_blank"> 
                        <img src="{{asset('storage/uploads/'.$client->nic_front)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                    </a>
                     
                    <input type="file" id="nic_front" name="nic_front"  class="imgLoad" accept="image/*">
                </div>
                <div class ="form-group" id="nicDiv">
                    <label class="required" for="nic_back">NIC Back Image</label> 
                    <br>
                    <a href="{{asset('/storage/uploads/'.$client->nic_back)}}" target="_blank"> 
                        <img src="{{asset('storage/uploads/'.$client->nic_back)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                    </a>
                     
                    <input type="file" id="nic_back" name="nic_back"  class="imgLoad" accept="image/*">
                </div>
                @endif

                @If($client->passport!=null)
                <div class ="form-group" id="passportDiv">
                    <label class="required" for="passport">Passport</label> 
                    <br>
                    <a href="{{asset('/storage/uploads/'.$client->passport)}}" target="_blank"> 
                        <img src="{{asset('storage/uploads/'.$client->passport)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                    </a>
                     
                    <input type="file" id="passport" name="passport"  class="imgLoad" accept="image/*">
                </div>
                @endif

                {{-- <div class ="form-group" id="signatureDiv">
                    <label class="required" for="signature">Signature</label> 
                    <br>
                    <a href="{{asset('/storage/uploads/'.$client->signature)}}" target="_blank"> 
                        <img src="{{asset('storage/uploads/'.$client->signature)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                    </a>
                     
                    <input type="file" id="signature" name="signature"  class="imgLoad" accept="image/*">
                </div> --}}

            
                {{-- <div class="form-group">
                    <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                </div> --}}
            
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
        <div class="row">
         <h3>Requested Changes</h3>
         @if ($client->hasChangeRequests())
            @foreach ($client->changeRequests() as $key=> $change)
               <table>
                   <head>
                       <tr>
                           <th>Field</th>
                           <th>Current</th>
                           <th>Change</th>
                       </tr>

                   </head>
                   <tbody>
                    @if($client->change->title_status)
                    <tr>
                         <th>Title</th>
                         <td>{{$client->title}}</td>
                         <td>{{$client->change->title}}</td>
                    </tr>
                    @endif
                   
                    <tr>
                     <th></th>
                     <td></td>
                     <td></td>
                    </tr>
                    <tr>
                     <th></th>
                     <td></td>
                     <td></td>
                    </tr>
                    <tr>
                     <th></th>
                     <td></td>
                     <td></td>
                    </tr>
                   </tbody>
              

                  
               </table>

                
            @endforeach

             
         @endif



        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Employment Information</h3>
                    </div>
                    <div class="cart-body">
                        <form method="POST" action="{{ route('client.customer.employmentInfo.update', [$client->id]) }}" enctype="multipart/form-data">
                            
                            @csrf
                            {{-- <input type="hidden" name="id" value="{{(employmentDetails->id)}}"> --}}
                            <div class="form-group">
                                <label class="required" for="occupation">Occupation</label>
                                <input class="form-control {{ $errors->has('occupation') ? 'is-invalid' : '' }}" type="text" name="occupation" id="occupation" value="{{ old('occupation', $employmentDetails->occupation) }}" required>
                                @if($errors->has('occupation'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('occupation') }}
                                    </div>
                                @endif
                                {{-- <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span> --}}
                            </div>
                            <div class="form-group">
                                <label class="required" for="company_name">Company Name</label>
                                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', $employmentDetails->company_name) }}" required>
                                @if($errors->has('company_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="required" for="company_address">Company Address</label>
                                <input class="form-control {{ $errors->has('company_address') ? 'is-invalid' : '' }}" type="text" name="company_address" id="company_address" value="{{ old('company_address', $employmentDetails->company_address) }}" required>
                                @if($errors->has('company_address'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_address') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="required" for="nature">Nature</label>
                                <input class="form-control {{ $errors->has('nature') ? 'is-invalid' : '' }}" type="text" name="nature" id="nature" value="{{ old('nature', $employmentDetails->nature) }}" required>
                                @if($errors->has('nature'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nature') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="required" for="telephone">Telephone</label>
                                <input class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" type="text" name="telephone" id="telephone" value="{{ old('telephone', $employmentDetails->telephone) }}" required>
                                @if($errors->has('telephone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('telephone') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="required" for="fax">Fax</label>
                                <input class="form-control {{ $errors->has('fax') ? 'is-invalid' : '' }}" type="text" name="fax" id="fax" value="{{ old('fax', $employmentDetails->fax) }}" required>
                                @if($errors->has('fax'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('fax') }}
                                    </div>
                                @endif
                            </div>
                           
        
        
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>        
            </div>
        </div>
        

            </div>
            
             </div>
        </div>
    </div>
</div>





@endsection
@section('scripts')
	@parent
		<script>
		</script>
@endsection
  		