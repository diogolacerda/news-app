<?php

namespace App\Services;

use App\Repositories\NewsRepository;
use App\Models\News;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsService implements NewsServiceInterface
{
    protected $repository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->repository = $newsRepository;
    }

    public function getAll($search = null, $categoryId = null): LengthAwarePaginator
    {
        return $this->repository->search($search, $categoryId);
    }

    public function find($id): News
    {
        return $this->repository->find($id);
    }

    public function store(array $data): News
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data): News
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id): void
    {
        $this->repository->delete($id);
    }
}
