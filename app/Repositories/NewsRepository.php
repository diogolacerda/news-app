<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository implements NewsRepositoryInterface
{
    protected News $model;

    public function __construct(News $news)
    {
        $this->model = $news;
    }
    public function all()
    {
        return $this->model::all();
    }

    public function find($id)
    {
        return $this->model::findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function update($id, array $data)
    {
        $category = $this->find($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = $this->find($id);
        $category->delete();
    }

    public function search($search, $categoryId)
    {
        return $this->model::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })
        ->when($categoryId, function ($query, $categoryId) {
            return $query->where('category_id', $categoryId);
        })
        ->paginate(10);
    }
}
