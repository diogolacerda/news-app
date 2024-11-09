<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use Illuminate\Support\Facades\Cache;
use App\Services\NewsServiceInterface;
use App\Services\CategoryServiceInterface;

class NewsController extends Controller
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
        $categories = $this->categoryService->getAll();

        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $news = $this->newsService->getAll($search, $categoryId);
        $news->appends(['category_id' => $categoryId, 'search' => $search]);

        return view('news.index', compact('news', 'categories', 'search', 'categoryId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAll();
        return view('news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $this->newsService->store($request->validated());

        Cache::forget(config('cache.keys.news'));

        return redirect()->route('news.index')->with('success', 'Notícia criada com sucesso');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $categories = $this->categoryService->getAll();
        return view('news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $this->newsService->update($news->id, $request->validated());

        Cache::forget(config('cache.keys.news'));

        return redirect()->route('news.index')
                         ->with('success', 'Notícia atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->newsService->delete($id);

        Cache::forget(config('cache.keys.news'));

        return redirect()->route('news.index')
                         ->with('success', 'Notícia deletada com sucesso.');
    }
}
