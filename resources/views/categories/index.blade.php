@extends('layouts.main')

@section('container')
    <div class="breadcumb-area section_padding_50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breacumb-content d-flex align-items-center justify-content-between">
                        <div class="gazette-post-tag">
                            <a href="{{ route('categories.show', $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        </div>
                        <p class="editorial-post-date text-dark mb-0">
                            {{ now()->translatedFormat('d M Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($editorials->count())
    <section class="gazatte-editorial-area section_padding_100 bg-dark">
        <div class="container">
            <div class="row"><div class="col-12">
                <div class="editorial-post-slides owl-carousel">
                    @foreach($editorials as $ed)
                    <div class="editorial-post-single-slide">
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <div class="editorial-post-thumb">
                                    <img src="{{ $ed->gambar }}" alt="{{ $ed->sumber_gambar }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-7">
                                <div class="editorial-post-content">
                                    <div class="gazette-post-tag">
                                        <a href="{{ route('categories.show', $category->slug) }}">
                                            {{ $category->name }}
                                        </a>
                                    </div>
                                    <h2>
                                        <a href="{{ route('articles.show', $ed->slug) }}" class="font-pt mb-15">
                                            {{ \Illuminate\Support\Str::limit($ed->judul, 90) }}
                                        </a>
                                    </h2>
                                    <p class="editorial-post-date mb-15">
                                        {{ \Carbon\Carbon::parse($ed->tanggal_posting)->translatedFormat('d M Y') }}
                                    </p>
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($ed->deskripsi), 260) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div></div>
        </div>
    </section>
    @endif

    <section class="catagory-welcome-post-area section_padding_100">
        <div class="container">
            <div class="row">
                @foreach($articles->take(3) as $card)
                    <div class="col-12 col-md-4">
                        <div class="gazette-welcome-post">
                            <div class="gazette-post-tag">
                                <a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                            </div>
                            <h2 class="font-pt">
                                <a href="{{ route('articles.show', $card->slug) }}">
                                    {{ \Illuminate\Support\Str::limit($card->judul, 70) }}
                                </a>
                            </h2>
                            <p class="gazette-post-date">
                                {{ \Carbon\Carbon::parse($card->tanggal_posting)->translatedFormat('d M Y') }}
                            </p>
                            <div class="blog-post-thumbnail my-5">
                                <a href="{{ route('articles.show', $card->slug) }}">
                                    <img src="{{ $card->gambar }}" alt="{{ $card->sumber_gambar }}">
                                </a>
                            </div>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($card->deskripsi), 140) }}</p>
                            <div class="post-continue-reading-share mt-30">
                                <div class="post-continue-btn">
                                    <a href="{{ route('articles.show', $card->slug) }}" class="font-pt">
                                        Continue Reading <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @php $big = $articles->slice(3,2); @endphp
                @foreach($big as $b)
                    <div class="col-12 col-md-6">
                        <div class="gazette-welcome-post">
                            <div class="gazette-post-tag">
                                <a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                            </div>
                            <h2 class="font-pt">
                                <a href="{{ route('articles.show', $b->slug) }}">
                                    {{ \Illuminate\Support\Str::limit($b->judul, 80) }}
                                </a>
                            </h2>
                            <p class="gazette-post-date">
                                {{ \Carbon\Carbon::parse($b->tanggal_posting)->translatedFormat('d M Y') }}
                            </p>
                            <div class="blog-post-thumbnail my-5">
                                <a href="{{ route('articles.show', $b->slug) }}">
                                    <img src="{{ $b->gambar }}" alt="{{ $b->sumber_gambar }}">
                                </a>
                            </div>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($b->deskripsi), 180) }}</p>
                            <div class="post-continue-reading-share mt-30">
                                <div class="post-continue-btn">
                                    <a href="{{ route('articles.show',$b->slug) }}" class="font-pt">
                                        Continue Reading <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @php $wide = $articles->slice(5,1)->first(); @endphp
                @if($wide)
                <div class="col-12">
                    <div class="gazette-welcome-post d-md-flex align-items-center">
                        <div class="blog-post-thumbnail">
                            <a href="{{ route('articles.show',$wide->slug) }}">
                                <img src="{{ $wide->gambar }}" alt="{{ $wide->sumber_gambar }}">
                            </a>
                        </div>
                        <div class="welcome-post-contents ml-30">
                            <div class="gazette-post-tag">
                                <a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                            </div>
                            <h2 class="font-pt">
                                <a href="{{ route('articles.show',$wide->slug) }}">
                                    {{ \Illuminate\Support\Str::limit($wide->judul, 100) }}
                                </a>
                            </h2>
                            <p class="gazette-post-date mb-15">
                                {{ \Carbon\Carbon::parse($wide->tanggal_posting)->translatedFormat('d M Y') }}
                            </p>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($wide->deskripsi), 220) }}</p>
                            <div class="post-continue-reading-share mt-15">
                                <div class="post-continue-btn">
                                    <a href="{{ route('articles.show',$wide->slug) }}" class="font-pt">
                                        Continue Reading <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Pagination --}}
            <div class="row">
                <div class="col-12">
                    <div class="gazette-pagination-area">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                {{ $articles->onEachSide(0)->links('pagination::bootstrap-4') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            {{-- Jika kategori kosong --}}
            @if($articles->isEmpty())
                <div class="row mt-4">
                    <div class="col-12">
                        <p class="text-center text-muted">Belum ada artikel dalam kategori {{ $category->name }}.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
