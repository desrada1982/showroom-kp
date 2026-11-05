<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Judul halaman dinamis -->
  <title>@yield('title') &mdash; Kenanga Motor</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

  @stack('styles')
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      
      <!-- TOPBAR / NAVIGASI ATAS -->
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
    <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
    <!-- Menampilkan nama user yang sedang login dari database -->
    <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
    
    <div class="dropdown-menu dropdown-menu-right">
      <div class="dropdown-divider"></div>
      
      <!-- Tombol Logout -->
      <a href="#" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
      
      <!-- Form tersembunyi untuk proses Logout (Syarat keamanan Laravel) -->
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </div>
</li>
        </ul>
      </nav>

      <div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <!-- Logo / Brand di pucuk atas sidebar -->
        <div class="sidebar-brand">
            <a href="{{ url('/admin') }}">Kenanga Motor</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/admin') }}">KM</a>
        </div>

        <!-- Daftar Menu -->
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/admin') }}">
                    <i class="fas fa-fire"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Manajemen</li>
            <li class="{{ Request::is('motor*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('motor.index') }}">
                    <i class="fas fa-motorcycle"></i> <span>Data Motor</span>
                </a>
            </li>

            <li class="{{ Request::is('transaksi*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('transaksi.index') }}">
                    <i class="fas fa-shopping-cart"></i> <span>Transaksi</span>
                </a>
            </li>
        </ul>
    </aside>
</div>

      <!-- MAIN CONTENT / AREA KONTEN UTAMA -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <!-- Judul halaman dinamis -->
            <h1>@yield('title')</h1> 
          </div>

          <div class="section-body">
            <!-- Konten halaman dinamis akan masuk ke sini -->
            @yield('content')
          </div>
        </section>
      </div>

      <!-- FOOTER -->
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2026 <div class="bullet"></div> Kenanga Motor
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>
  
  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>

  <!-- Page Specific JS File -->
  @stack('scripts')
</body>
</html>