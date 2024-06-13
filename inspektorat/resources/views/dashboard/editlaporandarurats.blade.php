@extends('dashboard.template')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title text-uppercase">
                    <a href="/dashboard/laporandarurats" class="mr-1"><i class="fa fa-arrow-circle-left"></i></a>
                    {{ $title_bar }}
                </div>
                <div class="card-body">
                    <form action="/dashboard/laporandarurats/{{ $laporandarurat->id }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $laporandarurat->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nik">Nik</label>
                                    <input type="number" name="nik" id="nik"
                                        class="form-control @error('nik') is-invalid @enderror"
                                        value="{{ old('nik', $laporandarurat->nik) }}">
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
                                    <label for="telepon">Telepon</label>
                                    <input type="number" name="telepon" id="telepon"
                                        class="form-control @error('telepon') is-invalid @enderror"
                                        value="{{ old('telepon', $laporandarurat->telepon) }}">
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
                                        value="{{ old('pukul', $laporandarurat->pukul) }}">
                                </div>
                                @error('pukul')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal"
                                        class="form-control @error('tanggal') is-invalid @enderror"
                                        value="{{ old('tanggal', $laporandarurat->tanggal) }}">
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
                                    <input type="hari" name="hari" id="hari"
                                        class="form-control @error('hari') is-invalid @enderror"
                                        value="{{ old('hari', $laporandarurat->hari) }}">
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
                                                {{ old('kecamatan_id', $laporandarurat->kecamatan->id ?? '') == $item->id ? 'selected' : '' }}>
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
                                        @foreach (\App\Models\Desa::orderBy('name', 'ASC')->get() as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('desa_id', $laporandarurat->desa->id ?? '') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('desa_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror " name="alamat" id="alamat" rows="5">{{ old('alamat', $laporandarurat->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="judul">Judul Pengaduan</label>
                            <input type="text" name="judul" id="judul"
                                class="form-control @error('judul') is-invalid @enderror"
                                value="{{ old('judul', $laporandarurat->judul) }}">
                            @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="kronologi">Penjelasan Pengaduan</label>
                            <textarea class="form-control @error('kronologi') is-invalid @enderror" name="kronologi" id="kronologi"
                                rows="5">{{ old('kronologi', $laporandarurat->kronologi) }}</textarea>
                            @error('kronologi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        {{--
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="la_latitude">Latitude</label>
                                        <input type="text" name="la_latitude" id="la_latitude"
                                            class="form-control @error('la_latitude') is-invalid @enderror"
                                            value="{{ old('la_latitude', $laporandarurat->la_latitude ?? '') }}">
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
                                            value="{{ old('la_longitude', $laporandarurat->la_longitude ?? '') }}">
                                    </div>
                                    @error('la_longitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>  --}}




                        <div class="row">
                            <div class="col-sm-2 mb-3">
                                <img src="{{ $laporandarurat->image1 ? '/storage/' . $laporandarurat->image1 : '/assets/images/profile.png' }}"
                                    class="img-thumbnail imagePreview1" width="100px">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="image1">Foto KTP</label>
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
                                <img src="{{ $laporandarurat->image2 ? '/storage/' . $laporandarurat->image2 : '/assets/images/profile.png' }}"
                                    class="img-thumbnail imagePreview2" width="100px">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="image2">Foto KK</label>
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

                        <div class="row">
                            <div class="col-sm-2 mb-3">
                                <img src="{{ $laporandarurat->image3 ? '/storage/' . $laporandarurat->image3 : '/assets/images/profile.png' }}"
                                    class="img-thumbnail imagePreview3" width="100px">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="image3">Foto Lainnya</label>
                                    <div class="input-group">
                                        <input type="file" name="image3" id="image3"
                                            class="form-control @error('desktop') is-invalid @enderror"
                                            onchange="previewImage('image3', 'imagePreview3')">
                                        @error('image3')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-2 mb-3">
                                <img src="{{ $laporandarurat->image4 ? '/storage/' . $laporandarurat->image4 : '/assets/images/profile.png' }}"
                                    class="img-thumbnail imagePreview4" width="100px">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="image4">Foto Lainnya</label>
                                    <div class="input-group">
                                        <input type="file" name="image4" id="image4"
                                            class="form-control @error('desktop') is-invalid @enderror"
                                            onchange="previewImage('image4', 'imagePreview4')">
                                        @error('image4')
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
                            <select class="form-control mt-1 @error('status_id') is-invalid @enderror" name="status_id"
                                id="status_id">
                                <option value="">:: Pilih Status ::</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('status_id', $laporandarurat->status->id ?? '') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi"
                                rows="5">{{ old('deskripsi', $laporandarurat->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </form>
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
    </script>


    <!-- Map -->
    {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('APIKEY_GOOGLEMAP') }}&callback=initMap"
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
    </script> --}}
@endsection
