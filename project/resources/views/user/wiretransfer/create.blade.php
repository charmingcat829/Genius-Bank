@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Wire Transfer')}}
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

                    @includeIf('includes.flash')
                    <form action="{{route('user.wire.transfer.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="form-label required">{{__('Bank')}}</label>
                            <select name="wire_transfer_bank_id" id="bankmethod" class="form-select" required>
                                <option value="">{{ __('Select Bank') }}</option>
                                @foreach ($banks as $key=>$bank)
                                    <option value="{{$bank->id}}" data-swift={{ $bank->swift_code }} data-currency="{{ $bank->currency->name }}" data-country="{{ $bank->country->name }}" data-routing={{ $bank->routing_number }}>{{$bank->title}}</option>
                                @endforeach                    
                            </select>
                        </div>

                        @error('wire_transfer_bank_id')
                            <span>{{ $message }}</span>
                        @enderror

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label">{{__('Swift Code')}}</label>
                                    <input type="text" id="swiftCode" name="swift_code" class="form-control" autocomplete="off" placeholder="{{__('Enter Swift Code')}}" value="">
                                </div>
                                @error('swift_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label">{{__('Currency')}}</label>
                                    <input type="text" id="currency" name="currency" class="form-control" autocomplete="off" placeholder="{{__('Enter Currency')}}" value="">
                                </div>
                                @error('currency')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label">{{__('Routing Number')}}</label>
                                    <input type="text" id="routingNumber" name="routing_number" class="form-control" autocomplete="off" placeholder="{{__('Enter Routing Number')}}" value="">
                                </div>
                                @error('routing_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label">{{__('Country')}}</label>
                                    <input type="text" id="country" name="country" class="form-control" autocomplete="off" placeholder="{{__('Enter Country')}}" value="">
                                </div>
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label">{{__('Account Number')}}</label>
                                    <input type="text" name="account_number" class="form-control" autocomplete="off" placeholder="{{__('Enter Account Number')}}" value="{{ old('account_number') }}">
                                </div>
                                @error('account_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label">{{__('Account Holder Name')}}</label>
                                    <input type="text" name="account_holder_name" class="form-control" autocomplete="off" placeholder="{{__('Enter Account Holder Name')}}" value="{{ old('account_holder_name') }}">
                                </div>
                                @error('account_holder_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 mt-3">
                            <label class="form-label required">{{__('Amount')}}</label>
                            <input name="amount" id="amount" class="form-control" autocomplete="off" placeholder="{{__('0.0')}}" type="number" value="{{ old('amount') }}" min="1" required>
                        </div>
                        @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group mb-3 ">
                            <label class="form-label">{{__('Note')}}</label>
                            <textarea name="note" class="form-control nic-edit" cols="30" rows="5" placeholder="{{__('Note')}}"></textarea>
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
    <script>
        'use strict';
        $("#bankmethod").on('change',function(){
            $("#swiftCode").val($(this).find('option:selected').data('swift'));
            $("#currency").val($(this).find('option:selected').data('currency'));
            $("#routingNumber").val($(this).find('option:selected').data('routing'));
            $("#country").val($(this).find('option:selected').data('country'));
        })
    </script>
@endpush
