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
            {{__('DPS Manage')}}
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
                    @if (count($dps) == 0)
                        <h3 class="text-center py-5">{{__('No Dps Data Found')}}</h3>
                    @else 
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-lg card-table">
                                <thead>
                                <tr>
                                    <th>{{ __('Plan No') }}</th>
                                    <th>{{ __('Deposit Amount') }}</th>
                                    <th>{{ __('Matured Amount') }}</th>
                                    <th>{{ __('Total Installement') }}</th>
                                    <th>{{ __('Next Installment') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach($dps as $key=>$data)
                                      <tr>
                                          <td data-label="{{ __('Plan No') }}">
                                            <div>
                                              {{ $data->transaction_no }}
                                                <br>
                                              <span class="text-info">{{ $data->plan->title }}</span>
                                            </div>
                                          </td>

                                          <td data-label="{{ __('Deposit Amount') }}">
                                            <div>
                                              {{ showprice($data->deposit_amount,$currency) }}
                                              <br>
                                              <span class="text-info">{{ showprice($data->per_installment,$currency) }} {{__('each')}}</span>
                                            </div>
                                          </td>

                                          <td data-label="{{ __('Matured Amount') }}">
                                            <div>
                                              {{ showprice($data->matured_amount,$currency) }}
                                            </div>  
                                          </td>
                                          
                                          <td data-label="{{ __('Total Installement') }}">
                                              <div>
                                                {{ $data->total_installment}}
                                                <br>
                                                <span class="text-info">{{ $data->given_installment }} @lang('Given')</span>
                                              </div>
                                          </td>

                                          <td data-label="{{ __('Next Installment') }}"> 
                                            <div>
                                              {{ $data->next_installment ?  $data->next_installment->toDateString() : '--'}}
                                            </div>
                                          </td>

                                          <td data-label="{{ __('Status') }}">
                                            <div>
                                              @if ($data->status == 1)
                                                <span class="badge bg-info">@lang('Running')</span>
                                              @else 
                                                <span class="badge bg-success">@lang('Matured')</span>
                                              @endif
                                            </div>
                                          </td>

                                          <td data-label="{{ __('View Logs') }}">
                                            <div class="btn-list flex-nowrap">
                                              <a href="{{ route('user.dps.logs',$data->id) }}" class="btn">
                                                @lang('Logs')
                                              </a>
                                            </div>
                                          </td>
                                      </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $dps->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

@endpush

