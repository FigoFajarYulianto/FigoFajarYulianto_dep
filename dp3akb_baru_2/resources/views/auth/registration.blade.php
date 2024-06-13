@extends('auth.template')
@section('content')
    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <a href="/" class="logo d-flex">
                    @if ($setting->sec_logo)
                        <center>
                            <a href="/">
                                <img width="250" class="mt-5 pt-3 mb-3" src="/storage/{{ $setting->sec_logo }}"
                                    alt="{{ $setting->name }}" />
                            </a>
                        </center>
                    @else
                        {{ $setting->name }}
                    @endif
                </a>
                <div class="card shadow-lg border-0 rounded-lg mt-3">
                    <div class="card-header justify-content-center">
                        <h3 class="fw-light my-0">{{ $title_bar }}</h3>
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/auth/registration" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="small mb-1" for="name">Nama</label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="name" type="text" placeholder="Nama" value="{{ old('name') }}"
                                    autofocus />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="username">Username</label>
                                <input class="form-control @error('username') is-invalid @enderror" id="username"
                                    name="username" type="text" placeholder="Username" value="{{ old('username') }}" />
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" name="email"
                                    id="email" type="text" placeholder="Email" value="{{ old('email') }}" />
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="no_phone">Telp / HP</label>
                                <input class="form-control @error('no_phone') is-invalid @enderror" name="no_phone"
                                    id="no_phone" type="number" placeholder="Telp / HP" value="{{ old('no_phone') }}" />
                                @error('no_phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="password">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" name="password"
                                    id="password" type="password" placeholder="Password" value="{{ old('password') }}" />
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3 text-center">
                                <div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror"
                                    data-sitekey="{{ env('RECAPTCHAV2_SITEKEY') }}"></div>
                                @error('g-recaptcha-response')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="/auth">Login</a>
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small text-muted text-uppercase">
                            &copy; {{ date('Y') }} - BAZNAS
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#username').on('keyup', function() {
                const username = $(this).val().toLowerCase().replace(/\W/g, '');
                $('#username').val(username);
            });

            const name = document.querySelector('#name');
            if (name) {
                name.addEventListener('change', function() {
                    fetch('/users/username?name=' + name.value)
                        .then(response => response.json())
                        .then(data => username.value = data.username)
                });
            }
        });
    </script>
@endsection
