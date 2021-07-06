<?php

namespace App\Repository\Shop;

use App\Models\PropertyValue;
use Illuminate\Support\Collection;

class ProductRepository
{
    public function getProperties(int $productId, int $categoryId = null): Collection
    {
        return PropertyValue::where(PropertyValue::PRODUCT_ID, $productId)->get();
    }
}
