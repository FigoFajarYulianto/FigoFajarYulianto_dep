@extends('dashboard.template')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="hash"></i></div>
                                Kategori Hidangan
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-fluid px-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Kategori Menu Hidangan
                        <a href="javascript:void(0)" class="ms-2 addCategory" data-bs-toggle="modal" data-bs-target="#categoryModal"><i class="fa fa-plus-circle fa-lg"></i></a>
                    </div>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kategori</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Kategori</th>
                                <th>Hapus</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($categories as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="editCategory" data-id="{{ $row->id }}" data-bs-toggle="modal" data-bs-target="#categoryModal">
                                        {{ $row->nama }}
                                    </a> ({{ $row->menus_count }})
                                </td>
                                <td>
                                    <form action="/dashboard/categories/{{ $row->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button {{ $row->menus->count() ? 'disabled' : '' }} type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="_method" id="_method">
                        <div class="modal-header">
                            <h5 class="modal-title" id="categoryModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Kategori</label>
                                <input type="text" name="nama" id="nama" class="form-control mt-1 @error('nama') is-invalid @enderror">
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection