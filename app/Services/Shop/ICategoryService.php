<?php

namespace App\Services\Shop;

use App\DTO\Page\PublicPageDto;

interface ICategoryService
{
    public function getCategoryPageDto(?string $categorySlug): ?PublicPageDto;
}
