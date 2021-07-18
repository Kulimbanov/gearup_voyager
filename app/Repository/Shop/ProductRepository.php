<?php

namespace App\Repository\Shop;

use App\Models\Product;
use App\Models\PropertyValue;
use Illuminate\Support\Collection;

class ProductRepository
{
    public function getProperties(int $productId, int $categoryId = null): Collection
    {
        return PropertyValue::where(PropertyValue::PRODUCT_ID, $productId)->get();
    }

    public function allProducts(): Collection
    {
        return Product::all();
    }

    public function getCategoryProducts(int $categoryId): Collection
    {
        return Product::where(Product::CATEGORY_ID, $categoryId)
                      ->with([Product::R_BRANDS, Product::R_PRODUCT_CATEGORY])
                      ->get();
    }
}
