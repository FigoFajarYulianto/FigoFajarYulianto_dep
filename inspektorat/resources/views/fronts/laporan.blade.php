@extends('fronts.template')
@section('content')
    <?php
    function getHariIni($tanggal = false)
    {
        if ($tanggal) {
            $day = date('D', strtotime($tanggal));
        } else {
            $day = date('D', strtotime(date('Y-m-d')));
        }
    
        $dayList = [
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu',
        ];
    
        return $dayList[$day];
    }
    
    ?>

    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5" style="background-color: rgba(14, 29, 52, 0.9)">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-8 text-center text-uppercase">
                        <h3 class="text-uppercase text-white">{{ $title_bar }}</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <br>

    <div class="contact-area pb-70">
        <div class="container">
            <form id="contactForm" action="/laporan/create" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" required
                                data-error="Please enter your name" value="{{ old('name') }}">
                            <div class="help-block with-errors"></div>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="kejadian">NIK</label>
                            <input type="number" name="nik" id="nik"
                                class="form-control @error('nik') is-invalid @enderror" required
                                data-error="Please enter your Nik" value="{{ old('nik') }}">
                            <div class="help-block with-errors"></div>
                            @error('nik')
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
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                                class="form-control @error('tanggal') is-invalid @enderror" placeholder="Tanggal">
                        </div>
                        @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="hari">Hari</label>
                            <input type="text" name="hari" id="hari" value="{{ old('hari', getHariIni()) }}"
                                class="form-control @error('hari') is-invalid @enderror">
                        </div>
                        @error('hari')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="kecamatan_pelapor">Kecamatan</label>
                            <select class="form-control mt-1 @error('kecamatan_id') is-invalid @enderror"
                                name="kecamatan_id" id="kecamatan_id">
                                <option value="">:: Pilih ::</option>
                                @foreach ($kecamatans as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('kecamatan_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kecamatan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="desa_pelapor">Desa/Kelurahan</label>
                            <select class="form-control mt-1 @error('desa_id') is-invalid @enderror" name="desa_id"
                                id="desa_id">
                                <option value="">:: Pilih ::</option>
                            </select>
                            @error('desa_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="telepon">Whatsapp</label>
                            <input type="number" name="telepon" id="telepon"
                                class="form-control @error('telepon') is-invalid @enderror" required
                                data-error="Please enter your Whatsapp" value="{{ old('telepon') }}">
                        </div>
                        @error('telepon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="alamat">Alamat Anda</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror " name="alamat" id="alamat" rows="3">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="telepon">Judul Pengaduan</label>
                            <input type="text" name="judul" id="judul"
                                class="form-control @error('judul') is-invalid @enderror" required
                                data-error="Please enter your Judul" value="{{ old('judul') }}">
                        </div>
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
                <div class="form-group mb-3">
                    <label for="kronologi">Penjelasan Pengaduan</label>
                    <textarea class="form-control @error('kronologi') is-invalid @enderror" name="kronologi" id="kronologi"
                        rows="5">{{ old('kronologi') }}</textarea>
                    @error('kronologi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image1">Foto KTP</label>
                            <input type="file" name="image1" id="image1"
                                class="form-control mt-1 @error('image1') is-invalid @enderror"
                                onchange="previewImage('image1', 'imagePreview1')">
                            @error('image1')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image2">Foto KK</label>
                            <input type="file" name="image2" id="image2"
                                class="form-control mt-1 @error('image2') is-invalid @enderror"
                                onchange="previewImage('image2', 'imagePreview2')">
                            @error('image2')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image3">Foto Lainnya</label>
                            <input type="file" name="image3" id="image3"
                                class="form-control mt-1 @error('image3') is-invalid @enderror">
                            @error('image3')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image4">Foto Lainnya</label>
                            <input type="file" name="image4" id="image4"
                                class="form-control mt-1 @error('image4') is-invalid @enderror">
                            @error('image4')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
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
                <div class="col-lg-12">
                    <button type="submit" class="btn common-btn" style="background-color: rgba(14, 29, 52, 0.9)">
                        Laporkan
                    </button>
                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                    <div class="clearfix"></div>
                </div>

                <div class="hide">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="pukul">Pukul</label>
                            <input type="time" name="pukul" id="pukul"
                                class="form-control @error('pukul') is-invalid @enderror">
                        </div>
                        @error('pukul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on('change', '#status', function() {
            $('#keterangan').val('');
        });

        if ($('#kecamatan_ppks').val()) {
            $.ajax({
                url: '/api/subdistricts/' + $('#kecamatan_ppks').val(),
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#desa_ppks').children().remove();
                    $('#desa_ppks').append($('<option>').val('').text(':: Pilih ::'));
                    for (let i = 0; i < response.length; i++) {
                        const item = response[i];
                        const selected = '<?= $pmks->desa_id ?? '' ?>' == item.id ? true : '';
                        addOption('desa_ppks', item.id, item.name, selected);
                    }
                }
            });
        } else {
            $('#desa_ppks').children().remove();
            $('#desa_ppks').append($('<option>').val('').text(':: Pilih ::'));
        }

        $(document).on('change', '#kecamatan_id', function() {
            const id = $(this).val();
            console.log(id);
            if (id) {
                $.ajax({
                    url: '/api/subdistricts/' + id,
                    method: 'get',
                    dataType: 'json',
                    success: function(response) {
                        $('#desa_id').children().remove();
                        $('#desa_id').append($('<option>').val('').text(':: Pilih ::'));
                        for (let i = 0; i < response.length; i++) {
                            const item = response[i];
                            addOption('desa_id', item.id, item.name);
                        }
                    }
                });
            } else {
                $('#desa_id').children().remove();
                $('#desa_id').append($('<option>').val('').text(':: Pilih ::'));
            }
        });

        $(document).on('change', '#kecamatan_ppks', function() {
            const id = $(this).val();
            if (id) {
                $.ajax({
                    url: '/api/subdistricts/' + id,
                    method: 'get',
                    dataType: 'json',
                    success: function(response) {
                        $('#desa_ppks').children().remove();
                        $('#desa_ppks').append($('<option>').val('').text(':: Pilih ::'));
                        for (let i = 0; i < response.length; i++) {
                            const item = response[i];
                            addOption('desa_ppks', item.id, item.name);
                        }
                    }
                });
            } else {
                $('#desa_ppks').children().remove();
                $('#desa_ppks').append($('<option>').val('').text(':: Pilih ::'));
            }
        });

        function addOption(inputId, val, text, select = false) {
            const selected = select ? 'selected="true"' : '';
            $('#' + inputId).append($('<option ' + selected + '>').val(val).text(text));
        }

        $(document).ready(function() {
            let now = new Date();
            $('#pukul').val(now.getHours() + ":" + now.getMinutes());
        });

        $('.hide').hide();
    </script>
@endsection
