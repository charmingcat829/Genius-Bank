@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Edit Homepage Customization') }} </h5>
    <ol class="breadcrumb py-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Manage Homepage Customization') }}</a></li>
    </ol>
    </div>
</div>

    <div class="card mb-4 mt-3">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit Homepage Customization') }}</h6>
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{route('admin.ps.customization.update')}}" method="POST" enctype="multipart/form-data">

            @include('includes.admin.form-both')

            {{ csrf_field() }}

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="home_module[]" value="Banner" {{ $data->homeModuleCheck('Banner') ? 'checked' : '' }} class="custom-control-input" id="Banner">
                  <label class="custom-control-label" for="Banner">{{__('Banner')}}</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="home_module[]" value="Feature" {{ $data->homeModuleCheck('Feature') ? 'checked' : '' }} class="custom-control-input" id="Feature">
                    <label class="custom-control-label" for="Feature">{{__('Feature')}}</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="home_module[]" value="About" {{ $data->homeModuleCheck('About') ? 'checked' : '' }} class="custom-control-input" id="About">
                  <label class="custom-control-label" for="About">{{__('About')}}</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input type="checkbox" name="home_module[]" value="Service" {{ $data->homeModuleCheck('Service') ? 'checked' : '' }} class="custom-control-input" id="Service">
                  <label class="custom-control-label" for="Service">{{__('Service')}}</label>
                  </div>
              </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="home_module[]" value="How It Works" {{ $data->homeModuleCheck('How It Works') ? 'checked' : '' }} class="custom-control-input" id="How It Works">
                    <label class="custom-control-label" for="How It Works">{{__('How It Works')}}</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="home_module[]" value="Plan" {{ $data->homeModuleCheck('Plan') ? 'checked' : '' }} class="custom-control-input" id="Plan">
                        <label class="custom-control-label" for="Plan">{{__('Plan')}}</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="home_module[]" value="Apps" {{ $data->homeModuleCheck('Apps') ? 'checked' : '' }} class="custom-control-input" id="Apps">
                        <label class="custom-control-label" for="Apps">{{__('Apps')}}</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="home_module[]" value="Testimonials" {{ $data->homeModuleCheck('Testimonials') ? 'checked' : '' }} class="custom-control-input" id="Testimonials">
                        <label class="custom-control-label" for="Testimonials">{{__('Testimonials')}}</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="home_module[]" value="Counter" {{ $data->homeModuleCheck('Counter') ? 'checked' : '' }} class="custom-control-input" id="Counter">
                        <label class="custom-control-label" for="Counter">{{__('Counter')}}</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="home_module[]" value="CTAs" {{ $data->homeModuleCheck('CTAs') ? 'checked' : '' }} class="custom-control-input" id="CTAs">
                        <label class="custom-control-label" for="CTAs">{{__('CTAs')}}</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="home_module[]" value="Blogs" {{ $data->homeModuleCheck('Blogs') ? 'checked' : '' }} class="custom-control-input" id="Blogs">
                        <label class="custom-control-label" for="Blogs">{{__('Blogs')}}</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="home_module[]" value="FAQs" {{ $data->homeModuleCheck('FAQs') ? 'checked' : '' }} class="custom-control-input" id="FAQs">
                        <label class="custom-control-label" for="FAQs">{{__('FAQs')}}</label>
                    </div>
                </div>
            </div>

          </div>



            <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>

@endsection
