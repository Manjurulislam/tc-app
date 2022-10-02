<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('layouts.header')
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card card-outline card-indigo">
        <div class="card-header text-center">
            <a href="" class="h1">TC App</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in your account</p>
            <form action="{{route('college.login')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <input type="text" name="eiin" class="form-control @error('eiin') is-invalid @enderror"
                           placeholder="Eiin No">
                    @error('eiin')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="Password" name="password">
                    @error('password')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="row mb-4">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->

                    <div class="col-12 mt-5">
                        @if(session('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
