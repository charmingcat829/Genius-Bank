@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="d-sm-flex align-items-center justify-content-between py-3">
  <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Edit Plan') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.loan.plan.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
  <ol class="breadcrumb m-0 py-0">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
      <li class="breadcrumb-item"><a href="{{route('admin.loan.plan.index')}}">{{ __('Loan Plan') }}</a></li>
      <li class="breadcrumb-item"><a href="{{route('admin.loan.plan.edit',$data->id)}}">{{ __('Edit Plan') }}</a></li>
  </ol>
  </div>
</div>

<div class="row justify-content-center mt-3">
<div class="col-md-10">
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit Plan Form') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{route('admin.loan.plan.update',$data->id)}}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

          <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('Enter Title') }}" value="{{ $data->title}}" required>
          </div>

          <div class="form-group">
            <label for="min_amount">{{ __('Minimum Price in') }} ({{$currency->name}})</label>
            <input type="number" class="form-control" id="min_amount" name="min_amount" placeholder="{{ __('Enter Minimum Price') }}" min="1" step="0.01" value="{{ $data->min_amount}}" required>
          </div>

          <div class="form-group">
            <label for="max_amount">{{ __('Maximum Price in') }} ({{$currency->name}})</label>
            <input type="number" class="form-control" id="max_amount" name="max_amount" placeholder="{{ __('Enter Maximum Price') }}" min="1" step="0.01" value="{{ $data->max_amount}}" required>
          </div>

          <div class="form-group">
            <label for="per_installment">{{ __('Per Installment') }} (%)</label>
            <input type="number" class="form-control" id="per_installment" name="per_installment" placeholder="{{ __('Per Installment') }}" min="1" step="0.01" value="{{ $data->per_installment}}" required>
          </div>

          <div class="form-group">
            <label for="installment_interval">{{ __('Installment Interval') }}</label>
            <input type="number" class="form-control" id="installment_interval" name="installment_interval" placeholder="{{ __('Installment Interval') }}" min="1" step="0.01" value="{{ $data->installment_interval }}" required>
          </div>

          <div class="form-group">
            <label for="total_installment">{{ __('Total Installment') }}</label>
            <input type="number" class="form-control" id="total_installment" name="total_installment" placeholder="{{ __('Total Installment') }}" min="1" value="{{ $data->total_installment}}" required>
          </div>
          
          <div class="form-group">
            <h3 id="profitShow" class="text-center"></h3>
          </div>


          <div class="lang-tag-top-filds" id="lang-section">
            <label for="instruction">{{ __("Required Information") }}</label>
            @if (count($informations) != 0)
              @foreach ($informations as $key=>$info)
                <div class="lang-area mb-3">
                  <span class="remove lang-remove"><i class="fas fa-times"></i></span>
                  <div class="row">
                    <div class="col-md-6">
                      <input type="text" name="form_builder[{{ $key }}][field_name]" class="form-control" placeholder="{{ __('Field Name') }}" value="{{ $info['field_name'] }}">
                    </div>

                    <div class="col-md-3">
                      <select name="form_builder[{{ $key }}][type]" class="form-control">
                          <option value="text" {{ $info['type'] == 'text' ? 'selected' : '' }}> {{__('Input')}} </option>
                          <option value="textarea" {{ $info['type'] == 'textarea' ? 'selected' : '' }}> {{__('Textarea')}} </option>
                          <option value="file" {{ $info['type'] == 'file' ? 'selected' : '' }}> {{__('File upload')}} </option>
                      </select>
                    </div>

                    <div class="col-md-3">
                      <select name="form_builder[{{ $key }}][validation]" class="form-control">
                          <option value="required" {{ $info['validation'] == 'required' ? 'selected' : '' }}> {{__('Required')}} </option>
                          <option value="nullable" {{ $info['validation'] == 'nullable' ? 'selected' : '' }}>  {{__('Optional')}} </option>
                      </select>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif


          </div>


          <a href="javascript:;" id="lang-btn" class="add-fild-btn d-flex justify-content-center"><i class="icofont-plus"></i> {{__('Add More Field')}}</a>

          <button type="submit" id="submit-btn" class="btn btn-primary w-100 mt-2">{{ __('Submit') }}</button>

      </form>
    </div>
  </div>
</div>

</div>

@endsection

@section('scripts')
<script type="text/javascript">
  'use strict';
  function isEmpty(el){
      return !$.trim(el.html())
  }

  let id = '{{count($informations) == 0 ? 1 : count($informations) + 1}}';

$("#lang-btn").on('click', function(){

    $("#lang-section").append(''+
            `<div class="lang-area mb-3">
            <span class="remove lang-remove"><i class="fas fa-times"></i></span>
            <div class="row">
              <div class="col-md-6">
                <input type="text" name="form_builder[${id}][field_name]" class="form-control" placeholder="{{ __('Field Name') }}">
              </div>

              <div class="col-md-3">
                <select name="form_builder[${id}][type]" class="form-control rounded-0">
                    <option value="text"> Input </option>
                    <option value="textarea"> Textarea </option>
                    <option value="file"> File upload </option>
                </select>
              </div>

              <div class="col-md-3">
                <select name="form_builder[${id}][validation]" class="form-control rounded-0">
                    <option value="required"> Required </option>
                    <option value="nullable">  Optional </option>
                </select>
              </div>
            </div>
          </div>`+
          '');
      id ++;
});

$(document).on('click','.lang-remove', function(){

    $(this.parentNode).remove();
    if(id && id >1){
      id --;
    }
    if (isEmpty($('#lang-section'))) {

      $("#lang-section").append(''+
            `<div class="lang-area mb-3">
            <span class="remove lang-remove"><i class="fas fa-times"></i></span>
            <div class="row">
              <div class="col-md-6">
                <input type="text" name="form_builder[1][field_name]" class="form-control" placeholder="{{ __('Field Name') }}">
              </div>

              <div class="col-md-3">
                <select name="form_builder[1][type]" class="form-control rounded-0">
                    <option value="text"> Input </option>
                    <option value="textarea"> Textarea </option>
                    <option value="file"> File upload </option>
                </select>
              </div>

              <div class="col-md-3">
                <select name="form_builder[1][validation]" class="form-control rounded-0">
                    <option value="required"> Required </option>
                    <option value="nullable">  Optional </option>
                </select>
              </div>
            </div>
          </div>`+
          '');
    }

});

$("#per_installment").on('input',()=>{
  profitCalculation();
})

$("#total_installment").on('input',()=>{
  profitCalculation();
})

function profitCalculation(){
  let perInstallment = parseFloat($("#per_installment").val());
  let totalInstallment = parseFloat($("#total_installment").val());

  if(perInstallment && totalInstallment){
    let profitLoss = (perInstallment * totalInstallment).toFixed(2);

    if(profitLoss>100){
      let profit = profitLoss - 100;
      $("#profitShow").text(`You will get ${profit} % profit`).removeClass('text-danger').addClass('text-success');
    }else if(profitLoss == 100){
      $("#profitShow").text(`You will get 0 % profit`).removeClass('text-danger').addClass('text-success');
    }else{
      let loss = 100 - profitLoss;
      $("#profitShow").text(`You will get ${loss} % loss`).removeClass('text-success').addClass('text-danger');
    }
  }
}

</script>
@endsection
