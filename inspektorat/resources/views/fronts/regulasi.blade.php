@extends('fronts.template')
@section('content')
    <style>
        .expandable-table thead tr th {
            background: rgba(14, 29, 52, 0.9);
            padding: 10px;
            color: #ffffff;
            font-size: 14px;
        }

        .expandable-table thead tr th:first-child {
            border-radius: 8px 0 0 8px;
        }

        .expandable-table thead tr th:last-child {
            border-radius: 0 8px 8px 0;
        }

        .expandable-table tr.odd,
        .expandable-table tr.even {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.03);
            border-radius: 4px;
        }

        .expandable-table tr td {
            padding: -100px;
            font-size: 14px;
        }

        .expandable-table tr td.select-checkbox {
            padding-left: 26px;
        }

        .expandable-table tr td.select-checkbox:after {
            top: 2rem;
        }

        .expandable-table tr td.select-checkbox:before {
            top: 2rem;
        }

        .expandable-table tr td .cell-hilighted {
            background-color: #4B49AC;
            border-radius: 10px;
            padding: 1px;
            color: #fff;
            font-size: 11px;
        }

        .expandable-table tr td .cell-hilighted h5 {
            font-size: 20px;
            color: #52C4FF;
        }

        .expandable-table tr td .cell-hilighted p {
            opacity: .6;
            margin-bottom: 0;
        }

        .expandable-table tr td .cell-hilighted h6 {
            font-size: 14px;
            color: #52C4FF;
        }

        .expandable-table tr td .expanded-table-normal-cell {
            padding: 10px;
        }

        .expandable-table tr td .expanded-table-normal-cell p {
            font-size: 11px;
            margin-bottom: 0;
        }

        .expandable-table tr td .expanded-table-normal-cell h6 {
            color: #0B0F32;
            font-size: 14px;
        }

        .expandable-table tr td .expanded-table-normal-cell .highlighted-alpha {
            width: 34px;
            height: 34px;
            border-radius: 100%;
            background: #FE5C83;
            color: #ffffff;
            text-align: center;
            padding-top: 7px;
            font-size: 14px;
            margin-right: -8px;
        }

        .expandable-table tr td .expanded-table-normal-cell img {
            width: 34px;
            height: 34px;
            border-radius: 100%;
            margin-right: -8px;
        }

        .expandable-table tr td.details-control:before {
            content: '\e64b';
            font-family: "themify";
        }

        .expandable-table tr.shown td.details-control:before {
            content: '\e648';
        }

        .expandable-table .expanded-row {
            background: #fafafa;
        }
    </style>



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

    <div class="contact-area pb-70 pt-4">
        <div class="container">

            <form action="{{ route('advance_search_regulasi') }}" method="GET">
                <div class="form-group row">
                    <div class="col-sm-6 mb-2">
                        <div class="mb-2">
                            <label for="peraturan_id">Kategori</label>
                        </div>
                        <select class="form-control mt-1 @error('peraturan_id') is-invalid @enderror" name="peraturan_id"
                            id="peraturan_id">
                            <option value="">:: Pilih ::</option>
                            <?php $peraturans = \App\Models\Categoriperaturan::orderBy('name', 'ASC')->get(); ?>
                            @foreach ($peraturans as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('peraturan_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('peraturan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-2">
                            Judul
                        </div>
                        <div class="col-auto">
                            <input type="text" name="judul" class="form-control">
                        </div>

                    </div>
                </div>
                <center>
                    <input style="background-color:rgba(14, 29, 52, 0.9); color:white;" type="submit" value="Search"
                        class="btn mt-3 mb-5">
                </center>
            </form>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="display expandable-table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Keterangan</th>
                                    <th>Unduh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($regulasis as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $row->judul }}
                                        </td>
                                        <td>
                                            {{ $row->peraturan->name ?? '' }}
                                        </td>
                                        <td>{{ $row->keterangan }}</td>
                                        <td> <a href="/regulasidownload/{{ $row->id }}" class="btn btn-secondary btn-sm mt-1"
                                                style="background-color: rgba(14, 29, 52, 0.9)" target='_blank'>
                                                Unduh
                                            </a></td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right">
                            {{ $regulasis->links() }}
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
