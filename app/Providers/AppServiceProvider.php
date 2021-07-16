<?php

namespace App\Providers;

use App\Services\IPageService;
use App\Services\PageService;
use App\Services\Shop\CategoryService;
use App\Services\Shop\ICategoryService;
use App\Services\Shop\IProductService;
use App\Services\Shop\IPropertyService;
use App\Services\Shop\ProductService;
use App\Services\Shop\PropertyService;
use App\Services\Shop\UI\IProductUIMapper;
use App\Services\Shop\UI\ProductUIMapper;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ICategoryService::class, CategoryService::class);
        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IPropertyService::class, PropertyService::class);
        $this->app->bind(IPageService::class, PageService::class);
        $this->app->bind(IProductUIMapper::class, ProductUIMapper::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
