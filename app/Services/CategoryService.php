<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService implements CategoryServiceInterface
{
    protected $service;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->service = $categoryRepository;
    }

    public function getAll($search = null)
    {
        return $this->service->search($search);
    }

    public function find($id)
    {
        return $this->service->find($id);
    }

    public function store(array $data)
    {
        return $this->service->create($data);
    }

    public function update($id, array $data)
    {
        return $this->service->update($id, $data);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }
}
