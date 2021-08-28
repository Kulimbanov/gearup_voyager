<?php

namespace App\Services;

use App\DTO\Page\ProductPageDto;

interface IProductPageService
{
    public function loadProductPage(?string $productSlug): ProductPageDto;
}
