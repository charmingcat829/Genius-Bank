@extends('layouts.user')

@push('css')

@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <div class="page-pretitle">
            {{__('Overview')}}
          </div>
          <h2 class="page-title">
            {{__('Other Bank Transfer')}}
          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-5">
                <div class="card p-3 p-lg-4">
                    <table class="table table-transparent table-responsive">
                        <thead>

                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Minimum Amount')}}</p>
                                </td>
                                <td class="text-end"> {{ showNameAmount($data->bank->min_limit) }}</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Maximum Amount')}}</p>
                                </td>
                                <td class="text-end">{{ showNameAmount($data->bank->max_limit) }}</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Daily Amount Limit')}}</p>
                                </td>
                                <td class="text-end">{{ showNameAmount($data->bank->daily_maximum_limit) }}</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Daily Monthly Limit')}}</p>
                                </td>
                                <td class="text-end">{{ showNameAmount($data->bank->monthly_maximum_limit) }}</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Daily Limit')}}</p>
                                </td>
                                <td class="text-end">{{ $data->bank->daily_total_transaction }}</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Monthly Limit')}}</p>
                                </td>
                                <td class="text-end">{{ $data->bank->monthly_total_transaction }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card p-3 p-lg-4">
                    @includeIf('includes.flash')
                    <form action="{{route('user.other.send.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="other_bank_id" value="{{ $data->other_bank_id }}">
                        <input type="hidden" name="beneficiary_id" value="{{ $data->id }}">
                        <div class="form-group mb-3">
                            <label class="form-label required">{{__('Bank Name')}}</label>
                            <input name="bank_name" id="bank_name" class="form-control" autocomplete="off" placeholder="{{__('Wells Fargo')}}" type="text" value="{{ $data->bank->title }}" min="1" required readonly>
                        </div>

                        <div class="form-group mb-3 mt-3">
                            <label class="form-label required">{{__('Name')}}</label>
                            <input name="account_name" id="account_name" class="form-control" autocomplete="off" placeholder="{{__('Jhon Doe')}}" type="text" value="{{ $data->account_name }}" min="1" required readonly>
                        </div>

                        <div class="form-group mt-3">
                            <label class="form-label required">{{__('Amount')}}</label>
                            <input name="amount" id="amount" class="form-control" autocomplete="off" placeholder="{{__('0.0')}}" type="number" value="{{ old('amount') }}" min="1" required>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">{{__('Submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

@endpush

