<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

    public function search(Request $request)
    {
        $q     = trim($request->query('q', ''));
        $cat   = $request->query('cat');
        $sort  = $request->query('sort', 'recent');
        $days  = (int) $request->query('days', 0);
        $allowedCategories = ['daerah', 'nasional', 'internasional', 'opini'];

        $categories = Category::select('name','slug')->orderBy('name')->get();

        $articles = Article::with('category')
            ->when($q !== '', function($query) use ($q) {
                $query->where(function($qq) use ($q) {
                    $qq->where('judul', 'like', "%{$q}%");
                });
            })
            ->whereHas('category', fn($c) => $c->whereIn('name', $allowedCategories))
            ->orderBy('tanggal_posting','desc')
            ->terbit()
            ->paginate(12)
            ->appends($request->query());

        $breaking = Article::with('category')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->where('is_featured',1)
            ->latest('tanggal_posting')
            ->take(2)
            ->get();

        return view('news.search', compact('q','cat','days','sort','categories','articles', 'breaking', 'allowedCategories'));
    }
}
