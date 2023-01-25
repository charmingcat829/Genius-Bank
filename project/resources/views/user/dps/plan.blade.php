@extends('layouts.user')

@push('css')

@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Dps Plan')}}
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
      <div class="row mb--25-none">
          @if (count($plans) == 0)
              <div class="card">
                  <h3 class="text-center">{{__('NO DPS PLAN FOUND')}}</h3>
              </div>
            @else

            @foreach ($plans as $key=>$data)

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
                                    {{ $data->interest_rate }} %
                                </h5>
                                <span>@lang('Interest Rate')</span>
                            </div>
                        </div>
                        <div class="plan__item-body">
                            <ul>
                                <li>
                                    <div class="name">
                                        @lang('Per Installment')
                                    </div>

                                    <div class="info">
                                        {{ showAmountSign($data->per_installment) }}
                                    </div>
                                </li>

                                <li>
                                    <div class="name">
                                        @lang('Total Deposit')
                                    </div>

                                    <div class="info">
                                        {{ showAmountSign($data->final_amount) }}
                                    </div>
                                </li>

                                <li>
                                    <div class="name">
                                        @lang('After Matured')
                                    </div>

                                    <div class="info">
                                        {{ showprice(round($data->final_amount + $data->user_profit,2),$currency) }}
                                    </div>
                                </li>

                                <li>
                                    <div class="name">
                                        @lang('Installment Interval')
                                    </div>

                                    <div class="info">
                                        {{ $data->installment_interval }} {{ __('Days')}}
                                    </div>
                                </li>

                                <li>
                                    <div class="name">
                                        @lang('Total Installment')
                                    </div>

                                    <div class="info">
                                        {{ $data->total_installment }}
                                    </div>
                                </li>
                            </ul>
                                <a href="{{ route('user.dps.planDetails',$data->id) }}" class="btn btn-green w-100">{{__('Apply')}}</a>
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

