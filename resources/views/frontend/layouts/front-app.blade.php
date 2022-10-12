<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Online tc application">
    <meta name="author" content="Online tc application">
    <title>Online tc application</title>
    <link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
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
                <p class="lead my-3 fs-3 text-center text-uppercase">Online tc application</p>
            </div>
        </div>
    </div>
    <!--- header end -->
    <div id="app">
        @yield('content')
    </div>
</div>
@include('frontend.layouts.front-footer')
</body>
</html>
