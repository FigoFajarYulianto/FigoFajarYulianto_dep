@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="/dashboard/zakatcollectionunits/create" class="ms-2"><i
                            class="fas fa-plus-circle fa-lg"></i></a>
                </span>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <form action="/dashboard/zakatcollectionunits" method="get">
                    <div class="row">
                        <label for="search" class="small">Cari Unit Pengumpulan Zakat</label>
                        <div class="col-md-11">
                            <div class="form-group mb-3">
                                <input type="text" name="search" id="search"
                                    class="form-control form-control-sm mt-1" value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary btn-sm mt-1">Filter</button>
                            </div>
                        </div>
                    </div>
                    {{-- <button type="button" class="btn btn-sm btnReset btn-outline-dark">Reset</button> --}}
                </form>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered small" style="width:100%">
                        <thead class="text-uppercase bg-light text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>NAMA</th>
                                {{-- <th>PROVINSI</th>
                                <th>KABUPATEN</th>
                                <th>KECAMATAN</th> --}}
                                <th>ALAMAT</th>
                                <th>KONTAK</th>
                                <th>LOKASI</th>
                                {{-- <th>LIHAT</th> --}}
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($zakatcollectionunits as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if (auth()->user()->id !== $row->user_id && auth()->user()->level_id !== 1)
                                            {{ $row->name }}
                                        @else
                                            <a
                                                href="/dashboard/zakatcollectionunits/{{ $row->id }}/edit">{{ $row->name }}</a>
                                        @endif
                                    </td>
                                    {{-- <td>{{ $row->province->name ?? '' }}</td>
                                    <td>{{ $row->district->name ?? '' }}</td>
                                    <td>{{ $row->subdistrict->name ?? '' }}</td> --}}
                                    <td>{{ $row->alamat }}</td>
                                    <td>{{ $row->kontak }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="lokasiShow" data-id="{{ $row->id }}"
                                            data-bs-toggle="modal" data-bs-target="#lokasiModal">
                                            Lihat Lokasi
                                        </a>
                                    </td>
                                    {{-- <td><a href="/zakatcollectionunits/{{ $row->slug }}" target="_blank"><i
                                                class="fas fa-external-link"></i></a></td> --}}
                                    <td>
                                        <form action="/dashboard/zakatcollectionunits/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                {{ auth()->user()->id !== $row->user_id && auth()->user()->level_id !== 1 ? 'disabled' : '' }}
                                                type="submit" class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
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
                url: '/dashboard/zakatcollectionunits/' + id,
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
