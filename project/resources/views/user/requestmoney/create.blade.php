@extends('layouts.user')

@push('css')

@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Request Now')}}
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
                    @includeIf('includes.flash')
                    <form id="request-form" action="{{ route('user.money.request.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3 mt-3">
                            <label class="form-label required">{{__('Account Number')}}</label>
                            <input name="account_number" id="account_number" class="form-control" autocomplete="off" placeholder="{{__('000.000.0000')}}" type="text" value="{{ old('account_number') }}" min="1" required>
                        </div>

                        <div class="form-group mb-3 mt-3">
                            <label class="form-label required">{{__('Account Name')}}</label>
                            <input name="account_name" id="account_name" class="form-control" autocomplete="off" placeholder="{{__('Jhon Doe')}}" type="text" value="{{ old('account_name') }}" min="1" required readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label required">{{__('Request Amount')}}</label>
                            <input name="amount" id="amount" class="form-control" autocomplete="off" placeholder="{{__('0.0')}}" type="number" value="{{ old('amount') }}" required>
                        </div>

                        <div class="form-group mb-3 ">
                            <label class="form-label">{{__('Description')}}</label>
                            <textarea name="details" class="form-control nic-edit" cols="30" rows="5" placeholder="{{__('Receive account details')}}"></textarea>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary submit-btn w-100" disabled>{{__('Submit')}}</button>
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
    $("#account_name").on('click',function(){
      let accountNumber = $("#account_number").val();

      let url = `${mainurl}/user/username/${accountNumber}`;

      $.get(url, function(data){
        $("#account_name").val(data);
        $(".submit-btn").prop( "disabled", false );
      });
    })
  </script>
@endpush
