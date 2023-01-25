@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('New Beneficiary')}}
          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card p-5">
                    <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                        @includeIf('includes.flash')
                        <form action="{{route('user.beneficiaries.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="form-label required">{{__('Others Bank')}}</label>
                                <select name="other_bank_id" class="form-select bankId" required>
                                    <option value="">{{ __('Select Bank') }}</option>
                                    @foreach ($othersBank as $key=>$data)
                                        <option value="{{$data->id}}" data-requirements="{{ json_decode(json_encode($data->required_information,true)) }}">{{$data->title}}</option>
                                    @endforeach                    
                                </select>
                            </div>

                            <div class="form-group mb-3 mt-3">
                                <label class="form-label required">{{__('Account Number')}}</label>
                                <input name="account_number" id="account_number" class="form-control" autocomplete="off" placeholder="{{__('000.000.0000')}}" type="text" value="{{ old('account_number') }}" min="1" required>
                            </div>

                            <div class="form-group mb-3 mt-3">
                                <label class="form-label required">{{__('Account Name')}}</label>
                                <input name="account_name" id="account_name" class="form-control" autocomplete="off" placeholder="{{__('Jhon Doe')}}" type="text" value="{{ old('account_name') }}" min="1" required>
                            </div>

                            <div class="form-group mb-3 mt-3">
                                <label class="form-label required">{{__('Nick Name')}}</label>
                                <input name="nick_name" id="nick_name" class="form-control" autocomplete="off" placeholder="{{__('Doe')}}" type="text" value="{{ old('nick_name') }}" min="1" required>
                            </div>

                            <div id="required-form-element">

                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100">{{__('Submit')}}</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')
    <script>
        'use strict';
        $(".bankId").on('change',function(){
            let requirements = $(this).find('option:selected').data('requirements');

            let output = ``;
            requirements.forEach(element => {
            
                    if(element.type == 'text') {
                        output +=
                        `
                            <div class="form-group mb-3 mt-3">
                                <label class="form-label ${element.validation}">{{__('${element.field_name}')}}</label>
                                <input type="text" name="${element.field_name}" class="form-control" autocomplete="off" placeholder="{{__('${element.field_name}')}}" min="1" ${element.validation}>
                            </div>
                        `;
                    }else if(element.type == 'textarea'){
                        output +=
                        `
                            <div class="form-group mb-3 mt-3">
                                <label class="form-label ${element.validation}">{{__('${element.field_name}')}}</label>
                                <textarea type="text" name="${element.field_name}" class="form-control" autocomplete="off" placeholder="{{__('${element.field_name}')}}" ${element.validation}></textarea>
                            </div>
                        `;
                    }else if(element.type == 'file'){
                        output +=
                        `
                            <div class="form-group mb-3 mt-3">
                                <label class="form-label ${element.validation}">{{__('${element.field_name}')}}</label>
                                <input type="file" name="${element.field_name}" class="form-control" autocomplete="off" ${element.validation}>
                            </div>
                        `
                    }
                });
                $('#required-form-element').html(output).hide().fadeIn(500);
        })
    </script>
@endpush
