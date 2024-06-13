@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col mb-4">
                <div class="card h-100">
                    <div class="card-body h-100 p-5">
                        <div class="row align-items-center">
                            <div class="col-md">
                                <div class="text-xl-start">
                                    <h1 class="text-primary">Halo,
                                        <strong>{{ auth()->user()->name }}</strong>
                                    </h1>
                                    <p class="text-gray-700 mb-0">Selamat datang kembali di Dashboard</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
