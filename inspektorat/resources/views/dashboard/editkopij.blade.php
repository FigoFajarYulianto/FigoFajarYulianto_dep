@extends('dashboard.template')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title text-uppercase">
                    <a href="/dashboard/kopijs" class="mr-1"><i class="fa fa-arrow-circle-left"></i></a>
                    {{ $title_bar }}
                </div>
                <form action="/dashboard/kopijs/{{ $kopij->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="number" class="form-control mt-1 @error('nik') is-invalid @enderror"
                                    name="nik" id="nik" value="{{ old('nik', $kopij->nik) }}">
                                @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control mt-1 @error('nama') is-invalid @enderror"
                                    name="nama" id="nama" value="{{ old('nama', $kopij->nama) }}">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin"
                                    class="form-control mt-1 @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="">:: Pilih ::</option>
                                    <option value="1"
                                        {{ old('jenis_kelamin', $kopij->jenis_kelamin) == 1 ? 'selected' : '' }}>
                                        Laki-Laki
                                    </option>
                                    <option value="2"
                                        {{ old('jenis_kelamin', $kopij->jenis_kelamin) == 2 ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_wa">No. WhatsApp</label>
                                <input type="number" class="form-control mt-1 @error('nomor_wa') is-invalid @enderror"
                                    name="nomor_wa" id="nomor_wa" value="{{ old('nomor_wa', $kopij->nomor_wa) }}">
                                @error('nomor_wa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="judul">Perihal / Judul</label>
                        <input type="text" class="form-control mt-1 @error('judul') is-invalid @enderror" name="judul"
                            id="judul" value="{{ old('judul', $kopij->judul) }}">
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Keluhan / Konsultasi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="10"
                            class="form-control mt-1 @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $kopij->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-3 col-lg-3">
                                    @if ($kopij->file_ktp)
                                        <a href="/storage/{{ $kopij->file_ktp }}" target="_blank"><img class="img-fluid"
                                                src="/storage/{{ $kopij->file_ktp }}" alt="Foto KTP"></a>
                                    @else
                                        <img class="img-fluid" src="/assets/images/noimage.jpeg" alt="Foto KTP">
                                    @endif
                                </div>
                                <div class="col-sm-9 col-lg-9">
                                    <div class="form-group">
                                        <label for="file_ktp">Foto KTP (Wajib diisi)</label>
                                        <input type="file" name="file_ktp" id="file_ktp"
                                            class="form-control mt-1 @error('file_ktp') is-invalid @enderror">
                                        @error('file_ktp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-3 col-lg-3">
                                    @if ($kopij->file_kk)
                                        <a href="/storage/{{ $kopij->file_kk }}" target="_blank"><img class="img-fluid"
                                                src="/storage/{{ $kopij->file_kk }}" alt="Foto KTP"></a>
                                    @else
                                        <img class="img-fluid" src="/assets/images/noimage.jpeg" alt="Foto KTP">
                                    @endif
                                </div>
                                <div class="col-sm-9 col-lg-9">
                                    <div class="form-group">
                                        <label for="file_kk">Foto KK (Opsional)</label>
                                        <input type="file" name="file_kk" id="file_kk"
                                            class="form-control mt-1 @error('file_kk') is-invalid @enderror">
                                        @error('file_kk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-3 col-lg-3">
                                    @if ($kopij->file_lain1)
                                        <a href="/storage/{{ $kopij->file_lain1 }}" target="_blank">
                                            <img class="img-fluid" src="/storage/{{ $kopij->file_lain1 }}"
                                                alt="Foto KTP">
                                        </a>
                                    @else
                                        <img class="img-fluid" src="/assets/images/noimage.jpeg" alt="Foto Lainnya">
                                    @endif
                                </div>
                                <div class="col-sm-9 col-lg-9">
                                    <div class="form-group">
                                        <label for="file_lain1">Foto Lainnya (Jika ada)</label>
                                        <input type="file" name="file_lain1" id="file_lain1"
                                            class="form-control mt-1 @error('file_lain1') is-invalid @enderror">
                                        @error('file_lain1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-3 col-lg-3">
                                    @if ($kopij->file_lain2)
                                        <a href="/storage/{{ $kopij->file_lain2 }}" target="_blank">
                                            <img class="img-fluid" src="/storage/{{ $kopij->file_lain2 }}"
                                                alt="Foto KTP">
                                        </a>
                                    @else
                                        <img class="img-fluid" src="/assets/images/noimage.jpeg" alt="Foto Lainnya">
                                    @endif
                                </div>
                                <div class="col-sm-9 col-lg-9">
                                    <div class="form-group">
                                        <label for="file_lain2">Foto Lainnya (Jika ada)</label>
                                        <input type="file" name="file_lain2" id="file_lain2"
                                            class="form-control mt-1 @error('file_lain2') is-invalid @enderror">
                                        @error('file_lain2')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group my-3">
                        <label for="status_id">Status</label>
                        <select name="status_id" id="status_id"
                            class="form-control mt-1 @error('status_id') is-invalid @enderror">
                            <option value="">:: Pilih ::</option>
                            @foreach (\App\Models\Categorystatus::orderBy('name', 'ASC')->get() as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('status_id', $kopij->status_id) == $item->id ? 'selected' : '' }}>
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

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
