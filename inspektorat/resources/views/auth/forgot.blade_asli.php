<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ $title_bar }}</title>
    <link href="login/dashboard/css/styles.css" rel="stylesheet" />

    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,400,500">
    <link rel="stylesheet" href="/baru/css/bootstrap.css">
    <link rel="stylesheet" href="/baru/css/fonts.css">
    <link rel="stylesheet" href="/baru/css/style.css">
</head>

<body style="background-color:blue ;">
    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <div class="col-lg-5">

                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/auth/reset" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="small mb-1" for="username">Username</label>
                                <input class="form-control @error('username') is-invalid @enderror" id="username" name="username" type="text" aria-describedby="username" placeholder="Nama User" />
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- <div class="form-group mb-3">
                                {!! RecaptchaV3::initJs() !!}
                                {!! RecaptchaV3::field('forgot') !!}
                                @error('g-recaptcha-response')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> -->
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="/auth">Login</a>
                                <button type="submit" class="btn btn-primary">Reset</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>