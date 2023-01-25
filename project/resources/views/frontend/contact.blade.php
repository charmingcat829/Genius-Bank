@extends('layouts.front')

@push('css')

@endpush

@section('content')
    <!-- Hero -->
    <section class="hero-section bg--overlay bg_img" data-img="{{ asset('assets/images/'.$gs->breadcumb_banner) }}">
        <div class="container">
            <div class="hero-content">
                <h2 class="hero-title"> @lang('Contact') </h2>
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('front.index') }}">@lang('Home')</a>
                    </li>
                    <li>
                        @lang('Contact')
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Hero -->
    
        <!-- About -->
        <section class="contact-section pt-100 pb-50">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-lg-5">
                        <div class="section-title">
                            <h6 class="subtitle text--base">@lang('Contact US')</h6>
                            <h2 class="title">{{ $ps->side_title }}</h2>
                            <p>
                                {{ $ps->side_text }}
                            </p>
                        </div>
                        <div class="contact-area">
                            <div class="contact__item">
                                <div class="contact__item-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact__item-cont">
                                    <h6 class="contact__item-cont-title">@lang('Address')</h6>
                                    <span class="text--base">
                                        {{$ps->street}}
                                    </span>
                                </div>
                            </div>
                            <div class="contact__item">
                                <div class="contact__item-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact__item-cont">
                                    <h6 class="contact__item-cont-title">@lang('Call US') </h6>
                                    <a href="Tel:{{ $ps->phone}}" class="text--base"> {{ $ps->phone}}</a>
                                </div>
                            </div>
                            <div class="contact__item">
                                <div class="contact__item-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact__item-cont">
                                    <h6 class="contact__item-cont-title">@lang('Email US')</h6>
                                    <a href="mailto:{{$ps->email}}" class="text--base">{{$ps->email}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="mapouter mt-4 mt-lg-5">
                            <div class="gmap_canvas">
                                <iframe width="600" height="400" id="gmap_canvas"
                                    src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                                </iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="contact-wrapper">
                            <div class="section-title mb-3">
                                <h6 class="subtitle text--base"> @lang('Contact US')</h6>
                                <h3 class="title">@lang('Send Message to get connected')</h3>
                            </div>
                            <form class="contact-form row g-3 gx-xxl-4 form-contact" method="post" action="{{route('front.contact.submit')}}" id="contactform">
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
                                    <label for="subject" class="form-label">@lang('Subject')</label>
                                    <input type="text" id="subject" name="subject" class="form-control form--control">
                                </div>
                                <div class="col-sm-12">
                                    <label for="message" class="form-label">@lang('Your Message')</label>
                                    <textarea id="message" name="message" class="form-control form--control"></textarea>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="cmn--btn bg--base">
                                        @lang('Send Message')
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About -->
@endsection

@push('js')

@endpush
