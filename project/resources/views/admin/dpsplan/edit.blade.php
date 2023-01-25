@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="d-sm-flex align-items-center justify-content-between">
  <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Edit Plan') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.dps.plan.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
      <li class="breadcrumb-item"><a href="{{route('admin.dps.plan.index')}}">{{ __('DPS Plan') }}</a></li>
  </ol>
  </div>
</div>

<div class="row justify-content-center mt-3">
<div class="col-md-10">
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit Plan Form') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{route('admin.dps.plan.update',$data->id)}}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

          <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('Enter Title') }}" value="{{$data->title}}" required>
          </div>

          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="installment_interval">{{ __('Installment Interval') }}</label>
                    <input type="number" class="form-control" id="installment_interval" name="installment_interval" placeholder="{{ __('Installment Interval') }}" min="1" value="{{$data->installment_interval}}" required>
                  </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <label for="total_installment">{{ __('Total Installment') }}</label>
                    <input type="number" class="form-control" id="total_installment" name="total_installment" placeholder="{{ __('Total Installment') }}" min="1" value="{{$data->total_installment}}" required>
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="per_installment">{{ __('Per Installment') }}</label>
                    <input type="number" class="form-control" id="per_installment" name="per_installment" placeholder="{{ __('Per Installment') }}" min="1" value="{{$data->per_installment}}" required>
                  </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <label for="interest_rate">{{ __('Interest Rate of Total Deposit') }} %</label>
                    <input type="number" class="form-control" id="interest_rate" name="interest_rate" placeholder="{{ __('Interest Rate of Total Deposit') }}" min="1" value="{{$data->interest_rate}}" required>
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="final_amount">{{ __('Total Deposit') }} ({{$currency->name}})</label>
                    <input type="number" class="form-control" id="final_amount" name="final_amount" placeholder="{{ __('Total Deposit') }}" min="1" value="{{$data->final_amount}}" required readonly>
                  </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <label for="user_profit">{{ __('User Profit') }} ({{$currency->name}})</label>
                    <input type="number" class="form-control" id="user_profit" name="user_profit" placeholder="{{ __('User Profit') }}" min="1" value="{{$data->user_profit}}"" required readonly>
                  </div>
              </div>
          </div>

          <div>
            <h3 class="col-lg-12 d-none deposit-amount text-primary text-center">
                {{__('After mature, the user will get')}} : ({{$currency->name}}) <span class="text-primary"></span>
            </h3>
          </div>


          <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

      </form>
    </div>
  </div>
</div>

</div>

@endsection

@section('scripts')
<script>
    (function ($) {
        "use strict";

        $('#per_installment, #total_installment, #interest_rate').on('input', (e) => {

            let perInstallment      = Number($('#per_installment').val());
            let totalInstallment    = Number($('#total_installment').val());
            let interestRate        = Number($('#interest_rate').val());

            let totalAmount         = perInstallment * totalInstallment;
            let interest            = totalAmount * interestRate / 100;

            if(perInstallment && totalInstallment && interestRate){
                $('#final_amount').val(totalAmount);
                $('#user_profit').val(interest);
                $('.deposit-amount').removeClass( 'd-none' );
                $('.deposit-amount span').text(totalAmount + interest);
            }
        });

    })(jQuery);

</script>
@endsection