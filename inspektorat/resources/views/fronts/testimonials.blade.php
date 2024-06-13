@extends('fronts.template')
@section('content')
     <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5" style="background-color: rgba(14, 29, 52, 0.9)">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-6 text-center">
                        <h3 class="text-uppercase text-white">{{ $title_bar }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="blog" class="blog mb-5">
        <div class="container" data-aos="fade-up">
            <div class="row g-5">
                <div class="col-lg">
                    {!! session('msg') !!}
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card mb-4 shadow">
                                <div class="card-body">
                                    <div class="text-center">
                                        <p class="mt-2"><i class="fas fa-star fa-4x text-warning"></i></p>
                                        <p style="font-size: 22px; font-weight: bold;" class="mb-1">
                                            {{ number_format($totalStar / $totalTesti, 2) }} /
                                            {{ number_format($totalTesti, 0, ',', '.') }}</p>
                                        <p style="font-weight: bold;" class="mb-3 small">
                                            {{ number_format($totalStar / $totalTesti, 2) }} DARI 5 BINTANG
                                            SEBANYAK {{ number_format($totalTesti, 0, ',', '.') }}
                                            SURVEY</p>

                                        <a href="/testimonials/create" class="btn common-btn btn-sm mb-2"
                                            style="background-color: rgba(14, 29, 52, 0.9)"><i
                                                class="fas fa-plus-circle me-1"></i>
                                            Tulis SURVEY</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mt-4">
                        <table id="" class="table table-bordered small" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Testimoni</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonials as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img class="img-fluid" width="50px"
                                                src="{{ $item->image ? '/storage/' . $item->image : '/assets/img/profile.png' }}"
                                                alt="{{ $item->name }}">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <input disabled id="rateStar" name="rateStar" class="rating rating-loading"
                                                data-show-clear="false" data-show-caption="false" data-size="xs"
                                                value="{{ $item->star }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3 mb-0">
                        {{ $testimonials->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
