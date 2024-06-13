@extends('dashboard.template')
@section('content')
<h2 class="page-header-title">
    <div class="page-header-icon"><i data-feather="activity"></i></div>
    Menu Hidangan
</h2>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title">Tambah Menu Hidangan
                        <a href="/dashboard/menus/create" class="ms-6"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <div class="pull-right row g-3 align-items-center mt-2 mb-4">
                                    Pencarian :
                                    <div class="col-auto">
                                        <form action="/dashboard/menus" method="GET">
                                            <input type="search" id="" name="search" class="form-control">
                                        </form>
                                    </div>
                                </div>
                                <table class="display expandable-table" style="width: 100%">
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
                                <div>
                                    <p>Showing
                                        {{ $menus->firstItem() }}
                                        To
                                        {{ $menus->lastItem() }}
                                        Of
                                        {{ $menus->total() }}
                                    </p>
                                </div>
                                <div class="pull-right">
                                    {{ $menus->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection