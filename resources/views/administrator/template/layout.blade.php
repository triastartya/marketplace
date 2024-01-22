<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrator</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/template/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/template/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/') }}/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/template/plugins/datatables-select/css/select.bootstrap4.css">
    <link rel="stylesheet" href="{{ url('/') }}/template/plugins/datatables-keytable/css/keyTable.bootstrap4.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ url('/') }}/template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- jQuery -->
  <script src="{{ url('/') }}/template/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ url('/') }}/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


  <script src="{{ url('/') }}/template/angularJS/angular.min.js"></script>
  <script src="{{ url('/') }}/template/angularJS/app.js"></script>

  <!-- jquery-validation -->
  <script src="{{ url('/') }}/template/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="{{ url('/') }}/template/plugins/jquery-validation/additional-methods.min.js"></script>
 <!-- DataTables  & Plugins -->
    <script src="{{ url('/') }}/template/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/jszip/jszip.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-select/js/dataTables.select.min.js"></script>
    <script src="{{ url('/') }}/template/plugins/datatables-keytable/js/dataTables.keyTable.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="{{ url('/') }}/template/plugins/sweetalert2/sweetalert2.min.js"></script>
  @yield('css')
  @yield('ctrl')
  <style>
    .btn-nav{
         border-radius: 20px; 
    }
    .hidden{
      display:none;
    }
    [class*=sidebar-dark-] .sidebar a {
        color: #f4f6f9;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini" ng-app="app"  ng-controller="myCtrl">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-fuchsia navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-blue sidebar-blue elevation-4" style="background-color: #007bff;">
    <!-- Brand Logo -->
    <a  class="brand-link">
      {{-- <img src="{{ url('/') }}/logo.png" alt="Administrator" class="brand-image img-circle elevation-3" style="opacity: .8;background-color: white;"> --}}
      <span class="brand-text font-weight-light">Administrator</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('/') }}/template/dist/img/blank.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          {{-- <a href="#" class="d-block">{{ Session::get('data')->name }}</a> --}}
          {{-- <a href="#" class="d-block">{{ Session::get('data')->nama }}</a> --}}
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ url('/') }}/administrator/konfirmasi" class="nav-link">
              <i class="nav-icon fas fa-caret-right"></i>
              <p>
                Konfirmasi Pembayaran
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/administrator/pencairan" class="nav-link">
              <i class="nav-icon fas fa-caret-right"></i>
              <p>
                Pembayaran Ke Toko
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/administrator/kategori" class="nav-link">
              <i class="nav-icon fas fa-caret-right"></i>
              <p>
                Kategori
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/administrator/page" class="nav-link">
              <i class="nav-icon fas fa-caret-right"></i>
              <p>
                Setting Website
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/administrator/banner" class="nav-link">
              <i class="nav-icon fas fa-caret-right"></i>
              <p>
                Banner
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/administrator/user" class="nav-link">
              <i class="nav-icon fas fa-caret-right"></i>
              <p>
                Management user
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    @yield('content')
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

  <!-- AdminLTE App -->
  <script src="{{ url('/') }}/template/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ url('/') }}/template/dist/js/demo.js"></script>

</body>
</html>
