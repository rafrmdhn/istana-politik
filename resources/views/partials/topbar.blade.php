<div class="top-header">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <!-- Breaking News Area -->
            <div class="col-12 col-md-6">
                <div class="breaking-news-area">
                    <h5 class="breaking-news-title">Breaking news</h5>
                    <div id="breakingNewsTicker" class="ticker">
                        <ul>
                            @foreach ($breaking as $item)
                                <li><a href="{{ route('articles.show', $item->slug) }}">{{ $item->judul }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
