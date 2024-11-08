<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\News;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $cache_key = config('cache.keys.news');

        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $newsQuery = News::query();

        if ($categoryId) {
            $newsQuery->where('category_id', $categoryId);
        }

        if ($search) {
            $newsQuery->where('title', 'like', "%$search%");
        }

        $news  = Cache::remember($cache_key, now()->addMinutes(60), function () use ($newsQuery) {
            return $newsQuery->with('category')
                ->latest()
                ->paginate(10);
        });

        $news->appends(['category_id' => $categoryId, 'search' => $search]);

        return view('home.index', compact('news'));
    }

    public function show(News $news)
    {
        $news->load('category');

        return view('home.show', compact('news'));
    }
}