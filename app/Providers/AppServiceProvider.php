<?php

namespace App\Providers;

use App\Services\ContactForm\ContactFormService;
use App\Services\ContactForm\IContactFormService;
use App\Services\Mail\ISendService;
use App\Services\Mail\SendService;
use App\Services\Page\Generator\CategoryPageService;
use App\Services\Page\Generator\ICategoryPageService;
use App\Services\Page\Generator\IProductPageService;
use App\Services\Page\Generator\IPublicPageService;
use App\Services\Page\Generator\ProductPageService;
use App\Services\Page\Generator\PublicPageService;
use App\Services\Repairments\IRepairmentService;
use App\Services\Repairments\RepairmentService;
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
        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IPropertyService::class, PropertyService::class);
        $this->app->bind(IProductUIMapper::class, ProductUIMapper::class);
        $this->app->bind(IRepairmentService::class, RepairmentService::class);

        //Send and contact
        $this->app->bind(IContactFormService::class, ContactFormService::class);
        $this->app->bind(ISendService::class, SendService::class);

        //Page Generators
        $this->app->bind(IPublicPageService::class, PublicPageService::class);
        $this->app->bind(ICategoryPageService::class, CategoryPageService::class);
        $this->app->bind(IProductPageService::class, ProductPageService::class);
    }

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
    }
}
