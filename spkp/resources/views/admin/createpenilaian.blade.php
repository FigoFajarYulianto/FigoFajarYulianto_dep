@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Tambah Penilaian Kandidat
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/dashboard/nilais">Data Kandidat</a></li>
            <li class="active">Tambah Penilaian Kandidat</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary">
                    <div class="box-body">
                        <form role="form" action="/admin/nilais/{{ $kandidat->id }}" method="post">
                            @csrf
                            @if (!empty($kandidat))
                                <div class="form-group">
                                    <label for="mahasiswa">Nama Kandidat</label>
                                    <input type="hidden" name="kandidat_id" value="{{ $kandidat->id }}">
                                    <input type="text" class="form-control" value="{{ $kandidat->nama }}" readonly>
                                </div>
                                @foreach ($master_kriteria as $kriteria)
                                    <div class="form-group">
                                        <label for="{{ $kriteria->nama }}">{{ $kriteria->nama }}</label>
                                        <input type="text" class="form-control" name="kriteria_id[{{ $kriteria->id }}]"
                                            placeholder="Isi nilai">
                                        @if ($errors->has($kriteria->nama))
                                            <div class="text-danger">{{ $errors->first($kriteria->nama) }}</div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="form-group text-center">
                                    Data Tidak Ditemukan
                                </div>
                            @endif
                            <div class="box-footer">
                                @if (!empty($kandidat))
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                @else
                                    <a href="/dashboard/nilais" class="btn btn-primary">
                                        <i class="fas fa-arrow-left"></i>
                                        Back
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
