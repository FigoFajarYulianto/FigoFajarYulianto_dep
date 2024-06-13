@extends('frontend.template')
@section('content')
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-10 text-center">
                        <h2>{{ $title_bar }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol class="text-muted">
                    <li><a href="/">Beranda</a></li>
                    <li>{{ $title_bar }}</li>
                </ol>
            </div>
        </nav>
    </div>
    <div class="container-xl px-4 mt-n10 mt-3">
        <div class="card-body">
            {!! session('msg') !!}
            <form action="/zakatcollectionunits" method="get" class="bg-light p-3 rounded">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="search" class="small">Cari Unit Pengumpulan Zakat</label>
                            <input type="text" name="search" id="search" class="form-control form-control-sm mt-1"
                                value="{{ request('search') }}">
                        </div>
                    </div>
                </div>
                <center>
                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                </center>
                {{-- <button type="button" class="btn btn-sm btnReset btn-outline-dark">Reset</button> --}}
            </form>

            <div class="table-responsive">
                <table id="customTable" class="table table-bordered small" style="width:100%">
                    <thead class="text-uppercase bg-light text-uppercase">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Kontak</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($zakatcollectionunits as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>{{ $row->kontak }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="lokasiShow" data-id="{{ $row->id }}"
                                        data-bs-toggle="modal" data-bs-target="#lokasiModal">
                                        Lihat Lokasi
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3 mb-0">
                {{ $zakatcollectionunits->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="lokasiModal" tabindex="-1" aria-labelledby="lokasiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="_method" id="_method">
                <div class="modal-header">
                    <h5 class="modal-title" id="lokasiModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name"
                                    class="form-control mt-1 @error('name') is-invalid @enderror" readonly>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="kontak">Kontak</label>
                                <input type="text" name="kontak" id="kontak"
                                    class="form-control mt-1 @error('kontak') is-invalid @enderror" readonly>
                                @error('kontak')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control mt-1 @error('alamat') is-invalid @enderror" name="alamat" id="alamat" cols="30"
                            rows="10" readonly></textarea>
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">iFrame Map</label>
                        <div id="atf-map-area" class="mt-4">
                            <div id="lokasi">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.lokasiShow').on('click ', function() {
            const id = $(this).data('id');
            $('#lokasiModalLabel').html('Perbarui Provinsi');
            $.ajax({
                url: '/api/zakatcollectionunits/' + id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#kontak').val(response.kontak);
                    $('#alamat').val(response.alamat);
                    $('#lokasi').html('');
                    $('#lokasi').append(response.lokasi);
                }
            });
        });
    </script>
@endsection
