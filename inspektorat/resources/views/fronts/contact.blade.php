@extends('fronts.template')
@section('content')
     <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5" style="background-color: rgba(14, 29, 52, 0.9)">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-8 text-center text-uppercase">
                        <h3 class="text-uppercase text-white">{{ $title_bar }}</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="contact-info-area pt-5 mt-3 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="contact-info">
                        <i class="icofont-location-pin" style="color: rgba(14, 29, 52, 0.9)"></i>
                        <span style="color: rgba(14, 29, 52, 0.9)">Alamat:</span>
                        <a href="javascript:void(0)">{{ $setting->address }}</a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="contact-info" style="color: rgba(14, 29, 52, 0.9)">
                        <i class="icofont-ui-call" style="color: rgba(14, 29, 52, 0.9)"></i>
                        <span style="color: rgba(14, 29, 52, 0.9)">Phone:</span>
                        <a href="tel:{{ $setting->telp }}">{{ $setting->telp }}</a>
                    </div>
                </div>
                <div class="col-sm-6 offset-sm-3 offset-lg-0 col-lg-4">
                    <div class="contact-info">
                        <i class="icofont-ui-email" style="color: rgba(14, 29, 52, 0.9)"></i>
                        <span style="color: rgba(14, 29, 52, 0.9)">Email:</span>
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
                                <i class="icofont-user-alt-3" style="color: rgba(14, 29, 52, 0.9)"></i>
                            </label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                required data-error="Please enter your name" style="background-color: rgb(236, 236, 236)">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>
                                <i class="icofont-ui-email" style="color: rgba(14, 29, 52, 0.9)"></i>
                            </label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                required data-error="Please enter your email" style="background-color: rgb(236, 236, 236)">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>
                                <i class="icofont-notepad " style="color: rgba(14, 29, 52, 0.9)"></i>
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
                                <i class="icofont-comment" style="color: rgba(14, 29, 52, 0.9)"></i>
                            </label>
                            <textarea name="message" class="form-control" id="message" cols="30" rows="8" placeholder="Write message"
                                required data-error="Write your message" style="background-color: rgb(236, 236, 236)"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                     <center>
                        <div class="form-group mb-3">
                            <div class="g-recaptcha  @error('g-recaptcha-response') is-invalid @enderror"
                                data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                            @error('g-recaptcha-response')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </center>
                    <div class="col-lg-12">
                        <button type="submit" class="btn common-btn" style="background-color: rgba(14, 29, 52, 0.9)">
                            Send Message
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="map-area">
            <iframe id="map" {!! $setting->map !!}></iframe>
        </div>
    </div>
@endsection
