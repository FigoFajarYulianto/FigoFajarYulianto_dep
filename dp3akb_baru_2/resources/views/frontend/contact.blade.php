@extends('frontend.template')
@section('content')
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('assets/img/page-header.jpg');">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-6 text-center">
                        <h2 style="font-size: 32px;">{{ $title_bar }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>{{ $title_bar }}
                </ol>
            </div>
        </nav>
    </div>
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div>
                <div class="row">
                    {!! $setting->code !!}
                </div>
            </div>
            <div class="row gy-4 mt-4">
                <div class="col-lg-4">
                    <div class="info-item d-flex"><i class="flex-shrink-0">
                        <iconify-icon icon="material-symbols:location-on"></iconify-icon>
                    </i>
                    <div>
                        <h4>Lokasi:</h4>
                        <p>{{ $setting->address }}</p>
                    </div>
                </div>
                <div class="info-item d-flex"> <i class="flex-shrink-0">
                        <iconify-icon icon="ic:round-email"></iconify-icon>
                    </i>
                    <div>
                        <h4>Email:</h4>
                        <p><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="8de4e3ebe2cde8f5ece0fde1e8a3eee2e0">{{ $setting->email }}</a></p>
                    </div>
                </div>
                <div class="info-item d-flex"> <i class="flex-shrink-0">
                        <iconify-icon icon="material-symbols:call"></iconify-icon>
                    </i>
                    <div>
                        <h4>Hubungi Kami:</h4>
                        <p>{{ $setting->telp }}</p>
                    </div>
                </div>
                </div>
                <div class="col-lg-8">
                    <form action="/contact/sendmessage" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group"> <input type="text" name="name" class="form-control"
                                    id="name" placeholder="Your Name" required></div>
                            <div class="col-md-6 form-group mt-3 mt-md-0"> <input type="email" class="form-control"
                                    name="email" id="email" placeholder="Your Email" required></div>
                        </div>
                        <div class="form-group mt-3"> <input type="text" class="form-control" name="subject"
                                id="subject" placeholder="Subject" required></div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
