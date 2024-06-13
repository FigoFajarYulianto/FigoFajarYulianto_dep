@extends('auth.template')
@section('content')
<?php $setting = App\Models\Setting::where('id', 1)->first(); ?>
<div class="container-xl px-4">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <img src="{{ '/storage/' . $setting->sec_logo }}" width="80%" alt="" class="mx-auto d-block mt-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-body">
                    {!! session('msg') !!}
                    <form action="/auth/newpassword" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                        <div class="mb-3">
                            <label class="small mb-1" for="username">Username</label>
                            <input class="form-control @error('username') is-invalid @enderror" id="username" name="username" type="text" aria-describedby="username" placeholder="Nama User" value="{{ $user->username }}" readonly />
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" aria-describedby="email" placeholder="Email" value="{{ $user->email }}" readonly />
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="password">Password Baru</label>
                            <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" aria-describedby="password" />
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <div class="g-recaptcha  @error('g-recaptcha-response') is-invalid @enderror" data-sitekey="{{ env('RECAPTCHAV2_SITEKEY') }}"></div>
                            @error('g-recaptcha-response')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small" href="/auth">Login</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center mb-0">
                    <div class="small text-muted text-uppercase">&copy; {{ date('Y') }} {{ $setting->name }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection