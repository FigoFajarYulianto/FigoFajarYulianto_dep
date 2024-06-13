@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        {{ $title_bar }}
                        <a href="javascript:void(0)" class="ml-1 addstatusCategory" data-bs-toggle="modal"
                            data-bs-target="#categorystatusModal"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="customTable" class="display expandable-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Status</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($status as $row)
                                            <tr>
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" class="editstatusCategory"
                                                        data-id="{{ $row->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#categorystatusModal">
                                                        {{ $row->name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="/dashboard/kategories/{{ $row->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            {{ $row->id == 1 || $row->kopijs->count() > 0 ? 'disabled' : '' }}
                                                            type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin ingin menghapus data ini?');"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pull-right">
                                    {{ $status->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="categorystatusModal" tabindex="-1" aria-labelledby="categorystatusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categorystatusModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Status</label>
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
        $(".addstatusCategory").on("click", function() {
            $("#categorystatusModalLabel").html("Status Baru");
            $("input[name=_method]").val("POST");
            $(".modal form").prop("action", "/dashboard/kategories");
            $(".modal-footer button[type=submit]").html("Simpan");
            $("#id").val("");
            $("#name").val("");
        });


        $(document).on("click", ".editstatusCategory", function() {
            const id = $(this).data("id");
            $("input[name=_method]").val("PUT");
            $("#categorystatusModalLabel").html("Perbarui Status");
            $(".modal form").prop("action", "/dashboard/kategories/" + id);
            $(".modal-footer button[type=submit]").html("Perbarui");
            console.log(id);
            $.ajax({
                url: "/dashboard/kategories/" + id,
                method: "get",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $("#id").val(response.id);
                    $("#name").val(response.name);
                },
            });
        });
    </script>
@endsection
