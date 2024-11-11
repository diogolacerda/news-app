<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsRepository implements NewsRepositoryInterface
{
    protected News $model;

    public function __construct(News $news)
    {
        $this->model = $news;
    }
    public function all(): Collection
    {
        return $this->model::all();
    }

    public function find($id): News
    {
        return $this->model::findOrFail($id);
    }

    public function create(array $data): News
    {
        return $this->model::create($data);
    }

    public function update($id, array $data): News
    {
        $news = $this->find($id);
        $news->update($data);
        return $news;
    }

    public function delete($id): void
    {
        $news = $this->find($id);
        $news->delete($id);
    }

    public function search($search, $categoryId): LengthAwarePaginator
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
