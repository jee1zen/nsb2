<!DOCTYPE html>
<html>

<head>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link href="{{ asset('css/client.css') }}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
    <!------ Include the above in your HEAD tag ---------->
    <title>NSBFM Client Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/fmc.jpg') }}">

    <style>
        .welcome-note {
            text-align: center;
            background-color: #ffb000;
            padding: 10px 0;
        }
    </style>
</head>

<body class="client-dashboad-body">
    @php
        $user = Auth::user();
        $role = $user->roles()->first()->id;
        if ($role == 4) {
            $client = App\Client::findOrFail($user->id);
            $client_id = $client->id;
            $mainClient = $client;
            if (!$user->hasSelectedAccount()) {
                $selectedAccount = 0;
                $account_id = 0;
                $account = $mainClient->accounts()->first();
            } else {
                $_selectedAccount = $user->selectedAccount;
                // dd($_selectedAccount);
                $selectedAccount = $_selectedAccount->account_id;
                $account = App\Account::findOrFail($selectedAccount);
                $account_id = $account->id;
                if ($account->type == 2) {
                    $account_name = $client->name . ' & ' . $client->jointHolders()->first()->name . ' (Joint Account)';
                } else {
                    $account_name = $client->name . ' (Individual)';
                }
            }
        } elseif ($role == 10) {
            $client = $user->jointHolder;
            $client_id = $user->id;
            $mainClient = $client->client;
            $mainClientUser = $mainClient->user;
            if (!$user->hasSelectedAccount()) {
                $selectedAccount = 0;
                $account_id = 0;
            } else {
                $_selectedAccount = $user->selectedAccount;
                // dd($_selectedAccount);
                $selectedAccount = $_selectedAccount->account_id;
                $account = App\Account::findOrFail($selectedAccount);
                $account_id = $account->id;
            }
        
            $account_name = $client->name . ' & ' . $mainClient->name . ' (Joint Acccount) ';
        } else {
            $client = App\CompanySignature::where('user_id', '=', $user->id);
        }
        // dd($user->hasSelectedAccount());
    @endphp
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
                    MENU
                </button>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <div class="user-thumbnail">
                        @if ($role == 4)
                            <img src="{{ asset('storage/uploads/' . $client->pro_pic) }}" class="img-fluid"
                                width="100%" height="auto" alt="Responsive image">
                        @elseif($role == 10)
                            <img src="{{ asset('storage/uploads/' . $client->pro_pic) }}" class="img-fluid"
                                width="100%" height="auto" alt="Responsive image">
                        @else
                            <img src="{{ asset('img/default-user-image.png') }}" class="img-fluid" width="100%"
                                height="auto" alt="Responsive image">
                        @endif
                    </div>
                    <div class="title-name">{{ $account_name ?? 'Selecting..' }}</div>

                    {{-- <label for="" class="badge badge-light badge-lg ms-3" id="account_label">
                        @if ($account_id != 0)
                            {{ $account->id }}
                            {{ Config::get('constants.CLIENT_TYPE')[$account->type] }}
                        @endif

                    </label> --}}

                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                {{-- <form class="navbar-form navbar-left" method="GET" role="search">
				<div class="form-group">
					<input type="text" name="q" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
			</form> --}}


                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a id="accountChangeBtn" class="btn btn-default" style="background-color:transparent"><i
                                class="glyphicon glyphicon-transfer"></i>Account</a>
                    </li>

                    <li>
                        <p class="last-login">Last Login :
                            {{ \Carbon\Carbon::parse($user->last_login)->format('d m Y g:i:s A') }}</p>
                    </li>

                    @php
                        $userGuide = App\UserManual::find(1);
                    @endphp
                    <a href="{{ asset('/storage/uploads/' . $userGuide->doc) }}" target="_blank"
                        class="btn btn-default btn-lg" style="background-color:transparent"><i
                            class="glyphicon glyphicon-info-sign"></i></a>
                    <a href="{{ route('profile.password.edit') }}" class="btn btn-default btn-lg"
                        style="background-color:transparent"><i class="glyphicon glyphicon-cog"></i></a>
                    <a href="javascript:void" onclick="$('#logout-form').submit();" class="btn btn-default btn-lg"
                        style="background-color:transparent"><i class="glyphicon glyphicon-off"></i></a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-2 sidebar">
                <div class="">
                    <div class="absolute-wrapper"> </div>
                    <!-- Menu -->
                    <div class="side-menu">



                        <nav class="navbar navbar-default" role="navigation">
                            <!-- Main Menu -->
                            <div class="side-menu-container">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="{{ route('client.dashboard') }}"><span
                                                class="glyphicon glyphicon-dashboard"></span>Dashboard</a></li>
                                    @if ($role == 4 && $account->status == 9)
                                        <li><a href="{{ route('client.allAccounts') }}"><span
                                                    class="glyphicon glyphicon-briefcase"></span>Account Management</a>
                                        </li>
                                        {{-- <li><a href="{{route('client.reverseRepo.create')}}"><span class="glyphicon glyphicon-import"></span>Obtain A Reverse Repo</a></li> --}}
                                    @endif
                                    @if ($role == 4 && $account->status >= 8)
                                        <li><a href="{{ route('client.investment.index') }}"><span
                                                    class="glyphicon glyphicon-plus"></span>Add Investment </a></li>
                                        <li><a href="{{ route('client.bid') }}"><span
                                                    class="glyphicon glyphicon-user"></span>Bid for Auction</a></li>
                                    @endif
                                    @if ($role == 4 && $account->status == 9)
                                        {{-- <li><a href="{{ route('client.reverseRepo.create') }}"><span
                                                    class="glyphicon glyphicon-import"></span>Obtain A Reverse Repo</a>
                                        </li> --}}
                                        {{-- <li><a href="{{route('client.reverseRepo.create')}}"><span class="glyphicon glyphicon-import"></span>Obtain A Reverse Repo</a></li> --}}
                                    @endif

                                    <li class=""><a href="{{ route('client.history') }}"><span
                                                class="glyphicon glyphicon-dashboard"></span>Transaction History</a>
                                    </li>
                                    @if ($role == 4 && $account->status == 9)
                                        <li><a href="{{ route('client.fundRequest.form') }}"><span
                                                    class="glyphicon glyphicon-send"></span>Maturity Instruction </a>
                                        </li>
                                        <li><a href="{{ route('client.requests') }}"><span
                                                    class="glyphicon glyphicon-usd"></span>My Requests </a></li>

                                        {{-- <li><a href="{{route('client.settleReverseRepo.create')}}"><span class="glyphicon glyphicon-export"></span>Settle ReverseRepo</a></li> --}}
                                    @endif

                                    {{-- <li><a href="#"><span class="glyphicon glyphicon-plane"></span> Active Link</a></li> --}}



                                    @if ($role == 4 && $account->status == 9)
                                        <li><a href="{{ route('client.investment.list') }}"><span
                                                    class="glyphicon glyphicon-usd"></span>My Investment Requests </a>
                                        </li>
                                        <li><a href="{{ route('client.bid.list') }}"><span
                                                    class="glyphicon glyphicon-user"></span>My Bids</a></li>
                                    @endif



                                    @if ($role == 4 && $account->status == 9)
                                        <li><a href="{{ route('client.bankAccounts.view') }}"><span
                                                    class="glyphicon glyphicon-th-list"></span>Bank Accounts</a></li>
                                        {{-- <li><a href="{{route('client.blank')}}"><span class="glyphicon glyphicon-user"></span> e-Statements</a></li> --}}
                                        <li><a href="{{ route('client.profile') }}"><span
                                                    class="glyphicon glyphicon-user"></span>Profile</a></li>
                                        <li><a href="{{ route('client.inquiries') }}"><span
                                                    class="glyphicon glyphicon-user"></span>Inquiries</a></li>
                                    @endif
                                    @php
                                        if ($user->hasClient()) {
                                            $is_signatureB = $user->client->is_signatureB;
                                        } else {
                                            $is_signatureB = 0;
                                        }
                                    @endphp


                                    @if ($role == 8 || $role == 9 || $is_signatureB == 1 || ($role == 10 && $account->joint_permission == 1))
                                        <li><a href="{{ route('client.requests.proceed') }}"><span
                                                    class="glyphicon glyphicon-th-list"></span>Maturity Requests</a>
                                        </li>
                                        <li><a href="{{ route('client.reverseRepo.proceed') }}"><span
                                                    class="glyphicon glyphicon-th-list"></span>ReverseRepo Requests</a>
                                        </li>
                                        <li><a href="{{ route('client.settleReverseRepo.proceed') }}"><span
                                                    class="glyphicon glyphicon-th-list"></span>Settle ReverseRepo
                                                Requests</a></li>
                                        <li><a href="{{ route('client.investment.proceed') }}"><span
                                                    class="glyphicon glyphicon-th-list"></span>Investment Requests</a>
                                        </li>
                                        <li><a href="{{ route('client.bid.proceed') }}"><span
                                                    class="glyphicon glyphicon-th-list"></span>Bid Requests</a></li>
                                    @endif
                                    {{-- @if ($role == 10 && $mainClient->joint_permission == 1)
					 
					<li><a href="{{route('client.requests.proceed')}}"><span class="glyphicon glyphicon-th-list"></span> Requests Actions</a></li>
					@endif --}}
                                    {{-- <li><a href="{{route('client.profileEdit')}}"><span class="glyphicon glyphicon-user"></span>Edit Profile</a></li> --}}

                                    {{-- <li><a href="#"><span class="glyphicon glyphicon-cloud"></span> Link</a></li> --}}

                                    <!-- Dropdown-->
                                    {{-- <li class="panel panel-default" id="dropdown">
						<a data-toggle="collapse" href="#dropdown-lvl1">
							<span class="glyphicon glyphicon-user"></span> Sub Level <span class="caret"></span>
						</a>

						<!-- Dropdown level 1 -->
						<div id="dropdown-lvl1" class="panel-collapse collapse">
							<div class="panel-body">
								<ul class="nav navbar-nav">
									<li><a href="#">Link</a></li>
									<li><a href="#">Link</a></li>
									<li><a href="#">Link</a></li>

									<!-- Dropdown level 2 -->
									<li class="panel panel-default" id="dropdown">
										<a data-toggle="collapse" href="#dropdown-lvl2">
											<span class="glyphicon glyphicon-off"></span> Sub Level <span class="caret"></span>
										</a>
										<div id="dropdown-lvl2" class="panel-collapse collapse">
											<div class="panel-body">
												<ul class="nav navbar-nav">
													<li><a href="#">Link</a></li>
													<li><a href="#">Link</a></li>
													<li><a href="#">Link</a></li>
												</ul>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</li>

					<li><a href="#"><span class="glyphicon glyphicon-signal"></span> Link</a></li> --}}

                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </nav>

                    </div>
                </div>
            </div>
            @yield('content')
        </div>
        <div class="modal fade" id="accountSelectModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"> Please Select an Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="">Account</label>
                        @if ($role == 10)
                            <select name="account" id="account" class="form-control">
                                @foreach ($mainClient->activeAccounts()->get() as $account)
                                    @if ($account->type == 2)
                                        <option value="{{ $account->id }}">
                                            {{ $client->name . ' & ' . $account->client->name . '(Main holder)' }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        @else
                            <select name="account" id="account" class="form-control">
                                @foreach ($mainClient->activeAccounts()->get() as $account)
                                    <option value="{{ $account->id }}">
                                        {{ $account->type == 2
                                            ? $account->client->name .
                                                ' & ' .
                                                $mainClient->jointHolders()->first()->name .
                                                '
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                (Joint Account)'
                                            : $account->client->name . ' (individual)' }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btnAccountProceed" class="btn btn-primary">Proceed</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <footer class="text-center footer">
        <div class="row">
            <p class="col-md-12 footer-text">
                Copyright &COPY; {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', now())->year }} <a
                    href="">NSB FM </a>
            </p>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
    <script>
        $(function() {
            let selectedAccount = {{ $selectedAccount }};
            console.log(selectedAccount);

            if (selectedAccount == 0) {
                $("#accountSelectModal").modal("show");
            }

            $('#btnAccountProceed').click(function() {
                let account_id = $('#account').val();
                let client_id = {{ $client_id }};
                var data = {
                    "account_id": account_id,
                    "client_id": client_id,
                    "_token": "{{ csrf_token() }}"
                }; //data to send to server
                var dataType = "json" //expected datatype from server

                $.post({
                    url: "{{ route('client.setAccount') }}", //url of the server which stores time data
                    data: data,

                    success: function(data) {
                        if (data.success) {

                            $("#accountSelectModal").modal("hide");
                            location.reload();
                        } else {
                            alertify.error(
                                'Could not select account'
                            );
                        }
                    }
                });

            });

            $('#accountChangeBtn').click(function() {
                    $("#accountSelectModal").modal("show");
                }



            );


            $('.navbar-toggle-sidebar').click(function() {
                $('.navbar-nav').toggleClass('slide-in');
                $('.side-body').toggleClass('body-slide-in');
                $('#search').removeClass('in').addClass('collapse').slideUp(200);
            });

            $('#search-trigger').click(function() {
                $('.navbar-nav').removeClass('slide-in');
                $('.side-body').removeClass('body-slide-in');
                $('.search-input').focus();
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
