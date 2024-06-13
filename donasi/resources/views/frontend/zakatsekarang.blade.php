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
                    <img src="/assets/img/banner_zakat.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6 offset-md-3">
                <div id="msg" class="text-center"></div>
                <div class="card-box-shadow" style="box-shadow: 0 4px 10px 0 rgb(204, 204, 204);">
                    <input type="hidden" name="transaction_type" class="transaction_type" id="transaction_type"
                        value="Transfer In">
                    <div class="form__row">
                        <label for="" class="form-label">Pilih Kategori Dana</label>
                        <div class="form-nominal mb-1">
                            <select name="danacategory_id" id="danacategory_id"
                                class="form-control mt-1 @error('danacategory_id') is-invalid @enderror">
                                <option value="">:: Pilih ::</option>
                                @foreach ($danacategories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('danacategory_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <span class="minTransaction text-danger"></span>
                    </div>
                    <div class="form__row">
                        <label for="" class="form-label">Pilih Dana</label>
                        <div class="form-nominal mb-1">
                            <select name="dana_id" id="dana_id"
                                class="form-control mt-1 @error('dana_id') is-invalid @enderror">
                                <option value="">:: Pilih ::</option>
                                @foreach ($danas as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dana_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <span class="minTransaction text-danger"></span>
                    </div>
                    <div class="jml_hari" id="jml_hari">

                    </div>
                    <div class="form__row">
                        <label for="" class="form-label">Nominal</label>
                        <div class="form-nominal mb-1">
                            <span class="form-label-rp">Rp</span>
                            <input type="tel" name="gross_amount" id="gross_amount"
                                class="form-input form-input-payment form-input-nominal money valid" required
                                aria-required="true" autocomplete="off" aria-invalid="false" style="background-color: white"
                                onkeyup="strToNum('gross_amount')">
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
        // Filter Dana
        $(document).on('change', '#danacategory_id', function() {
            const id = $(this).val();
            if (id) {
                $.ajax({
                    url: '/api/danacategory/' + id,
                    method: 'get',
                    dataType: 'json',
                    success: function(response) {
                        $('#dana_id').children().remove();
                        $('#dana_id').append($('<option>').val('').text(':: Pilih ::'));
                        for (let i = 0; i < response.length; i++) {
                            const item = response[i];
                            addOption('dana_id', item.id, item.name);
                        }
                    }
                });
            } else {
                $('#dana_id').children().remove();
                $('#dana_id').append($('<option>').val('').text(':: Pilih ::'));
            }
        });

        $(document).on('change', '#dana_id', function() {
            $('#jml_hari').html('');
            $('#gross_amount').val('');
            $('#gross_amount').attr('readonly', false);
            $('#gross_amount').attr('style', 'background-color:white;');
            const id = $(this).val();
            if (id) {
                $.ajax({
                    url: '/api/dana/' + id,
                    method: 'get',
                    dataType: 'json',
                    success: function(response) {
                        if (response.slug == 'fidyah') {
                            $('#jml_hari').append(`
                                <div class="form__row">
                                    <label for="" class="form-label">Jumlah Hari</label>
                                    <div class="form-nominal mb-1">
                                        <select name="hari" id="hari" name="hari" class="form-control">
                                            <option value="">:: Pilih ::</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            </select>
                                    </div>
                                    <span class="minTransaction text-danger"></span>
                                </div>`);
                        }
                    }
                });
            }
        });

        $(document).on('change', '#hari', function() {
            let hari = $(this).val();
            let nominal = hari * 50000;
            $('#gross_amount').val(nominal);
            $('#gross_amount').attr('readonly', '');
            $('#gross_amount').attr('style', 'background-color:rgb(236, 236, 236);');
        });

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
            const danacategory_id = $('#danacategory_id').val();
            const name = $('#name').val();
            const alamat = $('#alamat').val();
            const jml_hari = $('#hari').val();
            const email = $('#email').val();
            const phone = $('#phone').val();
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
                        danacategory_id,
                        name,
                        alamat,
                        email,
                        jml_hari,
                        phone,
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
                        $('#zakat_id').val('');
                        $('#gross_amount').val('');
                        $('#name').val('');
                        $('#alamat').val('');
                        $('#email').val('');
                        $('#phone').val('');
                        $('#is_anonim').val('');
                        $('#description').val('');
                    } else {
                        $('#zakat_id').val('');
                        $('#gross_amount').val('');
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
