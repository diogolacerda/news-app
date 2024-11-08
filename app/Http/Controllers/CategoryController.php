<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\BaseServiceInterface;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(BaseServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = $this->categoryService->getAll($search);
        return view('categories.index', compact('categories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->store($request->validated());
        return redirect()->route('categories.index')->with('success', 'Categoria criada com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = $this->categoryService->find($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->categoryService->update($category->id, $request->validated());
        return redirect()->route('categories.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return redirect()->route('categories.index')->with('success', 'Categoria excluída com sucesso.');
    }


}
