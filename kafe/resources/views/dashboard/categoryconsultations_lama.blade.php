@extends('dashboard.template')
@section('content')
    <h2 class="page-header-title">
        <div class="page-header-icon"><i data-feather="activity"></i></div>
        Kategori Konsultasi
    </h2>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-title">Kategori Konsultasi
                            <a href="javascript:void(0)" class="ms-2 addcategoryconsultations" data-bs-toggle="modal"
                                data-bs-target="#categoryconsultationsModal"><i class="fa fa-plus-circle fa-lg"></i></a>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <div class="pull-right row g-3 align-items-center mt-2 mb-4">
                                        Pencarian :
                                        <div class="col-auto">
                                            <form action="/dashboard/categoryconsultations" method="GET">
                                                <input type="search" id="" name="search" class="form-control">
                                            </form>
                                        </div>
                                    </div>
                                    <table id="table" class="display expandable-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kategori</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categoryconsultations as $row)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="editcategoryconsultations"
                                                            data-id="{{ $row->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#categoryconsultationsModal">
                                                            {{ $row->nama }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form action="/dashboard/categoryconsultations/{{ $row->id }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Yakin ingin menghapus data ini?');"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                        <p>Showing
                                            {{ $categoryconsultations->firstItem() }}
                                            To
                                            {{ $categoryconsultations->lastItem() }}
                                            Of
                                            {{ $categoryconsultations->total() }}
                                        </p>
                                    </div>
                                    <div class="pull-right">
                                        {{ $categoryconsultations->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="categoryconsultationsModal" tabindex="-1" aria-labelledby="categoryconsultationsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryconsultationsModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Kategori</label>
                            <input type="text" name="nama" id="nama"
                                class="form-control mt-1 @error('nama') is-invalid @enderror">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
