@extends('layouts.admin')
@section('content')
<h2>Bid For Auction</h2>
<div class="row">
  <div class="col">
    <div class="card">
        <div class="card-header">
            <h2>Upload Documents</h2>
         </div>
            <div class="card-body">

                <form method="POST" action="{{ route('admin.bid.post') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="nic">Document 1</label>
                                <input class="form-control {{ $errors->has('doc1') ? 'is-invalid' : '' }}" type="file" name="doc1" id="doc1" >
                                @if($errors->has('doc1'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('doc1') }}
                                    </div>
                                @endif
        
        
                                {{-- <span class="help-block">nic</span> --}}
                            </div>

                        </div>
                        <div class="col-md-6">
                           
                            @if ($bid->doc1!='')

                            <a href="{{asset('/storage/uploads/'.$bid->doc1)}}" target="_blank"> Bid For Auction Document 1 </a>
                                
                            @else
                                
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="nic">Document 2</label>
                                <input class="form-control {{ $errors->has('doc2') ? 'is-invalid' : '' }}" type="file" name="doc2" id="doc2" >
                                @if($errors->has('doc2'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('doc2') }}
                                    </div>
                                @endif
        
                                
                                {{-- <span class="help-block">nic</span> --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if ($bid->doc2!='')

                            <a href="{{asset('/storage/uploads/'.$bid->doc2)}}" target="_blank"> Bid For Auction Document 2 </a>
                                
                            @else
                                
                            @endif

                        </div>


                    </div>
                  
                 
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>

        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
<script>
  $( document ).ready(function() {
      // var myDropzone = new Dropzone("div#client_documents", { url: "/file/post"});
  
   });

    


</script>



@endsection