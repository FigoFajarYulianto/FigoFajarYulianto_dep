@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        <a href="/dashboard/campaigns" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                        {{ $title_bar }}
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/dashboard/campaigns/{{ $campaign->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="title">Judul</label>
                                <input class="form-control mt-1 @error('title') is-invalid @enderror" name="title"
                                    type="text" id="title" value="{{ old('title', $campaign->title) }}" />
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="category_id">Kategori</label>
                                <select name="category_id" id="category_id"
                                    class="form-control mt-1 @error('category_id') is-invalid @enderror">
                                    <option value="">:: Pilih ::</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category_id', $campaign->category_id) == $item->id ? 'selected' : '' }}>
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
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="province_id">Provinsi</label>
                                        <select name="province_id" id="province_id"
                                            class="form-control mt-1 @error('province_id') is-invalid @enderror">
                                            <option value="">:: Pilih ::</option>
                                            @foreach ($provinces as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('province_id', $campaign->province_id) == $item->id ? 'selected' : '' }}>
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
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="status">Kabupaten</label>
                                        <select name="district_id" id="district_id"
                                            class="form-control mt-1 @error('district_id') is-invalid @enderror">
                                            <option value="">:: Pilih ::</option>
                                            @foreach ($districts as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('district_id', $campaign->district_id) == $item->id ? 'selected' : '' }}>
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
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="status">Kecamatan</label>
                                        <select name="subdistrict_id" id="subdistrict_id"
                                            class="form-control mt-1 @error('subdistrict_id') is-invalid @enderror">
                                            <option value="">:: Pilih ::</option>
                                            @foreach ($subdistricts as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('subdistrict_id', $campaign->subdistrict_id) == $item->id ? 'selected' : '' }}>
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
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="nominal">Nominal</label>
                                        <input class="form-control mt-1 @error('nominal') is-invalid @enderror"
                                            name="nominal" type="text" id="nominal"
                                            value="{{ old('nominal', $campaign->nominal) }}"
                                            onkeyup="strToNum('nominal')" />
                                        @error('nominal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="waktu_tenggat">Batas Waktu</label>
                                        <input class="form-control mt-1 @error('waktu_tenggat') is-invalid @enderror"
                                            name="waktu_tenggat" type="date" id="waktu_tenggat"
                                            value="{{ old('waktu_tenggat', $campaign->waktu_tenggat) }}" />
                                        @error('waktu_tenggat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <img src="{{ $campaign->image ? '/storage/' . $campaign->image : '/assets/img/noimage.jpeg' }}"
                                        class="img-thumbnail imagePreview" width="100px">
                                </div>
                                <div class="col-md-10 mb-3">
                                    <div class="form-group">
                                        <label for="image">Gambar</label>
                                        <div class="input-group">
                                            <input type="file" name="image" id="image"
                                                class="form-control @error('image') is-invalid @enderror"
                                                onchange="previewImage('image', 'imagePreview')">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="body">Deskripsi</label>
                                <textarea class="ckeditor form-control @error('description') is-invalid @enderror" name="description" id="body">{{ old('description', $campaign->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @if (auth()->user()->level_id == 1)
                                <div class="form-group mb-3">
                                    <label for="status_id">Status</label>
                                    <select name="status_id" id="status_id"
                                        class="form-control mt-1 @error('status_id') is-invalid @enderror"
                                        {{ auth()->user()->id != 1 ?? '' }}>
                                        <option value="">:: Pilih ::</option>
                                        @foreach ($statuses as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('status_id', $campaign->status_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary mb-2 mt-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // $(document).ready(function() {
        //     $('#category_id').attr('data-live-search', true);
        //     $('#category_id').attr('data-width', '100%');
        //     $('#category_id').selectpicker();

        //     $('#province_id').attr('data-live-search', true);
        //     $('#province_id').attr('data-width', '100%');
        //     $('#province_id').selectpicker();

        //     $('#district_id').attr('data-live-search', true);
        //     $('#district_id').attr('data-width', '100%');
        //     $('#district_id').selectpicker();

        //     $('#subdistrict_id').attr('data-live-search', true);
        //     $('#subdistrict_id').attr('data-width', '100%');
        //     $('#subdistrict_id').selectpicker();
        // });

        formatStrNum('nominal');

        function previewImage(fieldId, previewClass) {
            const image = document.querySelector('#' +
                fieldId);
            const imgPreview = document.querySelector('.' + previewClass);

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(img) {
                imgPreview.src = img.target.result;
            }
        }

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
    </script>
@endsection
