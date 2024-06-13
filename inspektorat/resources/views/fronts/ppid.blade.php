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

    <?php $ppid = \App\Http\Helpers\ApiPPID::getNews(); ?>
    <section class="recent-posts
                        blog-area three pt-100 pb-70 " style="background-color: #f9f9f9"
        id="ppid">
        <div class="container">
            <div class="row">
                @foreach (array_slice($ppid, 0, 9) as $row)
                    <div class="col-sm-6 col-lg-4">
                        <div class="blog-item">
                            <div class="top">
                                <a target="_blank" href="https://ppid.jemberkab.go.id/berita-ppid/detail/{{ $row['slug'] }}">
                                    <img src="https://ppid.jemberkab.go.id/{{ str_replace('public/', 'storage/', $row['foto_berita']) }}"
                                        alt="{{ $row['judul_berita'] }}">
                                </a>
                            </div>

                            <div class="bottom">
                                <ul>
                                    <li>
                                        <i class="icofont-calendar" style="color: rgba(14, 29, 52, 0.9)"></i>
                                        <span>{{ date('d/m/Y', strtotime($row['created_at'])) }}</span>
                                    </li>
                                    <li>
                                        <i class="icofont-user-alt-3" style="color: rgba(14, 29, 52, 0.9)"></i>
                                        <a target="_blank"
                                            href="https://ppid.jemberkab.go.id/berita-ppid/detail/{{ $row['slug'] }}">{{ $row['diposting_oleh'] }}</a>
                                    </li>
                                </ul>
                                <h3>
                                    <a target="_blank"
                                        href="https://ppid.jemberkab.go.id/berita-ppid/detail/{{ $row['slug'] }}">{{ $row['judul_berita'] }}</a>
                                </h3>
                                <div class="card border-0">
                                    <p>{{ Str::substr(strip_tags($row['ringkasan_berita']), 0, 98) }} ...</p>
                                </div>
                                <a target="_blank" class="blog-btn" style="color: rgba(14, 29, 52, 0.9)"
                                    href="https://ppid.jemberkab.go.id/berita-ppid/detail/{{ $row['slug'] }}">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
