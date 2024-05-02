<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="overflow-y: hidden">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Ulti | @yield('title', 'CMS')</title>

        @yield('header')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Nucleo Icons -->
        <link href="{{asset('assets/css/app.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
        <!-- CSS Files -->
        <link id="pagestyle" href="{{asset('assets/css/soft-ui-dashboard.css?v=1.0.3')}}" rel="stylesheet" />
        <link href="{{asset('datatables/bootstrap-icons/font/bootstrap-icons.css')}}" rel="stylesheet" />
        <link href="{{asset('datatables/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
        <link href="{{asset('datatables/datatables.net-select-bs5/css/select.bootstrap5.css')}}" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        {{-- @vite(['resources/scss/app.scss', 'resources/js/app.js']) --}}
    </head>

    <body class="g-sidenav-show bg-gray-100">
        <x-layouts.sidebar />
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
            <x-layouts.navbar />
            <div class="container-fluid py-4">
                @yield('content')
                <x-layouts.footer />
            </div>
        </main>

        @stack('scripts')
        <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
        <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
        <script src="{{asset('assets/js/plugins/fullcalendar.min.js')}}"></script>
        <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
        <script src="{{asset('datatables/js/jquery.dataTables.js')}}"></script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>

        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{asset('assets/js/soft-ui-dashboard.min.js?v=1.0.3')}}"></script>
    </body>
</html> 