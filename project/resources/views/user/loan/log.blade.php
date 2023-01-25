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
            {{__('Loan Installment Log')}}
          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    @if (count($logs) == 0)
                        <h3 class="text-center py-5">{{__('No Loan Log Found')}}</h3>
                    @else 
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-sm card-table">
                                <thead>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Transaction No') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach($logs as $key=>$data)
                                    <tr>
                                        <td data-label="{{ __('Date') }}">
                                            <div>
                                              {{ $data->created_at->toDateString() }}
                                            </div>
                                        </td>
                                        <td data-label="{{ __('Transaction No') }}">
                                            <div>
                                              {{ $data->transaction_no }}
                                            </div>
                                        </td>
                                        <td data-label="{{ __('Amount') }}">
                                          <div>
                                            {{ $currency->sign }} {{ $data->amount }}
                                          </div>
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $logs->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

@endpush

