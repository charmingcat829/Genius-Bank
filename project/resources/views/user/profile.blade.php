@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Update Profile')}}
          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card p-3 py-4 px-sm-4">
                    @includeIf('includes.flash')
                    <form id="request-form" action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                          <div class="col-md-6 mx-auto">
                              <div class="form-group">
                                <label class="font-weight-bold">{{ __('Set Image') }} </label>
                                <div class="wrapper-image-preview">
                                    <div class="box">
                                        <div class="back-preview-image" style="background-image: url({{auth()->user()->photo ? asset('assets/images/'.auth()->user()->photo) : asset('assets/images/placeholder.jpg') }});"></div>
                                        <div class="upload-options">
                                            <label class="img-upload-label" for="img-upload"> <i class="fa fa-camera"></i> {{ __('Upload Picture') }} </label>
                                            <input id="img-upload" type="file" class="image-upload" name="photo" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>

                        <div class="row g-3">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label required">{{__('User Name')}}</label>
                              <input name="name" class="form-control form--control" autocomplete="off" placeholder="{{__('User Name')}}" type="text" value="{{ $user->name }}" required readonly>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label required">{{__('Email Address')}}</label>
                              <input name="email" class="form-control form--control" autocomplete="off" placeholder="{{__('Email Address')}}" type="email" value="{{ $user->email }}" required readonly>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label required">{{__('Phone Number')}}</label>
                              <input name="phone" class="form-control form--control" autocomplete="off" placeholder="{{__('Phone Number')}}" type="tel" value="{{ $user->phone }}" required>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label required">{{__('Zip')}}</label>
                              <input name="zip" class="form-control form--control" autocomplete="off" placeholder="{{__('Zip')}}" type="text" value="{{ $user->zip }}" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label required">{{__('City')}}</label>
                              <input name="city" class="form-control form--control" autocomplete="off" placeholder="{{__('City')}}" type="text" value="{{ $user->city }}" required>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="form-label required">{{__('Fax')}}</label>
                              <input name="fax" class="form-control form--control" autocomplete="off" placeholder="{{__('Fax')}}" type="text" value="{{ $user->fax }}" required>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-label required">{{__('Address')}}</label>
                              <input name="address" class="form-control form--control" autocomplete="off" placeholder="{{__('Address')}}" type="text" value="{{ $user->address }}" required>
                            </div>
                          </div>
                        </div>




                        <div class="form-footer">
                          <button type="submit" class="btn btn-primary submit-btn">{{__('Submit')}}</button>
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')
<script type="text/javascript">
  'use strict';
  
  $('.edit-profile').on('click',function(){
    $('.upload').click();

  });

</script>
@endpush
