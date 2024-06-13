@extends('dashboard.template')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title text-uppercase">
                    <a href="/dashboard/regulasis" class="mr-1"><i class="fa fa-arrow-circle-left"></i></a>
                    {{ $title_bar }}
                </div>
                <form class="form-sample" action="/dashboard/regulasis/create" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label for="judul">Judul Regulasi</label>
                                <input class="form-control mt-1 @error('judul') is-invalid @enderror" name="judul"
                                    type="text" id="judul" value="{{ old('judul') }}" />
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
                                    type="text" id="keterangan" value="{{ old('keterangan') }}" />
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
                        <select name="peraturan_id" id="peraturan_id"
                            class="form-control @error('peraturan_id') is-invalid @enderror">
                            <option value="">:: Pilih ::</option>
                            @foreach ($categoriperaturan as $row)
                                <option value="{{ $row->id }}" {{ old('peraturan_id') == $row->id ? 'selected' : '' }}>
                                    {{ $row->name }}
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
                        <label for="unduh">Upload File</label>
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
