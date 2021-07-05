<?php

namespace App\Services\Shop;

use Illuminate\Support\Collection;

interface ICategoryService
{
    public function getCategoryProperties(int $categoryId): Collection;
}
