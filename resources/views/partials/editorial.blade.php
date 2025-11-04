<!-- Editorial Area Start -->
<section class="gazatte-editorial-area section_padding_100 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="editorial-post-slides owl-carousel">
                    @foreach($breaking->take(4) as $ed)
                        <div class="editorial-post-single-slide">
                            <div class="row">
                                <div class="col-12 col-md-5">
                                    <div class="editorial-post-thumb">
                                        <img src="{{ $ed->gambar }}" alt="{{ $ed->sumber_gambar }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-7">
                                    <div class="editorial-post-content">
                                        <div class="gazette-post-tag"><a href="{{ route('categories.show', $ed->category->slug) }}">{{ $ed->category->name }}</a></div>
                                        <h2><a href="{{ route('articles.show',$ed->slug) }}" class="font-pt mb-15">
                                            {{ Str::limit($ed->judul, 90) }}
                                        </a></h2>
                                        <p class="editorial-post-date mb-15">
                                            {{ \Carbon\Carbon::parse($ed->tanggal_posting)->translatedFormat('d M Y') }}
                                        </p>
                                        <p>{{ Str::limit(strip_tags($ed->deskripsi), 280) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Editorial Area End -->
