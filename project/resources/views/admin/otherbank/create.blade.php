@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="d-sm-flex align-items-center justify-content-between py-3">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Add New Bank') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.other.banks.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
    <ol class="breadcrumb m-0 py-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.other.banks.index')}}">{{ __('Other Bank') }}</a></li>
    </ol>
  </div>
</div>

<div class="row justify-content-center mt-3">
<div class="col-md-10">
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Add New Bank Form') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{route('admin.other.banks.store')}}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="title">{{ __('Bank Name') }}</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('Enter Bank Name') }}" value="" required>
                  </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <label for="processing_time">{{ __('Processing Time') }}</label>
                    <input type="text" class="form-control" id="processing_time" name="processing_time" placeholder="{{ __('Enter Processing Time') }}" min="1" value="" required>
                  </div>
              </div>
          </div>


          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="min_limit">{{ __('Minimum Amount') }} ({{$currency->name}})</label>
                    <input type="number" class="form-control" id="min_limit" name="min_limit" placeholder="{{ __('0') }}" min="1" value="" required>
                  </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <label for="max_limit">{{ __('Maximum Amount') }} ({{$currency->name}})</label>
                    <input type="number" class="form-control" id="max_limit" name="max_limit" placeholder="{{ __('0') }}" min="1" value="" required>
                  </div>
              </div>
          </div>


          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="daily_maximum_limit">{{ __('Daily Maximum Amount') }} ({{$currency->name}})</label>
                    <input type="number" class="form-control" id="daily_maximum_limit" name="daily_maximum_limit" placeholder="{{ __('0') }}" min="1" value="" required>
                  </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <label for="daily_total_transaction">{{ __('Daily Transaction Limit') }}</label>
                    <input type="number" class="form-control" id="daily_total_transaction" name="daily_total_transaction" placeholder="{{ __('0') }}" min="1" value="" required>
                  </div>
              </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <label for="monthly_maximum_limit">{{ __('Monthly Maximum Amount') }} ({{$currency->name}})</label>
                  <input type="number" class="form-control" id="monthly_maximum_limit" name="monthly_maximum_limit" placeholder="{{ __('0') }}" min="1" value="" required>
                </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                  <label for="monthly_total_transaction">{{ __('Monthly Transaction Limit') }}</label>
                  <input type="number" class="form-control" id="monthly_total_transaction" name="monthly_total_transaction" placeholder="{{ __('0') }}" min="1" value="" required>
                </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <label for="fixed_charge">{{ __('Fixed Charge') }}</label>
                  <input type="number" class="form-control" id="fixed_charge" name="fixed_charge" placeholder="{{ __('0') }}" min="1" value="" required>
                </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                  <label for="percent_charge">{{ __('Percent Charge') }} (%)</label>
                  <input type="number" class="form-control" id="percent_charge" name="percent_charge" placeholder="{{ __('0') }}" min="1" value="" required>
                </div>
            </div>
         </div>

         <div class="lang-tag-top-filds" id="lang-section">
          <label for="instruction">{{ __("Required Information") }}</label>
          <div class="lang-area mb-3">
            <span class="remove lang-remove"><i class="fas fa-times"></i></span>
            <div class="row">
              <div class="col-md-6">
                <input type="text" name="form_builder[1][field_name]" class="form-control" placeholder="{{ __('Field Name') }}">
              </div>

              <div class="col-md-3">
                <select name="form_builder[1][type]" class="form-control">
                    <option value="text"> {{__('Input')}} </option>
                    <option value="textarea"> {{__('Textarea')}} </option>
                    <option value="file"> {{__('File upload')}} </option>
                </select>
              </div>

              <div class="col-md-3">
                <select name="form_builder[1][validation]" class="form-control">
                    <option value="required"> {{__('Required')}} </option>
                    <option value="nullable">  {{__('Optional')}} </option>
                </select>
              </div>
            </div>
          </div>
        </div>


        <a href="javascript:;" id="lang-btn" class="add-fild-btn d-flex justify-content-center"><i class="icofont-plus"></i> {{__('Add More Field')}}</a>



        <div class="row d-flex justify-content-center">
            <button type="submit" id="submit-btn" class="btn btn-primary w-100 mt-3">{{ __('Submit') }}</button>
        </div>

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

  let id = 2;

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

</script>

@endsection