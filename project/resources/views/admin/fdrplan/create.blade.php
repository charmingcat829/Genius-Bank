@extends('layouts.admin')

@section('content')

<div class="card">
  <div class="d-sm-flex align-items-center justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Add New Plan') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.fdr.plan.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.fdr.plan.index')}}">{{ __('FDR Plan') }}</a></li>
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
        <form class="geniusform" action="{{route('admin.fdr.plan.store')}}" method="POST" enctype="multipart/form-data">

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
                      <label for="interest_rate">{{ __('Interest Rate of Total Deposit') }} (%)</label>
                      <input type="number" class="form-control" id="interest_rate" name="interest_rate" placeholder="{{ __('Interest Rate of Total Deposit') }}" min="1" value="" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="interval_type">{{ __('Interest Interval Type') }}</label>
                      <select name="interval_type" class="form-control" id="interval_type">
                          <option value="fixed"> {{__('Fixed')}} </option>
                          <option value="partial"> {{__('Partial')}} </option>
                      </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                      <label for="matured_days">{{ __('Locked In Period') }}</label>
                      <input type="number" class="form-control" id="matured_days" name="matured_days" placeholder="{{ __('Locked In Period') }}" min="1" value="" required>
                    </div>
                </div>
            </div>

            <div class="row interval_time d-none">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="interest_interval">{{ __('Interval Time') }}</label>
                  <input type="number" class="form-control" id="interest_interval" name="interest_interval" placeholder="{{ __('Interval Time') }}" min="1" value="">
                </div>
              </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="min_amount">{{ __('Minimum Amount') }} ({{$currency->name}})</label>
                      <input type="number" class="form-control" id="min_amount" name="min_amount" placeholder="{{ __('Minimum Amount') }}" min="1" value="" required>
                    </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                      <label for="max_amount">{{ __('Maximum Amount') }} ({{$currency->name}})</label>
                      <input type="number" class="form-control" id="max_amount" name="max_amount" placeholder="{{ __('Maximum Amount') }}" min="1" value="" required>
                    </div>
                </div>
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

        $("#interval_type").on("change",function(){
          if($(this).val() == 'partial'){
            $(".interval_time").removeClass('d-none');
          }else{
            $(".interval_time").addClass('d-none');
          }
        })

    })(jQuery);

</script>
@endsection