<!DOCTYPE html >
<html lang="{{ session('locale') }}" @if(session('dir') !== 'box') dir="{{ session('dir')}}" @endif>
@include('layouts.partials.head')
  <body data-mode-source="server" class="{{ session('theme_class') }} {{ session('dir') === 'box' ? 'box-layout' : '' }}">
    @include('layouts.partials.alert')
    <!-- page-wrapper Start-->
    <!-- tap on top starts-->
    <div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
    <!-- tap on tap ends-->
    @include('layouts.partials.loader')
    <div class="page-wrapper {{ session('sidebar_type') === 'Horizontal' ? 'horizontal-sidebar' : 'compact-wrapper' }}" id="pageWrapper">
        @include('layouts.partials.header')
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page sidebar start-->
        @include('layouts.partials.aside')
        <!-- Page sidebar end-->
        @include('layouts.partials.body')
        
      </div>
    </div>
    @include('layouts.partials.scripts')
  </body>
</html>
