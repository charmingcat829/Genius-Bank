@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="d-sm-flex align-items-center justify-content-between py-3">
  <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Wire Transfer Bank') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.wire.transfer.banks.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
  <ol class="breadcrumb py-0 m-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
      <li class="breadcrumb-item"><a href="{{route('admin.wire.transfer.banks.create')}}">{{ __('Add Wire Transfer Bank') }}</a></li>
  </ol>
  </div>
</div>

<div class="row justify-content-center mt-3">
<div class="col-md-10">
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Add Wire Transfer Bank Form') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{route('admin.wire.transfer.banks.store')}}" method="POST" enctype="multipart/form-data">

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
                    <label for="swift">{{ __('Swift Code') }}</label>
                    <input type="text" class="form-control" id="swift" name="swift_code" placeholder="{{ __('Enter Swift Code') }}" value="">
                </div>
              </div>
          </div>

          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="min_amount">{{ __('Minimum Price in') }} ({{$currency->name}})</label>
                    <input type="number" class="form-control" id="min_amount" name="min_amount" placeholder="{{ __('Enter Minimum Price') }}" min="1" step="0.01" value="" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <label for="max_amount">{{ __('Maximum Price in') }} ({{$currency->name}})</label>
                    <input type="number" class="form-control" id="max_amount" name="max_amount" placeholder="{{ __('Enter Maximum Price') }}" min="1" step="0.01" value="" required>
                </div>
              </div>
          </div>

          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="inp-name">{{ __('Currency') }}</label>
                    <select class="form-control js-example-basic-single mb-3" name="currency_id">
                      <option value="" selected>{{__('Select Currency')}}</option>
                        @foreach ($currencies as $key=>$data)
                        <option value="{{$data->id}}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <label for="inp-name">{{ __('Country') }}</label>
                    <select class="form-control js-example-basic-single mb-3" name="country_id">
                      <option value="" selected>{{__('Select Country')}}</option>
                        @foreach ($countries as $key=>$data)
                        <option value="{{$data->id}}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <label for="fixed">{{ __('Fixed Charge') }} ({{$currency->name}})</label>
                  <input type="number" class="form-control" id="fixed" name="fixed_charge" placeholder="{{ __('Enter Fixed Charge') }}" min="1" step="0.01" value="" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                  <label for="percentage">{{ __('Percentage Charge') }} (%)</label>
                  <input type="number" class="form-control" id="percentage" name="percentage_charge" placeholder="{{ __('Enter Percentage Charge') }}" min="0" step="0.01" value="" required>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <label for="routing">{{ __('Routing Number') }}</label>
                  <input type="number" class="form-control" id="routing" name="routing_number" placeholder="{{ __('Enter Routing Number') }}" min="0" step="0.01" value="" required>
              </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="inp-name">{{ __('Status') }}</label>
                    <select class="form-control mb-3" name="status">
                      <option value="1">{{__('activated')}}</option>
                      <option value="0">{{__('deactivated')}}</option>
                    </select>
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
      'use strict';
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
