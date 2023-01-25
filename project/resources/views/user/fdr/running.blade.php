@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Running FDR')}}
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
                    @if (count($fdr) == 0)
                        <h3 class="text-center py-5">{{__('No FDR Data Found')}}</h3>
                    @else 
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                <tr>
                                    <th>{{ __('Plan No') }}</th>
                                    <th>{{ __('FDR Amount') }}</th>
                                    <th>{{ __('Profit Type') }}</th>
                                    <th>{{ __('Profit') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach($fdr as $key=>$data)
                                      <tr>
                                          <td data-label="{{ __('Plan No') }}">
                                            <div>
                                                {{ $data->transaction_no }}
                                                <br>
                                              <span class="text-info">{{ $data->plan->title }}</span>
                                            </div>
                                          </td>

                                          <td data-label="{{ __('FDR Amount') }}">
                                            <div>
                                              {{ showprice($data->amount,$currency) }}
                                              <br>
                                              <span class="text-info">@lang('Profit Rate') {{$data->interest_rate}} (%) </span>
                                            </div>
                                          </td>

                                          <td data-label="{{ __('Profit Type') }}">
                                            <div>
                                              {{ strtoupper($data->profit_type) }}
                                            </div>
                                          </td>

                                          <td data-label="{{ __('Profit') }}">
                                            <div class="text-center text-md-start">
                                              {{ showprice($data->profit_amount,$currency) }}
                                              <br>
                                              @if ($data->profit_type == 'partial')
                                                  <span class="text-info"> @lang('Next Frofit Days') ({{ $data->next_profit_time->toDateString() }})</span>
                                              @else 
                                                  <span class="text-info"> @lang('Profit will get after locked period') </span>
                                              @endif
                                            </div>
                                          </td>

                                          <td data-label="{{ __('Status') }}">
                                            <div>
                                              @if ($data->status == 1)
                                                <span class="badge bg-success">@lang('Running')</span>
                                              @else 
                                                <span class="badge bg-danger">@lang('Closed')</span>
                                              @endif
                                            </div>
                                          </td>
                                      </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $fdr->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

@endpush