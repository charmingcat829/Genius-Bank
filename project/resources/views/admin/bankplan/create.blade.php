@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="d-sm-flex align-items-center justify-content-between">
  <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Add New Plan') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.bank.plan.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
      <li class="breadcrumb-item"><a href="javascript:;">{{ __('Bank Plan') }}</a></li>
  </ol>
  </div>
</div>

<div class="row justify-content-center mt-3">
<div class="col-md-10">
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Add New Plan Form') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{route('admin.bank.plan.store')}}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="title">{{ __('Title') }}</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('Enter Title') }}" value="" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="amount">{{ __('Amount') }}</label>
                <input type="number" class="form-control" id="amount" name="amount" placeholder="{{ __('Enter Amount (USD)') }}" min="0" value="" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="daily_send">{{ __('Maximum Send Money') }} ({{ __('Daily')}})</label>
                <input type="number" class="form-control" id="daily_send" name="daily_send" placeholder="{{ __('ex.1000 USD') }}" min="0" value="" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="monthly_send">{{ __('Maximum Send Money') }} ({{ __('Monthly')}})</label>
                <input type="number" class="form-control" id="monthly_send" name="monthly_send" placeholder="{{ __('ex.10000 USD') }}" min="0" value="" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="daily_receive">{{ __('Maximum Request Money') }} ({{ __('Daily')}})</label>
                <input type="number" class="form-control" id="daily_receive" name="daily_receive" placeholder="{{ __('ex.1000 USD') }}" min="0" value="" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="monthly_receive">{{ __('Maximum Request Money') }} ({{ __('Monthly')}})</label>
                <input type="number" class="form-control" id="monthly_receive" name="monthly_receive" placeholder="{{ __('ex.10000 USD') }}" min="0" value="" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="daily_withdraw">{{ __('Withdraw Amount') }} ({{ __('Daily')}})</label>
                <input type="number" class="form-control" id="daily_withdraw" name="daily_withdraw" placeholder="{{ __('ex.1000 USD') }}" min="0" value="" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="monthly_withdraw">{{ __('Withdraw Amount') }} ({{ __('Monthly')}})</label>
                <input type="number" class="form-control" id="monthly_withdraw" name="monthly_withdraw" placeholder="{{ __('ex.10000 USD') }}" min="0" value="" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="days">{{ __('Days') }}</label>
                <input type="number" class="form-control" id="days" name="days" placeholder="{{ __('Enter Days') }}" min="1" value="" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="loan_amount">{{ __('Maximum Loan Amount') }} ({{ __('Monthly')}})</label>
                <input type="number" class="form-control" id="loan_amount" name="loan_amount" placeholder="{{ __('Loan Amount (USD)') }}" min="1" value="" required>
              </div>
            </div>
          </div>



          <div class="featured-keyword-area">
            <div class="lang-tag-top-filds" id="lang-section">


            </div>

            <a href="javascript:;" id="lang-btn" class="add-fild-btn d-flex justify-content-center"><i class="icofont-plus"></i> {{__('Add Attribute')}}</a>
          </div>

          <button type="submit" id="submit-btn" class="btn btn-primary w-100 mt-2">{{ __('Submit') }}</button>

      </form>
    </div>
  </div>
</div>

</div>

@endsection

@section('scripts')
  <script type="text/javascript">
    "use strict";
    function isEmpty(el){
        return !$.trim(el.html())
    }


  $("#lang-btn").on('click', function(){

      $("#lang-section").append(''+
                                  '<div class="lang-area mb-3">'+
                                    '<span class="remove lang-remove"><i class="fas fa-times"></i></span>'+
                                    '<div class="row">'+
                                      '<div class="col-md-12">'+
                                      '<input type="text" class="form-control" name="attribute[]" placeholder="{{ __('Enter Plan Attribute') }}" value="" required>'+
                                      '</div>'+
                                    '</div>'+
                                  '</div>'+
                              '');

  });

  $(document).on('click','.lang-remove', function(){

      $(this.parentNode).remove();

  });

  </script>

@endsection
