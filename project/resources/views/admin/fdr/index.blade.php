@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between">
	<h5 class=" mb-0 text-gray-800 pl-3">{{ __('FDR') }}</h5>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.fdr.index') }}">{{ __('FDR') }}</a></li>
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
				<th>{{__('User')}}</th>
				<th>{{__('Fdr Amount')}}</th>
				<th>{{__('Profit Type')}}</th>
				<th>{{__('Profit')}}</th>
				<th>{{__('Status')}}</th>
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
           searching: true,
           ajax: '{{ route('admin.fdr.datatables',['status' => 'all']) }}',
           columns: [
				{ data: 'transaction_no', name: 'transaction_no' },
				{ data: 'user_id', name: 'user_id' },
				{ data: 'amount', name: 'amount' },
				{ data: 'profit_type', name: 'profit_type' },
				{ data: 'profit_amount', name: 'profit_amount' },
				{ data: 'status', name: 'status' },
            ],
            language : {
                processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
            }
        });

</script>

@endsection


