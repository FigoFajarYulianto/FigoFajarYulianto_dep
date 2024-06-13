@extends('dashboard.template')
@section('content')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card shadow">
            <div class="card-body">
                <a href="/dashboard/konsultasi" class="me-2"><i class="fa fa-arrow-circle-left"></i></a>
                <h4 class="card-title">Edit Konsultasi</h4>
                <form class="form-sample" action="/dashboard/konsultasi/{{ $consultation->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="nomor">Nomor</label>
                                <input readonly type="text" name="nomor" id="nomor" class="form-control" value="{{ old('nomor', $consultation->nomor) }}">
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
                                <input readonly type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $consultation->nama) }}">
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
                                <input readonly type="number" name="whatsapp" id="whatsapp" class="form-control" value="{{ old('whatsapp', $consultation->whatsapp) }}">
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
                        <input readonly class="form-control mt-1 @error('alamat') is-invalid @enderror" name="alamat" type="text" id="alamat" value="{{ old('alamat', $consultation->alamat) }}" />
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
                                        <option value="{{ $item->id }}" {{ old('categoryconsultation_id', $consultation->categoryconsultation_id ?? '') == $item->id ? 'selected' : '' }}>
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
                                        <option value="{{ $item->id }}" {{ old('statusconsultation_id', $consultation->statusconsultation_id ?? '') == $item->id ? 'selected' : '' }}>
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
                        <input readonly class="form-control mt-1 @error('judul') is-invalid @enderror" name="judul" type="text" id="judul" value="{{ old('judul', $consultation->judul) }}" />
                        @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="pesan">Pesan</label>
                        <textarea readonly class="form-control @error('pesan') is-invalid @enderror " name="pesan" id="pesan" rows="5">{{ old('pesan', $consultation->pesan) }}</textarea>
                        @error('pesan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="lampiran">Lampiran</label>
                        <textarea readonly class="form-control @error('lampiran') is-invalid @enderror " name="lampiran" id="lampiran" rows="5">{{ old('lampiran', $consultation->lampiran) }}</textarea>
                        @error('lampiran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="jawaban">Balas</label>
                        <textarea name="jawaban" id="jawaban" class="form-control" cols="30" rows="10">{{ old('jawaban', $consultation->jawaban) }}</textarea>
                        @error('jawaban')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                </form>
            </div>

            @foreach ($consultation->consultationreplies as $item)
            <div class="col-md-12">
                <div class="form-group">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h4 class="my-0 small">
                                <i class="fa fa-user-circle-o"></i> {{ $item->user->name ?? $consultation->name }}
                                <span class="float-end small">
                                    {{ date('d/m/Y H:i', strtotime($item->created_at)) }}
                                </span>
                            </h4>
                        </div>
                        <div class="card-body">
                            <p class="my-0">{{ $item->jawaban }}</p>
                        </div>
                        <div class="card-footer">
                            <form action="/dashboard/konsultasi/reply/{{ $item->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm fa fa-trash" onclick="return confirm('Yakin ingin melanjutkan?')"><i data-feather="trash-2"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</div>
@endsection