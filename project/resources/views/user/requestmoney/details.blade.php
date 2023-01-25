@extends('layouts.user')

@push('css')

@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Request Money Details')}}
          </h2>
        </div>

      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
          <div class="col-12">
              <div class="card mb-4">
                <div class="card-body">
                    <div class="heading-area">
                        <h4 class="title">
                        {{__('Request Money')}}
                        </h4>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th class="45%" width="45%">{{__('Request From')}}</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">{{ $from->name }}</td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%">{{__('Request To')}}</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">{{ $to->name }}</td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%">{{__('Amount')}}</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">{{ showNameAmount($data->amount) }}</td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%">{{__('Cost')}}</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">{{ showNameAmount($data->cost) }}</td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%">{{__('Amount To Get')}}</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">{{ showNameAmount(($data->amount - $data->cost)) }}</td>
                            </tr>

                            <tr>
                                <th width="45%">{{__('Details')}}</th>
                                <td width="10%">:</td>
                                <td width="45%">{{ $data->details }}</td>
                            </tr>

                            <tr>
                                <th width="45%">{{__('Request Date')}}</th>
                                <td width="10%">:</td>
                                <td width="45%">{{ $data->created_at->diffForHumans() }}</td>
                            </tr>

                            </tbody>
                        </table>
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

