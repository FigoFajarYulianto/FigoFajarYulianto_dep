{{--  <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/">{{ $pengaturan->nama_institusi }}</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                @if ($errors->has('kredensial'))
                    <div class="alert alert-warning">{{ $errors->first('kredensial') }}</div>
                @endif
                <form action="{{ route('login.post') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input type="text" name="nis"
                                class="form-control @if ($errors->has('nis')) is-invalid @endif"
                                placeholder="Username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('nis'))
                            <span class="small text-danger">{{ $errors->first('nis') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <input type="password" name="password"
                                class="form-control @if ($errors->has('nis')) is-invalid @endif"
                                placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="small text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/js/adminlte.min.js') }}"></script>

</body>

</html>  --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Neptune Auth Login 1 | Neptune - Multipurpose Bootstrap Admin Dashboard Template</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Common Styles Starts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="/baru/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/baru/assets/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/baru/assets/css/structure.css" rel="stylesheet" type="text/css" />
    <link href="/baru/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="/baru/plugins/highlight/styles/monokai-sublime.css" rel="stylesheet" type="text/css" />
    <!-- Common Styles Ends -->
    <!-- Common Icon Starts -->
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Common Icon Ends -->
    <!-- Page Level Plugin/Style Starts -->
    <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
    <link href="/baru/plugins/owl-carousel/owl.carousel.min.css" rel="stylesheet" type="text/css">
    <link href="/baru/plugins/owl-carousel/owl.theme.default.min.css" rel="stylesheet" type="text/css">
    <link href="/baru/assets/css/authentication/auth_1.css" rel="stylesheet" type="text/css">
    <!-- Page Level Plugin/Style Ends -->
</head>







<body class="login-one">

    <!-- Main Body Starts -->

    <form action="{{ route('login.post') }}" method="post">
        @csrf
        <div class="container-fluid login-one-container">

            <div class="p-30 h-100">
                <div class="row main-login-one h-100">
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 p-0">
                        <div class="login-one-start">
                            @if ($errors->has('kredensial'))
                                <div class="alert alert-warning">{{ $errors->first('kredensial') }}</div>
                            @endif
                            <h6 class="mt-2 text-primary text-center font-20">Log In</h6>
                            <p class="text-center text-muted mt-3 mb-3 font-14">Please Log into your account</p>
                            <div class="login-one-inputs mt-5">
                                <input type="text" name="nis"
                                    class="form-control @if ($errors->has('nis')) is-invalid @endif"
                                    placeholder="Username" />
                                <i class="las la-user-alt"></i>
                                @if ($errors->has('nis'))
                                    <span class="small text-danger">{{ $errors->first('nis') }}</span>
                                @endif
                            </div>
                            <div class="login-one-inputs mt-3">
                                <input type="password" name="password"
                                    class="form-control @if ($errors->has('nis')) is-invalid @endif"
                                    placeholder="Password" />
                                <i class="las la-lock"></i>
                                @if ($errors->has('password'))
                                    <span class="small text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="login-one-inputs check mt-4">
                                <input class="inp-cbx" id="cbx" type="checkbox" style="display: none">
                                <label class="cbx" for="cbx">
                                    <span>
                                        <svg width="12px" height="10px" viewBox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </svg>
                                    </span>
                                    <span class="font-13 text-muted">Remember me ?</span>
                                </label>
                            </div>
                            <div class="login-one-inputs mt-4">
                                <button class="ripple-button ripple-button-primary btn-lg btn-login" type="submit">
                                    <div class="ripple-ripple js-ripple">
                                        <span class="ripple-ripple__circle"></span>
                                    </div>
                                    LOG IN
                                </button>
                            </div>
                            <div class="login-one-inputs mt-4 text-center font-12 strong">
                                <a href="auth_forget_password_1.html" class="text-primary">Forgot your Password ?</a>
                            </div>
                            <div class="login-one-inputs social-logins mt-4">

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-6 col-md-6 d-none d-md-block p-0">
                        <div class="slider-half">
                            <div class="slide-content">
                                <div class="top-sign-up ">
                                    <div class="about-comp text-white mt-2">
                                        Ujian SPKP TUGU
                                    </div>
                                    <div class="for-sign-up">
                                        <p class="text-white font-12 mt-2 font-weight-300">Dont have an account ?</p>
                                        <a href="auth_signup_1.html">Sign Up</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="owl-carousel owl-theme">
                                    <div class="item">
                                        <i class="lar la-grin-alt font-45 text-white"></i>
                                        <h2 class="font-30 text-white mt-2">Selamat Datang</h2>
                                        <p class="summary-count text-white font-12 mt-2 slide-text">Everyone has been
                                            made
                                            for some particular work, and the desire for that work has been put in every
                                            heart</p>
                                    </div>
                                    <div class="item">
                                        <i class="lar la-clock font-45 text-white"></i>
                                        <h2 class="font-30 text-white mt-2">Silahkan Login</h2>
                                        <p class="summary-count text-white font-12 mt-2 slide-text">Everyone has been
                                            made
                                            for some particular work, and the desire for that work has been put in every
                                            heart</p>
                                    </div>
                                    <div class="item">
                                        <i class="las la-hand-holding-usd font-45 text-white"></i>
                                        <h2 class="font-30 text-white mt-2">Segera</h2>
                                        <p class="summary-count text-white font-12 mt-2 slide-text">Everyone has been
                                            made
                                            for some particular work, and the desire for that work has been put in every
                                            heart</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Level Plugin/Script Starts -->
        <script src="/baru/assets/js/loader.js"></script>
        <script src="/baru/assets/js/libs/jquery-3.1.1.min.js"></script>
        <script src="/baru/plugins/owl-carousel/owl.carousel.min.js"></script>
        <script src="/baru/plugins/owl-carousel/owl.carousel.js"></script>
        <script src="/baru/bootstrap/js/bootstrap.min.js"></script>
        <script src="/baru/assets/js/authentication/auth_1.js"></script>
        <!-- Page Level Plugin/Script Ends -->
    </form>
</body>

</html>
