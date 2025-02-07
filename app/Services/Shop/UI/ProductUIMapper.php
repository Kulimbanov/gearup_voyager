<?php

namespace App\Services\Shop\UI;

use App\DTO\Shop\ListProductDto;
use App\Models\Brand;
use App\Models\CategoryProperty;
use App\Models\Product;
use App\Models\PropertyValue;
use Illuminate\Support\Collection;

class ProductUIMapper implements IProductUIMapper
{
    public function mapListProducts(Collection $products): Collection
    {
        return $products->map(function (Product $product) {
            return $this->mapProductProperties($product);
        });
    }

    private function mapProductProperties(Product $product): ListProductDto
    {
        $properties = $this->mapPropertiesValues($product->productPropertiesValues, $product->productProperties);

        return (new ListProductDto)
            ->setSlug($product->slug)
            ->setName($product->name)
            ->setImage($product->image)
            ->setPrice($product->price)
            ->setFeatured($product->featured)
            ->setBrand($product->brands->pluck(Brand::NAME))
            ->setCategorySlug($product->productCategory->slug)
            ->setProperties($properties);
    }

    public static function mapPropertiesValues(Collection $properties, Collection $values): Collection
    {
        return $properties->map(function ($property) use ($values) {
            return [
                PropertyValue::VALUE => $values->firstWhere(PropertyValue::CATEGORY_PROPERTY_ID, $property->id)->value,
                CategoryProperty::NAME => $property->name
            ];
        });
    }

}
