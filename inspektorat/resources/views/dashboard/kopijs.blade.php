@extends('dashboard.template')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title text-uppercase">
                    {{ $title_bar }}
                    <a href="/dashboard/kopijs/create" class="ml-1"><i class="fa fa-plus-circle"></i></a>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <table id="customTable" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nomor</th>
                                    <th>Nama Lengkap</th>
                                    <th>Perihal / Judul</th>
                                    <th>Balasan</th>
                                    <th>Status</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kopijs as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="/dashboard/kopijs/{{ $row->id }}/edit">{{ $row->nomor }}</a>
                                        </td>
                                        <td>{{ $row->nama }}</td>
                                        <td>{{ $row->judul }}</td>
                                        <td>
                                            <a class="text-decoration-none" href="/dashboard/kopijs/{{ $row->id }}">
                                                <i class="fa fa-comment mr-1"></i>
                                                {{ $row->kopijitems_count }}
                                            </a>
                                        </td>
                                        <td>{{ $row->status->name ?? 'Menunggu' }}</td>
                                        <td>
                                            <form action="/dashboard/kopijs/{{ $row->id }}" method="post">
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
                    </div>
                    <div class="d-flex justify-content-end mt-3 mb-0">
                        {{ $kopijs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
