@extends('frontend.template')
@section('content')
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-10 text-center">
                        <h2>{{ $title_bar }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol class="text-muted">
                    <li><a href="/">Beranda</a></li>
                    <li>{{ $title_bar }}</li>
                </ol>
            </div>
        </nav>
    </div>

    <div class="contact-info-area pt-5 mt-3 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="contact-info">
                        <i class="icofont-location-pin"></i>
                        <span>Location:</span>
                        <a href="javascript:void(0)">{{ $setting->address }}</a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="contact-info">
                        <i class="icofont-ui-call"></i>
                        <span>Phone:</span>
                        <a href="tel:{{ $setting->telp }}">{{ $setting->telp }}</a>
                    </div>
                </div>
                <div class="col-sm-6 offset-sm-3 offset-lg-0 col-lg-4">
                    <div class="contact-info">
                        <i class="icofont-ui-email"></i>
                        <span>Email:</span>
                        <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-area mb-5">
        <div class="container">
            <center>
                {!! session('msg') !!}
            </center>
            <form action="/contact/sendmessage" method="post" id="contactForm">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>
                                <i class="icofont-user-alt-3"></i>
                            </label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                required data-error="Please enter your name" style="background-color: rgb(236, 236, 236)">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>
                                <i class="icofont-ui-email"></i>
                            </label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                required data-error="Please enter your email" style="background-color: rgb(236, 236, 236)">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>
                                <i class="icofont-notepad"></i>
                            </label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject"
                                required data-error="Please enter your subject"
                                style="background-color: rgb(236, 236, 236)">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>
                                <i class="icofont-comment"></i>
                            </label>
                            <textarea name="message" class="form-control" id="message" cols="30" rows="8" placeholder="Write message"
                                required data-error="Write your message" style="background-color: rgb(236, 236, 236)"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group text-center">
                            <div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror"
                                data-sitekey="{{ env('RECAPTCHAV2_SITEKEY') }}"></div>
                            @error('g-recaptcha-response')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn common-btn">
                            Send Message
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if ($setting->map)
        <div class="map-area">
            {{ $setting->map }}
        </div>
    @endif
@endsection
