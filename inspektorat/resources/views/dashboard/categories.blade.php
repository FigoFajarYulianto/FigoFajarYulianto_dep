@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        {{ $title_bar }}
                        <a href="javascript:void(0)" class="ml-1 addCategory" data-bs-toggle="modal"
                            data-bs-target="#categoryModal"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="customTable" class="display expandable-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kategori Program</th>
                                            <th>Kategori</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>
                                                    <a href="javascript:void(0)" class="editCategory"
                                                        data-id="{{ $row->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#categoryModal">
                                                        {{ $row->name }}
                                                    </a> ({{ $row->posts_count }})
                                                </td>
                                                <td>{{ $row->program->name ?? '' }}</td>
                                                <td>
                                                    <form action="/dashboard/categories/{{ $row->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button {{ $row->posts->count() ? 'disabled' : '' }} type="submit"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin ingin menghapus data ini?');"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pull-right">
                                    {{ $categories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Kategori Berita</label>
                            <input type="text" name="name" id="name"
                                class="form-control mt-1 @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="program_id">Kategori Menu</label>
                            <select name="program_id" id="program_id"
                                class="form-control @error('program_id') is-invalid @enderror">
                                <option value="">:: Pilih ::</option>
                                @foreach ($programs as $row)
                                    <option value="{{ $row->id }}"
                                        {{ old('program_id') == $row->id ? 'selected' : '' }}>{{ $row->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('program_id')
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
