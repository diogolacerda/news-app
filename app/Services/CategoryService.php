<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService implements CategoryServiceInterface
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll($search = null)
    {
        return $this->categoryRepository->search($search);
    }

    public function find($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function store(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}
