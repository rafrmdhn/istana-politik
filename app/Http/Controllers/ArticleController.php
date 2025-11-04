<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function show(string $slug)
    {
        $allowedCategories = ['daerah', 'nasional', 'internasional', 'opini'];
        $article = Article::with(['category'])
            ->where('slug', $slug)
            ->firstOrFail();

        $article->increment('views');

        $prev = Article::where('kategori_id', $article->kategori_id)
            ->where('tanggal_posting', '<', $article->tanggal_posting)
            ->orderBy('tanggal_posting', 'desc')
            ->first();

        $next = Article::where('kategori_id', $article->kategori_id)
            ->where('tanggal_posting', '>', $article->tanggal_posting)
            ->orderBy('tanggal_posting', 'asc')
            ->first();

        $related = Article::with('category')
            ->where('kategori_id', $article->kategori_id)
            ->where('id', '!=', $article->id)
            ->latest('tanggal_posting')
            ->take(6)
            ->get();

        $breaking = Article::with('category')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->where('is_featured',1)
            ->latest('tanggal_posting')
            ->take(2)
            ->get();

        return view('news.show', compact('article', 'prev', 'next', 'related', 'breaking', 'allowedCategories'));
    }

    public function comment(Request $request)
    {
        $validated = $request->validate([
            'artikel_id' => 'required|exists:artikels,id',
            'parent_id'  => 'nullable|exists:comments,id',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'website'    => 'nullable|url|max:255',
            'message'    => 'required|string',
        ]);

        $emailHash = md5(strtolower(trim($validated['email'])));
        $validated['avatar'] = "https://www.gravatar.com/avatar/{$emailHash}?s=80&d=mp";

        Comment::create($validated);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}
