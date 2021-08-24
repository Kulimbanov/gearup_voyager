<?php

namespace App\Providers;

use App\Services\ContactForm\ContactFormService;
use App\Services\ContactForm\IContactFormService;
use App\Services\IPageService;
use App\Services\Mail\ISendService;
use App\Services\Mail\SendService;
use App\Services\PageService;
use App\Services\Repairments\IRepairmentService;
use App\Services\Repairments\RepairmentService;
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
     * @return void
     */
    public function register()
    {
        $this->app->bind(ICategoryService::class, CategoryService::class);
        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IPropertyService::class, PropertyService::class);
        $this->app->bind(IPageService::class, PageService::class);
        $this->app->bind(IProductUIMapper::class, ProductUIMapper::class);
        $this->app->bind(IRepairmentService::class, RepairmentService::class);
        $this->app->bind(IContactFormService::class, ContactFormService::class);
        $this->app->bind(ISendService::class, SendService::class);
    }

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
    }
}
