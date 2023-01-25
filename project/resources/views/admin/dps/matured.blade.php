@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between">
	<h5 class=" mb-0 text-gray-800 pl-3">{{ __('Matured DPS') }}</h5>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.dps.index') }}">{{ __('DPS') }}</a></li>
	</ol>
	</div>
</div>


<div class="row mt-3">
  <div class="col-lg-12">

	@include('includes.admin.form-success')

	<div class="card mb-4">
	  <div class="table-responsive p-3">
		<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
		  <thead class="thead-light">
			<tr>
				<th>{{__('Plan No')}}</th>
				<th>{{__('Deposit Amount')}}</th>
				<th>{{__('User')}}</th>
				<th>{{__('Total Installment')}}</th>
				<th>{{__('Matured Amount')}}</th>
				<th>{{__('Next Installment')}}</th>
				<th>{{__('Action')}}</th>
			</tr>
		  </thead>
		</table>
	  </div>
	</div>
  </div>
</div>


@endsection


@section('scripts')

<script type="text/javascript">
	"use strict";

    var table = $('#geniustable').DataTable({
           ordering: false,
           processing: true,
           serverSide: true,
           searching: false,
           ajax: '{{ route('admin.dps.datatables',['status' => 2]) }}',
           columns: [
				{ data: 'transaction_no', name: 'transaction_no' },
				{ data: 'deposit_amount', name: 'deposit_amount' },
				{ data: 'user_id', name: 'user_id' },
				{ data: 'total_installment', name: 'total_installment' },
				{ data: 'matured_amount', name: 'matured_amount' },
				{ data: 'next_installment', name: 'next_installment' },
				{ data: 'action', searchable: false, orderable: false }
            ],
            language : {
                processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
            }
        });

</script>

@endsection


