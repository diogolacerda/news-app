<?php

namespace App\Services;

use App\Repositories\HomeRepository;

class HomeService implements HomeServiceInterface
{
    protected $repository;

    public function __construct(HomeRepository $homeRepository)
    {
        $this->repository = $homeRepository;
    }

    public function getAll($search = null, $categoryId = null)
    {
        return $this->repository->search($search, $categoryId);
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }
}
