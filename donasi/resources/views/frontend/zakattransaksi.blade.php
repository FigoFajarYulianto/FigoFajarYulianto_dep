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
    <section class="home-section home-section--grey">
        <div class="container page-remove-paddingx-on-mobile">
            <div class="col-md-6 offset-md-3">
                <div class="card-box-shadow" style="margin-bottom: 1em; box-shadow: 0 4px 10px 0 rgb(204, 204, 204);">
                    <div class="bg-light text-black p-4 b-radius-4 d-flex align-items-center">
                        <div class="">
                            <div>
                                <span class="h3 text-bold">{{ $dana->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 offset-md-3">
                <div id="msg" class="text-center"></div>
                <div class="card-box-shadow" style="box-shadow: 0 4px 10px 0 rgb(204, 204, 204);">
                    <input type="hidden" name="transaction_type" class="transaction_type" id="transaction_type"
                        value="Transfer In">
                    <input type="hidden" name="slug" id="slug" value="{{ $dana->slug }}">
                    <input type="hidden" name="dana_id" class="dana_id" id="dana_id" value="{{ $dana->id }}">
                    <input type="hidden" name="danacategory_id" class="danacategory_id" id="danacategory_id"
                        value="{{ $dana->danacategory->id }}">
                    <div class="form__row">
                        <label for="" class="form-label">Nominal Zakat</label>
                        <div class="form-nominal mb-1">
                            <span class="form-label-rp">Rp</span>
                            <input type="tel" name="gross_amount" id="gross_amount"
                                class="form-input form-input-payment form-input-nominal money valid"
                                value="{{ $nominal }}" required="" aria-required="true" autocomplete="off"
                                aria-invalid="false">
                        </div>
                        <span class="minTransaction text-danger"></span>
                    </div>
                    <div class="form__row">
                        <input type="text" name="name" id="name"
                            class="form-input form-input-payment mb-1 mt-1 @error('name') is-invalid @enderror"
                            value="" placeholder="Nama Lengkap" required aria-required="true" autocomplete="off"
                            style="color: black">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form__row mt-3">
                        <input type="text" name="alamat" id="alamat"
                            class="form-input form-input-payment mb-1 mt-1 @error('alamat') is-invalid @enderror""
                            value="" placeholder="Alamat" style="color: black">
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form__row mt-3">
                        <input type="email" name="email" id="email" class="form-input form-input-payment mb-1"
                            value="" placeholder="Email (Optional)" autocomplete="off" style="color: black">
                    </div>
                    <div class="form__row mt-3">
                        <input type="tel" name="phone" id="phone"
                            class="form-input form-input-payment mask-numberonly-js mb-1 mt-1 @error('phone') is-invalid @enderror""
                            placeholder="Nomor WA / HP" required aria-required="true" autocomplete="off" maxlength="14"
                            minlength="10" style="color: black">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form__row mt-3">
                        <div class="d-flex justify-content-between">
                            <label for="" class="form-label">Zakat sebagai anonim?</label>
                            <label class="switch mt-2">
                                <input class="form-check-input" type="checkbox" value="false" name="is_anonim"
                                    id="is_anonim">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form__row mt-3">
                        <div class="form-label">Komentar (opsional)</div>
                        <textarea name="description" id="description" cols="8" rows="2"
                            class="form-input form-textarea-payment" placeholder="Tulis komentar" style="color: black"></textarea>
                    </div>
                    <div class="form__row mt-4">
                        <button class="btn-base btn--block btn--primary btn--lg payment" type="submit"
                            onclick="confirm('Yakin ingin melanjutkan?')">Lanjut
                            Pembayaran</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        formatStrNum('harga_beli');
        formatStrNum('gross_amount');

        function enableTextBox(chk, index) {
            if (chk.checked) {
                $('.' + index).hide();
            } else {
                $('.' + index).show();
            }

        }

        $("#is_anonim").on('change', function() {
            if ($(this).is(':checked')) {
                $(this).attr('value', 'true');
            } else {
                $(this).attr('value', 'false');
            }
        });

        // PAYMENT GATEWAY
        $(document).on('click', '.payment', function() {
            const gross_amount = $('#gross_amount').val() ? $('#gross_amount').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;
            const dana_id = $('#dana_id').val();
            const name = $('#name').val();
            const alamat = $('#alamat').val();
            const email = $('#email').val();
            const phone = $('#phone').val();
            const slug = $('#slug').val();
            const is_anonim = $('#is_anonim').val() == 'false' ? 0 : 1;
            const description = $('#description').val();
            const transaction_type = $('#transaction_type').val();
            if (parseFloat(gross_amount) > 0) {
                $.ajax({
                    url: '/zakat/transaksi',
                    method: 'post',
                    data: {
                        gross_amount,
                        dana_id,
                        name,
                        alamat,
                        email,
                        phone,
                        slug,
                        is_anonim,
                        description,
                        transaction_type,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            snap.pay(response.data.snap_token, {
                                onSuccess: function(result) {
                                    updatezakatItem(response.data.id, result);
                                    $('#msg').append(`
                                        <div class="alert small alert-success alert-dismissible fade show" role="alert">Terimakasih Anda Telah Berzakat.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                                    `);
                                },
                                onPending: function(result) {
                                    updatezakatItem(response.data.id, result);
                                },
                                onError: function(result) {
                                    updatezakatItem(response.data.id, result);
                                }
                            });
                        }
                    }
                });
            } else {
                alert('Nominal Zakat harus diisi.')
            }
        });

        function updatezakatItem(id, result) {
            const transaction_status_time = result.transaction_time;
            const transaction_status = result.transaction_status;
            $.ajax({
                url: '/zakat/transaksi/' + id,
                method: 'PUT',
                data: {
                    transaction_status_time,
                    transaction_status,
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status) {
                        $('#name').val('');
                        $('#alamat').val('');
                        $('#email').val('');
                        $('#phone').val('');
                        $('#is_anonim').val('');
                        $('#description').val('');
                    } else {
                        $('#name').val('');
                        $('#alamat').val('');
                        $('#email').val('');
                        $('#phone').val('');
                        $('#is_anonim').val('');
                        $('#description').val('');
                    }
                }
            });
        }
    </script>
@endsection
