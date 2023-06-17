@extends('layouts.admin')
@section('content')
    <style>
        body {
            padding-top: 30px;
        }

        .glyphicon {
            margin-bottom: 10px;
            margin-right: 10px;
        }

        small {
            display: block;
            line-height: 1.428571429;
            color: #999;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <h3>Instruction - {{ Config::get('constants.REQUEST_TYPES')[$withdraw->request_type] }}</h3>
        </div>
        <div class="card-body">


            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="well well-sm">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <img src="{{ asset('storage/uploads/' . $withdraw->client->pro_pic) }}" alt=""
                                        class="img-rounded img-responsive" width="50px" height="100px" />
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <h4>
                                        {{ $withdraw->client->name }}</h4>
                                    <small><cite title="San Francisco, USA">{{ $withdraw->client->residence_address }} <i
                                                class="glyphicon glyphicon-map-marker">
                                            </i></cite></small>
                                    <p>
                                        <i class="fa fa-phone">{{ $withdraw->client->mobile }}</i>
                                        <br />
                                        <i class="fa fa-envelope"></i>{{ $withdraw->client->user->email }}
                                        <br />
                                        <i class="fa fa-globe"></i><a
                                            href="{{ route('admin.clients.profile', $withdraw->client->id) }}"
                                            target="_blank">Profile</a>
                                        <br />
                                        {{-- {{dd($withdraw->client->clientRecords()->get()->last())}} --}}
                                        {{-- <i class="fa fa-dollar"></i>@money($withdraw->client->clientRecords->last()->account_balance) --}}
                                    </p>

                                    <!-- Split button -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">


                        <label for="">Invested Amount @money($withdraw->investment->invested_amount)</label><br />
                        @if ($withdraw->amount != 0)
                            <label for="">Amount @money($withdraw->amount)</label><br />
                        @endif
                        @if ($withdraw->expected_date != null)
                            <label for="">Expected Date :- {{ $withdraw->expected_date }}</label>
                        @endif

                        <label for="">{{ $withdraw->investment->investmentType->name }}</label></br>
                        <label for="">Current Status -
                            {{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$withdraw->status] }}</label>

                        <form id="approvalForm" action="" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @if (
                                ($officer_role->id == 5 && $withdraw->status == 0) ||
                                    ($officer_role->id == 6 && $withdraw->status == 0) ||
                                    ($officer_role->id == 7 && $withdraw->status == 1))
                                <div class="form-group">
                                    <button type="button" id="btnApprove" class="btn btn-success btn-lg"> Approve</button>
                                    &nbsp; &nbsp;
                                    <button type="button" id="btnDecline" class="btn btn-danger btn-lg"> Decline </button>
                                    <input type="hidden" name="withdraw_id" value="{{ $withdraw->id }}">
                                    <input type="hidden" name="client_id" value="{{ $withdraw->client->id }}">
                                    <input type="hidden" name="request_type" id="request_type" value="">
                                </div>
                            @endif
                        </form>
                    </div>

                    @if ($withdraw->bank_id != 0)
                        <div class="col-xs-12 col-sm-6 col-md-6">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            <h5>Account To Tranfer </h5>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Bank</th>
                                        <td>{{ $withdraw->bankAccount->bank_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Branch</th>
                                        <td>{{ $withdraw->bankAccount->branch }}</td>
                                    </tr>
                                    <tr>
                                        <th>Account No</th>
                                        <td>{{ $withdraw->bankAccount->account_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Account Type</th>

                                        <td>
                                            {{-- {{Config::get('constants.CLIENT_TYPE') [$withdraw->bankAccount->Account_type]}} --}}
                                            {{ $withdraw->bankAccount->Account_type }}
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let nextStage = "{{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$withdraw->status + 1] }}"
            $('#btnApprove').click(function() {
                alertify.confirm('Client Approval',
                    'Are you sure you want to Approve the Withdraw Request for further process?',
                    function() {
                        $('#request_type').val(1);
                        alertify.success("Approved! NEXT STEP - " + nextStage);
                        $('#approvalForm').submit();
                    },
                    function() {
                        alertify.error('Action Cancelled')
                    });
            });

            $('#btnDecline').click(function() {
                alertify.prompt('Decline From Further Process', 'Reason for Decline', '', function(evt,
                    value) {
                    $('#request_comment').val(value);
                    $('#request_type').val(0);
                    alertify.error("You've Decliend Further Process!")
                    $('#approvalForm').submit();
                }, function() {
                    alertify.error('Action Cancelled')
                });

            });
        });
    </script>
@endsection
