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
                                        <i class="icofont-calendar" style="color: rgba(14, 29, 52, 0.9)"></i>
                                        <span>{{ date('d/m/Y', strtotime($item->created_at)) }}</span>
                                    </li>
                                    <li>
                                        <i class="icofont-user-alt-3" style="color: rgba(14, 29, 52, 0.9)"></i>
                                        <a href="/posts?author={{ $item->user->username }}">{{ $item->user->name }}</a>
                                    </li>
                                </ul>
                                <h6 class="post-category">
                                    <a href="/posts?category={{ $item->category->slug }}">{{ $item->category->name }}</a>
                                </h6>
                                <h3>
                                    <a href="/posts/{{ $item->slug }}">{{ $item->title }}</a>
                                </h3>
                                <div class="card border-0">
                                    <p>{{ Str::substr(strip_tags($item->body), 0, 98) }}</p>
                                </div>
                                <a class="blog-btn" style="color: rgba(14, 29, 52, 0.9)"
                                    href="/posts/{{ $item->slug }}">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-start my-4">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection
