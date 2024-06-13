@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="javascript:void(0)" class="ms-2 addCategory" data-bs-toggle="modal"
                        data-bs-target="#categoryModal"><i class="fas fa-plus-circle fa-lg"></i></a>
                </span>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <div class="table-responsive">
                    <table id="customTable" class="table table-bordered small" style="width:100%">
                        <thead class="text-uppercase bg-light text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>Kategori</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="editCategory" data-id="{{ $row->id }}"
                                            data-bs-toggle="modal" data-bs-target="#categoryModal">
                                            {{ $row->name }}
                                        </a> ({{ $row->posts->count() }})
                                    </td>
                                    <td>
                                        <form action="/dashboard/categories/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button {{ $row->posts->count() ? 'disabled' : '' }} type="submit"
                                                class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3 mb-0">
                    {{ $categories->links() }}
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
                            <label for="name">Kategori</label>
                            <input type="text" name="name" id="name"
                                class="form-control mt-1 @error('name') is-invalid @enderror">
                            @error('name')
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

@section('script')
    <script>
        $('.addCategory').on('click', function() {
            $('#categoryModalLabel').html('Kategori Baru');
            $('input[name=_method]').val('POST');
            $('.modal form').prop('action', '/dashboard/postcategories');
            $('.modal-footer button[type=submit]').html('Simpan');
            $('#id').val('');
            $('#name').val('');
        });

        $(document).on('click', '.editCategory', function() {
            const id = $(this).data('id');
            $('input[name=_method]').val('PUT');
            $('#categoryModalLabel').html('Perbarui Kategori');
            $('.modal form').prop('action', '/dashboard/postcategories/' + id);
            $('.modal-footer button[type=submit]').html('Perbarui');
            $.ajax({
                url: '/dashboard/postcategories/' + id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                }
            });
        });
    </script>
@endsection
