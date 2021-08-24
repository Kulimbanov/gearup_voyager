<?php

namespace App\Repository\Shop;

use App\Models\CategoryProperty;
use App\Models\PropertyValue;
use Illuminate\Support\Collection;

class PropertyValueRepository
{
    public function getProperties(int $productId = null, int $categoryId = null): Collection
    {
        return CategoryProperty::where(CategoryProperty::CATEGORY_ID, $categoryId)
                               ->with(CategoryProperty::R_PROPERTY_VALUE, function ($query) use ($productId) {
                                   $query->where(PropertyValue::PRODUCT_ID, $productId);
                               })
                               ->get();
    }

    public function addProperty(int $productId, int $categoryPropertyId, string $value): int
    {
        return PropertyValue::updateOrCreate([
            PropertyValue::PRODUCT_ID => $productId,
            PropertyValue::CATEGORY_PROPERTY_ID => $categoryPropertyId
        ], [
            PropertyValue::VALUE => $value
        ])->id;
    }

    public function clearProductProperties(Collection $propertyValueIds, int $productId): void
    {
        PropertyValue::where(PropertyValue::PRODUCT_ID, $productId)
                     ->whereNotIn(PropertyValue::ID, $propertyValueIds)
                     ->delete();
    }
}
