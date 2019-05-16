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
{{--     <link href="{{ asset('css/flipclock.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/iziToast.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body class="{{Request::is('admin/login') ? 'bg-dark' : ''}} || {{Request::is('/', 'login') ? 'bg-dark' : ''}}">
{{-- <body> --}}
<div id="app" >
    @auth()
        <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
            <a class="navbar-brand mr-1 text-info" href="admin/dashboard">{{ config('app.name')}}</a>
                <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
                  <i class="fa fa-bars"></i>
                </button>
           {{--  <div class="navbar-nav m-auto mr-md-0 text-white">
              {{ now()->setTimezone('Asia/Manila')->format('M j, Y h:iA') }}
            </div> --}}
            <!-- Navbar -->
            <ul class="navbar-nav ml-auto mr-md-0">
              <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="fa fa-user-circle text-info"></i>
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
               <i class="fa fa-bar-chart-o"></i>
              <span>Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('register.index')}}">
              <i class="fa fa-users"></i>
              <span>Users</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('logs.index')}}">
              <i class="fa fa-edit"></i>
              <span>Logs</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="admin/login">
              <i class="fa fa-qrcode"></i>
              <span>Tester</span></a>
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
                
                  {{--  content --}}
                  @yield('content')

              </main>

              @auth()
                  <footer class="sticky-footer mt-0">
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
{{-- <script src="{{ asset('js/flipclock.min.js') }}"></script> --}}
<script src="{{ asset('js/sb-admin.min.js') }}"></script>
<script src="{{ asset('js/iziToast.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

{{-- Added scripts --}}
@yield('script')

</body>
</html>
