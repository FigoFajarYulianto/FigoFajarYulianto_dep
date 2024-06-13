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
                                    <i class="icofont-calendar" style="color: rgba(14, 29, 52, 0.9)"></i>
                                    {{ date_format($post->created_at, 'd/m/Y') }}
                                </li>
                                <li>
                                    <i class="icofont-user-alt-3" style="color: rgba(14, 29, 52, 0.9)"></i>
                                    <a href="/posts?author={{ $post->user->username }}">{{ $post->user->name }}</a>
                                </li>
                            </ul>
                            
                            <div class="card border-0">
                                <p>{!! $post->body !!}</p>
                            </div>
                        </div>
                    </div>

                    <div class="my-3 d-inline-block">
                        <p class="small mb-1">Bagikan ke:</p>
                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                </div>

                @include('fronts.sidebarnews')
            </div>
        </div>
    </div>
@endsection
