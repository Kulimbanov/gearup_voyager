<?php

namespace App\Services\Page\Generator;

use App\DTO\Page\PublicPageDto;

interface IPublicPageService
{
    public function getSlugById(int $id): string;

    public function getPublicPageDto(string $slug): PublicPageDto;
}
