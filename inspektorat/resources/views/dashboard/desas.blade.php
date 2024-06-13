@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        {{ $title_bar }}
                        <a href="javascript:void(0)" class="ml-1 addDesa" data-bs-toggle="modal" data-bs-target="#desaModal"><i
                                class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="customTable" class="display expandable-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Desa/Kelurahan</th>
                                            <th>Kecamatan</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($desas as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" class="editDesa"
                                                        data-id="{{ $row->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#desaModal">
                                                        {{ $row->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $row->kecamatan->name }}</td>
                                                <td>
                                                    <form action="/dashboard/desas/{{ $row->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            {{ $row->reports_count || $row->officers_count ? 'disabled' : '' }}
                                                            type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin ingin melanjutkan?')"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end mt-3 mb-0">
                                {{ $desas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="desaModal" tabindex="-1" aria-labelledby="desaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="desaModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Desa/Kelurahan</label>
                            <input type="text" name="name" id="name"
                                class="form-control mt-1 @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kecamatan_id">Kecamatan</label>
                            <select name="kecamatan_id" id="kecamatan_id"
                                class="form-control mt-1 @error('kecamatan_id') is-invalid @enderror">
                                <option value="">:: Pilih ::</option>
                                @foreach (\App\Models\Kecamatan::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('kecamatan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.addDesa').on('click', function() {
            $('#desaModalLabel').html('Desa/Kelurahan Baru');
            $('input[name=_method]').val('POST');
            $('.modal form').prop('action', '/dashboard/desas/create');
            $('.modal-footer button[type=submit]').html('Simpan');
            $('#id').val('');
            $('#name').val('');
            $('#kecamatan_id option').prop('selected', false);
        });

        $(document).on('click', '.editDesa', function() {
            const id = $(this).data('id');
            $('input[name=_method]').val('PUT');
            $('#desaModalLabel').html('Perbarui Desa/Kelurahan');
            $('.modal form').prop('action', '/dashboard/desas/' + id);
            $('.modal-footer button[type=submit]').html('Perbarui');
            $.ajax({
                url: '/dashboard/desas/' + id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#kecamatan_id option[value=' + response.kecamatan_id + ']').prop('selected',
                        true);
                }
            });
        });
    </script>
@endsection
