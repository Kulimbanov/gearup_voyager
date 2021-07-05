<?php

namespace App\Repository\Shop;

use App\Models\CategoryProperty;
use Illuminate\Support\Collection;

class CategoryRepository
{
    public function getProperties(int $categoryId): Collection
    {
        return (new CategoryProperty)::where('category_id', $categoryId)->get();
    }
}
