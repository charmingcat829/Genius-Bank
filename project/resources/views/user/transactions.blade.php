@extends('layouts.user')

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Transaction')}}
          </h2>
        </div>
		<div class="col-auto ms-auto d-print-none">
			<div class="btn-list">

			  <a href="{{ route('user.export.pdf') }}" class="btn btn-primary d-none d-sm-inline-block">
				<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
				{{__('Export pdf')}}
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
					<div class="table-responsive">
						<table class="table card-table table-vcenter text-nowrap datatable">
						  <thead>
							<tr>
							  <th class="w-1">@lang('No').
								<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 15 12 9 18 15" /></svg>
							  </th>
							  <th>@lang('Type')</th>
							  <th>@lang('Txnid')</th>
							  <th>@lang('Amount')</th>
							  <th>@lang('Date')</th>
							  <th></th>
							</tr>
						  </thead>
						  <tbody>
							@forelse ($transactions as $key=>$data)
							  <tr>
								<td data-label="@lang('No')">
								  <div>

									<span class="text-muted">{{ $loop->iteration }}</span>
								  </div>
								</td>

								<td data-label="@lang('Type')">
								  <div>
									{{ strtoupper($data->type) }}
								  </div>
								</td>

								<td data-label="@lang('Txnid')">
								  <div>
									{{ $data->txnid }}
								  </div>
								</td>

								<td data-label="@lang('Amount')">
								  <div>
									<p class="text-{{ $data->profit == 'plus' ? 'success' : 'danger'}}">{{ showNameAmount($data->amount) }}</p>
								  </div>
								</td>

								<td data-label="@lang('Date')">
								  <div>
									{{date('d M Y',strtotime($data->created_at))}}
								  </div>
								</td>

							  </tr>
							@empty
							  <p>@lang('NO DATA FOUND')</p>
							@endforelse

						  </tbody>
						</table>
					  </div>
                      {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
