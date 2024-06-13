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
                        <form action="/dashboard/users" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name"
                                            type="text" id="name" value="{{ old('name') }}" />
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
                                            name="username" type="text" id="username" value="{{ old('username') }}" />
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
                                            type="email" id="email" value="{{ old('email') }}" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="no_phone">Telp</label>
                                        <input type="number" name="no_phone" id="no_phone"
                                            class="form-control mt-1 @error('no_phone') is-invalid @enderror"
                                            value="{{ old('no_phone') }}">
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
                                <textarea name="address" id="address" rows="5"class="form-control mt-1 @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                                    {{ old('level_id') == $item->id ? 'selected' : '' }}>
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
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif
                                            </option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Nonaktif
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
                                <label for="password">Password</label>
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