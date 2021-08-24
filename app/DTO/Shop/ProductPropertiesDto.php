<?php

namespace App\DTO\Shop;

use Illuminate\Support\Collection;

class ProductPropertiesDto
{
    public $id;
    public $name;
    public $value;

    public function __construct(Collection $data)
    {
        $this->id = $data->get('id');
        $this->name = $data->get('name');
        $propertyValue = $data->get('property_values');
        $this->value = $propertyValue ? $propertyValue['value'] : '';
    }
}
