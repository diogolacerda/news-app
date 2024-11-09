<?php

namespace App\Repositories;

use App\Models\News;

class HomeRepository implements HomeRepositoryInterface
{
    protected News $model;

    public function __construct(News $news)
    {
        $this->model = $news;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model::findOrFail($id);
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
