<header class="container-fluid p-md-0 m-md-0">
    <nav
        class="navbar navbar-light navbar-expand-sm flex-md-column flex-xl-row justify-content-center pr-0 hapo-navbar pl-xl-2 pr-xl-2 pt-xl-3 pb-xl-3">
        <button class="navbar-toggler border-0 col-xs-2 px-2" type="button" data-toggle="collapse"
            data-target="#sibarNavbar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars icon no-gutters"></span>
        </button>
        <img src="{{ url('storage/images/logo-5.png') }} "
            class="col-7 col-md-6 col-xl-3 ml-xl-1 m-auto ml-xl-2">
        <div class="collapse collapse navbar-collapse col-6 col-md-12 col-xl-8 p-0 justify-content-xl-end justify-content-md-center"
            id="sibarNavbar">
            <ul class="navbar-nav align-items-center hapo-nav-item">
                <li class="nav-item  hapo-list-item">
                    <a class="nav-link {{ Route::is('home') ? 'active' : '' }}"
                        href=" {{ route('home') }} ">HOME</a>
                </li>
                <li class="nav-item hapo-list-item">
                    <a class="nav-link {{ Request::is('course/*') ? 'active' : '' }}"
                        href="{{ route('course.all') }}">All COURSES</a>
                </li>
                <li class="nav-item  hapo-list-item">
                    <a class="nav-link {{ Request::is('teacher/*') ? 'active' : '' }}"
                        href=" {{ route('teacher.all') }} ">TEACHER</a>
                </li>
                @if(Auth::guard('web')->check())
                    <li>
                        <div class="dropdown pr-0">
                            <button type="button" class="btn btn-info" data-toggle="dropdown">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <div class="row total-header-section">
                                    <div class="col-lg-6 col-sm-6 col-6">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                    </div>
                                    @php $total = 0 @endphp
                                    @foreach((array) session('cart') as $id => $details)
                                        @php $total += $details['price']  @endphp
                                    @endforeach

                                    <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                        <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                                    </div>
                                </div>
                                @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                        <div class="row cart-detail">
                                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                <img src="{{ $details['image'] }}" />
                                            </div>
                                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-course">
                                                <p>{{ $details['course_name'] }}</p>
                                                <span class="price text-info"> ${{ $details['price'] }}</span>
                                                <!-- <span class="count"> Quantity:{{ $details['quantity'] }}</span> -->
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                            <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle mx-md-2 my-3 my-sm-1 text-center"
                            href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            v-pre>
                            {{ Auth::guard('web')->user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                {{-- <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 main-section"> --}}

                        {{-- </div>
                    </div>
                </div> --}}

                @else
                    <li class="nav-item hapo-list-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">LOGIN/REGISTER</a>
                    </li>
                @endif

            </ul>
        </div>
    </nav>
</header>
