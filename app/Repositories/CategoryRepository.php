<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected Category $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }
    public function all(): Collection
    {
        return $this->model::all();
    }

    public function find($id): Category
    {
        return $this->model::findOrFail($id);
    }

    public function create(array $data): Category
    {
        return $this->model::create($data);
    }

    public function update($id, array $data): Category
    {
        $category = $this->find($id);
        $category->update($data);
        return $category;
    }

    public function delete($id): void
    {
        $category = $this->find($id);
        $category->delete();
    }

    public function search($search): LengthAwarePaginator
    {
        return $this->model::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(10);
    }
}
