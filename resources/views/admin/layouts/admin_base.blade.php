<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>DutaTani </title>
  <link rel="shortcut icon" href="{{{ asset('img/favicon.ico') }}}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('/lte3/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/lte3/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('admin.inc.header')

  @include('admin.inc.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0 text-dark">Dashboard</h1> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
    @include('admin.inc.messages')
    @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
  
  @include('admin.inc.footer')

  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <!-- <div class="control-sidebar-bg"></div>
</div> -->
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@stack('test')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/lte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/lte3/dist/js/adminlte.min.js') }}"></script>


</body>
@stack('custom-script')
</html>
