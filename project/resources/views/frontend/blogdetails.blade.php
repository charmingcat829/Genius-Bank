@extends('layouts.front')

@push('css')
    
@endpush

@section('content')

		    <!-- Hero -->
			<section class="hero-section bg--overlay bg_img" data-img="{{ asset('assets/images/'.$gs->breadcumb_banner) }}">
				<div class="container">
					<div class="hero-content">
						<h2 class="hero-title">{{ $data->title }}</h2>
						<ul class="breadcrumb">
							<li>
								<a href="{{route('front.index')}}">@lang('Home')</a>
							</li>
							<li>
								<a href="{{route('front.blog')}}">@lang('Blogs')</a>
							</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- Hero -->
		
			<!-- Blog -->
			<section class="blog-section pt-100 pb-100">
				<div class="container">
					<div class="row gy-5">
						<div class="col-lg-8">
							<div class="blog__item blog__item-details">
								<div class="blog__item-img">
									<img src="{{asset('assets/images/'.$data->photo)}}" alt="blog">
								</div>
								<div class="blog__item-content">
									<div class="d-flex flex-wrap justify-content-between meta-post">
										<span><i class="far fa-user"></i> @lang('Admin')</span>
									</div>
									<h5 class="blog__item-content-title">
										{{ $data->title }}
									</h5>
								</div>
								<div class="blog__details">
									@php
										echo $data->details;
									@endphp

									<div class="d-flex align-items-center flex-wrap pt-4">
										<h6 class="m-0 me-2 align-items-center">@lang('Share Now')</h6>
										<ul class="social-icons social-icons-dark">
											<li>
												<a href="#0"><i class="fab fa-facebook-f"></i></a>
											</li>
											<li>
												<a href="#0"><i class="fab fa-twitter"></i></a>
											</li>
											<li>
												<a href="#0"><i class="fab fa-instagram"></i></a>
											</li>
											<li>
												<a href="#0"><i class="fab fa-linkedin-in"></i></a>
											</li>
											<li>
												<a href="#0"><i class="fab fa-youtube"></i></a>
											</li>
										</ul>
									</div>
									<div id="disqus_thread"></div>
								</div>
							</div>
						</div>
						<div class="col-xl-4">
							<aside class="blog-sidebar ps-xxl-5">
								<div class="widget">
									<div class="widget-header text-center">
										<h5 class="m-0 text-white">@lang('Latest Blog Posts')</h5>
									</div>
									<div class="widget-body">
										<ul class="latest-posts">
											@foreach ($rblogs as $key=>$data)
											<li>
												<a href="{{route('blog.details',$data->slug)}}">
													<div class="img">
														<img src="{{asset('assets/images/'.$data->photo)}}" alt="blog">
													</div>
													<div class="cont">
														<h5 class="subtitle">{{Str::limit($data->title,50)}}</h5>
														<span class="date">{{$data->created_at->format('M d, Y')}}</span>
													</div>
												</a>
											</li>
											@endforeach
										</ul>
									</div>
								</div>
								<div class="widget">
									<div class="widget-header text-center">
										<h5 class="m-0 text-white">@lang('Category')</h5>
									</div>
									<div class="widget-body">
										<ul class="archive-links">
											@foreach ($bcats as $key=>$data)
												<li>
													<a href="{{ route('front.blogcategory',$data->slug) }}">
														<span>{{$data->name}}</span>
														<span>&nbsp;</span>
													</a>
												</li>
											@endforeach
										</ul>
									</div>
								</div>
								<div class="widget">
									<div class="widget-header text-center">
										<h5 class="m-0 text-white">@lang('Archive')</h5>
									</div>
									<div class="widget-body">
										<ul class="archive-links">
											@foreach ($archives as $key=>$data)
												<li>
													<a href="{{ route('front.blogarchive',$key) }}">
														<span>{{$key}}</span>
														<span>&nbsp;</span>
													</a>
												</li>
											@endforeach
										</ul>
									</div>
								</div>
								<div class="widget">
									<div class="widget-header text-center">
										<h5 class="m-0 text-white">@lang('Tags')</h5>
									</div>
									<div class="widget-body">
										<ul class="widget-tags">
											@foreach($tags as $tag)
												@if(!empty($tag))
													<li>
														<a class="{{ isset($slug) ? ($slug == $tag ? 'active' : '') : '' }}" href="{{ route('front.blogtags',$tag) }}">{{ $tag }} </a>
													</li>
												@endif
											@endforeach
										</ul>
									</div>
								</div>
							</aside>
						</div>
					</div>
				</div>
			</section>
			<!-- Blog -->

@endsection

@push('js')
@if ($gs->is_disqus == 1)
<script>
	'use strict';
	(function () {
		var d = document,
		s = d.createElement('script');
		s.src = 'https://{{ $gs->disqus}}.disqus.com/embed.js';
		s.setAttribute('data-timestamp', +new Date());
		(d.head || d.body).appendChild(s);
	})();
</script>
<noscript>{{__('Please enable JavaScript to view the')}} <a href="https://disqus.com/?ref_noscript">{{__('comments powered by Disqus.')}}</a></noscript>
@endif
@endpush