@extends('layouts.admin')
@section('content')
    <h4 class="card-title text-uppercase">
        <a href="/dashboard/kandidats" class="mr-1">
            <i class="fa fa-arrow-circle-left"></i></a>
        {{ $title_bar }}
    </h4>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary">
                    <!-- form start -->
                    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="/admin/kandidats/create"
                        method="POST">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input value="{{ old('nama') }}"
                                    class="form-control {{ $errors->first('nama') ? 'is-invalid' : '' }}"
                                    placeholder="Full Name" type="text" name="nama" id="nama" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>

                            </div>
                            {{--  <div class="form-group">
                                <label for="rombel_id">Nama Kandidat</label>
                                <select name="siswa_id" id="siswa_id"
                                    class="form-control @error('siswa_id') is-invalid @enderror">
                                    <option value="">:: Pilih ::</option>
                                    @foreach ($siswas as $row)
                                        <option value="{{ $row->id }}"
                                            {{ old('siswa_id') == $row->id ? 'selected' : '' }}>
                                            {{ $row->nama }}
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
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <div class="invalid-feedback">
                                    {{ $errors->first('jk') }}
                                </div>

                            </div>
                            {{--  <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                    <option value=""></option>
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <div class="invalid-feedback">
                                    {{ $errors->first('jenis_kelamin') }}
                                </div>

                            </div>  --}}
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input value="{{ old('tanggal_lahir') }}"
                                    class="form-control {{ $errors->first('tanggal_lahir') ? 'is-invalid' : '' }}"
                                    type="date" name="tanggal_lahir" id="tanggal_lahir" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanggal_lahir') }}
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input value="{{ old('alamat') }}"
                                    class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}"
                                    placeholder="Alamat" type="text" name="alamat" id="alamat" />
                                <div class="invalid-feedback">
                                    {{ $errors->first('alamat') }}
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="telp">No Telpon</label>
                                <input value="{{ old('telp') }}"
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
