<?php

namespace App\Services;

use App\DTO\Page\PublicPageDto;
use App\Repository\PageRepository;

class PageService implements IPageService
{
    private PageRepository $pageRepository;

    public function __construct()
    {
        $this->pageRepository = resolve(PageRepository::class);
    }

    public function getSlugById(int $id): string
    {
        return $this->pageRepository->getSlugById($id);
    }

    public function loadPage(?string $slug): PublicPageDto
    {
        $page = $this->pageRepository->getBySlug($slug ?? 'home');

        if (empty($page)) {
            //TODO: use settings
            $page = $this->pageRepository->getBySlug('404');
        }

        return (new PublicPageDto)->setTitle($page->title)->setBody($page->body)->setSubTitle($page->sub_title);
    }
}
