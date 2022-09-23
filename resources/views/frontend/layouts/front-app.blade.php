<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>TC Application</title>
    <link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <link href="{{asset('assets/dist/css/adminlte.css')}}" rel="stylesheet">
    <link href="{{asset('assets/custom/front-style.css')}}" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <!--- header -->
    <div class="p-4 mb-2 text-white rounded bg-info">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10 px-0">
                <h3 class="fw-light fs-3 text-center">Board of Intermediate and Secondary Education, Dinajpur</h3>
                <p class="lead my-3 fs-3 text-center">Online TC Application</p>
            </div>
        </div>
    </div>
    <!--- header end -->

    <!--- link address -->
{{--    <div class="row">--}}
{{--        <div class="col-sm-3">--}}
{{--            <a class="btn btn-flat btn-block btn-danger" href="">--}}
{{--                Change Password--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="col-sm-3">--}}
{{--            <a class="btn btn-flat btn-block btn-success" href="{{route('create-login')}}">--}}
{{--                Application Edit--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="col-sm-3">--}}
{{--            <a class="btn btn-flat btn-block btn-warning" href="{{route('create-login')}}">--}}
{{--                Last Update--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="col-sm-3">--}}
{{--            <a class="btn btn-flat btn-block btn-info" target="_blank" href="">--}}
{{--                User Manual--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!--- link address end -->
    <div id="app">
        @yield('content')
    </div>

</div>

{{--<footer class="blog-footer fixed-bottom">--}}
{{--    <div class="footer-copyright text-center py-3 text-sm">--}}
{{--        © {{date('Y')}} Copyright:--}}
{{--        <a href="/"> Dinajpur Education Board</a>--}}
{{--        All rights reserved.--}}
{{--    </div>--}}
{{--</footer>--}}
@include('frontend.layouts.front-footer')
</body>
</html>
