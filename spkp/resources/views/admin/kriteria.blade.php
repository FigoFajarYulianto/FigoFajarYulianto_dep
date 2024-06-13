@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Data</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Kriteria</a></li>
            </ol>
        </div>
    </div>
    <!-- Main content -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ $title_bar }}
                    <a href="/admin/kriterias/create" class="ml-1"><i class="fa fa-plus-circle"></i></a>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table id="tableStandart" class="table table-striped text-center display nowrap w-100"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kriteria</th>
                                    <th>Atribut</th>
                                    <th>Bobot</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($kriterias as $no => $kriteria)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td><a href="/admin/kriterias/{{ $kriteria->id }}/edit">{{ $kriteria->nama ?? '' }}
                                            </a></td>
                                        <td>{{ $kriteria->atribut }}</td>
                                        <td>{{ $kriteria->bobot }}</td>
                                        {{--  <td>{{ $kriteria->keterangan }}</td>  --}}
                                        <td>
                                            <form action="/admin/kriterias/{{ $kriteria->id }}" method="post">
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
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    @include('sweetalert::alert')
    <script>
        // Hapus Kelas
        $(document).on('click', '.btn-hapus', function() {
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
                        success: function(res) {
                            if (res.status) {
                                Swal.fire("Berhasil", 'Kelas berhasil dihapus', 'success')
                                table.draw()
                            }
                        }
                    })
                }
            })
        })
    </script>
@endsection
@push('javascript')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
@endpush
