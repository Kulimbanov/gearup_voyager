<?php

namespace App\Repository\Shop;

use App\Models\ProductCategory;

class ProductCategoryRepository
{
    public function getCategoryBySlug(?string $categorySlug): ?ProductCategory
    {
        return ProductCategory::where(ProductCategory::SLUG, $categorySlug)->first();
    }
}
