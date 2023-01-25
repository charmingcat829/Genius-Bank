@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center py-3 justify-content-between">
        <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Loan Details') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.loan.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
        <ol class="breadcrumb py-0 m-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">{{ __('Loan Details') }}</a></li>
        </ol>
    </div>
</div>

<div class="row mt-3">
    <div class="col-lg-12">
        @include('includes.admin.form-success')
        <div class="row">
            <div class="col-lg-6">
                <div class="special-box">
                    <div class="heading-area">
                        <h4 class="title">
                            {{__('Required Information')}}
                        </h4>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tbody>

                                @foreach ($requiredInformations as $key=>$value)
                                    @if ($value[1] == 'file')
                                    <tr>
                                        <th width="45%">{{$key}}</th>
                                        <td width="10%">:</td>
                                        <td width="45%"><a href="{{asset('assets/images/'.$value[0])}}" download><img src="{{asset('assets/images/'.$value[0])}}" class="img-thumbnail"></a></td>
                                    </tr>
                                    @else 
                                        <tr>
                                            <th width="45%">{{$key}}</th>
                                            <td width="10%">:</td>
                                            <td width="45%">{{ $value[0] }}</td>
                                        </tr>
                                    @endif
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <div class="footer-area">
                        @if ($data->status == 0)
                            <a href="javascript:;" data-toggle="modal" data-target="#statusModal" data-href="{{ route('admin.loan.status',['id1' => $data->id, 'id2' => 1]) }}" class="btn btn-primary"><i class="far fa-check-circle"></i> {{__('Approve')}}</a>
                            <a href="javascript:;" data-toggle="modal" data-target="#statusModal" data-href="{{ route('admin.loan.status',['id1' => $data->id, 'id2' => 2]) }}" class="btn btn-danger ml-3"><i class="fas fa-minus-circle"></i> {{__('Reject')}}</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="special-box">
                    <div class="heading-area">
                        <h4 class="title">
                        {{__('Loan Details')}}
                        </h4>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tbody>
                                    <tr>
                                        <th width="45%">{{__('Plan No')}}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{$data->transaction_no}}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">{{__('Plan Name')}}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{$data->plan->title}}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">{{__('User')}}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{$data->user->name}}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">{{__('Request Amount')}}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{ $currency->sign}} {{$data->loan_amount}}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">{{__('Pay Amount')}}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{ $currency->sign}} {{round($data->total_installment * $data->per_installment_amount,2)}}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">{{__('Total Installment')}}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{$data->total_installment}}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">{{__('Per Installment')}}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{ $currency->sign}} {{$data->per_installment_amount}}</td>
                                    </tr>
                                    <tr>
                                        <th width="45%">{{__('Given Installment')}}</th>
                                        <th width="10%">:</th>
                                        <td width="45%">{{$data->given_installment}}</td>
                                    </tr>
                            </tbody>
                        </table>
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
