@include('auth.login-register')
<footer class="container-fluid p-0 m-0">
    <div class="container-content">
        <div class="hapo-footer-content row d-flex">
            <div class="hapo-footer-logo col-md-4 order-sm-1 order-2 col-6 p-0">
                {{-- <div class="hapo-footer-img"><img alt="" src="{{url('storage/images/logo-white.png')}} "></div> --}}
                <p class="">Interactive lessons, "on-the-go" <br> practice, peer support.</p>
            </div>
            <div class="col-md-4 col-12 order-sm-2 order-1 d-flex hapo-footer-menu">
                <div class="hapo-menu-left col-6  mr-md-2 p-0 d-flex align-items-md-center justify-content-md-center justify-content-start">
                    <ul class="hapo-nav-footer">
                        <li class="nav-item">
                            <a class="nav-item" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item" href="#">Feature</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item" href="#">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item" href="#">Blog</a>
                        </li>
                    </ul>
                </div>
                <div class="hapo-menu-right col-6 p-0 d-flex justify-content-md-center">
                    <ul class="hapo-nav-footer">
                        <li class="nav-item">
                            <a class="nav-item" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item" href="#">Terms of Use</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item" href="#">FAQ</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hapo-footer-contact col-md-4 col-6 order-sm-3 order-2 p-0 d-flex justify-content-center align-items-center">
                <div class="hapo-nav-footer-icon d-flex">
            <a href="#" class="d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top"><img class="img-facebook" src="{{url('storage/images/facebook-icon.png')}} "></a>
                    <a href="#" class="d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top"><img class="img-call" src="{{url('storage/images/call-icon.png')}}"></a>
                    <a href="#" class="d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top"><span><i class="fa fa-envelope icon-mail"></i></span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="hapo-copyright m-0 d-flex align-items-center justify-content-center">
        <p>© 2021 ITSS ダークネス</p>
    </div>
</footer>
