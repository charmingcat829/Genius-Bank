@extends('layouts.user')

@push('css')

@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Pricing Plans')}}
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
      <div class="row">
          @if (count($packages) == 0)
              <div class="card">
                  <h3 class="text-center">{{__('NO PLAN FOUND')}}</h3>
              </div>
            @else

            @foreach ($packages as $key=>$data)

                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="plan__item position-relative">
                        <div class="ribbon ribbon-top ribbon-bookmark bg-green">
                        </div>
                        <div class="plan__item-header">
                            <div class="left">
                                <h4 class="title">{{ $data->title}}</h4>
                            </div>
                            <div class="right">
                                <h5 class="title">
                                    {{ showAmountSign($data->amount) }}
                                </h5>
                                <span>{{ $data->days }} @lang('Days')</span>
                            </div>
                        </div>
                        <div class="plan__item-body">
                            <ul>
                                @if ($data->attribute)
                                    @foreach (json_decode($data->attribute,true) as $key=>$attribute)
                                        <li>
                                            <div class="w-100">
                                                {{ $attribute }}
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                            @if (auth()->user()->bank_plan_id == $data->id)
                                <a href="javascript:;" class="btn btn-green w-100">
                                    {{__('Current Plan')}}
                                </a>

                                <div class="text-end mt-2">
                                    ({{ auth()->user()->plan_end_date ? auth()->user()->plan_end_date->toDateString() : '' }}) <a href="{{route('user.package.subscription',$data->id)}}" class="text--base">@lang('Renew Plan')</a>
                                </div>
                            @else
                                <a href="{{route('user.package.subscription',$data->id)}}" class="btn btn-green w-100">
                                    {{__('Get Started')}}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
          @endif
      </div>
    </div>
  </div>


@endsection

@push('js')

@endpush

