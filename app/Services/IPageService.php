<?php

namespace App\Services;

use App\Models\Page;

interface IPageService
{
    public function getSlugById(int $id): string;

    public function load(?string $slug): Page;
}
