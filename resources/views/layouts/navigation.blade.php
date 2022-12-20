<nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->

        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="{{asset('assets/images/logout.png')}}" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline text-primary text-bold">
                   @if(auth()->guard('student')->check())
                        {{auth()->guard('student')->user()->name}}
                    @else
                        {{auth()->user()->inst_name }}
                    @endif
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <li class="user-header bg-primary">
                    <img src="{{asset('assets/images/logout.png')}}" class="img-circle elevation-2" alt="User Image">
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
</nav>




