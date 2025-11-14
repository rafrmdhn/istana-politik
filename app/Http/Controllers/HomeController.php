<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $headerAd  = Ads::active()->position('header')->inRandomOrder()->first();
        $sidebarAd = Ads::active()->position('sidebar')->inRandomOrder()->first();
        $allowedCategories = ['daerah', 'nasional', 'internasional', 'opini'];
        $welcomeBlog = Article::with('category')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->where('is_featured', 1)
            ->terbit()
            ->latest('tanggal_posting')
            ->take(3)
            ->get();

        $marquee = Article::select('judul','slug','created_at')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->terbit()
            ->latest('tanggal_posting')
            ->take(4)
            ->get();

        $featured = Article::with('category')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->when(true, fn($q) => $q->orderByDesc('is_featured'))
            ->terbit()
            ->latest('tanggal_posting')
            ->first();

        $mostPopular = Article::with('category')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->orderByDesc('views')
            ->terbit()
            ->latest('tanggal_posting')
            ->take(2)
            ->get();

        $breaking = Article::with('category')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->where('is_featured',1)
            ->terbit()
            ->latest('tanggal_posting')
            ->take(2)
            ->get();

        $dontMiss = Article::latest('tanggal_posting')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->terbit()
            ->take(6)
            ->get();

        $catsFour = Category::whereIn('name', $allowedCategories)
            ->withCount('articles')
            ->orderByDesc('articles_count')
            ->with(['articles' => fn($q) => $q->latest('tanggal_posting')->take(4)])
            ->take(2)
            ->get();

        $catsTwo = Category::whereIn('name', $allowedCategories)
            ->whereNotIn('id', $catsFour->pluck('id'))
            ->withCount('articles')
            ->orderByDesc('articles_count')
            ->with(['articles' => fn($q) => $q->latest('tanggal_posting')->take(2)])
            ->take(2)
            ->get();

        $combinedGroups = $catsTwo->map(function ($cat) {
            return (object)[
                'category' => $cat,
                'articles' => $cat->articles->take(1),
            ];
        });

        $videos = Article::whereNotNull('video')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->terbit()
            ->latest('tanggal_posting')
            ->take(8)->get();

        return view('news.index', compact(
            'allowedCategories',
            'welcomeBlog','marquee','featured','mostPopular',
            'breaking','dontMiss', 'catsFour', 'combinedGroups', 'videos',
            'headerAd', 'sidebarAd'
        ));
    }
}
