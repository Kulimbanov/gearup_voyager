<?php

namespace App\Services\Page\Generator;

use App\Repository\Shop\ProductCategoryRepository;
use App\Services\Page\PublicPageMap;
use App\Services\Page\Type\IPublicPage;

class CategoryPageService implements ICategoryPageService
{
    private ProductCategoryRepository $productCategoryRepository;
    private IPublicPageService $publicPageService;

    public function __construct(ProductCategoryRepository $productCategoryRepository, IPublicPageService $pageService)
    {
        $this->productCategoryRepository = $productCategoryRepository;
        $this->publicPageService = $pageService;
    }

    public function getCategoryPageDto(string $categorySlug): IPublicPage
    {
        $category = $this->productCategoryRepository->getCategoryBySlug($categorySlug);

        if (empty($category)) {
            return $this->publicPageService->getPublicPageDto('404');
        }

        return PublicPageMap::mapCategory($category);
    }
}
