@extends('layouts.client')
@section('content')
    <div class="col-md-6 content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>My Requests</h2>

            </div>
            @if (Session::has('message'))
                <div class="alert alert-info">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="panel-body">
                @php
                    if (isset($parameters)) {
                        $fromDate = $parameters['fromDate'];
                        $toDate = $parameters['toDate'];
                        $type = $parameters['type'];
                    } else {
                        $fromDate = Carbon\Carbon::now()->format('Y-m-d');
                        $toDate = Carbon\Carbon::now()->format('Y-m-d');
                        $type = '';
                    }
                @endphp
                <form method="POST" action="{{ route('client.requests.filter') }}">
                    @csrf
                    <table class="table table-stripped table-borded">
                        <tbody>
                            <tr>
                                <th width>Investment Type</th>
                                <td>
                                    <select name="investment_type" id="investment_type" class="form-control" required>
                                        @php
                                            $investmenet_types = App\InvestmentType::get();
                                            
                                        @endphp
                                        <option value="" {{ $type == '' ? 'selected' : '' }}>Select Type</option>
                                        {{-- <option value="0" {{$type==0 ? 'selected' : ''}}  >Any</option> --}}
                                        @foreach ($investmenet_types as $investment)
                                            <option value="{{ $investment->id }}"
                                                {{ $type == $investment->id ? 'selected' : '' }}>{{ $investment->name }}
                                            </option>
                                        @endforeach
                                        <option value="4" {{ $type == 4 ? 'selected' : '' }}>Reverse Repo</option>
                                        <option value="0" {{ $type == 0 ? 'selected' : '' }}>Any</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>From Date</th>
                                <td>
                                    <input type="date" id="fromDate" name="fromDate" value="{{ $fromDate }}"
                                        class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <th>To Date</th>
                                <td>
                                    <input type="date" id="toDate" name="toDate" value="{{ $toDate }}"
                                        class="form-control">
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <button class="btn pull-right btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-10 content">

        @if ($withdraws)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2> Maturity Instruction Requests</h2>
                </div>
                <div class="panel-body">
                    <table class="table table-stripped">
                        <thead>
                            <tr class="bank-row">
                                <td>
                                </td>
                                <td>
                                    Instrument Type
                                </td>
                                <td>
                                    Ref No
                                </td>
                                <td>
                                    Value Date
                                </td>
                                <td>
                                    Maturity Date
                                </td>
                                <td>
                                    Invested Amount
                                </td>
                                <td>
                                    Maturity Amount
                                </td>
                                <td>
                                    Instruction
                                </td>
                                <td>
                                    Current Status
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($withdraws as $key => $withdraw)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td> {{ $withdraw->investment->InvestmentType->name }}</td>
                                    <td>{{ $withdraw->investment->ref_no }}</td>
                                    <td>{{ $withdraw->investment->value_date }}</td>
                                    <td>{{ $withdraw->investment->maturity_date }}</td>
                                    <td> @money($withdraw->investment->invested_amount)</td>
                                    <td> @money($withdraw->investment->matured_amount)</td>
                                    <td>{{ Config::get('constants.REQUEST_TYPES')[$withdraw->request_type] }}</td>
                                    <td>
                                        @if ($client->client_type == 3)
                                            @if ($withdraw->status == -2)
                                                Waiting For Signature B to be Approved!
                                            @elseif ($withdraw->status == -1)
                                                Waiting For Signature A to be Approved!
                                            @else
                                                {{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$withdraw->status] }}
                                            @endif
                                        @elseif ($client->client_type == 2)
                                            @if ($withdraw->status < 0)
                                                Waiting Joint Holder/Holders to Be Accept Your Request!
                                            @else
                                                {{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$withdraw->status] }}
                                            @endif
                                        @else
                                            {{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$withdraw->status] }}
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                No Records Found
                            @endforelse
                        </tbody>
                    </table>

                    {{ $withdraws->links() }}
                </div>

            </div>
        @endif
        @if ($reverseRepos)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2> Reverse Repo Requests</h2>
                </div>
                <div class="panel-body">
                    <table class="table table-stripped">
                        <thead>
                            <tr class="bank-row">
                            <tr class="bank-row">
                                <td>
                                </td>
                                <td>
                                    Instrument Type
                                </td>
                                <td>
                                    Ref No
                                </td>
                                <td>
                                    Value Date
                                </td>

                                <td>
                                    Maturity Date
                                </td>
                                <td>
                                    Amount Requested
                                </td>
                                <td>
                                    Invested Amount
                                </td>
                                <td>
                                    Maturity Amount
                                </td>

                                <td>
                                    Current Status
                                </td>
                            </tr>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reverseRepos as $key => $reverseRepo)
                                <tr>

                                    <td>{{ $key + 1 }}</td>
                                    <td> {{ $reverseRepo->investment->InvestmentType->name }}</td>
                                    <td>{{ $reverseRepo->investment->ref_no }}</td>
                                    <td>{{ $reverseRepo->investment->value_date }}</td>
                                    <td>{{ $reverseRepo->investment->maturity_date }}</td>
                                    <td>@money($reverseRepo->amount)</td>
                                    <td> @money($reverseRepo->investment->invested_amount)</td>
                                    <td> @money($reverseRepo->investment->matured_amount)</td>
                                    <td>
                                        @if ($client->client_type == 3)
                                            @if ($reverseRepo->status == -2)
                                                Waiting For Signature B to be Approved!
                                            @elseif ($reverseRepo->status == -1)
                                                Waiting For Signature A to be Approved!
                                            @else
                                                {{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$reverseRepo->status] }}
                                            @endif
                                        @elseif ($client->client_type == 2)
                                            @if ($reverseRepo->status < 0)
                                                Waiting Joint Holder/Holders to Be Accept Your Request!
                                            @else
                                                {{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$reverseRepo->status] }}
                                            @endif
                                        @else
                                            {{ Config::get('constants.WITHDRAW_REQUEST_STATUS')[$reverseRepo->status] }}
                                        @endif

                                    </td>




                                    {{-- <td>{{$reverseRepo->updated_at}}</td>
            
                  <td> {{$reverseRepo->investment->InvestmentType->name}} - @money($reverseRepo->investment->invested_amount) - Matured at -  {{$reverseRepo->investment->maturity_date}}</td>
                  <td>{{$reverseRepo->amount}}</td>
                  <td>{{$reverseRepo->maturity_date}}</td>
                  <td>
                    @if ($client->client_type == 3)
                        @if ($reverseRepo->status == -2)
                          Waiting For Signature B to be Approved!
                        @elseif ($reverseRepo->status == -1)
                          Waiting For Signature A to be Approved!
                        @else 
                        {{Config::get('constants.WITHDRAW_REQUEST_STATUS')[$reverseRepo->status]}}   
                        @endif
                    @elseif ($client->client_type==2)
                        @if ($reverseRepo->status < 0)
                        Waiting Joint Holder/Holders to Be Accept Your Request!
                        @else 
                        {{Config::get('constants.WITHDRAW_REQUEST_STATUS')[$reverseRepo->status]}}   
                        @endif

                    @else
                      {{Config::get('constants.WITHDRAW_REQUEST_STATUS')[$reverseRepo->status]}} 
                    @endif
                  
                  </td> --}}

                                </tr>
                            @empty
                                No Records Found
                            @endforelse

                        </tbody>



                    </table>

                    {{ $reverseRepos->links() }}
                </div>

            </div>
    </div>
    @endif

@endsection
@section('scripts')
    @parent
    <script>
        $("#fromDate").flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",

        });


        $("#toDate").flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",

        });
    </script>
@endsection
