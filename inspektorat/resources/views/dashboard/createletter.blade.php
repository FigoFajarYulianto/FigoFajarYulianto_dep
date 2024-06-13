@extends('dashboard.template')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title text-uppercase">
                    <a href="/dashboard/letters" class="mr-1"><i class="fa fa-arrow-circle-left"></i></a>
                    {{ $title_bar }}
                </div>
                <form action="/dashboard/letters" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pengirim_opd">Pengirim OPD</label>
                                <input type="text" class="form-control mt-1 @error('pengirim_opd') is-invalid @enderror"
                                    name="pengirim_opd" id="pengirim_opd" value="{{ old('pengirim_opd') }}">
                                @error('pengirim_opd')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pengirim_nonopd">Pengirim Non OPD</label>
                                <input type="text"
                                    class="form-control mt-1 @error('pengirim_nonopd') is-invalid @enderror"
                                    name="pengirim_nonopd" id="pengirim_nonopd" value="{{ old('pengirim_nonopd') }}">
                                @error('pengirim_nonopd')
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
                                <label for="tgl_surat">Tanggal Surat</label>
                                <input type="date" class="form-control mt-1 @error('tgl_surat') is-invalid @enderror"
                                    name="tgl_surat" id="tgl_surat" value="{{ old('tgl_surat') }}">
                                @error('tgl_surat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_diterima">Tanggal Diterima</label>
                                <input type="date" class="form-control mt-1 @error('tgl_diterima') is-invalid @enderror"
                                    name="tgl_diterima" id="tgl_diterima" value="{{ old('tgl_diterima', date('Y-m-d')) }}">
                                @error('tgl_diterima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat</label>
                        <input type="text" class="form-control mt-1 @error('nomor_surat') is-invalid @enderror"
                            name="nomor_surat" id="nomor_surat" value="{{ old('nomor_surat') }}">
                        @error('nomor_surat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="perihal">Perihal</label>
                        <textarea class="form-control mt-1 @error('perihal') is-invalid @enderror" name="perihal" id="perihal" rows="3">{{ old('perihal') }}</textarea>
                        @error('perihal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label for="tgl_disposisi">Tgl. Disposisi Inspektur</label>
                                <input type="date" class="form-control mt-1 @error('tgl_disposisi') is-invalid @enderror"
                                    name="tgl_disposisi" id="tgl_disposisi" value="{{ old('tgl_disposisi') }}">
                                @error('tgl_disposisi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="disposisi">Disposisi Inspektur</label>
                        <textarea type="text" class="form-control mt-1 @error('disposisi') is-invalid @enderror" name="disposisi"
                            id="disposisi" rows="5">{{ old('disposisi') }}</textarea>
                        @error('disposisi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="irban_penerima">Irban Penerima</label>
                                <select name="irban_penerima" id="irban_penerima"
                                    class="form-control mt-1 @error('irban_penerima') is-invalid @enderror">
                                    <option value="">:: Pilih ::</option>
                                    @foreach (\App\Models\User::where('level_id', 5)->orderBy('name', 'ASC')->get() as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('irban_penerima') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('irban_penerima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_penerima">Nama Penerima</label>
                                <input type="text" class="form-control mt-1 @error('nama_penerima') is-invalid @enderror"
                                    name="nama_penerima" id="nama_penerima" value="{{ old('nama_penerima') }}">
                                @error('nama_penerima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control mt-1 @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan"
                            rows="5">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
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
