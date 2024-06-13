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
    <div class="container-xl px-4 mt-n10 mt-5">
        <div class="container">
            <div class="text-center mb-4">
                <h3 class="text-bold">Kalkulator Zakat</h3>
                <div class="mt-2">Yuk hitung berapa zakat yang harus kamu keluarkan tahun ini</div>
            </div>
            <div class="col-md-8 offset-md-2 mt-4">
                <div class="card-box-shadow --no-padding" style="box-shadow: 0 4px 10px 0 rgb(228, 228, 228);">
                    <div class="tab-base">
                        <ul class="nav nav-pills nav-justified nav-base" id="tabzakat" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link py-3 active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#penghasilan" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true"
                                    style="color: rgb(55, 55, 55)">Penghasilan</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link py-3" id="home-tab" data-bs-toggle="tab" data-bs-target="#mal"
                                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true"
                                    style="color: rgb(55, 55, 55)">Maal</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link py-3" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#perdagangan" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true"
                                    style="color: rgb(55, 55, 55)">Perdagangan</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link py-3" id="home-tab" data-bs-toggle="tab" data-bs-target="#simpanan"
                                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true"
                                    style="color: rgb(55, 55, 55)">Simpanan</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="penghasilan" role="tabpanel"
                                aria-labelledby="nav-home-tab" tabindex="0">
                                <div class="p-4 form-calc-profesi">
                                    <form id="form-calc-profesi">
                                        <p class="mt-20 mb-10" style="text-align: justify;">
                                            {{ $zakatpenghasilan->description }}
                                        </p>
                                        <div class="row mt-4" style="text-align: center">
                                            <a href="javascript:void(0)"
                                                class="btn-base btn--block btn--primary btn--lg penghasilanModal"
                                                data-id="1" data-bs-toggle="modal"
                                                data-bs-target="#penghasilanModal">Kalkulator Zakat
                                                Penghasilan
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="mal" role="tabpanel" aria-labelledby="nav-profile-tab"
                                tabindex="0">
                                <div class="p-4">
                                    <p class="mt-20 mb-10" style="text-align: justify;">
                                        {{ $zakatmal->description }}
                                    </p>
                                    <div class="row mt-4" style="text-align: center">
                                        <a href="javascript:void(0)"
                                            class="btn-base btn--block btn--primary btn--lg malModal" data-bs-toggle="modal"
                                            data-bs-target="#malModal">Kalkulator Zakat Harta
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="perdagangan" role="tabpanel" aria-labelledby="nav-profile-tab"
                                tabindex="0">
                                <div class="p-4">
                                    <p class="mt-20 mb-10" style="text-align: justify;">
                                        {{ $zakatperdagangan->description }}
                                    </p>
                                    <div class="row mt-4" style="text-align: center">
                                        <a href="javascript:void(0)"
                                            class="btn-base btn--block btn--primary btn--lg perdaganganModal"
                                            data-bs-toggle="modal" data-bs-target="#perdaganganModal">Kalkulator Zakat
                                            Perdagangan
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="simpanan" role="tabpanel" aria-labelledby="nav-profile-tab"
                                tabindex="0">
                                <div class="p-4">
                                    <p class="mt-20 mb-10" style="text-align: justify;">
                                        {{ $zakatsimpanan->description }}
                                    </p>
                                    <div class="row mt-4" style="text-align: center">
                                        <a href="javascript:void(0)"
                                            class="btn-base btn--block btn--primary btn--lg simpananModal"
                                            data-bs-toggle="modal" data-bs-target="#simpananModal">Kalkulator Zakat
                                            Simpanan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Penghasilan Modal --}}
    <div class="modal fade" id="penghasilanModal" tabindex="-1" aria-labelledby="penghasilanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="penghasilanModalLabel">Zakat Profesi/Penghasilan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="pendapatan">Pendapatan Perbulan</label>
                                <input type="text" name="pendapatan" id="pendapatan" onkeyup="strToNum('pendapatan')"
                                    class="form-control mt-1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="lainnya">Bonus, THR Lainnya (jika ada)</label>
                                <input type="text" name="lainnya" id="lainnya" onkeyup="strToNum('lainnya')"
                                    class="form-control mt-1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="lainnya">Hasil Perhitungan Zakat Profesi/Penghasilan Anda</label>
                                <div id="totalpendapatanlabel"
                                    style="color: rgb(255, 111, 0); font-weight:bold; font-size:30px"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="form-control btn btn-success hitungpenghasilan">Hitung</button>
                            <div id="bayar_sekarang" class="mt-1"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Maal Modal --}}
    <div class="modal fade" id="malModal" tabindex="-1" aria-labelledby="malModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="penghasilanModalLabel">Zakat Maal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="nilai_tabungan">Nilai Deposito/Tabungan/Giro</label>
                                <input type="text" name="nilai_tabungan" id="nilai_tabungan"
                                    onkeyup="strToNum('nilai_tabungan')" class="form-control mt-1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="nilai_emas_dll">Emas, perak, permata, atau sejenisnya</label>
                                <input type="text" name="nilai_emas_dll" id="nilai_emas_dll"
                                    onkeyup="strToNum('nilai_emas_dll')" class="form-control mt-1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="nilai_properti">Nilai properti & kendaraan</label>
                                <input type="text" name="nilai_properti" id="nilai_properti"
                                    onkeyup="strToNum('nilai_properti')" class="form-control mt-1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="nilai_harta_lain">Lainnya</label>
                                <input type="text" name="nilai_harta_lain" id="nilai_harta_lain"
                                    onkeyup="strToNum('nilai_harta_lain')" class="form-control mt-1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="nilai_hutang">Hutang pribadi yang jatuh tempo tahun ini</label>
                                <input type="text" name="nilai_hutang" id="nilai_hutang"
                                    onkeyup="strToNum('nilai_hutang')" class="form-control mt-1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label></label>
                            <button type="submit" class="form-control btn btn-success hitungmal">Hitung</button>
                            <div id="bayar_sekarang1" class="mt-1"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="lainnya">Zakat Maal :</label>
                                <div id="totalmallabel" style="color: rgb(255, 111, 0); font-weight:bold; font-size:30px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Perdagangan Modal --}}
    <div class="modal fade" id="perdaganganModal" tabindex="-1" aria-labelledby="perdaganganModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="penghasilanModalLabel">Zakat Perdagangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="modal">Modal (1 Tahun)</label>
                                <input type="text" name="modal" id="modal" onkeyup="strToNum('modal')"
                                    class="form-control mt-1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="hutang">Hutang Jatuh Tempo</label>
                                <input type="text" name="hutang" id="hutang" onkeyup="strToNum('hutang')"
                                    class="form-control mt-1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="keuntungan">Keuntungan (1 Tahun)</label>
                                <input type="text" name="keuntungan" id="keuntungan" onkeyup="strToNum('keuntungan')"
                                    class="form-control mt-1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="piutang">Piutang Dagang</label>
                                <input type="text" name="piutang" id="piutang" onkeyup="strToNum('piutang')"
                                    class="form-control mt-1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="hutang_rugi">Hutang / Kerugian (1 Tahun)</label>
                                <input type="text" name="hutang_rugi" id="hutang_rugi"
                                    onkeyup="strToNum('hutang_rugi')" class="form-control mt-1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label></label>
                            <button type="submit" class="form-control btn btn-success hitungperdagangan">Hitung</button>
                            <div id="bayar_sekarang2" class="mt-1"></div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="lainnya">Zakat Perdagangan :</label>
                        <div id="totalperdaganganlabel" style="color: rgb(255, 111, 0); font-weight:bold; font-size:30px">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Simpanan Modal --}}
    <div class="modal fade" id="simpananModal" tabindex="-1" aria-labelledby="simpananModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="simpananModalLabel">Zakat Simpanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="tabungan">Saldo Tabungan (wajib di isi)</label>
                                <input type="text" name="tabungan" id="tabungan" onkeyup="strToNum('tabungan')"
                                    class="form-control mt-1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="bagi_hasil">Bagi Hasil (jika ada)</label>
                                <input type="text" name="bagi_hasil" id="bagi_hasil" onkeyup="strToNum('bagi_hasil')"
                                    class="form-control mt-1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="lainnya">Zakat Simpanan :</label>
                                <div id="totalsimpananlabel"
                                    style="color: rgb(255, 111, 0); font-weight:bold; font-size:30px">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for=""></label>
                            <button type="submit" class="form-control btn btn-success hitungsimpanan">Hitung</button>
                            <div id="bayar_sekarang3" class="mt-1"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Niat Penghasilan Modal --}}
    <div class="modal fade" id="niatpenghasilanModal" tabindex="-1" aria-labelledby="niatpenghasilanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="GET">
                    @csrf
                    <div class="modal-header">
                        <input type="hidden" name="bayarzakat" id="bayarzakat" class="bayarzakat">
                        <h5 class="modal-title" id="niatpenghasilanModalLabel">Niat Zakat Profesi/Penghasilan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <img src="/assets/frontend/img/niatmal.jpg" alt="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success niatpenghasilan">Saya Sudah Membaca Niat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Niat Maal Modal --}}
    <div class="modal fade" id="niatmalModal" tabindex="-1" aria-labelledby="niatmalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="GET">
                    @csrf
                    <div class="modal-header">
                        <input type="hidden" name="bayarzakat" id="bayarzakat" class="bayarzakat">
                        <h5 class="modal-title" id="niatmalModalLabel">Niat Zakat Maal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <img src="/assets/frontend/img/niatmal.jpg" alt="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success niatmal">Saya Sudah Membaca Niat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Niat Perdagangan Modal --}}
    <div class="modal fade" id="niatperdaganganModal" tabindex="-1" aria-labelledby="niatperdaganganModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="GET">
                    @csrf
                    <div class="modal-header">
                        <input type="hidden" name="bayarzakat" id="bayarzakat" class="bayarzakat">
                        <h5 class="modal-title" id="niatperdaganganModalLabel">Niat Zakat Perdagangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <img src="/assets/frontend/img/niatmal.jpg" alt="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success niatperdagangan">Saya Sudah Membaca Niat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Niat Simpanan Modal --}}
    <div class="modal fade" id="niatsimpananModal" tabindex="-1" aria-labelledby="niatsimpananModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="GET">
                    @csrf
                    <div class="modal-header">
                        <input type="hidden" name="bayarzakat" id="bayarzakat" class="bayarzakat">
                        <h5 class="modal-title" id="niatsimpananModalLabel">Niat Zakat Simpanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <img src="/assets/frontend/img/niatmal.jpg" alt="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success niatsimpanan">Saya Sudah Membaca Niat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        formatStrNum('pendapatan');
        formatStrNum('lainnya');
        formatStrNum('nilai_tabungan');
        formatStrNum('nilai_properti');
        formatStrNum('nilai_hutang');
        formatStrNum('nilai_emas_dll');
        formatStrNum('nilai_harta_lain');
        formatStrNum('modal');
        formatStrNum('keuntungan');
        formatStrNum('hutang_rugi');
        formatStrNum('hutang');
        formatStrNum('piutang');
        formatStrNum('tabungan');
        formatStrNum('bagi_hasil');

        $('.penghasilanModal').on('click ', function() {
            $('#pendapatan').val('');
            $('#lainnya').val('');
            $('#totalpendapatanlabel').html('');
            $('.btn-penghasilan').show();
            $('#bayar_sekarang').hide();
            $('#zakatsekarang').hide();
        });

        $('.malModal').on('click ', function() {
            $('#nilai_tabungan').val('');
            $('#nilai_properti').val('');
            $('#nilai_hutang').val('');
            $('#nilai_emas_dll').val('');
            $('#nilai_harta_lain').val('');
            $('#totalmallabel').html('');
            $('#bayar_sekarang1').hide();
            $('#zakatsekarang').hide();
            $('.btn-mal').show();
        });

        $('.perdaganganModal').on('click ', function() {
            $('#modal').val('');
            $('#keuntungan').val('');
            $('#hutang_rugi').val('');
            $('#hutang').val('');
            $('#piutang').val('');
            $('#bayar_sekarang2').hide();
            $('#zakatsekarang').hide();
            $('#totalperdaganganlabel').html('');
            $('.btn-perdagangan').show();
        });

        $('.simpananModal').on('click ', function() {
            $('#tabungan').val('');
            $('#bagi_hasil').val('');
            $('#bayar_sekarang3').hide();
            $('#zakatsekarang').hide();
            $('#totalsimpananlabel').html('');
            $('.btn-simpanan').show();
        });

        // zakat penghasilan
        $('.hitungpenghasilan').on('click ', function() {
            $('#bayar_sekarang').html('');
            $('#bayar_sekarang').show();
            $('#totalpendapatanlabel').html('');
            var pendapatan = $('#pendapatan').val() ? $('#pendapatan').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;
            var lainnya = $('#lainnya').val() ? $('#lainnya').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;

            $.ajax({
                url: '/kalkulator-zakat/profesi',
                method: 'get',
                data: {
                    pendapatan,
                    lainnya,
                },
                dataType: 'json',
                success: function(response) {
                    if (response != 'Belum Wajib Zakat') {
                        $('#totalpendapatanlabel').append('Rp ' + formatNumber(response) + ',-');
                        $('#bayar_sekarang').append(`
                        <a href="javascript:void(0)" class="btn btn-success form-control" id="zakatsekarang"
                                                data-bs-toggle="modal" onClick="niatpenghasilan(` + response + `)"
                                                data-bs-target="#niatpenghasilanModal">Zakat Sekarang
                                            </a>`);

                    } else {
                        $('#totalpendapatanlabel').append(response);
                    }
                }
            });
        });

        function niatpenghasilan(nominal) {
            $('.bayarzakat').val(nominal)
        };

        $('.niatpenghasilan').on('click ', function() {
            let nominal = $('.bayarzakat').val();
            let jeniszakat = 'zakat-profesi-penghasilan';
            $('input[name=_method]').val('GET');
            $('.modal form').prop('action', '/kalkulator-zakat/transaksi/' + nominal + '/' + jeniszakat);
        });

        // Zakat Mal
        $('.hitungmal').on('click ', function() {
            $('#bayar_sekarang1').html('');
            $('#bayar_sekarang1').show();
            $('#totalmallabel').html('');
            var nilai_tabungan = $('#nilai_tabungan').val() ? $('#nilai_tabungan').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;
            var nilai_properti = $('#nilai_properti').val() ? $('#nilai_properti').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;
            var nilai_hutang = $('#nilai_hutang').val() ? $('#nilai_hutang').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;
            var nilai_emas_dll = $('#nilai_emas_dll').val() ? $('#nilai_emas_dll').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;
            var nilai_harta_lain = $('#nilai_harta_lain').val() ? $('#nilai_harta_lain').val().replace(/[^0-9,]/g,
                    '')
                .replace(',', '.') : 0;

            $.ajax({
                url: '/kalkulator-zakat/maal',
                method: 'get',
                data: {
                    nilai_tabungan,
                    nilai_properti,
                    nilai_hutang,
                    nilai_emas_dll,
                    nilai_harta_lain,
                },
                dataType: 'json',
                success: function(response) {
                    if (response != 'Belum Wajib Zakat') {
                        $('#totalmallabel').append('Rp ' + formatNumber(response) + ',-');
                        $('#bayar_sekarang1').append(`
                        <a href="javascript:void(0)" class="btn btn-success form-control" id="zakatsekarang"
                                                data-bs-toggle="modal" onClick="niatmal(` + response + `)"
                                                data-bs-target="#niatmalModal">Zakat Sekarang
                                            </a>`);
                    } else {
                        $('#totalmallabel').append(response);
                    }
                }
            });
        });

        function niatmal(nominal) {
            $('.bayarzakat').val(nominal)
        };

        $('.niatmal').on('click ', function() {
            let nominal = $('.bayarzakat').val();
            let jeniszakat = 'zakat-maal';
            $('input[name=_method]').val('GET');
            $('.modal form').prop('action', '/kalkulator-zakat/transaksi/' + nominal + '/' + jeniszakat);
        });

        // Zakat Perdagangan
        $('.hitungperdagangan').on('click ', function() {
            $('#bayar_sekarang2').html('');
            $('#bayar_sekarang2').show();
            $('#totalperdaganganlabel').html('');
            var modal = $('#modal').val() ? $('#modal').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;
            var keuntungan = $('#keuntungan').val() ? $('#keuntungan').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;
            var hutang_rugi = $('#hutang_rugi').val() ? $('#hutang_rugi').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;
            var hutang = $('#hutang').val() ? $('#hutang').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;
            var piutang = $('#piutang').val() ? $('#piutang').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;

            $.ajax({
                url: '/kalkulator-zakat/perdagangan',
                method: 'get',
                data: {
                    modal,
                    keuntungan,
                    hutang_rugi,
                    hutang,
                    piutang,
                },
                dataType: 'json',
                success: function(response) {
                    if (response != 'Belum Wajib Zakat') {
                        $('#totalperdaganganlabel').append('Rp ' + formatNumber(response) + ',-');
                        $('#bayar_sekarang2').append(`
                        <a href="javascript:void(0)" class="btn btn-success form-control" id="zakatsekarang"
                                                data-bs-toggle="modal" onClick="niatperdagangan(` + response + `)"
                                                data-bs-target="#niatperdaganganModal">Zakat Sekarang
                                            </a>`);
                    } else {
                        $('#totalperdaganganlabel').append(response);
                    }
                }
            });
        });

        function niatperdagangan(nominal) {
            $('.bayarzakat').val(nominal)
        };

        $('.niatperdagangan').on('click ', function() {
            let nominal = $('.bayarzakat').val();
            let jeniszakat = 'zakat-perdagangan';
            $('input[name=_method]').val('GET');
            $('.modal form').prop('action', '/kalkulator-zakat/transaksi/' + nominal + '/' + jeniszakat);
        });

        // Zakat Simpanan
        $('.hitungsimpanan').on('click ', function() {
            $('#bayar_sekarang3').html('');
            $('#bayar_sekarang3').show();
            $('#totalsimpananlabel').html('');
            var tabungan = $('#tabungan').val() ? $('#tabungan').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;
            var bagi_hasil = $('#bagi_hasil').val() ? $('#bagi_hasil').val().replace(/[^0-9,]/g, '')
                .replace(',', '.') : 0;

            $.ajax({
                url: '/kalkulator-zakat/simpanan',
                method: 'get',
                data: {
                    tabungan,
                    bagi_hasil,
                },
                dataType: 'json',
                success: function(response) {
                    if (response != 'Belum Wajib Zakat') {
                        $('#totalsimpananlabel').append('Rp ' + formatNumber(response) + ',-');
                        $('#bayar_sekarang3').append(`
                        <a href="javascript:void(0)" class="btn btn-success form-control" id="zakatsekarang"
                                                data-bs-toggle="modal" onClick="niatsimpanan(` + response + `)"
                                                data-bs-target="#niatsimpananModal">Zakat Sekarang
                                            </a>`);
                    } else {
                        $('#totalsimpananlabel').append(response);
                    }
                }
            });
        });

        function niatsimpanan(nominal) {
            $('.bayarzakat').val(nominal)
        };

        $('.niatsimpanan').on('click ', function() {
            let nominal = $('.bayarzakat').val();
            let jeniszakat = 'zakat-simpanan';
            $('input[name=_method]').val('GET');
            $('.modal form').prop('action', '/kalkulator-zakat/transaksi/' + nominal + '/' + jeniszakat);
        });

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        }
    </script>
@endsection
