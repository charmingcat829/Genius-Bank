@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Wire Transfer Details')}}
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
                                    <th class="45%" width="45%">{{__('Bank Name')}}</th>
                                    <td width="10%">:</td>
                                    <td class="45%" width="45%">{{$data->bank->title}}</td>
                                </tr>

                                <tr>
                                    <th class="45%" width="45%">{{__('Swift Code')}}</th>
                                    <td width="10%">:</td>
                                    <td class="45%" width="45%">{{ $data->swift_code }}</td>
                                </tr>

                                <tr>
                                    <th class="45%" width="45%">{{__('Currency')}}</th>
                                    <td width="10%">:</td>
                                    <td class="45%" width="45%">{{ $data->currency }}</td>
                                </tr>

                                <tr>
                                    <th class="45%" width="45%">{{__('Routing Number')}}</th>
                                    <td width="10%">:</td>
                                    <td class="45%" width="45%">{{ $data->routing_number }}</td>
                                </tr>

                                <tr>
                                    <th class="45%" width="45%">{{__('Country')}}</th>
                                    <td width="10%">:</td>
                                    <td class="45%" width="45%">{{ $data->country }}</td>
                                </tr>

                                <tr>
                                    <th width="45%">{{__('Receiver Account Name')}}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ $data->account_holder_name }}</td>
                                </tr>
    
                                <tr>
                                    <th width="45%">{{__('Receiver Account Number')}}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ $data->account_number }}</td>
                                </tr>

                                <tr>
                                    <th width="45%">{{__('Status')}}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">
                                        <span class="badge bg-{{ $data->status == 1 ? 'success' : 'warning'}}">{{ $data->status == 1 ? 'completed' : 'pending'}}</span>
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
