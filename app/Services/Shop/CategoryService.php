<?php

namespace App\Services\Shop;

use App\Repository\Shop\CategoryPropertyRepository;
use Illuminate\Support\Collection;

class CategoryService implements ICategoryService
{
    private $categoryRepository;

    public function __construct(CategoryPropertyRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoryProperties(int $categoryId): Collection
    {
    }
}
