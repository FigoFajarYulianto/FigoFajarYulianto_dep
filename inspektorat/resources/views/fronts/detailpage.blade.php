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
                                <img src="/storage/{{ $page->image }}" class="img-fluid" alt="Details">
                            </center>
                            
                            <div class="card border-0">
                                <p>{!! $page->body !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @include('fronts.sidebarnews')
            </div>
        </div>
    </div>
@endsection
