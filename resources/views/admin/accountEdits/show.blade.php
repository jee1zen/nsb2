@extends('layouts.admin')
@section('content')
    <style>
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }
        }

        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: always
        }

        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
        }
    </style>
    <div class="card">
        <div class="card-header">
            <h1> {{ $client->name }} - Info for Approval - Risk Rate - {{ $kyc_rating['totalRiskRate'] ?? 'Unrated' }} -
                <span class="badge badge-{{ $kyc_rating['rateColor'] ?? '' }}">{{ $kyc_rating['rateLabel'] ?? '' }}</span>
            </h1>
        </div>


        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default no-print" href="{{ route('admin.clients.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <ul class="nav nav-pills">
                    <li class="active">
                        <a href="#1a" data-toggle="tab" class="no-print">Client Info</a>
                    </li>
                    <li><a href="#2a" data-toggle="tab" class="no-print">KYC Info</a>

                    </li>
                </ul>
                <div class="tab-content clearfix">
                    <div class="tab-pane active" id="1a">
                        <table class="table table-bordered  table-hover">
                            <tbody>
                                <tr>
                                    <th>
                                        Account ID

                                    </th>
                                    <td>
                                        {{ $account->id }}
                                    </td>
                                    <td>

                                        <b>Changes Requested</b>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Clinet ID

                                    </th>
                                    <td>
                                        {{ $client->id }}
                                    </td>
                                    <td> &nbsp;</td>
                                </tr>
                                <tr>
                                    <th>
                                        Client Name With Initials
                                    </th>
                                    <td>
                                        {{ $client->name }}
                                    </td>
                                    <td>
                                        {{ $clientChange->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Client Full Name
                                    </th>
                                    <td>
                                        {{ $client->name_by_initials }}
                                    </td>
                                    <td>
                                        {{ $clientChange->name_by_initials }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Client Email
                                    </th>
                                    <td>
                                        {{ $client->user->email }}
                                    </td>
                                    <td>
                                        {{-- <input type="checkbox" class="checkBoxVerify" {{$client->name_verify==0?"":'checked'}} {{$account->status > 2 ?"disabled":""}} />
                                <input type="hidden" value="{{base64_encode(serialize(array("clients","name_verify",$client->name_verify,$client->id)))}}">
                                <label for="checkbox"></label>    --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Mobile
                                    </th>
                                    <td>
                                        {{ $client->mobile }}
                                    </td>
                                    <td>
                                        {{ $clientChange->mobile }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Telephone
                                    </th>
                                    <td>
                                        {{ $client->telephone }}
                                    </td>
                                    <td>
                                        {{ $clientChange->telephone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Residance Address
                                    </th>
                                    <td>
                                        {{ $client->address_line_1 }}<br>
                                        {{ $client->address_line_2 }}<br>
                                        {{ $client->address_line_3 }}
                                    </td>
                                    <td>
                                        {{ $clientChange->address_line_1 }}<br>
                                        {{ $clientChange->address_line_2 }}<br>
                                        {{ $clientChange->address_line_3 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Correspondance Address
                                    </th>
                                    <td>
                                        {{ $client->correspondence_address_line_1 }}<br>
                                        {{ $client->correspondence_address_line_2 }}<br>
                                        {{ $client->correspondence_address_line_3 }}
                                    </td>
                                    <td>
                                        {{ $clientChange->correspondence_address_line_1 }}<br>
                                        {{ $clientChange->correspondence_address_line_2 }}<br>
                                        {{ $clientChange->correspondence_address_line_3 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Date Of Birth
                                    </th>
                                    <td>
                                        {{ $client->dob }}
                                    </td>
                                    <td>
                                        {{ $clientChange->dob }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Nationality
                                    </th>
                                    <td>
                                        {{ $client->nationality }}
                                    </td>
                                    <td>
                                        {{ $clientChange->nationality }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        National ID
                                    </th>
                                    <td>
                                        {{ $client->nic }}
                                    </td>
                                    <td>
                                        {{ $clientChange->nic }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Account Type
                                    </th>
                                    <td>
                                        {{ Config::get('constants.CLIENT_TYPE')[$account->type] }}
                                    </td>
                                    <td>
                                        {{ Config::get('constants.CLIENT_TYPE')[$accountChange->type] }}
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
                                            <table>

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
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->verification_from_GOV_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['clients', 'verification_from_GOV_verify', $client->verification_from_GOV_verify, $client->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                @else
                                    <tr style="border-color: Red; border-style: dotted; border-width: thick">
                                        <th>
                                            Upload Government Verfication DOC
                                        </th>
                                        <td>
                                            <form id="govVerifyForm" method="post"
                                                action="{{ route('admin.clients.management.gov.approval', $client->id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-3" align="right">
                                                        <h4>Enter Title</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="title" id="title"
                                                            class="form-control" />
                                                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                                                    </div>
                                                </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3" align="right">
                            <h4>Select File</h4>
                        </div>
                        <div class="col-md-6">
                            <input type="file" name="file" id="file" class="form-control" />
                        </div>
                        <div class="col-md-3">
                            <input type="submit" name="upload" value="Upload" class="btn btn-success" />
                        </div>
                    </div>
                    </form>
                    </td>

                    </tr>
                    @endif

                    @if ($client->hasMoneyLaunderingVerifications())
                        <tr>
                            <th>
                                Money laundering verification
                            </th>
                            <td>
                                {{-- <a href="{{asset('/storage/uploads/'.$client->verification_from_GOV)}}" target="_blank"> 
                                    <img src="{{asset('storage/uploads/'.$client->verification_from_GOV)}}" class="img-fluid" width="50px" height="100px" alt="Responsive image">
                                </a> --}}
                                <table>

                                    <thead>
                                        <tr>
                                            <td>Document</td>
                                            <td>Uploaded By</td>
                                        </tr>

                                    </thead>
                                    @foreach ($client->moneyLaunderingVerifications()->get() as $upload)
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
                            <td>
                                <input type="checkbox" class="checkBoxVerify"
                                    {{ $client->money_laundering_verification_verify == 0 ? '' : 'checked' }}
                                    {{ $account->status > 2 ? 'disabled' : '' }} />
                                <input type="hidden"
                                    value="{{ base64_encode(serialize(['clients', 'verification_from_GOV_verify', $client->money_laundering_verification_verify, $client->id])) }}">
                                <label for="checkbox"></label>
                            </td>
                        </tr>
                    @endif
                    @if ($client->billing_proof != null)
                        <tr>
                            <th>
                                Billing Proof
                            </th>
                            <td>
                                <a href="{{ asset('/storage/uploads/' . $client->billing_proof) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $client->billing_proof) }}" class="img-fluid"
                                        width="50px" height="100px" alt="Responsive image">
                                </a>
                            </td>
                            <td>
                                <input type="checkbox" class="checkBoxVerify"
                                    {{ $client->billing_proof_verify == 0 ? '' : 'checked' }}
                                    {{ $account->status > 2 ? 'disabled' : '' }} />
                                <input type="hidden"
                                    value="{{ base64_encode(serialize(['clients', 'billing_proof_verify', $client->billing_proof_verify, $client->id])) }}">
                                <label for="checkbox"></label>
                            </td>
                        </tr>
                    @endif

                    @if ($client->nic_front != null)
                        <tr>
                            <th>
                                NIC Front
                            </th>
                            <td>
                                <a href="{{ asset('/storage/uploads/' . $client->nic_front) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $client->nic_front) }}" class="img-fluid"
                                        width="50px" height="100px" alt="National ID front">
                                </a>
                            </td>
                            <td>
                                <a href="{{ asset('/storage/uploads/' . $clientChange->nic_front) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $clientChange->nic_front) }}" class="img-fluid"
                                        width="50px" height="100px" alt="National ID front">
                                </a>
                            </td>
                        </tr>
                    @endif
                    @if ($client->nic_back != null)
                        <tr>
                            <th>
                                NIC Back
                            </th>
                            <td>
                                <a href="{{ asset('/storage/uploads/' . $client->nic_back) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $client->nic_back) }}" class="img-fluid"
                                        width="50px" height="100px" alt="National ID Back Image">
                                </a>
                            </td>
                            <td>
                                <a href="{{ asset('/storage/uploads/' . $clientChange->nic_back) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $clientChange->nic_back) }}" class="img-fluid"
                                        width="50px" height="100px" alt="National ID Back Image">
                                </a>
                            </td>
                        </tr>
                    @endif
                    @if ($client->passport != null)
                        <tr>
                            <th>
                                Passport
                            </th>
                            <td>
                                <a href="{{ asset('/storage/uploads/' . $client->passport) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $client->passport) }}" class="img-fluid"
                                        width="50px" height="100px" alt="Passport Image">
                                </a>
                            </td>
                            <td>
                                <a href="{{ asset('/storage/uploads/' . $clientChange->passport) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $clientChange->passport) }}"
                                        class="img-fluid" width="50px" height="100px" alt="Passport Image">
                                </a>
                            </td>
                        </tr>
                    @endif
                    @if ($client->signature != null)
                        <tr>
                            <th>
                                Signature
                            </th>
                            <td>
                                <a href="{{ asset('/storage/uploads/' . $client->signature) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $client->signature) }}" class="img-fluid"
                                        width="50px" height="100px" alt="Client Signature Image">
                                </a>
                            </td>
                            <td>
                                <a href="{{ asset('/storage/uploads/' . $clientChange->signature) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $clientChange->signature) }}"
                                        class="img-fluid" width="50px" height="100px" alt="Client Signature Image">
                                </a>

                            </td>
                        </tr>
                    @endif
                    @if ($client->pro_pic != null)
                        <tr>
                            <th>
                                Profile Picture
                            </th>
                            <td>
                                <a href="{{ asset('/storage/uploads/' . $client->pro_pic) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $client->pro_pic) }}" class="img-fluid"
                                        width="50px" height="100px" alt="Client Profile Picture">
                                </a>
                            </td>
                            <td>
                                <a href="{{ asset('/storage/uploads/' . $clientChange->pro_pic) }}" target="_blank">
                                    <img src="{{ asset('storage/uploads/' . $clientChange->pro_pic) }}" class="img-fluid"
                                        width="50px" height="100px" alt="Client Profile Picture">
                                </a>

                            </td>
                        </tr>
                    @endif
                    @if ($authorizedPerson)
                        <tr>
                            <th>
                                Authorized Person
                            </th>
                            <td>
                                <table>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $authorizedPerson->name }}</td>
                                        <td>
                                            {{-- <input type="checkbox" class="checkBoxVerify"
                                                {{ $authorizedPerson->name_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(
                                                    serialize(['authorized_person', 'name_verify', $authorizedPerson->name_verify, $authorizedPerson->id]),
                                                ) }}">
                                            <label for="checkbox"></label> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $authorizedPerson->address }}</td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $authorizedPerson->address_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(
                                                    serialize(['authorized_person', 'address_verify', $authorizedPerson->address_verify, $authorizedPerson->id]),
                                                ) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>NIC</td>
                                        <td>{{ $authorizedPerson->nic }}</td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $authorizedPerson->nic_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(
                                                    serialize(['authorized_person', 'nic_verify', $authorizedPerson->nic_verify, $authorizedPerson->id]),
                                                ) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Telephone</td>
                                        <td>{{ $authorizedPerson->telephone }}</td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $authorizedPerson->telephone_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(
                                                    serialize(['authorized_person', 'telephone_verify', $authorizedPerson->telephone_verify, $authorizedPerson->id]),
                                                ) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>

                                </table>
                            </td>
                            <td>

                            </td>
                        </tr>
                    @endif

                    @if ($client->hasEmploymenDetails())
                        <tr>
                            <th>Employment Details</th>
                            <td colspan="2">
                                <table>
                                    <tr>
                                        <th>
                                            Info
                                        </th>
                                        <th>
                                            Existing Account
                                        </th>
                                        <th>
                                            Changes
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>Occupation</td>
                                        <td>{{ $employmentDetails->occupation }}</td>
                                        <td>
                                            {{ $employmentDetailsChanges->occupation }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Company Name</td>
                                        <td>{{ $employmentDetails->company_name }}</td>
                                        <td>
                                            {{ $employmentDetailsChanges->company_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Company Address</td>
                                        <td>{{ $employmentDetails->company_address }}</td>
                                        <td>
                                            {{ $employmentDetailsChanges->company_address }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Telephone</td>
                                        <td>{{ $employmentDetails->telephone }}</td>
                                        <td>
                                            {{ $employmentDetailsChanges->telephone }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fax</td>
                                        <td>{{ $employmentDetails->fax }}</td>
                                        <td>
                                            {{ $employmentDetailsChanges->fax }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nature</td>
                                        <td>{{ $employmentDetails->nature }}</td>
                                        <td>
                                            {{ $employmentDetailsChanges->nature }}
                                        </td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                    @endif
                    @if ($client->hasCompany())
                        <tr>
                            <th>
                                Coperate Information
                            </th>
                            <td>
                                <table>
                                    <tr>
                                        <th>
                                            Company Name
                                        </th>
                                        <td>
                                            {{ $client->company->name }}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->name_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'name_verify', $client->company->name_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Address Line 1
                                        </th>
                                        <td>
                                            {{ $client->company->address_line_1 }}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->address_line_1_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'address_line_1_verify', $client->company->address_line_1_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Address Line 2
                                        </th>
                                        <td>
                                            {{ $client->company->address_line_2 }}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->address_line_2_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'address_line_2_verify', $client->company->address_line_2_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Address Line 3
                                        </th>
                                        <td>
                                            {{ $client->company->address_line_3 }}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->address_line_3_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'address_line_3_verify', $client->company->address_line_3_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            Business Registration No
                                        </th>
                                        <td>
                                            {{ $client->company->business_registration_no }}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->business_registration_no_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'business_registration_no_verify', $client->company->business_registration_no_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Nature Of Business
                                        </th>
                                        <td>
                                            {{ $client->company->nature_of_business }}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->nature_of_business_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'nature_of_business_verify', $client->company->nature_of_business_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            Telephone 1
                                        </th>
                                        <td>
                                            {{ $client->company->telephone_1 }}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->telephone_1_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'telephone_1_verify', $client->company->telephone_1_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Telephone 2
                                        </th>
                                        <td>
                                            {{ $client->company->telephone_2 }}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->telephone_2_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'telephone_2_verify', $client->company->telephone_2_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Telephone 3
                                        </th>
                                        <td>
                                            {{ $client->company->telephone_3 }}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->telephone_3_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'telephone_3_verify', $client->company->telephone_3_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Email 1
                                        </th>
                                        <td>
                                            {{ $client->company->email_1 }}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->email_1_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'email_1_verify', $client->company->email_1_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Email 2
                                        </th>
                                        <td>
                                            {{ $client->company->email_2 }}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->email_2_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'email_2_verify', $client->company->email_2_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Email 3
                                        </th>
                                        <td>
                                            {{ $client->company->email_3 }}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->email_3_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'email_3_verify', $client->company->email_3_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Fax 1
                                        </th>
                                        <td>
                                            {{ $client->company->fax_1 }}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->fax_1_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'fax_1_verify', $client->company->fax_1_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Fax 2
                                        </th>
                                        <td>
                                            {{ $client->company->fax_2 }}
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->fax_2_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'fax_2_verify', $client->company->fax_2_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Fax 3
                                        </th>
                                        <td>
                                            {{ $client->company->fax_3 }}
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Business ACT
                                        </th>
                                        <td>
                                            <a href="{{ asset('/storage/uploads/' . $client->company->business_act) }}"
                                                target="_blank">
                                                {{ $client->company->business_act }}
                                            </a>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->business_act_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'business_act_verify', $client->company->business_act_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Trust Deed
                                        </th>
                                        <td>
                                            <a href="{{ asset('/storage/uploads/' . $client->company->trust_deed) }}"
                                                target="_blank">
                                                {{ $client->company->trust_deed }}
                                            </a>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->trust_deed_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'trust_deed_verify', $client->company->trust_deed_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Board Resolution
                                        </th>
                                        <td>
                                            <a href="{{ asset('/storage/uploads/' . $client->company->board_resolution) }}"
                                                target="_blank">
                                                {{ $client->company->board_resolution }}
                                            </a>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->board_resolution_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'board_resolution_verify', $client->company->board_resolution_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Society Constitution
                                        </th>
                                        <td>
                                            <a href="{{ asset('/storage/uploads/' . $client->company->society_constitution) }}"
                                                target="_blank">
                                                {{ $client->company->society_constitution }}
                                            </a>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->society_constitution_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'society_constitution_verify', $client->company->society_constitution_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Power of Attorney
                                        </th>
                                        <td>
                                            <a href="{{ asset('/storage/uploads/' . $client->company->power_of_attorney) }}"
                                                target="_blank">
                                                {{ $client->company->power_of_attorney }}
                                            </a>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="checkBoxVerify"
                                                {{ $client->company->power_of_attorney_verify == 0 ? '' : 'checked' }}
                                                {{ $account->status > 2 ? 'disabled' : '' }} />
                                            <input type="hidden"
                                                value="{{ base64_encode(serialize(['companies', 'power_of_attorney_verify', $client->company->power_of_attorney_verify, $client->company->id])) }}">
                                            <label for="checkbox"></label>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    @endif


                    <tr>
                        <th>Joint Holders</th>
                        <td>
                            @if ($account->hasJointHolders())
                                @foreach ($account->jointHolders()->get() as $jointHolder)
                                    <table>
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
                                            <td> Address Line 1 </td>
                                            <td>{{ $jointHolder->address_line_1 }}</td>

                                        </tr>
                                        <tr>
                                            <td> Address Line 2 </td>
                                            <td>{{ $jointHolder->address_line_2 }}</td>

                                        </tr>
                                        <tr>
                                            <td> Address Line 3 </td>
                                            <td>{{ $jointHolder->address_line_3 }}</td>

                                        </tr>
                                        <tr>
                                            <td>Telephone</td>
                                            <td>{{ $jointHolder->telephone }}</td>

                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <td>{{ $jointHolder->mobile }}</td>

                                        </tr>
                                        @if ($jointHolder->nic_front != null && $jointHolder->nic_front != 'none')
                                            <tr>
                                                <td>NIC Front</td>
                                                <td> <a href="{{ asset('/storage/uploads/' . $jointHolder->nic_front) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/uploads/' . $jointHolder->nic_front) }}"
                                                            class="img-fluid" width="50px" height="100px"
                                                            alt="Responsive image">
                                                    </a></td>

                                            </tr>
                                        @endif
                                        @if ($jointHolder->nic_back != null && $jointHolder->nic_back != 'none')
                                            <tr>
                                                <td>NIC Back</td>
                                                <td> <a href="{{ asset('/storage/uploads/' . $jointHolder->nic_back) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/uploads/' . $jointHolder->nic_back) }}"
                                                            class="img-fluid" width="50px" height="100px"
                                                            alt="Responsive image">
                                                    </a></td>

                                            </tr>
                                        @endif
                                        @if ($jointHolder->passport != null && $jointHolder->passport != 'none')
                                            <tr>
                                                <td>Passport</td>
                                                <td> <a href="{{ asset('/storage/uploads/' . $jointHolder->passport) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/uploads/' . $jointHolder->passport) }}"
                                                            class="img-fluid" width="50px" height="100px"
                                                            alt="Responsive image">
                                                    </a></td>

                                            </tr>
                                        @endif
                                        @if ($jointHolder->signature != null)
                                            <tr>
                                                <td>signature</td>
                                                <td> <a href="{{ asset('/storage/uploads/' . $jointHolder->signature) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/uploads/' . $jointHolder->signature) }}"
                                                            class="img-fluid" width="50px" height="100px"
                                                            alt="Responsive image">
                                                    </a></td>

                                            </tr>
                                        @endif
                                        @if ($jointHolder->pro_pic != null)
                                            <tr>
                                                <td>Profile Picture</td>
                                                <td> <a href="{{ asset('/storage/uploads/' . $jointHolder->pro_pic) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/uploads/' . $jointHolder->pro_pic) }}"
                                                            class="img-fluid" width="50px" height="100px"
                                                            alt="Responsive image">
                                                    </a></td>

                                            </tr>
                                        @endif
                                    </table>
                                    <br>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if ($account->hasJoinHolderChanges())
                                @foreach ($account->joinHolderChanges()->get() as $jointHolder)
                                    <table>
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
                                            <td> Address Line 1 </td>
                                            <td>{{ $jointHolder->address_line_1 }}</td>

                                        </tr>
                                        <tr>
                                            <td> Address Line 2 </td>
                                            <td>{{ $jointHolder->address_line_2 }}</td>

                                        </tr>
                                        <tr>
                                            <td> Address Line 3 </td>
                                            <td>{{ $jointHolder->address_line_3 }}</td>

                                        </tr>
                                        <tr>
                                            <td>Telephone</td>
                                            <td>{{ $jointHolder->telephone }}</td>

                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <td>{{ $jointHolder->mobile }}</td>

                                        </tr>
                                        @if ($jointHolder->nic_front != null && $jointHolder->nic_front != 'none')
                                            <tr>
                                                <td>NIC Front</td>
                                                <td> <a href="{{ asset('/storage/uploads/' . $jointHolder->nic_front) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/uploads/' . $jointHolder->nic_front) }}"
                                                            class="img-fluid" width="50px" height="100px"
                                                            alt="Responsive image">
                                                    </a></td>

                                            </tr>
                                        @endif
                                        @if ($jointHolder->nic_back != null && $jointHolder->nic_back != 'none')
                                            <tr>
                                                <td>NIC Back</td>
                                                <td> <a href="{{ asset('/storage/uploads/' . $jointHolder->nic_back) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/uploads/' . $jointHolder->nic_back) }}"
                                                            class="img-fluid" width="50px" height="100px"
                                                            alt="Responsive image">
                                                    </a></td>

                                            </tr>
                                        @endif
                                        @if ($jointHolder->passport != null && $jointHolder->passport != 'none')
                                            <tr>
                                                <td>Passport</td>
                                                <td> <a href="{{ asset('/storage/uploads/' . $jointHolder->passport) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/uploads/' . $jointHolder->passport) }}"
                                                            class="img-fluid" width="50px" height="100px"
                                                            alt="Responsive image">
                                                    </a></td>

                                            </tr>
                                        @endif
                                        @if ($jointHolder->signature != null)
                                            <tr>
                                                <td>signature</td>
                                                <td> <a href="{{ asset('/storage/uploads/' . $jointHolder->signature) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/uploads/' . $jointHolder->signature) }}"
                                                            class="img-fluid" width="50px" height="100px"
                                                            alt="Responsive image">
                                                    </a></td>

                                            </tr>
                                        @endif
                                        @if ($jointHolder->pro_pic != null)
                                            <tr>
                                                <td>Profile Picture</td>
                                                <td> <a href="{{ asset('/storage/uploads/' . $jointHolder->pro_pic) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/uploads/' . $jointHolder->pro_pic) }}"
                                                            class="img-fluid" width="50px" height="100px"
                                                            alt="Responsive image">
                                                    </a></td>

                                            </tr>
                                        @endif
                                    </table>
                                    <br>
                                @endforeach
                            @endif


                        </td>
                    </tr>


                    @if ($client->hasCompanySignatures())
                        <tr>
                            <th>Company Signatures</th>
                            <td>
                                @foreach ($client->companySignatures()->get() as $signature)
                                    <h3>Signature - {{ $signature->type }}</h3>
                                    <table>
                                        <tr>
                                            <td>Name</td>
                                            <td>{{ $signature->name }}</td>
                                            <td>
                                                <input type="checkbox" class="checkBoxVerify"
                                                    {{ $signature->name_verify == 0 ? '' : 'checked' }}
                                                    {{ $account->status > 2 ? 'disabled' : '' }} />
                                                <input type="hidden"
                                                    value="{{ base64_encode(serialize(['company_signatures', 'name_verify', $signature->name_verify, $signature->id])) }}">
                                                <label for="checkbox"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Date Of Birth</td>
                                            <td>{{ $signature->dob }}</td>
                                            <td>
                                                <input type="checkbox" class="checkBoxVerify"
                                                    {{ $signature->dob_verify == 0 ? '' : 'checked' }}
                                                    {{ $account->status > 2 ? 'disabled' : '' }} />
                                                <input type="hidden"
                                                    value="{{ base64_encode(serialize(['company_signatures', 'dob_verify', $signature->dob_verify, $signature->id])) }}">
                                                <label for="checkbox"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>NIC/Passport</td>
                                            <td>{{ $signature->nic }}</td>
                                            <td>
                                                <input type="checkbox" class="checkBoxVerify"
                                                    {{ $signature->nic_verify == 0 ? '' : 'checked' }}
                                                    {{ $account->status > 2 ? 'disabled' : '' }} />
                                                <input type="hidden"
                                                    value="{{ base64_encode(serialize(['company_signatures', 'nic_verify', $signature->nic_verify, $signature->id])) }}">
                                                <label for="checkbox"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nationality</td>
                                            <td>{{ $signature->nationality }}</td>
                                            <td>
                                                <input type="checkbox" class="checkBoxVerify"
                                                    {{ $signature->nationality_verify == 0 ? '' : 'checked' }}
                                                    {{ $account->status > 2 ? 'disabled' : '' }} />
                                                <input type="hidden"
                                                    value="{{ base64_encode(
                                                        serialize(['company_signatures', 'nationality_verify', $signature->nationality_verify, $signature->id]),
                                                    ) }}">
                                                <label for="checkbox"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Address Line 1 </td>
                                            <td>{{ $signature->address_line_1 }}</td>
                                            <td>
                                                <input type="checkbox" class="checkBoxVerify"
                                                    {{ $signature->address_line_1_verify == 0 ? '' : 'checked' }}
                                                    {{ $account->status > 2 ? 'disabled' : '' }} />
                                                <input type="hidden"
                                                    value="{{ base64_encode(
                                                        serialize(['company_signatures', 'address_line_1_verify', $signature->address_line_1_verify, $signature->id]),
                                                    ) }}">
                                                <label for="checkbox"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Address Line 2 </td>
                                            <td>{{ $signature->address_line_2 }}</td>
                                            <td>
                                                <input type="checkbox" class="checkBoxVerify"
                                                    {{ $signature->address_line_2_verify == 0 ? '' : 'checked' }}
                                                    {{ $account->status > 2 ? 'disabled' : '' }} />
                                                <input type="hidden"
                                                    value="{{ base64_encode(
                                                        serialize(['company_signatures', 'address_line_2_verify', $signature->address_line_2_verify, $signature->id]),
                                                    ) }}">
                                                <label for="checkbox"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Address Line 3 </td>
                                            <td>{{ $signature->address_line_3 }}</td>
                                            <td>
                                                <input type="checkbox" class="checkBoxVerify"
                                                    {{ $signature->address_line_3_verify == 0 ? '' : 'checked' }}
                                                    {{ $account->status > 2 ? 'disabled' : '' }} />
                                                <input type="hidden"
                                                    value="{{ base64_encode(
                                                        serialize(['company_signatures', 'address_line_3_verify', $signature->address_line_3_verify, $signature->id]),
                                                    ) }}">
                                                <label for="checkbox"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Telephone</td>
                                            <td>{{ $signature->telephone }}</td>
                                            <td>
                                                <input type="checkbox" class="checkBoxVerify"
                                                    {{ $signature->telephone_verify == 0 ? '' : 'checked' }}
                                                    {{ $account->status > 2 ? 'disabled' : '' }} />
                                                <input type="hidden"
                                                    value="{{ base64_encode(
                                                        serialize(['company_signatures', 'telephone_verify', $signature->telephone_verify, $signature->id]),
                                                    ) }}">
                                                <label for="checkbox"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <td>{{ $signature->mobile }}</td>
                                            <td>
                                                <input type="checkbox" class="checkBoxVerify"
                                                    {{ $signature->mobile_verify == 0 ? '' : 'checked' }}
                                                    {{ $account->status > 2 ? 'disabled' : '' }} />
                                                <input type="hidden"
                                                    value="{{ base64_encode(serialize(['company_signatures', 'mobile_verify', $signature->mobile_verify, $signature->id])) }}">
                                                <label for="checkbox"></label>
                                            </td>
                                        </tr>
                                        @if ($signature->nic_front != null && $signature->nic_front != 'none')
                                            <tr>
                                                <td>NIC Front</td>
                                                <td> <a href="{{ asset('/storage/uploads/' . $signature->nic_front) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/uploads/' . $signature->nic_front) }}"
                                                            class="img-fluid" width="50px" height="100px"
                                                            alt="Responsive image">
                                                    </a></td>
                                                <td>
                                                    <input type="checkbox" class="checkBoxVerify"
                                                        {{ $signature->nic_front_verify == 0 ? '' : 'checked' }}
                                                        {{ $account->status > 2 ? 'disabled' : '' }} />
                                                    <input type="hidden"
                                                        value="{{ base64_encode(
                                                            serialize(['company_signatures', 'nic_front_verify', $signature->nic_front_verify, $signature->id]),
                                                        ) }}">
                                                    <label for="checkbox"></label>
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($signature->nic_back != null && $signature->nic_back != 'none')
                                            <tr>
                                                <td>NIC Back</td>
                                                <td> <a href="{{ asset('/storage/uploads/' . $signature->nic_back) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/uploads/' . $signature->nic_back) }}"
                                                            class="img-fluid" width="50px" height="100px"
                                                            alt="Responsive image">
                                                    </a></td>
                                                <td>
                                                    <input type="checkbox" class="checkBoxVerify"
                                                        {{ $signature->nic_back_verify == 0 ? '' : 'checked' }}
                                                        {{ $account->status > 2 ? 'disabled' : '' }} />
                                                    <input type="hidden"
                                                        value="{{ base64_encode(
                                                            serialize(['company_signatures', 'nic_back_verify', $signature->nic_back_verify, $signature->id]),
                                                        ) }}">
                                                    <label for="checkbox"></label>
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($signature->passport != null && $signature->passport != 'none')
                                            <tr>
                                                <td>Passport</td>
                                                <td> <a href="{{ asset('/storage/uploads/' . $signature->passport) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/uploads/' . $signature->passport) }}"
                                                            class="img-fluid" width="50px" height="100px"
                                                            alt="Responsive image">
                                                    </a></td>
                                                <td>
                                                    <input type="checkbox" class="checkBoxVerify"
                                                        {{ $signature->passport_verify == 0 ? '' : 'checked' }}
                                                        {{ $account->status > 2 ? 'disabled' : '' }} />
                                                    <input type="hidden"
                                                        value="{{ base64_encode(
                                                            serialize(['company_signatures', 'passport_verify', $signature->passport_verify, $signature->id]),
                                                        ) }}">
                                                    <label for="checkbox"></label>
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($signature->signature != null)
                                            <tr>
                                                <td>signature</td>
                                                <td> <a href="{{ asset('/storage/uploads/' . $signature->signature) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/uploads/' . $signature->signature) }}"
                                                            class="img-fluid" width="50px" height="100px"
                                                            alt="Responsive image">
                                                    </a></td>
                                                <td>
                                                    <input type="checkbox" class="checkBoxVerify"
                                                        {{ $signature->signature_verify == 0 ? '' : 'checked' }}
                                                        {{ $account->status > 2 ? 'disabled' : '' }} />
                                                    <input type="hidden"
                                                        value="{{ base64_encode(
                                                            serialize(['company_signatures', 'signature_verify', $signature->signature_verify, $signature->id]),
                                                        ) }}">
                                                    <label for="checkbox"></label>
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                    <br>
                                @endforeach
                            </td>
                            <td></td>
                        </tr>
                    @endif

                    <tr>
                        <th>
                            Bank Particulars
                        </th>
                        <td>
                            @if ($account->hasBankParticulars())
                                <table>
                                    <tr>
                                        <th>Account Type</th>
                                        <th>BeneFactor</th>
                                        <th>Bank</th>
                                        <th>Branch</th>
                                        <th>Account No</th>

                                    </tr>
                                    @foreach ($account->bankParticulars()->get() as $bankParticulars)
                                        <tr>
                                            <td> {{ $bankParticulars->Account_type }} </td>
                                            <td> {{ $bankParticulars->name }} </td>
                                            <td> {{ $bankParticulars->bank_name }} </td>
                                            <td> {{ $bankParticulars->branch }} </td>
                                            <td> {{ $bankParticulars->account_no }} </td>

                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                        </td>
                        <td>
                            @if ($account->hasBankParticularChanges())
                                <table>
                                    <tr>
                                        <th>Account Type</th>
                                        <th>BeneFactor</th>
                                        <th>Bank</th>
                                        <th>Branch</th>
                                        <th>Account No</th>

                                    </tr>
                                    @foreach ($account->bankParticularChanges()->get() as $bankParticulars)
                                        <tr>
                                            <td> {{ $bankParticulars->Account_type }} </td>
                                            <td> {{ $bankParticulars->name }} </td>
                                            <td> {{ $bankParticulars->bank_name }} </td>
                                            <td> {{ $bankParticulars->branch }} </td>
                                            <td> {{ $bankParticulars->account_no }} </td>

                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                        </td>
                    </tr>

                    @if ($otherDetails)
                        <tr>
                            <th>Other Details</th>
                            <td colspan="2">
                                <table>
                                    <tr>
                                        <th>Info</th>
                                        <th>Existing Account</th>
                                        <th>Changes</th>
                                    </tr>
                                    <tr>
                                        <td>Are you a Director or Staff of NSB Fund Management Company Ltd?</td>
                                        <td>{{ $otherDetails->nsb_staff_fund_management == 1 ? 'Yes' : 'No' }}</td>
                                        <td>
                                            {{ $account->otheDetailChanges->nsb_staff_fund_management == 1 ? 'Yes' : 'No' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Are you related to any Director or Staff of NSB Fund Management Company Ltd?
                                        </td>
                                        <td>{{ $otherDetails->related_nsb_staff == 1 ? 'Yes' : 'No' }}</td>
                                        <td>
                                            {{ $account->otheDetailChanges->related_nsb_staff == 1 ? 'Yes' : 'No' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Are you a Director or Staff of NSB?</td>
                                        <td>{{ $otherDetails->nsb_staff == 1 ? 'Yes' : 'No' }}</td>
                                        <td>
                                            {{ $account->otheDetailChanges->nsb_staff == 1 ? 'Yes' : 'No' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>If “Yes”, please state the Relationship</td>
                                        <td>{{ $otherDetails->staff_relationship }}</td>
                                        <td>
                                            {{ $account->otheDetailChanges->staff_relationship }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Are you a Director/Employee of another Primary Dealer/ Holding Company and/or an
                                            associate of the Primary Dealer?</td>
                                        <td>{{ $otherDetails->member_holding_company == 1 ? 'Yes' : 'No' }}</td>
                                        <td>
                                            {{ $account->otheDetailChanges->member_holding_company == 1 ? 'Yes' : 'No' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>If yes, please state the Prior written concern</td>
                                        <td>{{ $otherDetails->member_holding_company_state }}</td>
                                        <td>
                                            {{ $account->otheDetailChanges->member_holding_company_state }}
                                        </td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                        @if ($client->hasRealTimeNotification())
                            <th>
                                Real Time Notification
                            </th>
                            <td>
                                <table>

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
                            <td>
                                @if ($account->hasNotificationChange())
                                    <table>

                                        <tbody>
                                            @if ($account->notificationChange->on_email == 1)
                                                <tr>
                                                    <th>
                                                        ON Email
                                                    </th>
                                                    <td>
                                                        {{ $account->notificationChange->realTimeNotification->email }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if ($account->notificationChange->on_mobile == 1)
                                                <tr>
                                                    <th>
                                                        ON Mobile
                                                    </th>
                                                    <td>
                                                        {{ $account->notificationChange->mobile }}
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>


                                    </table>
                                @endif


                            </td>
                        @endif
                    @endif





                    @if ($account->status >= 3)
                        <tr>
                            <th>
                                Videos

                            </th>
                            <td>

                                @foreach ($account->uploads()->get() as $upload)
                                    @php
                                        $info = pathinfo($upload->file_name);
                                        
                                    @endphp
                                    @if ($info['extension'] == 'mp4' || $info['extension'] == 'm4v')
                                        <video width="320" height="240" controls>
                                            <source src="{{ asset('/storage/uploads/' . $upload->file_name) }}"
                                                type="video/mp4">

                                            Your browser does not support the video tag.
                                        </video>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endif
                    @if ($account->status >= 3)
                        <tr>
                            <th>
                                Documents

                            </th>
                            <td>

                                @foreach ($account->uploads()->get() as $upload)
                                    @php
                                        $info = pathinfo($upload->file_name);
                                        
                                    @endphp
                                    @if ($info['extension'] == 'pdf' || $info['extension'] == 'docx' || $info['extension'] == 'doc')
                                        <a href="{{ asset('/storage/uploads/' . $upload->file_name) }}"
                                            target="_blank">{{ $upload->file_name }}</a>

                                        &nbsp;
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <th>
                            Reference Email Address
                        </th>
                        <td>
                            <form method="post" action="{{ route('admin.clients.refemail.update') }}">
                                @csrf
                                <input type="text" name="reference_email" id="reference_email"
                                    value="{{ $account->reference_email }}" class="form-control" />
                                <input type="hidden" name="account_id" value="{{ $account->id }}">
                                <button type="submit" class="btn btn-danger">Save</button>
                            </form>
                        </td>
                    </tr>

                    {{-- @if ($account->status >= 4)
                       
                        <tr>
                            <th>
                                 Recorded Meeting
                                
                            </th>
                            <td>
                                @foreach ($client->meetings()->get() as $meeting)
                                    
                               
                                <video width="320" height="240" controls>
                                    <source src="{{asset('/storage/uploads/'.$meeting->video)}}" type="video/mp4">
                                    
                                  Your browser does not support the video tag.
                                  </video>
                                  @endforeach
    
                            </td>
                                <td></td>
                        </tr>
                            
                        @endif --}}


                    <tr>
                        <th>
                            Current Status
                        </th>
                        <td>
                            @if ($account->status == 100)
                                Declined
                            @else
                                @if ($account->verify_type == 1)
                                    {{ Config::get('constants.CLIENT_STATUS')[$account->status] }}
                                @else
                                    {{ Config::get('constants.CLIENT_STATUS_PHY')[$account->status] }}
                                @endif
                            @endif


                        </td>
                    </tr>
                    @php
                        $current_user = Auth::user()
                            ->roles()
                            ->first();
                        
                    @endphp

                    <tr>
                        <th>
                            Action
                        </th>

                        <td id="tdAction">
                            {{-- <div class="spinner-border" id="processSpiner" style="width: 3rem; height: 3rem;"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div> --}}
                            <form id="approvalForm" action="" method="POST" action=""
                                enctype="multipart/form-data">
                                @csrf
                                @if (
                                    ($officer_role->id == 5 && $accountChange->status == 0) ||
                                        ($officer_role->id == 6 && $accountChange->status == 0) ||
                                        ($officer_role->id == 7 && $accountChange->status == 1))
                                    <div class="form-group">
                                        <button type="button" id="btnApprove" class="btn btn-success btn-lg">
                                            Approve</button>
                                        &nbsp; &nbsp;
                                        <button type="button" id="btnDecline" class="btn btn-danger btn-lg"> Decline
                                        </button>
                                        <input type="hidden" name="account_id" value="{{ $accountChange->id }}">
                                        {{-- <input type="hidden" name="client_id"
                                                value="{{ $accountChange->client->id }}"> --}}
                                        <input type="hidden" name="request_type" id="request_type" value="">
                                    </div>
                                @endif
                            </form>
                        </td>
                    </tr>

                    </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="2a">
                    <h3>KYC INFO</h3><button class="btn btn-primary no-print btnPrint"
                        style="float:right;margin-top:-40px;">
                        <i class="fa fa-printer"></i>Print KYC
                    </button>
                    @if ($kyc != null)
                        <table class="table table-bordered  table-hover">
                            <tbody>
                                <tr>
                                    <th>
                                        Client Name
                                    </th>
                                    <td>
                                        {{ $client->name }}

                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                        {{ $account->clientChange->name }}

                                    </td>

                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        NIC/Passport
                                    </th>
                                    <td>
                                        {{ $client->nic }}

                                    </td>
                                    <td>



                                    </td>
                                    <td>
                                        {{ $account->clientChange->name }}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Address
                                    </th>

                                    <td>
                                        {{ $client->address_line_1 }},
                                        {{ $client->address_line_2 }},
                                        {{ $client->address_line_3 }}

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        {{ $account->clientChange->address_line_1 }},
                                        {{ $account->clientChange->address_line_2 }},
                                        {{ $account->clientChange->address_line_3 }}
                                    </td>
                                    <td>



                                    </td>
                                </tr>
                                @if ($client->hasEmploymenDetails())
                                    <tr>
                                        <th>
                                            Occupation
                                        </th>
                                        <td>
                                            {{ $client->employmentDetails->occupation }}

                                        </td>
                                        <td>



                                        </td>
                                        <td>
                                            {{ $account->employmentChange->occupation }}
                                        </td>
                                        <td></td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>
                                        Have a Investment at NSB FMC
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_account_at_NSB_FMC }}

                                    </td>
                                    <td>



                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_account_at_NSB_FMC }}


                                    </td>
                                    <td>



                                    </td>
                                </tr>
                                @if ($kyc->kyc_employment_status != null)
                                    <tr>
                                        <th>
                                            Employment Status
                                        </th>
                                        <td>
                                            @if (!$kyc->kyc_employment_status != 'Other')
                                                {{ $kyc->kyc_employment_status }}
                                            @else
                                                {{ $kyc->kyc_other_employement }}
                                            @endif
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            @if (!$kyc_change->kyc_employment_status != 'Other')
                                                {{ $kyc_change->kyc_employment_status }}
                                            @else
                                                {{ $kyc_change->kyc_other_employement }}
                                            @endif
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                @endif
                                @if ($kyc->kyc_nature_of_business != null)
                                    <tr>
                                        <th>
                                            Nature of Business
                                        </th>
                                        <td>
                                            @if (!$kyc->kyc_nature_of_business != 'Other')
                                                {{ $kyc->kyc_nature_of_business }}
                                            @else
                                                {{ $kyc->kyc_nature_of_business_specify }}
                                            @endif
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            @if (!$kyc_change->kyc_nature_of_business != 'Other')
                                                {{ $kyc_change->kyc_nature_of_business }}
                                            @else
                                                {{ $kyc_change->kyc_nature_of_business_specify }}
                                            @endif
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                @endif
                                @if ($kyc->kyc_marital_status != null)
                                    <tr>
                                        <th>
                                            Marital Status
                                        </th>
                                        <td>
                                            {{ $kyc->kyc_marital_status }}
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            {{ $kyc_change->kyc_marital_status }}
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    @if ($kyc->kyc_marital_status == 'Married')
                                        <tr>
                                            <th>
                                                Name of Spouse
                                            </th>
                                            <td>
                                                {{ $kyc->kyc_spouse_name }}
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                                {{ $kyc_change->kyc_spouse_name }}
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Spouse Occupation Held
                                            </th>
                                            <td>
                                                {{ $kyc->kyc_spouse_job }}
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                                {{ $kyc_change->kyc_spouse_job }}
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                    @endif
                                @endif


                                <tr>
                                    <th>
                                        Status of the Residential Address:
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_ownership_of_premises }}

                                    </td>

                                    @php
                                        if ($kyc->kyc_ownership_of_premises == 'Owner' || $kyc->kyc_ownership_of_premises == "Parent's") {
                                            $rate = 0.05;
                                            $color = 'grey';
                                            $label = 'low';
                                        } elseif ($kyc->kyc_ownership_of_premises == 'Lease/Rent' || $kyc->kyc_ownership_of_premises == 'Official') {
                                            $rate = 0.1;
                                            $color = 'yellow';
                                            $label = 'Medium';
                                        } else {
                                            $rate = 0.15;
                                            $color = 'red';
                                            $label = 'high';
                                        }
                                    @endphp



                                    <td style="background-color: {{ $color }}">


                                        <b>{{ $label }}</b><br>
                                        <b class="rateB"> {{ $rate }}</b>

                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_ownership_of_premises }}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Foreign Address (if any):
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_foreign_address }}

                                    </td>
                                    <td>



                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_foreign_address }}


                                    </td>
                                    <td>



                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Citizenship
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_citizenship }}

                                    </td>
                                    @php
                                        if ($kyc->kyc_citizenship == 'Sri Lankan') {
                                            $rate = 0.05;
                                            $color = 'grey';
                                            $label = 'low';
                                        } elseif ($kyc->kyc_citizenship == 'Sri Lankan') {
                                            $rate = 0.1;
                                            $color = 'yellow';
                                            $label = 'Medium';
                                        } elseif ($kyc->kyc_citizenship == 'Sri Lankan with dual citizenship') {
                                            $rate = 0.1;
                                            $color = 'yellow';
                                            $label = 'Medium';
                                        } else {
                                            $rate = 0.15;
                                            $color = 'red';
                                            $label = 'high';
                                        }
                                    @endphp
                                    <td style="background-color: {{ $color }}">
                                        <b>{{ $label }}</b><br>
                                        <b class="rateB"> {{ $rate }}</b>
                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_citizenship }}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Country of Residence
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_country_of_residence }}

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_country_of_residence }}

                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Country of Birth:
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_country_of_birth }}

                                    </td>
                                    <td>


                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_country_of_birth }}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Nationality:
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_nationality }}

                                    </td>
                                    <td>



                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_nationality }}

                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Type of Visa
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_type_of_visa }}

                                    </td>
                                    <td>


                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_type_of_visa }}

                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Expiry Date
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_expiry_date }}

                                    </td>
                                    <td>



                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_expiry_date }}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        In case of Foreign Passport Holders, give the purpose of opening the account in the
                                        foreign jurisdiction:
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_purpose_account_foreign }}

                                    </td>
                                    <td>



                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_purpose_account_foreign }}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Purpose of Opening the Account:
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_purpose_of_opening_account }}

                                    </td>
                                    @php
                                        if ($kyc->kyc_purpose_of_opening_account == 'Employment/Professional income') {
                                            $rate = 0.2;
                                            $color = 'grey';
                                            $label = 'low';
                                        } elseif ($kyc->kyc_purpose_of_opening_account == 'Savings' || $kyc->kyc_purpose_of_opening_account == 'Investment purposes' || $kyc->kyc_purpose_of_opening_account == 'Remittances') {
                                            $rate = 0.0;
                                            $color = 'yellow';
                                            $label = 'Medium';
                                        } else {
                                            $rate = 0.6;
                                            $color = 'red';
                                            $label = 'high';
                                        }
                                    @endphp
                                    <td style="background-color: {{ $color }}">
                                        <b>{{ $label }}</b><br>
                                        <b class="rateB"> {{ $rate }}</b>
                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_purpose_of_opening_account }}

                                    </td>
                                    <td>

                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        Other Purpose
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_other_purpose }}

                                    </td>
                                    <td>


                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_other_purpose }}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Source of Funds: [Expected source and nature of credits into the account]
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_source_of_funds }}

                                    </td>
                                    @php
                                        if ($kyc->kyc_source_of_funds == 'Salary/Profit/Professional Income') {
                                            $rate = 0.25;
                                            $color = 'grey';
                                            $label = 'low';
                                        } elseif ($kyc->kyc_source_of_funds == 'Sales and Business Turnover' || $kyc->kyc_source_of_funds == 'Sale of Property/Assets' || $kyc->kyc_source_of_funds == 'Sales and Business Turnover' || $kyc->kyc_source_of_funds == 'Rent Income' || $kyc->kyc_source_of_funds == 'Remittances' || $kyc->kyc_source_of_funds == 'Investment Proceeds' || $kyc->kyc_source_of_funds == 'Export Proceeds') {
                                            $rate = 0.5;
                                            $color = 'yellow';
                                            $label = 'Medium';
                                        } else {
                                            $rate = 0.75;
                                            $color = 'red';
                                            $label = 'high';
                                        }
                                    @endphp
                                    <td style="background-color: {{ $color }}">
                                        <b>{{ $label }}</b><br>
                                        <b class="rateB"> {{ $rate }}</b>
                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_source_of_funds }}
                                    </td>
                                    <td>

                                    </td>

                                </tr>
                                <tr>
                                    <th>
                                        Other Source Of fund
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_other_source }}

                                    </td>
                                    <td>



                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_other_source }}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Anticipated Volumes: [Expected/Usual average volumes of deposits into the account in
                                        Rs
                                        per month]
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_anticipated_volume }}

                                    </td>
                                    @php
                                        if (\Carbon\Carbon::parse($kyc->create_at)->format('y-m-d') < \Carbon\Carbon::parse('2023-03-06')->format('y-m-d')) {
                                            if ($kyc->kyc_anticipated_volume == 'Less than Rs.200,000 (or equivalent FC value)' || $kyc->kyc_anticipated_volume == 'Rs.200,001 to Rs.500,000 (or equivalent FC value)') {
                                                $rate = 0.2;
                                                $color = 'grey';
                                                $label = 'low';
                                            } elseif ($kyc->kyc_anticipated_volume == 'Rs.500,001 to Rs.1,000,000 (or equivalent FC value') {
                                                $rate = 0.2;
                                                $color = 'yellow';
                                                $label = 'Medium';
                                            } else {
                                                $rate = 0.3;
                                                $color = 'red';
                                                $label = 'high';
                                            }
                                        } else {
                                            if ($kyc->kyc_anticipated_volume == 'Less than Rs.500,000 (or equivalent FC value)' || $kyc->kyc_anticipated_volume == 'Rs.500,001 to Rs.2,000,000 (or equivalent FC value)') {
                                                $rate = 0.2;
                                                $color = 'grey';
                                                $label = 'low';
                                            } elseif ($kyc->kyc_anticipated_volume == 'Rs.2,000,001 to Rs.5,000,000 (or equivalent FC value)') {
                                                $rate = 0.2;
                                                $color = 'yellow';
                                                $label = 'Medium';
                                            } else {
                                                $rate = 0.3;
                                                $color = 'red';
                                                $label = 'high';
                                            }
                                        }
                                        
                                    @endphp

                                    <td style="background-color: {{ $color }}">
                                        <b>{{ $label }}</b><br>
                                        <b class="rateB"> {{ $rate }}</b>

                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_anticipated_volume }}
                                    </td>
                                    <td>

                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        Expected Mode of Transactions/ Delivery Channels:
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_expected_mode_of_transacation }}

                                    </td>
                                    @php
                                        if ($kyc->kyc_expected_mode_of_transacation == 'Cheque' || $kyc->kyc_expected_mode_of_transacation == 'Standing Orders') {
                                            $rate = 0.15;
                                            $color = 'grey';
                                            $label = 'low';
                                        } elseif ($kyc->kyc_expected_mode_of_transacation == 'Cash') {
                                            $rate = 0.3;
                                            $color = 'yellow';
                                            $label = 'Medium';
                                        } else {
                                            $rate = 0.45;
                                            $color = 'red';
                                            $label = 'high';
                                        }
                                    @endphp
                                    <td style="background-color: {{ $color }}">
                                        <b>{{ $label }}</b><br>
                                        <b class="rateB"> {{ $rate }}</b>
                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_expected_mode_of_transacation }}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Other Connected Businesses /Professional Activities (if applicable):
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_other_connected_businesses }}

                                    </td>
                                    <td>



                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_other_connected_businesses }}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Expected Types of Counterparties (if applicable)
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_expected_types_of_counterparties }}

                                    </td>
                                    <td>


                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_expected_types_of_counterparties }}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th> Customer Type</th>
                                    <td> {{ Config::get('constants.CLIENT_TYPE')[$client->client_type] }} </td>
                                    @php
                                        if ($account->type == 1) {
                                            $rate = 0.05;
                                            $color = 'grey';
                                            $label = 'low';
                                        } elseif ($account->type == 2) {
                                            $rate = 0.1;
                                            $color = 'yellow';
                                            $label = 'Medium';
                                        } else {
                                            $rate = 0.15;
                                            $color = 'red';
                                            $label = 'high';
                                        }
                                    @endphp
                                    <td style="background-color: {{ $color }}">
                                        <b>{{ $label }}</b><br>
                                        <b class="rateB"> {{ $rate }}</b>
                                    </td>
                                    <td> {{ Config::get('constants.CLIENT_TYPE')[$accountChange->type] }} </td>
                                    <td>

                                    </td>

                                </tr>
                                <tr>
                                    <th>
                                        Relationship With Bank

                                    </th>
                                    <td>
                                        {{ $kyc->kyc_relationship }}
                                    </td>
                                    @php
                                        if ($kyc->kyc_relationship == 'Existing customer (more than 5 years)') {
                                            $rate = 0.05;
                                            $color = 'grey';
                                            $label = 'low';
                                        } elseif ($kyc->kyc_relationship == 'Existing customer (1 to 5 years)') {
                                            $rate = 0.1;
                                            $color = 'yellow';
                                            $label = 'Medium';
                                        } else {
                                            $rate = 0.15;
                                            $color = 'red';
                                            $label = 'high';
                                        }
                                    @endphp
                                    <td style="background-color: {{ $color }}">
                                        <b>{{ $label }}</b><br>
                                        <b class="rateB"> {{ $rate }}</b>
                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_relationship }}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        PEP (politically exposed person)

                                    </th>
                                    <td>
                                        {{ $kyc->kyc_pep }}
                                    </td>
                                    @php
                                        if ($kyc->kyc_pep == 'Yes') {
                                            $rate = '';
                                            $color = 'Red';
                                            $label = 'High';
                                        } else {
                                            $rate = 0;
                                            $color = 'white';
                                            $label = 'Low';
                                        }
                                    @endphp
                                    <td style="background-color: {{ $color }}">
                                        <b>{{ $label }}</b><br>
                                        <b class="rateB"> {{ $rate }}</b>
                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_pep }}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Operating Authority of the Account
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_operation_authority }}

                                    </td>
                                    <td>


                                    </td>
                                    <td>
                                        {{ $kyc_change->kyc_operation_authority }}

                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                @if ($kyc->kyc_operation_authority == 'Other')
                                    <tr>
                                        <th>
                                            Name
                                        </th>
                                        <td>
                                            {{ $kyc->kyc_other_name }}

                                        </td>
                                        <td>


                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Address
                                        </th>
                                        <td>
                                            {{ $kyc->kyc_other_address }}

                                        </td>
                                        <td>


                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            NIC
                                        </th>
                                        <td>
                                            {{ $kyc->kyc_other_nic }}

                                        </td>
                                        <td>


                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>
                                        Risk Rate
                                    </th>
                                    <td>
                                        {{ $kyc->risk_rate }}
                                    </td>

                                </tr>
                                <tr>
                                    <th>
                                        Officer Remarks
                                    </th>
                                    <td>
                                        {{ $kyc->officer_remarks }} &nbsp;
                                    </td>
                                    <td>
                                        @if ($kyc->officer != null)
                                            Rate By :- &nbsp; {{ $kyc->remarkOfficer->name }}
                                        @endif
                                    </td>

                                </tr>
                                <tr class="no-print">

                                    <td colspan="3">
                                        <h5>Update Risk Rate By Officer </h5>
                                        <Form id="rateUpdateForm" method="POST"
                                            action="{{ route('admin.clients.kyc.remark') }}">
                                            @csrf
                                            <table class="table table-primary" width="100%">
                                                <input type="hidden" name="kyc_id" value="{{ $kyc->id }}}">
                                                <tr>
                                                    <td>Rate</td>
                                                    <td>
                                                        <select name="risk_rate" id="seletRate">
                                                            <option value="LOW">LOW</option>
                                                            <option value="MEDIUM">MEDIUM</option>
                                                            <option value="HIGH">HIGH</option>
                                                        </select>
                                                    </td>
                                                <tr>
                                                    <td>Remark</td>
                                                    <td>
                                                        <textarea name="remark" id="" cols="30" rows="10" class="form-control"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="submit" class="btn btn-danger">update</button>
                                                    </td>
                                                </tr>

                                </tr>

                        </table>
                        </Form>
                        </td>
                        </tr>
                        </tbody>
                        </table>

                    @endif

                    @if ($account->hasJointHolders())
                        <h3>Joint Holders</h3>


                        @foreach ($account->jointHolders()->get() as $jointHolder)
                            @if ($jointHolder->hasKycByInvestmentId(0))
                                @php
                                    $jkyc = $jointHolder->kycByInvestmentId(0);
                                    
                                @endphp
                                <table class="table table-bordered  table-hover">
                                    <tbody>
                                        <tr>
                                            <th>
                                                Client Name
                                            </th>
                                            <td>
                                                {{ $jointHolder->name }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                NIC/Passport
                                            </th>
                                            <td>
                                                {{ $jointHolder->nic }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                Address
                                            </th>
                                            <td>
                                                {{ $jointHolder->address_line_1 }},
                                                {{ $jointHolder->address_line_2 }},
                                                {{ $jointHolder->address_line_3 }}

                                            </td>

                                        </tr>

                                        <tr>
                                            <th>
                                                Occupation
                                            </th>
                                            <td>
                                                {{ $jointHolder->occupation }}

                                            </td>

                                        </tr>


                                        <tr>
                                            <th>
                                                Have a Investment at NSB FMC
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_account_at_NSB_FMC }}


                                        </tr>
                                        @if ($kyc->kyc_employment_status != null)
                                            <tr>
                                                <th>
                                                    Employment Status
                                                </th>
                                                <td>
                                                    @if (!$jkyc->kyc_employment_status != 'Other')
                                                        {{ $jkyc->kyc_employment_status }}
                                                    @else
                                                        {{ $jkyc->kyc_other_employement }}
                                                    @endif
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($jkyc->kyc_nature_of_business != null)
                                            <tr>
                                                <th>
                                                    Nature of Business
                                                </th>
                                                <td>
                                                    @if (!$jkyc->kyc_nature_of_business != 'Other')
                                                        {{ $jkyc->kyc_nature_of_business }}
                                                    @else
                                                        {{ $jkyc->kyc_nature_of_business_specify }}
                                                    @endif
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($jkyc->kyc_marital_status != null)
                                            <tr>
                                                <th>
                                                    Marital Status
                                                </th>
                                                <td>
                                                    {{ $jkyc->kyc_marital_status }}
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                            @if ($jkyc->kyc_marital_status == 'Married')
                                                <tr>
                                                    <th>
                                                        Name of Spouse
                                                    </th>
                                                    <td>
                                                        {{ $jkyc->kyc_spouse_name }}
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Spouse Occupation Held
                                                    </th>
                                                    <td>
                                                        {{ $jkyc->kyc_spouse_job }}
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                        <tr>
                                            <th>
                                                Status of the Residential Address:
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_ownership_of_premises }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                Foreign Address (if any):
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_foreign_address }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                Citizenship
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_citizenship }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                Country of Residence
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_country_of_residence }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                Country of Birth:
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_country_of_birth }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                Nationality:
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_nationality }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                Type of Visa
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_type_of_visa }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                Expiry Date
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_expiry_date }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                In case of Foreign Passport Holders, give the purpose of opening the account
                                                in
                                                the foreign jurisdiction:
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_purpose_account_foreign }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                Purpose of Opening the Account:
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_purpose_of_opening_account }}

                                            </td>


                                        <tr>
                                            <th>
                                                Other Purpose
                                            </th>
                                            <td>
                                                {{ $kyc->kyc_other_purpose }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                Source of Funds: [Expected source and nature of credits into the account]
                                            </th>
                                            <td>
                                                {{ $kyc->kyc_source_of_funds }}

                                            </td>


                                        </tr>
                                        <tr>
                                            <th>
                                                Other Source Of fund
                                            </th>
                                            <td>
                                                {{ $kyc->kyc_other_source }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                Anticipated Volumes: [Expected/Usual average volumes of deposits into the
                                                account in Rs per month]
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_anticipated_volume }}

                                            </td>

                                        </tr>

                                        <tr>
                                            <th>
                                                Expected Mode of Transactions/ Delivery Channels:
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_expected_mode_of_transacation }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                Other Connected Businesses /Professional Activities (if applicable):
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_other_connected_businesses }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                Expected Types of Counterparties (if applicable)
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_expected_types_of_counterparties }}

                                            </td>

                                        </tr>

                                        <tr>
                                            <th>
                                                Relationship With Bank

                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_relationship }}
                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                Operating Authority of the Account
                                            </th>
                                            <td>
                                                {{ $kyc->kyc_operation_authority }}

                                            </td>

                                        </tr>
                                        @if ($jkyc->kyc_operation_authority == 'Other')
                                            <tr>
                                                <th>
                                                    Name
                                                </th>
                                                <td>
                                                    {{ $jkyc->kyc_other_name }}

                                                </td>

                                            </tr>
                                            <tr>
                                                <th>
                                                    Address
                                                </th>
                                                <td>
                                                    {{ $jkyc->kyc_other_address }}

                                                </td>

                                            </tr>
                                            <tr>
                                                <th>
                                                    NIC
                                                </th>
                                                <td>
                                                    {{ $jkyc->kyc_other_nic }}

                                                </td>

                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            @else
                                <h4> joint Holder or holders haven't filled the KYC forms</h4>
                            @endif
                        @endforeach
                    @endif




                    {{-- @if ($client->hasCompanySignatures() && $client->companySignatures->haskyc())

                   @foreach ($client->companySignatures()->get() as $signature)
                       
                          <h3>{{$signature->name}} - Signature</h3>
  
                   <table class="table table-bordered  table-hover">
                       @php
                           $skyc = $signature->kyc;
                       @endphp
                      <tbody>
                          <tr>
                              <th>
                                  Have a Investment at NSB FMC
                              </th>
                              <td>
                               {{$skyc->kyc_account_at_NSB_FMC}} 
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_account_at_NSB_FMC_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_account_at_NSB_FMC_verify",$skyc->kyc_account_at_NSB_FMC_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Nature Of Businesss
                              </th>
                              <td>
                               {{$skyc->kyc_nature_of_business}} 
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_nature_of_business_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_nature_of_business_verify",$skyc->kyc_nature_of_business_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                 Employment
                              </th>
                              <td>
                               {{$skyc->kyc_employment}} 
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_employment_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_employment_verify",$skyc->kyc_employment_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                 Employment Address
                              </th>
                              <td>
                               {{$skyc->kyc_employer_address}} 
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_employer_address_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_employer_address_verify",$skyc->kyc_employer_address_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Status of the Residential Address:
                              </th>
                              <td>
                               {{$skyc->kyc_ownership_of_premises}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_ownership_of_premises_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_ownership_of_premises_verify",$skyc->kyc_ownership_of_premises_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Foreign Address (if any):
                              </th>
                              <td>
                               {{$skyc->kyc_foreign_address}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_foreign_address_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_foreign_address_verify",$skyc->kyc_foreign_address_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Citizenship
                              </th>
                              <td>
                               {{$skyc->kyc_citizenship}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_citizenship_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_citizenship_verify",$skyc->kyc_citizenship_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Country of Residence
                              </th>
                              <td>
                               {{$skyc->kyc_country_of_residence}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_country_of_residence_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_country_of_residence_verify",$skyc->kyc_country_of_residence_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Country of Birth:
                              </th>
                              <td>
                               {{$skyc->kyc_country_of_birth}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_country_of_birth_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_country_of_birth_verify",$skyc->kyc_country_of_birth_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Nationality:
                              </th>
                              <td>
                               {{$skyc->kyc_nationality}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_nationality_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_nationality_verify",$skyc->kyc_nationality_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Type of Visa
                              </th>
                              <td>
                               {{$skyc->kyc_type_of_visa}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_type_of_visa_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_type_of_visa_verify",$skyc->kyc_type_of_visa_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Expiry Date
                              </th>
                              <td>
                               {{$skyc->kyc_expiry_date}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_expiry_date_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_expiry_date_verify",$skyc->kyc_expiry_date_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  In case of Foreign Passport Holders, give the purpose of opening the account in the foreign jurisdiction:
                              </th>
                              <td>
                               {{$skyc->kyc_purpose_account_foreign}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_purpose_account_foreign_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_purpose_account_foreign_verify",$skyc->kyc_purpose_account_foreign_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Purpose of Opening the Account:
                              </th>
                              <td>
                               {{$skyc->kyc_purpose_of_opening_account}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_purpose_of_opening_account_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_purpose_of_opening_account_verify",$skyc->kyc_purpose_of_opening_account_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                 Other Purpose
                              </th>
                              <td>
                               {{$skyc->kyc_other_purpose}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_other_purpose_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_account_at_NSB_FMC",$skyc->kyc_other_purpose_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Source of Funds: [Expected source and nature of credits into the account]
                              </th>
                              <td>
                               {{$skyc->kyc_source_of_funds}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_source_of_funds_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_source_of_funds_verify",$skyc->kyc_source_of_funds_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Other Source Of fund
                              </th>
                              <td>
                               {{$skyc->kyc_other_source}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_other_source_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_other_source_verify",$skyc->kyc_other_source_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Anticipated Volumes: [Expected/Usual average volumes of deposits into the account in Rs per month]
                              </th>
                              <td>
                               {{$skyc->kyc_anticipated_volume}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_anticipated_volume_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_anticipated_volume_verify",$skyc->kyc_anticipated_volume_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                Expected Mode of Transactions/ Delivery Channels:
                              </th>
                              <td>
                               {{$skyc->kyc_expected_mode_of_transacation}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_expected_mode_of_transacation_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_expected_mode_of_transacation_verify",$skyc->kyc_expected_mode_of_transacation_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Other Connected Businesses /Professional Activities (if applicable):
                              </th>
                              <td>
                               {{$skyc->kyc_other_connected_businesses}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_other_connected_businesses_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_other_connected_businesses_verify",$skyc->kyc_other_connected_businesses_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Expected Types of Counterparties (if applicable)
                              </th>
                              <td>
                               {{$skyc->kyc_expected_types_of_counterparties}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_expected_types_of_counterparties_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_expected_types_of_counterparties_verify",$skyc->kyc_expected_types_of_counterparties_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Operating Authority of the Account
                              </th>
                              <td>
                               {{$skyc->kyc_operation_authority}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_operation_authority_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_operation_authority_verify",$skyc->kyc_operation_authority_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                 Name
                              </th>
                              <td>
                               {{$skyc->kyc_other_name}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_other_name_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_other_name_verify",$skyc->kyc_other_name_verify,
                                                 $skyc->id)))}}">
      
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  Address
                              </th>
                              <td>
                               {{$skyc->kyc_other_address}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_other_address_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_other_address_verify",$skyc->kyc_other_address_verify,
                                                 $skyc->id)))}}">
                               </td>
                          </tr>
                          <tr>
                              <th>
                                  NIC
                              </th>
                              <td>
                               {{$skyc->kyc_other_nic}}
                              
                              </td>
                               <td>
      
                                  <input type="checkbox" class="checkBoxVerify" {{$skyc->kyc_other_nic_verify==0?"":'checked'}} {{$client->mainInvestmentState() > 2 ?"disabled":""}} />
                                                  <input type="hidden" value="{{base64_encode(serialize(array("k_y_c_company_signature_forms","kyc_other_nic_verify",$skyc->kyc_other_nic_verify,
                                                 $skyc->id)))}}">
                               </td>
                          </tr>
                        </tbody>         
                      </table>       
                      @endforeach
                     @endif --}}
                    {{-- @endif --}}
                </div>
            </div>
            <div class="form-group">
                <a class="btn btn-default no-print" href="{{ route('admin.clients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
    </div>
    <div>
        @php
            //  dd($client->process()->get())
        @endphp
        <table class="table table-success table-striped no-print">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Officer</th>
                    <th scope="col">status</th>
                    <th scope="col">Action</th>
                    <th scope="col">comment</th>
                    <th scope="col">Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($account->process()->get() as $process)
                    <tr>
                        <td>{{ $process->id }}</td>
                        <td>{{ $process->users()->first()->name }} -
                            {{ $process->users()->first()->roles()->first()->title }}</td>
                        <td>{{ Config::get('constants.CLIENT_STATUS')[$process->current_state] }}</td>
                        <td>{{ $process->current_state != 100 ? 'Approved' : 'Declined' }}</td>
                        <td>{!! $process->comment !!}</td>
                        <td>{{ $process->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Decliened modal --}}

        <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reason For Rejecting Application</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Comment:</label>
                                <textarea class="form-control" id="declineComment"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btnCommentSubmit" class="btn btn-primary">Submit Comment &
                            Decline</button>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {






        });
    </script>
@endsection
