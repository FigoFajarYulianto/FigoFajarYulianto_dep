@extends('layouts.admin')
@section('content')
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="/admin/riwayats/create" method="POST">
        @csrf
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Terpilih Baru</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="form-group row">
                    <label class="col-3 col-form-label">Nama</label>
                    <div class="col-9">
                        <input class="form-control @error('nama') is-invalid @enderror" type="text" value=""
                            id="nama" name="nama">
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
                        <input class="form-control @error('tahun') is-invalid @enderror" type="date" value=""
                            id="tahun" name="tahun">
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
                        <input class="form-control @error('nilai') is-invalid @enderror" type="number" value=""
                            id="nilai" name="nilai" min="0" step="any">
                    </div>
                </div>
            </div>
            <div class="widget-footer text-right">
                <button type="submit" class="btn btn-primary mr-2">Tambah</button>

            </div>
        </div>
    </form>
@endsection
