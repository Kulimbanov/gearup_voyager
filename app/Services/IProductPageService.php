<?php

namespace App\Services;

use App\DTO\Page\ProductPageDto;

interface IProductPageService
{
    public function getProductPageDto(string $productSlug, string $categorySlug): ProductPageDto;
}
