<?php

namespace App\Services\Shop\UI;

use Illuminate\Support\Collection;

interface IProductUIMapper
{
    public function mapListProducts(Collection $products): Collection;

    public static function mapPropertiesValues(Collection $properties, Collection $values): Collection;
}
