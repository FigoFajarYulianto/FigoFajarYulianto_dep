@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="javascript:void(0)" class="ms-2 addDana" data-bs-toggle="modal" data-bs-target="#danaModal">
                        <?= in_array('Dana.store', $roles) ? "<i class='fas fa-plus-circle fa-lg'></i>" : '' ?>
                    </a>
                </span>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <div class="table-responsive">
                    <table id="customTable" class="table table-bordered small" style="width:100%">
                        <thead class="text-uppercase bg-light text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>DANA</th>
                                <th>KODE DANA</th>
                                <th>KATEGORI DANA</th>
                                <th>HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danas as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="editDana" data-id="{{ $row->id }}"
                                            data-bs-toggle="modal" data-bs-target="#danaModal"
                                            <?= in_array('Dana.show', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>>
                                            {{ $row->name }}
                                        </a>
                                    </td>
                                    <td>{{ $row->code }}</td>
                                    <td>{{ $row->danacategory->name }}</td>
                                    {{-- ({{ $row->dana->count() }}) --}}
                                    <td>
                                        <form action="/dashboard/danas/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"
                                                <?= in_array('Dana.destroy', $roles) ? '' : 'Disabled' ?>><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-3">
                    {{ $danas->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="danaModal" tabindex="-1" aria-labelledby="danaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="danaModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Dana</label>
                            <input type="text" name="name" id="name"
                                class="form-control mt-1 @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="code">Kode Dana</label>
                            <input type="text" name="code" id="code"
                                class="form-control mt-1 @error('code') is-invalid @enderror">
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="danacategory_id">Kategori Dana</label>
                            <select name="danacategory_id" id="danacategory_id"
                                class="form-control mt-1 @error('danacategory_id') is-invalid @enderror">
                                <option value="">:: Pilih ::</option>
                                @foreach (\App\Models\Danacategory::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('danacategory_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description (Di isi hanya untuk zakat)</label>
                            <textarea name="description" id="description" class="form-control" rows="10"></textarea>
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

@section('script')
    <script>
        $('.addDana').on('click', function() {
            $('#danaModalLabel').html('Dana Baru');
            $('input[name=_method]').val('POST');
            $('.modal form').prop('action', '/dashboard/danas');
            $('.modal-footer button[type=submit]').html('Simpan');
            $('#id').val('');
            $('#name').val('');
            $('#code').val('');
            $('#slug').val('');
            $('#description').val('');
            $('#danacategory_id option').prop('selected', false);
        });

        $('.editDana').on('click ', function() {
            const id = $(this).data('id');
            $('input[name=_method]').val('PUT');
            $('#danaModalLabel').html('Perbarui Dana');
            $('.modal form').prop('action', '/dashboard/danas/' + id);
            $('.modal-footer button[type=submit]').html('Perbarui');
            $.ajax({
                url: '/dashboard/danas/' + id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#code').val(response.code);
                    $('#slug').val(response.slug);
                    $('#description').val(response.description);
                    $('#danacategory_id option[value=' + response.danacategory_id + ']').prop(
                        'selected',
                        true);
                }
            });
        });
    </script>
@endsection
