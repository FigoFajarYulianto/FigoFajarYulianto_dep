@extends('frontend.template')
@section('content')
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('assets/img/page-header.jpg');">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2>{{ $title_bar }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section- id="about" class="about">
        <div class="container" data-aos="fade-up">
            <img src="/storage/{{ $page->image }}" class="img-fluid mb-3" alt="">
            {!! $page->body !!}
            <div class="my-3 d-inline-block">
                <p class="small mb-1">Bagikan ke:</p>
                <div class="addthis_inline_share_toolbox"></div>
            </div>
        </div>
    </section->

    <?php $sectionPost = \App\Models\Section::getSection('posts'); ?>
    @if ($sectionPost)
        <?php $posts = \App\Models\Post::orderBy('id', 'ASC')->get(); ?>
        <section class="testimonials sections-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-header py-4"><span><?= $sectionPost->name ?></span>
                    <h2><?= $sectionPost->name ?></h2>
                </div>
                <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        @foreach ($posts as $row)
                            <div class="swiper-slide">
                                <div class="testimonial-wrap">
                                    <div class="testimonial-item">
                                        <a href="/posts/{{ $row->slug }}">
                                            <img src="/storage/{{ $row->image }}" class="img-fluid"
                                                alt="{{ $row->title }}">
                                        </a>
                                        <h3>
                                            <a href="/posts/{{ $row->slug }}">{{ $row->title }}</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endif
@endsection
