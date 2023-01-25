@extends('layouts.user')

@push('css')

@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Loan Plan')}}
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
                  <h3 class="text-center">{{__('NO LOAN PLAN FOUND')}}</h3>
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
                                <h5 class="title">{{ $data->per_installment }} %</h5>
                                <span>@lang('Per Installment')</span>
                            </div>
                        </div>
                        <div class="plan__item-body">
                            <ul>
                                <li>
                                    <div class="name">
                                        @lang('Minimum Amount')
                                    </div>

                                    <div class="info">
                                      {{ showAmountSign($data->min_amount) }}
                                    </div>
                                </li>
                                <li>
                                    <div class="name">
                                        @lang('Maximum Amount')
                                    </div>

                                    <div class="info">
                                        {{ showAmountSign($data->max_amount) }}
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
                            <a href="javascript:;" class="btn btn-green w-100 apply-loan" data-id="{{ $data->id}}" data-bs-toggle="modal" data-bs-target="#modal-apply">
                                {{__('Apply')}}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
          @endif
      </div>
    </div>
  </div>

  <div class="modal modal-blur fade" id="modal-apply" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{('Apply for Loan')}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route('user.loan.amount') }}" method="post">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label class="form-label required">{{__('Amount')}}</label>
                <input name="amount" id="amount" class="form-control" autocomplete="off" placeholder="{{__('0.0')}}" type="number" value="{{ old('amount') }}" min="1" required>
              </div>

              <input type="hidden" name="planId" id="planId" value="">
            </div>

            <div class="modal-footer">
                <button type="submit" id="submit-btn" class="btn btn-primary">{{ __('Submit') }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('js')

<script>
    'use strict';

    $('.apply-loan').on('click',function(){
        let id = $(this).data('id');
        $('#planId').val(id);
    });
</script>
@endpush

