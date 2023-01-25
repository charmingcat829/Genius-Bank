@extends('layouts.user')

@push('css')

@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Loan Apply Form')}}
          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-12">
                <div class="card p-4">
                    <table class="table table-transparent table-responsive">

                        <tbody>
                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Plan Title')}}</p>
                                </td>
                                <td class="text-end">{{$data->title}}</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Loan Amount')}}</p>
                                </td>
                                <td class="text-end">{{ $loanAmount.' '.$currency->sign }}</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Total Installment')}}</p>
                                </td>
                                <td class="text-end">{{ $data->total_installment }}</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1">{{__('Per Installment')}}</p>
                                </td>
                                <td class="text-end">{{ $perInstallment.' '.$currency->sign }}</td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="strong mb-1 text-danger">{{__('Total Amount To Pay')}}</p>
                                </td>
                                <td class="text-end text-danger">{{ $perInstallment * $data->total_installment.' '.$currency->sign }}</td>
                            </tr>

                        </tbody>
                    </table>

                    <form action="{{route('user.loan.request')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="plan_id" value="{{ $data->id }}">
                        <input type="hidden" name="total_installment" value="{{ $data->total_installment }}">
                        <input type="hidden" name="loan_amount" value="{{ $loanAmount }}">
                        <input type="hidden" name="per_installment_amount" value="{{ $perInstallment }}">
                        <input type="hidden" name="total_amount" value="{{ $perInstallment * $data->total_installment }}">

                        @if ($data->required_information)
                            @foreach (json_decode($data->required_information,true) as $key=>$value)
                                @if ($value['type'] == 'file')
                                    <div class="form-group mb-3 mt-3">
                                        <label class="form-label" {{$value['validation']}}> {{$value['field_name']}} </label>
                                        <input type="file" name="{{$value['field_name']}}" class="form-control" autocomplete="off" {{$value['validation']}}>
                                    </div>
                                @endif

                                @if ($value['type'] == 'text')
                                    <div class="form-group mb-3 mt-3">
                                        <label class="form-label" {{$value['validation']}}> {{$value['field_name']}} </label>
                                        <input type="text" name="{{$value['field_name']}}" placeholder="{{$value['field_name']}}" class="form-control" autocomplete="off" {{$value['validation']}}>
                                    </div>
                                @endif

                                @if ($value['type'] == 'textarea')
                                    <div class="form-group mb-3 mt-3">
                                        <label class="form-label" {{$value['validation']}}> {{$value['field_name']}} </label>
                                        <textarea type="text" name="{{$value['field_name']}}" placeholder="{{$value['field_name']}}" cols="30" class="form-control" {{$value['validation']}}></textarea>
                                    </div>
                                @endif

                            @endforeach
                        @endif

                        <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection

@push('js')

@endpush

