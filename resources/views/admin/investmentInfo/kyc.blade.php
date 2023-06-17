@extends('layouts.app')
<style>
    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }
    }
</style>


@section('content')
    <div class="card print-form">
        <div class="card-header">
            <div class="pull-right">
                <img src="{{ asset('storage/images/fmc.jpg') }}" class="rounded-logo" alt="...">
            </div>
            <h4>{{ $investment->ref_no ?? '' }} &nbsp; KYC of {{ $client->title }} {{ $client->name }} for Investment
                {{ $investment->ref_no ?? 'Initial' }}</h4>
        </div>

        <div class="card-body">
            <div class="form-group">
                <button class="btn btn-default no-print btnPrint">
                    Print
                </button>
            </div>
            <h3>KYC INFO</h3>

            @if ($client->hasKycWithInvestmentId($investment_id))
                <table class="table table-bordered  table-hover">
                    <tbody>
                        <tr>
                            <th>
                                Have a Investment at NSB FMC
                            </th>
                            <td>
                                {{ $kyc->kyc_account_at_NSB_FMC }}

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

                            </tr>
                            @if ($kyc->kyc_marital_status == 'Married')
                                <tr>
                                    <th>
                                        Name of Spouse
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_spouse_name }}
                                    </td>

                                </tr>
                                <tr>
                                    <th>
                                        Spouse Occupation Held
                                    </th>
                                    <td>
                                        {{ $kyc->kyc_spouse_job }}
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

                        </tr>
                        <tr>
                            <th>
                                Foreign Address (if any):
                            </th>
                            <td>
                                {{ $kyc->kyc_foreign_address }}

                            </td>

                        </tr>
                        <tr>
                            <th>
                                Citizenship
                            </th>
                            <td>
                                {{ $kyc->kyc_citizenship }}

                            </td>

                        </tr>
                        <tr>
                            <th>
                                Country of Residence
                            </th>
                            <td>
                                {{ $kyc->kyc_country_of_residence }}

                            </td>

                        </tr>
                        <tr>
                            <th>
                                Country of Birth:
                            </th>
                            <td>
                                {{ $kyc->kyc_country_of_birth }}

                            </td>

                        </tr>
                        <tr>
                            <th>
                                Nationality:
                            </th>
                            <td>
                                {{ $kyc->kyc_nationality }}

                            </td>

                        </tr>
                        <tr>
                            <th>
                                Type of Visa
                            </th>
                            <td>
                                {{ $kyc->kyc_type_of_visa }}

                            </td>

                        </tr>
                        <tr>
                            <th>
                                Expiry Date
                            </th>
                            <td>
                                {{ $kyc->kyc_expiry_date }}

                            </td>

                        </tr>
                        <tr>
                            <th>
                                In case of Foreign Passport Holders, give the purpose of opening the account in the foreign
                                jurisdiction:
                            </th>
                            <td>
                                {{ $kyc->kyc_purpose_account_foreign }}

                            </td>

                        </tr>
                        <tr>
                            <th>
                                Purpose of Opening the Account:
                            </th>
                            <td>
                                {{ $kyc->kyc_purpose_of_opening_account }}

                            </td>

                        </tr>

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
                                Anticipated Volumes: [Expected/Usual average volumes of deposits into the account in Rs per
                                month]
                            </th>
                            <td>
                                {{ $kyc->kyc_anticipated_volume }}

                            </td>

                        </tr>

                        <tr>
                            <th>
                                Expected Mode of Transactions/ Delivery Channels:
                            </th>
                            <td>
                                {{ $kyc->kyc_expected_mode_of_transacation }}

                            </td>

                        </tr>
                        <tr>
                            <th>
                                Other Connected Businesses /Professional Activities (if applicable):
                            </th>
                            <td>
                                {{ $kyc->kyc_other_connected_businesses }}

                            </td>

                        </tr>
                        <tr>
                            <th>
                                Expected Types of Counterparties (if applicable)
                            </th>
                            <td>
                                {{ $kyc->kyc_expected_types_of_counterparties }}

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
                        @if ($kyc->kyc_operation_authority == 'Other')
                            <tr>
                                <th>
                                    Name
                                </th>
                                <td>
                                    {{ $kyc->kyc_other_name }}

                                </td>

                            </tr>
                            <tr>
                                <th>
                                    Address
                                </th>
                                <td>
                                    {{ $kyc->kyc_other_address }}

                                </td>

                            </tr>
                            <tr>
                                <th>
                                    NIC
                                </th>
                                <td>
                                    {{ $kyc->kyc_other_nic }}

                                </td>

                            </tr>
                        @endif
                        <tr>
                            <th> PEP</th>
                            <td>{{ $kyc->kyc_pep }}</td>

                        </tr>
                        <tr>
                            <th> US Person</th>
                            <td>{{ $kyc->kyc_us_person }}</td>

                        </tr>
                    </tbody>
                </table>
            @endif
            @if ($client->hasJointHolders())
                @foreach ($client->jointHolders()->get() as $jointHolder)
                    <h3>{{ $jointHolder->name }} - Joint Holder</h3>
                    @php
                        $jkyc = $jointHolder->kycByInvestmentId($investment_id);
                    @endphp


                    @if ($jkyc)
                        <table class="table table-bordered  table-hover">

                            <tbody>
                                <tr>
                                    <th>
                                        Have a Investment at NSB FMC
                                    </th>
                                    <td>
                                        {{ $jkyc->kyc_account_at_NSB_FMC }}

                                    </td>

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

                                    </tr>
                                    @if ($jkyc->kyc_marital_status == 'Married')
                                        <tr>
                                            <th>
                                                Name of Spouse
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_spouse_name }}
                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                Spouse Occupation Held
                                            </th>
                                            <td>
                                                {{ $jkyc->kyc_spouse_job }}
                                            </td>

                                        </tr>
                                    @endif
                                @endif
                                {{-- <tr>
                                    <th>
                                        Nature Of Businesss
                                    </th>
                                    <td>
                                        {{ $jkyc->kyc_nature_of_business }}

                                    </td>

                                </tr> --}}
                                <tr>
                                    <th>
                                        Employment
                                    </th>
                                    <td>
                                        {{ $jkyc->kyc_employment }}

                                    </td>

                                </tr>
                                <tr>
                                    <th>
                                        Employment Address
                                    </th>
                                    <td>
                                        {{ $jkyc->kyc_employer_address }}

                                    </td>

                                </tr>
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
                                        In case of Foreign Passport Holders, give the purpose of opening the account in the
                                        foreign jurisdiction:
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

                                </tr>
                                <tr>
                                    <th>
                                        Other Purpose
                                    </th>
                                    <td>
                                        {{ $jkyc->kyc_other_purpose }}

                                    </td>

                                </tr>
                                <tr>
                                    <th>
                                        Source of Funds: [Expected source and nature of credits into the account]
                                    </th>
                                    <td>
                                        {{ $jkyc->kyc_source_of_funds }}

                                    </td>

                                </tr>
                                <tr>
                                    <th>
                                        Other Source Of fund
                                    </th>
                                    <td>
                                        {{ $jkyc->kyc_other_source }}

                                    </td>

                                </tr>
                                <tr>
                                    <th>
                                        Anticipated Volumes: [Expected/Usual average volumes of deposits into the account in
                                        Rs per month]
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
                                        Operating Authority of the Account
                                    </th>
                                    <td>
                                        {{ $jkyc->kyc_operation_authority }}

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
                                <tr>
                                    <th> PEP</th>
                                    <td>{{ $jkyc->kyc_pep }}</td>

                                </tr>
                                <tr>
                                    <th> US Person</th>
                                    <td>{{ $jkyc->kyc_us_person }}</td>

                                </tr>
                            </tbody>
                        </table>
                    @endif
                @endforeach
            @endif
            @if ($client->company->hasKyc())
                @php
                    $ckyc = $client->company->kycWithType($investment_id);
                @endphp


                <h3>Company KYC - {{ $client->company->name }}</h3>

                <table class="table table-bordered  table-hover">
                    <tbody>
                        <tr>
                            <td>Have an investment account at NSB FMC?</td>
                            <td>{{ $ckyc->kyc_account_at_NSB_FMC == 1 ? 'Yes' : 'no' }}</td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td> Foreign Address (if any)</td>
                            <td>{{ $ckyc->kyc_foreign_address }}</td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td>Countries involved in the Business (if any)</td>
                            <td>{{ $ckyc->kyc_countries }}</td>
                            <td>

                            </td>
                        </tr>

                        <tr>
                            <td> Purpose of Opening the Account</td>
                            <td>{{ $ckyc->kyc_purpose_of_opening_account }}</td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td>if Other purpose</td>
                            <td>{{ $ckyc->kyc_other_source }}</td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td>Source of Funds: [Expected source and nature of credits into the account]</td>
                            <td>{{ $ckyc->kyc_source_of_funds }}</td>
                            <td>

                            </td>
                        </tr>

                        <tr>
                            <td>Anticipated Volumes: [Expected/Usual average volumes of deposits into the account in Rs per
                                month]</td>
                            <td>{{ $ckyc->kyc_anticipated_volume }}</td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td> Expected Mode of Transactions/ Delivery Channels</td>
                            <td>{{ $ckyc->kyc_expected_mode_of_transacation }}</td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td> Other Connected Businesses /Professional Activities / Expected Type of Counterparties:
                                (Indicate in brief; Major Customers/Suppliers and Other Connected Parties) (if applicable).
                                (if applicable):</td>
                            <td>{{ $ckyc->kyc_other_connected_businesses }}</td>
                            <td>

                            </td>
                        </tr>

                        <tr>
                            <td>Assets owned by the Business / Organization and the value</td>
                            <td>
                                <table>
                                    <tbody>
                                        <tr>
                                            <th>Property / Premises</th>
                                            <td>{{ $ckyc->kyc_property }}</td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Motor Vehicles</th>
                                            <td>{{ $ckyc->kyc_motor_vehicles }}</td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Financial Assets</th>
                                            <td>{{ $ckyc->kyc_financial_assets }}</td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Investments</th>
                                            <td>{{ $ckyc->kyc_investments }}</td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ $ckyc->other_assets_name }}</th>
                                            <td>{{ $ckyc->other_assets_value }}</td>
                                            <td>

                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td> Does the business / entity have any foreign investors?</td>
                            <td>{{ $ckyc->has_foreign_investors == 1 ? 'Yes' : 'no' }}</td>
                            <td>

                            </td>
                        </tr>
                        @if ($ckyc->has_foreign_investors == 1 && $ckyc->hasKycForiegnInvestors())
                            <tr>
                                <th>Foreign Investors</th>
                                <td>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Country</th>
                                                <th>Percentage</th>
                                                <th>Verify</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ckyc->kycForiegnInvestors()->get() as $investor)
                                                <tr>
                                                    <td>{{ $investor->name }}</td>
                                                    <td>{{ $investor->country }}</td>
                                                    <td>{{ $investor->percentage }}</td>
                                                    <td> </td>

                                                </tr>
                                            @endforeach

                                        </tbody>


                                    </table>
                                </td>


                            </tr>
                        @endif


                    </tbody>
                </table>

            @endif
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
