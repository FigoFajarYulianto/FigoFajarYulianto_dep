@extends('dashboard.template')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card shadow">
                <div class="card-body">
                    <a href="/dashboard/users" class="me-2"><i class="fa fa-arrow-circle-left"></i></a>
                    <h4 class="card-title">Edit User</h4>
                    <form class="form-sample" action="/dashboard/users/{{ $user->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" value="{{ old('name', $user->name) }}" />
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control  @error('username') is-invalid @enderror"
                                            name="username" id="username" value="{{ old('username', $user->username) }}" />
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input class="form-control @error('email') is-invalid @enderror" name="email"
                                            type="email" placeholder="" id="email"
                                            value="{{ old('email', $user->email) }}" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Whatsapp</label>
                                    <div class="col-sm-9">
                                        <input class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp"
                                            placeholder="" type="number" id="whatsapp"
                                            value="{{ old('whatsapp', $user->whatsapp) }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Level</label>
                                    <div class="col-sm-9">
                                        <select name="level_id" id="level_id"
                                            class="form-control  @error('level_id') is-invalid @enderror">
                                            <option value="">:: Pilih ::</option>
                                            @foreach ($level as $row)
                                                <option value="{{ $row->id }}"
                                                    {{ old('level_id', $user->level_id) == $row->id ? 'selected' : '' }}>
                                                    {{ $row->nama }}
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select name="status" id="status"
                                            class="form-control @error('status') is-invalid @enderror">
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
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col mr-5">Password</label>
                                    <div class="col-sm-12">
                                        <input class="form-control @error('password') is-invalid @enderror" name="password"
                                            type="password" id="password"
                                            value="{{ old('password', $user->password) }}" />
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
