@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Ubah Kandidat
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/dashboard/kandidats">Data Kandidat</a></li>
            <li class="active">Ubah Kandidat</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary">
                    <!-- form start -->
                    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3"
                        action="/admin/kandidats/{{ $kandidat->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" value="PUT" name="_method">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input value="{{ old('nama') ? old('nama') : $kandidat->nama }}"
                                    class="form-control {{ $errors->first('nama') ? 'is-invalid' : '' }}"
                                    placeholder="Full Name" type="text" name="nama" id="nama" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>

                            </div>
                            {{--  <div class="form-group">
                                <label for="siswa_id">Nama Kandidat</label>
                                <select name="siswa_id" id="siswa_id"
                                    class="form-control @error('siswa_id') is-invalid @enderror">
                                    <option value="">:: Pilih ::</option>
                                    @foreach ($siswas as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('siswa_id', $kandidat->siswa->id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('siswa_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>  --}}
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select name="jk" class="form-control" id="jk">
                                    <option value=""></option>
                                    <option value="L" {{ $kandidat->jk === 'L' ? 'selected' : '' }}>Laki - Laki
                                    </option>
                                    <option value="P" {{ $kandidat->jk === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <div class="invalid-feedback">
                                    {{ $errors->first('jk') }}
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input value="{{ old('tanggal_lahir') ? old('tanggal_lahir') : $kandidat->tanggal_lahir }}"
                                    class="form-control {{ $errors->first('tanggal_lahir') ? 'is-invalid' : '' }}"
                                    type="date" name="tanggal_lahir" id="tanggal_lahir" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanggal_lahir') }}
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input value="{{ old('alamat') ? old('alamat') : $kandidat->alamat }}"
                                    class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}"
                                    placeholder="Alamat" type="text" name="alamat" id="alamat" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('alamat') }}
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="telp">No Telpon</label>
                                <input value="{{ old('telp') ? old('telp') : $kandidat->telp }}"
                                    class="form-control {{ $errors->first('telp') ? 'is-invalid' : '' }}"
                                    placeholder="No Telpon" type="text" name="telp" id="telp" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('telp') }}
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input value="{{ old('foto') }}"
                                    class="form-control {{ $errors->first('foto') ? 'is-invalid' : '' }}" type="file"
                                    name="foto" id="foto" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('foto') }}
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">ubah</button>
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
