<?php

namespace App\Services\Shop;

use App\DTO\Page\PublicPageDto;

interface ICategoryService
{
    public function loadCategoryPage(?string $categorySlug): ?PublicPageDto;
}
