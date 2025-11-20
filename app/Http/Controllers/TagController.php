<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $headerAd  = Ads::active()->position('header')->inRandomOrder()->first();
        $tags = Tag::take(10)->get();
        $allowedCategories = ['daerah', 'nasional', 'internasional', 'opini'];

        $categories = Category::select('name','slug')->orderBy('name')->get();

        $articles = Article::with('category','tags')
            ->whereHas('tags', fn($q) => $q->where('tags.id', $tag->id))
            ->terbit()
            ->orderBy('tanggal_posting','desc')
            ->paginate(10);

        $breaking = Article::with('category')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->where('is_featured',1)
            ->latest('tanggal_posting')
            ->take(2)
            ->get();

        return view('tags.show', compact(
            'tag',
            'categories',
            'articles', 
            'breaking', 
            'allowedCategories', 
            'headerAd',
            'tags'
        ));
    }
}
