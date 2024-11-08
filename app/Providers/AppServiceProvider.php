<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Services\BaseServiceInterface;
use App\Services\CategoryService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(BaseServiceInterface::class, CategoryService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
