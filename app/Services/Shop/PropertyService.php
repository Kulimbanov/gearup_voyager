<?php

namespace App\Services\Shop;

use App\DTO\Shop\ProductPropertiesDto;
use App\Repository\Shop\PropertyValueRepository;
use Illuminate\Support\Collection;

class PropertyService implements IPropertyService
{
    private $propertyRepository;

    public function __construct()
    {
        $this->propertyRepository = resolve(PropertyValueRepository::class);
    }

    public function getProductCategoryProperties(int $productId = null, int $categoryId = null): Collection
    {
        $data = $this->propertyRepository->getProperties($productId, $categoryId);

        return $data->map(function ($property) {
            return $this->mapDto($property);
        });
    }

    public function addProductProperties(int $productId, Collection $categoryProperties): void
    {
        $newProperties = $categoryProperties->map(function ($value, $categoryPropertyId) use ($productId) {
            return $this->propertyRepository->addProperty($productId, $categoryPropertyId, $value);
        })->flatten();

        $this->propertyRepository->clearProductProperties($newProperties, $productId);
    }

    private function mapDto($data): ProductPropertiesDto
    {
        logger(collect($data)->get('property_values', ['value' => '']));
        return new ProductPropertiesDto(collect($data));
    }
}
