<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Services\NewsServiceInterface;
use App\Services\CategoryServiceInterface;
use App\Models\News;


class HomeController extends Controller
{
    protected $newsService;
    protected $categoryService;

    public function __construct(
        NewsServiceInterface $newsService,
        CategoryServiceInterface $categoryService
    )
    {
        $this->newsService = $newsService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $cache_key = config('cache.keys.news');

        $categories = $this->categoryService->getAll();

        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $news = $this->newsService->getAll($search, $categoryId);
        $news->appends(['category_id' => $categoryId, 'search' => $search]);

        return view('home.index', compact('news', 'categories', 'search', 'categoryId'));
    }

    public function show(News $news)
    {
        $news->load('category');
        return view('home.show', compact('news'));
    }
}
