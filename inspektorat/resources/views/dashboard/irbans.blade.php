@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        {{ $title_bar }}
                        <a href="javascript:void(0)" class="ml-1 addIrban" data-bs-toggle="modal"
                            data-bs-target="#irbanModal"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="customTable" class="display expandable-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>IRBAN</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($irbans as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>
                                                    <a href="javascript:void(0)" class="editIrban"
                                                        data-id="{{ $row->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#irbanModal">
                                                        {{ $row->nama }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="/dashboard/irbans/{{ $row->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin ingin menghapus data ini?');"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pull-right">
                                    {{ $irbans->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="irbanModal" tabindex="-1" aria-labelledby="irbanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="irbanModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">IRBAN</label>
                            <input type="text" name="nama" id="nama"
                                class="form-control mt-1 @error('nama') is-invalid @enderror">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="5"
                                class="form-control mt-1 @error('keterangan') is-invalid @enderror"></textarea>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inspektur">Nama Inspektur</label>
                            <input type="text" name="inspektur" id="inspektur"
                                class="form-control mt-1 @error('inspektur') is-invalid @enderror">
                            @error('inspektur')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" id="nip"
                                class="form-control mt-1 @error('nip') is-invalid @enderror">
                            @error('nip')
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
        $(".addIrban").on("click", function() {
            $("#irbanModalLabel").html("IRBAN Baru");
            $("input[name=_method]").val("POST");
            $(".modal form").prop("action", "/dashboard/irbans");
            $(".modal-footer button[type=submit]").html("Simpan");
            $("#id").val("");
            $("#nama").val("");
            $("#keterangan").val("");
            $("#inspektur").val("");
            $("#nip").val("");
        });

        $(document).on("click", ".editIrban", function() {
            const id = $(this).data("id");
            $("input[name=_method]").val("PUT");
            $("#irbanModalLabel").html("Perbarui IRBAN");
            $(".modal form").prop("action", "/dashboard/irbans/" + id);
            $(".modal-footer button[type=submit]").html("Perbarui");
            $.ajax({
                url: "/dashboard/irbans/" + id,
                method: "get",
                dataType: "json",
                success: function(response) {
                    $("#id").val(response.id);
                    $("#nama").val(response.nama);
                    $("#keterangan").val(response.keterangan);
                    $("#inspektur").val(response.inspektur);
                    $("#nip").val(response.nip);
                },
            });
        });
    </script>
@endsection
