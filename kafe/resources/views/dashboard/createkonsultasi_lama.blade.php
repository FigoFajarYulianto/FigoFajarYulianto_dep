@extends('dashboard.template')
@section('content')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card shadow">
            <div class="card-body">
                <a href="/dashboard/konsultasi" class="me-2"><i class="fa fa-arrow-circle-left"></i></a>
                <h4 class="card-title">Tambah Konsultasi</h4>
                <form class="form-sample" action="/dashboard/konsultasi/create" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="nomor">Nomor</label>
                                <input type="number" name="nomor" id="nomor" class="form-control" value="{{ old('nomor') }}">
                                @error('nomor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}">
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="whatsapp">Whatsapp</label>
                                <input type="number" name="whatsapp" id="whatsapp" class="form-control" value="{{ old('whatsapp') }}">
                                @error('whatsapp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <input class="form-control mt-1 @error('alamat') is-invalid @enderror" name="alamat" type="text" id="alamat" value="{{ old('alamat') }}" />
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label" for="categoryconsultation_id">Kategori
                                    Konsultasi</label>
                                <div class="col-sm-12">
                                    <select class="form-control mt-1 @error('categoryconsultation_id') is-invalid @enderror" name="categoryconsultation_id" id="categoryconsultation_id">
                                        <option value="">:: Pilih ::</option>
                                        @foreach ($category as $item)
                                        <option value="{{ $item->id }}" {{ old('categoryconsultation_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('categoryconsultation_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label" for="statusconsultation_id">Status
                                    Konsultasi</label>
                                <div class="col-sm-12">
                                    <select class="form-control mt-1 @error('statusconsultation_id') is-invalid @enderror" name="statusconsultation_id" id="statusconsultation_id">
                                        <option value="">:: Pilih ::</option>
                                        @foreach ($status as $item)
                                        <option value="{{ $item->id }}" {{ old('statusconsultation_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('statusconsultation_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="judul">Judul</label>
                        <input class="form-control mt-1 @error('judul') is-invalid @enderror" name="judul" type="text" id="judul" value="{{ old('judul') }}" />
                        @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="pesan">Pesan</label>
                        <textarea class="form-control @error('pesan') is-invalid @enderror " name="pesan" id="pesan" rows="5"></textarea>
                        @error('pesan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="lampiran">Lampiran</label>
                        <textarea class="form-control @error('lampiran') is-invalid @enderror " name="lampiran" id="lampiran" rows="5"></textarea>
                        @error('lampiran')
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
@endsection