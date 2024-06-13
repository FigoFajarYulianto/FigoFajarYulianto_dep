@extends('frontend.template')
@section('content')
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-6 text-center">
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
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4 posts-list">
                @foreach ($posts as $row)
                    <div class="col-xl-4 col-md-6">
                        <article>
                            @if ($row->image)
                                <div class="post-img">
                                    <img src="/storage/{{ $row->image }}" alt="{{ $row->title }}" class="img-fluid">
                                </div>
                            @endif
                            <p class="post-category">
                                <a href="/posts?category={{ $row->postcategory->slug }}">{{ $row->postcategory->name }}</a>
                            </p>
                            <h4 class="title"><a href="/posts/{{ $row->slug }}"
                                    style="color: black">{{ $row->title }}</a></h4>
                            <div class="d-flex align-items-center">
                                {{-- <img src="{{ $row->user->photo ? '/storage/' . $row->user->photo : '/assets/img/profile.png' }}"
                                    alt="{{ $row->user->name }}" class="img-fluid post-author-img flex-shrink-0"> --}}
                                <div class="post-meta">
                                    <p class="post-author-list">
                                        <a href="/posts?author={{ $row->user->username ?? '' }}">{{ $row->user->name ?? '' }}</a>
                                    </p>
                                    <p class="post-date">
                                        <time
                                            datetime="{{ date('Y-m-d', strtotime($row->created_at)) }}">{{ date('d/m/Y', strtotime($row->created_at)) }}</time>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-start my-4">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection
