<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Finances')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{asset("assets/admin/plugins/ionicons/font/fonts.css")}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("assets/admin/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset("assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assets/admin/dist/css/adminlte.min.css")}}">
    @toastr_css
</head>
<body class="hold-transition login-page register-page">
@yield('content')
<!-- /.login-register-box -->

<!-- jQuery -->
<script src="{{asset("assets/admin/plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("assets/admin/dist/js/adminlte.js")}}"></script>
@yield('script')
</body>
@toastr_js
@toastr_render
</html>
