<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HomeServiceInterface;
use App\Services\CategoryServiceInterface;
use App\Models\News;


class HomeController extends Controller
{
    protected $homeService;
    protected $categoryService;

    public function __construct(
        HomeServiceInterface $homeService,
        CategoryServiceInterface $categoryService
    )
    {
        $this->homeService = $homeService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->getAll();

        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $news = $this->homeService->getAll($search, $categoryId);
        $news->appends(['category_id' => $categoryId, 'search' => $search]);

        return view('home.index', compact('news', 'categories', 'search', 'categoryId'));
    }

    public function show(News $news)
    {
        $news->load('category');
        return view('home.show', compact('news'));
    }
}
