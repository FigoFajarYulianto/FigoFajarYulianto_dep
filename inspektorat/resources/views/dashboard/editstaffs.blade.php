@extends('dashboard.template')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title text-uppercase">
                    <a href="/dashboard/staffs" class="mr-1"><i class="fa fa-arrow-circle-left"></i></a>
                    {{ $title_bar }}
                </div>
                <form class="form-sample" action="/dashboard/staffs/{{ $staff->id }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label for="nama">Nama</label>
                                <input class="form-control mt-1 @error('nama') is-invalid @enderror" name="nama"
                                    type="text" id="nama" value="{{ old('nama', $staff->nama) }}" />
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label for="nip">Nip</label>
                                <input class="form-control mt-1 @error('nip') is-invalid @enderror" name="nip"
                                    type="number" id="nip" value="{{ old('nip', $staff->nip) }}" />
                                @error('nip')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="jabatan">Jabatan</label>
                                <input class="form-control mt-1 @error('jabatan') is-invalid @enderror" name="jabatan"
                                    type="text" id="jabatan" value="{{ old('jabatan', $staff->jabatan) }}" />
                                @error('jabatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{--  <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="kualifikasi">Kualifikasi</label>
                                    <input class="form-control mt-1 @error('kualifikasi') is-invalid @enderror"
                                        name="kualifikasi" type="text" id="kualifikasi"
                                        value="{{ old('kualifikasi', $staff->kualifikasi) }}" />
                                    @error('kualifikasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>  --}}
                    </div>
                    <div class="form-group mb-3">
                        <label for="kualifikasi">Kualifikasi</label>
                        <textarea class="ckeditor form-control @error('body') is-invalid @enderror" name="kualifikasi" id="body"
                            rows="3">{{ old('body', $staff->kualifikasi) }}</textarea>
                        @error('kualifikasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-2 mb-3">
                            <img src="{{ $staff->foto ? '/storage/' . $staff->foto : '/admin/img/noimage.jpeg' }}"
                                class="img-thumbnail fotoPreview" width="100px">
                        </div>
                        <div class="col-md-10 mb-3">
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <div class="input-group">
                                    <input type="file" name="foto" id="foto"
                                        class="form-control @error('foto') is-invalid @enderror"
                                        onchange="previewImage('foto', 'fotoPreview')">
                                    @error('foto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-5">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="">:: Pilih ::</option>
                            <option value="1" {{ old('status', $staff->status) == '1' ? 'selected' : '' }}>Aktif
                            </option>
                            <option value="0" {{ old('status', $staff->status) == '0' ? 'selected' : '' }}>Nonaktif
                            </option>
                        </select>
                        @error('status')
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
