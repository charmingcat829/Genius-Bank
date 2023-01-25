@extends('layouts.front')

@push('css')

@endpush

@section('content')
	<!-- Hero -->
	<section class="hero-section bg--overlay bg_img" data-img="{{ asset('assets/images/'.$gs->breadcumb_banner) }}">
		<div class="container">
			<div class="hero-content">
				<h2 class="hero-title">@lang('About US')</h2>
				<ul class="breadcrumb">
					<li>
						<a href="{{route('front.index')}}">@lang('Home')</a>
					</li>
					<li>
						@lang('About US')
					</li>
				</ul>
			</div>
		</div>
	</section>
	<!-- Hero -->

    <!-- About -->
    <section class="about-section pt-100 pb-50">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-6">
                    <div class="about-thumb h-100">
                        <div class="thumb">
                            <img src="{{ asset('assets/images/'.$ps->about_photo) }}" alt="about">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-title">
                            <h6 class="subtitle text--base">@lang('Who We are')</h6>
                            <h2 class="title">{{ $ps->about_title }}</h2>
                            <p>
                                @php
                                    echo $ps->about_text;
                                @endphp
                            </p>
                        </div>
                        <ul class="about-list">
                            @if ($ps->about_attributes)
                                @foreach (json_decode($ps->about_attributes,true) as $key=>$attribute)
                                    <li>
                                        <span>
                                            {{ $attribute }}
                                        </span>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                        <div class="btn__grp mt-4 pt-3">
                            <a href="{{ $ps->about_link }}" class="cmn--btn btn-outline">@lang('Get Started')</a>
                            <a href="{{ route('front.about') }}" class="cmn--btn">@lang('More About Us')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About -->

    <!-- About -->
    <section class="about-section-2 pt-50 pb-100">
        <div class="container">
            <div class="about__item">
                @php
                    echo $ps->about_details;
                @endphp
            </div>
        </div>
    </section>
    <!-- About -->

@endsection

@push('js')

@endpush