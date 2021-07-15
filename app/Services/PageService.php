<?php

namespace App\Services;

use App\Models\Page;
use App\Repository\PageRepository;

class PageService implements IPageService
{
    private $pageRepository;

    public function __construct()
    {
        $this->pageRepository = resolve(PageRepository::class);
    }

    public function getSlugById(int $id): string
    {
        return $this->pageRepository->getSlugById($id);
    }

    public function load(?string $slug): Page
    {
        $page = $this->pageRepository->getBySlug($slug);

        if (empty($page)) {
            //TODO: use settings
            $page = $this->pageRepository->getBySlug('404');
        }

        return $page;
    }
}
