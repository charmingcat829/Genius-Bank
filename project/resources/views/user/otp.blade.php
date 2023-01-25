@extends('layouts.front')

@section('content')
    <!-- Hero -->
    <section class="hero-section bg--overlay bg_img" data-img="{{ asset('assets/images/'.$gs->breadcumb_banner) }}">
      <div class="container">
          <div class="hero-content">
              <h2 class="hero-title"> @lang('OTP') </h2>
              <ul class="breadcrumb">
                  <li>
                      <a href="{{ route('front.index') }}">@lang('Home')</a>
                  </li>
                  <li>
                      @lang('Two Factor Authentication')
                  </li>
              </ul>
          </div>
      </div>
  </section>
  <!-- Hero -->

  <section class="about-section pt-100 pb-50">
		<div class="container">
			<div class="row gy-5">
				<div class="col-lg-12">
          <form action="{{ route('user.otp.submit') }}" method="POST">
            @include('includes.admin.form-login')
            {{ csrf_field() }}
            <div class="row">
              <div class="col-lg-12">
                <div class="form-input">
                  <input type="text" class="form-control" name="otp" placeholder="@lang('Type Your otp')" required="">
                </div>
              </div>
            </div>

            <div class="row d-flex justify-content-center">
              <button type="submit" class="submit-btn btn btn-primary mt-4">@lang('Submit')</button>
            </div>

          </form>
				</div>
			</div>
		</div>
	</section>


@endsection

@push('js')

<script src="{{asset('assets/user/js/sweetalert2@9.js')}}"></script>

@if($errors->any())
    @foreach ($errors->all() as $error)
        <script>
          "use strict";
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
            Toast.fire({
            icon: 'error',
            title: '{{ $error }}'
            })
        </script>
    @endforeach
@endif
@endpush