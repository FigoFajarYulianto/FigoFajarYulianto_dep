@extends('dashboard.template')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title text-uppercase">
                    {{ $title_bar }}
                </div>
                <form action="/dashboard/settings/{{ $settings->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="name">Judul</label>
                        <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name" type="text"
                            id="name" value="{{ old('name', $settings->name) }}" />
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <img src="{{ $settings->main_logo ? '/storage/' . $settings->main_logo : '/admin/img/noimage.jpeg' }}"
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
                            <img src="{{ $settings->sec_logo ? '/storage/' . $settings->sec_logo : '/admin/img/noimage.jpeg' }}"
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
                            <img src="{{ $settings->favicon ? '/storage/' . $settings->favicon : '/admin/img/noimage.jpeg' }}"
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
                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $settings->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Alamat</label>
                        <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', $settings->address) }}</textarea>
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
                                    value="{{ old('email', $settings->email) }}">
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
                                    value="{{ old('telp', $settings->telp) }}">
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
                                    value="{{ old('facebook', $settings->facebook) }}">
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
                                    value="{{ old('instagram', $settings->instagram) }}">
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
                                    value="{{ old('youtube', $settings->youtube) }}">
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
                                    value="{{ old('twitter', $settings->twitter) }}">
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
                                    value="{{ old('whatsapp', $settings->whatsapp) }}">
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
                                    value="{{ old('telegram', $settings->telegram) }}">
                                @error('telegram')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="map">iFrame Google Map</label>
                        <textarea name="map" id="map" rows="10" class="form-control @error('map') is-invalid @enderror">{{ old('map', $settings->map) }}</textarea>
                        @error('map')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="code">Script Tag</label>
                        <textarea name="code" id="code" rows="10" class="form-control @error('code') is-invalid @enderror">{{ old('code', $settings->code) }}</textarea>
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
