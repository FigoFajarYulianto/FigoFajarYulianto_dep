<?php
$setting = \App\Models\Setting::where('id', 1)->first();
$id_order = \App\Models\Order::latest()->first()->id;
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/storage/{{ $setting->favicon }}" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>{{ $setting->name }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="/fronts/assets/css/templatemo-klassy-cafe.css">
    <link rel="stylesheet" href="/fronts/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src='https://www.google.com/recaptcha/api.js'></script>


    <!-- Template Form -->
    <link rel="stylesheet" type="text/css" href="/form/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="/form/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/form/css/main-form.css">

</head>

<body>

    <style>
        .container-btn {
            text-align: center;
            width: 900px;
            height: 10px;
            padding-top: 10px;
        }

        .container-recaptcha {
            text-align: center;
            width: 900px;
            height: 100px;
            padding-top: 20px;
        }

        @media only screen and (min-width: 1024px) {
            .container-recaptcha {
                margin-left: 290px;
            }
        }
    </style>

    <section class="section mb-5" id="offers">

        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 text-center">
                    <div class="section-heading">
                        @if ($setting->main_logo)
                        <img class="mb-5" src="/storage/{{ $setting->main_logo }}" alt="{{ $setting->name }}">
                        @else
                        <h2>{{ $setting->name }}</h2>
                        @endif
                        <h6>{{ $setting->name_company }}</h6>
                        <h2>{{ $setting->name }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top:-50px;" class="col-12 grid-margin">
            <form class="form-sample" action="/consultation/reply/{{ $consultations->id }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="container-contact100-form">
                    <div class="wrap-contact100">

                        <div class="wrap-input100 validate-input">
                            <span class="contact100-form-title">
                                <b>Detail Konsultasi</b>
                            </span>
                        </div>
                        <div class="center-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nomor"><b>Nomor</b></label>
                                    <div class="wrap-input100 validate-input">
                                        <input class="input-bold input100" type="text" name="nomor" value="{{ old('nomor', $consultations->nomor) }}" readonly="readonly" placeholder="nomor">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-address-card" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="nama"><b>Nama</b></label>
                                    <div class="wrap-input100 validate-input">
                                        <input class="input-bold input100" type="text" name="nama" value="{{ old('nama', $consultations->nama) }}" readonly="readonly" placeholder="Nama">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-list-ol" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="alamat"><b>Alamat</b></label>
                                    <div class="wrap-input100 validate-input">
                                        <input class="input-bold input100" type="text" name="alamat" value="{{ old('alamat', $consultations->alamat) }}" readonly="readonly" placeholder="Alamat">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="whatsapp"><b>Whatsapp</b></label>
                                    <div class="wrap-input100 validate-input">
                                        <input class="input-bold input100" type="number" name="whatsapp" value="{{ old('whatsapp', $consultations->whatsapp) }}" readonly="readonly" placeholder="Whatsapp">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label class="center-form-description-title" for="judul"><b>Judul</b></label>
                        <div class="center-form-description wrap-input100 validate-input">
                            <textarea class="input-bold input100" name="judul" placeholder="Judul" id="judul" rows="1" readonly="readonly">{{ old('pesan', $consultations->judul) }}</textarea>
                            <span class="focus-input100"></span>
                        </div>
                        <label class="center-form-description-title" for="pesan"><b>Pesan</b></label>
                        <div class="center-form-description wrap-input100 validate-input">
                            <textarea class="input-bold input100" name="pesan" placeholder="Pesan" id="pesan" rows="1" readonly="readonly">{{ old('pesan', $consultations->pesan) }}</textarea>
                            <span class="focus-input100"></span>
                        </div>
                        <label class="center-form-description-title" for="lampiran"><b>Lampiran</b></label>
                        <div class="center-form-description wrap-input100 validate-input">
                            <textarea class="input-bold input100" name="lampiran" placeholder="Lampiran" id="lampiran" rows="1" readonly="readonly">{{ old('pesan', $consultations->lampiran) }}</textarea>
                            <span class="focus-input100"></span>
                        </div>
                        <!-- <div class="container-contact100-form-btn">
                                    <button class="contact100-form-btn">
                                        Send
                                    </button>
                                </div> -->

                        <label class="center-form-description-title" for="jawaban"><b>Balas</b></label>
                        <div class="center-form-description wrap-input100 validate-input">
                            <textarea class="input-bold input100" name="jawaban" placeholder="Balas Pesan Disini" id="jawaban" rows="1">{{ old('pesan', $consultations->jawaban) }}</textarea>
                            <span class="focus-input100"></span>
                        </div>

                        <div class="container-recaptcha form-group mt-3 mb-3">
                            <div class="g-recaptcha  @error('g-recaptcha-response') is-invalid @enderror" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                            @error('g-recaptcha-response')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="container-btn">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>
                </div>
            </form>

            @foreach ($consultations->Consultationreplies as $item)

            <div class="row" style="display: flex; justify-content:center;">
                <div class="col-md-9">
                    <div class="form-group">
                        <div class="card-header bg-light">
                            <h4 class="my-0 small">
                                <i class="fas fa-user me-2"></i> {{ $item->user->name ?? $consultations->nama }}
                                <span class="float-end small">
                                    {{ date('d/m/Y H:i', strtotime($item->created_at)) }}
                                </span>
                            </h4>
                        </div>
                        <div style="background-color: #e6e6e5; opacity: 0.5; font-weight: bold;" class="card-body">
                            <p style="color: black;" class="my-0">{{ $item->jawaban }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach


        </div>

        <!-- Script Form -->
        <script src="/form/vendor/select2/select2.min.js"></script>

        <script src="/form/vendor/tilt/tilt.jquery.min.js"></script>
        <script>
            $('.js-tilt').tilt({
                scale: 1.1
            })
        </script>

        <script src="/form/js/main.js"></script>

</body>

</html>