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

    <div class="blog-details-area pt-5 pb-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="details-item">
                        <div class="details-img">
                            <center>
                                <img src="/storage/{{ $post->image }}" class="img-fluid" alt="Details">
                            </center>
                            <ul>
                                <li>
                                    <i class="icofont-calendar"></i>
                                    {{ date_format($post->created_at, 'd/m/Y') }}
                                </li>
                                <li>
                                    <i class="icofont-user-alt-3"></i>
                                    <a href="/posts?author={{ $post->user->username }}">{{ $post->user->name }}</a>
                                </li>
                            </ul>
                            <h2>{{ $post->title }}</h2>
                            <p>{!! $post->body !!}</p>
                        </div>
                    </div>

                    <div class="my-3 d-inline-block">
                        <p class="small mb-1">Bagikan ke:</p>
                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                </div>

                @include('frontend.sidebarnews')
            </div>
        </div>
    </div>
@endsection
