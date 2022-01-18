<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('admin.admin_dasboard') }}" class="brand-link">
            <span class="brand-text font-weight-light">Admin</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    @if(auth()->user()->role_id == 2)
                        <li class="nav-item has-treeview {{ Request::is('admin/users') || Request::is('admin/users/*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('admin/users') || Request::is('admin/users/*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    Manager User
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item">
                                    <a href=" {{ route('admin.users.index') }} " class="nav-link {{ Route::is('admin.users.index') ? 'active' : '' }} ">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p>User List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href=" {{ route('admin.users.create') }} " class="nav-link {{ Route::is('admin.users.create') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>User Create</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-item has-treeview {{ Request::is('admin/courses') || Request::is('admin/courses/*') || Request::is('admin/lesson/*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('admin/courses') || Request::is('admin/courses/*') || Request::is('admin/lesson/*')? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                               Manager Course
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href=" {{ route('admin.courses.index') }} " class="nav-link  {{ Route::is('admin.courses.index') ? 'active' : '' }} ">
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>Course List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                @if(auth()->user()->role_id == 2 && auth()->user()->course_creation_times == 0)
                                    <a href="{{ Route('admin.payment.index') }}" class="nav-link" role="button">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Course Create</p>
                                    </a>
                                @else
                                    <a href=" {{ route('admin.courses.create') }} " class="nav-link  {{ Route::is('admin.courses.create') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Course Create</p>
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <div class="content-wrapper">
        <div class="container-fluid mt-5">
            @yield('contents')
        </div>
    </div>
    <footer class="container-fluid">
        <div class="main-footer">
            <div class="row">
                <div class="hapo-admin-footer col-md-12 text-center d-flex justify-content-center align-items-center">
                    @CopyRight by  quang.tranmq99
                </div>
            </div>
        </div>
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>
</body>
</html>
