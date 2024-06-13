@extends('dashboard.template')
@section('content')
    <?php
    $user = auth()->user();
    ?>


    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card shadow">
                <div class="card-body">
                    <a href="/dashboard/orderitems" class="me-2"><i class="fa fa-arrow-circle-left"></i></a>
                    <h4 class="card-title">Tambah Order Item</h4>
                    <form class="form-sample" action="/dashboard/orderitems/create" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="order_id">Order_id</label>
                                    <input type="number" name="order_id" id="order_id" class="form-control"
                                        value="{{ old('order_id') }}">
                                    @error('order_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="menu_id">Id Menu</label>
                                    <select class="form-control mt-1 @error('menu_id') is-invalid @enderror" name="menu_id"
                                        id="menu_id">
                                        <option value="">:: Pilih ::</option>
                                        @foreach ($menus as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('menu_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('menu_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="qty">Qty</label>
                            <input class="form-control mt-1 @error('qty') is-invalid @enderror" name="qty"
                                type="text" id="qty" value="{{ old('qty') }}" onkeyup="strToNum('qty')" />
                            @error('qty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga">Harga</label>
                            <input class="form-control mt-1 @error('harga') is-invalid @enderror" name="harga"
                                type="text" id="harga" value="{{ old('harga') }}" onkeyup="strToNum('harga')" />
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="diskon">Diskon</label>
                            <input class="form-control mt-1 @error('diskon') is-invalid @enderror" name="diskon"
                                type="text" id="diskon" value="{{ old('diskon') }}" onkeyup="strToNum('diskon')" />
                            @error('diskon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror " name="keterangan" id="keterangan"
                                rows="5"></textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    {{--  @section('script')
    <script>
        cartLS.destroy();
        cartPembelian();
        formatNumberField();
        formatStrNum('berat');
        $('.bank').hide();
        $('.bankTagihan').hide();

        $('#jenis_id').on('change', function() {
            const id = $(this).val();
            $('#berat').val('');
            if (id == 1) {
                $('#berat').attr('disabled', true);
            } else {
                $('#berat').attr('disabled', false);
            }
        });

        $('.insertConversion').on('click ', function() {
            if ($('#konversi_barang_id').val()) {
                $.ajax({
                    url: '/api/conversions',
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        barang_id: $('#konversi_barang_id').val(),
                        satuan_dari: $('#konversi_satuan_dari').val(),
                        satuan_ke: $('#konversi_satuan_ke').val(),
                        nilai: $('#konversi_nilai').val()
                    },
                    dataType: 'json',
                    error: function(err) {
                        $('#conversionModal').modal('hide');
                        $("#toastAlert").toast({
                            delay: 3000
                        });
                        $("#toastAlert").toast('show');
                        $("#infoToast").html('Oops!');
                        $(".toast-body>#message").html('Gagal / data sudah tersedia.');
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#conversionModal').modal('hide');
                            $("#toastAlert").toast({
                                delay: 3000
                            });
                            $("#toastAlert").toast('show');
                            $("#infoToast").html('Berhasil!');
                            $(".toast-body>#message").html('Data berhasil disimpan.');
                        } else {
                            $("#toastAlert").toast({
                                delay: 3000
                            });
                            $("#toastAlert").toast('show');
                            $("#infoToast").html('Oops!');
                            $(".toast-body>#message").html('Data gagal disimpan.');
                        }
                    }
                });
            } else {
                $("#toastAlert").toast({
                    delay: 3000
                });
                $("#toastAlert").toast('show');
                $("#infoToast").html('Oops!');
                $(".toast-body>#message").html('Barang harus diisi.');
            }
        });

        $('.insertSuplier').on('click ', function() {
            if ($('#namaSuplier').val()) {
                $.ajax({
                    url: '/api/supliers',
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        nama: $('#namaSuplier').val(),
                        alamat: $('#alamat').val(),
                        telp: $('#telp').val()
                    },
                    dataType: 'json',
                    error: function(err) {
                        getSupliers();
                        $("#toastAlert").toast({
                            delay: 3000
                        });
                        $("#toastAlert").toast('show');
                        $("#infoToast").html('Oops!');
                        $(".toast-body>#message").html('Gagal / data sudah tersedia.');
                    },
                    success: function(response) {
                        if (response.status) {
                            getSupliers();
                        } else {
                            $("#toastAlert").toast({
                                delay: 3000
                            });
                            $("#toastAlert").toast('show');
                            $("#infoToast").html('Oops!');
                            $(".toast-body>#message").html('Data gagal disimpan.');
                        }
                    }
                });
            } else {
                $("#toastAlert").toast({
                    delay: 3000
                });
                $("#toastAlert").toast('show');
                $("#infoToast").html('Oops!');
                $(".toast-body>#message").html('Nama suplier harus diisi.');
            }
        });

        function getSupliers() {
            $('#suplierModal').modal('hide');
            $.ajax({
                url: '/api/supliers',
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#suplier_id').children().remove();
                    addOption('suplier_id', '', ':: Pilih ::');
                    for (let i = 0; i < response.length; i++) {
                        const suplier = response[i];
                        addOption('suplier_id', suplier.id, suplier.nama);
                    }
                    $('#suplier_id').selectpicker('refresh');
                }
            });
        }

        $('.insertBarang').on('click ', function() {
            if ($('#namaBarang').val()) {
                $.ajax({
                    url: '/api/barangs',
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        isPPN: $('#isPPNBarang').val(),
                        nama: $('#namaBarang').val(),
                        nama_pasaran: $('#namaBarangPasaran').val(),
                        category_id: $('#category_id').val(),
                        satuan_banyak_id: $('#satuan_banyak_id').val(),
                        satuan_berat_id: $('#satuan_berat_id').val(),
                        berat: $('#berat').val(),
                        rak_id: $('#rak_id').val(),
                        harga_beli: $('#harga_beli_brg').val(),
                        harga_jual: $('#harga_jual_brg').val(),
                        ppn_keluaran: $('#ppn_keluaran_brg').val(),
                        harga_jual_min: $('#harga_jual_min_brg').val(),
                        harga_jual_max: $('#harga_jual_max_brg').val(),
                    },
                    dataType: 'json',
                    error: function(err) {
                        getBarangs();
                        $("#toastAlert").toast({
                            delay: 3000
                        });
                        $("#toastAlert").toast('show');
                        $("#infoToast").html('Oops!');
                        $(".toast-body>#message").html('Gagal / data sudah tersedia.');
                    },
                    success: function(response) {
                        if (response.status) {
                            getBarangs();
                        } else {
                            $("#toastAlert").toast({
                                delay: 3000
                            });
                            $("#toastAlert").toast('show');
                            $("#infoToast").html('Oops!');
                            $(".toast-body>#message").html('Data gagal disimpan.');
                        }
                    }
                });
            } else {
                $("#toastAlert").toast({
                    delay: 3000
                });
                $("#toastAlert").toast('show');
                $("#infoToast").html('Oops!');
                $(".toast-body>#message").html('Nama barang harus diisi.');
            }
        });

        function getBarangs() {
            $('#barangModal').modal('hide');
            $.ajax({
                url: '/api/barangs',
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#barang_id').children().remove();
                    addOption('barang_id', '', ':: Pilih ::');
                    for (let i = 0; i < response.length; i++) {
                        const barang = response[i];
                        addOption('barang_id', barang.id, barang.kode_barang + ' - ' + barang.nama);
                    }
                    $('#barang_id').selectpicker('refresh');
                }
            });
        }

        $('.refaktur').on('click', function() {
            location.reload();
        });

        if ($('#jenis_faktur').val()) {
            if ($('#jenis_faktur').val() == 1) {
                createInv()
                $('.div_faktur1').show();
                $('.div_faktur2').hide();
                $('#faktur2').val('');
            } else {
                $('.div_faktur1').hide();
                $('.div_faktur2').show();
            }
        }

        $(document).on('change', '#jenis_faktur', function() {
            const id = $(this).val();
            if (id == 1) {
                createInv()
                $('.div_faktur1').show();
                $('.div_faktur2').hide();
                $('#faktur2').val('');
            } else {
                $('.div_faktur1').hide();
                $('.div_faktur2').show();
            }
        });

        $(document).on('change', '#barang_id', function() {
            const id = $(this).val();
            $.ajax({
                url: '/api/barangs/' + id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    const satuan = response.satuan_banyak ? ' / ' + response.satuan_banyak.nama : '';
                    const berat = response.berat ? ' / ' + response.berat + ' KG' : '';
                    $('#nama_barang').html(response.nama);
                    $('#kategori_barang').html(response.category ? response.category.nama : '');
                    $('#satuan_barang').html(satuan + berat);
                    $('#harga_beli').val(formatRupiah(response.hpp));
                    $('#harga_jual').val(formatRupiah(response.jual));
                    $('#ppn_keluaran').val(formatRupiah(response.ppn));
                    $('#harga_jual_ppn').val(formatRupiah(response.jual_ppn));
                    $("#konversi_barang_id").val(response.id).change();
                    $("#konversi_satuan_dari").val(response.satuan_id).change();
                }
            });
        });

        $(document).on('keyup', '#harga_beli', function() {
            const qty = $('#qty').val() ? $('#qty').val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const harga_beli = $(this).val() ? $(this).val().replace(/[^0-9,]/g, '').replace(',',
                '.') : 0;
            const harga_jual = $('#harga_jual').val() ? $('#harga_jual').val().replace(/[^0-9,]/g, '').replace(',',
                '.') : 0;
            const diskon = $('#diskon').val() ? $('#diskon').val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const total = (parseFloat(harga_beli) * parseFloat(qty)) - parseFloat(diskon);
            const profit = ((parseFloat(harga_jual) - parseFloat(harga_beli)) * parseFloat(qty)) + parseFloat(
                diskon);
            $('#total').val(formatRupiah(total));
            $('#profit').val(formatRupiah(profit));
        });

        $(document).on('keyup', '#harga_beli', function() {
            const qty = $('#qty').val() ? $('#qty').val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const harga_beli = $(this).val() ? $(this).val().replace(/[^0-9,]/g, '').replace(',',
                '.') : 0;
            const harga_jual = $('#harga_jual').val() ? $('#harga_jual').val().replace(/[^0-9,]/g, '').replace(',',
                '.') : 0;
            const diskon = $('#diskon').val() ? $('#diskon').val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const total = (parseFloat(harga_beli) * parseFloat(qty)) - parseFloat(diskon);
            const profit = ((parseFloat(harga_jual) - parseFloat(harga_beli)) * parseFloat(qty)) + parseFloat(
                diskon);
            $('#total').val(formatRupiah(total));
            $('#profit').val(formatRupiah(profit));
        });

        $(document).on('keyup', '#harga_jual', function() {
            const qty = $('#qty').val() ? $('#qty').val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const harga_beli = $('#harga_beli').val() ? $('#harga_beli').val().replace(/[^0-9,]/g, '').replace(',',
                '.') : 0;
            const harga_jual = $(this).val() ? $(this).val().replace(/[^0-9,]/g, '').replace(',',
                '.') : 0;
            const diskon = $('#diskon').val() ? $('#diskon').val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const total = (parseFloat(harga_beli) * parseFloat(qty)) - parseFloat(diskon);
            const profit = ((parseFloat(harga_jual) - parseFloat(harga_beli)) * parseFloat(qty)) + parseFloat(
                diskon);
            $('#total').val(formatRupiah(total));
            $('#profit').val(formatRupiah(profit));
        });

        $(document).on('keyup', '#qty', function() {
            const qty = $(this).val() ? $(this).val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const harga_beli = $('#harga_beli').val() ? $('#harga_beli').val().replace(/[^0-9,]/g, '').replace(',',
                '.') : 0;
            const harga_jual = $('#harga_jual').val() ? $('#harga_jual').val().replace(/[^0-9,]/g, '').replace(',',
                '.') : 0;
            const diskon = $('#diskon').val() ? $('#diskon').val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const total = (parseFloat(harga_beli) * parseFloat(qty)) - parseFloat(diskon);
            const profit = ((parseFloat(harga_jual) - parseFloat(harga_beli)) * parseFloat(qty)) + parseFloat(
                diskon);
            $('#total').val(formatRupiah(total));
            $('#profit').val(formatRupiah(profit));
        });

        $(document).on('keyup', '#diskon', function() {
            const qty = $('#qty').val() ? $('#qty').val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const harga_beli = $('#harga_beli').val() ? $('#harga_beli').val().replace(/[^0-9,]/g, '').replace(',',
                '.') : 0;
            const harga_jual = $('#harga_jual').val() ? $('#harga_jual').val().replace(/[^0-9,]/g, '').replace(',',
                '.') : 0;
            const diskon = $(this).val() ? $(this).val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const total = (parseFloat(harga_beli) * parseFloat(qty)) - parseFloat(diskon);
            const profit = ((parseFloat(harga_jual) - parseFloat(harga_beli)) * parseFloat(qty)) + parseFloat(
                diskon);
            $('#total').val(formatRupiah(total));
            $('#profit').val(formatRupiah(profit));
        });

        if ($('#ongkir').val()) {
            $('#bayar').attr('disabled', false);
            $('#jenis_pembayaran').attr('disabled', false);
            $('#bank_id').attr('disabled', false);
            $('#keterangan_pembayaran').attr('disabled', false);
        } else {
            $('#bayar').attr('disabled', true);
            $('#jenis_pembayaran').attr('disabled', true);
            $('#bank_id').attr('disabled', true);
            $('#keterangan_pembayaran').attr('disabled', true);
        }

        $(document).on('keyup', '#ongkir', function() {
            const ongkir = $(this).val() ? $(this).val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const grandtotalwithdiskon = $('#grandtotalwithdiskon').val() ? $('#grandtotalwithdiskon').val()
                .replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const ppn = 0
            const diskon_lain = $('#diskon_lain').val() ? $('#diskon_lain').val().replace(/[^0-9,]/g, '').replace(
                ',', '.') : 0;
            const totalTagihan = parseFloat(grandtotalwithdiskon) + parseFloat(ppn) - parseFloat(diskon_lain);
            const totalsemua = parseFloat(grandtotalwithdiskon) + parseFloat(ongkir) + parseFloat(ppn) - parseFloat(
                diskon_lain);
            $('#totalongkir').val(formatRupiah(ongkir));
            $('#totalsemua').val(formatRupiah(totalsemua));
            $('#totalTagihan').val(formatRupiah(totalTagihan));

            if (parseFloat(ongkir) > 0) {
                $('#bayar').attr('disabled', false);
                $('#jenis_pembayaran').attr('disabled', false);
                $('#bank_id').attr('disabled', false);
                $('#keterangan_pembayaran').attr('disabled', false);
            } else {
                $('#bayar').attr('disabled', true);
                $('#jenis_pembayaran').attr('disabled', true);
                $('#bank_id').attr('disabled', true);
                $('#keterangan_pembayaran').attr('disabled', true);
            }
        });

        // if ($('#ppn_masukan').val()) {
        //     const ongkir = $('#ongkir').val() ? $('#ongkir').val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
        //     const grandtotalwithdiskon = $('#grandtotalwithdiskon').val() ? $('#grandtotalwithdiskon').val()
        //         .replace(/[^0-9,]/g, '').replace(',', '.') : 0;
        //     const ppn = $('#ppn_masukan').val().replace(/[^0-9,]/g, '').replace(',', '.');
        //     const diskon_lain = $('#diskon_lain').val() ? $('#diskon_lain').val().replace(/[^0-9,]/g, '').replace(
        //         ',', '.') : 0;
        //     const totalTagihan = parseFloat(grandtotalwithdiskon) + parseFloat(ppn) - parseFloat(diskon_lain);
        //     const totalsemua = parseFloat(grandtotalwithdiskon) + parseFloat(ongkir) + parseFloat(ppn) - parseFloat(
        //         diskon_lain);
        //     $('#totalsemua').val(formatRupiah(totalsemua));
        //     $('#totalTagihan').val(formatRupiah(totalTagihan));
        // }

        // $(document).on('keyup', '#ppn_masukan', function() {
        //     const ongkir = $('#ongkir').val() ? $('#ongkir').val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
        //     const grandtotalwithdiskon = $('#grandtotalwithdiskon').val() ? $('#grandtotalwithdiskon').val()
        //         .replace(/[^0-9,]/g, '').replace(',', '.') : 0;
        //     const ppn = $(this).val() ? $(this).val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
        //     const diskon_lain = $('#diskon_lain').val() ? $('#diskon_lain').val().replace(/[^0-9,]/g, '').replace(
        //         ',', '.') : 0;
        //     const totalTagihan = parseFloat(grandtotalwithdiskon) + parseFloat(ppn) - parseFloat(diskon_lain);
        //     const totalsemua = parseFloat(grandtotalwithdiskon) + parseFloat(ongkir) + parseFloat(ppn) - parseFloat(
        //         diskon_lain);
        //     $('#totalsemua').val(formatRupiah(totalsemua));
        //     $('#totalTagihan').val(formatRupiah(totalTagihan));
        // });

        $(document).on('keyup', '#diskon_lain', function() {
            const ongkir = $('#ongkir').val() ? $('#ongkir').val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const grandtotalwithdiskon = $('#grandtotalwithdiskon').val() ? $('#grandtotalwithdiskon').val()
                .replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const diskon_lain = $(this).val() ? $(this).val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const ppn = 0
            const totalTagihan = parseFloat(grandtotalwithdiskon) + parseFloat(ppn) - parseFloat(diskon_lain);
            const totalsemua = parseFloat(grandtotalwithdiskon) + parseFloat(ongkir) + parseFloat(ppn) - parseFloat(
                diskon_lain);
            $('#totalsemua').val(formatRupiah(totalsemua));
            $('#totalTagihan').val(formatRupiah(totalTagihan));
        });

        $(document).on('keyup', '#bayar', function() {
            const ongkir = $('#ongkir').val() ? $('#ongkir').val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            const bayar = $(this).val() ? $(this).val().replace(/[^0-9,]/g, '').replace(',', '.') : 0;
            if (parseFloat(bayar) > parseFloat(ongkir)) {
                $(this).val(formatRupiah(ongkir));
            }
        });

        $(document).on('change', '#jenis_pembayaran', function() {
            const id = $(this).val();
            if (id == 1 || id == '') {
                $('.bank').hide();
            } else {
                $('.bank').show();
            }
        });

        $(document).on('change', '#jenis_pembayaranTagihan', function() {
            const id = $(this).val();
            if (id == 1 || id == '') {
                $('.bankTagihan').hide();
            } else {
                $('.bankTagihan').show();
            }
        });

        $(document).on('change', '#suplier_id', function() {
            const id = $(this).val();
            $.ajax({
                url: '/api/supliers/' + id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    const alamat = response.alamat ? `, ` +
                        response.alamat : '';
                    const telp = response.telp ? `, ` +
                        response.telp : ``;
                    $('#info_suplier').html(response.nama +
                        alamat + telp);
                }
            });
        });

        $(document).on('click', '.addPembelian', function() {
            const barang_id = $('#barang_id').val();
            if (barang_id) {
                $.ajax({
                    url: '/api/barangs/' + barang_id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        const qty = $('#qty').val() ? $('#qty').val().replace(/[^0-9,]/g, '')
                            .replace(',', '.') : 0;
                        const harga_beli = $('#harga_beli').val() ? $('#harga_beli').val().replace(
                            /[^0-9,]/g, '').replace(',', '.') : 0;
                        const harga_jual = $('#harga_jual').val() ? $('#harga_jual').val().replace(
                            /[^0-9,]/g, '').replace(',', '.') : 0;
                        const ppn_keluaran = $('#ppn_keluaran').val() ? $('#ppn_keluaran').val()
                            .replace(
                                /[^0-9,]/g, '').replace(',', '.') : 0;
                        const harga_jual_ppn = $('#harga_jual_ppn').val() ? $('#harga_jual_ppn').val()
                            .replace(
                                /[^0-9,]/g, '').replace(',', '.') : 0;
                        const diskon = $('#diskon').val() ? $('#diskon').val().replace(/[^0-9,]/g, '')
                            .replace(',', '.') : 0;

                        const dataBrg = {
                            id: response.id,
                            name: response.nama,
                            price: parseFloat(harga_beli) === 0 ? 112233 : parseFloat(
                                harga_beli),
                            harga_jual: parseFloat(harga_jual),
                            ppn_keluaran: parseFloat(ppn_keluaran),
                            harga_jual_ppn: parseFloat(harga_jual_ppn),
                            diskon: parseFloat(diskon),
                            isPPN: response.isPPN
                        };
                        cartLS.add(dataBrg, parseFloat(qty));

                        $('#barang_id').selectpicker('val', '');
                        // $("#barang_id option").prop("selected", false);
                        $('#nama_barang').html('');
                        $('#kategori_barang').html('');
                        $('#satuan_barang').html('');
                        $('#qty').val('');
                        $('#harga_beli').val('');
                        $('#harga_jual').val('');
                        $('#ppn_keluaran').val('');
                        $('#harga_jual_ppn').val('');
                        $('#diskon').val('');
                        $('#total').val('');
                        $('#profit').val('');
                        cartPembelian();
                    }
                });
            } else {
                $("#toastAlert").toast({
                    delay: 3000
                });
                $("#toastAlert").toast('show');
                $("#infoToast").html('Oops!');
                $(".toast-body>#message").html('Barang, qty, harga beli dan harga jual harus diisi.');
            }
        });

        function createInv() {
            if ($('#tanggal').val()) {
                $.ajax({
                    url: "/api/pembelians/createinv?tanggal=" + $('#tanggal').val(),
                    method: 'get',
                    dataType: 'json',
                    success: function(response) {
                        $('#faktur1').val(response.number);
                    }
                });
            }

            $(document).on('change', '#tanggal', function() {
                $.ajax({
                    url: '/api/pembelians/createinv?tanggal=' + $(this).val(),
                    method: 'get',
                    dataType: 'json',
                    success: function(response) {
                        $('#faktur1').val(response.number);
                    }
                });
            });
        }

        function cartPembelian() {
            $('#ppn_masukan').attr('disabled', true);
            $('#ongkir').attr('disabled', true);
            $('#diskon_lain').attr('disabled', true);
            $('#bayar').attr('disabled', true);
            $('#jenis_pembayaran').attr('disabled', true);
            $('#bank_id').attr('disabled', true);
            $('#tempo').attr('disabled', true);
            $('#keterangan_pembayaran').attr('disabled', true);
            $('.btnInsertPembelian').attr('disabled', true);

            const cartList = cartLS.list();
            if (cartList.length > 0) {
                $('#ppn_masukan').attr('disabled', false);
                $('#diskon_lain').attr('disabled', false);
                $('#ongkir').attr('disabled', false);
                $('#tempo').attr('disabled', false);
                $('.btnInsertPembelian').attr('disabled', false);

                $('#cartListPembelian').html('');

                let grandtotalwithoutdiskon = 0;
                let grandtotalwithdiskon = 0;
                let grandtotalwithPPN = 0;
                let grandtotalPPNMasukan = 0;
                let totaldiskon = 0;
                let totalprofit = 0;
                for (var i = 0; i < cartList.length; i++) {
                    const qty = cartList[i].quantity;
                    let harga_beli = 0;
                    if (cartList[i].price === 112233) {
                        harga_beli = 0;
                    } else {
                        harga_beli = cartList[i].price;
                    }
                    const harga_jual = cartList[i].harga_jual;
                    const ppn_keluaran = cartList[i].ppn_keluaran;
                    const harga_jual_ppn = cartList[i].harga_jual_ppn;
                    const diskon = cartList[i].diskon;
                    const subtotal = (qty * harga_beli);
                    const grandtotal = (qty * harga_beli) - diskon;
                    const profit = ((harga_jual - harga_beli) * qty) + diskon;

                    const hrg_beli = (harga_beli !== 112233 ? formatRupiah(harga_beli
                        .toString()
                        .replace('.', ',')) : 0);

                    let dpp = 0;
                    let ppn_masukan_item = 0;
                    if (cartList[i].isPPN == 1) {
                        dpp = (harga_beli / 1.11);
                        ppn_masukan_item = harga_beli > 0 ? (harga_beli - dpp) : 0;
                    } else {
                        dpp = 0;
                        ppn_masukan_item = 0;
                    }
                    // const ppn_masukan_item = cartList[i].isPPN == 1 && hrg_beli > 0 ? ((harga_beli * 11 / 100) * qty) : 0;

                    grandtotalwithoutdiskon += subtotal;
                    grandtotalwithdiskon += grandtotal;
                    grandtotalPPNMasukan += ppn_masukan_item * cartList[i].quantity;
                    totaldiskon += diskon;
                    totalprofit += profit;

                    $('#cartListPembelian').append(`
                        <tr>
                            <td class="py-2" style="vertical-align:middle;">` + (parseInt(i) + 1) + `</td>
                            <td class="py-2" style="vertical-align:middle;">` + cartList[i].name +
                        `</td>
                            <td class="py-2" style="vertical-align:middle;" align="center"><a href="javascript:void(0)" class="text-dark qtyCart" data-id="` +
                        cartList[i].id + `" data-qtybefore="` + cartList[i].quantity + `" data-namabarang="` + cartList[
                            i].name +
                        `" data-bs-toggle="modal" data-bs-target="#qtyCartModal">` +
                        formatRupiah(qty
                            .toString().replace(
                                '.', ',')) + `</a></td>
                            <td class="py-2" style="vertical-align:middle;" align="right">` + formatRupiah(dpp.toFixed(
                            0)) + `</td>
                            <td class="py-2" style="vertical-align:middle;" align="right">` + formatRupiah(
                            ppn_masukan_item.toFixed(0).toString().replace('.', ',')) + `</td>
                            <td class="py-2" style="vertical-align:middle;" align="right">` + formatRupiah(
                            harga_beli) + `</td>
                            <td class="py-2" style="vertical-align:middle;" align="right">` + formatRupiah(harga_jual
                            .toString()
                            .replace('.',
                                ',')) + `</td>
                            <td class="py-2" style="vertical-align:middle;" align="right">` + formatRupiah(diskon
                            .toString().replace(
                                '.',
                                ',')) + `</td>
                            <td class="py-2" style="vertical-align:middle;" align="right">` + formatRupiah(grandtotal
                            .toString()
                            .replace('.',
                                ',')) + `</td>

                            <td class="py-2" style="vertical-align:middle;" align="right">` + formatRupiah(profit
                            .toString().replace(
                                '.',
                                ',')) +
                        `</td>
                        <td class="py-2" style="vertical-align:middle;"><button class="btn btn-danger btn-sm removeItem" type="button" data-id="` +
                        cartList[i].id + `"><i class="fas text-warning fa-sm fa-trash fa-sm"></i></button></td>
                        </tr>
                    `);
                }
                $('#cartListPembelian').append(`
                    <tr class="bg-light">
                        <td class="py-2" style="vertical-align:middle;" colspan="7">TOTAL</td>
                    <td class="py-2" style="vertical-align:middle;" align="right">` + formatRupiah(totaldiskon
                    .toString()
                    .replace('.',
                        ',')) + `</td>
                    <td class="py-2" style="vertical-align:middle;" align="right">` + formatRupiah(
                    grandtotalwithdiskon
                    .toString().replace(
                        '.',
                        ',')) + `</td>
                    <td class="py-2" style="vertical-align:middle;" align="right">` + formatRupiah(totalprofit
                    .toString()
                    .replace('.',
                        ',')) + `</td>
                        <td class="py-2"></td>
                    </tr>
                `);

                // const ppn_masukan = grandtotalwithPPN * 11 / 100;
                $('#grandtotal').val(grandtotalwithoutdiskon);
                $('#grandtotalwithdiskon').val(grandtotalwithdiskon);
                $('#totaldiskon').val(totaldiskon);
                $('#ppn_masukan').val(formatRupiah(grandtotalPPNMasukan.toFixed(0)));
                $('#totalsemua').val(formatRupiah(grandtotalwithdiskon));
                $('#totalTagihan').val(formatRupiah(grandtotalwithdiskon));
            } else {
                $('#cartListPembelian').html('');
                $('#cartListPembelian').append(
                    `<tr><td colspan="11" class="py-2 font-italic text-center">Data belum tersedia.</td></tr>`);
            }
        }

        $(document).on('click', '.qtyCart', function() {
            const id = $(this).data('id');
            const namaBarang = $(this).data('namabarang');
            const qtyBefore = $(this).data('qtybefore');
            $('#idQtyCart').val(id);
            $('#namaQtyCart').val(namaBarang);
            $('#updateQtyCart').val(formatRupiah(qtyBefore));
        });

        $(document).on('click', '.changeQtyCart', function() {
            const id = $('#idQtyCart').val();
            const qty = $('#updateQtyCart').val() ? $('#updateQtyCart').val().replace(/[^0-9,]/g, '').replace(',',
                '.') : 0;
            cartLS.update(parseInt(id), 'quantity', parseFloat(qty));
            $('#qtyCartModal').modal('hide');
            cartPembelian();
        });

        $(document).on('click', '.removeItem', function() {
            r = confirm('Yakin ingin melanjutkan?');
            if (r == true) {
                const id = $(this).data('id');
                if (cartLS.exists(id)) {
                    cartLS.remove(id);
                    cartPembelian();
                }
                if (cartLS.list() == 0) {
                    $('#ppn_masukan').val('');
                    $('#totaldiskon').val('');
                    $('#grandtotal').val('');
                    $('#grandtotalwithdiskon').val('');
                    $('#totalsemua').val('');
                    $('#totalTagihan').val('');
                    $('#ongkir').val('');
                    $('#diskon_lain').val('');
                    $('#bayar').val('');
                    $("#jenis_pembayaran option").prop("selected", false);
                    $("#jenis_pembayaranTagihan option").prop("selected", false);
                    $("#bank_id option").prop("selected", false);
                    $("#bank_idTagihan option").prop("selected", false);
                    $('#tempo').val('');
                    $('#keterangan_pembayaran').val('');
                }
            }
        });

        $(document).on('click', '.clearItem', function() {
            r = confirm('Yakin ingin melanjutkan?');
            if (r == true) {
                cartLS.destroy();
                cartPembelian();
                $('#ppn_masukan').val('');
                $('#totaldiskon').val('');
                $('#grandtotal').val('');
                $('#grandtotalwithdiskon').val('');
                $('#totalsemua').val('');
                $('#ongkir').val('');
                $('#diskon_lain').val('');
                $('#totalTagihan').val('');
                $('#bayar').val('');
                $("#jenis_pembayaran option").prop("selected", false);
                $("#jenis_pembayaranTagihan option").prop("selected", false);
                $("#bank_id option").prop("selected", false);
                $("#bank_idTagihan option").prop("selected", false);
                $('#tempo').val('');
                $('#keterangan_pembayaran').val('');
            }
        });

        $(document).on('click', '.btnInsertPembelian', function() {
            r = confirm('Yakin ingin melanjutkan?');
            if (r == true) {
                const faktur1 = $('#faktur1').val();
                const faktur2 = $('#faktur2').val();
                const tanggal = $('#tanggal').val();
                const suplier_id = $('#suplier_id').val();
                const catatan = $('#catatan').val();

                const totaldiskon = $('#totaldiskon').val().replace(/[^0-9,]/g, '').replace(',', '.');
                const ongkir = $('#ongkir').val() ? $('#ongkir').val().replace(/[^0-9,]/g, '').replace(',', '.') :
                    0;
                const ppn_masukan = $('#ppn_masukan').val() ? $('#ppn_masukan').val().replace(/[^0-9,]/g, '')
                    .replace(',', '.') : 0;
                const diskon_lain = $('#diskon_lain').val() ? $('#diskon_lain').val().replace(/[^0-9,]/g, '')
                    .replace(',', '.') : 0;
                const grandtotal = $('#grandtotal').val().replace(/[^0-9,]/g, '').replace(',', '.');
                const grandtotalwithdiskon = $('#grandtotalwithdiskon').val() ? $('#grandtotalwithdiskon').val()
                    .replace(/[^0-9,]/g, '').replace(',',
                        '.') : 0;

                const bayar = $('#bayar').val().replace(/[^0-9,]/g, '').replace(',', '.');
                const jenis_pembayaran = $('#jenis_pembayaran').val();
                const bank_id = $('#bank_id').val();
                const keterangan_pembayaran = $('#keterangan_pembayaran').val();

                const bayarTagihan = $('#bayarTagihan').val().replace(/[^0-9,]/g, '').replace(',', '.');
                const jenis_pembayaranTagihan = $('#jenis_pembayaranTagihan').val();
                const bank_idTagihan = $('#bank_idTagihan').val();
                const keterangan_pembayaranTagihan = $('#keterangan_pembayaranTagihan').val();

                const tempo = $('#tempo').val();

                const grandtotalkeseluruhan = parseFloat(grandtotalwithdiskon) + parseFloat(ongkir) + parseFloat(
                    ppn_masukan);

                const cartList = cartLS.list();
                if (faktur1 && tanggal && suplier_id && cartList) {
                    $.ajax({
                        url: '/dashboard/pembelians',
                        method: 'post',
                        data: {
                            faktur1,
                            faktur2,
                            tanggal,
                            suplier_id,
                            catatan,
                            totaldiskon,
                            ongkir,
                            ppn_masukan,
                            diskon_lain,
                            grandtotal,
                            grandtotalkeseluruhan,
                            bayar,
                            jenis_pembayaran,
                            bank_id,
                            keterangan_pembayaran,
                            bayarTagihan,
                            jenis_pembayaranTagihan,
                            bank_idTagihan,
                            keterangan_pembayaranTagihan,
                            tempo,
                            data: cartList
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response)
                            if (response.status) {
                                cartLS.destroy();
                                $("#toastAlert").toast({
                                    delay: 3000
                                });
                                $("#toastAlert").toast('show');
                                $("#infoToast").html('Oops!');
                                $(".toast-body>#message").html(response.msg);
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
                    $(".toast-body>#message").html('Tanggal, suplier atau data barang belum ditambahkan.');
                }
            }
        });

        $('.addSatuan').on('click', function() {
            $('#satuanModalLabel').html('Satuan Baru');
            $('#satuan_nama').val('');
            $('#satuan_jenis_id option[value=""]').prop('selected', true);
        });

        $('.insertSatuan').on('click ', function() {
            if ($('#satuan_nama').val()) {
                $.ajax({
                    url: '/api/satuans',
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        nama: $('#satuan_nama').val(),
                        jenis_id: $('#satuan_jenis_id').val()
                    },
                    dataType: 'json',
                    error: function(err) {
                        getSatuans();
                        $("#toastAlert").toast({
                            delay: 3000
                        });
                        $("#toastAlert").toast('show');
                        $("#infoToast").html('Oops!');
                        $(".toast-body>#message").html('Gagal / data sudah tersedia.');
                    },
                    success: function(response) {
                        if (response.status) {
                            getSatuans();
                        } else {
                            $("#toastAlert").toast({
                                delay: 3000
                            });
                            $("#toastAlert").toast('show');
                            $("#infoToast").html('Oops!');
                            $(".toast-body>#message").html('Data gagal disimpan.');
                        }
                    }
                });
            } else {
                $("#toastAlert").toast({
                    delay: 3000
                });
                $("#toastAlert").toast('show');
                $("#infoToast").html('Oops!');
                $(".toast-body>#message").html('Nama satuan harus diisi.');
            }
        });

        function getSatuans() {
            $('#satuanModal').modal('hide');
            $.ajax({
                url: '/api/satuans?jenis=1',
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#satuan_banyak_id').children().remove();
                    addOption('satuan_banyak_id', '', ':: Pilih ::');
                    for (let i = 0; i < response.length; i++) {
                        const satuan = response[i];
                        addOption('satuan_banyak_id', satuan.id, satuan.nama);
                    }
                    $('#satuan_banyak_id').selectpicker('refresh');
                }
            });
            $.ajax({
                url: '/api/satuans?jenis=2',
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#satuan_berat_id').children().remove();
                    addOption('satuan_berat_id', '', ':: Pilih ::');
                    for (let i = 0; i < response.length; i++) {
                        const satuan = response[i];
                        addOption('satuan_berat_id', satuan.id, satuan.nama);
                    }
                    $('#satuan_berat_id').selectpicker('refresh');
                }
            });
        }

        $('.addCategory').on('click', function() {
            $('#categoryModalLabel').html('Kategori Baru');
            $('#category_nama').val('');
        });

        $('.insertCategory').on('click ', function() {
            if ($('#category_nama').val()) {
                $.ajax({
                    url: '/api/categories',
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        nama: $('#category_nama').val()
                    },
                    dataType: 'json',
                    error: function(err) {
                        getCategories();
                        $("#toastAlert").toast({
                            delay: 3000
                        });
                        $("#toastAlert").toast('show');
                        $("#infoToast").html('Oops!');
                        $(".toast-body>#message").html('Gagal / data sudah tersedia.');
                    },
                    success: function(response) {
                        if (response.status) {
                            getCategories();
                        } else {
                            $("#toastAlert").toast({
                                delay: 3000
                            });
                            $("#toastAlert").toast('show');
                            $("#infoToast").html('Oops!');
                            $(".toast-body>#message").html('Data gagal disimpan.');
                        }
                    }
                });
            } else {
                $("#toastAlert").toast({
                    delay: 3000
                });
                $("#toastAlert").toast('show');
                $("#infoToast").html('Oops!');
                $(".toast-body>#message").html('Nama kategori harus diisi.');
            }
        });

        function getCategories() {
            $('#categoryModal').modal('hide');
            $.ajax({
                url: '/api/categories',
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#category_id').children().remove();
                    addOption('category_id', '', ':: Pilih ::');
                    for (let i = 0; i < response.length; i++) {
                        const category = response[i];
                        addOption('category_id', category.id, category.nama);
                    }
                    $('#category_id').selectpicker('refresh');
                }
            });
        }

        $('.addRak').on('click', function() {
            $('#rakModalLabel').html('Rak Baru');
            $('#rak_nama').val('');
        });

        $('.insertRak').on('click ', function() {
            if ($('#rak_nama').val()) {
                $.ajax({
                    url: '/api/raks',
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        nama: $('#rak_nama').val()
                    },
                    dataType: 'json',
                    error: function(err) {
                        getRaks();
                        $("#toastAlert").toast({
                            delay: 3000
                        });
                        $("#toastAlert").toast('show');
                        $("#infoToast").html('Oops!');
                        $(".toast-body>#message").html('Gagal / data sudah tersedia.');
                    },
                    success: function(response) {
                        if (response.status) {
                            getRaks();
                        } else {
                            $("#toastAlert").toast({
                                delay: 3000
                            });
                            $("#toastAlert").toast('show');
                            $("#infoToast").html('Oops!');
                            $(".toast-body>#message").html('Data gagal disimpan.');
                        }
                    }
                });
            } else {
                $("#toastAlert").toast({
                    delay: 3000
                });
                $("#toastAlert").toast('show');
                $("#infoToast").html('Oops!');
                $(".toast-body>#message").html('Nama rak harus diisi.');
            }
        });

        function getRaks() {
            $('#rakModal').modal('hide');
            $.ajax({
                url: '/api/raks',
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#rak_id').children().remove();
                    addOption('rak_id', '', ':: Pilih ::');
                    for (let i = 0; i < response.length; i++) {
                        const rak = response[i];
                        addOption('rak_id', rak.id, rak.nama);
                    }
                    $('#rak_id').selectpicker('refresh');
                }
            });
        }

        // $(document).on('keyup', '#harga_jual', function() {
        //     const harga_jual = $(this).val().replace(/[^0-9,]/g, '').replace(',', '.');
        //     const ppn_keluaran = parseFloat(harga_jual) * 11 / 100;
        //     const harga_ppn = parseFloat(harga_jual) + parseFloat(ppn_keluaran);
        //     $('#ppn_keluaran').val(formatRupiah(ppn_keluaran));
        //     $('#harga_jual_ppn').val(formatRupiah(harga_ppn));
        // })

        // $(document).on('keyup', '#harga_jual_brg', function() {
        //     const harga_jual = $(this).val().replace(/[^0-9,]/g, '').replace(',', '.');
        //     const ppn_keluaran = parseFloat(harga_jual) * 11 / 100;
        //     const harga_ppn = parseFloat(harga_jual) + parseFloat(ppn_keluaran);
        //     $('#ppn_keluaran_brg').val(formatRupiah(ppn_keluaran));
        //     $('#harga_ppn_brg').val(formatRupiah(harga_ppn));
        //     $('#harga_jual_min_brg').val(formatRupiah(harga_ppn));
        // })

        // $(document).on('keyup', '#ppn_keluaran_brg', function() {
        //     const harga_jual = $('#harga_jual_brg').val().replace(/[^0-9,]/g, '').replace(',', '.');
        //     const ppn_keluaran = $(this).val().replace(/[^0-9,]/g, '').replace(',', '.');
        //     const harga_ppn = parseFloat(harga_jual) + parseFloat(ppn_keluaran);
        //     $('#ppn_keluaran_brg').val(formatRupiah(ppn_keluaran));
        //     $('#harga_ppn_brg').val(formatRupiah(harga_ppn));
        //     $('#harga_jual_min_brg').val(formatRupiah(harga_ppn));
        // })

        $(document).ready(function() {
            if ($('#isPPNBarang').is(':checked')) {
                $('#ppn_keluaran_brg').attr('readonly', false);
                if ($('#harga_jual_brg').val()) {
                    const harga_jual = $('#harga_jual_brg').val().replace(/[^0-9,]/g, '').replace(',', '.');
                    const ppn_keluaran = parseFloat(harga_jual) * 11 / 100;
                    const harga_ppn = parseFloat(harga_jual) + parseFloat(ppn_keluaran);
                    $('#ppn_keluaran_brg').val(formatRupiah(ppn_keluaran));
                    $('#harga_ppn_brg').val(formatRupiah(harga_ppn));
                    $('#harga_jual_min_brg').val(formatRupiah(harga_ppn));
                }

                $(document).on('keyup', '#harga_jual_brg', function() {
                    const harga_jual = $(this).val().replace(/[^0-9,]/g, '').replace(',', '.');
                    const ppn_keluaran = parseFloat(harga_jual) * 11 / 100;
                    const harga_ppn = parseFloat(harga_jual) + parseFloat(ppn_keluaran);
                    $('#ppn_keluaran_brg').val(formatRupiah(ppn_keluaran));
                    $('#harga_ppn_brg').val(formatRupiah(harga_ppn));
                    $('#harga_jual_min_brg').val(formatRupiah(harga_ppn));
                });

                $(document).on('keyup', '#ppn_keluaran_brg', function() {
                    const harga_jual = $('#harga_jual_brg').val().replace(/[^0-9,]/g, '').replace(',', '.');
                    const ppn_keluaran = $(this).val().replace(/[^0-9,]/g, '').replace(',', '.');
                    const harga_ppn = parseFloat(harga_jual) + parseFloat(ppn_keluaran);
                    $('#ppn_keluaran_brg').val(formatRupiah(ppn_keluaran));
                    $('#harga_ppn_brg').val(formatRupiah(harga_ppn));
                    $('#harga_jual_min_brg').val(formatRupiah(harga_ppn));
                });
            } else {
                $('#ppn_keluaran_brg').val('');
                $('#ppn_keluaran_brg').attr('readonly', true);
                if ($('#harga_jual_brg').val()) {
                    const harga_jual = $('#harga_jual_brg').val().replace(/[^0-9,]/g, '').replace(',', '.');
                    $('#harga_ppn_brg').val(formatRupiah(harga_jual));
                    $('#harga_jual_min_brg').val(formatRupiah(harga_jual));
                }

                $(document).on('keyup', '#harga_jual_brg', function() {
                    const harga_jual = $(this).val().replace(/[^0-9,]/g, '').replace(',', '.');
                    const ppn_keluaran = 0;
                    const harga_ppn = parseFloat(harga_jual) + parseFloat(ppn_keluaran);
                    $('#ppn_keluaran_brg').val(formatRupiah(ppn_keluaran));
                    $('#harga_ppn_brg').val(formatRupiah(harga_ppn));
                    $('#harga_jual_min_brg').val(formatRupiah(harga_ppn));
                })
            }
        });


        $('#isPPNBarang').on('change', function() {
            if (this.checked) {
                $('#ppn_keluaran_brg').attr('readonly', false);
                if ($('#harga_jual_brg').val()) {
                    const harga_jual = $('#harga_jual_brg').val().replace(/[^0-9,]/g, '').replace(',', '.');
                    const ppn_keluaran = parseFloat(harga_jual) * 11 / 100;
                    const harga_ppn = parseFloat(harga_jual) + parseFloat(ppn_keluaran);
                    $('#ppn_keluaran_brg').val(formatRupiah(ppn_keluaran));
                    $('#harga_ppn_brg').val(formatRupiah(harga_ppn));
                    $('#harga_jual_min_brg').val(formatRupiah(harga_ppn));
                }

                $(document).on('keyup', '#harga_jual_brg', function() {
                    const harga_jual = $(this).val().replace(/[^0-9,]/g, '').replace(',', '.');
                    const ppn_keluaran = parseFloat(harga_jual) * 11 / 100;
                    const harga_ppn = parseFloat(harga_jual) + parseFloat(ppn_keluaran);
                    $('#ppn_keluaran_brg').val(formatRupiah(ppn_keluaran));
                    $('#harga_ppn_brg').val(formatRupiah(harga_ppn));
                    $('#harga_jual_min_brg').val(formatRupiah(harga_ppn));
                });

                $(document).on('keyup', '#ppn_keluaran_brg', function() {
                    const harga_jual = $('#harga_jual_brg').val().replace(/[^0-9,]/g, '').replace(',', '.');
                    const ppn_keluaran = $(this).val().replace(/[^0-9,]/g, '').replace(',', '.');
                    const harga_ppn = parseFloat(harga_jual) + parseFloat(ppn_keluaran);
                    $('#ppn_keluaran_brg').val(formatRupiah(ppn_keluaran));
                    $('#harga_ppn_brg').val(formatRupiah(harga_ppn));
                    $('#harga_jual_min_brg').val(formatRupiah(harga_ppn));
                });
            }

            if (!this.checked) {
                $('#ppn_keluaran_brg').val('');
                $('#ppn_keluaran_brg').attr('readonly', true);
                if ($('#harga_jual_brg').val()) {
                    const harga_jual = $('#harga_jual_brg').val().replace(/[^0-9,]/g, '').replace(',', '.');
                    $('#harga_ppn_brg').val(formatRupiah(harga_jual));
                    $('#harga_jual_min_brg').val(formatRupiah(harga_jual));
                }

                $(document).on('keyup', '#harga_jual_brg', function() {
                    const harga_jual = $(this).val().replace(/[^0-9,]/g, '').replace(',', '.');
                    const ppn_keluaran = 0;
                    const harga_ppn = parseFloat(harga_jual) + parseFloat(ppn_keluaran);
                    $('#ppn_keluaran_brg').val(formatRupiah(ppn_keluaran));
                    $('#harga_ppn_brg').val(formatRupiah(harga_ppn));
                    $('#harga_jual_min_brg').val(formatRupiah(harga_ppn));
                });
            }
        })

        function formatNumberField() {
            formatStrNum('qty');
            formatStrNum('harga_beli');
            formatStrNum('harga_jual');
            formatStrNum('diskon');
            formatStrNum('total');
            formatStrNum('profit');
            formatStrNum('ongkir');
            formatStrNum('grandtotal');
            formatStrNum('bayar');
            formatStrNum('tempo');
            formatStrNum('konversi_nilai');
            formatStrNum('ppn_masukan');
            formatStrNum('totalsemua');
            formatStrNum('totalTagihan');
            formatStrNum('bayarTagihan');
            formatStrNum('harga_beli_brg');
            formatStrNum('harga_jual_brg');
            formatStrNum('ppn_keluaran_brg');
            formatStrNum('harga_ppn_brg');
            formatStrNum('harga_jual_min_brg');
            formatStrNum('harga_jual_max_brg');
            formatStrNum('harga_jual_ppn');
            formatStrNum('ppn_keluaran');
            formatStrNum('diskon_lain');
        }
    </script>  --}}
@endsection
