@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    {{ $title_bar }}
                    <a href="/admin/users/create" class="ml-1"><i class="fa fa-plus-circle"></i></a>

                </div>
                <div class="card-body">

                        <table id="table" class="table table-striped text-center display nowrap w-100"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="/admin/users/{{ $row->id }}/edit">{{ $row->name }}</a></td>
                                        <td>{{ $row->email }}</td>
                                        <td>
                                            <form action="/admin/users/{{ $row->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?');"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--  <div class="pull-right">
                                    {{ $riwayats->links() }}
                                </div>  --}}
                </div>
            </div>
        </div>
    </div>
@endsection
