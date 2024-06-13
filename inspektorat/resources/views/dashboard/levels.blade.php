@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        Level User
                        <a href="javascript:void(0)" class="ml-1 addLevel" data-bs-toggle="modal"
                            data-bs-target="#levelModal"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="customTable" class="display expandable-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Level</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($levels as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td> <a href="/dashboard/levels/{{ $row->id }}/edit">
                                                        {{ $row->nama }}</a> ({{ $row->users_count }})
                                                </td>
                                                <td>
                                                    <form action="/dashboard/levels/{{ $row->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button {{ $row->id === 5 || $row->id === 1 ? 'disabled' : '' }}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="levelModal" tabindex="-1" aria-labelledby="levelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="levelModalLabel"></h5>
                        <button type="button" class="remove ti-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Level</label>
                            <input type="text" name="nama" id="nama"
                                class="form-control mt-1 @error('nama') is-invalid @enderror">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
