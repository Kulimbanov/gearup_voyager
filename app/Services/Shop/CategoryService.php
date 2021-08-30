<?php

namespace App\Services\Shop;

use App\DTO\Page\CategoryPageDto;
use App\Repository\Shop\ProductCategoryRepository;
use App\Services\IPageService;
use App\Services\Page\PublicPageMap;

class CategoryService implements ICategoryService
{
    private ProductCategoryRepository $productCategoryRepository;
    private IPageService $pageService;

    public function __construct(ProductCategoryRepository $productCategoryRepository, IPageService $pageService)
    {
        $this->productCategoryRepository = $productCategoryRepository;
        $this->pageService = $pageService;
    }

    public function getCategoryPageDto(?string $categorySlug): ?CategoryPageDto
    {
        $category = $this->productCategoryRepository->getCategoryBySlug($categorySlug);

        if (empty($category)) {
            return $this->pageService->getPublicPageDto('404');
        }

        return PublicPageMap::mapCategory($category);
    }
}
