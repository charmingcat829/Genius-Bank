@extends('layouts.user')

@push('css')

@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Running Loans')}}
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
                    @if (count($loans) == 0)
                        <h3 class="text-center py-5">{{__('No Loan Data Found')}}</h3>
                    @else
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-lg card-table">
                                <thead>
                                <tr>
                                    <th>{{ __('Plan No') }}</th>
                                    <th>{{ __('Loan Amount') }}</th>
                                    <th>{{ __('Per Installment') }}</th>
                                    <th>{{ __('Total Installement') }}</th>
                                    <th>{{ __('Next Installment') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach($loans as $key=>$data)
                                      <tr>
                                          <td data-label="{{ __('Plan No') }}">
                                              <div>
                                                  {{ $data->transaction_no }}
                                              <br>
                                            <span class="text-info">{{ $data->plan->title }}</span>
                                              </div>
                                          </td>
                                          <td data-label="{{ __('Loan Amount') }}">{{ showNameAmount($data->loan_amount) }}</td>
                                          <td data-label="{{ __('Per Installment') }}">{{ showNameAmount($data->per_installment_amount) }}</td>
                                          <td data-label="{{ __('Total Installement') }}">
                                              <div>
                                                  {{ $data->total_installment}}
                                              <br>
                                              <span class="text-info">{{ $data->given_installment }} @lang('Given')</span>
                                              </div>
                                          </td>

                                          <td data-label="{{ __('Next Installment') }}">
                                            {{ $data->next_installment ?  $data->next_installment->toDateString() : '--'}}
                                          </td>
                                          <td data-label="{{ __('Status') }}">
                                            @if ($data->status == 0)
                                              <span class="badge bg-warning">@lang('Pending')</span>
                                            @elseif($data->status == 1)
                                              <span class="badge bg-success">@lang('Running')</span>
                                            @elseif($data->status == 3)
                                              <span class="badge bg-info">@lang('Paid')</span>
                                            @else
                                              <span class="badge bg-danger">@lang('Rejected')</span>
                                            @endif
                                          </td>
                                          <td data-label="{{__('View Logs')}}">
                                            <div class="btn-list flex-nowrap">
                                              <a href="{{ route('user.loans.logs',$data->id) }}" class="btn">
                                                @lang('Logs')
                                              </a>
                                            </div>
                                          </td>
                                      </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $loans->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

@endpush

