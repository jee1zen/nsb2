@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mx-4">
            <div class="card-body p-4">
                <div class="text-center">
                    <img src="{{asset('storage/images/fmc.jpg')}}" class="rounded-logo" alt="...">
                  </div>
                <h1> Thank You  {{$client->name}} For Registering With NSB FMC</h1>

                @if(session('message'))
                    <div class="alert alert-info" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <p>
                    You have successfully registered to NSB Fund Management System. 
                     NSB FMC Team will verify your information and contact you For Futher Processors
                </p>
                
                @if (!$client->hasKyc() && $client->client_type!=3)

                 <div style="margin-bottom:10px;">
                    <a class="btn btn-primary" href="{{route('client.kyc.client',$client->mainInvestmentStateWithInvestmentType())}}"> Fill {{$client->name}} 's KYC FORM</a> <br>
                 </div>
                 

                 @else
                        @if ($client->client_type!=3)
                        <p>You have Filled The KYC form for {{$client->name}}</p>
                        @endif
                        <form id="logoutform" action="{{ route('logout') }}" method="POST">
                            <button class="btn btn-primary">Leave This Page</button>
                            {{ csrf_field() }}
            {{-- <p>Your Password has been sent to your email, once your investment is fully approved by NSB FMC team</p> --}}
            </form>
                           
                    
                @endif

                {{-- @if ($client->client_type==2 && $client->joint_permission==1 && $client->hasJointHolders())

                   @foreach ($client->jointHolders()->get() as $jointholder )
                   <div style="margin-bottom:10px;">
                  
                     @if(!$jointholder->hasKycWithType($client->investments()->first()->investment_type_id))
                     <a class="btn btn-primary" href="{{route('client.kyc.joint',[$jointholder->id,$client->mainInvestmentStateWithInvestmentType()])}}"> Fill {{$jointholder->name}} 's KYC FORM</a>
                     @else

                     <p>You have Filled The KYC form for {{$jointholder->name}}</p>
                     @endif
                 
                   </div>
                   @endforeach
                  @endif --}}

                    <div style="margin-bottom:10px;">   
                    @if($client->client_type==3 && !$client->company->hasKycWithType($client->investments()->first()->investment_type_id))
                    <a class="btn btn-primary" href="{{route('client.kyc.company',[$client->id,$client->mainInvestmentStateWithInvestmentType()])}}"> Fill   - {{$client->company->name}} 's KYC FORM</a>
                    @else
                        @if($client->client_type==3)
                        <p>You have Filled The KYC form for {{$client->company->name}}</p>
                        @endif
                    @endif
                    </div>

                
                {{-- @if ($client->client_type==3 && $client->hasCompanySignatures())
                
                   @foreach ($client->companySignatures()->get() as $signature)
                   <div style="margin-bottom:10px;">
                    @if (!$signature->hasKyc())
                    <a class="btn btn-primary" href="{{route('client.kyc.signature',$signature->id)}}"> Fill Signature {{$signature->type}} - {{$signature->name}} 's KYC FORM</a>
                    @else
                    <p>You have Filled The KYC form for {{$signature->name}}</p>
                 
                    @endif
                   </div>
                   @endforeach
                @endif --}}



                {{-- @if($client->mainInvestment()->kyc == 1)
                <form id="logoutform" action="{{ route('logout') }}" method="POST">
								<button class="btn btn-primary">Go to  Your Dashboard </button>
								{{ csrf_field() }}
                <p>Your Password has been sent to your email, Login and change password for your preference</p>
				</form>
                @endif --}}

              
            </div>
        </div>
    </div>
</div>


@endsection