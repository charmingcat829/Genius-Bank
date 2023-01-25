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
            {{__('Request Money')}}
          </h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
          <div class="btn-list">

            <a href="{{ route('user.money.request.create') }}" class="btn btn-primary d-none d-sm-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              {{__('Add Request Money')}}
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
                    @if (count($requests) == 0)
                        <h3 class="text-center py-5">{{__('No Request Money Data Found')}}</h3>
                    @else
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-lg card-table">
                                <thead>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Sender') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Receiver') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Details') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach($requests as $key=>$data)
                                      <tr>
                                          <td data-label="{{ __('Date') }}">
                                            <div>
                                              {{ $data->created_at->toFormattedDateString() }}
                                            </div>
                                          </td>
                                          <td data-label="{{ __('Sender') }}">
                                            <div>
                                              {{ auth()->user()->name }}
                                            </div>
                                          </td>
                                          <td data-label="{{ __('Amount') }}">
                                            <div>
                                              {{ showNameAmount($data->amount) }}
                                            </div>
                                          </td>
                                          <td data-label="{{ __('Receiver') }}">
                                            <div>
                                              {{ $data->receiver_name }}
                                            </div>
                                          </td>
                                          <td data-label="{{ __('Status') }}">
                                            <div>
                                              <span class="badge badge-{{ $data->status == 1 ? 'success' : 'warning'}}">{{ $data->status == 1 ? 'completed' : 'pending'}}</span>
                                            </div>
                                          </td>

                                          <td data-label="{{ __('Details') }}">
                                            <div class="btn-list">
                                                <a href="{{route('user.money.request.details',$data->id)}}" class="btn btn-primary">
                                                  {{__('Details')}}
                                                </a>
                                            </div>
                                          </td>
                                      </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $requests->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

@endpush

