@extends('dashboard.template')
@section('content')
<div class="container-xl px-4 mt-n10">
    <div class="card mb-4">
        <div class="card-header text-uppercase">
            {{ $title_bar }}
            <span class="ml-5">
                <a href="/dashboard/posts/create" class="ms-2"><i class="fas fa-plus-circle fa-lg"></i></a>
            </span>
        </div>
        <div class="card-body">
            {!! session('msg') !!}
            <div class="table-responsive">
                <table id="customTable" class="table table-bordered small" style="width:100%">
                    <thead class="text-uppercase bg-light text-uppercase">
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Komentar</th>
                            <th>View</th>
                            <th>Status</th>
                            <th>Lihat</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $row)
                        <tr>
                            <td scope="row">{{ $posts->firstItem() + $loop->index }}</td>
                            <td>
                                @if (auth()->user()->id !== $row->user_id && auth()->user()->level_id !== 1)
                                {{ $row->title }}
                                @else
                                <a href="/dashboard/posts/{{$row->id}}/edit">{{ $row->title }}</a>
                                @endif
                            </td>
                            <td>{{ $row->category_id ? $row->category->name : '-' }}</td>
                            <td></td>
                            <td>
                                <a href="/posts/{{ $row->slug }}#comments" target="_blank">
                                    <i class="feather" data-feather="message-circle"></i>
                                    {{ number_format($row->comments->count(), 0, ',', '.') }}
                                </a>
                            </td>
                            <td>{{ $row->views ? number_format($row->views, 0, ',', '.') : 0 }}</td>
                            <td>
                                {!! $row->status === 1
                                ? '<span class="badge bg-success">Disetujui</span>'
                                : ($row->status === 0
                                ? '<span class="badge bg-warning">Menunggu</span>'
                                : '<span class="badge bg-danger">Ditolak</span>') !!}
                            </td>
                            <td>
                                <a href="/posts/{{ $row->slug }}" target="_blank"><i class="fa fa-external-link"></i></a>
                            </td>
                            <td>
                                <form action="/dashboard/posts/{{ $row->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button {{ auth()->user()->id !== $row->user_id && auth()->user()->level_id !== 1 ? 'disabled' : '' }} type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');">
                                        <i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3 mb-0">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection