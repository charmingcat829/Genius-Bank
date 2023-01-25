@extends('layouts.user')

@push('css')

@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Send Money')}}
          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card p-4">
                    <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs">
                      <li class="nav-item">
                        <a href="#other-account" class="nav-link active" data-bs-toggle="tab">{{__('Other Account')}}</a>
                      </li>
                      <li class="nav-item">
                        <a href="#saved-account" class="nav-link" data-bs-toggle="tab">{{__('Saved Account')}}</a>
                      </li>
                    </ul>

                    <div class="card-body">
                      <div class="tab-content">
                        <div class="tab-pane active show" id="other-account">
                            @includeIf('includes.flash')
                            <form action="{{route('send.money.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label required">{{__('Account Number')}}</label>
                                    <input name="account_number" id="account_number" class="form-control" autocomplete="off" placeholder="{{__('000.000.0000')}}" type="text" value="{{ $savedUser ? $savedUser->account_number : '' }}" min="1" required>
                                </div>

                                <div class="form-group mb-3 mt-3">
                                    <label class="form-label required">{{__('Account Name')}}</label>
                                    <input name="account_name" id="account_name" class="form-control" autocomplete="off" placeholder="{{__('Jhon Doe')}}" type="text" value="{{ $savedUser ? $savedUser->name : '' }}" min="1" required readonly>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="form-label required">{{__('Amount')}}</label>
                                    <input name="amount" id="amount" class="form-control" autocomplete="off" placeholder="{{__('0.0')}}" type="number" value="{{ old('amount') }}" required>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary w-100">{{__('Submit')}}</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="saved-account">
                          <div class="row g-3">
                            @if (count($saveAccounts) == 0)
                                <p class="text-center">{{__('NO SAVED ACCOUNT FOUND')}}</p>
                              @else
                              @foreach ($saveAccounts as $key=>$data)
                              @php
                                  $reciver = App\Models\User::whereId($data->receiver_id)->first();
                              @endphp
                                @if ($reciver)
                                  <div class="col-6">
                                    <a href="{{ route('send.money.savedUser',$reciver->account_number) }}">
                                      <div class="row g-3 align-items-center">
                                        <span class="col-auto">
                                          <span class="avatar" style="background-image: url({{ asset('assets/images/'.$reciver->photo) }})">
                                            <span class="badge bg-red"></span></span>
                                        </span>
                                        <div class="col text-truncate">
                                          <span>{{$reciver->name}}</span>
                                          <br>
                                          <small class="text-muted text-truncate mt-n1">{{ $reciver->account_number }}</small>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                                @endif
                              @endforeach
                            @endif

                          </div>
                        </div>
                      </div>
                    </div>
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
    });
  })
</script>
@endpush
