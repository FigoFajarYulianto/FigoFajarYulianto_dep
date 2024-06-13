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
                <div class="col-lg">
                    <div class="details-item">
                        <div class="details-img">
                            <center>
                                <img src="/storage/{{ $page->image }}" class="img-fluid" alt="Details">
                            </center>
                            <h2>{{ $page->title }}</h2>
                            <p>{!! $page->body !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
