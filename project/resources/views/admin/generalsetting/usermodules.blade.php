@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
        <h5 class=" mb-0 text-gray-800 pl-3">{{ __('User Modules') }} </h5>
        <ol class="breadcrumb py-0 m-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">{{ __('User Modules') }}</a></li>
        </ol>
    </div>
</div>

    <div class="card mb-4 mt-3">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('User Modules') }}</h6>
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{route('admin.gs.update')}}" method="POST" enctype="multipart/form-data">

            @include('includes.admin.form-both')

            {{ csrf_field() }}

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="user_module[]" value="Loan" {{ $data->moduleCheck('Loan') ? 'checked' : '' }} class="custom-control-input" id="Loan">
                  <label class="custom-control-label" for="Loan">{{__('Loan')}}</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="user_module[]" value="DPS" {{ $data->moduleCheck('DPS') ? 'checked' : '' }} class="custom-control-input" id="DPS">
                    <label class="custom-control-label" for="DPS">{{__('DPS')}}</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="user_module[]" value="FDR" {{ $data->moduleCheck('FDR') ? 'checked' : '' }} class="custom-control-input" id="FDR">
                    <label class="custom-control-label" for="FDR">{{__('FDR')}}</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="user_module[]" value="Request Money" {{ $data->moduleCheck('Request Money') ? 'checked' : '' }} class="custom-control-input" id="Request Money">
                  <label class="custom-control-label" for="Request Money">{{__('Request Money')}}</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="user_module[]" value="Deposit" {{ $data->moduleCheck('Deposit') ? 'checked' : '' }} class="custom-control-input" id="Deposit">
                    <label class="custom-control-label" for="Deposit">{{__('Deposit')}}</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="user_module[]" value="Wire Transfer" {{ $data->moduleCheck('Wire Transfer') ? 'checked' : '' }} class="custom-control-input" id="Wire Transfer">
                  <label class="custom-control-label" for="Wire Transfer">{{__('Wire Transfer')}}</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="user_module[]" value="Transfer" {{ $data->moduleCheck('Transfer') ? 'checked' : '' }} class="custom-control-input" id="Transfer">
                  <label class="custom-control-label" for="Transfer">{{__('Transfer')}}</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="user_module[]" value="Withdraw" {{ $data->moduleCheck('Withdraw') ? 'checked' : '' }} class="custom-control-input" id="Withdraw">
                  <label class="custom-control-label" for="Withdraw">{{__('Withdraw')}}</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="user_module[]" value="Pricing Plan" {{ $data->moduleCheck('Pricing Plan') ? 'checked' : '' }} class="custom-control-input" id="pricing_plan">
                    <label class="custom-control-label" for="pricing_plan">{{__('Pricing Plan')}}</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="user_module[]" value="More" {{ $data->moduleCheck('More') ? 'checked' : '' }} class="custom-control-input" id="more">
                    <label class="custom-control-label" for="more">{{__('More')}}</label>
                    </div>
                </div>
            </div>

          </div>
            

            <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>

@endsection
