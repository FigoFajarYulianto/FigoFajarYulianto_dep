<div class="col-lg-4">
    <div class="widget-area">
        <div class="search widget-item">
            <form action="/campaigns" method="get">
                <input type="text" class="form-control" name="q" id="q" placeholder="Cari...">
                <button type="submit" class="btn">
                    <i class="icofont-search-1"></i>
                </button>
            </form>
        </div>
        <div class="post widget-item">
            <h3 style="font-size: 18px; font-weight: bold;">Penggalangan Terbaru</h3>
            @foreach (\App\Models\Campaign::limit(5)->where('waktu_tenggat', '>=', date_create(date('Y-m-d')))->where('status_id', 2)->latest()->get() as $item)
                <div class="post-inner">
                    <ul class="align-items-center">
                        <li>
                            <img src="/storage/{{ $item->image }}" alt="Details">
                        </li>
                        <li>
                            <h4>
                                <a href="/campaigns/{{ $item->slug }}">{{ $item->title }}</a>
                            </h4>
                            <p><a href="/campaigns?author={{ $item->user->username }}">{{ $item->user->name }}</a></p>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="common-right-content widget-item">
            <h3 style="font-size: 18px; font-weight: bold;">Kategori Galang Dana</h3>
            <ul>
                @foreach (\App\Models\Category::withCount('campaigns_sidebar')->orderBy('name', 'ASC')->get() as $item)
                    <li>
                        <a href="/campaigns?category={{ $item->slug }}">{{ $item->name }}
                            ({{ $item->campaigns_sidebar_count }})
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
