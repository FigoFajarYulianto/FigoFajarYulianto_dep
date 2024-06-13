@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        {{ $title_bar }}
                        <a href="/dashboard/links/create" class="ml-1"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="customTable" class="display expandable-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Url</th>
                                            <th>Hapus</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($links as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td> <a
                                                        href="/dashboard/links/{{ $row->id }}/edit">{{ $row->name }}</a>
                                                </td>
                                                <td>{{ $row->link ? $row->link : '-' }}</td>
                                                <td>
                                                    <form action="/dashboard/links/{{ $row->id }}" method="post">
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
                                    {{ $links->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
