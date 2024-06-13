<?php
$setting = \App\Models\Setting::where('id', 1)->first();
$id_order = \App\Models\Order::latest()->first()->id;
$user = auth()->user();
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
</head>

<body>

    <style>
        .number-order {
            position: absolute;
            top: 30px;
            right: 0px;
            width: 130px;
            display: inline-block;
            text-align: center;
            line-height: 24px;
            border-radius: 3px;
        }

        @media only screen and (max-width: 1024px) {
            .number-order {
                position: absolute;
                top: 30px;
                right: -30px;
                width: 130px;
                display: inline-block;
                text-align: center;
                line-height: 24px;
                border-radius: 3px;
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
            <div class="row justify-content-center">
                <center>
                    <div class="col-lg-12">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="heading-tabs">
                                    <div class="row">
                                        <div class="col-lg-6 offset-lg-3">
                                            <ul>
                                                <form action="{{ route('search') }}" method="GET">
                                                    <select class="form-control-search mt-1 @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                                        <option value="">:: Pilih Katagori Menu ::</option>
                                                        <?php $categotys = \App\Models\Category::orderBy('nama', 'ASC')->get(); ?>
                                                        @foreach ($categotys as $item)
                                                        <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                                            {{ $item->nama }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <input style="background-color:#ff6600; color:white; margin-top:20px;" type="submit" value="Cari" class="btn">
                                                </form>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <section class='tabs-content'>
                                    <article>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="left-list" id="menus" data-totalmenu="{{ $menus->count() }}">
                                                        @foreach ($menus as $i => $row)
                                                        <div class="col-lg-12">
                                                            <div class="tab-item">
                                                                <img src="/storage/{{ $row->photo }}" alt="">
                                                                <h4 class="my-0 pt-0">{{ $row->nama }}</h4>
                                                                <span class="small my-0"><i class="fas fa-tags fa-sm text-muted mr-1"></i>
                                                                    {{ $row->category->nama }}</span>
                                                                <p class="my-0">
                                                                    <strong>Rp @currency($row->harga)</strong> &nbsp;
                                                                    @if ($row->diskon)
                                                                    <span class="small"><del>Rp
                                                                            @currency($row->diskon)</del></span>
                                                                    @endif
                                                                </p>
                                                                <div class="number-order input-group">
                                                                    <span class="input-group-btn">
                                                                        <input type="button" class="btn-number button-minus" data-type="minus" data-field="qty{{ $i }}" value="-">
                                                                    </span>
                                                                    <input type="number" name="qty{{ $i }}" id="qty{{ $i }}" class="input-number quantity-field" value="0" min="0" data-id="{{ $row->id }}" data-menu="{{ $row->nama }}" data-harga="{{ $row->harga }}">
                                                                    <span class="input-group-btn">
                                                                        <input type="button" class="btn-number button-plus" data-type="plus" data-field="qty{{ $i }}" value="+">
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </section>
                            </div>
                        </div>
                    </div>
                </center>
            </div>
        </div>

    </section>

    <a href="javascript:void(0)" data-toggle="modal" data-target="#orderModal" id="fakturShow" onclick="createInv()" class="float text-white shadow-lg">
        <span style="font-weight: bold;" id="totalcart">0</span>
        <i class="fas fa-shopping-cart my-float"></i>
    </a>

    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Pesanan Anda</h5>
                    <button type="button" class="close btnReloadQty" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="tanggal" id="tanggal" class="form-control mt-1" value="{{ date('Y-m-d') }}">
                            <div class=" form-group mb-3 div_faktur">
                                <label for="faktur">Faktur <a href="javascript:void(0)" class="text-dark refaktur"><i class="fas fa-sync-alt ms-1"></i></a></label>
                                <input readonly type="text" name="faktur" id="faktur" class="form-control mt-1">
                                @error('faktur')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control mt-1 @error('nama') is-invalid @enderror">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="whatsapp">No. Whatsapp</label>
                                <input type="number" name="whatsapp" id="whatsapp" class="form-control mt-1 @error('whatsapp') is-invalid @enderror">
                                @error('meja')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="meja">Nomor Meja</label>
                                <input type="number" name="meja" id="meja" class="form-control mt-1 @error('meja') is-invalid @enderror">
                                @error('meja')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <h5 class="mt-3">Daftar Pesanan</h5>
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Pesanan</th>
                                    <th style="text-align: center;">Quantity</th>
                                    <th style="text-align: center;">Harga</th>
                                    <th style="text-align: center;">Subtotal</th>
                                    <th style="text-align: center;">Hapus</th>
                                </tr>
                            </thead>
                            <tbody id="cartListOrder">
                            </tbody>
                        </table>
                        @if (auth()->user()->level_id ?? '')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="bayar">Bayar</label>
                                    <input type="text" name="bayar" id="bayar" class="form-control mt-1 @error('bayar') is-invalid @enderror" onkeyup="strToNum('bayar')">
                                    @error('bayar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kembalian">Kembalian</label>
                                    <input readonly type="text" name="kembalian" id="kembalian" class="form-control mt-1 @error('kembalian') is-invalid @enderror">
                                    @error('kembalian')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Catatan (Opsional)</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btnReloadQty" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary checkout">Checkout</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert -->
    @include('sweetalert::alert')

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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
    <!-- <script src="/fronts/assets/js/custom.js"></script> -->
    <!-- Tambahan -->
    <script src="/admin/dashboard/js/custom.js"></script>
    <script src="/admin2/js/scripts.js"></script>
    <script src="https://unpkg.com/cart-localstorage@1.1.4/dist/cart-localstorage.min.js" type="text/javascript"></script>
    <script>
        getCart();
        const menus = $('#menus').data('totalmenu');

        for (let i = 0; i < parseInt(menus); i++) {
            const idmenu = $('#qty' + i).data('id');
            const cart = cartLS.get(idmenu);
            if (cart) {
                $('#qty' + i).val(cart.quantity);
            }

            $(document).on('change', '#qty' + i, function() {
                const id = parseInt($(this).data('id'));
                const name = $(this).data('menu');
                const price = parseInt($(this).data('harga'));
                const qty = parseInt($(this).val());
                if (qty > 0) {
                    if (cartLS.get(id)) {
                        cartLS.update(id, 'quantity', qty);
                    } else {
                        cartLS.add({
                            id: id,
                            name: name,
                            price: price
                        }, qty);
                    }
                } else {
                    cartLS.remove(id);
                }
                getCart();
            });
        }

        $('.btnReloadQty').on('click', function() {
            for (let i = 0; i < parseInt(menus); i++) {
                const idmenu = $('#qty' + i).data('id');
                const cart = cartLS.get(idmenu);
                if (cart) {
                    $('#qty' + i).val(cart.quantity);
                } else {
                    $('#qty' + i).val(0);
                }
            }
        })

        $(document).on('click', '.removeItem', function() {
            r = confirm('Yakin ingin melanjutkan?');
            if (r == true) {
                const id = $(this).data('id');
                if (cartLS.exists(id)) {
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
            $('#cartListOrder').html('');
            if (carts.length > 0) {
                for (let i = 0; i < carts.length; i++) {
                    const cart = carts[i];
                    const subtotal = cart.price * cart.quantity;

                    $('#cartListOrder').append(`
                        <tr>
                            <td align="center">` + (parseInt(i) + 1) + `</td>
                            <td>` + cart.name + `</td>
                            <td align="center">` + cart.quantity + `</td>
                            <td align="right">` + formatRupiah(cart.price) + `</td>
                            <td align="right">` + formatRupiah(subtotal) +
                        `</td>
                            <td align="center"><button class="btn btn-danger btn-sm removeItem" type="button" data-id="` +
                        cart.id + `"><i class="fas fa-sm fa-trash fa-sm"></i></button></td>
                        </tr>
                    `);
                }

                $('#cartListOrder').append(`
                    <tr style="font-weight:bold;">
                        <td colspan="4">
                            <input type="hidden" id="grandtotal" value="` + cartLS.total() + `">
                            Grand Total
                        </td>
                        <td align="right">` + formatRupiah(cartLS.total()) + `</td>
                        <td></td>
                    </tr>
                `);

            }

        }


        $(document).on('keyup', '#bayar', function() {
            getCart();
            const carts = cartLS.list();

            if (carts.length > 0) {
                for (let i = 0; i < carts.length; i++) {
                    const cart = carts[i];
                    const subtotal = cart.price * cart.quantity;
                    const total_bayar = $('#total_bayar').val() ? parseFloat($('#total_bayar').val().replace('.', '')) : 0;
                    const bayar = $(this).val() ? parseFloat($(this).val().replace('.', '')) : 0;
                    const kembalian = bayar - subtotal;
                    $('#kembalian').val(formatRupiah(kembalian));


                }



            }

        });

        function formatNumberField() {
            formatStrNum('bayar');
            formatStrNum('total_bayar');
        }

        function formatRupiah(angka) {
            if (angka) {
                var number_string = angka.toString().match(/[0-9,]+/g).join([]).toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                if (parseInt(angka) < 0) {
                    return '-' + rupiah;
                } else {
                    return rupiah;
                }
            } else {
                return '';
            }
        }

        // js input
        $('.btn-number').click(function(e) {
            e.preventDefault();
            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > 0) {
                        input.val(currentVal - 1).change();
                    }
                } else if (type == 'plus') {
                    input.val(currentVal + 1).change();
                }
            } else {
                input.val(0);
            }
        });

        $('.input-number').focusin(function() {
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').change(function() {
            valueCurrent = parseInt($(this).val());
            name = $(this).attr('name');
            if (valueCurrent >= 0) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
        });

        $(".input-number").keydown(function(e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

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
                            var id_order = '<?php echo $id_order; ?>';
                            const id_order_tambah = parseInt(id_order) + 1;
                            if (response.status) {
                                cartLS.destroy();
                                $("#toastAlert").toast({
                                    delay: 3000
                                });
                                $("#toastAlert").toast('show');
                                $("#infoToast").html('Oops!');
                                $(".toast-body>#message").html(response.msg);
                                window.open('/detail/orders/' + id_order_tambah + '/detail');
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

        $('.hide').hide();
    </script>
</body>

</html>