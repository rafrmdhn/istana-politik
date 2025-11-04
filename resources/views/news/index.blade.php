@extends('layouts.main')

@section('container')
    <!-- Welcome Blog Slide Area Start -->
    <section class="welcome-blog-post-slide owl-carousel">
        @foreach($welcomeBlog as $post)
            <div class="single-blog-post-slide bg-img background-overlay-5"
                style="background-image:url('{{ $post->gambar }}');">
                <div class="single-blog-post-content">
                    <div class="tags">
                        @if($post->category)
                        <a href="{{ route('categories.show', $post->category->slug) }}">
                            {{ $post->category->name }}
                        </a>
                        @endif
                    </div>
                    <h3>
                        <a href="{{ route('articles.show', $post->slug) }}" class="font-pt">
                        {{ Str::limit($post->judul, 70) }}
                        </a>
                    </h3>
                    <div class="date">
                        <a href="#">{{ \Carbon\Carbon::parse($post->tanggal_posting)->translatedFormat('d M Y') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
    <!-- Welcome Blog Slide Area End -->

    <!-- Latest News Marquee Area Start -->
    <div class="latest-news-marquee-area">
        <div class="simple-marquee-container">
            <div class="marquee">
                <ul class="marquee-content-items">
                    @foreach($marquee as $item)
                    <li>
                        <a href="{{ route('articles.show',$item->slug) }}">
                            <span class="latest-news-time">{{ $item->created_at->format('H:i') }}</span>
                            {{ Str::limit($item->judul, 90) }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- Latest News Marquee Area End -->

    <!-- Main Content Area Start -->
    <section class="main-content-wrapper section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9">
                    <!-- Gazette Welcome Post -->
                    @if($featured)
                        <div class="gazette-welcome-post">
                            <div class="gazette-post-tag">
                                @if($featured->category)
                                    <a href="{{ route('categories.show', $featured->category->slug ?? Str::slug($featured->category->name)) }}">
                                        {{ $featured->category->name }}
                                    </a>
                                @endif
                            </div>
                            <h2 class="font-pt">{{ $featured->judul }}</h2>
                            <p class="gazette-post-date">
                                {{ \Carbon\Carbon::parse($featured->tanggal_posting)->translatedFormat('d M Y') }}
                                • {{ $featured->nama_penulis }}
                            </p>
                            <div class="blog-post-thumbnail my-5">
                                <img src="{{ $featured->gambar }}" alt="{{ $featured->sumber_gambar }}">
                            </div>
                            <p>{{ Str::limit(strip_tags($featured->deskripsi), 400) }}</p>
                            <div class="post-continue-reading-share d-sm-flex align-items-center justify-content-between mt-30">
                                <div class="post-continue-btn">
                                    <a href="{{ route('articles.show', $featured->slug) }}" class="font-pt">
                                        Continue Reading <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="post-share-btn-group">
                                    <a href="{{ route('articles.show', $featured->slug) }}"><i class="fas fa-link" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="gazette-todays-post section_padding_100_50">
                        <div class="gazette-heading"><h4>today’s most popular</h4></div>

                        @foreach($mostPopular as $pop)
                            <div class="gazette-single-todays-post d-md-flex align-items-start mb-50">
                                <div class="todays-post-thumb">
                                    <a href="{{ route('articles.show', $pop->slug) }}">
                                        <img src="{{ $pop->gambar }}" alt="{{ $pop->sumber_gambar }}">
                                    </a>
                                </div>
                                <div class="todays-post-content">
                                    <div class="gazette-post-tag">
                                        @if($pop->category)
                                            <a href="{{ route('categories.show', $pop->category->slug) }}">{{ $pop->category->name }}</a>
                                        @endif
                                    </div>
                                    <h3><a href="{{ route('articles.show', $pop->slug) }}" class="font-pt mb-2">{{ $pop->judul }}</a></h3>
                                    <span class="gazette-post-date mb-2">{{ \Carbon\Carbon::parse($pop->tanggal_posting)->translatedFormat('d M Y') }}</span>
                                    <p>{{ Str::limit(strip_tags($pop->deskripsi), 180) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 col-lg-3 col-md-6">
                    <div class="sidebar-area">
                        <!-- Breaking News Widget -->
                        <div class="breaking-news-widget">
                            <div class="widget-title"><h5>breaking news</h5></div>
                            @foreach($breaking as $b)
                                <div class="single-breaking-news-widget">
                                    <a href="{{ route('articles.show',$b->slug) }}">
                                        <img src="{{ $b->gambar }}" alt="{{ $b->sumber_gambar }}">
                                    </a>
                                    <div class="breakingnews-title"><p>{{ $b->category->name ?? 'Breaking' }}</p></div>
                                    <div class="breaking-news-heading gradient-background-overlay">
                                        <h5 class="font-pt">
                                            <a class="text-white" href="{{ route('articles.show', $b->slug) }}">{{ Str::limit($b->judul, 70) }}</a>
                                        </h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Don't Miss Widget -->
                        <div class="donnot-miss-widget">
                            <div class="widget-title"><h5>Don't miss</h5></div>
                            @foreach($dontMiss as $dm)
                                <div class="single-dont-miss-post d-flex mb-30">
                                    <div class="dont-miss-post-thumb">
                                        <a href="{{ route('articles.show', $dm->slug) }}">
                                            <img src="{{ $dm->gambar }}" alt="">
                                        </a>
                                    </div>
                                    <div class="dont-miss-post-content">
                                        <a href="{{ route('articles.show', $dm->slug) }}" class="font-pt">{{ Str::limit($dm->judul, 60) }}</a>
                                        <span>{{ \Carbon\Carbon::parse($dm->tanggal_posting)->translatedFormat('d M Y') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Advert Widget -->
                        <div class="advert-widget">
                            <div class="widget-title">
                                <h5>Advert</h5>
                            </div>
                            <div class="advert-thumb mb-30">
                                <a href="#"><img src="{{ asset('img/add.png') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content Area End -->

        <!-- Catagory Posts Area Start -->
        <div class="gazette-catagory-posts-area">
            <div class="container">
                <div class="row">
                    @php
                        $left  = $catsFour->get(0);
                        $right = $catsFour->get(1);
                    @endphp
                    @if($left)
                        <div class="col-12 col-md-4">
                            @php $first = $left->articles->first(); @endphp
                            @if($first)
                                <div class="gazette-single-catagory-post">
                                    <div class="single-catagory-post-thumb mb-15">
                                        <a href="{{ route('articles.show', $first->slug) }}"><img src="{{ $first->gambar }}" alt="{{ $first->sumber_gambar }}"></a>
                                    </div>
                                    <div class="gazette-post-tag"><a href="{{ route('categories.show', $first->category->slug) }}">{{ $left->name }}</a></div>
                                    <h5><a href="{{ route('articles.show', $first->slug) }}" class="font-pt">{{ Str::limit($first->judul, 70) }}</a></h5>
                                    <span>{{ \Carbon\Carbon::parse($first->tanggal_posting)->translatedFormat('d M Y') }}</span>
                                </div>
                            @endif
                            @foreach($left->articles->skip(1) as $a)
                                <div class="gazette-single-catagory-post">
                                    <h5><a href="{{ route('articles.show', $a->slug) }}" class="font-pt">{{ Str::limit($a->judul, 75) }}</a></h5>
                                    <span>{{ \Carbon\Carbon::parse($a->tanggal_posting)->translatedFormat('d M Y') }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="col-12 col-md-4">
                        @foreach ($combinedGroups as $group)
                            @php
                                $thumb = optional($group->articles)->first();
                            @endphp

                            @if (is_null($thumb))
                                @continue
                            @endif

                            <div class="gazette-single-catagory-post">
                                <div class="single-catagory-post-thumb mb-15">
                                    <a href="{{ route('articles.show', $thumb->slug) }}">
                                        <img src="{{ $thumb->gambar ?? asset('images/placeholder.jpg') }}"
                                            alt="{{ $thumb->sumber_gambar ?? $thumb->judul }}">
                                    </a>
                                </div>

                                <div class="gazette-post-tag">
                                    @if (!empty($group->category))
                                        <a href="{{ route('categories.show', $group->category->slug) }}">
                                            {{ $group->category->name }}
                                        </a>
                                    @endif
                                </div>

                                <h5 class="mb-1">
                                    <a href="{{ route('articles.show', $thumb->slug) }}" class="font-pt">
                                        {{ Str::limit($thumb->judul, 30) }}
                                    </a>
                                </h5>

                                @if (!empty($thumb->tanggal_posting))
                                    <span>{{ \Carbon\Carbon::parse($thumb->tanggal_posting)->translatedFormat('d M Y') }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    @if($right)
                        <div class="col-12 col-md-4">
                            @php $first = $right->articles->first(); @endphp
                            @if($first)
                                <div class="gazette-single-catagory-post">
                                    <div class="single-catagory-post-thumb mb-15">
                                        <a href=""><img src="{{ $first->gambar }}" alt="{{ $first->sumber_gambar }}"></a>
                                    </div>
                                    <div class="gazette-post-tag"><a href="{{ route('categories.show', $first->category->slug) }}">{{ $right->name }}</a></div>
                                    <h5><a href="{{ route('articles.show', $first->slug) }}" class="font-pt">{{ Str::limit($first->judul, 70) }}</a></h5>
                                    <span>{{ \Carbon\Carbon::parse($first->tanggal_posting)->translatedFormat('d M Y') }}</span>
                                </div>
                            @endif
                            @foreach($right->articles->skip(1) as $a)
                                <div class="gazette-single-catagory-post">
                                    <h5><a href="{{ route('articles.show', $a->slug) }}" class="font-pt">{{ Str::limit($a->judul, 75) }}</a></h5>
                                    <span>{{ \Carbon\Carbon::parse($a->tanggal_posting)->translatedFormat('d M Y') }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Catagory Posts Area End -->

    <!-- Video Posts Area Start -->
    <section class="gazatte-video-post-area section_padding_100_70 bg-gray">
        <div class="container">
            <div class="row">
                @foreach($videos as $v)
                    <div class="col-12 col-md-3">
                        <div class="single-video-post">
                            <div class="video-post-thumb">
                                <img src="{{ $v->image_url }}" alt="">
                                {{-- <a href="{{ $v->video }}" class="videobtn"><i class="fa fa-play" aria-hidden="true"></i></a> --}}
                                <a href="" class="videobtn"><i class="fas fa-play" aria-hidden="true"></i></a>
                            </div>
                            {{-- <h5><a href="{{ route('articles.show',$v->slug) }}">{{ Str::limit($v->judul, 60) }}</a></h5> --}}
                            <h5><a href="">{{ Str::limit($v->judul, 60) }}</a></h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Video Posts Area End -->
    @include('partials.editorial')
@endsection
