@extends('fronts.template')
@section('content')
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

    <section id="kelurahan" class="atf-contact-area atf-section-padding pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-5" style="vertical-align: top;" align="center">
                    <img class="img-fluid rounded shadow"
                        src="{{ $staff->foto ? '/storage/' . $staff->foto : '/assets/images/noimage.jpeg' }}"
                        alt="">
                </div>
                <div class="col-md-9 mb-5">
                    <table class="table table-bordered small">
                        <tbody>
                            <tr>
                                <td align="left" class="text-uppercase"><strong>Nama</strong></td>
                                <td align="left">{{ old('nama', $staff->nama) }}</td>
                            </tr>
                            <tr>
                                <td align="left" class="text-uppercase"><strong>Nip</strong></td>
                                <td align="left">{{ old('nip', $staff->nip) }}</td>
                            </tr>
                            <tr>
                                <td align="left" class="text-uppercase"><strong>Jabatan</strong></td>
                                <td align="left">{{ old('jabatan', $staff->jabatan) }}</td>
                            </tr>
                            <tr>
                                <td align="left" class="text-uppercase"><strong>Kualifikasi</strong></td>
                                <td align="left">{!! $staff->kualifikasi !!}</td>
                            </tr>
                            <tr>
                                <td align="left" class="text-uppercase"><strong>Status</strong></td>
                                <td align="left">{{ $staff->status ==  1 ? 'Aktif' : 'Nonaktif' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
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

    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
