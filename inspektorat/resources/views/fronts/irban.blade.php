@extends('fronts.template')
@section('content')
    <style>
        .portfolio .portfolio-item {
            margin-bottom: 30px;
        }

        .portfolio #portfolio-flters {
            padding: 0;
            margin: 0 auto 20px auto;
            list-style: none;
            text-align: center;
        }

        .portfolio #portfolio-flters li {
            cursor: pointer;
            display: inline-block;
            padding: 8px 15px 0px 15px;
            font-size: 14px;
            font-weight: 600;
            line-height: 1;
            text-transform: uppercase;
            color: #444444;
            margin-bottom: 5px;
            transition: all 0.3s ease-in-out;
            border-radius: 3px;
        }

        .portfolio #portfolio-flters li:hover,
        .portfolio #portfolio-flters li.filter-active {
            color: #151515;
            background: #ffc451;
        }

        .portfolio #portfolio-flters li:last-child {
            margin-right: 0;
        }

        .portfolio .portfolio-wrap {
            transition: 0.3s;
            position: relative;
            overflow: hidden;
            z-index: 1;
            background: rgba(21, 21, 21, 0.6);
        }

        .portfolio .portfolio-wrap::before {
            content: "";
            background: rgba(21, 21, 21, 0.6);
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            transition: all ease-in-out 0.3s;
            z-index: 2;
            opacity: 0;
        }

        .portfolio .portfolio-wrap img {
            transition: all ease-in-out 0.3s;
        }

        .portfolio .portfolio-wrap .portfolio-info {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 3;
            transition: all ease-in-out 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: flex-start;
            padding: 20px;
        }

        .portfolio .portfolio-wrap .portfolio-info h4 {
            font-size: 20px;
            color: #fff;
            font-weight: 600;
        }

        .portfolio .portfolio-wrap .portfolio-info p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            text-transform: uppercase;
            padding: 0;
            margin: 0;
            font-style: italic;
        }

        .portfolio .portfolio-wrap .portfolio-links {
            text-align: center;
            z-index: 4;
        }

        .portfolio .portfolio-wrap .portfolio-links a {
            color: #fff;
            margin: 0 5px 0 0;
            font-size: 28px;
            display: inline-block;
            transition: 0.3s;
        }

        .portfolio .portfolio-wrap .portfolio-links a:hover {
            color: #ffc451;
        }

        .portfolio .portfolio-wrap:hover::before {
            opacity: 1;
        }

        .portfolio .portfolio-wrap:hover img {
            transform: scale(1.2);
        }

        .portfolio .portfolio-wrap:hover .portfolio-info {
            opacity: 1;
        }
    </style>

    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5" style="background-color: rgba(14, 29, 52, 0.9)">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-8 text-center text-uppercase">
                        <h3 class="text-uppercase text-white">{{ $title_bar }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="portfolio mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        @foreach (\App\Models\Irban::orderBy('nama', 'ASC')->get() as $item)
                            <li data-filter=".filter-app" {!! (request('id') ?? $irban->id) == $item->id ? 'class="filter-active"' : '' !!}><a href="/irban?id={{ $item->id }}">
                                    <h6 style="color:black;">{{ $item->nama }}
                                    </h6>
                                </a> </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-area pb-10 pt-0">
        <section class="blog-area three pb-5 pt-3 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width: 100%">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th>{{ Str::upper($irban->nama) }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($irban->irbanwilayah->count())
                                        @foreach ($irban->irbanwilayah as $item)
                                            <tr>
                                                <td style="text-align: center;" width="10%">{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2" class="small">Data belum tersedia.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        @if ($irban->keterangan && $irban->inspektur && $irban->nip)
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="mt-3 mb-0" style="font-weight: bold;">KETERANGAN</p>
                                    <p class="my-0 small">{!! nl2br($irban->keterangan) !!}</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="mt-3 mb-0" style="font-weight: bold;">INSPEKTUR KABUPATEN JEMBER</p>
                                    <p class="mt-2 my-0 small">{{ $irban->inspektur }}</p>
                                    <p class="my-0 small">Pembina</p>
                                    <p class="my-0 small">NIP. {{ $irban->nip }}</p>
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
