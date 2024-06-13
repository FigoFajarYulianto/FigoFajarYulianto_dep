@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Nilai Kandidat
        </h1>
        <div class="row">
            <div class="col-md-6">
                <ol class="breadcrumb">
                    <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Nilai Kandidat</li>
                </ol>
            </div>
            <div class="col-md-6" style="text-align: right">
                <form action="/admin/nilais_all" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus Semua Data <i
                            class="fa fa-trash"></i></button>
                </form>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-body">
                        <div class="table table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="20vh">No</th>
                                        <th>Nama</th>
                                        @foreach ($kriteria as $krit)
                                            <th>{{ $krit->nama }}</th>
                                        @endforeach
                                        <th width="100vh">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @if (!empty($kandidat))
                                        {{-- variable $kandidat berisi nilai dari setiap kriteria per mahasiswa --}}
                                        @foreach ($kandidat as $kdt)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $kdt->nama }}</td>
                                                @if (count($kdt->nilai) == 0)
                                                    @foreach ($kriteria as $krit)
                                                        <td><i>Tidak ada data</i></td>
                                                    @endforeach
                                                @endif
                                                @foreach ($kdt->nilai as $nilai)
                                                    <td>{{ $nilai->nilai }}</td>
                                                @endforeach
                                                <td class="text-center">
                                                    @if (count($kdt->nilai) == 0)
                                                        <a href="/admin/nilais/{{ $kdt->id }}/create"
                                                            class="btn btn-sm btn-primary mb-3" data-toggle="tooltip"
                                                            data-placement="bottom" title="tambah data"><i
                                                                class="fa fa-plus"></i>
                                                        </a>
                                                    @else
                                                        <a href="/admin/nilais/{{ $kdt->id }}/edit"
                                                            class="btn btn-sm btn-warning mb-3" data-toggle="tooltip"
                                                            data-placement="bottom" title="ubah data"><span
                                                                class="fa fa-edit"></span>
                                                        </a>
                                                    @endif
                                                    <form action="/admin/nilais/{{ $nilai->id ?? '' }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin ingin menghapus data ini?');"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <a href="{{ url('/admin/perhitungan') }}"
                            class="margin-bottom-2 btn btn-primary btn-sm btn-rounded btn-fw"><span
                                class="glyphicon glyphicon-eye-open"></span> Perhitungan MWP</a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
@push('javascript')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
@endpush
