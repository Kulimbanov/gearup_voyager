<?php

namespace App\Services;

use App\DTO\Page\ProductPageDto;
use App\Services\Page\PublicPageMap;
use App\Services\Shop\ICategoryService;
use App\Services\Shop\IProductService;

class ProductPageService implements IProductPageService
{
    private IProductService $productService;
    private IPageService $pageService;
    private ICategoryService $categoryService;

    public function __construct(
        IProductService $productService,
        IPageService $pageService,
        ICategoryService $categoryService
    ) {
        $this->productService = $productService;
        $this->pageService = $pageService;
        $this->categoryService = $categoryService;
    }

    public function getProductPageDto(string $productSlug, string $categorySlug): ProductPageDto
    {
        $categoryPageDto = $this->categoryService->getCategoryPageDto($categorySlug);

        $product = $this->productService->getProductBySlug($productSlug);

        if (empty($product)) {
            return $this->pageService->getPublicPageDto('404');
        }

        return PublicPageMap::mapProduct($categoryPageDto, $product);
    }
}
