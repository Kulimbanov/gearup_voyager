<?php

namespace App\Services\Shop;

use App\Models\Product;
use App\Repository\Shop\ProductRepository;
use App\Services\Shop\UI\IProductUIMapper;
use Illuminate\Support\Collection;

class ProductService implements IProductService
{
    private ProductRepository $productRepository;
    private IProductUIMapper $productUIMapper;

    public function __construct(ProductRepository $productRepository, IProductUIMapper $productUIMapper)
    {
        $this->productRepository = $productRepository;
        $this->productUIMapper = $productUIMapper;
    }

    public function getProductCategoryProperties(int $productId, int $categoryId = null): Collection
    {
        return $this->productRepository->getProperties($productId, $categoryId);
    }

    public function getProductsByCategoryId(?int $categoryId): Collection
    {
        $products = $this->loadProducts($categoryId);

        return $this->productUIMapper->mapListProducts($products);
    }

    private function loadProducts(?int $categoryId): Collection
    {
        if (empty($categoryId)) {
            return $this->productRepository->allProducts();
        }

        return $this->productRepository->getCategoryProducts($categoryId);
    }

    public function getFeaturedProducts(): Collection
    {
        return $this->productRepository->getFeaturedProducts();
    }

    public function getProductBySlug(string $slug): ?Product
    {
        return $this->productRepository->getProductBySlug($slug);
    }
}
