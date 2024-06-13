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
                                <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                Menu
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
                    <div class="mb-3 card-title">Tambah Menu Hidangan
                        <a href="/dashboard/menus/create" class="ms-6"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Gambar</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Gambar</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Hapus</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($menus as $row)
                            <tr>
                                <td scope="row">{{ $menus->firstItem() + $loop->index }}</td>
                                <td><a href="/dashboard/menus/{{ $row->id }}/edit">{{ $row->nama }}</a></td>
                                <td><img src="{{ $row->photo ? '/storage/' . $row->photo : '/assets/images/noimage.jpeg' }}" class="img-thumbnail" width="100px"></td>
                                <td>{{ $row->category->nama }}</td>
                                <td>{{ $row->harga }}</td>
                                <td>
                                    <form action="/dashboard/menus/{{ $row->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection