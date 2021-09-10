<?php

namespace App\Services\Shop;

use App\Models\Product;
use Illuminate\Support\Collection;

interface IProductService
{
    public function getProductCategoryProperties(int $productId, int $categoryId = null): Collection;

    public function getProductsByCategoryId(?int $categoryId): Collection;

    public function getFeaturedProducts(): Collection;

    public function getProductBySlug(string $slug): ?Product;
}
