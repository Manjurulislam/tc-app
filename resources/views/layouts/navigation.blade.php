<nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
    <div class="container">
        <a href="{{route('dashboard')}}" class="navbar-brand">
            <img src="{{asset('assets/images/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
            {{--            <span class="brand-text font-weight-light text-uppercase">OTA</span>--}}
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    @if(auth()->guard('student')->check())
                        <a href="{{route('student.dashboard')}}" class="nav-link">Dashboard</a>
                    @else
                        <a href="{{route('dashboard')}}" class="nav-link">Dashboard</a>
                    @endif
                </li>

                @if(auth()->check())
                    <li class="nav-item">
                        <a href="{{route('application')}}" class="nav-link">Application</a>
                    </li>
                    @if(auth()->user()->user_role !=2)
                        <li class="nav-item"><a href="{{route('comments')}}" class="nav-link">Comments</a></li>
                    @endif
                @endif
            </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('assets/images/logout.png')}}" class="user-image img-circle elevation-2"
                         alt="User Image">
                    <span class="d-none d-md-inline">
                        @if(auth()->guard('student')->check())
                            {{auth()->guard('student')->user()->name}}
                        @else
                            {{auth()->user()->inst_name }}
                        @endif
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-blue">
                        <img src="{{asset('assets/images/logout.png')}}" class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            @if(auth()->guard('student')->check())
                                {{auth()->guard('student')->user()->name}}
                                <small>Member since
                                    {{ auth()->guard('student')->user()->created_at ? auth()->guard('student')->user()->created_at->format('M Y') : '' }}
                                </small>
                            @else
                                {{auth()->user()->inst_name }}
                                <small>Member since
                                    {{ auth()->user()->created_at ? auth()->user()->created_at->format('M Y') : '' }}</small>
                            @endif
                        </p>
                    </li>

                    <!-- Menu Footer-->
                    <li class="user-footer">
                        @if(auth()->guard('student')->check())
                            <a href="javascript:void(0)"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="btn btn-default btn-flat float-right">Sign out
                            </a>
                            <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <a href="javascript:void(0)"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="btn btn-default btn-flat float-right">Sign out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endif
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
