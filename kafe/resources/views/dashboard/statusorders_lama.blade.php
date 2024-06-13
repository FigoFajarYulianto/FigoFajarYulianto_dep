@extends('dashboard.template')
@section('content')
    <h2 class="page-header-title">
        <div class="page-header-icon"><i data-feather="activity"></i></div>
        Kategori Status Order
    </h2>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-title">Kategori Status Order
                            <a href="javascript:void(0)" class="ms-2 addstatusorders" data-bs-toggle="modal"
                                data-bs-target="#statusordersModal"><i class="fa fa-plus-circle fa-lg"></i></a>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <div class="pull-right row g-3 align-items-center mt-2 mb-4">
                                        Pencarian :
                                        <div class="col-auto">
                                            <form action="/dashboard/statusorders" method="GET">
                                                <input type="search" id="" name="search" class="form-control">
                                            </form>
                                        </div>
                                    </div>
                                    <table id="table" class="display expandable-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Status</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($statusorders as $row)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="editstatusorders"
                                                            data-id="{{ $row->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#statusordersModal">
                                                            {{ $row->nama }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form action="/dashboard/statusorders/{{ $row->id }}"
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
                                            {{ $statusorders->firstItem() }}
                                            To
                                            {{ $statusorders->lastItem() }}
                                            Of
                                            {{ $statusorders->total() }}
                                        </p>
                                    </div>
                                    <div class="pull-right">
                                        {{ $statusorders->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="statusordersModal" tabindex="-1" aria-labelledby="statusordersModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusordersModalLabel"></h5>
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
