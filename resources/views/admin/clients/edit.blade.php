@extends('layouts.admin')
@section('content')
<h2>Edit Client</h2>
<div class="row">
  <div class="col">
    <div class="card">
        <div class="card-header">
            <h2>Basic infomation</h2>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.clients.management.basicInfo.update', [$client->id]) }}" enctype="multipart/form-data">
                <h5>Basic Information</h5>
                
                @csrf
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
                {{-- <div class="form-group">
                    <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                </div> --}}
{{-- 
                <div class="form-group">
                    <label class= "required" for="residence_address">Residence Address</label>
                    <input class="form-control {{ $errors->has('residence_address') ? 'is-invalid' : ''}}"  type="text" name="residence_address" id="residence_address" value="{{ old('residence_address', $client->residence_address) }}" required>
                    @if ($errors->has('residence_address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('residence_address')}}
                        </div>
                        
                    @endif
                </div> --}}



                <div class="form-group">
                    <label class="required" for="dob">Date of Birth</label>
                    <input class="form-control {{ $errors->has('dob') ? 'is-invalid' : '' }}" type="text" name="dob" id="dob" value="{{ old('dob', $client->dob) }}" required>
                    @if($errors->has('dob'))
                        <div class="invalid-feedback">
                            {{ $errors->first('dob') }}
                        </div>
                    @endif
                    {{-- <span class="help-block">dob</span> --}}
                </div>

                {{-- <div class="form-group">
                    <label class="required" for="email">Email</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $client->user->email) }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                   
                </div> --}}
                {{-- <div class ="form-group" id="doc">
                    <label class="required" for="verification from GOV">Verification from GOV </label> 
                    <br>
                    @if ($client->verification_from_GOV!='')
                    <a href="{{asset('/storage/uploads/'.$client->verification_from_GOV)}}" target="_blank"> 
                        <img src="{{asset('storage/uploads/'.$client->verification_from_GOV)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                    </a>
                    @endif
                    <input type="file" id="money_laundering_verification" name="verification_from_GOV"  class="imgLoad">
                </div>
                <div class ="form-group" id="doc">
                    <label class="required" for="verification from GOV">Money laundering verification</label> 
                    <br>
                    @if ($client->money_laundering_verification!='')
                    <a href="{{asset('/storage/uploads/'.$client->money_laundering_verification)}}" target="_blank"> 
                        <img src="{{asset('storage/uploads/'.$client->money_laundering_verification)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                    </a>
                    @endif
                    <input type="file" id="money_laundering_verification" name="money_laundering_verification"  class="imgLoad">
                </div> --}}

            
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

                <div class ="form-group" id="signatureDiv">
                    <label class="required" for="signature">Signature</label> 
                    <br>
                    <a href="{{asset('/storage/uploads/'.$client->signature)}}" target="_blank"> 
                        <img src="{{asset('storage/uploads/'.$client->signature)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                    </a>
                     
                    <input type="file" id="signature" name="signature"  class="imgLoad" accept="image/*">
                </div>

            
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
    </div>
</div>

