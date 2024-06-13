<div class="col-lg-4">
    <div class="widget-area">
        <div class="search widget-item">
            <form action="/posts" method="get">
                <input type="text" class="form-control" name="q" id="q" placeholder="Cari...">
                <button type="submit" class="btn">
                    <i class="icofont-search-1"></i>
                </button>
            </form>
        </div>
        <div class="post widget-item">
            <h3>Terbaru</h3>
            @foreach (\App\Models\Post::limit(5)->latest()->get() as $item)
                <div class="post-inner">
                    <ul class="align-items-center">
                        <li>
                            <img src="/storage/{{ $item->image }}" alt="Details">
                        </li>
                        <li>
                            <h4>
                                <a href="/posts/{{ $item->slug }}">{{ $item->title }}</a>
                            </h4>
                            <p><a href="/posts?author={{ $item->user->username }}">{{ $item->user->name }}</a></p>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="common-right-content widget-item">
            <h3>Kategori</h3>
            <ul>
                @foreach (\App\Models\Postcategory::withCount('posts')->orderBy('name', 'ASC')->get() as $item)
                    <li>
                        <a href="/posts?category={{ $item->slug }}">{{ $item->name }} ({{ $item->posts_count }})</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
