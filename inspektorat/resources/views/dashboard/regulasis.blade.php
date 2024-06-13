@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        {{ $title_bar }}
                        <a href="/dashboard/regulasis/create" class="ml-1"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="customTable" class="display expandable-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Keterangan</th>
                                            <th>Preview</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($regulasis as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a
                                                        href="/dashboard/regulasis/{{ $row->id }}/edit">{{ $row->judul }}</a>
                                                </td>
                                                <td>{{ $row->peraturan->name ?? '' }}</td>
                                                <td>{{ $row->keterangan ? Str::substr($row->keterangan, 0, 60) . ' ...' : '' }}
                                                </td>
                                                <td>
                                                    <a href="/storage/{{ $row->unduh }}"><i
                                                            class="fa fa-external-link mr-1"></i></a>
                                                </td>
                                                <td>
                                                    <form action="/dashboard/regulasis/{{ $row->id }}" method="post">
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
                                    {{ $regulasis->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