@if ($client->hasGovDocs())
<div class="col">
    <div class="card">
        <div class="card-header">
          Government Verification Documents
         </div>
     <div class="card-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#ID</th>
                <th scope="col">Document</th>
                <th scope="col">Uploaded By</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody>
            @foreach($client->govDocs()->get() as $upload)
              <tr>
                <th scope="row">#{{$upload->id}}</th>
                <td><a href="{{asset('storage/uploads/'.$upload->file_name)}}" target="_blank">{{$upload->title!=""?$upload->title:$upload->file_name}}</a></td>
                <td>{{$upload->officer->name}}</td>
                <td>{{$upload->created_at}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
       </form>
     </div>
    </div>
 </div>
 @endif

</div>
 
    <div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h2>Upload Government Verification Documents</h2>
            </div>
            <div class="cart-body">
                <div class="panel panel-default">
                
                    <div class="panel-body">
                        <br />
                        <form id="videoUploadForm" method="post" action="{{ route('admin.clients.management.gov',$client->id) }}" enctype="multipart/form-data">
                          @csrf
                          <div class="row">
                            <div class="col-md-3" align="right"><h4>Enter Title</h4></div>
                            <div class="col-md-6">
                              <input type="text" name="title" id="title" class="form-control"/>
                              <input type="hidden" name="client_id" value="{{$client->id}}">
                            </div>
                        </div>
                      </div>
                          <div class="row">
                                <div class="col-md-3" align="right"><h4>Select File</h4></div>
                                <div class="col-md-6">
                                  <input type="file" name="file" id="file" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                  <input type="submit" name="upload" value="Upload" class="btn btn-success" />
                                </div>
                            </div>
                        </form>
                        <br />
                        <div class="progress">
                          <div class="progress-bar video-progress-bar" role="progressbar" aria-valuenow=""
                          aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                            0%
                          </div>
                        </div>
                        <br />
                        <div id="successVideo">
                        </div>
                        <br />
                    </div>
                   
                </div>

            </div>
        </div>    
        @if ($client->hasMoneyLaunderingVerifications())
<div class="col">
    <div class="card">
        <div class="card-header">
        Money Laundering Verification Docs
         </div>
     <div class="card-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#ID</th>
                <th scope="col">Document</th>
                <th scope="col">Uploaded By</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody>
            @foreach($client->moneyLaunderingVerifications()->get() as $upload)
              <tr>
                <th scope="row">#{{$upload->id}}</th>
                <td><a href="{{asset('storage/uploads/'.$upload->file_name)}}" target="_blank">{{$upload->title!=""?$upload->title:$upload->file_name}}</a></td>
                <td>{{$upload->officer->name}}</td>
                <td>{{$upload->created_at}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
       </form>
     </div>
    </div>
 </div>
 @endif
        


    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Upload Money laundering verifications</h2>
                </div>
                <div class="cart-body">
                    <div class="panel panel-default">
                    
                        <div class="panel-body">
                            <br />
                            <form id="moneyForm" method="post" action="{{ route('admin.clients.management.money',$client->id) }}" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                <div class="col-md-3" align="right"><h4>Enter Title</h4></div>
                                <div class="col-md-6">
                                  <input type="text" name="title" id="title" class="form-control"/>
                                  <input type="hidden" name="client_id" value="{{$client->id}}">
                                </div>
                            </div>
                          </div>
                              <div class="row">
                                    <div class="col-md-3" align="right"><h4>Select File</h4></div>
                                    <div class="col-md-6">
                                      <input type="file" name="file" id="file" class="form-control" />
                                    </div>
                                    <div class="col-md-3">
                                      <input type="submit" name="upload" value="Upload" class="btn btn-success" />
                                    </div>
                                </div>
                            </form>
                            <br />
                            <div class="progress">
                              <div class="progress-bar money-progress-bar" role="progressbar" aria-valuenow=""
                              aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                0%
                              </div>
                            </div>
                            <br />
                            
                            <div id="successMoney">
                            </div>
                            <br />
                        </div>
                       
                    </div>
    
                </div>
            </div>        
        </div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h2>Employment Information</h2>
            </div>
            <div class="cart-body">
                <form method="POST" action="{{ route('admin.clients.management.employmentInfo.update', [$client->id]) }}" enctype="multipart/form-data">
                    
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

<div class="row">
    <div class="col-md-6">
        <div class="card">
           
            @foreach ( $client->jointHolders()->get() as $jointHolder )
            <div class="card-header">
                <h2>Joint Holder</h2>
            </div>
            <div class="cart-body">
                <form method="POST" action="{{ route('admin.clients.management.jointHolder.update', [$jointHolder->id]) }}" enctype="multipart/form-data">
                    
                    @csrf
                    <div class="form-group">
                        <label class="required" for="name">Name</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $jointHolder->name) }}" required>
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="dob">Date of Birth</label>
                        <input class="form-control {{ $errors->has('dob') ? 'is-invalid' : '' }}" type="text" name="dob" id="dob" value="{{ old('dob', $jointHolder->dob) }}" required>
                        @if($errors->has('dob'))
                            <div class="invalid-feedback">
                                {{ $errors->first('dob') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="nic">NIC</label>
                        <input class="form-control {{ $errors->has('nic') ? 'is-invalid' : '' }}" type="text" name="nic" id="nic" value="{{ old('nic', $jointHolder->nic) }}" required>
                        @if($errors->has('nic'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nic') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span> --}}
                    </div>
                    <div class="form-group">
                        <label class="required" for="email">Email</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $jointHolder->email) }}" required>
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span> --}}
                    </div>
                    <div class="form-group">
                        <label class="required" for="residence_address">Address</label>
                        <input class="form-control {{ $errors->has('residence_address') ? 'is-invalid' : '' }}" type="text" name="residence_address" id="residence_address" value="{{ old('residence_address', $jointHolder->residence_address) }}" required>
                        @if($errors->has('residence_address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('residence_address') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span> --}}
                    </div>
                    <div class="form-group">
                        <label class="required" for="telephone">Telephone</label>
                        <input class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" type="text" name="telephone" id="telephone" value="{{ old('telephone', $jointHolder->telephone) }}" required>
                        @if($errors->has('telephone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('telephone') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span> --}}
                    </div>
                    <div class="form-group">
                        <label class="required" for="mobile">Mobile</label>
                        <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', $jointHolder->mobile) }}" required>
                        @if($errors->has('mobile'))
                            <div class="invalid-feedback">
                                {{ $errors->first('mobile') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span> --}}
                    </div>

                    @if ($jointHolder->nic_front!=null && $jointHolder->nic_front!='none')
                    <div class ="form-group" id="nicDiv">
                        <label class="required" for="nic_front">NIC Front Image</label> 
                        <br>
                        <a href="{{asset('/storage/uploads/'.$jointHolder->nic_front)}}" target="_blank"> 
                            <img src="{{asset('storage/uploads/'.$jointHolder->nic_front)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                        </a>
                        
                        <input type="file" id="joint_nic_front" name="joint_nic_front"  class="imgLoad" accept="image/*">
                    </div>
                    @endif

                    @if ($jointHolder->nic_back!=null && $jointHolder->nic_back!='none')
                    <div class ="form-group" id="nicDiv">
                        <label class="required" for="nic_back">NIC Back Image</label> 
                        <br>
                        <a href="{{asset('/storage/uploads/'.$jointHolder->nic_back)}}" target="_blank"> 
                            <img src="{{asset('storage/uploads/'.$jointHolder->nic_back)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                        </a>
                        
                        <input type="file" id="joint_nic_back" name="joint_nic_back"  class="imgLoad" accept="image/*">
                    </div>
                    @endif

                    @if ($jointHolder->passport!=null && $jointHolder->passport!='none')
                    <div class ="form-group" id="passportDiv">
                        <label class="required" for="passport">Passport</label> 
                        <br>
                        <a href="{{asset('/storage/uploads/'.$jointHolder->passport)}}" target="_blank"> 
                            <img src="{{asset('storage/uploads/'.$jointHolder->passport)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                        </a>
                        
                        <input type="file" id="joint_passport" name="joint_passport"  class="imgLoad" accept="image/*">
                    </div>
                    @endif

                    <div class ="form-group" id="signatureDiv">
                        <label class="required" for="signature">Signature</label> 
                        <br>
                        <a href="{{asset('/storage/uploads/'.$jointHolder->signature)}}" target="_blank"> 
                            <img src="{{asset('storage/uploads/'.$jointHolder->signature)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                        </a>
                        
                        <input type="file" id="joint_signature" name="joint_signature"  class="imgLoad" accept="image/*">
                    </div>

                    
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </form>
            </div>
            <br>
            <br>
            <hr>
            @endforeach
        </div>        
    </div>
</div>







{{-- <div class="card">
    <div class="card-header">
       Upload Client Documents
     </div>
 <div class="card-body">
    <form action="{{ route('admin.clients.management.upload',$client->id)}}" method="post" name="file" files="true" enctype="multipart/form-data"
    class="dropzone"
    id="client_documents">@csrf
   <input class="form-control" type="text" name="title" id="title" placeholder="Add Image Title here..">
   <input type="hidden" name="client_id" id="client_id" value="{{$client->id}}">
</form>
 </div>
</div> --}}

@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
<script>
  $( document ).ready(function() {
      // var myDropzone = new Dropzone("div#client_documents", { url: "/file/post"});
    $('#videoUploadForm').ajaxForm({
          beforeSend:function(){
            $('#successVideo').empty();
          },
          uploadProgress:function(event, position, total, percentComplete)
          {
            $('.video-progress-bar').text(percentComplete + '%');
            $('.video-progress-bar').css('width', percentComplete + '%');
          },
          success:function(data)
          {
            if(data.errors)
            {
              $('.video-progress-bar').text('0%');
              $('.video-progress-bar').css('width', '0%');
              $('#successVideo').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
            }
            if(data.success)
            {
              $('.video-progress-bar').text('Uploaded');
              $('.video-progress-bar').css('width', '100%');
              $('#successVideo').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
               location.reload(); 
            

            }
          }
         
        });

        $('#moneyForm').ajaxForm({
          beforeSend:function(){
         $('#successMoney').empty();
          },
          uploadProgress:function(event, position, total, percentComplete)
          {
            $('.money-progress-bar').text(percentComplete + '%');
            $('.money-progress-bar').css('width', percentComplete + '%');
          },
          success:function(data)
          {
            if(data.errors)
            {
              $('.money-progress-bar').text('0%');
              $('.money-progress-bar').css('width', '0%');
              $('#successMoney').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
            }
            if(data.success)
            {
              $('.video-progress-bar').text('Uploaded');
              $('.video-progress-bar').css('width', '100%');
             $('#successMoney').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
               location.reload(); 
            

            }
          }
         
        });
  
   });

    


</script>



@endsection