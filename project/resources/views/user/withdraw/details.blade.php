@extends('layouts.user')

@push('css')

@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Withdraw Details')}}
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
                    <div class="table-responsive-sm">
                        <table class="table mb-0">
                            <tbody>
                            <tr>
                                <th class="45%" width="45%">{{__('WithDraw Method')}}</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">{{ $data->method }}</td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%">{{__('User Name')}}</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">{{ $data->user->name }}</td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%">{{__('Amount')}}</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">{{ showNameAmount($data->amount) }}</td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%">{{__('Fees')}}</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">{{ showNameAmount($data->fee) }}</td>
                            </tr>

                            <tr>
                                <th class="45%" width="45%">{{__('Status')}}</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">
                                  @if ($data->status == 'completed')
                                    <span class="badge bg-success">{{__('Completed')}}</span>
                                  @elseif($data->status == 'pending')
                                    <span class="badge bg-warning">{{__('Pending')}}</span>
                                  @else
                                    <span class="badge bg-danger">{{__('Rejected')}}</span>
                                  @endif
                                </td>
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
