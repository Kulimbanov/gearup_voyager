<?php

namespace App\Services\Shop;

use App\DTO\Page\PublicPageDto;
use App\Repository\Shop\ProductCategoryRepository;

class CategoryService implements ICategoryService
{
    private ProductCategoryRepository $productCategoryRepository;

    public function __construct(ProductCategoryRepository $productCategoryRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
    }

    public function loadCategoryPage(?string $categorySlug): ?PublicPageDto
    {
        logger($categorySlug);
        $category = $this->productCategoryRepository->getCategoryBySlug($categorySlug);

        if (empty($category)) {
            return (new PublicPageDto)->setTitle('404')->setCategoryId(0);
        }

        return (new PublicPageDto)
            ->setTitle($category->name)
            ->setBody($category->description)
            ->setCategoryId($category->id);
    }
}
