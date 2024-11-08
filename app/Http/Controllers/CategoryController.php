<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryServiceInterface;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = $this->categoryService->getAll($search);
        return view('categories.index', compact('categories', 'search'));
    }


    public function create()
    {
        return view('categories.create');
    }


    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->store($request->validated());
        return redirect()->route('categories.index')->with('success', 'Categoria criada com sucesso.');
    }


    public function edit($id)
    {
        $category = $this->categoryService->find($id);
        return view('categories.edit', compact('category'));
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->categoryService->update($category->id, $request->validated());
        return redirect()->route('categories.index')->with('success', 'Categoria atualizada com sucesso.');
    }


    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return redirect()->route('categories.index')->with('success', 'Categoria excluída com sucesso.');
    }


}
