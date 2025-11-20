<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(string $slug)
    {
        $headerAd  = Ads::active()->position('header')->inRandomOrder()->first();
        $allowedCategories = ['daerah', 'nasional', 'internasional', 'opini'];
        $category = Category::where('slug', $slug)->firstOrFail();

        $breaking = Article::with('category')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->where('is_featured',1)
            ->terbit()
            ->latest('tanggal_posting')
            ->take(2)
            ->get();

        $editorials = Article::with('category')
            ->where('kategori_id', $category->id)
            ->orderByDesc('is_featured')
            ->terbit()
            ->latest('tanggal_posting')
            ->take(6)
            ->get();

        $articles = Article::with('category')
            ->where('kategori_id', $category->id)
            ->terbit()
            ->latest('tanggal_posting')
            ->paginate(9);

        $highlight = Article::with('category')
            ->where('kategori_id', $category->id)
            ->terbit()
            ->latest('tanggal_posting')
            ->first();

        $tags = Tag::take(10)->get();

        return view('categories.index', compact(
            'allowedCategories',
            'category',
            'editorials',
            'articles',
            'highlight',
            'breaking',
            'headerAd',
            'tags'
        ));
    }
}
