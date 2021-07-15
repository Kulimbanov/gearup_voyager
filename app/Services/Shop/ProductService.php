<?php

namespace App\Services\Shop;

use App\Repository\Shop\ProductRepository;
use Illuminate\Support\Collection;

class ProductService implements IProductService
{
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = resolve(ProductRepository::class);
    }

    public function getProductCategoryProperties(int $productId, int $categoryId = null): Collection
    {
        return $this->productRepository->getProperties($productId, $categoryId);
    }

    public function getProductsByCategoryId(?int $categoryId): Collection
    {
        if (empty($categoryId)) {
            return $this->productRepository->allProducts();
        }

        return $this->productRepository->getCategoryProducts($categoryId);
    }
}
