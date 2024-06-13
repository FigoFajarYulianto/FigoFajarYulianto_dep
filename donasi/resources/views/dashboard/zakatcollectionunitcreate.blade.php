@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        <a href="/dashboard/zakatcollectionunits" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                        {{ $title_bar }}
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/dashboard/zakatcollectionunits" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Nama</label>
                                <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name"
                                    type="text" id="name" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="province_id">Provinsi</label>
                                        <select required name="province_id" id="province_id"
                                            class="form-control mt-1 @error('province_id') is-invalid @enderror">
                                            <option value="">:: Pilih ::</option>
                                            @foreach ($provinces as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('province_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="district_id">Kabupaten</label>
                                        <select required name="district_id" id="district_id"
                                            class="form-control mt-1 @error('district_id') is-invalid @enderror">
                                            <option value="">:: Pilih ::</option>
                                        </select>
                                        @error('district_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="subdistrict_id">Kecamatan</label>
                                        <select required name="subdistrict_id" id="subdistrict_id"
                                            class="form-control mt-1 @error('subdistrict_id') is-invalid @enderror">
                                            <option value="">:: Pilih ::</option>
                                        </select>
                                        @error('subdistrict_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}
                            <div class="form-group mb-3">
                                <label for="name">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="kontak">Kontak</label>
                                <input class="form-control mt-1 @error('kontak') is-invalid @enderror" name="kontak"
                                    type="text" id="kontak" value="{{ old('kontak') }}" />
                                @error('kontak')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="lokasi">Embed Lokasi</label>
                                <textarea class="form-control mt-1 @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" cols="30"
                                    rows="10">{{ old('lokasi') }}</textarea>
                                @error('lokasi')
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
    </div>
@endsection

@section('script')
    <script>
        // $('#province_id option').prop('selected', false);
        // $('#district_id option').prop('selected', false);
        // $('#subdistrict_id option').prop('selected', false);

        // // Filter Province
        // $(document).on('change', '#province_id', function() {
        //     const id = $(this).val();
        //     if (id) {
        //         $.ajax({
        //             url: '/api/districts/' + id,
        //             method: 'get',
        //             dataType: 'json',
        //             success: function(response) {
        //                 console.log(response);
        //                 $('#district_id').children().remove();
        //                 $('#district_id').append($('<option>').val('').text(':: Pilih ::'));
        //                 for (let i = 0; i < response.length; i++) {
        //                     const item = response[i];
        //                     addOption('district_id', item.id, item.name);
        //                 }
        //             }
        //         });
        //     } else {
        //         $('#district_id').children().remove();
        //         $('#district_id').append($('<option>').val('').text(':: Pilih ::'));
        //     }
        // });

        // // Filter District
        // $(document).on('change', '#district_id', function() {
        //     const id = $(this).val();
        //     if (id) {
        //         $.ajax({
        //             url: '/api/subdistricts/' + id,
        //             method: 'get',
        //             dataType: 'json',
        //             success: function(response) {
        //                 console.log(response);
        //                 $('#subdistrict_id').children().remove();
        //                 $('#subdistrict_id').append($('<option>').val('').text(':: Pilih ::'));
        //                 for (let i = 0; i < response.length; i++) {
        //                     const item = response[i];
        //                     addOption('subdistrict_id', item.id, item.name);
        //                 }
        //             }
        //         });
        //     } else {
        //         $('#subdistrict_id').children().remove();
        //         $('#subdistrict_id').append($('<option>').val('').text(':: Pilih ::'));
        //     }
        // });

        // function addOption(inputId, val, text) {
        //     console.log(text);
        //     $('#' + inputId).append($('<option>').val(val).text(text));
        // }
    </script>
@endsection
