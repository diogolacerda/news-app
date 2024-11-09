<?php

namespace App\Services;
use Illuminate\Support\Facades\Cache;

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
        $page = request()->input('page', 1);

        $cachePrefix = 'news_';
        $cacheKey = $cachePrefix . md5('search=' . ($search ?? '') . '&category_id=' . ($categoryId ?? '') . '&page=' . $page);

        $news = Cache::tags(['news'])->remember($cacheKey, 60, function () use ($search, $categoryId) {
            $news = $this->repository->search($search, $categoryId);
            return $news;
        });

        return $news;
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }
}
