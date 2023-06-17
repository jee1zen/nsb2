@extends('layouts.admin')
@section('content')
<h2>User Guide</h2>
<div class="row">
  <div class="col">
    <div class="card">
        <div class="card-header">
            <h2>Upload User Guide</h2>
         </div>
            <div class="card-body">

                <form method="POST" action="{{ route('admin.userGuide.post') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="nic">User Guide</label>
                                <input class="form-control {{ $errors->has('doc1') ? 'is-invalid' : '' }}" type="file" name="doc" id="doc" >
                                @if($errors->has('doc'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('doc') }}
                                    </div>
                                @endif
        
        
                                {{-- <span class="help-block">nic</span> --}}
                            </div>

                        </div>
                        <div class="col-md-6">
                           
                            @if ($userGuide->doc!='')

                            <a href="{{asset('/storage/uploads/'.$userGuide->doc)}}" target="_blank"> User Guide </a>
                                
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