@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Section Heading') }}</h5>
    <ol class="breadcrumb py-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Home Page Manage') }}</a></li>
    </ol>
    </div>
</div>

    <div class="card mb-4 mt-3">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Section Heading') }}</h6>
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{route('admin.ps.update')}}" method="POST" enctype="multipart/form-data">

            @include('includes.admin.form-both')

            {{ csrf_field() }}
            <div class="form-group">
              <label for="service-title">{{ __('Service Title') }} *</label>
              <input type="text" class="form-control" id="service-title" name="service_title"  placeholder="{{ __('Service Title') }}" value="{{ $data->service_title }}" required>
            </div>

            <div class="form-group">
              <label for="text">{{ __('Service Subtitle') }} *</label>
              <textarea name="service_subtitle" id="text" cols="30" rows="5" class="form-control summernote" placeholder="{{ __('Service Subtitle') }}" required>{{ $ps->service_subtitle }} </textarea>
            </div>

            <div class="form-group">
              <label for="plan-title">{{ __('Plan Title') }} *</label>
              <input type="text" class="form-control" id="plan-title" name="plan_title"  placeholder="{{ __('Plan Title') }}" value="{{ $data->plan_title }}" required>
            </div>

            <div class="form-group">
              <label for="plan-subtitle">{{ __('Plan Subtitle') }} *</label>
              <textarea name="plan_subtitle" id="plan-subtitle" cols="30" rows="5" class="form-control summernote" placeholder="{{ __('Plan Subtitle') }}" required>{{ $ps->plan_subtitle }} </textarea>
            </div>

            <div class="form-group">
              <label for="review-title">{{ __('Testimonial Title') }} *</label>
              <input type="text" class="form-control" id="review-title" name="review_title"  placeholder="{{ __('Testimonial Title') }}" value="{{ $data->review_title }}" required>
            </div>

            <div class="form-group">
              <label for="review-text">{{ __('Testimonial Subtitle') }} *</label>
              <textarea name="review_text" id="review-text" cols="30" rows="5" class="form-control summernote" placeholder="{{ __('Testimonial Subtitle') }}" required>{{ $ps->review_text }} </textarea>
            </div>

            <div class="form-group">
              <label for="blog-title">{{ __('Blog Title') }} *</label>
              <input type="text" class="form-control" id="blog-title" name="blog_title"  placeholder="{{ __('Blog Title') }}" value="{{ $data->blog_title }}" required>
            </div>

            <div class="form-group">
              <label for="blog-text">{{ __('Blog Subtitle') }} *</label>
              <textarea name="blog_text" id="blog-text" cols="30" rows="5" class="form-control summernote" placeholder="{{ __('Blog Subtitle') }}" required>{{ $ps->blog_text }} </textarea>
            </div>

            <div class="form-group">
              <label for="faq-title">{{ __('FAQ Title') }} *</label>
              <input type="text" class="form-control" id="faq-title" name="faq_title"  placeholder="{{ __('FAQ Title') }}" value="{{ $data->faq_title }}" required>
            </div>

            <div class="form-group">
              <label for="faq-text">{{ __('FAQ Subtitle') }} *</label>
              <textarea name="faq_subtitle" id="faq-text" cols="30" rows="5" class="form-control summernote" placeholder="{{ __('FAQ Subtitle') }}" required>{{ $ps->faq_subtitle	 }} </textarea>
            </div>


            <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>
@endsection
