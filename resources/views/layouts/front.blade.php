<!doctype html>
<html lang="en">
@include('front.includes.head')
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
<div id="overlayer"></div>
<div class="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="site-wrap">
    @include('front.includes.header')

    @include('front.includes.navbar')

    @yield('content')

    @include('front.includes.footer')
</div> <!-- .site-wrap -->
@include('front.includes.script')
@yield('script')
</body>
@toastr_js
@toastr_render
</html>
