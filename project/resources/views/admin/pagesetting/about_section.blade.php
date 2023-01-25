@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center py-3 justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('About Us') }}</h5>
    <ol class="breadcrumb m-0 py-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('General Settings') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ps.about') }}">{{ __('About Us') }}</a></li>
    </ol>
    </div>
</div>

  <div class="card mb-4 mt-3">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('About Us') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{route('admin.ps.update')}}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

          <div class="form-group">
            <label for="inp-title">{{  __('About Title')  }}</label>
            <input type="text" class="form-control" id="inp-title" name="about_title"  placeholder="{{ __('Enter About Title') }}" value="{{ $data->about_title }}" required>
          </div>

          <div class="form-group">
            <label for="error_text">{{ __('About Subtitle') }} *</label>
            <textarea class="form-control summernote"  id="error_text" name="about_text" required rows="3" placeholder="{{__('Enter About Text')}}">{{$data->about_text}}</textarea>
          </div>

          <div class="form-group">
            <label for="about_details">{{ __('About Description') }} *</label>
            <textarea class="form-control summernote"  id="about_details" name="about_details" required rows="7" placeholder="{{__('Enter About Description')}}">{{ $data->about_details }}</textarea>
          </div>

          <div class="form-group">
            <label>{{ __('Set Background Image') }} <small class="small-font">({{ __('Preferred Size 600 X 600') }})</small></label>
            <div class="wrapper-image-preview">
                <div class="box full-width">
                    <div class="back-preview-image" style="background-image: url({{ $data->about_photo ? asset('assets/images/'.$data->about_photo) : asset('assets/images/placeholder.jpg') }});"></div>
                    <div class="upload-options">
                        <label class="img-upload-label full-width" for="img-upload"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                        <input id="img-upload" type="file" class="image-upload" name="about_photo" accept="image/*">
                    </div>
                </div>
            </div>
          </div>

          <label for="about_link">{{  __('About Link')  }}</label>
            <input type="text" class="form-control" id="about_link" name="about_link"  placeholder="{{ __('Enter About Link') }}" value="{{ $data->about_link }}" required>
          </div>

          <div class="featured-keyword-area p-4">
            <div class="lang-tag-top-filds" id="lang-section">
                @if ($data->about_attributes)
                    @foreach (json_decode($data->about_attributes,true) as $key=>$data)
                        <div class="lang-area mb-3">
                            <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="about_attributes[]" placeholder="{{ __('Enter Anout Attribute') }}" value="{{ $data }}" required>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

            <a href="javascript:;" id="lang-btn" class="add-fild-btn d-flex justify-content-center"><i class="icofont-plus"></i> {{__('Add Attribute')}}</a>
          </div>


          <button type="submit" id="submit-btn" class="btn btn-primary mt-2 w-100">{{ __('Submit') }}</button>

      </form>
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
                                    '<input type="text" class="form-control" name="about_attributes[]" placeholder="{{ __('Enter About Attribute') }}" value="" required>'+
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