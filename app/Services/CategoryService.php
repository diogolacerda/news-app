<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryService implements CategoryServiceInterface
{
    protected $repository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }

    public function getAll($search = null): LengthAwarePaginator
    {
        return $this->repository->search($search);
    }

    public function find($id): Category
    {
        return $this->repository->find($id);
    }

    public function store(array $data): Category
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data): Category
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id): void
    {
        $this->repository->delete($id);
    }
}
