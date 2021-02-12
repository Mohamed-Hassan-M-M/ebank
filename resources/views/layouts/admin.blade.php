<!DOCTYPE html>
<html lang="en">
@include("admin.includes.head")
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    @include("admin.includes.header")
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include("admin.includes.sidebar")

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->
    @include("admin.includes.footer")

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('admin.includes.script')
@yield('script')
</body>
@toastr_js
@toastr_render
</html>
