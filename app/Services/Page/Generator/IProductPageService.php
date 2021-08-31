<?php

namespace App\Services\Page\Generator;

use App\Services\Page\Type\IPublicPage;

interface IProductPageService
{
    public function getProductPageDto(string $productSlug, string $categorySlug): IPublicPage;
}
