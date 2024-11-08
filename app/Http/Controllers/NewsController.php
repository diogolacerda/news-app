<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $newsQuery = News::query();

        if ($categoryId) {
            $newsQuery->where('category_id', $categoryId);
        }

        if ($search) {
            $newsQuery->where('title', 'like', '%' . $search . '%');
        }

        $news = $newsQuery->with('category')->paginate(10);

        // Mantem os parâmetros de busca ao navegar pelas paginas
        $news->appends(['category_id' => $categoryId, 'search' => $search]);

        $categories = Category::all();

        return view('news.index', compact('news', 'categories', 'search', 'categoryId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $data = $request->validated();

        News::create($data);

        Cache::forget(config('cache.keys.news'));

        return redirect()->route('news.index')
                         ->with('success', 'Notícia criada com sucesso.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $categories = Category::all();
        return view('news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $news->update($request->validated());

        Cache::forget(config('cache.keys.news'));

        return redirect()->route('news.index')
                         ->with('success', 'Notícia atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();

        Cache::forget(config('cache.keys.news'));

        return redirect()->route('news.index')
                         ->with('success', 'Notícia deletada com sucesso.');
    }
}
