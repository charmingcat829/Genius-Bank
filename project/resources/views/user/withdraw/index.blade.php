@extends('layouts.user')

@push('css')

@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="d-flex flex-wrap justify-content-between">
        <div class="me-3">
          <div class="page-pretitle">
            {{__('Overview')}}
          </div>
          <h2 class="page-title">
            {{__('Withdraws')}}
          </h2>
        </div>
        <div class="d-print-none">
          <div class="btn-list">
            <a href="{{ route('user.withdraw.create') }}" class="btn btn-primary">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              {{__('Create new Withdraw')}}
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
                    @if (count($withdraws) == 0)
                        <h3 class="text-center py-5">{{__('No Withdraw Data Found')}}</h3>
                    @else
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                <tr>
                                    <th>{{ __('Withdraw Date') }}</th>
                                    <th>{{ __('Method') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Fee') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Details') }}</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach($withdraws as $key=>$withdraw)
                                      <tr>
                                          <td data-label="{{ __('Withdraw Date') }}">{{date('d-M-Y',strtotime($withdraw->created_at))}}</td>
                                          <td data-label="{{ __('Method') }}">{{$withdraw->method}}</td>
                                          <td data-label="{{ __('Amount') }}">{{ showNameAmount($withdraw->amount) }}</td>
                                          <td data-label="{{ __('Fee') }}">{{ showNameAmount($withdraw->fee) }}</td>
                                          <td data-label="{{ __('Status') }}">{{ucfirst($withdraw->status)}}</td>

                                          <td data-label="{{ __('Details') }}">
                                            <a href="{{route('user.withdraw.details',$withdraw->id)}}" class="btn btn-primary">
                                              {{__('Details')}}
                                            </a>
                                          </td>
                                      </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $withdraws->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

@endpush

