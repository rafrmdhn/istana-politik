@extends('layouts.main')

@section('container')
<style>
    .single-post-text ul,
    .single-post-text ol {
        margin: 0 0 1rem 1.25rem;
        padding-left: 1.25rem;
        text-transform: none;
    }

    .single-post-text ul {
        list-style: disc outside;
    }

    .single-post-text ol {
        list-style: decimal outside;
    }

    .single-post-text li {
        list-style: inherit;
        margin: .25rem 0;
    }

    .single-post-text ol[type="a"] { list-style: lower-alpha; }
    .single-post-text ol[type="A"] { list-style: upper-alpha; }
    .single-post-text ol[type="i"] { list-style: lower-roman; }
    .single-post-text ol[type="I"] { list-style: upper-roman; }
</style>
<section class="single-post-area">
    <div class="single-post-title bg-img background-overlay"
        style="background-image: url('{{ $article->gambar }}');">
        <div class="container h-100">
            <div class="row h-100 align-items-end">
                <div class="col-12">
                    <div class="single-post-title-content">
                        <div class="gazette-post-tag">
                            @if($article->category)
                                <a href="{{ route('categories.show', $article->category->slug ?? \Illuminate\Support\Str::slug($article->category->name)) }}">
                                {{ $article->category->name }}
                                </a>
                            @endif
                        </div>
                        <h2 class="font-pt">{{ $article->judul }}</h2>
                        <p class="mb-1">
                            <span class="text-white-50">Penulis:</span> {{ $article->nama_penulis }}
                            @if($article->additional_authors->isNotEmpty())
                                <span class="mx-2">•</span>
                                <span class="text-white-50">Editor:</span>
                                {{ $article->additional_authors->pluck('name')->join(', ') }}
                            @endif
                        </p>
                        <p>
                            {{ \Carbon\Carbon::parse($article->tanggal_posting)->translatedFormat('d M Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="single-post-contents">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="single-post-text text-justify">
                        {!! $article->deskripsi !!}
                    </div>
                </div>

                <div class="single-post-thumb text-center">
                    @if($article->sumber_gambar || $article->source)
                        <div class="mt-3 text-muted" style="font-size:.9rem">
                            @if($article->sumber_gambar) Foto: <em>{{ $article->sumber_gambar }}</em>@endif
                            @if($article->sumber_gambar && $article->source) • @endif
                            @if($article->source) Sumber: <em>{{ $article->source }}</em>@endif
                        </div>
                    @endif
                    <img src="{{ $article->gambar }}"
                        alt="{{ $article->sumber_gambar }}"
                        class="img-fluid mx-auto d-block">
                </div>
                @if($article->tags)
                    <div class="col-12 col-md-8 mt-3">
                        <span class="text-muted mr-2">Tags:</span>
                        @foreach($article->tags as $tag)
                            <a href="{{ route('tags.show', $tag->slug) }}"
                            class="badge badge-secondary text-uppercase font-weight-semi-bold px-2 py-1 mr-1">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
                <div class="col-12 col-md-8 mt-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            @if($prev)
                                <small class="text-muted d-block">Previous</small>
                                <a href="{{ route('articles.show', $prev->slug) }}">
                                    &laquo; {{ \Illuminate\Support\Str::limit($prev->judul, 30) }}
                                </a>
                            @endif
                        </div>
                        <div class="text-right">
                            @if($next)
                                <small class="text-muted d-block">Next</small>
                                <a href="{{ route('articles.show', $next->slug) }}">
                                    {{ \Illuminate\Support\Str::limit($next->judul, 30) }} &raquo;
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                @if($related->count())
                    <div class="col-12 col-md-10 mt-5">
                        <div class="gazette-heading"><h4 class="font-bold">Related</h4></div>
                        <div class="row">
                            @foreach($related as $rel)
                                <div class="col-6 col-md-4 mb-4">
                                    <div class="gazette-single-catagory-post">
                                        <img src="{{ $rel->gambar }}" class="img-fluid mb-2" alt="{{ $rel->sumber_gambar }}">
                                        <div class="gazette-post-tag">
                                            <a href="{{ route('categories.show', $rel->category->slug) }}">
                                                {{ $rel->category->name }}
                                            </a>
                                        </div>
                                        <a href="{{ route('articles.show', $rel->slug) }}" class="font-pt">{{ \Illuminate\Support\Str::limit($rel->judul, 70) }}</a>
                                        <span class="d-block">
                                            {{ \Carbon\Carbon::parse($rel->tanggal_posting)->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="gazette-post-discussion-area section_padding_100 bg-gray">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="comment_area section_padding_50 clearfix">
                    <div class="gazette-heading">
                        <h4 class="font-bold">Discussion</h4>
                    </div>
                    <ol>
                        @foreach($article->comments->where('parent_id', null) as $comment)
                            <li class="single_comment_area">
                                <div class="comment-wrapper d-md-flex align-items-start">
                                    <div class="comment-author">
                                        <img src="{{ $comment->avatar }}" alt="avatar">
                                    </div>
                                    <div class="comment-content">
                                        <h5>{{ $comment->name }}</h5>
                                        <span class="comment-date font-pt">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                        <p>{{ $comment->message }}</p>
                                        <button class="reply-btn"
                                                onclick="document.getElementById('reply-form-{{ $comment->id }}').style.display='block'">
                                            Reply
                                        </button>

                                        <div id="reply-form-{{ $comment->id }}" style="display:none; margin-top:15px;" class="leave-comment-area clearfix">
                                            <div class="comment-form">
                                                <form action="{{ route('comments.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="artikel_id" value="{{ $article->id }}">
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="name" placeholder="Enter Your Full Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="message" rows="3" placeholder="Message" required></textarea>
                                                    </div>
                                                    <button type="submit" class="btn leave-comment-btn">
                                                        SUBMIT <i class="fas fa-angle-right ml-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($comment->replies as $reply)
                                    <ol class="children">
                                        <li class="single_comment_area">
                                            <div class="comment-wrapper d-md-flex align-items-start">
                                                <div class="comment-author">
                                                    <img src="{{ $reply->avatar }}" alt="Avatar">
                                                </div>
                                                <div class="comment-content">
                                                    <h5>{{ $reply->name }}</h5>
                                                    <span class="comment-date text-muted">{{ $reply->created_at->diffForHumans() }}</span>
                                                    <p>{{ $reply->message }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                @endforeach
                            </li>
                        @endforeach
                    </ol>
                </div>

                <div class="leave-comment-area clearfix">
                    <div class="comment-form">
                        <div class="gazette-heading">
                            <h4 class="font-bold">Leave a comment</h4>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('comments.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="artikel_id" value="{{ $article->id }}">
                            <input type="hidden" name="parent_id" id="parent_id" value="">
                            <div class="form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" placeholder="Enter Your Full Name">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" placeholder="Email">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <textarea class="form-control @error('message') is-invalid @enderror"
                                        name="message" rows="6" placeholder="Message">{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <button type="submit" class="btn leave-comment-btn">
                                SUBMIT <i class="fas fa-angle-right ml-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
