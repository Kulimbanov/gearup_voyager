<?php

namespace App\Services\Shop;

use Illuminate\Support\Collection;

interface IProductService
{
    public function getProductCategoryProperties(int $productId, int $categoryId = null): Collection;

    public function getProductsByCategoryId(?int $categoryId): Collection;
}
