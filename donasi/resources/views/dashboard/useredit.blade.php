@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        <a href="/dashboard/users" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                        {{ $title_bar }}
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/dashboard/users/{{ $user->id }}" method="post">
                            @csrf
                            @method('PUT')
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
                                        <input type="number" name="no_phone" id="no_phone"
                                            class="form-control mt-1 @error('no_phone') is-invalid @enderror"
                                            value="{{ old('no_phone', $user->no_phone) }}">
                                        @error('no_phone')
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
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="level_id">Level</label>
                                        <select name="level_id" id="level_id"
                                            class="form-control mt-1 @error('level_id') is-invalid @enderror">
                                            <option value="">:: Pilih ::</option>
                                            @foreach ($levels as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('level_id', $user->level_id) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('level_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status"
                                            class="form-control mt-1 @error('status') is-invalid @enderror">
                                            <option value="">:: Pilih ::</option>
                                            <option value="1"
                                                {{ old('status', $user->status) == '1' ? 'selected' : '' }}>Aktif
                                            </option>
                                            <option value="0"
                                                {{ old('status', $user->status) == '0' ? 'selected' : '' }}>Nonaktif
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password <small><em>(Biarkan kosong jika tidak ingin
                                            merubah)</em></small></label>
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
        // $(document).ready(function() {
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

        // Username Otomatis
        $(document).ready(function() {
            $('#username').on('keyup', function() {
                const username = $(this).val().toLowerCase().replace(/\W/g, '');
                $('#username').val(username);
            });

            const name = document.querySelector('#name');
            if (name) {
                name.addEventListener('change', function() {
                    fetch('/create/users/username?name=' + name.value)
                        .then(response => response.json())
                        .then(data => username.value = data.username)
                });
            }
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

        function addOption(inputId, val, text) {
            $('#' + inputId).append($('<option>').val(val).text(text));
        }
    </script>
@endsection
