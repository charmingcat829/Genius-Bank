<div class="navbar-expand-xl">
    <div class="collapse navbar-collapse" id="navbar-menu">
      <div class="navbar navbar-light">
        <div class="container-xl">
          <ul class="navbar-nav">
            <li class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
              <a class="nav-link" href="{{route('user.dashboard')}}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                </span>
                <span class="nav-link-title">
                  @lang('Home')
                </span>
              </a>
            </li>

            @php
              $modules = explode(" , ", $gs->user_module);
            @endphp

            @if (!in_array('Loan',$modules))
              <li class="nav-item dropdown {{ request()->routeIs('user.loans.plan') || request()->routeIs('user.loans.index') || request()->routeIs('user.loans.pending') || request()->routeIs('user.loans.paid') || request()->routeIs('user.loans.rejected') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-cash-register"></i>
                  </span>
                  <span class="nav-link-title">
                    {{__('Loan')}}
                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('user.loans.plan')}}" >
                    {{__('Loan Plan')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.loans.index')}}" >
                    {{__('All Loans')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.loans.pending')}}" >
                    {{__('Pending Loans')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.loans.running')}}" >
                    {{__('Running Loans')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.loans.paid')}}" >
                    {{__('Paid Loans')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.loans.rejected')}}" >
                    {{__('Rejected Loans')}}
                  </a>
                </div>
              </li>
            @endif

            @if (!in_array('DPS',$modules))
              <li class="nav-item dropdown {{ request()->routeIs('user.dps.plan') || request()->routeIs('user.dps.index') || request()->routeIs('user.dps.running') || request()->routeIs('user.dps.matured') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-warehouse"></i>
                  </span>
                  <span class="nav-link-title">
                    {{__('DPS')}}
                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('user.dps.plan')}}" >
                    {{__('Dps Plan')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.dps.index')}}" >
                    {{__('All dps')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.dps.running')}}" >
                    {{__('Running dps')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.dps.matured')}}" >
                    {{__('Matured dps')}}
                  </a>

                </div>
              </li>
            @endif

            @if (!in_array('FDR',$modules))
              <li class="nav-item dropdown {{ request()->routeIs('user.fdr.plan') || request()->routeIs('user.fdr.index') || request()->routeIs('user.fdr.running') || request()->routeIs('user.fdr.closed') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-user-shield"></i>
                  </span>
                  <span class="nav-link-title">
                    {{__('FDR')}}
                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('user.fdr.plan')}}" >
                    {{__('Fdr Plan')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.fdr.index')}}" >
                    {{__('All Fdr')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.fdr.running')}}" >
                    {{__('Running Fdr')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.fdr.closed')}}" >
                    {{__('Closed Fdr')}}
                  </a>
                </div>
              </li>
            @endif

            @if (!in_array('Request Money',$modules))
              <li class="nav-item dropdown {{ request()->routeIs('user.money.request.index') || request()->routeIs('user.request.money.receive') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-file-signature"></i>
                  </span>
                  <span class="nav-link-title">
                    {{__('Request Money')}}
                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('user.money.request.index')}}" >
                    {{__('Send Request Money')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.request.money.receive')}}" >
                    {{__('Receive Request Money')}}
                  </a>
                </div>
              </li>
            @endif

            @if (!in_array('Deposit',$modules))
              <li class="nav-item {{ request()->routeIs('user.deposit.index') ? 'active' : '' }}">
                  <a class="nav-link" href="{{route('user.deposit.index')}}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <i class="fas fa-hand-holding-usd"></i>
                    </span>
                    <span class="nav-link-title">
                      {{__('Deposit')}}
                    </span>
                  </a>
              </li>
            @endif

            @if (!in_array('Wire Transfer',$modules))
              <li class="nav-item {{ request()->routeIs('user.wire.transfer.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('user.wire.transfer.index')}}" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-tram"></i>
                  </span>
                  <span class="nav-link-title">
                    {{__('Wire Transfer')}}
                  </span>
                </a>
              </li>
            @endif

            @if (!in_array('Transfer',$modules))
              <li class="nav-item dropdown {{ request()->routeIs('send.money.create') || request()->routeIs('user.beneficiaries.index') || request()->routeIs('user.other.bank') || request()->routeIs('tranfer.logs.index') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-exchange-alt"></i>
                  </span>
                  <span class="nav-link-title">
                    {{__('Transfer')}}
                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('send.money.create')}}" >
                    {{__('Send Money')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.beneficiaries.index')}}" >
                    {{__('Beneficiary Manage')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.other.bank')}}" >
                    {{__('Other Bank Transfer')}}
                  </a>

                  <a class="dropdown-item" href="{{ route('tranfer.logs.index') }}" >
                    {{__('Transfer History')}}
                  </a>
                </div>
              </li>
            @endif

            @if ($gs->withdraw_status == 1)
              @if (!in_array('Withdraw',$modules))
                <li class="nav-item {{ request()->routeIs('user.withdraw.index') ? 'active' : '' }}">
                  <a class="nav-link" href="{{route('user.withdraw.index')}}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <i class="fas fa-file-signature"></i>
                    </span>
                    <span class="nav-link-title">
                      {{__('Withdraw')}}
                    </span>
                  </a>
                </li>
              @endif
            @endif

            @if (!in_array('Pricing Plan',$modules))
              <li class="nav-item {{ request()->routeIs('user.package.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('user.package.index')}}" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fab fa-affiliatetheme"></i>
                  </span>
                  <span class="nav-link-title">
                    {{__('Pricing Plan')}}
                  </span>
                </a>
              </li>
            @endif

            @if (!in_array('More',$modules))
              <li class="nav-item dropdown {{ request()->routeIs('user.show2faForm') || request()->routeIs('user.referral.index') || request()->routeIs('user.referral.commissions') || request()->routeIs('user.message.index') || request()->routeIs('user.other.bank') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-suitcase"></i>
                  </span>
                  <span class="nav-link-title">
                    {{__('More')}}
                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('user.show2faForm')}}" >
                    {{__('2FA Security')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.referral.index')}}" >
                    @lang('Referred Users')
                  </a>

                  <a class="dropdown-item" href="{{ route('user.referral.commissions') }}" >
                    @lang('Referral Commissions')
                  </a>

                  <a class="dropdown-item" href="{{route('user.message.index')}}" >
                    {{__('Support Tickets')}}
                  </a>

                  <a class="dropdown-item" href="{{route('user.transaction')}}" >
                    {{__('Transactions')}}
                  </a>
                </div>
              </li>
            @endif

          </ul>
        </div>
      </div>
    </div>
  </div>