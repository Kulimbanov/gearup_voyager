<?php

namespace App\DTO\Shop;

use App\Models\CategoryProperty;

class ProductPropertiesDto
{
    public $id;
    public $name;
    public $value;

    public function __construct(CategoryProperty $data)
    {
        $this->id = $data->id;
        $this->name = $data->name;
        $propertyValue = $data->propertyValues;
        $this->value = !empty($propertyValue) ? $propertyValue->value : '';
    }
}
