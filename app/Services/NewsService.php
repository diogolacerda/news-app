<?php

namespace App\Services;

use App\Repositories\NewsRepository;

class NewsService implements NewsServiceInterface
{
    protected $service;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->service = $newsRepository;
    }

    public function getAll($search = null, $categoryId = null)
    {
        return $this->service->search($search, $categoryId);
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
