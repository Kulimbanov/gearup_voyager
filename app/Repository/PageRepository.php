<?php

namespace App\Repository;

use App\Models\Page;
use App\Providers\RouteServiceProvider;

class PageRepository
{
    public function getSlugById(int $id): ?string
    {
        return optional(Page::where(Page::ID, $id)->first(Page::SLUG))->slug;
    }

    public function getBySlug(?string $slug): ?Page
    {
        if (empty($slug)) {
            return Page::where(Page::SLUG, RouteServiceProvider::HOME)->first();
        }

        return Page::where(Page::SLUG, $slug)->first();
    }
}
