<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link text-sm text-center">
        <span class="brand-text font-weight-light">TC APP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-compact text-sm" data-widget="treeview"
                role="menu" data-accordion="false">
                <li class="nav-item">
                    @if(auth()->guard('student')->check())
                        <a href="{{route('student.dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    @else
                        <a href="{{route('dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    @endif
                </li>

                @if(auth()->check())
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('application')}}" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-list"></i>--}}
{{--                            <p>Application</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-list"></i>
                            <p>
                                Application
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('application')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    Pending
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('approved')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    Approved
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(auth()->check())
                    <li class="nav-header">Settings</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Settings
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('signature')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    Signature
                                </a>
                            </li>
                            @if(auth()->user()->user_role !=2)
                                <li class="nav-item">
                                    <a href="{{route('comments')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        Comments
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
