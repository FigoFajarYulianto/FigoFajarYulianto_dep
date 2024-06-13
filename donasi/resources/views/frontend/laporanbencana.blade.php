@extends('frontend.template')
@section('content')
    <style>
        .btn-laporkan {
            background-color: rgb(255, 126, 20);
            color: white;
        }

        .btn-laporkan:hover {
            background-color: rgb(235, 106, 0);
            color: white;
        }
    </style>

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
    
    function getBulanIni($bulan = false)
    {
        if ($bulan) {
            $month = date('M', strtotime($bulan));
        } else {
            $month = date('M', strtotime(date('Y-m-d')));
        }
    
        $monthList = [
            'Jan' => 'Januari',
            'Feb' => 'Februari',
            'Mar' => 'Maret',
            'Apr' => 'April',
            'May' => 'Mei',
            'Jun' => 'Juni',
            'Jul' => 'Juli',
            'Aug' => 'Agustus',
            'Sep' => 'September',
            'Okt' => 'Oktober',
            'Nov' => 'November',
            'Dec' => 'Desember',
        ];
    
        return $monthList[$month];
    }
    
    ?>

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

    <div class="blog-details-area pt-5 pb-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg">
                    <div class="details-item">
                        <div class="details-img">
                            <div class="col-12 grid-margin">
                                <div class="col-md-12 grid-margin stretch-card">
                                    {!! session('msg') !!}
                                    <div class="card">
                                        <div class="card shadow">
                                            <div class="card-body">

                                                <div class="col-sm-12">
                                                    <center>
                                                        <h4 class="text-uppercase">Form Laporan Bencana</h4>
                                                    </center>
                                                </div>

                                                <div class="col-sm-12 mt-4">
                                                    <h5 class="text-uppercase">IDENTITAS PELAPOR</h5>
                                                    <hr class="" style="width:100%;text-align:left;margin-left:0">
                                                </div>

                                                <form action="/laporanbencana/create" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="name">Nama</label>
                                                                <input type="text" name="name" id="name"
                                                                    class="form-control @error('name') is-invalid @enderror">
                                                                @error('name')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="kejadian">Kejadian</label>
                                                                <input type="text" name="kejadian" id="kejadian"
                                                                    class="form-control @error('kejadian') is-invalid @enderror">
                                                                @error('kejadian')
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
                                                                <label for="telepon">Nomor Whatsapp</label>
                                                                <input type="number" name="telepon" id="telepon"
                                                                    class="form-control @error('telepon') is-invalid @enderror">
                                                            </div>
                                                            @error('telepon')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
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
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label for="tanggal">Tanggal</label>
                                                                <input type="date" name="tanggal" id="tanggal"
                                                                    value="<?php echo date('Y-m-d'); ?>"
                                                                    class="form-control @error('tanggal') is-invalid @enderror">
                                                            </div>
                                                            @error('tanggal')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label for="hari">Hari</label>
                                                                <input type="text" name="hari" id="hari"
                                                                    value="{{ old('hari', getHariIni()) }}"
                                                                    class="form-control @error('hari') is-invalid @enderror">
                                                            </div>
                                                            @error('hari')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label for="bulan">Bulan</label>
                                                                <select
                                                                    class="form-control @error('bulan') is-invalid @enderror"
                                                                    name="bulan" id="bulan">
                                                                    <option value="">:: Pilih Bulan ::</option>
                                                                    <option value="Januari"
                                                                        {{ old('bulan', getBulanIni()) == 'Januari' ? 'selected' : '' }}>
                                                                        Januari</option>
                                                                    <option value="Februari"
                                                                        {{ old('bulan', getBulanIni()) == 'Februari' ? 'selected' : '' }}>
                                                                        Februari</option>
                                                                    <option value="Maret"
                                                                        {{ old('bulan', getBulanIni()) == 'Maret' ? 'selected' : '' }}>
                                                                        Maret</option>
                                                                    <option value="April"
                                                                        {{ old('bulan', getBulanIni()) == 'April' ? 'selected' : '' }}>
                                                                        April</option>
                                                                    <option value="Mei"
                                                                        {{ old('bulan', getBulanIni()) == 'Mei' ? 'selected' : '' }}>
                                                                        Mei</option>
                                                                    <option value="Juni"
                                                                        {{ old('bulan', getBulanIni()) == 'Juni' ? 'selected' : '' }}>
                                                                        Juni</option>
                                                                    <option value="Juli"
                                                                        {{ old('bulan', getBulanIni()) == 'Juli' ? 'selected' : '' }}>
                                                                        Juli</option>
                                                                    <option value="Agustus"
                                                                        {{ old('bulan', getBulanIni()) == 'Agustus' ? 'selected' : '' }}>
                                                                        Agustus</option>
                                                                    <option value="September"
                                                                        {{ old('bulan', getBulanIni()) == 'September' ? 'selected' : '' }}>
                                                                        September</option>
                                                                    <option value="Oktober"
                                                                        {{ old('bulan', getBulanIni()) == 'Oktober' ? 'selected' : '' }}>
                                                                        Oktober</option>
                                                                    <option value="November"
                                                                        {{ old('bulan', getBulanIni()) == 'November' ? 'selected' : '' }}>
                                                                        November</option>
                                                                    <option value="Desember"
                                                                        {{ old('bulan', getBulanIni()) == 'Desember' ? 'selected' : '' }}>
                                                                        Desember</option>
                                                                </select>
                                                            </div>
                                                            @error('bulan')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label for="province_id">Provinsi</label>
                                                                <select
                                                                    class="form-control mt-1 @error('province_id') is-invalid @enderror"
                                                                    name="province_id" id="province_id">
                                                                    <option value="">:: Pilih ::</option>
                                                                    @foreach ($provinces as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            {{ old('province_id') == $item->id ? 'selected' : '' }}>
                                                                            {{ $item->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('province_id')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label for="district_id">Kabupaten</label>
                                                                <select
                                                                    class="form-control mt-1 @error('district_id') is-invalid @enderror"
                                                                    name="district_id" id="district_id">
                                                                    <option value="">:: Pilih ::</option>
                                                                </select>
                                                                @error('district_id')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label for="subdistrict_id">Kecamatan</label>
                                                                <select
                                                                    class="form-control mt-1 @error('subdistrict_id') is-invalid @enderror"
                                                                    name="subdistrict_id" id="subdistrict_id">
                                                                    <option value="">:: Pilih ::</option>
                                                                </select>
                                                                @error('subdistrict_id')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="alamat">Detail Tempat Kejadian</label>
                                                        <textarea class="form-control @error('alamat') is-invalid @enderror " name="alamat" id="alamat" rows="5"></textarea>
                                                        @error('alamat')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="kronologi">Kronologi</label>
                                                        <textarea class="form-control @error('kronologi') is-invalid @enderror" name="kronologi" id="kronologi"
                                                            rows="5"></textarea>
                                                        @error('kronologi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-2 mb-3">
                                                            <img src="/assets/img/noimage.jpeg"
                                                                class="img-thumbnail imagePreview1" width="100px">
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <div class="form-group">
                                                                <label for="image1">Foto 1</label>
                                                                <div class="input-group">
                                                                    <input type="file" name="image1" id="image1"
                                                                        class="form-control @error('desktop') is-invalid @enderror"
                                                                        onchange="previewImage('image1', 'imagePreview1')">
                                                                    @error('image1')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2 mb-3">
                                                            <img src="/assets/img/noimage.jpeg"
                                                                class="img-thumbnail imagePreview2" width="100px">
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <div class="form-group">
                                                                <label for="image2">Foto 2</label>
                                                                <div class="input-group">
                                                                    <input type="file" name="image2" id="image2"
                                                                        class="form-control @error('desktop') is-invalid @enderror"
                                                                        onchange="previewImage('image2', 'imagePreview2')">
                                                                    @error('image2')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <input class="hide" type="text" name="la_latitude"
                                                        id="la_latitude">
                                                    <input class="hide" type="text" name="la_longitude"
                                                        id="la_longitude">

                                                    <div id="map" style="width: 100%; height: 400px;"
                                                        class="mb-4"></div>


                                                    <center>
                                                        <div class="form-group mb-3">
                                                            <div class="g-recaptcha  @error('g-recaptcha-response') is-invalid @enderror"
                                                                data-sitekey="{{ env('RECAPTCHAV2_SITEKEY') }}"></div>
                                                            @error('g-recaptcha-response')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </center>

                                                    <button class="col-12 btn btn-laporkan"
                                                        type="submit">Laporkan</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on('change', '#status', function() {
            $('#keterangan').val('');
        });

        // Filter District
        $(document).on('change', '#province_id', function() {
            const id = $(this).val();
            if (id) {
                $.ajax({
                    url: '/api/districts/' + id,
                    method: 'get',
                    dataType: 'json',
                    success: function(response) {
                        $('#district_id').children().remove();
                        $('#district_id').append($('<option>').val('').text(':: Pilih ::'));
                        for (let i = 0; i < response.length; i++) {
                            const item = response[i];
                            addOption('district_id', item.id, item.name);
                        }
                    }
                });
            } else {
                $('#district_id').children().remove();
                $('#district_id').append($('<option>').val('').text(':: Pilih ::'));
            }
        });


        $(document).on('change', '#district_id', function() {
            const id = $(this).val();
            if (id) {
                $.ajax({
                    url: '/api/subdistricts/' + id,
                    method: 'get',
                    dataType: 'json',
                    success: function(response) {
                        $('#subdistrict_id').children().remove();
                        $('#subdistrict_id').append($('<option>').val('').text(':: Pilih ::'));
                        for (let i = 0; i < response.length; i++) {
                            const item = response[i];
                            addOption('subdistrict_id', item.id, item.name);
                        }
                    }
                });
            } else {
                $('#subdistrict_id').children().remove();
                $('#subdistrict_id').append($('<option>').val('').text(':: Pilih ::'));
            }
        });

        function addOption(inputId, val, text, select = false) {
            const selected = select ? 'selected="true"' : '';
            $('#' + inputId).append($('<option ' + selected + '>').val(val).text(text));
        }
    </script>
    <!-- Jam -->
    <script>
        $(document).ready(function() {
            let now = new Date();
            $('#pukul').val(now.getHours() + ":" + now.getMinutes());
        });
    </script>
    <!-- Map -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('APIKEY_GOOGLEMAP') }}&callback=initMap"
        type="text/javascript"></script>

    <script>
        x = navigator.geolocation;
        x.getCurrentPosition(success, failure);

        function success(position) {
            if ($("#la_latitude").val() == '') {
                var myLat = position.coords.latitude;
            } else {
                var myLat = $("#la_latitude").val();
            }
            $("#la_latitude").val(myLat);

            if ($("#la_longitude").val() == '') {
                var myLong = position.coords.longitude;
            } else {
                var myLong = $("#la_longitude").val();
            }
            $("#la_longitude").val(myLong);

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                disableDefaultUI: true,
                center: new google.maps.LatLng(myLat, myLong),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var vMarker = new google.maps.Marker({
                position: new google.maps.LatLng(myLat, myLong),
                draggable: true
            });

            google.maps.event.addListener(vMarker, 'dragend', function(evt) {
                $("#la_latitude").val(evt.latLng.lat().toFixed(6));
                $("#la_longitude").val(evt.latLng.lng().toFixed(6));
                map.panTo(evt.latLng);
            });

            map.setCenter(vMarker.position);
            vMarker.setMap(map);
        }

        function failure() {
            console.log("error");
        }
    </script>
    <!-- Hide -->
    <script>
        $('.hide').hide();
    </script>
    <!-- Penutip Hide -->
@endsection
