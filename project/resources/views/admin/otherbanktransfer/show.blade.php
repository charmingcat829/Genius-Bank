@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between py-3">
	<h5 class=" mb-0 text-gray-800 pl-3">{{ __('Other Bank Transfer') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.other.banks.transfer.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
	<ol class="breadcrumb m-0 py-0">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.other.banks.transfer.show',$data->id) }}">{{ __('Other Bank Transfer Details') }}</a></li>
	</ol>
	</div>
</div>


<div class="row justify-content-center mt-3">
  <div class="col-lg-10">
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
                                    <th width="45%">{{__('Account Name')}}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{$data->beneficiary->account_name}}</td>
                                </tr>
    
                                <tr>
                                    <th width="45%">{{__('Account Number')}}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{$data->beneficiary->account_number}}</td>
                                </tr>
    
                                @foreach (json_decode($data->beneficiary->details,true) as $key=>$value)
                                    @if ($value[1] == 'file')
                                        <tr>
                                            <th width="45%">{{$key}}</th>
                                            <td width="10%">:</td>
                                            <td width="45%"><img src="{{asset('assets/images/'.$value[0])}}" class="img-thumbnail"></td>
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
    
    
    
                    </div>
    
                </div>
            </div>
        </div>
      </div>
  </div>
</div>


@endsection


@section('scripts')

@endsection


