@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('DPS Apply Form')}}
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
                                    <p class="strong mb-1">{{__('Per Installment Amount')}}</p>
                                </td>
                                <td class="text-end">{{ showprice($data->per_installment,$currency) }}</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Total Deposit Amount')}}</p>
                                </td>
                                <td class="text-end">{{ showprice($data->final_amount,$currency) }}</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('User Profit')}}</p>
                                </td>
                                <td class="text-end">{{ showprice(($data->final_amount + $data->user_profit),$currency) }}</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Total Installment')}}</p>
                                </td>
                                <td class="text-end">{{ $data->total_installment }}</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Interest Rate')}}</p>
                                </td>
                                <td class="text-end"> {{ $data->interest_rate }} (%)</td>
                            </tr>


                        </tbody>
                    </table>
                    
                    <form action="{{route('user.loan.dpsSubmit')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="dps_plan_id" value="{{ $data->id }}">
                        <input type="hidden" name="per_installment" value="{{ $data->per_installment }}">
                        <input type="hidden" name="deposit_amount" value="{{ $data->final_amount }}">
                        <input type="hidden" name="matured_amount" value="{{ $data->final_amount + $data->user_profit }}">


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

