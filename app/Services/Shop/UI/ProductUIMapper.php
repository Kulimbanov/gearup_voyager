<?php

namespace App\Services\Shop\UI;

use App\DTO\Shop\ListProductDto;
use App\Models\Product;
use Illuminate\Support\Collection;

class ProductUIMapper implements IProductUIMapper
{

    public function __construct()
    {
    }

    public function mapListProducts(Collection $products): Collection
    {
        return $products->map(function (Product $product) {
            return $this->mapListProduct($product);
        });
    }

    private function mapListProduct(Product $product): ListProductDto
    {
        return (new ListProductDto)
            ->setSlug($product->slug)
            ->setName($product->name)
            ->setCategory($product->productCategory->name)
            ->setBrand($product->brands->pluck('name'))
            ->setImage($product->image)
            ->setPrice($product->price)
            ->setProperties($product->productProperties);
    }

}
