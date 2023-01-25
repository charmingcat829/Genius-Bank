@extends('layouts.user')

@push('css')

@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Loan Apply Form')}}
          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-12">
                <div class="card p-4">
                    <table class="table table-transparent table-responsive">

                        <tbody>
                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Plan Title')}}</p>
                                </td>
                                <td class="text-end">{{$data->title}}</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('FDR Amount')}}</p>
                                </td>
                                <td class="text-end">{{ $currency->sign }} {{ $fdrAmount }}</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Locked In Period')}}</p>
                                </td>
                                <td class="text-end"> {{ $data->matured_days }} {{ __('Days') }}</td>
                            </tr>

                            @if ($data->interval_type == 'partial')
                                <tr>
                                    <td>
                                        <p class="strong mb-1">{{__('Get Profit Every')}}</p>
                                    </td>
                                    <td class="text-end"> {{ $data->interest_interval }} {{ __('Days') }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td>
                                        <p class="strong mb-1">{{__('Get Profit')}}</p>
                                    </td>
                                    <td class="text-end"> {{ ('After Locked Period') }}</td>
                                </tr>
                            @endif

                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Interest Rate In Total Deposit')}}</p>
                                </td>
                                <td class="text-end"> {{ $data->interest_rate }} (%)</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1 text-success">{{__('Amount To Get')}}</p>
                                </td>
                                <td class="text-end text-success">{{ round($profit_amount,2).' '.$currency->sign }}</td>
                            </tr>

                        </tbody>
                    </table>

                    <form action="{{ route('user.fdr.request') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="plan_id" value="{{ $data->id }}">
                        <input type="hidden" name="fdr_amount" value="{{ $fdrAmount }}">
                        <input type="hidden" name="profit_amount" value="{{ $profit_amount }}">

                        <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection

@push('js')

@endpush

