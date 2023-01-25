<section class="ctas-section bg--overlay bg_img bg_fixed" data-img="{{ asset('assets/images/'.$ps->quick_background) }}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="cta-img">
                    <img src="{{ asset('assets/images/'.$ps->quick_photo) }}" alt="about">
                </div>
            </div>
            <div class="col-md-6">
                <div class="ctas-content">
                    <div class="section-title text-white">
                        <h6 class="subtitle text--base">@lang('Quick Start')</h6>
                        <h3 class="title">{{ $ps->quick_title }}</h3>
                        <p>
                            {{ $ps->quick_subtitle }}
                        </p>
                    </div>
                    <div>
                        <a href="{{ $ps->quick_link }}" class="cmn--btn">@lang('Get Started Now')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>