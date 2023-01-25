@extends('layouts.front')

@push('css')

@endpush

@section('content')

	<!-- Hero -->
	<section class="hero-section bg--overlay bg_img" data-img="{{ asset('assets/images/'.$gs->breadcumb_banner) }}">
		<div class="container">
			<div class="hero-content">
				<h2 class="hero-title">@lang('Blog')</h2>
				<ul class="breadcrumb">
					<li>
						<a href="{{route('front.index')}}">@lang('Home')</a>
					</li>
					<li>
						@lang('Blog Posts')
					</li>
				</ul>
			</div>
		</div>
	</section>
	<!-- Hero -->

	<!-- Blog -->
	<section class="blog-section pt-100 pb-100">
		<div class="container">
			<div class="row justify-content-center gy-4">
				@if (count($blogs) == 0)
					<div class="col-12 text-center">
							<h3 class="m-0">{{__('No Blog Found')}}</h3>
					</div>
				@else
					@foreach ($blogs as $key=>$data)
						<div class="col-lg-4 col-md-6 col-sm-10">
							<div class="blog__item">
								<div class="blog__item-img">
									<a href="{{route('blog.details',$data->slug)}}">
										<img src="{{asset('assets/images/'.$data->photo)}}" alt="blog">
									</a>
								</div>
								<div class="blog__item-content">
									<div class="d-flex flex-wrap justify-content-between meta-post">
										<span><i class="far fa-user"></i> @lang('Admin')</span>
									</div>
									<h5 class="blog__item-content-title">
										<a href="{{route('blog.details',$data->slug)}}">
											{{Str::limit($data->title,50)}}
										</a>
									</h5>
									<a href="{{route('blog.details',$data->slug)}}" class="read-more">@lang('Read More')</a>
								</div>
							</div>
						</div>
					@endforeach
				@endif
			</div>
			<ul class="pagination">
				{{ $blogs->links()}}
			</ul>
		</div>
	</section>
	<!-- Blog -->

@endsection

@push('js')

@endpush
