<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
</head>

<body class="layout-top-nav control-sidebar-slide-open layout-navbar-fixed layout-footer-fixed">

<div class="wrapper">
    <!-- Navbar -->
@include('layouts.navigation')
<!-- /.navbar -->

    <div class="content-wrapper">
        <div class="content-header"></div>
        <div class="content">
            <div class="container-fluid">
            @yield('content')
            </div>
        </div>
    </div>

    <footer class="main-footer text-sm">
        <div class="text-center">
            <strong>Copyright &copy; {{date('Y')}} <a href="{{env('APP_URL')}}">
                    {{env('APP_NAME')}}
                </a>.
            </strong> All rights reserved.
        </div>
    </footer>
</div>
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
@livewireScripts
</body>
</html>
