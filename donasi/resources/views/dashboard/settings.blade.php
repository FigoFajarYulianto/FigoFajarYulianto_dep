@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <form action="/dashboard/settings/{{ $setting->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Judul</label>
                                <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name"
                                    type="text" id="name" value="{{ old('name', $setting->name) }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="harga_emas">Harga Emas (gr)</label>
                                <input class="form-control mt-1 @error('harga_emas') is-invalid @enderror" name="harga_emas"
                                    type="text" id="harga_emas" onkeyup="strToNum('harga_emas')"
                                    value="{{ old('harga_emas', $setting->harga_emas) }}" />
                                @error('harga_emas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <img src="{{ $setting->main_logo ? '/storage/' . $setting->main_logo : '/assets/img/noimage.jpeg' }}"
                                class="img-thumbnail main_logoPreview" width="100px">
                        </div>
                        <div class="col-md-10 mb-3">
                            <div class="form-group">
                                <label for="main_logo">Logo Utama (Header)</label>
                                <div class="input-group">
                                    <input type="file" name="main_logo" id="main_logo"
                                        class="form-control @error('main_logo') is-invalid @enderror"
                                        onchange="previewImage('main_logo', 'main_logoPreview')">
                                    @error('main_logo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <img src="{{ $setting->sec_logo ? '/storage/' . $setting->sec_logo : '/assets/img/noimage.jpeg' }}"
                                class="img-thumbnail sec_logoPreview" width="100px">
                        </div>
                        <div class="col-md-10 mb-3">
                            <div class="form-group">
                                <label for="sec_logo">Logo Kedua (Footer)</label>
                                <div class="input-group">
                                    <input type="file" name="sec_logo" id="sec_logo"
                                        class="form-control @error('sec_logo') is-invalid @enderror"
                                        onchange="previewImage('sec_logo', 'sec_logoPreview')">
                                    @error('sec_logo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <img src="{{ $setting->favicon ? '/storage/' . $setting->favicon : '/assets/img/noimage.jpeg' }}"
                                class="img-thumbnail faviconPreview" width="100px">
                        </div>
                        <div class="col-md-10 mb-3">
                            <div class="form-group">
                                <label for="favicon">Favicon</label>
                                <div class="input-group">
                                    <input type="file" name="favicon" id="favicon"
                                        class="form-control @error('favicon') is-invalid @enderror"
                                        onchange="previewImage('favicon', 'faviconPreview')">
                                    @error('favicon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" id="description" rows="5"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $setting->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Alamat</label>
                        <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', $setting->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $setting->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="telp">Telp</label>
                                <input type="number" name="telp" id="telp"
                                    class="form-control @error('telp') is-invalid @enderror"
                                    value="{{ old('telp', $setting->telp) }}">
                                @error('telp')
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
                                <label for="facebook">Facebook (URL)</label>
                                <input type="text" name="facebook" id="facebook"
                                    class="form-control @error('facebook') is-invalid @enderror"
                                    value="{{ old('facebook', $setting->facebook) }}">
                                @error('facebook')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="instagram">Instagram (URL)</label>
                                <input type="text" name="instagram" id="instagram"
                                    class="form-control @error('instagram') is-invalid @enderror"
                                    value="{{ old('instagram', $setting->instagram) }}">
                                @error('instagram')
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
                                <label for="youtube">Youtube (URL)</label>
                                <input type="text" name="youtube" id="youtube"
                                    class="form-control @error('youtube') is-invalid @enderror"
                                    value="{{ old('youtube', $setting->youtube) }}">
                                @error('youtube')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="twitter">Twitter (URL)</label>
                                <input type="text" name="twitter" id="twitter"
                                    class="form-control @error('twitter') is-invalid @enderror"
                                    value="{{ old('twitter', $setting->twitter) }}">
                                @error('twitter')
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
                                <label for="whatsapp">WhatsApp</label>
                                <input type="number" name="whatsapp" id="whatsapp"
                                    class="form-control @error('whatsapp') is-invalid @enderror"
                                    value="{{ old('whatsapp', $setting->whatsapp) }}">
                                @error('whatsapp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="telegram">Telegram (URL)</label>
                                <input type="text" name="telegram" id="telegram"
                                    class="form-control @error('telegram') is-invalid @enderror"
                                    value="{{ old('telegram', $setting->telegram) }}">
                                @error('telegram')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group mb-3">
                        <b><label for="map">Google Map</label></b>
                        <div class="row" style="text-align: left">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" name="latitude" id="latitude"
                                        class="form-control @error('latitude') is-invalid @enderror"
                                        value="{{ old('latitude', $setting->latitude) }}">
                                    @error('latitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" name="longitude" id="longitude"
                                        class="form-control @error('longitude') is-invalid @enderror"
                                        value="{{ old('longitude', $setting->longitude) }}">
                                    @error('longitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div id="map" style="width: 100%; height: 550px;"></div>
                    </div> --}}
                    <div class="form-group mb-3">
                        <label for="code">Script Tag</label>
                        <textarea name="code" id="code" rows="10" class="form-control @error('code') is-invalid @enderror">{{ old('code', $setting->code) }}</textarea>
                        @error('code')
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
@endsection

@section('script')
    <script>
        formatStrNum('harga_emas');

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
    </script>
@endsection
