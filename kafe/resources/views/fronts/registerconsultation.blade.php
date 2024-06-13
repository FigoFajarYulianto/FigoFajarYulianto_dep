<?php
$setting = \App\Models\Setting::where('id', 1)->first();
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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="/form/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="/fronts/assets/css/templatemo-klassy-cafe.css">
    <link rel="stylesheet" href="/fronts/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Template Form -->
    <link rel="stylesheet" type="text/css" href="/form/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="/form/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/form/css/main-form.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/cf/ContactFrom_v12/css/main.css"> -->

    <style type="text/css">
        .input-bold {
            font-weight: bold;
        }
    </style>

</head>

<body>

    <style>
        .center-form-description-title {
            margin-top: 5px;
            margin-left: 11px;
        }

        .center-form-description {
            margin-top: 15px;
            margin-right: 39px;
            margin-left: 80px;
            width: 80%;
        }

        @media only screen and (max-width: 450px) {
            .center-form-description-title {
                margin-top: 5px;
                margin-left: 0px;
            }
        }

        @media only screen and (max-width: 450px) {
            .center-form-description {
                margin-top: 0px;
                margin-right: 0px;
                margin-left: 0px;
                width: 350px;
            }
        }

        .form-judul {
            /* margin-top: 15px;
            margin-right: 100px;
            margin-left: 100px; */
            width: 97%;
        }

        .input-form {
            height: 50px;
            border-radius: 25px;
            padding: 0 170px 0 50px;
        }

        /* .input-select-field {
            height: fit-content;
            border-radius: 25px;
            width: 420px;

        } */

        @media only screen and (max-width: 450px) {
            .input-select-field {
                /* height: fit-content;
                border-radius: 25px;
                width: 270px; */

                border-radius: 25px;
                height: fit-content;
                position: relative;
                display: block;
                max-width: 500px;
                min-width: 180px;
                margin: 0 auto;

            }
        }

        @media only screen and (max-width: 1024px) and (min-width: 768px) {
            .input-select-field {
                border-radius: 25px;
                height: fit-content;
                position: relative;
                display: block;
                width: 680px;
                margin: 0 auto;
            }
        }

        @media only screen and (max-width: 1440px) and (min-width: 1050px) {
            .input-select-field {
                height: fit-content;
                border-radius: 25px;
                width: 860px;
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
            <form class="form-sample" action="/register/consultation/store" method="post" enctype="multipart/form-data">
                @csrf
                <div class="container-contact100-form">
                    <div class="wrap-contact100">
                        <div class="wrap-input100 validate-input">
                            <span class="contact100-form-title">
                                <b>Registrasi Konsultasi</b>
                            </span>
                        </div>
                        <div class="row">
                            <input type="hidden" name="tanggal" id="tanggal" class="form-control mt-1" value="{{ date('Y-m-d') }}">
                            <div class="hide div_nomor wrap-input100 validate-input">
                                <input class="input-bold input100" type="text" id="nomor" name="nomor" placeholder="Nomor">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label for="nama"><b>Nama</b></label>
                                <div class="wrap-input100 validate-input">
                                    <input class="input-bold input100" type="text" name="nama" value="{{ $nama }}" placeholder="Nama">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="whatsapp"><b>Whatsapp</b></label>
                                <div class="wrap-input100 validate-input">
                                    <input class="input-bold input100" type="text" name="whatsapp" value="{{ $whatsapp }}" placeholder="Whatsapp">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <input class="hide input-bold input100" type="text" name="statusconsultation_id" value="1">

                        <label for="categoryconsultation_id"><b>Kategori Konsultasi</b></label>
                        <div class="wrap-input100 validate-input">
                            <select class="input-select-field form-control mt-1 input-bold input100 @error('categoryconsultation_id') is-invalid @enderror" name="categoryconsultation_id" id="categoryconsultation_id">
                                <option value="">:: Pilih ::</option>
                                @foreach ($category as $item)
                                <option value="{{ $item->id }}" {{ old('categoryconsultation_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                                @endforeach
                            </select>
                            @error('categoryconsultation_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <label for="judul"><b>Alamat</b></label>

                        <div class="wrap-input100 validate-input">
                            <input class="form-judul input-bold input100" type="text" name="alamat" value="" placeholder="Masukkan Alamat Anda">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-address-card" aria-hidden="true"></i>
                            </span>
                        </div>


                        <label for="judul"><b>Judul</b></label>

                        <div class="wrap-input100 validate-input">
                            <input class="form-judul input-bold input100" type="text" name="judul" value="" placeholder="Judul">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-book" aria-hidden="true"></i>
                            </span>
                        </div>

                        <label class="center-form-description-title" for="pesan"><b>Pesan</b></label>
                        <div class="center-form-description wrap-input100 validate-input">
                            <textarea class="input-bold input100" name="pesan" placeholder="Masukkan Pesan Anda" id="pesan" rows="1">{{ old('pesan') }}</textarea>
                            <span class="focus-input100"></span>
                        </div>

                        <label class="center-form-description-title" for="lampiran"><b>Lampiran</b></label>
                        <div class="center-form-description wrap-input100 validate-input">
                            <textarea class="input-bold input100" name="lampiran" placeholder="Lampiran" id="lampiran" rows="1">{{ old('lampiran') }}</textarea>
                            <span class="focus-input100"></span>
                        </div>
                        <!-- <div class="container-contact100-form-btn">
                                    <button class="contact100-form-btn">
                                        Send
                                    </button>
                                </div> -->

                    </div>

                </div>
                <center>
                    <button style="margin-top: -200px;" type="submit" class="mb-5 mr-3 btn btn-primary">
                        <p3 style="font-family: Arial; color: white;">Lanjut</p3>
                    </button>
                </center>
            </form>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

    <script>
        // Faktur Otomatis


        // if (cartLS.get(id)) {
        //     createInv()
        //     $('.div_faktur').show();
        // } else {
        //     $('.div_faktur').hide();
        // }

        $('.refaktur').on('click', function() {
            location.reload();
            // cartLS.destroy();
            // cartPenjualan();
            // createInv();
        });

        // const id = $(this).data('id');
        // console.log(id);
        // if (cartLS.get(id)) {
        //     createInv()
        //     $('.div_nomor').show();
        //     getCart();
        // } else {
        //     $('.div_nomor').show();
        //     getCart();
        // }


        if ($('#tanggal').val()) {
            createInv()
        }


        function createInv() {
            console.log($('#tanggal').val());
            $.ajax({
                url: "/api/consultations/createinv?tanggal=" + $('#tanggal').val(),
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('#nomor').val(response.number);
                }
            });
        }
    </script>

    <!-- Script Form -->
    <script src="/form/vendor/select2/select2.min.js"></script>

    <script src="/form/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>

    <script src="/form/js/main.js"></script>

    <script>
        $('.hide').hide();
    </script>

    <script>
        function createInv() {
            $.ajax({
                url: "/api/orders/createinv?tanggal=" + $('#tanggal').val(),
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#faktur').val(response.number);
                }
            });
        }
    </script>

</body>

</html>