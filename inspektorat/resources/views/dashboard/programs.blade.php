@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        {{ $title_bar }}
                        <a href="javascript:void(0)" class="ml-1 addProgram" data-bs-toggle="modal"
                            data-bs-target="#programModal"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="customTable" class="display expandable-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kategori</th>
                                            <th>Slug</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($programs as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" class="editProgram"
                                                        data-id="{{ $row->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#programModal">
                                                        {{ $row->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $row->slug }}</td>
                                                <td>
                                                    <form action="/dashboard/programs/{{ $row->id }}" method="post">
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
                                    {{ $programs->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="programModal" tabindex="-1" aria-labelledby="programModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="programModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Kategori Program</label>
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
        $(".addProgram").on("click", function() {
            $("#programModalLabel").html("Kategori Program Baru");
            $("input[name=_method]").val("POST");
            $(".modal form").prop("action", "/dashboard/programs");
            $(".modal-footer button[type=submit]").html("Simpan");
            $("#id").val("");
            $("#name").val("");
        });

        $(document).on("click", ".editProgram", function() {
            const id = $(this).data("id");
            $("input[name=_method]").val("PUT");
            $("#programModalLabel").html("Perbarui Kategori Program ");
            $(".modal form").prop("action", "/dashboard/programs/" + id);
            $(".modal-footer button[type=submit]").html("Perbarui");
            $.ajax({
                url: "/dashboard/programs/" + id,
                method: "get",
                dataType: "json",
                success: function(response) {
                    $("#id").val(response.id);
                    $("#name").val(response.name);
                },
            });
        });
    </script>
@endsection
