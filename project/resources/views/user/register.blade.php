@extends('layouts.front')

@push('css')
    
@endpush

@section('content')
    <!-- Hero -->
    <section class="hero-section bg--overlay bg_img" data-img="{{ asset('assets/images/'.$gs->breadcumb_banner) }}">
        <div class="container">
            <div class="hero-content">
                <h2 class="hero-title"></h2>
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('front.index') }}">@lang('Home')</a>
                    </li>
                    <li>
                        @lang('Registration')
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Hero -->

    <!-- Account -->
    <section class="account-section pt-100 pb-100">
        <div class="container">
            <div class="account-wrapper bg--body">
                <div class="section-title mb-3">
                    <h6 class="subtitle text--base">@lang('Sign Up')</h6>
                    <h3 class="title">@lang('Create Account Now')</h3>
                </div>
                <form id="registerform" class="account-form row gy-3 gx-4 align-items-center" action="{{ route('user.register.submit') }}" method="POST">
                    @includeIf('includes.user.form-both')
                    @csrf
                    <div class="col-sm-6">
                        <label for="name" class="form-label">@lang('Your Name')</label>
                        <input type="text" id="name" name="name" class="form-control form--control">
                    </div>
                    <div class="col-sm-6">
                        <label for="email" class="form-label">@lang('Your Email')</label>
                        <input type="text" id="email" name="email" class="form-control form--control">
                    </div>
                    <div class="col-sm-6">
                        <label for="phone" class="form-label">@lang('Your Phone')</label>
                        <input type="text" id="phone" name="phone" class="form-control form--control">
                    </div>

                    <div class="col-sm-6">
                        <label for="password" class="form-label">@lang('Your Password')</label>
                        <input type="password" id="password" name="password" class="form-control form--control">
                    </div>
                    <div class="col-sm-6">
                        <label for="confirm-password" class="form-label">@lang('Confirm Password')</label>
                        <input type="password" id="confirm-password" name="password_confirmation"
                            class="form-control form--control">
                    </div>
                    <div class="col-sm-12 d-flex flex-wrap justify-content-between align-items-center">
                        <button type="submit" class="cmn--btn bg--base me-3">
                            @lang('Register Now')
                        </button>
                        <div class="text-end">
                            <a href="{{ route('user.login')}}" class="text--base">@lang('Already have
                                an account ')?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="form-check mt-3 mb-0">
                            <input type="checkbox" id="accept" class="form-check-input" checked>
                            <label class="form-check-label" for="accept">@lang('I accept all the') <a href="#0"
                                    class="text--base">@lang('privacy & policy')</a></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Account -->

@endsection

@push('js')
    
@endpush