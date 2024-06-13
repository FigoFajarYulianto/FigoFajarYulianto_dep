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

        <center>
            <div style="width:60%;" class="alert alert-success">
                <strong>Selamat!</strong> Order anda telah masuk du database kami<br>Anda juga berkesempatan untuk mendapatkan layanan hukum konsultasi gratis,<br><strong>klik tombol dibawah detail detail order</strong>
            </div>
        </center>
        <br>
        <br>

        <div style="margin-top:-50px;" class="col-12 grid-margin">
            <form class="form-sample" action="/register/consultation/order" method="post" enctype="multipart/form-data">
                @csrf
                <div class="container-contact100-form">
                    <div class="wrap-contact100">

                        <div class="wrap-input100 validate-input">
                            <span class="contact100-form-title">
                                <b>Detail Order</b>
                            </span>
                        </div>
                        <div class="center-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="faktur"><b>Faktur</b></label>
                                    <div class="wrap-input100 validate-input">
                                        <input class="input-bold input100" type="text" name="faktur" value="{{ old('faktur', $order->faktur) }}" readonly="readonly" placeholder="faktur">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-address-card" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="meja"><b>Nomer Meja</b></label>
                                    <div class="wrap-input100 validate-input">
                                        <input class="input-bold input100" type="text" name="meja" value="{{ old('meja', $order->meja) }}" readonly="readonly" placeholder="Nomer Meja">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-list-ol" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nama"><b>Nama</b></label>
                                    <div class="wrap-input100 validate-input">
                                        <input class="input-bold input100" type="text" name="nama" value="{{ old('nama', $order->nama) }}" readonly="readonly" placeholder="Nama">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="whatsapp"><b>Whatsapp</b></label>
                                    <div class="wrap-input100 validate-input">
                                        <input class="input-bold input100" type="text" name="whatsapp" value="{{ old('whatsapp', $order->whatsapp) }}" readonly="readonly" placeholder="Whatsapp">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label class="center-form-description-title" for="keterangan"><b>Keterangan</b></label>
                        <!-- <label for="keterangan"><b>Keterangan</b></label> -->
                        <div class="center-form-description wrap-input100 validate-input">
                            <!-- <div class="wrap-input100 validate-input"> -->
                            <textarea class="input-bold input100" name="keterangan" placeholder="Keterangan" id="keterangan" rows="5" readonly="readonly">{{ old('keterangan', $order->keterangan) }}</textarea>
                            <span class="focus-input100"></span>
                        </div>
                        <!-- <div class="container-contact100-form-btn">
                                    <button class="contact100-form-btn">
                                        Send
                                    </button>
                                </div> -->

                    </div>
                    <div style="margin-top:-100px;" class="card shadow">
                        <div class="card-body-form">
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Nama </th>
                                            <th> Qty </th>
                                            <th> Harga </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderitem as $row)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            </td>
                                            <td>{{ $row->menu->nama ?? '' }}</td>
                                            <td>{{ $row->qty }}</td>
                                            <td>Rp @currency($row->harga)</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <center>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="total_order">Total Harga</label>
                                            <input type="text" name="total_order" id="total_order" class="form-control" value="Rp @currency($order->total)" onkeyup="strToNum('total_order')" readonly="readonly">
                                            @error('total_order')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </center>
                                <!-- <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="total_diskon">Total Diskon</label>
                                <input type="text" name="total_diskon" id="total_diskon" class="form-control" value="{{ old('total_diskon', $order->total_diskon) }}" onkeyup="strToNum('total_diskon')" readonly="readonly">
                                @error('total_diskon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div> -->
                            </div>

                        </div>
                    </div>
                </div>
                <center>
                    <a type="button" href="/" class="mb-5 mt-3 mr-3 btn btn-primary">
                        <p3 style="font-family: Arial; color: white;">Kembali</p3>
                    </a>
                    <button type="submit" class="mb-5 mt-3 btn btn-success">
                        <p3 style="font-family: Arial; color: white;">Konsultasi hukum gratis</p3>
                    </button>
                </center>
            </form>
        </div>
    </section>

    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="/fronts/assets/js/scrollreveal.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
    <script src="/fronts/assets/js/imgfix.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.0/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.4/isotope.pkgd.min.js"></script>
    <script src="/fronts/assets/js/custom.js"></script>
    <script src="https://unpkg.com/cart-localstorage@1.1.4/dist/cart-localstorage.min.js" type="text/javascript"></script>
    <script>
        getCart();

        function incrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

            if (!isNaN(currentVal)) {
                parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
            } else {
                parent.find('input[name=' + fieldName + ']').val(0);
            }
        }

        function decrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

            if (!isNaN(currentVal) && currentVal > 0) {
                parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
            } else {
                parent.find('input[name=' + fieldName + ']').val(0);
            }
        }

        $('.input-group').on('click', '.button-plus', function(e) {
            incrementValue(e);
        });

        $('.input-group').on('click', '.button-minus', function(e) {
            decrementValue(e);
        });

        function addCart(id, name, price) {
            const qty = $('#quantity' + id).val() ? $('#quantity' + id).val().replace(/[^0-9,]/g, '').replace(',',
                '.') : 0;
            if (cartLS.get(id)) {
                if (parseInt(qty) === 0) {
                    cartLS.remove(parseInt(id));
                } else {
                    cartLS.update(parseInt(id), 'quantity', parseFloat(qty));
                }
            } else {
                cartLS.remove(parseInt(id));
                cartLS.add({
                    id: parseInt(id),
                    name: name,
                    price: price
                }, parseFloat(qty));
            }
            getCart();
        }

        $(document).on('click', '.removeItem', function() {
            r = confirm('Yakin ingin melanjutkan?');
            if (r == true) {
                const id = $(this).data('id');
                if (cartLS.get(id)) {
                    cartLS.remove(id);
                }
                if (cartLS.list().length == 0) {
                    $('#cartListOrder').html('');
                    getCart();
                } else {
                    getCart();
                }
            }
        });

        function getCart() {
            const carts = cartLS.list();
            $('#totalcart').html(carts.length);
            if (carts.length > 0) {
                $('#cartListOrder').html('');
                let grandtotal = 0;
                for (let i = 0; i < carts.length; i++) {
                    const cart = carts[i];
                    const subtotal = cart.price * cart.quantity;
                    grandtotal += subtotal;
                    $('#quantity' + cart.id).val(cart.quantity);

                    $('#cartListOrder').append(`
                        <tr>
                            <td>` + (parseInt(i) + 1) + `</td>
                            <td>` + cart.name + `</td>
                            <td>` + cart.quantity + `</td>
                            <td>` + cart.price + `</td>
                            <td>` + subtotal + `</td>
                            <td><button class="btn btn-danger btn-sm removeItem" type="button" data-id="` +
                        cart.id + `"><i class="fas text-warning fa-sm fa-trash fa-sm"></i></button></td>
                        </tr>
                    `);
                }

                $('#cartListOrder').append(`
                    <tr>
                        <td colspan="4">
                            <input type="hidden" id="grandtotal" value="` + grandtotal + `">
                            Grand Total
                        </td>
                        <td>` + grandtotal + `</td>
                        <td></td>
                    </tr>
                `);
            }
        }

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

        // Masuk Ke Controller
        $(document).on('click', '.checkout', function() {
            r = confirm('Yakin ingin melanjutkan?');
            if (r == true) {
                const faktur = $('#faktur').val();
                const nama = $('#nama').val();
                const whatsapp = $('#whatsapp').val();
                const meja = $('#meja').val();
                const keterangan = $('#keterangan').val();

                const grandtotal = $('#grandtotal').val() ? $('#grandtotal').val() : 0;

                const cartList = cartLS.list();
                if (cartList) {
                    $.ajax({
                        url: '/orders',
                        method: 'post',
                        data: {
                            faktur,
                            nama,
                            whatsapp,
                            meja,
                            keterangan,
                            grandtotal,
                            data: cartList
                        },
                        dataType: 'json',
                        success: function(response) {
                            // console.log(response);
                            if (response.status) {
                                cartLS.destroy();
                                $("#toastAlert").toast({
                                    delay: 3000
                                });
                                $("#toastAlert").toast('show');
                                $("#infoToast").html('Oops!');
                                $(".toast-body>#message").html(response.msg);
                                window.open('/');
                                location.reload();
                            } else {
                                $("#toastAlert").toast({
                                    delay: 3000
                                });
                                $("#toastAlert").toast('show');
                                $("#infoToast").html('Oops!');
                                $(".toast-body>#message").html(response.msg);
                            }
                        }
                    });
                } else {
                    $("#toastAlert").toast({
                        delay: 3000
                    });
                    $("#toastAlert").toast('show');
                    $("#infoToast").html('Oops!');
                    $(".toast-body>#message").html(
                        'Tanggal, customer, data barang atau jenis pembayaran belum diisi.');
                }
            }
        });
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