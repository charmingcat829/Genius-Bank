@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/admin/css/codemirror.min.css')}}">
{{-- <link rel="stylesheet" href="{{asset('assets/admin/css/monokai.min.css')}}"> --}}
@endsection

@section('content')
<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between py-3">
        <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Custom Css') }}</h5>
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">{{ __('General Settings') }}</a></li>
        </ol>
    </div>
</div>

  <div class="card mb-4 mt-3">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Custom Css') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{ route('admin.gs.customcss.submit') }}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

          <div class="form-group">
            <textarea class="form-control css_editor" id="css_editor" name="custom_css" cols="30" rows="10">{{ $data }}</textarea>
          </div>

          <button type="submit" id="submit-btn" class="btn btn-primary w-100">{{ __('Submit') }}</button>
        </div>

      </form>
    </div>
  </div>

@endsection

@section('scripts')
<script src="{{ asset('assets/admin/js/codemirror.js') }}"></script>
<script src="{{asset('assets/admin/js/css.js')}}"></script>
<script src="{{asset('assets/admin/js/sublime.min.js')}}"></script>
<script src="{{asset('assets/admin/js/show-hint.js')}}"></script>
<script src="{{asset('assets/admin/js/css-hint.js')}}"></script>

<script>
    "use strict";
    var editor = CodeMirror.fromTextArea(document.getElementById("css_editor"), {
      lineNumbers: true,
      mode: "text/css",
      theme: "monokai",
      keyMap: "sublime",
      autoCloseBrackets: true,
      matchBrackets: true,
      showCursorWhenSelecting: true,
      matchBrackets: true
    });
</script>

@endsection
