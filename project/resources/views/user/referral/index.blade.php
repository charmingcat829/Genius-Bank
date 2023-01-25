@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('My Referred')}}
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
                    @if (count($referreds) == 0)
                        <h3 class="text-center py-5">{{__('No Data Found')}}</h3>
                    @else 
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-sm card-table">
                                <thead>
                                <tr>
                                    <th>{{ __('Serial No') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Joined At') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($referreds as $key=>$data)
                                        <tr>
                                            <td data-label="{{ __('Serial No') }}">
                                                <div>
                                                    {{ $loop->iteration }}
                                                </div>
                                            </td>
                                            <td data-label="{{ __('Name') }}">
                                                <div>
                                                    {{ ucfirst($data->name) }}
                                                </div>
                                            </td>
                                            <td data-label="{{ __('Joined At') }}">
                                                <div>
                                                    {{ $data->created_at->diffForHumans() }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $referreds->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

@endpush

