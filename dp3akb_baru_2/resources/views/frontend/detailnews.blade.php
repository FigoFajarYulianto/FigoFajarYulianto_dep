@extends('frontend.template')
@section('content')
<div class="breadcrumbs">
    <div class="page-header d-flex align-items-center">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 text-center"></div>
            </div>
        </div>
    </div>
    <nav>
        <div class="container">
            <ol class="text-muted">
                <li><a href="/">Beranda</a></li>
                <li>{{ $post->title }}</li>
            </ol>
        </div>
    </nav>
</div>
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="row g-5">
            <div class="col-lg-8">
                <article class="blog-details">
                    @if ($post->image)
                    <div class="post-ismg">
                        <img src="/storage/{{ $post->image }}" alt="{{ $post->title }}" class="img-fluid rounded">
                    </div>
                    @endif
                    <h2 class="title">{{ $post->title }}</h2>
                    <div class="meta-top">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                                <a href="/posts?author={{ $post->user->username ?? '' }}">{{ $post->user->name ?? '' }}</a>
                            </li>
                            <li class="d-flex align-items-center"><i class="bi bi-tag"></i>
                                <a href="/posts?postcategory={{ $post->postcategory->slug }}">{{ $post->postcategory->name }}</a>
                            </li>
                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
                                <time datetime="{{ date('Y-m-d', strtotime($post->created_at)) }}">{{ date('d/m/Y', strtotime($post->created_at)) }}</time></a>
                            </li>
                        </ul>
                    </div>
                    <div class="content">
                        {!! Str::replace('<img src="', '<img class=" img-fluid" src="', $post->body) !!}
                        </div>

                        <div class=" my-3 d-inline-block">
                        <p class="small mb-1">Bagikan ke:</p>
                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                </article>
            </div>
            @include('frontend.sidebar')
        </div>
    </div>
</section>
@endsection