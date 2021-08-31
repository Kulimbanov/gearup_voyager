<?php

namespace App\Services\Page\Generator;

use App\Services\Page\Type\IPublicPage;

interface ICategoryPageService
{
    public function getCategoryPageDto(string $categorySlug): IPublicPage;
}
