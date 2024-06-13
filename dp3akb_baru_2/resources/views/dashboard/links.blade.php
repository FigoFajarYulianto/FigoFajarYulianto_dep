@extends('dashboard.template')
@section('content')
<div class="container-xl px-4 mt-n10">
    <div class="card mb-4">
        <div class="card-header text-uppercase">
            Link
            <span class="ml-5">
                <a href="/dashboard/links/create" class="ms-2"><i class='fas fa-plus-circle fa-lg'></i></a>
            </span>
        </div>
        <div class="card-body">
            {!! session('msg') !!}
            <div class="table-responsive">
                <table id="customTable" class="table table-bordered small" style="width:100%">
                    <thead class="text-uppercase bg-light text-uppercase">
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
                            <td scope="row">{{ $links->firstItem() + $loop->index }}</td>
                            <td> <a href="/dashboard/links/{{ $row->id }}/edit">{{ $row->name }}</a>
                            </td>
                            <td>{{ $row->link ? $row->link : '-' }}</td>
                            <td>
                                <form action="/dashboard/links/{{ $row->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');">
                                        <i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    <p>Showing
                        {{ $links->firstItem() }}
                        To
                        {{ $links->lastItem() }}
                        Of
                        {{ $links->total() }}
                    </p>
                </div>
                <div class="pull-right">
                    {{ $links->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection