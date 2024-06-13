@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        {{ $title_bar }}
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/dashboard/profile/{{ $user->username }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <img src="{{ $user->photo ? '/storage/' . $user->photo : '/assets/img/noimage.jpeg' }}"
                                        class="img-thumbnail imagePreview" width="100px">
                                </div>
                                <div class="col-md-10 mb-3">
                                    <div class="form-group">
                                        <label for="photo">Photo Profil</label>
                                        <div class="input-group">
                                            <input type="file" name="photo" id="photo"
                                                class="form-control @error('photo') is-invalid @enderror"
                                                onchange="previewImage('photo', 'imagePreview')">
                                            @error('photo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name"
                                            type="text" id="name" value="{{ old('name', $user->name) }}" />
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input class="form-control mt-1 @error('username') is-invalid @enderror"
                                            name="username" type="text" id="username"
                                            value="{{ old('username', $user->username) }}" />
                                        @error('username')
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
                                        <label for="email">Email</label>
                                        <input class="form-control mt-1 @error('email') is-invalid @enderror" name="email"
                                            type="email" id="email" value="{{ old('email', $user->email) }}" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="telp">Telp</label>
                                        <input type="number" name="telp" id="telp"
                                            class="form-control mt-1 @error('telp') is-invalid @enderror"
                                            value="{{ old('telp', $user->telp) }}">
                                        @error('telp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="address">Alamat</label>
                                <textarea name="address" id="address" rows="5"class="form-control mt-1 @error('address') is-invalid @enderror">{{ old('address', $user->address) }}</textarea>
                                @error('address')
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
                                                    {{ old('province_id', $user->province_id) == $item->id ? 'selected' : '' }}>
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
                                                    {{ old('district_id', $user->district_id) == $item->id ? 'selected' : '' }}>
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
                                                    {{ old('subdistrict_id', $user->subdistrict_id) == $item->id ? 'selected' : '' }}>
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
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="atas_nama">Atas Nama</label>
                                        <input class="form-control mt-1 @error('atas_nama') is-invalid @enderror"
                                            name="atas_nama" type="text" id="atas_nama"
                                            value="{{ old('atas_nama', $banks->name ?? '') }}" />
                                        @error('atas_nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="bank">Bank</label>
                                        <input class="form-control mt-1 @error('bank') is-invalid @enderror"
                                            name="bank" type="text" id="bank"
                                            value="{{ old('bank', $banks->bank ?? '') }}" />
                                        @error('bank')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="nomor_rekening">Nomor Rekening</label>
                                        <input class="form-control mt-1 @error('nomor_rekening') is-invalid @enderror"
                                            name="nomor_rekening" type="text" id="nomor_rekening"
                                            value="{{ old('nomor_rekening', $banks->nomor ?? '') }}" />
                                        @error('nomor_rekening')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password <small>(Biarkan kosong jika tidak ingin
                                        mengganti)</small></label>
                                <input class="form-control mt-1 @error('password') is-invalid @enderror" name="password"
                                    type="password" id="password" />
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-1 mb-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#province_id').attr('data-live-search', true);
            $('#province_id').attr('data-width', '100%');
            $('#province_id').selectpicker();

            $('#district_id').attr('data-live-search', true);
            $('#district_id').attr('data-width', '100%');
            $('#district_id').selectpicker();

            $('#subdistrict_id').attr('data-live-search', true);
            $('#subdistrict_id').attr('data-width', '100%');
            $('#subdistrict_id').selectpicker();
        });

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
