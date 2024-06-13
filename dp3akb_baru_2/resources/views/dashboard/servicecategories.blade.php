@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="javascript:void(0)" class="ms-2 addMenu" data-bs-toggle="modal" data-bs-target="#menuModal">
                        <?= in_array('Kategori Layanan.store', $roles) ? "<i class='fas fa-plus-circle fa-lg'></i>" : '' ?>
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
                                <th>NAMA KATEGORI</th>
                                <th>LAYANAN</th>
                                <th>IMAGE</th>
                                <th>HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($servicecategories as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="editMenu" data-id="{{ $row->id }}"
                                            data-bs-toggle="modal" data-bs-target="#menuModal"
                                            <?= in_array('Kategori Layanan.show', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>>{{ $row->name }}</a>
                                    </td>
                                    <td>{{ $row->service->name }}</td>
                                    <td>
                                        <img src="{{ $row->image ? '/storage/' . $row->image : '/assets/img/noimage.jpeg' }}"
                                            class="img-thumbnail" width="100px">
                                    </td>
                                    <td>
                                        <form action="/dashboard/servicecategories/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"
                                                <?= in_array('Kategori Layanan.destroy', $roles) ? '' : 'Disabled' ?>><i
                                                    data-feather="trash-2"></i></button>
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

    <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="menuModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="service_id">Layanan</label>
                            <select name="service_id" id="service_id"
                                class="form-control @error('service_id') is-invalid @enderror">
                                <option value="">:: Pilih ::</option>
                                @foreach ($services as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                            @error('link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Nama Kategori Layanan</label>
                            <input type="text" name="name" id="name"
                                class="form-control mt-1 @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="slug">SLUG</label>
                            <input type="text" name="slug" id="slug"
                                class="form-control mt-1 @error('slug') is-invalid @enderror" readonly>
                            @error('slug')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <label for=""></label>
                                <img id="image" class="img-thumbnail imagePreview" width="100px">
                            </div>
                            <div class="col-md-10 mb-3">
                                <div class="form-group">
                                    <label for="image">Gambar</label>
                                    <div class="input-group">
                                        <input type="file" name="image" id="image"
                                            class="form-control mt-1 @error('image') is-invalid @enderror"
                                            onchange="previewImage('image', 'imagePreview')">
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
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
        // Modal Menu
        $(".addMenu").on("click", function() {
            $("#menuModalLabel").html("Kategori Layanan Baru");
            $("input[name=_method]").val("POST");
            $(".modal form").prop("action", "/dashboard/servicecategories").prop("enctype", "multipart/form-data");
            $(".modal-footer button[type=submit]").html("Simpan");
            $("#id").val("");
            $("#name").val("");
            $("#slug").val("");
            $("#image").val("");
            $('#service_id option[value=""]').prop("selected", true);
        });

        $('.editMenu').on('click ', function() {
            const id = $(this).data("id");
            $("input[name=_method]").val("PUT");
            $("#menuModalLabel").html("Perbarui Kategori Layanan");
            $(".modal form").prop("action", "/dashboard/servicecategories/" + id).prop("enctype",
                "multipart/form-data");
            $(".modal-footer button[type=submit]").html("Perbarui");
            $.ajax({
                url: "/dashboard/servicecategories/" + id,
                method: "get",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    const service_id = response.service_id ? response.service_id : "";
                    $("#id").val(response.id);
                    $("#name").val(response.name);
                    $("#slug").val(response.slug);
                    $("#image").attr("src", `/storage/` + response.image + ``);
                    $('#service_id option[value="' + service_id + '"]').prop("selected", true);
                },
            });
        });
        // End Modal Menu
    </script>
@endsection
