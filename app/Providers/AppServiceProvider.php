<?php

namespace App\Providers;

use App\Models\News;
use Illuminate\Support\ServiceProvider;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Services\CategoryServiceInterface;
use App\Services\CategoryService;

use App\Services\NewsServiceInterface;
use App\Services\NewsService;
use App\Repositories\NewsRepositoryInterface;
use App\Repositories\NewsRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);

        $this->app->bind(NewsRepositoryInterface::class, NewsRepository::class);
        $this->app->bind(NewsServiceInterface::class, NewsService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
