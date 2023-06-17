@extends('layouts.app')

@section('content')
<style type="text/css" media="screen">
    .steps-registration .card{
        padding: 20px;
    }
    </style>
    <div class="d-flex justify-content-center">
      <div class="col-md-10">
        <div class="text-center">
            <img src="{{asset('storage/images/fmc.jpg')}}" class="rounded-logo" alt="...">
          </div>
          <div class="form-card">
            <div class="row">
                <div class="col-10">
                    <h2 class="fs-title">Reasons For Rejection</h2>
                </div>
               
            </div> 
            <div class="row">
              <div class="col-md-10">
                {!!$process->comment!!}



              </div>
              
                  
             

            </div>

              
          </div>
      </div>
    </div> 



@endsection