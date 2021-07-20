<?php

namespace App\Services\Shop;

use App\DTO\Page\PublicPageDto;
use App\Repository\Shop\ProductCategoryRepository;
use App\Services\Page\HeaderImageGenerator;

class CategoryService implements ICategoryService
{
    private ProductCategoryRepository $productCategoryRepository;

    public function __construct(ProductCategoryRepository $productCategoryRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
    }

    public function loadCategoryPage(?string $categorySlug): ?PublicPageDto
    {
        $category = $this->productCategoryRepository->getCategoryBySlug($categorySlug);

        if (empty($category)) {
            return (new PublicPageDto)->setTitle('404')->setCategoryId(0);
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
