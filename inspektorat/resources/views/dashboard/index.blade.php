@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-xxl-4 col-xl-12 mb-4">
                <div class="card h-100">
                    <div class="card-body h-100 p-5">
                        <div class="row align-items-center">
                            <div class="col-xl-8 col-xxl-12">
                                <div class="text-center text-xl-start text-xxl-center mb-4 mb-xl-0 mb-xxl-4">
                                    <h2 class="text-primary">Halo, <b>{{ auth()->user()->name }}</b></h2>
                                    <p class="text-gray-700 mb-0">Selamat Datang Kembali di Dashboard</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-xxl-12 text-center"><img class="img-fluid"
                                    src="/assets/images/user.svg" style="width: 150px" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- <div class="row">
        @if ($totalUsers)
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Total User</div>
                                <div class="text-lg fw-bold">{{ number_format($totalUsers, 0, ',', '.') }}</div>
                            </div>
                            <i class="fa fa-users fa-3x text-white-50" data-feather="users"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between small">
                        <a class="text-white stretched-link" href="/dashboard/users">Lihat User</a>
                        <div class="text-white"><i class="fa fa-arrow-right"></i></div>
                    </div>
                </div>
            </div>
        @endif
    </div> --}}
@endsection
