@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center py-3 justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Apps Section') }}</h5>
    <ol class="breadcrumb m-0 py-0">
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Home Page Settings') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ps.apps') }}">{{ __('Apps Section') }}</a></li>
    </ol>
    </div>
</div>

    <div class="card mb-4 mt-3">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Apps Section') }}</h6>
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{route('admin.ps.update')}}" method="POST" enctype="multipart/form-data">

            @include('includes.admin.form-both')

            {{ csrf_field() }}

            <div class="form-group">
              <label for="inp-title">{{  __('Apps Title')  }}</label>
              <input type="text" class="form-control" id="inp-title" name="app_title"  placeholder="{{ __('Enter Apps Title') }}" value="{{ $data->app_title }}" required>
            </div>

            <div class="form-group">
              <label for="app_details">{{ __('Apps Description') }} *</label>
              <textarea class="form-control summernote"  id="app_details" name="app_details" required rows="7" placeholder="{{__('Enter Apps Description')}}">{{ $data->app_details }}</textarea>
            </div>

            <div class="form-group">
              <label>{{ __('Set Banner Image') }} <small class="small-font"></small></label>
              <div class="wrapper-image-preview">
                  <div class="box full-width">
                      <div class="back-preview-image" style="background-image: url({{ $data->app_banner ? asset('assets/images/'.$data->app_banner) : asset('assets/images/placeholder.jpg') }});"></div>
                      <div class="upload-options">
                          <label class="img-upload-label full-width" for="img-upload"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                          <input id="img-upload" type="file" class="image-upload" name="app_banner" accept="image/*">
                      </div>
                  </div>
              </div>
            </div>

            <div class="form-group">
                <label>{{ __('App Store Photo') }} <small class="small-font"></small></label>
                <div class="wrapper-image-preview">
                    <div class="box full-width">
                        <div class="back-preview-image" style="background-image: url({{ $data->app_store_photo ? asset('assets/images/'.$data->app_store_photo) : asset('assets/images/placeholder.jpg') }});"></div>
                        <div class="upload-options">
                            <label class="img-upload-label full-width" for="img-upload1"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                            <input id="img-upload1" type="file" class="image-upload1" name="app_store_photo" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="app_store_link">{{  __('About Store Link')  }}</label>
                  <input type="text" class="form-control" id="app_store_link" name="app_store_link"  placeholder="{{ __('Enter About Link') }}" value="{{ $data->app_store_link }}" required>
                </div>
            </div>

            <div class="form-group p-3">
                <label>{{ __('Google Play Photo') }} <small class="small-font"></small></label>
                <div class="wrapper-image-preview">
                    <div class="box full-width">
                        <div class="back-preview-image" style="background-image: url({{ $data->app_google_store ? asset('assets/images/'.$data->app_google_store) : asset('assets/images/placeholder.jpg') }});"></div>
                        <div class="upload-options">
                            <label class="img-upload-label full-width" for="img-upload2"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                            <input id="img-upload2" type="file" class="image-upload2" name="app_google_store" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group p-3">
                <label for="app_store_link">{{  __('About Store Link')  }}</label>
                  <input type="text" class="form-control" id="app_store_link" name="app_store_link"  placeholder="{{ __('Enter About Link') }}" value="{{ $data->app_store_link }}" required>
                </div>
            </div>


            <button type="submit" id="submit-btn" class="btn btn-primary mt-2 w-100">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>



@endsection

@section('scripts')

@endsection