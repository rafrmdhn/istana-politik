@extends('layouts.main')

@section('container')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <small class="text-muted">
                @php $total = $articles->total(); @endphp
                Menampilkan <strong>{{ $total }}</strong> hasil
                @if($q) untuk "<strong>{{ $q }}</strong>" @endif
                @if($cat)
                    pada <strong>{{ $categoryLabel ?? $cat }}</strong>
                @endif
                @if($days) dalam <strong>{{ $days }} hari</strong> terakhir @endif
                (urut: {{ $sort==='popular'?'Terpopuler':($sort==='featured'?'Featured':'Terbaru') }})
            </small>
        </div>
    </div>

    <div class="row">
        @forelse($articles as $a)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="gazette-single-catagory-post h-100 d-flex flex-column">
                    <div class="single-catagory-post-thumb mb-15">
                        <a href="{{ route('articles.show', $a->slug) }}">
                        <img src="{{ $a->gambar }}"
                            alt="{{ $a->sumber_gambar }}" class="img-fluid">
                        </a>
                    </div>
                    <div class="gazette-post-tag mb-1">
                        @if($a->category)
                            <a href="{{ route('categories.show', $a->category->slug) }}">{{ $a->category->name }}</a>
                        @endif
                    </div>
                    <h5>
                        <a href="{{ route('articles.show', $a->slug) }}" class="font-pt">
                        {{ \Illuminate\Support\Str::limit($a->judul, 90) }}
                        </a>
                    </h5>
                    <span>{{ \Carbon\Carbon::parse($a->tanggal_posting)->translatedFormat('d M Y') }}</span>
                    <p class="mb-0">
                        {{ \Illuminate\Support\Str::limit(strip_tags($a->deskripsi), 120) }}
                    </p>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p>Tidak ada hasil. Coba ubah kata kunci atau filter.</p>
            </div>
        @endforelse
    </div>

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
</div>
@endsection