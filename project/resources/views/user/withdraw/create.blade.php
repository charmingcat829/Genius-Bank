@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Withdraw Now')}}
          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card p-5">
                    <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

                        @if ($gs->withdraw_status == 0)
                            <p class="text-center text-danger">{{__('WithDraw is temporary Off')}}</p>
                        @else
                            @includeIf('includes.flash')
                            <form action="{{route('user.withdraw.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label required">{{__('Withdraw Method')}}</label>
                                    <select name="methods" id="withmethod" class="form-select" required>
                                        <option value="">{{ __('Select Withdraw Method') }}</option>
                                        @foreach ($methods as $data)
                                            <option value="{{$data->method}}">{{$data->method}}</option>
                                        @endforeach                    
                                    </select>
                                </div>

                                <input type="hidden" name="currency_sign" value="{{ $currency->sign }}">
                                <input type="hidden" id="currencyCode" name="currency_code" value="{{ $currency->name }}">
                                <input type="hidden" name="currency_id" value="{{ $currency->id }}">

                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label required">{{__('Withdraw Amount')}}</label>
                                    <input name="amount" id="amount" class="form-control" autocomplete="off" placeholder="{{__('0.0')}}" type="number" value="{{ old('amount') }}" min="1" required>
                                </div>

                                <div class="form-group mb-3 ">
                                    <label class="form-label required">{{__('Description')}}</label>
                                    <textarea name="details" class="form-control nic-edit" cols="30" rows="5" placeholder="{{__('Receive account details')}}" required></textarea>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary w-100">{{__('Submit')}}</button>
                                </div>

                                
                            </form>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

@endpush
