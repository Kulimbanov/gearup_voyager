<?php

namespace App\Services\Shop;

use Illuminate\Support\Collection;

interface IPropertyService
{
    public function getProductCategoryProperties(int $productId = null, int $categoryId = null): Collection;

    public function addProductProperties(int $productId, Collection $categoryProperties): void;
}
