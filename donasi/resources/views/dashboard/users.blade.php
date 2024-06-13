@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="/dashboard/users/create" class="ms-2">
                        <?= in_array('users.store', $roles) ? "<i class='fas fa-plus-circle fa-lg'></i>" : '' ?>
                    </a>
                </span>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <div class="table-responsive mt-4">
                    <table id="customTable" class="table table-bordered small" style="width:100%">
                        <thead class="text-uppercase bg-light text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>NAMA</th>
                                <th>USERNAME</th>
                                <th>EMAIL</th>
                                <th>TELP</th>
                                <th>PROVINSI</th>
                                <th>KABUPATEN</th>
                                <th>KECAMATAN</th>
                                <th>LEVEL</th>
                                <th>STATUS</th>
                                <th>HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="/dashboard/users/{{ $row->id }}/edit"
                                            <?= in_array('users.edit', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>>
                                            {{ $row->name }}
                                        </a>
                                    </td>
                                    <td>{{ $row->username }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->no_phone ?? '-' }}</td>
                                    <td>{{ $row->province->name ?? '' }}</td>
                                    <td>{{ $row->district->name ?? '' }}</td>
                                    <td>{{ $row->subdistrict->name ?? '' }}</td>
                                    <td>{{ $row->level->name ?? '' }}</td>
                                    <td>{{ $row->status ? 'Aktif' : 'Nonaktif' }}</td>
                                    <td>
                                        <form action="/dashboard/users/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                {{ $row->id === auth()->user()->id || $row->id === 1 ? 'disabled' : '' }}
                                                type="submit" class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"
                                                <?= in_array('users.destroy', $roles) ? '' : 'Disabled' ?>><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
