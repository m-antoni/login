<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="description" content="Attendance Monitoring using QR Code">
    <meta name="author" content="Michael Antoni">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Attendance Monitoring') }}</title>

    <!-- Custom fonts-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/flipclock.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/iziToast.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body class="{{Request::is('admin/login') ? 'bg-dark' : ''}} || {{Request::is('/', 'login') ? 'bg-dark' : ''}}">
{{-- <body> --}}
<div id="app" >
  <div id="wrapper">

      @auth
        @include('partials.sidebar')
      @endauth

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
          
          @auth()
            @include('partials.navbar')
          @endauth
          <!-- Begin Page Content -->
          <div class="container-fluid">
            
            <!-- Content Row -->
            <div class="row">

                @yield('content')

            </div>
            
          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
        @auth()
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Attendance Monitoring System 2019</span>
            </div>
          </div>
        </footer>
        @endauth()
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
  </div>
</div><!-- app -->

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
{{-- <script src="{{ asset('js/flipclock.min.js') }}"></script> --}}
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
{{-- <script src="{{ asset('/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> --}}
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/iziToast.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
{{-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> --}}
<!-- Page level plugins -->
{{-- <script src="vendor/chart.js/Chart.min.js"></script> --}}
<!-- Page level custom scripts -->
{{-- Added scripts --}}
@yield('script')

</body>
</html>
