@extends('fronts.template')
@section('content')
     <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5" style="background-color: rgba(14, 29, 52, 0.9)">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-6 text-center">
                        <h3 class="text-uppercase text-white">{{ $title_bar }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $setting = \App\Models\Setting::where('id', 1)->first(); ?>
    <div class="contact-area pb-70 mt-5">
        <div class="container">
            {!! session('msg') !!}
            <form action="/testimonials" method="post" class="row" enctype="multipart/form-data" id="contactForm">
                @csrf
                <div class="col-lg-6 col-md">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="name"
                            class="form-control mt-1 form-control-lg @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md">
                    <div class="form-group">
                        <label for="rateStar" class="small">1 Bintang: Mengecewakan, 5 Bintang: Mantap!</label>
                        <input required id="rateStar" name="rateStar" class="rating rating-loading" data-show-clear="false"
                            data-show-caption="false">
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="form-group">
                        <label for="image">Foto</label>
                        <input type="file" name="image" id="image"
                            class="mt-1 form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="form-group">
                        <label for="description">Testimonial</label>
                        <textarea name="description" id="description" rows="8"
                            class="form-control mt-1 form-control-lg @error('description') is-invalid @enderror"></textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
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
                <div class="text-center d-grid mt-1">
                    <button type="submit" class="btn common-btn" style="background-color: rgba(14, 29, 52, 0.9)">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
