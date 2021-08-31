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

    public function getFeaturedProducts(): Collection
    {
        return Product::where(Product::FEATURED, 1)
                      ->with(Product::R_PRODUCT_CATEGORY)
                      ->get();
    }

    public function getProductBySlug(string $slug): ?Product
    {
        return Product::where(Product::SLUG, $slug)
                      ->with(Product::R_PRODUCT_PROPERTIES)
                      ->first();
    }
}
