<?php

namespace App\Services\Page\Generator;

use App\Services\Page\PublicPageMap;
use App\Services\Page\Type\IPublicPage;
use App\Services\Shop\IProductService;

class ProductPageService implements IProductPageService
{
    private IProductService $productService;
    private IPublicPageService $pageService;
    private ICategoryPageService $categoryService;

    public function __construct(
        IProductService $productService,
        IPublicPageService $pageService,
        ICategoryPageService $categoryService
    ) {
        $this->productService = $productService;
        $this->pageService = $pageService;
        $this->categoryService = $categoryService;
    }

    public function getProductPageDto(string $productSlug, string $categorySlug): IPublicPage
    {
        $categoryPageDto = $this->categoryService->getCategoryPageDto($categorySlug);

        $product = $this->productService->getProductBySlug($productSlug);

        if (empty($product)) {
            return $this->pageService->getPublicPageDto('404');
        }

        return PublicPageMap::mapProduct($categoryPageDto, $product);
    }
}
