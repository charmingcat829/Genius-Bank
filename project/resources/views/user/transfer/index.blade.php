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
            {{__('Transfer Logs')}}
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
                        <h3 class="text-center py-5">{{__('No Transfer Data Found')}}</h3>
                    @else
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-lg card-table">
                                <thead>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Transaction Number') }}</th>
                                    <th>{{ __('Account No') }}</th>
                                    <th>{{ __('Account Name') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach($logs as $key=>$data)
                                      <tr>
                                          <td data-label="{{ __('Date') }}">{{ $data->created_at->toFormattedDateString() }}</td>
                                          <td data-label="{{ __('Transaction Number') }}">{{ $data->transaction_no }}</td>
                                          @if ($data->receiver_id)
                                            @php
                                              $receiver = App\Models\User::whereId($data->receiver_id)->first();
                                            @endphp

                                            <td data-label="{{ __('Account No') }}">{{ $receiver != NULL ? $receiver->account_number : 'User Deleted' }}</td>
                                            <td data-label="{{ __('Account Name') }}">{{ $receiver != NULL ? $receiver->name : 'User Deleted' }}</td>
                                          @endif

                                          @if (!$data->receiver_id)
                                            @php
                                              $beneficiary = App\Models\Beneficiary::whereId($data->beneficiary_id)->first();
                                            @endphp
                                            <td data-label="{{ __('Account No') }}">{{ $beneficiary != NULL ? $beneficiary->account_number : 'deleted' }}</td>
                                            <td data-label="{{ __('Account Name') }}">{{ $beneficiary != NULL ? $beneficiary->account_name : 'deleted' }}</td>
                                          @endif
                                          <td data-label="{{ __('Type') }}">{{ $data->type }} {{ __('Bank') }}</td>
                                          <td data-label="{{ __('Amount') }}">{{ showNameAmount($data->amount) }}</td>
                                          <td data-label="{{ __('Status') }}">
                                            @if ($data->status == 1)
                                              <span class="badge bg-success">{{ __('Completed')}}</span>
                                            @elseif($data->status == 2)
                                              <span class="badge bg-danger">{{ __('Rejected')}}</span>
                                            @else
                                              <span class="badge bg-warning">{{ __('Pending')}}</span>
                                            @endif
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

