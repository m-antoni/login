<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flipclock.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin.min.css') }}" rel="stylesheet">
</head>
<body class="{{Request::is('admin/login') ? 'bg-secondary' : ''}}">
{{-- <body> --}}
<div id="app" >
    @auth('admin')
        <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
            <a class="navbar-brand mr-1 text-info" href="admin/dashboard">{{ config('app.name')}}</a>
                <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
                  <i class="fas fa-bars"></i>
                </button>

            <!-- Navbar -->
            <ul class="navbar-nav ml-auto mr-md-0">
              <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-user-circle fa-fw text-info"></i>
                    </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Activity Log</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                            @csrf
                    </form>
                </div>
              </li>
            </ul>    
        </nav>
     <div id="wrapper">
  
        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">

          <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">
               <i class="fa fa-chart-area"></i>
              <span>Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('register.index')}}">
              <i class="fa fa-users"></i>
              <span>Users</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="admin/login">
              <i class="fa fa-user-clock"></i>
              <span>Login</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="admin/login">
              <i class="fa fa-clock"></i>
              <span>Logs</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="admin/login">
              <i class="fa fa-trash"></i>
              <span>Trashed</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="admin/login">
              <i class="fa fa-qrcode"></i>
              <span>QR Code Tester</span></a>
          </li>

          <li class="nav-item">
              <a class="nav-link" href="admin/login">
                <i class="fa fa-cog"></i>
                <span>Setting</span></a>
          </li>
        </ul>
@endauth

    <div id="content-wrapper">
        <div class="container-fluid">
         <main>

            @yield('content')

        </main>
        @auth('admin')
            <footer class="sticky-footer">
                <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                    <span>Copyright © Your Website 2019</span>
                  </div>
                </div>
            </footer>
        @endauth
        </div><!-- container-fluid -->
    </div> <!-- content-wrapper -->  
  </div><!-- wrapper -->
</div><!-- app -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/flipclock.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin.min.js') }}"></script>

    <script type="text/javascript">
      // password visibility script
      function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }

      // Flip Clock script
      var clock;
      
      $(document).ready(function() {
        clock = $('.clock').FlipClock({
          clockFace: 'TwelveHourClock'
        });
      });
    </script>
</body>
</html>
