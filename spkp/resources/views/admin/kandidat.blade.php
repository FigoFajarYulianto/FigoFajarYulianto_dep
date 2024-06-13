@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Data</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Kandidat</a></li>
            </ol>
        </div>
    </div>
    <!-- Main content -->


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ $title_bar }}
                    <a href="/admin/kandidats/create" class="ml-1"><i class="fa fa-plus-circle"></i></a>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table id="basic-dt" class="table table-striped text-center display nowrap w-100"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kandidat</th>
                                    {{--  <th>Jenis Kelamin</th>  --}}
                                    {{--  <th>No Telphone</th>  --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($kandidats as $no => $kandidat)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td><a href="/admin/kandidats/{{ $kandidat->id }}/edit">{{ $kandidat->nama ?? '' }}
                                            </a></td>
                                        {{--  <td>{{ $kandidat->jk == 'L' ? 'laki-laki' : 'perempuan' }}</td>  --}}
                                        {{--  <td>{{ $kandidat->telp }}</td>  --}}

                                        <td>
                                            {{--  <a class="btn btn-info text-white btn-sm"
                                                    href="/dashboard/kandidats/{{ $kandidat->id }}/show"
                                                    data-toggle="tooltip" data-placement="bottom" title="lihat data"><span
                                                        class="glyphicon glyphicon-eye-open"></span></a>  --}}

                                            <form action="/admin/kandidats/{{ $kandidat->id }}" method="post">
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
                    {{--  <a href="/dashboard/kandidats/create"
                        class="margin-bottom-2 btn btn-primary btn-sm btn-rounded btn-fw"><i class="fa fa-plus"></i>
                        Tambah Kandidat</a>  --}}

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection



@push('javascript')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
@endpush
