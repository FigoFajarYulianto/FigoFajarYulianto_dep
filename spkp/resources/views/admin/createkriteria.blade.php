@extends('layouts.admin')
@section('content')
    <h4 class="card-title text-uppercase">
        <a href="/dashboard/kriterias" class="mr-1">
            <i class="fa fa-arrow-circle-left"></i></a>
        {{ $title_bar }}
    </h4>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary">
                    <!-- form start -->
                    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="/admin/kriterias/create"
                        method="POST">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama">Nama Kriteria</label>
                                <input value="{{ old('nama') }}"
                                    class="form-control {{ $errors->first('nama') ? 'is-invalid' : '' }}"
                                    placeholder="Nama Kriteria" type="text" name="nama" id="nama" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            </div>

                            {{--  <div class="form-group">
                                <label for="ujian_id">Kriteria</label>
                                <select name="ujian_id" id="ujian_id"
                                    class="form-control @error('ujian_id') is-invalid @enderror">
                                    <option value="">:: Pilih ::</option>
                                    @foreach ($ujians as $row)
                                        <option value="{{ $row->id }}"
                                            {{ old('ujian_id') == $row->id ? 'selected' : '' }}>
                                            {{ $row->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ujian_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>  --}}
                            <div class="form-group">
                                <label for="atribut">Atribut</label>
                                <select name="atribut" class="form-control" id="atribut">
                                    <option value=""></option>
                                    <option value="benefit">Benefit</option>
                                    <option value="cost">Cost</option>
                                </select>
                                <div class="invalid-feedback">
                                    {{ $errors->first('atribut') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bobot">Bobot</label>
                                <input value="{{ old('bobot') }}"
                                    class="form-control {{ $errors->first('bobot') ? 'is-invalid' : '' }}"
                                    placeholder="Bobot" type="text" name="bobot" id="bobot" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('bobot') }}
                                </div>
                            </div>
                            {{--  <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input value="{{ old('keterangan') }}"
                                    class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}"
                                    placeholder="Keterangan" type="text" name="keterangan" id="keterangan" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('keterangan') }}
                                </div>
                            </div>  --}}
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">tambah</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
