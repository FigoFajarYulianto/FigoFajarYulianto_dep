@extends('frontend.template')
@section('content')
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-10 text-center">
                        <h2 style="font-size: 40px">{{ $title_bar }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="blog-area three pt-100 pb-70" style="background-color: #f9f9f9">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($services as $row)
                    <div class="bg-image col-6 col-sm-6 col-lg-2 my-4">
                        <div class="blog-item">
                            <a href="{{ $row->link }}">
                                <img src="/storage/{{ $row->image }}" class="w-100 rounded-top" />
                                <div class="mask text-light d-flex justify-content-center flex-column text-center">
                                    <a href="/servicecategories/{{ $row->slug }}" class="m-1 stretched-link"
                                        style="color: black">{{ $row->name }}</a>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="blog-area three pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>{{ $title_post->title }}</h2>
            </div>
            <div class="row">
                <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        @foreach ($posts as $row)
                            <div class="swiper-slide">
                                <div class="blog-item" style="margin: 10px">
                                    <div class="top">
                                        <a href="/posts/{{ $row->slug }}">
                                            <img src="/storage/{{ $row->image }}" alt="{{ $row->title }}">
                                        </a>
                                    </div>
                                    <div class="bottom">
                                        <ul>
                                            <li>
                                                <i class="icofont-calendar"></i>
                                                <span>{{ date('d/m/Y', strtotime($row->created_at)) }}</span>
                                            </li>
                                        </ul>
                                        <h3>
                                            <a href="/posts/{{ $row->slug }}">{{ $row->title }}</a>
                                        </h3>
                                        <p>{{ Str::substr(strip_tags($row->body), 0, 98) }}</p>
                                        <a class="blog-btn" href="/posts/{{ $row->slug }}">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <br><br>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
