<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('resources/js/app.js') }}"></script>
  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
  <script src="{{ asset('js/html2canvas.js')}}"></script>
  <script src="{{ asset('js/instascan.js') }}"></script>
  <script src="{{ asset('js/vue.js') }}"></script>
  <script src="{{ asset('js/adapter.js') }}"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <!-- Date et l'heure-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="{{ asset('js/qrCode.js')}}"></script>
  <script src="{{ asset('js/html2canvas.js')}}"></script>

</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <x-application-login class="animation__wobble" alt="AdminLTELogo" height="auto" width="auto"/>
        {{-- <img class="animation__wobble" src="logo/30.png" alt="AdminLTELogo" height="auto" width="auto"> --}}
      </div>

      {{-- Sidebar --}}
      @include('layouts.navigation')

      <!-- Content Wrapper. Contains page content -->

      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.mi.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    {{-- <script src="{{ asset('raphael/raphael.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('jquery-mapael/jquery.mapael.min.js') }}"></script> --}}
    <script src="{{ asset('jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    {{-- <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script> --}}

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('js/pages/dashboard2.js') }}"></script>
    </body>
</html>
