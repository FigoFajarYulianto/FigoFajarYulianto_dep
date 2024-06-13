@extends('layouts.admin')
@section('title', 'Kelas')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambah"><i
                                class="fas fa-plus"></i> Tambah Kelas</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center display nowrap" id="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{--  <div class="layout-px-spacing">
        <div class="layout-top-spacing mb-2">
            <div class="col-md-12">
                <div class="row">
                    <div class="container p-0">
                        <div class="row layout-top-spacing date-table-container">
                            <!-- BASIC -->
                            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                <div class="widget-content widget-content-area br-6">
                                    <h4 class="table-header">Basic</h4>
                                    <div class="table-responsive mb-4">
                                        <table id="basic-dt" class="table table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Office</th>
                                                    <th>Age</th>
                                                    <th>Start date</th>
                                                    <th>Salary</th>
                                                    <th class="no-content"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Sonya Frost</td>
                                                    <td>Software Engineer</td>
                                                    <td>Edinburgh</td>
                                                    <td>23</td>
                                                    <td>2008/12/13</td>
                                                    <td>$103,600</td>
                                                    <td><a href="#" title="Edit" class="font-20 text-primary"><i
                                                                class="las la-edit"></i></a></td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}

    {{-- Modal Tambah --}}
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kelas</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="formTambah">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addNama">Nama Kelas</label>
                            <input type="text" name="nama" class="form-control" id="addNama"
                                placeholder="Masukkan Nama Kelas">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Kelas</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="formEdit">
                    @method('PUT')
                    <input type="hidden" id="editId">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editNama">Nama Kelas</label>
                            <input type="text" name="nama" class="form-control" id="editNama"
                                placeholder="Masukkan Nama Kelas">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/admin/kelas.js') }}"></script>
    {{-- <script>
    const table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: URL_ADMIN + '/kelas/datatable'
        },
        columns: [
            {data: 'index', name: 'id'},
            {data: 'nama'},
            {data: 'opsi', name: 'id'}
        ]
    })

    // Tambah Kelas
    const modalTambah = $('#modalTambah')
    $('#formTambah').on('submit', function (e) {
        e.preventDefault();
        const form = new FormData(this)

        $.post({
            url: URL_ADMIN + '/kelas',
            processData: false,
            contentType: false,
            data: form,
            success: function (res) {
                $(this).trigger('reset')
                modalTambah.modal('hide')
                table.draw()
                Swal.fire('Berhasil', 'Kelas berhasil ditambahkan', 'success')
            }
        })
    })

    // Edit Kelas
    const modalEdit = $('#modalEdit')
    const formEdit = document.getElementById('formEdit')
    $(document).on('click', '.btn-edit', function () {
        const data = $(this).data()

        $('#editId').val(data.id)
        $('#editNama').val(data.nama)

        modalEdit.modal('show')
    })

    formEdit.addEventListener('submit', function (e) {
        e.preventDefault();
        const id = document.getElementById('editId').value
        const form = new FormData(this)

        $.post({
            url: URL_ADMIN + '/kelas/' + id,
            processData: false,
            contentType: false,
            data: form,
            success: function (res) {
                Swal.fire('Berhasil', 'Kelas berhasil diperbarui', 'success')
                table.draw()
                modalEdit.modal('hide')
            }
        })
    })

    // Hapus Kelas
    $(document).on('click', '.btn-hapus', function () {
        const data = $(this).data()

        Swal.fire({
            title: "Hapus Kelas?",
            html: '<div class="alert alert-danger">Menghapus kelas akan menghapus data lainnya yang terkait</div>',
            icon: "question",
            showCancelButton: true,
            cancelButtonText: "Tidak",
            confirmButtonText: "Ya, hapus!"
        }).then(hapus => {
            if (hapus.value) {
                $.ajax({
                    url: URL_ADMIN + '/kelas/' + data.id,
                    type: "DELETE",
                    success: function (res) {
                        if (res.status) {
                            Swal.fire("Berhasil", 'Kelas berhasil dihapus', 'success')
                            table.draw()
                        }
                    }
                })
            }
        })
    })

</script> --}}
@endpush
