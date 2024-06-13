@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        {{ $title_bar }}
                        <a href="/dashboard/pages/create" class="ml-1"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="customTable" class="display expandable-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>View</th>
                                            <th>Lihat</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pages as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if (auth()->user()->id !== $row->user_id && auth()->user()->level_id !== 1)
                                                        {{ $row->title }}
                                                    @else
                                                        <a
                                                            href="/dashboard/pages/{{ $row->id }}/edit">{{ $row->title }}</a>
                                                    @endif
                                                </td>
                                                <td>{{ $row->user_id ? $row->user->name : '-' }}</td>
                                                <td>{{ $row->views ? number_format($row->views, 0, ',', '.') : 0 }}</td>
                                                <td><a href="/pages/{{ $row->slug }}" target="_blank"><i
                                                            class="fa fa-external-link"></i></a></td>
                                                <td>
                                                    <form action="/dashboard/pages/{{ $row->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            {{ auth()->user()->id !== $row->user_id && auth()->user()->level_id !== 1 ? 'disabled' : '' }}
                                                            type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin ingin menghapus data ini?');">
                                                            &nbsp;<i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mb-5">
                                {{ $pages->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection