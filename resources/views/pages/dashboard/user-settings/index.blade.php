@extends('layouts.app')
@section('title')
    {{ __('Settings') }}
@endsection
@section('breadcrumb')
    {{ __('Settings') }}
@endsection
@section('breadcrumbActive')
    {{ __('Customize') }}
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-no-border pb-0">
        <h3>{{ __('Customize') }}</h3>
        <p class="mb-0">{{ __('Choose interface settings and they will be applied instantly') }}</p>
      </div>
      <div class="card-body">
        @php $settings = auth()->user()->userSettings; @endphp
        <form id="settingsForm" class="needs-validation" novalidate method="POST" action="{{ route('settings.update') }}">
          @csrf
          @method('PUT')
        <div class="mb-3 p-2 rounded-3 b-t-primary border-3">
          <div class="color-header mb-2">
            <h4>{{ __('Theme Mode') }}</h4>
            <p>{{ __('Choose between Light / Dark / Mix') }}</p>
          </div>
          <div class="row g-2 align-items-stretch">
            <div class="col-auto">
              <input type="radio" class="btn-check" name="mode" id="mode-light" value="Light" autocomplete="off" {{ ($settings && $settings->mode === 'Light') || (!$settings) ? 'checked' : '' }} required>
              <label class="btn btn-outline-success text-start d-flex align-items-center gap-2" for="mode-light">
                <span>{{ __('Light') }}</span>
              </label>
            </div>
            <div class="col-auto">
              <input type="radio" class="btn-check" name="mode" id="mode-dark" value="Dark" autocomplete="off" {{ ($settings && $settings->mode === 'Dark') ? 'checked' : '' }} required>
              <label class="btn btn-outline-success text-start d-flex align-items-center gap-2" for="mode-dark">
                <span>{{ __('Dark') }}</span>
              </label>
            </div>
            <div class="col-auto">
              <input type="radio" class="btn-check" name="mode" id="mode-mix" value="Mix" autocomplete="off" {{ ($settings && $settings->mode === 'Mix') ? 'checked' : '' }} required>
              <label class="btn btn-outline-success text-start d-flex align-items-center gap-2" for="mode-mix">
                <span>{{ __('Mix') }}</span>
              </label>
            </div>
          </div>
        </div>

        <div class="mb-3 p-2 rounded-3 b-t-primary border-3">
          <div class="sidebar-icon mb-2"><h4>{{ __('Sidebar Icon') }}</h4><p>{{ __('Choose between Stroke / Colorful') }}</p></div>
          <div class="sidebar-body">
            <div class="row g-2 align-items-stretch">
              <div class="col-auto">
                <input type="radio" class="btn-check" name="icon" id="icon-stroke" value="Stroke" autocomplete="off" {{ ($settings && $settings->icon === 'Stroke') || (!$settings) ? 'checked' : '' }} required>
                <label class="btn btn-outline-success d-flex align-items-center gap-2" for="icon-stroke">
                  <span>{{ __('Stroke Icon') }}</span>
                </label>
              </div>
              <div class="col-auto">
                <input type="radio" class="btn-check" name="icon" id="icon-color" value="Colorful" autocomplete="off" {{ ($settings && $settings->icon === 'Colorful') ? 'checked' : '' }} required>
                <label class="btn btn-outline-success d-flex align-items-center gap-2" for="icon-color">
                  <span>{{ __('Colorful Icon') }}</span>
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="mb-3 p-2 rounded-3 b-t-primary border-3">
          <div class="theme-layout mb-2"><h4>{{ __('Theme Layout') }}</h4><p>{{ __('Choose between LTR / RTL / Box') }}</p></div>
          <div class="radio-form checkbox-checked">
            <input type="radio" class="btn-check" name="layout" id="dir-ltr" value="ltr" autocomplete="off" {{ ($settings && $settings->layout === 'ltr') || (!$settings) ? 'checked' : '' }} required>
            <label class="btn btn-outline-success me-2 ltr-setting" for="dir-ltr">{{__('LTR')}}</label>

            <input type="radio" class="btn-check" name="layout" id="dir-rtl" value="rtl" autocomplete="off" {{ ($settings && $settings->layout === 'rtl') ? 'checked' : '' }} required>
            <label class="btn btn-outline-success me-2 rtl-setting" for="dir-rtl">{{__('RTL')}}</label>

            <input type="radio" class="btn-check" name="layout" id="dir-box" value="Box" autocomplete="off" {{ ($settings && $settings->layout === 'Box') ? 'checked' : '' }} required>
            <label class="btn btn-outline-success box-setting" for="dir-box">{{__('Box')}}</label>
          </div>
        </div>

        <div class="mb-3 p-2 rounded-3 b-t-primary border-3">
          <div class="sidebar-type mb-2"><h4>{{ __('Sidebar Type') }}</h4><p>{{ __('Choose between Vertical / Horizontal') }}</p></div>
            <div class="sidebar-body">
              <input type="radio" class="btn-check" name="sidebar_type" id="layout-vertical" value="Vertical" autocomplete="off" {{ ($settings && $settings->sidebar_type === 'Vertical') || (!$settings) ? 'checked' : '' }} required>
              <label class="btn btn-outline-success me-2 vertical-setting" for="layout-vertical">{{__('Vertical')}}</label>

              <input type="radio" class="btn-check" name="sidebar_type" id="layout-horizontal" value="Horizontal" autocomplete="off" {{ ($settings && $settings->sidebar_type === 'Horizontal') ? 'checked' : '' }} required>
              <label class="btn btn-outline-success horizontal-setting" for="layout-horizontal">{{__('Horizontal')}}</label>
            </div>
        </div>

        <div class="customizer-color mb-3 p-2 rounded-3 b-t-primary border-3">
          <div class="color-picker mb-2"><h4>{{ __('Color Picker') }}</h4></div>
          <div class="" role="group" aria-label="Color themes">
            <input type="radio" class="btn-check" name="color" id="palette-1" value="#308e87" autocomplete="off" {{ ($settings && $settings->color === '#308e87') || (!$settings) ? 'checked' : '' }} required>
            <label class="btn btn-outline-success p-1" for="palette-1"><span class="d-block rounded" style="width:32px;height:32px;background-color:#308e87"></span></label>

            <input type="radio" class="btn-check" name="color" id="palette-2" value="#57375D" autocomplete="off" {{ ($settings && $settings->color === '#57375D') ? 'checked' : '' }} required>
            <label class="btn btn-outline-success p-1" for="palette-2"><span class="d-block rounded" style="width:32px;height:32px;background-color:#57375D"></span></label>

            <input type="radio" class="btn-check" name="color" id="palette-3" value="#0766AD" autocomplete="off" {{ ($settings && $settings->color === '#0766AD') ? 'checked' : '' }} required>
            <label class="btn btn-outline-success p-1" for="palette-3"><span class="d-block rounded" style="width:32px;height:32px;background-color:#0766AD"></span></label>

            <input type="radio" class="btn-check" name="color" id="palette-4" value="#025464" autocomplete="off" {{ ($settings && $settings->color === '#025464') ? 'checked' : '' }} required>
            <label class="btn btn-outline-success p-1" for="palette-4"><span class="d-block rounded" style="width:32px;height:32px;background-color:#025464"></span></label>

            <input type="radio" class="btn-check" name="color" id="palette-5" value="#884A39" autocomplete="off" {{ ($settings && $settings->color === '#884A39') ? 'checked' : '' }} required>
            <label class="btn btn-outline-success p-1" for="palette-5"><span class="d-block rounded" style="width:32px;height:32px;background-color:#884A39"></span></label>

            <input type="radio" class="btn-check" name="color" id="palette-6" value="#0C356A" autocomplete="off" {{ ($settings && $settings->color === '#0C356A') ? 'checked' : '' }} required>
            <label class="btn btn-outline-success p-1" for="palette-6"><span class="d-block rounded" style="width:32px;height:32px;background-color:#0C356A"></span></label>
          </div>
        </div>
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
          <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#resetModal">{{ __('Reset to default') }}</button>
        </div>
        </form>
        <hr class="my-4"/>
        @php $selectedLocale = strtolower(old('locale', $settings->locale ?? session('locale', request()->cookie('locale', 'en')))); @endphp
        <form id="localeForm" class="needs-validation" novalidate method="POST" action="{{ route('settings.setLocale') }}">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label class="form-label">{{ __('Language') }}</label>
            <div class="row g-2 align-items-stretch" role="group" aria-label="Language">
              <div class="col-auto">
                <input type="radio" class="btn-check" name="locale" id="locale-en" value="en" autocomplete="off" {{ $selectedLocale === 'en' ? 'checked' : '' }} required>
                <label class="btn btn-outline-success d-flex align-items-center gap-2" for="locale-en">
                  <i class="flag-icon flag-icon-us"></i>
                  <span>{{ __('English') }}</span>
                </label>
              </div>
              <div class="col-auto">
                <input type="radio" class="btn-check" name="locale" id="locale-ar" value="ar" autocomplete="off" {{ $selectedLocale === 'ar' ? 'checked' : '' }} required>
                <label class="btn btn-outline-success d-flex align-items-center gap-2" for="locale-ar">
                  <i class="flag-icon flag-icon-sa"></i>
                  <span>{{ __('Arabic') }}</span>
                </label>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">{{ __('Update language') }}</button>
        </form>
        <div class="modal fade" id="resetModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">{{ __('Confirm reset') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">{{ __('Are you sure you want to reset all settings to default?') }}</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <form method="POST" action="{{ route('settings.setDefault') }}">
                  @csrf
                  @method('PUT')
                  <button type="submit" class="btn btn-danger">{{ __('Reset') }}</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
(function(){
  var body = document.body;
  var html = document.documentElement;
  var pageWrapper = document.getElementById('pageWrapper');
  var sidebars = document.querySelectorAll('.page-sidebar');
  function setMode(mode){
    body.classList.remove('dark-only','dark-sidebar','light');
    if(mode === 'Dark'){ body.classList.add('dark-only'); html.setAttribute('data-theme','dark-only'); }
    else if(mode === 'Mix'){ body.classList.add('dark-sidebar'); html.setAttribute('data-theme','dark-sidebar'); }
    else { body.classList.add('light'); html.setAttribute('data-theme','light'); }
  }
  function setLayout(layout){
    body.classList.remove('box-layout');
    if(layout === 'rtl'){ html.setAttribute('dir','rtl'); }
    else if(layout === 'ltr'){ html.setAttribute('dir','ltr'); }
    else if(layout === 'Box'){ body.classList.add('box-layout'); html.removeAttribute('dir'); }
  }
  function setSidebarType(type){
    if(!pageWrapper) return;
    pageWrapper.classList.remove('horizontal-sidebar','compact-wrapper');
    if(type === 'Horizontal'){ pageWrapper.classList.add('horizontal-sidebar'); }
    else { pageWrapper.classList.add('compact-wrapper'); }
  }
  function setIconStyle(style){
    sidebars.forEach(function(el){
      el.classList.remove('iconcolor-sidebar');
      el.setAttribute('data-sidebar-layout','stroke-svg');
      if(style === 'Colorful'){ el.classList.add('iconcolor-sidebar'); el.setAttribute('data-sidebar-layout','iconcolor-sidebar'); }
    });
  }
  function setColor(hex){
    document.documentElement.style.setProperty('--theme-default', hex);
  }
  ['mode-light','mode-dark','mode-mix'].forEach(function(id){
    var el = document.getElementById(id);
    if(el) el.addEventListener('change', function(e){ if(e.target.checked) setMode(e.target.value); });
  });
  ['dir-ltr','dir-rtl','dir-box'].forEach(function(id){
    var el = document.getElementById(id);
    if(el) el.addEventListener('change', function(e){ if(e.target.checked) setLayout(e.target.value); });
  });
  ['layout-vertical','layout-horizontal'].forEach(function(id){
    var el = document.getElementById(id);
    if(el) el.addEventListener('change', function(e){ if(e.target.checked) setSidebarType(e.target.value); });
  });
  ['icon-stroke','icon-color'].forEach(function(id){
    var el = document.getElementById(id);
    if(el) el.addEventListener('change', function(e){ if(e.target.checked) setIconStyle(e.target.value); });
  });
  document.querySelectorAll('input[name="color"]').forEach(function(el){
    el.addEventListener('change', function(e){ if(e.target.checked) setColor(e.target.value); });
  });
})();
</script>
@endpush
