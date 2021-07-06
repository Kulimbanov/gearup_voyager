<?php

namespace App\Services\Shop;

use App\Repository\Shop\ProductRepository;
use Illuminate\Support\Collection;

class ProductService implements IProductService
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = resolve(ProductRepository::class);
    }

    public function getProductCategoryProperties(int $productId, int $categoryId = null): Collection
    {
        return $this->productRepository->getProperties($productId, $categoryId);
    }
}
