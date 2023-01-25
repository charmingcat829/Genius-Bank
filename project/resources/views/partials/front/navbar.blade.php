<div class="d-flex flex-wrap justify-content-evenly justify-content-md-between">
    <div class="d-flex flex-wrap align-items-center">
        <ul class="social-icons py-1 py-md-0">
            @if ($social->f_status)
                <li>
                    <a href="{{$social->facebook}}"><i class="fab fa-facebook-f"></i></a>
                </li>
            @endif

            @if ($social->t_status)
                <li>
                    <a href="{{$social->twitter}}"><i class="fab fa-twitter"></i></a>
                </li>
            @endif

            @if ($social->l_status)
                <li>
                    <a href="{{$social->linkedin}}"><i class="fab fa-linkedin-in"></i></a>
                </li>
            @endif
        </ul>
        <div class="change-language me-md-auto">
            <select name="currency" class="currency selectors nice language-bar">
                @foreach(DB::table('currencies')->get() as $currency)
                    <option value="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}>
                        {{$currency->name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <ul class="contact-bar py-1 py-md-0">
        <li>
            <a href="Tel:{{$ps->phone}}">{{$ps->phone}}</a>
        </li>
        <li>
            <a href="Mailto:{{$ps->email}}">{{$ps->email}}</a>
        </li>
        <li>
            <div class="change-language d-none d-sm-block">
                <select name="language" class="language selectors nice language-bar">
                    @foreach(DB::table('languages')->get() as $language)
                        <option value="{{route('front.language',$language->id)}}" {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }} >
                            {{$language->language}}
                        </option>
                    @endforeach
                </select>
            </div>
        </li>
    </ul>
</div>