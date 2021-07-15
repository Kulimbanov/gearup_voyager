<?php

namespace App\Services;

use App\DTO\Page\PublicPageDto;

interface IPageService
{
    public function getSlugById(int $id): string;

    public function loadPage(?string $slug): PublicPageDto;
}
