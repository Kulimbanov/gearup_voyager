<?php

namespace App\Services\Shop;

use App\DTO\Page\PublicPageDto;
use App\Repository\Shop\ProductCategoryRepository;
use App\Services\IPageService;
use App\Services\Page\HeaderImageGenerator;

class CategoryService implements ICategoryService
{
    private ProductCategoryRepository $productCategoryRepository;
    private IPageService $pageService;

    public function __construct(ProductCategoryRepository $productCategoryRepository, IPageService $pageService)
    {
        $this->productCategoryRepository = $productCategoryRepository;
        $this->pageService = $pageService;
    }

    public function loadCategoryPage(?string $categorySlug): ?PublicPageDto
    {
        $category = $this->productCategoryRepository->getCategoryBySlug($categorySlug);

        if (empty($category)) {
            return $this->pageService->loadPage('404')->setCategoryId(0);
        }
        $headerImage = HeaderImageGenerator::generateHeaderImage($category->image);

        return (new PublicPageDto)
            ->setTitle($category->name)
            ->setSubTitle("Shop")
            ->setBody($category->description)
            ->setCategoryId($category->id)
            ->setHeaderImage($headerImage);
    }
}
