<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Polines</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/node_modules/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/node_modules/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="/node_modules/flag-icon-css/css/flag-icon.min.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="/node_modules/chartist/dist/chartist.min.css" />
  <link rel="stylesheet" href="/node_modules/jvectormap/jquery-jvectormap.css" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/css/style.css">
  <!-- endinject -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="/"><img src="/images/logo.svg" alt="logo"></a>
        <a class="navbar-brand brand-logo-mini" href="/"><img src="/images/logo_mini.svg" alt="logo"></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
      <p class="page-name d-none d-lg-block">Hi, {{Auth::user()->name}}</p>
        <ul class="navbar-nav ml-lg-auto">
          
          <li class="nav-item d-none d-sm-block profile-img">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center ml-auto" type="button" data-toggle="offcanvas">
          <span class="icon-menu icons"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-category">
              <span class="nav-link">UMUM</span>
            </li>
            <li class="nav-item {{active(['/'])}}">
              <a class="nav-link " href="/">
                <span class="menu-title">Beranda</span>
                {{-- <i class="icon-speedometer menu-icon"></i> --}}
              </a>
            </li>
            <li class="nav-item nav-category">
              <span class="nav-link">DATA</span>
            </li>
            <li class="nav-item {{active(['students'])}}">
              <a class="nav-link" href="/students">
                <span class="menu-title">Data Mahasiswa</span>
                {{-- <i class="icon-account-card-details menu-icon"></i> --}}
              </a>
            </li>
            <li class="nav-item {{active(['lecturers'])}}">
              <a class="nav-link" href="/lecturers">
                <span class="menu-title">Data Dosen</span>
                {{-- <i class="icon-speedometer menu-icon"></i> --}}
              </a>
            </li>
            <li class="nav-item {{active(['lectures', 'classrooms', 'schedules'])}}">
              <a class="nav-link" data-toggle="collapse" href="#college_data" aria-expanded="false" aria-controls="college_data">
                <span class="menu-title">Data Perkuliahan</span>
                {{-- <i class="icon-bubbles menu-icon"></i> --}}
              </a>
              <div class="@if (!is_active(['lectures', 'classrooms', 'schedules'])) collapse @endif " id="college_data">
                <ul class="nav flex-column sub-menu ">
                  <li class="nav-item {{active(['lectures'])}} "> <a class="nav-link" href="/lectures"> Mata Kuliah </a></li>
                  <li class="nav-item {{active(['classrooms'])}}"> <a class="nav-link" href="/classrooms"> Ruang Kuliah </a></li>
                  <li class="nav-item {{active(['schedules'])}}"> <a class="nav-link" href="/schedules"> Jadwal Perkuliahan </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item nav-category">
              <span class="nav-link">REKAM PRESENSI</span>
            </li>
            <li class="nav-item {{active(['presences'])}}">
              <a class="nav-link" href="/presences">
                <span class="menu-title">Rekam Presensi</span>
              </a>
            </li>
            <li class="nav-item nav-category">
              <span class="nav-link">AKUN</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/presence">
                <span class="menu-title">Ganti Password</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="content-wrapper">
          @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019 . All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- row-offcanvas ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="/node_modules/flot/jquery.flot.js"></script>
  <script src="/node_modules/flot/jquery.flot.resize.js"></script>
  <script src="/node_modules/flot.curvedlines/curvedLines.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="/js/off-canvas.js"></script>
  <script src="/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="/js/dashboard.js"></script>
  <!-- End custom js for this page-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $('[name=entry_hour]').timepicker({step:5});
    $('.selectpicker').selectpicker();
    $('.datepick').datepicker();
  </script>
  <style>
    .dropdown-menu{z-index: 1040}
  <style>
</body>

</html>
