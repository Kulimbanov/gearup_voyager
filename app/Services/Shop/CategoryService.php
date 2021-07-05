<?php

namespace App\Services\Shop;

use App\Repository\Shop\CategoryRepository;
use Illuminate\Support\Collection;

class CategoryService implements ICategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoryProperties(int $categoryId): Collection
    {
        return $this->categoryRepository->getProperties($categoryId);
    }
}
