@extends('layouts.user')

@push('css')

@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Commissions Log')}}
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
                    @if (count($commissions) == 0)
                        <h3 class="text-center py-5">{{__('No Data Found')}}</h3>
                    @else
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('From') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($commissions as $key=>$data)
                                    @php
                                        $receiver = App\Models\User::whereId($data->from_user_id)->first();
                                    @endphp
                                        <tr>
                                            <td data-label="{{ __('Date') }}">
                                                <div>
                                                    {{ $data->created_at->toDateString() }}
                                                </div>
                                            </td>

                                            <td data-label="{{ __('Type') }}">
                                                <div>
                                                    {{ ucfirst($data->type) }}
                                                </div>
                                            </td>

                                            <td data-label="{{ __('From') }}">
                                                <div>
                                                    {{  $receiver != NULL ? $receiver->name : '' }}
                                                </div>
                                            </td>

                                            <td data-label="{{ __('Amount') }}">
                                                <div>
                                                    {{ showNameAmount($data->amount) }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $commissions->render() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

@endpush

