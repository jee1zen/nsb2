@extends('layouts.client')
@section('content')


    <div class="col-md-9 content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>New Investment Requests</h2>
            </div>
            <div class="panel-body">
                @if ($newInvestments)
                    @foreach ($newInvestments as $key => $newInvestment)
                        @if ($newInvestment->jointNotApproved($client->id) == 0)
                            <div class="table-responsive">

                                <table class=" table table-bordered table-striped table-hover">
                                    <tbody>

                                        <tr>
                                            <th>
                                                #ID
                                            </th>
                                            <td># {{ $newInvestment->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Investment
                                            </th>
                                            <td>

                                                {{ $newInvestment->investmentType->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Amount
                                            </th>
                                            <td>
                                                @money($newInvestment->amount)
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                Requested on
                                            </th>
                                            <td>
                                                {{ $newInvestment->created_at }}
                                                &nbsp;({{ $newInvestment->created_at->diffForHumans() }})
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Value Date
                                            </th>
                                            <td>
                                                {{ $newInvestment->value_date }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Maturity Date
                                            </th>
                                            <td>
                                                {{ $newInvestment->maturity_date }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Instruction
                                            </th>
                                            <td>
                                                {{ $newInvestment->instruction }}
                                            </td>
                                        </tr>
                                        @if ($newInvestment->bank_id != null)
                                            <tr>
                                                <th>
                                                    Bank Info
                                                </th>
                                                <td>
                                                    {{ $newInvestment->bank->bank_name }} |
                                                    {{ $newInvestment->bank->account_no }}
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th>
                                                Status
                                            </th>
                                            <td>
                                                YOU NEED TO ACCEPT IF THIS TO BE PROCEEDED.
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Action</th>
                                            <td>
                                                @php
                                                    $user = Auth::user();
                                                    $role = $user->roles()->first()->id;
                                                    if ($user->hasClient()) {
                                                        $is_signatureB = $user->client->is_signatureB;
                                                    } else {
                                                        $is_signatureB = 0;
                                                    }

                                                @endphp
                                                @if ($newInvestment->status < 0)
                                                    <form class="approvalForm" method="POST"
                                                        action="{{ route('client.investment.process') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            @if ($client->client->hasKycWithInvestmentId($newInvestment->id, $account->id))
                                                                <button type="button"
                                                                    class="btn btn-success btn-lg btnApprove">
                                                                    Approve</button> &nbsp; &nbsp;<br>
                                                            @else
                                                                <a class="btn btn-primary"
                                                                    href="{{ route('client.kyc.client', $newInvestment->id) }}">
                                                                    Fill KYC FORM TO Approve</a> <br>
                                                            @endif

                                                            <br><button type="button"
                                                                class="btn btn-danger btn-lg btnDecline"> Decline </button>
                                                            <input type="hidden" name="investment_id"
                                                                value="{{ $newInvestment->id }}">
                                                            <input type="hidden" name="client_id"
                                                                value="{{ $newInvestment->client->id }}">
                                                            <input type="hidden" name="request_type" class="request_type"
                                                                value="">
                                                        </div>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>

                            </div>
                        @endif
                    @endforeach
                @else
                    NO Requests found Currently.
                @endif
                {{ $newInvestments->links() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {

            let nextStage = " ";


            $('.btnApprove').click(function() {
                var approveButton = $(this);
                alertify.confirm('Client Approval',
                    'Are you sure you want to Approve This New Investment  Request for further process?',
                    function() {

                        approveButton.closest('form').find('.request_type').val(1);
                        alertify.success("Approved! NEXT STEP - " + nextStage);
                        approveButton.closest('form').submit();
                    },
                    function() {
                        alertify.error('Action Cancelled')
                    });
            });

            $('.btnDecline').click(function() {
                var declineButton = $(this);
                alertify.prompt('Decline From Further Process', 'Reason for Decline', '', function(evt,
                    value) {
                    approveButton.closest('form').find('.request_comment').val(value);
                    approveButton.closest('form').find('.request_type').val(0);
                    alertify.error("You've Decliend Further Process!")
                    approveButton.closest('form').submit();
                }, function() {
                    alertify.error('Action Cancelled')
                });

            });
        });
    </script>
@endsection
