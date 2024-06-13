@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        <a href="/dashboard/laporanbencanas" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                        {{ $title_bar }}
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/dashboard/laporanbencanas/{{ $laporanbencana->id }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('hari', $laporanbencana->name) }}">
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
                                            class="form-control @error('kejadian') is-invalid @enderror"
                                            value="{{ old('kejadian', $laporanbencana->kejadian) }}">
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
                                        <label for="telepon">Telepon</label>
                                        <input type="number" name="telepon" id="telepon"
                                            class="form-control @error('telepon') is-invalid @enderror"
                                            value="{{ old('telepon', $laporanbencana->telepon) }}">
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
                                            class="form-control @error('pukul') is-invalid @enderror"
                                            value="{{ old('pukul', $laporanbencana->pukul) }}">
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
                                            class="form-control @error('tanggal') is-invalid @enderror"
                                            value="{{ old('tanggal', $laporanbencana->tanggal) }}">
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
                                        <input type="hari" name="hari" id="hari"
                                            class="form-control @error('hari') is-invalid @enderror"
                                            value="{{ old('hari', $laporanbencana->hari) }}">
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
                                        <select class="form-control @error('bulan') is-invalid @enderror" name="bulan"
                                            id="bulan">
                                            <option value="">:: Pilih Bulan ::</option>
                                            <option value="Januari"
                                                {{ old('bulan', $laporanbencana->bulan) == 'Januari' ? 'selected' : '' }}>
                                                Januari</option>
                                            <option value="Februari"
                                                {{ old('bulan', $laporanbencana->bulan) == 'Februari' ? 'selected' : '' }}>
                                                Februari</option>
                                            <option value="Maret"
                                                {{ old('bulan', $laporanbencana->bulan) == 'Maret' ? 'selected' : '' }}>
                                                Maret</option>
                                            <option value="April"
                                                {{ old('bulan', $laporanbencana->bulan) == 'April' ? 'selected' : '' }}>
                                                April</option>
                                            <option value="Mei"
                                                {{ old('bulan', $laporanbencana->bulan) == 'Mei' ? 'selected' : '' }}>
                                                Mei</option>
                                            <option value="Juni"
                                                {{ old('bulan', $laporanbencana->bulan) == 'Juni' ? 'selected' : '' }}>
                                                Juni</option>
                                            <option value="Juli"
                                                {{ old('bulan', $laporanbencana->bulan) == 'Juli' ? 'selected' : '' }}>
                                                Juli</option>
                                            <option value="Agustus"
                                                {{ old('bulan', $laporanbencana->bulan) == 'Agustus' ? 'selected' : '' }}>
                                                Agustus</option>
                                            <option value="September"
                                                {{ old('bulan', $laporanbencana->bulan) == 'September' ? 'selected' : '' }}>
                                                September</option>
                                            <option value="Oktober"
                                                {{ old('bulan', $laporanbencana->bulan) == 'Oktober' ? 'selected' : '' }}>
                                                Oktober</option>
                                            <option value="November"
                                                {{ old('bulan', $laporanbencana->bulan) == 'November' ? 'selected' : '' }}>
                                                November</option>
                                            <option value="Desember"
                                                {{ old('bulan', $laporanbencana->bulan) == 'Desember' ? 'selected' : '' }}>
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
                                        <select class="form-control mt-1 @error('province_id') is-invalid @enderror"
                                            name="province_id" id="province_id">
                                            <option value="">:: Pilih ::</option>
                                            @foreach ($provinces as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('province_id', $laporanbencana->province_id) == $item->id ? 'selected' : '' }}>
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
                                        <select class="form-control mt-1 @error('district_id') is-invalid @enderror"
                                            name="district_id" id="district_id">
                                            <option value="">:: Pilih ::</option>
                                            @foreach ($districts as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('district_id', $laporanbencana->district_id) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
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
                                        <select class="form-control mt-1 @error('subdistrict_id') is-invalid @enderror"
                                            name="subdistrict_id" id="subdistrict_id">
                                            <option value="">:: Pilih ::</option>
                                            @foreach ($subdistricts as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('subdistrict_id', $laporanbencana->subdistrict_id) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
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
                                <label for="alamat">Tempat Kejadian</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror " name="alamat" id="alamat" rows="5">{{ old('alamat', $laporanbencana->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="kronologi">kronologi</label>
                                <textarea class="form-control @error('kronologi') is-invalid @enderror" name="kronologi" id="kronologi"
                                    rows="5">{{ old('kronologi', $laporanbencana->kronologi) }}</textarea>
                                @error('kronologi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="la_latitude">Latitude</label>
                                        <input type="text" name="la_latitude" id="la_latitude"
                                            class="form-control @error('la_latitude') is-invalid @enderror"
                                            value="{{ old('la_latitude', $laporanbencana->la_latitude ?? '') }}">
                                    </div>
                                    @error('la_latitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="la_longitude">Longitude</label>
                                        <input type="text" name="la_longitude" id="la_longitude"
                                            class="form-control @error('la_longitude') is-invalid @enderror"
                                            value="{{ old('la_longitude', $laporanbencana->la_longitude ?? '') }}">
                                    </div>
                                    @error('la_longitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 mb-3">
                                    <img src="{{ $laporanbencana->image1 ? '/storage/' . $laporanbencana->image1 : '/assets/img/noimage.jpeg' }}"
                                        class="img-thumbnail imagePreview1" width="100px">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="image1">Gambar 1</label>
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
                                    <img src="{{ $laporanbencana->image2 ? '/storage/' . $laporanbencana->image2 : '/assets/img/noimage.jpeg' }}"
                                        class="img-thumbnail imagePreview2" width="100px">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="image2">Gambar 2</label>
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
                            <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <select class="form-control mt-1 @error('status') is-invalid @enderror" name="status"
                                    id="status">
                                    <option value="Menunggu"
                                        {{ old('status', $laporanbencana->status) == 'Menunggu' ? 'selected' : '' }}>
                                        Menunggu
                                    </option>
                                    <option value="Diterima"
                                        {{ old('status', $laporanbencana->status) == 'Diterima' ? 'selected' : '' }}>
                                        Diterima
                                    </option>
                                    <option value="Ditolak"
                                        {{ old('status', $laporanbencana->status) == 'Ditolak' ? 'selected' : '' }}>
                                        Ditolak
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div id="map" style="width: 100%; height: 400px;" class="mb-4"></div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button class="btn btn-success">
                                            <a style="color:white;" target="_blank"
                                                href="http://www.google.com/maps/place/{{ $laporanbencana->la_latitude ?? '' }},{{ $laporanbencana->la_longitude ?? '' }}">Untuk
                                                Rute Klik Disini</a>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6" style="text-align: right">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Map -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('APIKEY_GOOGLEMAP') }}&callback=initMap"
        type="text/javascript"></script>

    <script>
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

        // map
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
@endsection
