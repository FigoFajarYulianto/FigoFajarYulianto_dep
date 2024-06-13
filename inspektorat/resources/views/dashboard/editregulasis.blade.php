@extends('dashboard.template')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title text-uppercase">
                    <a href="/dashboard/regulasis" class="mr-1"><i class="fa fa-arrow-circle-left"></i></a>
                    {{ $title_bar }}
                </div>
                <form class="form-sample" action="/dashboard/regulasis/{{ $regulasi->id }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label for="judul">Judul Regulasi</label>
                                <input class="form-control mt-1 @error('judul') is-invalid @enderror" name="judul"
                                    type="text" id="judul" value="{{ old('judul', $regulasi->judul) }}" />
                                @error('judul')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label for="keterangan">Keterangan</label>
                                <input class="form-control mt-1 @error('keterangan') is-invalid @enderror" name="keterangan"
                                    type="text" id="keterangan" value="{{ old('keterangan', $regulasi->keterangan) }}" />
                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="peraturan_id">Kategori Peraturan</label>
                        <select class="form-control mt-1 @error('peraturan_id') is-invalid @enderror" name="peraturan_id"
                            id="peraturan_id">
                            <option value="">:: Pilih ::</option>
                            @foreach ($categoriperaturan as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('peraturan_id', $regulasi->peraturan->id ?? '') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('peraturan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="unduh">Perbarui File</label>
                        @if ($regulasi->unduh)
                            <p class="small mb-2  mt-0">
                                <i class="fa fa-external-link fa-sm mr-1"></i>
                                <a target="_blank" href="/storage/{{ $regulasi->unduh }}">
                                    Lihat File</a>
                            </p>
                        @endif
                        <input type="file" name="unduh" placeholder="Choose file" id="unduh" class="form-control">
                        @error('unduh')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
