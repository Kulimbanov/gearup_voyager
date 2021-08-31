<?php

namespace App\Services\Shop;

use App\DTO\Shop\ProductPropertiesDto;
use App\Models\CategoryProperty;
use App\Repository\Shop\PropertyValueRepository;
use Illuminate\Support\Collection;

class PropertyService implements IPropertyService
{
    private PropertyValueRepository $propertyRepository;

    public function __construct(PropertyValueRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function getProductCategoryProperties(int $productId = null, int $categoryId = null): Collection
    {
        $data = $this->propertyRepository->getProperties($productId, $categoryId);

        return $data->map(function (CategoryProperty $property) {
            return new ProductPropertiesDto($property);
        });
    }

    public function addProductProperties(int $productId, Collection $categoryProperties): void
    {
        $newProperties = $categoryProperties->map(function ($value, $categoryPropertyId) use ($productId) {
            return $this->propertyRepository->addProperty($productId, $categoryPropertyId, $value);
        })->flatten();

        $this->propertyRepository->clearProductProperties($newProperties, $productId);
    }
}
