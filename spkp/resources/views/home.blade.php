@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi Ujian</h4>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Selamat Datang!
                    </p>
                    <a href="{{ route('daftar-ujian') }}" class="btn btn-primary">Mulai Ujian</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="/assets/img/user.jpg"
                            alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ auth()->user()->nama }}</h3>


                    <p class="text-muted text-center">{{ auth()->user()->rombel->nama }}</p>



                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-block"><b>Keluar</b></button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
