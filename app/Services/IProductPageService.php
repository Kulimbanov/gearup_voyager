<?php

namespace App\Services;

use App\DTO\Page\PublicPageDto;

interface IProductPageService
{
    public function loadProductPage(?string $productSlug): PublicPageDto;
}
