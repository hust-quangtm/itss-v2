<div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-login-tab" data-toggle="tab" href="#nav-login" role="tab" aria-controls="nav-login" aria-selected="true">LOGIN</a>
                            <a class="nav-item nav-link" id="nav-register-tab" data-toggle="tab" href="#nav-register" role="tab" aria-controls="nav-register" aria-selected="false">REGISTER</a>
                        </div>
                        <button type="button" class="" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="fa fa-times d-flex justify-content-center rounded-circle position-absolute align-items-center"></span>
                        </button>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab">
                            <form class="hapo-form-login px-4 py-2" method="POST" action="{{ route('login') }}" >
                                @csrf
                                <input type="text" name="id" hidden id="loginDefault" value="{{ old('id') }}">
                                <div class="form-group hapo-login">
                                    <label for="login_email">Email:</label>
                                    <input id="loginEmail" type="email" class="form-control @error('login_email') is-invalid @enderror" name="login_email" value="{{ old('login_email') }}" required autocomplete="login_email" autofocus>

                                    @error('login_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group hapo-login">
                                    <label for="login_password">Password: </label>
                                    <input id="loginPassword" type="password" class="form-control @error('login_password') is-invalid @enderror" name="login_password" required autocomplete="current-password">

                                    @error('login_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-check d-flex justify-content-between">
                                    <div class="hapo-remember-me d-flex align-items-center">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    <div class="hapo-forgot">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="hapo-login-link d-flex justify-content-lg-center align-items-center mt-3">
                                    <button type="submit" class="btn btn-primary hapo-login-linkbut text-center">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab">
                             <form class="hapo-form-login px-4 py-3" method="POST" action="{{ route('register') }}">
                                @csrf
                                <input type="text" name="id" hidden id="registerDefault" value="{{ old('id') }}">
                                <div class="form-group hapo-register">
                                    <label for="username">User Name:</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group hapo-register">
                                    <label for="email">Email: </label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="abc@123gmail.com">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group hapo-register">
                                    <label for="password">Password: </label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="**********">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                 <div class="form-group hapo-register">
                                    <label for="password">Repeat Password: </label>
                                    <input id="passwordConfirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <div class="hapo-register-link d-flex justify-content-lg-center align-items-center mt-4 mb-5">
                                    <button type="submit" class="btn btn-primary hapo-register-linkbut text-center">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
