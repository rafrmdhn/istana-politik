<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(string $slug)
    {
        $allowedCategories = ['daerah', 'nasional', 'internasional', 'opini'];
        $category = Category::where('slug', $slug)->firstOrFail();

        $breaking = Article::with('category')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->where('is_featured',1)
            ->latest('tanggal_posting')
            ->take(2)
            ->get();

        $editorials = Article::with('category')
            ->where('kategori_id', $category->id)
            ->orderByDesc('is_featured')
            ->latest('tanggal_posting')
            ->take(6)
            ->get();

        $articles = Article::with('category')
            ->where('kategori_id', $category->id)
            ->latest('tanggal_posting')
            ->paginate(9);

        $highlight = Article::with('category')
            ->where('kategori_id', $category->id)
            ->latest('tanggal_posting')
            ->first();

        return view('categories.index', compact(
            'allowedCategories',
            'category',
            'editorials',
            'articles',
            'highlight',
            'breaking'
        ));
    }
}
