@extends('layouts.client')
@section('content')
    @php
        $user = Auth::user();
        $role = $user->roles()->first()->id;
        if ($user->hasClient()) {
            $is_signatureB = $user->client->is_signatureB;
        } else {
            $is_signatureB = 0;
        }
        
    @endphp


    <div class="col-md-9 content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>Bids</h2>
            </div>
            <div class="panel-body">
                @if ($bids)
                    @foreach ($bids as $key => $bid)
                        @if (($role == 10 && $bid->jointNotApproved($user->jointHolder->id) == 0) || $role == 8 || $role == 9)
                            <div class="table-responsive">

                                <table class=" table table-bordered table-striped table-hover">
                                    <tbody>

                                        <tr>
                                            <th>
                                                #ID
                                            </th>
                                            <td># {{ $bid->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Investment
                                            </th>
                                            <td>

                                                {{ $bid->investmentType->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Amount
                                            </th>
                                            <td>
                                                @money($bid->amount)
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Rate
                                            </th>
                                            <td>
                                                {{ $bid->rate }}%
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Value Date
                                            </th>
                                            <td>
                                                {{ $bid->value_date }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Date
                                            </th>
                                            <td>
                                                {{ $bid->created_at }} &nbsp;({{ $bid->created_at->diffForHumans() }})
                                            </td>
                                        </tr>
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
                                                @if (
                                                    ($role == 9 && $bid->status == -2) ||
                                                        ($is_signatureB == 1 && $bid->status == -2) ||
                                                        ($role == 8 && $bid->status == -1) ||
                                                        ($role == 10 && $bid->status < 0))
                                                    <form class="approvalForm" method="POST"
                                                        action="{{ route('client.bid.process') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row" style="margin-left: 3px; margin-bottom: 5px;">
                                                            <input class="form-check-input acceptCheck" type="checkbox"
                                                                value="" style="display: inline-block !important">
                                                            <strong>Accept <a
                                                                    href="{{ asset('storage/images/bid_terms.pdf') }}"
                                                                    target="_blank" style="margin-bottom:20px;">Terms and
                                                                    Conditions</a></strong>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="button"
                                                                class="btn btn-success btn-lg btnApprove"> Approve</button>
                                                            &nbsp; &nbsp;
                                                            <button type="button" class="btn btn-danger btn-lg btnDecline">
                                                                Decline </button>
                                                            <input type="hidden" name="bid_id"
                                                                value="{{ $bid->id }}">
                                                            <input type="hidden" name="client_id"
                                                                value="{{ $bid->bidSet->client->id }}">
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
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    @parent
    <script>
        $(function() {

            let nextStage = " ";
            $('.btnApprove').prop("disabled", true);

            $(".acceptCheck").on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).closest('form').find('.btnApprove').prop("disabled", false);
                } else {
                    $(this).closest('form').find('.btnApprove').prop("disabled", true);
                }

            });


            $('.btnApprove').click(function() {
                var approveButton = $(this);
                alertify.confirm('Client Approval',
                    'Are you sure you want to Approve This Bid Request for further process?',
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
