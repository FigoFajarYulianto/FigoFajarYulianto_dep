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
                                <div class="page-header-icon"><i data-feather="users"></i></div>
                                Konsultasi
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
                    <div class="card-title">Tambah Konsultasi
                        <a href="/dashboard/konsultasi/create" class="ms-6"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Judul</th>
                                <th>Whatsapp</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Tanggal 2</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Judul</th>
                                <th>Whatsapp</th>
                                <th>Hapus</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($consultation as $row)
                            <tr>
                                <td scope="row">{{ $consultation->firstItem() + $loop->index }}</td>
                                <td>{{ $row->created_at->format('d/m/Y')}} {{ $row->created_at->format('h:i')}}</td>
                                <td><a href="/dashboard/konsultasi/{{ $row->id }}/edit">{{ $row->nama }}</a>
                                </td>
                                <td>{{ $row->alamat }}</td>
                                <td>{{ $row->judul }}</td>
                                <td>{{ $row->whatsapp }}</td>
                                <td>
                                    <form action="/dashboard/konsultasi/{{ $row->id }}" method="post">
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
        <!-- Create group modal-->
        <div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="createGroupModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createGroupModalLabel">Create New Group</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-0">
                                <label class="mb-1 small text-muted" for="formGroupName">Group Name</label>
                                <input class="form-control" id="formGroupName" type="text" placeholder="Enter group name..." />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger-soft text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary-soft text-primary" type="button">Create New Group</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection