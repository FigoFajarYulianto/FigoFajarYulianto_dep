@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        Staff
                        <a href="/dashboard/staffs/create" class="ml-1"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="customTable" class="display expandable-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Nip</th>
                                            <th>Jabatan</th>
                                            <th>Status</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($staffs as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td> <img
                                                        src="{{ $row->foto ? '/storage/' . $row->foto : '/assets/images/noimage.jpeg' }}"
                                                        class="img-thumbnail" width="75px;"></td>
                                                <td><a
                                                        href="/dashboard/staffs/{{ $row->id }}/edit">{{ $row->nama }}</a>
                                                </td>
                                                <td>{{ $row->nip }}</td>
                                                <td>{{ $row->jabatan }}</td>
                                                <td>{{ $row->status == 1 ? 'Aktif' : 'Nonaktif' }}</td>

                                                <td>
                                                    <form action="/dashboard/staffs/{{ $row->id }}" method="post">
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
                                <div class="pull-right">
                                    {{ $staffs->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
