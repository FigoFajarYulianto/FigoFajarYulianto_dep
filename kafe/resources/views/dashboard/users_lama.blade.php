@extends('dashboard.template')
@section('content')
    <h2 class="page-header-title">
        <div class="page-header-icon"><i data-feather="activity"></i></div>
        User
    </h2>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card shadow">ss
                    <div class="card-body">
                        <div class="card-title">User
                            <a href="/dashboard/createuser" class="ms-6"><i class="fa fa-plus-circle"></i></a>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <div class="pull-right row g-3 align-items-center mt-2 mb-4">
                                        Pencarian :
                                        <div class="col-auto">
                                            <form action="/dashboard/users" method="GET">
                                                <input type="search" id="" name="search" class="form-control">
                                            </form>
                                        </div>
                                    </div>
                                    <table id="table" class="display expandable-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Level</th>
                                                <th>Status</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user as $row)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td> <a href="/dashboard/users/{{ $row->id }}/edit">
                                                            {{ $row->name }}
                                                        </a> ({{ $row->posts_count + $row->pages_count }})
                                                    </td>
                                                    <td>{{ $row->username }}</td>
                                                    <td>{{ $row->email }}</td>
                                                    <td>{{ $row->level->nama }}</td>
                                                    <td>{{ $row->status ? 'Aktif' : 'Nonaktif' }}</td>
                                                    <td>
                                                        <form action="/dashboard/users/{{ $row->id }}" method="post">
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
                                            {{ $user->firstItem() }}
                                            To
                                            {{ $user->lastItem() }}
                                            Of
                                            {{ $user->total() }}
                                        </p>
                                    </div>
                                    <div class="pull-right">
                                        {{ $user->links() }}
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
