<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>tc-app</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    <style>
        .nav-sidebar>.nav-item .nav-icon.fas , .nav-sidebar>.nav-item .nav-icon.far{
            font-size: 12px;
        }
    </style>
</head>
<body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed layout-footer-fixed sidebar-collapse">
<div class="wrapper">
    @include('layouts.navigation')
    @include('layouts.sidebar')
    <div class="content-wrapper">
        <section class="content pt-3">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    <footer class="main-footer text-sm">
        <div class="text-center">
            <strong>Copyright &copy; {{date('Y')}} <a href="{{env('APP_URL')}}">
                    Dinajpur education board
                </a>.
            </strong> All rights reserved.
        </div>
    </footer>
</div>
@include('layouts.footer')
@component('livewire-notification::components.toast') @endcomponent
</body>
</html>
