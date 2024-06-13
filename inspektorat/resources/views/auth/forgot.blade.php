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
                            <button type="submit" class="btn btn-primary">Reset</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection