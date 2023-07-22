`<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.permissions.index') }}"
                                    class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}"
                                    class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}"
                                    class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan

                        <!-- @can('team_access')
        <li class="nav-item">
                                                                                        <a href="{{ route('admin.teams.index') }}" class="nav-link {{ request()->is('admin/teams') || request()->is('admin/teams/*') ? 'active' : '' }}">
                                                                                            <i class="fa-fw fas fa-users nav-icon">

                                                                                            </i>
                                                                                            {{ trans('cruds.team.title') }}
                                                                                        </a>
                                                                                    </li>
    @endcan -->
                    </ul>
                </li>
            @endcan
            {{-- @can('asset_access')
                <li class="nav-item">
                    <a href="{{ route("admin.assets.index") }}" class="nav-link {{ request()->is('admin/assets') || request()->is('admin/assets/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs nav-icon">

                        </i>
                        {{ trans('cruds.asset.title') }}
                    </a>
                </li>
            @endcan --}}
            <!--   @can('stock_access')
    <li class="nav-item">
                                                <a href="{{ route('admin.stocks.index') }}" class="nav-link {{ request()->is('admin/stocks') || request()->is('admin/stocks/*') ? 'active' : '' }}">
                                                    <i class="fa-fw fas fa-cogs nav-icon">

                                                    </i>
                                                    {{ trans('cruds.stock.title') }}
                                                </a>
                                            </li>
@endcan -->
            @can('client_approval_access')
                <li class="nav-item">
                    <a href="{{ route('admin.clients.index') }}"
                        class="nav-link {{ request()->is('admin/clients') || request()->is('admin/clients/*') ? 'active' : '' }}">
                        <i class="fa fa-check-circle-o">

                        </i>
                        {{-- {{ trans('cruds.transaction.title') }} --}} Account Approval
                    </a>
                </li>
            @endcan
            @can('client_management_access')
                <li class="nav-item">
                    <a href="{{ route('admin.clients.management') }}"
                        class="nav-link {{ request()->is('admin/clients_management') || request()->is('admin/clients_management/*') ? 'active' : '' }}">
                        <i class="fa fa-address-book">

                        </i>
                        {{-- {{ trans('cruds.transaction.title') }} --}} Accounts
                    </a>
                </li>
            @endcan
            @can('sync_bank_records')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fa fa-superpowers nav-icon">

                        </i>
                        Data Sync
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a href="{{ route('admin.csv.index') }}"
                                class="nav-link {{ request()->is('admin/csv') || request()->is('admin/csv/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-database nav-icon">

                                </i>
                                Sync Tbill/TBond
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('admin.csv.repo.index') }}"
                                class="nav-link {{ request()->is('admin/repo/csv') || request()->is('admin/repo/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-database nav-icon">

                                </i>
                                Sync Repo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.existing.index') }}"
                                class="nav-link {{ request()->is('admin/existing') || request()->is('admin/existing/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-database nav-icon">

                                </i>
                                Sync old clients
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.bankRecords.view') }}"
                                class="nav-link {{ request()->is('admin/bankRecord') || request()->is('admin/bankRecord/*') ? 'active' : '' }}">
                                <i class="fa fa-fw fa-binoculars nav-icon">

                                </i>
                                View TBill/Bond
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.bankRepos.view') }}"
                                class="nav-link {{ request()->is('admin/bankRepos') || request()->is('admin/bankRepos/*') ? 'active' : '' }}">
                                <i class="fa fa-fw fa-binoculars nav-icon">

                                </i>
                                View Repos
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('transaction_access')
                <li class="nav-item">
                    <a href="{{ route('admin.noninstructed.index') }}"
                        class="nav-link {{ request()->is('admin/noninstructed') || request()->is('admin/noninstructed/*') ? 'active' : '' }}">
                        <i class="fa fa-hand-lizard-o">

                        </i>
                        Instruction-less Records
                    </a>
                </li>
            @endcan
            @can('transaction_access')
                <li class="nav-item">
                    <a href="{{ route('admin.withdraw.index') }}"
                        class="nav-link {{ request()->is('admin/withdraws') || request()->is('admin/withdraws/*') ? 'active' : '' }}">
                        <i class="fa fa-hand-lizard-o">

                        </i>
                        {{--   {{ trans('cruds.transaction.title') }} --}} Maturity Instruction
                    </a>
                </li>
            @endcan
            @can('transaction_access')
                <li class="nav-item">
                    <a href="{{ route('admin.reverseRepo.index') }}"
                        class="nav-link {{ request()->is('admin/settleReverseRepo') || request()->is('admin/ReveserRepo/*') ? 'active' : '' }}">
                        <i class="fa fa-reply">

                        </i>
                        {{--   {{ trans('cruds.transaction.title') }} --}} ReverseRepo Requests
                    </a>
                </li>
            @endcan
            @can('transaction_access')
                <li class="nav-item">
                    <a href="{{ route('admin.settleReverseRepo.index') }}"
                        class="nav-link {{ request()->is('admin/settleReverseRepo') || request()->is('admin/settleReverseRepo/*') ? 'active' : '' }}">
                        <i class="fa fa-reply">

                        </i>
                        {{--   {{ trans('cruds.transaction.title') }} --}} Settle ReverseRepo
                    </a>
                </li>
            @endcan
            @can('client_management_access')
                <li class="nav-item">
                    <a href="{{ route('admin.newInvestment.index') }}"
                        class="nav-link {{ request()->is('admin/investmentRequest') || request()->is('admin/investmentRequest/*') ? 'active' : '' }}">
                        <i class="fa fa-id-card">

                        </i>
                        {{-- {{ trans('cruds.transaction.title') }} --}} Investments Approval
                    </a>
                </li>
            @endcan
            @can('step_investment')
                <li class="nav-item">
                    <a href="{{ route('admin.stepControlling.investments.view') }}"
                        class="nav-link {{ request()->is('adminstepControlling/investments') || request()->is('admin/stepControlling/investments/*') ? 'active' : '' }}">
                        <i class="fa fa-level-down">

                        </i>
                        {{-- {{ trans('cruds.transaction.title') }} --}} Stepping Status Investments
                    </a>
                </li>
            @endcan
            @can('bid_for_auction')
                <li class="nav-item">
                    <a href="{{ route('admin.bids') }}"
                        class="nav-link {{ request()->is('admin/bids') || request()->is('admin/bids/*') ? 'active' : '' }}">
                        <i class="fa fa-microphone">

                        </i>
                        Bid Approval
                        {{-- {{ trans('cruds.transaction.title') }} --}}
                    </a>
                </li>
            @endcan
            @can('bid_for_auction')
                <li class="nav-item">
                    <a href="{{ route('admin.bid.index') }}"
                        class="nav-link {{ request()->is('admin/banks') || request()->is('admin/banks/*') ? 'active' : '' }}">
                        <i class="fa fa-upload">

                        </i>
                        Bid For Auction Upload
                    </a>
                </li>
            @endcan
            @can('client_management_access')
                <li class="nav-item">
                    <a href="{{ route('admin.changes.index') }}"
                        class="nav-link {{ request()->is('admin/changes') || request()->is('admin/changes/*') ? 'active' : '' }}">
                        <i class="fa fa-reply">

                        </i>
                        Info Change Requests
                    </a>
                </li>
            @endcan

            @can('client_management_access')
                <li class="nav-item">
                    <a href="{{ route('admin.investment.info') }}"
                        class="nav-link {{ request()->is('admin/investmentInfo') || request()->is('admin/investmentInfo/*') ? 'active' : '' }}">
                        <i class="fa fa-print">

                        </i>
                        Investment Info
                    </a>
                </li>
            @endcan
            @can('client_management_access')
                <li class="nav-item">
                    <a href="{{ route('admin.bid.info') }}"
                        class="nav-link {{ request()->is('admin/bidInfo') || request()->is('admin/bidInfo/*') ? 'active' : '' }}">
                        <i class="fa fa-print">

                        </i>
                        Bids Info
                    </a>
                </li>
            @endcan

            @can('client_management_access')
                <li class="nav-item">
                    <a href="{{ route('admin.allRequest') }}"
                        class="nav-link {{ request()->is('admin/allRequests') || request()->is('admin/allRequest/*') ? 'active' : '' }}">
                        <i class="fa fa-binoculars">

                        </i>
                        View Requests
                    </a>
                </li>
            @endcan

            @can('client_management_access')
                <li class="nav-item">
                    <a href="{{ route('admin.banks.index') }}"
                        class="nav-link {{ request()->is('admin/banks') || request()->is('admin/banks/*') ? 'active' : '' }}">
                        <i class="fa fa-university">

                        </i>
                        {{-- {{ trans('cruds.transaction.title') }} --}} Banks & Branches
                    </a>
                </li>
            @endcan
            @can('inquiry_access')
                <li class="nav-item">
                    <a href="{{ route('admin.inquiries.index') }}"
                        class="nav-link {{ request()->is('admin/inquiries') || request()->is('admin/inquiries/*') ? 'active' : '' }}">
                        <i class="fa fa-volume-control-phone">

                        </i>
                        {{-- {{ trans('cruds.transaction.title') }} --}} Client Inquiries
                    </a>
                </li>
            @endcan
            @can('step_investment')
                <li class="nav-item">
                    <a href="{{ route('admin.otps.view') }}"
                        class="nav-link {{ request()->is('liveOtp/get') || request()->is('liveOtp/*') ? 'active' : '' }}">
                        <i class="fa fa-user-secret">

                        </i>
                        {{-- {{ trans('cruds.transaction.title') }} --}} Live OTP
                    </a>
                </li>
            @endcan
            @can('client_management_access')
                <li class="nav-item">
                    <a href="{{ route('admin.userGuide.index') }}"
                        class="nav-link {{ request()->is('admin/userGuide') || request()->is('admin/userGuide/*') ? 'active' : '' }}">
                        <i class="fa fa-hand-pointer-o">

                        </i>
                        {{-- {{ trans('cruds.transaction.title') }} --}} User Guide
                    </a>
                </li>
            @endcan
            @if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}"
                            href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
