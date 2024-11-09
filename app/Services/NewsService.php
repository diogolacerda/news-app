<?php

namespace App\Services;

use App\Repositories\NewsRepository;

class NewsService implements NewsServiceInterface
{
    protected $repository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->repository = $newsRepository;
    }

    public function getAll($search = null, $categoryId = null)
    {
        return $this->repository->search($search, $categoryId);
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function store(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
