@extends('dashboard.template')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title text-uppercase">
                        {{ $title_bar }}
                        <a href="javascript:void(0)" class="ml-1 addIrbanWilayah" data-bs-toggle="modal"
                            data-bs-target="#irbanWilayahModal"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="customTable" class="display expandable-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Wilayah</th>
                                            <th>IRBAN</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($irbanwilayahs as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>
                                                    <a href="javascript:void(0)" class="editIrbanWilayah"
                                                        data-id="{{ $row->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#irbanWilayahModal">
                                                        {{ $row->nama }}
                                                    </a>
                                                </td>
                                                <td>{{ $row->irban->nama ?? '-' }}</td>
                                                <td>
                                                    <form action="/dashboard/irbanwilayahs/{{ $row->id }}"
                                                        method="post">
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
                                    {{ $irbanwilayahs->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="irbanWilayahModal" tabindex="-1" aria-labelledby="irbanWilayahModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="irbanWilayahModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Wilayah</label>
                            <input type="text" name="nama" id="nama"
                                class="form-control mt-1 @error('nama') is-invalid @enderror">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="irban_id">IRBAN</label>
                            <select name="irban_id" id="irban_id"
                                class="form-control mt-1 @error('irban_id') is-invalid @enderror">
                                <option value="">:: PILIH ::</option>
                                @foreach (\App\Models\Irban::orderBy('nama', 'ASC')->get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
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
@section('script')
    <script>
        $(".addIrbanWilayah").on("click", function() {
            $("#irbanWilayahModalLabel").html("IRBAN Baru");
            $("input[name=_method]").val("POST");
            $(".modal form").prop("action", "/dashboard/irbanwilayahs");
            $(".modal-footer button[type=submit]").html("Simpan");
            $("#id").val("");
            $("#nama").val("");
            $('#irban_id option[value=""]').prop('selected', true);
        });

        $(document).on("click", ".editIrbanWilayah", function() {
            const id = $(this).data("id");
            $("input[name=_method]").val("PUT");
            $("#irbanWilayahModalLabel").html("Perbarui IRBAN");
            $(".modal form").prop("action", "/dashboard/irbanwilayahs/" + id);
            $(".modal-footer button[type=submit]").html("Perbarui");
            $.ajax({
                url: "/dashboard/irbanwilayahs/" + id,
                method: "get",
                dataType: "json",
                success: function(response) {
                    $("#id").val(response.id);
                    $("#nama").val(response.nama);
                    $('#irban_id option[value="' + response.irban_id + '"]').prop('selected', true);
                },
            });
        });
    </script>
@endsection
