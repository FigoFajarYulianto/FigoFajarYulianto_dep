@extends('layouts.admin')
@section('content')
    <form class="form-sample" action="/admin/riwayats/{{ $terpilih->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Terpilih Edit</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="form-group row">
                    <label class="col-3 col-form-label">Nama</label>
                    <div class="col-9">
                        <input class="form-control @error('nama') is-invalid @enderror" type="text"
                            value="{{ old('nama', $terpilih->nama) }}" id="nama" name="nama">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col-3 col-form-label">Tahun</label>
                    <div class="col-9">
                        <input class="form-control @error('tahun') is-invalid @enderror" type="date"
                            value="{{ old('tahun', $terpilih->tahun) }}" id="tahun" name="tahun">
                        @error('tahun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3 col-form-label">Nilai</label>
                    <div class="col-9">
                        <input class="form-control @error('nilai') is-invalid @enderror" type="number"
                            value="{{ old('nilai', $terpilih->nilai) }}" id="nilai" name="nilai" min="0"
                            step="any">
                    </div>
                </div>
            </div>
            <div class="widget-footer text-right">
                <button type="submit" class="btn btn-primary mr-2">Perbarui</button>

            </div>
        </div>
    </form>
@endsection
