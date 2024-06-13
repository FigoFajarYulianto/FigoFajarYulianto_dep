@extends('dashboard.template')
@section('content')
<h2 class="page-header-title">
    <div class="page-header-icon"><i data-feather="activity"></i></div>
    Menu
</h2>


<div class="col-12 grid-margin">
    <div class="card">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title">{{ $title_bar }}
                    <!-- <a href="/dashboard/createmenu" class="ms-6"><i class="fa fa-plus-circle"></i></a> -->
                    <a href="javascript:void(0)" class="ms-2 addMenu" data-bs-toggle="modal" data-bs-target="#menuModal"><i class="fa fa-plus-circle"></i></a>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <div class="pull-right row g-3 align-items-center mt-2 mb-4 ml-0">
                                <div class="ml-3 mb-2">
                                    Pencarian :
                                </div>
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
                                        <th>Main Menu</th>
                                        <th>Sub Menu</th>
                                        <th>Urutan</th>
                                        <th>URL / Link</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menus as $row)
                                    <tr>
                                        <td scope="row">{{ $menus->firstItem() + $loop->index }}</td>
                                        <td>
                                            @if (!$row->child)
                                            <a href="javascript:void(0)" class="editMenu" data-id="{{ $row->id }}" data-bs-toggle="modal" data-bs-target="#menuModal">{{ $row->name }}</a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->child)
                                            <a href="javascript:void(0)" class="editMenu" data-id="{{ $row->id }}" data-bs-toggle="modal" data-bs-target="#menuModal">{{ $row->name }}</a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>{{ $row->sort }}</td>
                                        <td>{{ $row->link }}</td>
                                        <td>
                                            <form action="/dashboard/menusnav/{{ $row->id }}" method="post">
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

<div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="_method" id="_method">
                <div class="modal-header">
                    <h5 class="modal-title" id="menuModalLabel"></h5>
                    <button type="button" class="fa fa-times" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name">Nama Menu</label>
                        <input type="text" name="name" id="name" class="form-control mt-1 @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="link">URL / Link</label>
                        <input type="text" name="link" id="link" class="form-control mt-1 @error('link') is-invalid @enderror">
                        @error('link')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="child">Sub Menu</label>
                        <select name="child" id="child" class="form-control @error('name') is-invalid @enderror">
                            <option value="">:: Pilih ::</option>
                            @foreach ($mainMenus as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                        @error('link')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="sort">Urutan</label>
                        <input type="number" name="sort" id="sort" step="0.01" class="form-control mt-1 @error('sort') is-invalid @enderror">
                        @error('sort')
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