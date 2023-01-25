@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between py-3">
	<h5 class=" mb-0 text-gray-800 pl-3">{{ __('Wire Transfer') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.wire.transfer.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
	<ol class="breadcrumb m-0 py-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.wire.transfer.show',$data->id) }}">{{ __('Other Bank Transfer Details') }}</a></li>
	</ol>
	</div>
</div>


<div class="row justify-content-center mt-3">
    <div class="col-lg-10">
      @include('includes.admin.form-success')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="special-box">
                        <div class="heading-area">
                            <h4 class="title">
                            {{__('Transfer Details')}}
                            </h4>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table">
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
                                    <th width="45%">{{__('Sender Account Name')}}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ $data->user->name }}</td>
                                </tr>
    
                                <tr>
                                    <th width="45%">{{__('Sender Account Number')}}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ $data->user->account_number }}</td>
                                </tr>
    `
                                </tbody>
                            </table>
                        </div>
                        <div class="footer-area">
                            <a href="javascript:;" data-toggle="modal" data-target="#statusModal" data-href="{{ route('admin.wire.transfer.status',['id1' => $data->id, 'id2' => 1]) }}" class="btn btn-primary"><i class="far fa-check-circle"></i> {{__('Approve')}}</a>
                            <a href="javascript:;" data-toggle="modal" data-target="#statusModal" data-href="{{ route('admin.wire.transfer.status',['id1' => $data->id, 'id2' => 0]) }}" class="btn btn-danger ml-3"><i class="fas fa-minus-circle"></i> {{__('Reject')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
  </div>
</div>

{{-- STATUS MODAL --}}
<div class="modal fade status-modal" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">{{ __("Update Status") }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p class="text-center">{{ __("You are about to change the status.") }}</p>
				<p class="text-center">{{ __("Do you want to proceed?") }}</p>
			</div>

			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-secondary" data-dismiss="modal">{{ __("Cancel") }}</a>
				<a href="javascript:;" class="btn btn-success btn-ok">{{ __("Update") }}</a>
			</div>
		</div>
	</div>
</div>
{{-- STATUS MODAL ENDS --}}

@endsection


@section('scripts')

@endsection