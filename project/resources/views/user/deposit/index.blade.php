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
            {{__('Deposits')}}
          </h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
          <div class="btn-list">

            <a href="{{ route('user.deposit.create') }}" class="btn btn-primary d-none d-sm-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              {{__('Create new Deposit')}}
            </a>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    @if (count($deposits) == 0)
                        <h3 class="text-center py-5">{{__('No Deposit Data Found')}}</h3>
                    @else 
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                <tr>
                                    <th>{{ __('Deposit Date') }}</th>
                                    <th>{{ __('Method') }}</th>
                                    <th>{{ __('Account') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($deposits as $deposit)
                                    <tr>
                                        <td data-label="{{ __('Deposit Date') }}">
                                        <div>
                                          {{date('d-M-Y',strtotime($deposit->created_at))}}
                                        </div>    
                                      </td>
                                        <td data-label="{{ __('Method') }}">
                                          <div>
                                            {{$deposit->method}}
                                          </div>
                                        </td>
                                        <td data-label="{{ __('Account') }}">
                                          <div>
                                            {{ auth()->user()->email }}
                                          </div>
                                        </td>

                                        <td data-label="{{ __('Amount') }}">
                                          <div>
                                            {{ showprice($deposit->amount,$currency) }}
                                          </div>
                                        </td>
    
                                        <td data-label="{{ __('Status') }}">
                                          <div>
                                            {{ ucfirst($deposit->status) }}
                                          </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $deposits->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

@endpush

