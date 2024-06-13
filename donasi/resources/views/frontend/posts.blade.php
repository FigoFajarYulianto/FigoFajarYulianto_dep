@extends('frontend.template')
@section('content')
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-10 text-center">
                        <h2>{{ $title_bar }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol class="text-muted">
                    <li><a href="/">Beranda</a></li>
                    <li>{{ $title_bar }}</li>
                </ol>
            </div>
        </nav>
    </div>

    <section class="blog-area three pt-5 pb-5 mb-5">
        <div class="container">
            <div class="row">
                @foreach ($posts as $item)
                    <div class="col-sm-6 col-lg-4">
                        <div class="blog-item">
                            <div class="top">
                                <a href="/posts/{{ $item->slug }}">
                                    <img src="/storage/{{ $item->image }}" alt="{{ $item->title }}">
                                </a>
                            </div>
                            <div class="bottom">
                                <ul>
                                    <li>
                                        <i class="icofont-calendar"></i>
                                        <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                    </li>
                                    <li>
                                        <i class="icofont-user-alt-3"></i>
                                        <a href="/posts?author={{ $item->user->username }}">{{ $item->user->name }}</a>
                                    </li>
                                </ul>
                                <h3>
                                    <a href="/posts/{{ $item->slug }}">{{ $item->title }}</a>
                                </h3>
                                <p>{{ Str::substr(strip_tags($item->body), 0, 98) }}</p>
                                <a class="blog-btn" href="/posts/{{ $item->slug }}">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-start my-4">
                {{ $posts->links() }}
            </div>
            {{-- <div class="pagination-area">
                <ul>
                    <li>
                        <a href="#">Prev</a>
                    </li>
                    <li>
                        <a class="active" href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">Next</a>
                    </li>
                </ul>
            </div> --}}
        </div>
    </section>
@endsection
