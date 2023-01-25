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
                <div class="card card-md">
                    <div class="card-body text-center py-4 p-sm-5">
                      <img src="{{asset('assets/images/success.png')}}" height="128" class="mb-n2" alt="">
                      <h1 class="mt-5">{{__('Money Send Successfully')}}</h1>
                    </div>

                    <div class="hr-text hr-text-center hr-text-spaceless">{{__('your data')}}</div>
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-4">
                                <form action="{{ route('user.save.account') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $data->user_id }}">
                                    <input type="hidden" name="receiver_id" value="{{ $data->receiver_id }}">
                                    <button type="submit" class="btn btn-primary w-100">{{__('Saved Account')}}</button>
                                </form>
                            </div>

                            <div class="col-md-4">
                                <a href="{{ route('user.send.money.cancle') }}" class="btn btn-outline-secondary active w-100">
                                    {{__('Cancle')}}
                                  </a>
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

@endpush
