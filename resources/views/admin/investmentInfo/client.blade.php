@extends('layouts.app')
<style>
    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }

    }

    .customImage {
        display: block;
        max-width: 300px;
        height: auto;
    }
</style>
@section('content')
    <div class="card print-form">
        <div class="card-header">
            <div class="pull-right">
                <img src="{{ asset('storage/images/fmc.jpg') }}" class="rounded-logo" alt="...">
            </div>
            <h4> {{ $client->name }} - Profile</h4>

        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <button class="btn btn-default no-print btnPrint">
                        Print
                    </button>
                </div>
                <h5>Basic Information</h5>
                <table class="table table-bordered  table-hover">
                    <tbody>
                        <tr>
                            <th>
                                Account ID
                            </th>
                            <td>
                                {{ $account->id }}
                            </td>

                        </tr>
                        <tr>
                            <th>
                                Clinet ID
                            </th>
                            <td>
                                {{ $client->id }}
                            </td>

                        </tr>
                        <tr>
                            <th>
                                Client Name With Initials
                            </th>
                            <td>
                                {{ $client->name }}
                            </td>

                        </tr>
                        <tr>
                            <th>
                                Client Full Name
                            </th>
                            <td>
                                {{ $client->name_by_initials }}
                            </td>

                        </tr>
                        <tr>
                            <th>
                                Mobile
                            </th>
                            <td>
                                {{ $client->mobile }}
                            </td>

                        </tr>
                        <tr>
                            <th>
                                Client Email
                            </th>
                            <td>
                                {{ $client->user->email }}
                            </td>

                        </tr>
                        <tr>
                            <th>
                                Residance Address
                            </th>
                            <td>
                                {{ $client->address_line_1 }} <br>
                                {{ $client->address_line_2 }} <br>
                                {{ $client->address_line_3 }} <br>

                            </td>

                        </tr>
                        <tr>
                            <th>
                                Date Of Birth
                            </th>
                            <td>

                                {{ $client->dob }}
                            </td>

                        </tr>
                        <tr>
                            <th>
                                Nationality
                            </th>
                            <td>
                                {{ $client->nationality }}
                            </td>

                        </tr>
                        <tr>
                            <th>
                                National ID
                            </th>
                            <td>
                                {{ $client->nic }}
                            </td>

                        </tr>
                        <tr>
                            <th>
                                Account Type
                            </th>
                            <td>
                                {{ Config::get('constants.CLIENT_TYPE')[$account->type] }}
                            </td>

                        </tr>

                    </tbody>
                </table>




                <table class="table image-table" style="margin: 20px 0">
                    <tr>

                        <td>
                            @if ($client->nic_front != null)
                                <strong> NIC Front</strong>
                                <a href="{{ asset('/storage/uploads/' . $client->nic_front) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $client->nic_front) }}" class="customImage"
                                        alt="nic front">
                                </a>
                            @endif
                        </td>
                        <td>
                            @if ($client->nic_back != null)
                                <strong> NIC Back</strong>
                                <a href="{{ asset('/storage/uploads/' . $client->nic_back) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $client->nic_back) }}" class="customImage"
                                        alt="nic back">
                                </a>
                            @endif
                        </td>
                        <td>
                            @if ($client->passport != null)
                                <strong>Passport</strong>
                                <a href="{{ asset('/storage/uploads/' . $client->passport) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $client->passport) }}" class="customImage"
                                        alt="passport">
                                </a>
                            @endif
                        </td>
                        @if ($client->signature != null)
                            <td>
                                <strong>
                                    Signature
                                </strong>
                                <a href="{{ asset('/storage/uploads/' . $client->signature) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $client->signature) }}" class="customImage"
                                        alt="signature">
                                </a>
                            </td>
                        @endif

                    </tr>




                </table>


                <table class="table table-bordered  table-hover">
                    <tbody>
                        @if ($client->hasAuthorizedPerson())
                            <tr>
                                <th>
                                    Authorized Person
                                </th>
                                <td>
                                    <table>
                                        <tr>
                                            <td>Name</td>
                                            <td>{{ $client->authorizedPerson->name }}</td>

                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>{{ $client->authorizedPerson->address }}</td>

                                        </tr>
                                        <tr>
                                            <td>NIC</td>
                                            <td>{{ $client->authorizedPerson->nic }}</td>

                                        </tr>
                                        <tr>
                                            <td>Telephone</td>
                                            <td>{{ $client->authorizedPerson->telephone }}</td>

                                        </tr>

                                    </table>
                                </td>
                                <td>

                                </td>
                            </tr>
                            <table>
                        @endif
                        @if ($client->hasEmploymenDetails())
                            @php
                                $employmentDetails = $client->employmentDetails;
                            @endphp
                            <h5>Employment Details</h5>
                            <table class="table table-bordered  table-hover">
                                <tr>
                                    <td>Occupation</td>
                                    <td>{{ $employmentDetails->occupation }}</td>

                                </tr>
                                <tr>
                                    <td>Company Name</td>
                                    <td>{{ $employmentDetails->company_name }}</td>

                                </tr>
                                <tr>
                                    <td>Company Address</td>
                                    <td>{{ $employmentDetails->company_address }}</td>

                                </tr>
                                <tr>
                                    <td>Telephone</td>
                                    <td>{{ $employmentDetails->telephone }}</td>

                                </tr>
                                <tr>
                                    <td>Fax</td>
                                    <td>{{ $employmentDetails->fax }}</td>

                                </tr>
                                <tr>
                                    <td>Nature</td>
                                    <td>{{ $employmentDetails->nature }}</td>

                                </tr>
                            </table>
                        @endif
                        @if ($client->has('jointHolders')->find($client->id))
                            <h5>JointHolders</h5>

                            @foreach ($client->jointHolders()->get() as $jointHolder)
                                <table class="table table-bordered  table-hover">
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $jointHolder->name }}</td>

                                    </tr>
                                    <tr>
                                        <td>Name By Initials</td>
                                        <td>{{ $jointHolder->name_by_initials }}</td>

                                    </tr>
                                    <tr>
                                        <td>Date Of Birth</td>
                                        <td>{{ $jointHolder->dob }}</td>

                                    </tr>
                                    <tr>
                                        <td>NIC/Passport</td>
                                        <td>{{ $jointHolder->nic }}</td>

                                    </tr>
                                    <tr>
                                        <td>Nationality</td>
                                        <td>{{ $jointHolder->nationality }}</td>

                                    </tr>
                                    <tr>
                                        <td>Residacne Address</td>
                                        <td>{{ $jointHolder->address_line_1 }} <br>
                                            {{ $jointHolder->address_line_2 }} <br>
                                            {{ $jointHolder->address_line_3 }} <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Telephone</td>
                                        <td>{{ $jointHolder->telephone }}</td>

                                    </tr>
                                    <tr>
                                        <td>Mobile</td>
                                        <td>{{ $jointHolder->mobile }}</td>

                                    </tr>

                                    <table class="table image-table" style="margin: 20px 0">
                                        <tbody>
                                            <tr>
                                                @if ($jointHolder->nic_front != null && $jointHolder->nic_front != 'none')
                                                    <td> <strong> NIC Front</strong> <a
                                                            href="{{ asset('/storage/uploads/' . $jointHolder->nic_front) }}"
                                                            target="_blank">
                                                            <img src="{{ asset('storage/uploads/' . $jointHolder->nic_front) }}"
                                                                class="customImage" alt="Joint Holder NIC">
                                                        </a></td>
                                                @endif
                                                @if ($jointHolder->nic_back != null && $jointHolder->nic_back != 'none')
                                                    <td> <strong> NIC Back</strong> <a
                                                            href="{{ asset('/storage/uploads/' . $jointHolder->nic_back) }}"
                                                            target="_blank">
                                                            <img src="{{ asset('storage/uploads/' . $jointHolder->nic_back) }}"
                                                                class="customImage" alt="Joint Hold NIC BACK">
                                                        </a></td>
                                                @endif
                                                @if ($jointHolder->passport != null && $jointHolder->passport != 'none')
                                                    <td> <strong> Passport</strong><a
                                                            href="{{ asset('/storage/uploads/' . $jointHolder->passport) }}"
                                                            target="_blank">
                                                            <img src="{{ asset('storage/uploads/' . $jointHolder->passport) }}"
                                                                class="customImage" alt="Passport">
                                                        </a></td>
                                                @endif
                                                @if ($jointHolder->signature != null)
                                                    <td> <strong> Signature</strong><a
                                                            href="{{ asset('/storage/uploads/' . $jointHolder->signature) }}"
                                                            target="_blank">
                                                            <img src="{{ asset('storage/uploads/' . $jointHolder->signature) }}"
                                                                class="customImage" alt="Signature">
                                                        </a></td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>

                                    <br>
                            @endforeach
                        @endif
                        @if ($client->has('bankParticulars')->find($client->id))
                            <h5>Bank Particulars</h5>
                            <table class="table table-bordered  table-hover">
                                <tr>
                                    <th>Bank</th>
                                    <th>Account Holder</th>
                                    <th>Branch</th>
                                    <th>Account Type</th>
                                    <th>Account No</th>

                                </tr>
                                @foreach ($client->bankParticulars()->get() as $bankParticulars)
                                    <tr>
                                        <td> {{ $bankParticulars->bank_name }} </td>
                                        <td> {{ $bankParticulars->name }} </td>
                                        <td> {{ $bankParticulars->branch }} </td>
                                        <td> {{ $bankParticulars->Account_type }} </td>
                                        <td> {{ $bankParticulars->account_no }} </td>

                                    </tr>
                                @endforeach
                            </table>
                        @endif
                        @if ($client->hasOtherDetails())
                            @php
                                $otherDetails = $client->otherDetails;
                            @endphp

                            <h5>Other Details</h5>

                            <table class="table table-bordered  table-hover">
                                <tr>
                                    <td>Are you a Director or Staff of NSB Fund Management Company Ltd?</td>
                                    <td>{{ $otherDetails->nsb_staff_fund_management == 1 ? 'Yes' : 'No' }}</td>

                                </tr>
                                <tr>
                                    <td>Are you related to any Director or Staff of NSB Fund Management Company Ltd?</td>
                                    <td>{{ $otherDetails->related_nsb_staff == 1 ? 'Yes' : 'No' }}</td>

                                </tr>
                                <tr>
                                    <td>Are you a Director or Staff of NSB?</td>
                                    <td>{{ $otherDetails->nsb_staff == 1 ? 'Yes' : 'No' }}</td>

                                </tr>

                                <tr>
                                    <td>If “Yes”, please state the Relationship</td>
                                    <td>{{ $otherDetails->staff_relationship }}</td>

                                </tr>
                                <tr>
                                    <td>Are you a Director/Employee of another Primary Dealer/ Holding Company and/or an
                                        associate of the Primary Dealer?</td>
                                    <td>{{ $otherDetails->member_holding_company == 1 ? 'Yes' : 'No' }}</td>

                                </tr>

                                <tr>
                                    <td>If yes, please state the Prior written concern</td>
                                    <td>{{ $otherDetails->member_holding_company_state }}</td>

                                </tr>
                            </table>
                        @endif
                        @if ($client->hasRealTimeNotification())
                            <h5>Real Time Notification</h5>
                            <table class="table table-bordered  table-hover">

                                <tbody>
                                    @if ($client->realTimeNotification->on_email == 1)
                                        <tr>
                                            <th>
                                                ON Email
                                            </th>
                                            <td>
                                                {{ $client->realTimeNotification->email }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($client->realTimeNotification->on_mobile == 1)
                                        <tr>
                                            <th>
                                                ON Mobile
                                            </th>
                                            <td>
                                                {{ $client->realTimeNotification->mobile }}
                                            </td>
                                        </tr>
                                    @endif

                                </tbody>


                            </table>
                            </td>
                            </tr>
                        @endif
                        <tr>
                            <td>
                                @if ($client->hasUploads())
                                    <h5>Uploads</h5>
                                    <table class="table table-bordered  table-hover no-print">

                                        <tbody>
                                            <tr>
                                                <th>
                                                    Videos

                                                </th>
                                                <td>

                                                    @foreach ($client->uploads()->get() as $upload)
                                                        @php
                                                            $info = pathinfo($upload->file_name);
                                                            
                                                        @endphp
                                                        @if ($info['extension'] == 'mp4' || $info['extension'] == 'm4v')
                                                            <video width="320" height="240" controls>
                                                                <source
                                                                    src="{{ asset('/storage/uploads/' . $upload->file_name) }}"
                                                                    type="video/mp4">

                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </tbody>
                                @endif
                            </td>
                        </tr>
                        @if ($client->hasGovDocs())
                            <tr>
                                <th>
                                    Verification from GOV
                                </th>
                                <td>
                                    {{-- <a href="{{asset('/storage/uploads/'.$client->verification_from_GOV)}}" target="_blank"> 
                                 <img src="{{asset('storage/uploads/'.$client->verification_from_GOV)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                             </a> --}}
                                    <table class="table table-bordered  table-hover no-print">

                                        <thead>
                                            <tr>
                                                <td>Document</td>
                                                <td>Uploaded By</td>
                                            </tr>

                                        </thead>
                                        @foreach ($client->govDocs()->get() as $upload)
                                            <tr>
                                                <td>
                                                    <a href="{{ asset('storage/uploads/' . $upload->file_name) }}"
                                                        target="_blank">{{ $upload->title != '' ? $upload->title : $upload->file_name }}</a>
                                                </td>
                                                <td>{{ $upload->officer->name }}</td>

                                            </tr>
                                        @endforeach

                                    </table>


                                </td>

                            </tr>
                        @endif






                        {{-- <tr>
                        
                        <th>
                         Status Progress
                        </th>
                        <td>
                       @if ($client->status == 100)
                        
                       <div class="badge bg-danger text-wrap" style="width: 10rem;">
                           User Declined
                      </div>
                            
                       @else
                          
                            @foreach (Config::get('constants.CLIENT_STATUS') as $key => $client_state)
                              @if ($key > $client->status)
                              <div class="badge bg-secondary text-wrap" style="width: 10rem;">
                                {{$client_state}}
                              </div>
                             
                              @else
                              <div class="badge bg-success text-wrap" style="width: 10rem;">
                                {{$client_state}}
                              </div>
                              @endif
                            @endforeach
                        </td>
                        @endif
                    </tr> --}}
                        <tr>
                            <th>
                                Current Status
                            </th>
                            <td>
                                @if ($client->status == 100)
                                    Declined
                                @else
                                    {{ Config::get('constants.CLIENT_STATUS')[$client->status] }}
                                @endif
                            </td>
                        </tr>


                    </tbody>
                </table>
                <div class="form-group">
                    <button class="btn btn-default no-print btnPrint">
                        Print
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.btnPrint').on('click', function() {
                window.print();
            });


        });
    </script>
@endsection
