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
    <link rel="stylesheet" type="text/css" href="/form/css/main.css">
    <link rel="stylesheet" type="text/css" href="/form/css/style.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/cf/ContactFrom_v12/css/main.css"> -->

    <style type="text/css">
        .input-bold {
            font-weight: bold;
        }
    </style>

</head>

<body>

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
                        <div class="center-form-consultation">
                            <div class="row">
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
                            <label class="center-form-description-title-judul" for="judul"><b>Judul</b></label>
                            <div class="center-form-judul wrap-input100 validate-input">
                                <input class="input-bold input100" type="text" name="judul" value="" placeholder="Judul">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                </span>
                            </div>

                            <label class="center-form-description-title-judul" for="lampiran"><b>Lampiran</b></label>
                            <div class="center-form-description wrap-input100 validate-input">
                                <textarea class="input-bold input100" name="lampiran" placeholder="Lampiran" id="lampiran" rows="5">{{ old('lampiran') }}</textarea>
                                <span class="focus-input100"></span>
                            </div>
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

        const id = $(this).data('id');
        console.log(id);
        if (cartLS.get(id)) {
            createInv()
            $('.div_faktur').show();
            getCart();
        } else {
            $('.div_faktur').show();
            getCart();
        }


        function createInv() {
            console.log($('#tanggal').val());
            $.ajax({
                url: "/api/orders/createinv?tanggal=" + $('#tanggal').val(),
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('#faktur').val(response.number);
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

</body>

</html>