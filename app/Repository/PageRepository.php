<?php

namespace App\Repository;

use App\Models\Page;

class PageRepository
{
    public function getSlugById(int $id): ?string
    {
        return optional(Page::where(Page::ID, $id)->first(Page::SLUG))->slug;
    }

    public function getBySlug(?string $slug): ?Page
    {
        return Page::where(Page::SLUG, $slug)->first();
    }
}
