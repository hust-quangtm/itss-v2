<header class="container-fluid p-md-0 m-md-0">
    <nav class="navbar navbar-light navbar-expand-sm flex-md-column flex-xl-row justify-content-center pr-0 hapo-navbar pl-xl-2 pr-xl-2 pt-xl-3 pb-xl-3">
        <button class="navbar-toggler border-0 col-xs-2 px-2" type="button" data-toggle="collapse" data-target="#sibarNavbar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars icon no-gutters"></span>
        </button>
        <img src="{{url('storage/images/Hapo_Learn_logo.png')}} " class="col-7 col-md-6 col-xl-3 ml-xl-1 m-auto ml-xl-2">
        <div class="collapse collapse navbar-collapse col-6 col-md-12 col-xl-8 p-0 justify-content-xl-end justify-content-md-center"  id="sibarNavbar">
            <ul class="navbar-nav align-items-center hapo-nav-item">
                <li class="nav-item  hapo-list-item">
                    <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href=" {{ route('home') }} ">HOME</a>
                </li>
                <li class="nav-item hapo-list-item">
                    <a class="nav-link {{ Request::is('course/*') ? 'active' : '' }}" href="{{ route('course.all') }}">All COURSES</a>
                    {{-- <a class="nav-link {{ $currentUrl == 'home' ? 'active' : '' }}" href="{{ route('course.all') }}">All COURSES</a> --}}
                </li>
                @if(Auth::guard('web')->check())
                <li class="nav-item hapo-list-item">
                    <a class="nav-link {{ Route::is('user.profile') ? 'active' : '' }}" href=" {{ route('user.profile') }} ">PROFILE</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle mx-md-2 my-3 my-sm-1 text-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::guard('web')->user()->name }} <span class="caret"></span>
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
                @else
                <li class="nav-item hapo-list-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">LOGIN/REGISTER</a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
