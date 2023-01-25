
@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <h2 class="page-title">
            {{__('Changed Password')}}
          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card p-4">
                    @includeIf('includes.flash')
                    <form id="request-form" action="" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3 mt-3">
                            <label class="form-label required">{{__('Change Password')}}</label>
                            <input name="cpass" class="form-control form--control" autocomplete="off" placeholder="{{__('Change Password')}}" type="password" required>
                        </div>

                        <div class="form-group mb-3 mt-3">
                            <label class="form-label required">{{__('New Password')}}</label>
                            <input name="newpass" class="form-control form--control" autocomplete="off" placeholder="{{__('Change Password')}}" type="password" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label required">{{__('Re-Type New Password')}}</label>
                            <input name="renewpass" class="form-control form--control" autocomplete="off" placeholder="{{__('Re-Type New Password')}}" type="password" required>
                        </div>


                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary submit-btn">{{__('Submit')}}</button>
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

@endpush