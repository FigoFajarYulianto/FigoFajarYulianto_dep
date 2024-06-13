@extends('dashboard.template')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card shadow">
                <div class="card-body">
                    <a href="/dashboard/consultationreplies" class="me-2"><i class="fa fa-arrow-circle-left"></i></a>
                    <h4 class="card-title">Tambah Menu Hidangan</h4>
                    <form class="form-sample" action="/dashboard/consultationreplies/create" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="consultation_id">Consultation Id</label>
                                    <input type="number" name="consultation_id" id="consultation_id" class="form-control"
                                        value="">
                                    @error('consultation_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="user_id">User Id</label>
                                    <input type="number" name="user_id" id="user_id" class="form-control" value="">
                                    @error('user_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="lampiran">Lampiran</label>
                            <input class="form-control mt-1 @error('lampiran') is-invalid @enderror" name="lampiran"
                                type="text" id="lampiran" value="" />
                            @error('lampiran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="pesan">Pesan</label>
                            <textarea class="form-control @error('pesan') is-invalid @enderror " name="pesan" id="pesan" rows="5"></textarea>
                            @error('pesan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
