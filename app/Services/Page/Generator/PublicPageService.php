<?php

namespace App\Services\Page\Generator;

use App\DTO\Page\PublicPageDto;
use App\Repository\PageRepository;
use App\Services\Page\PublicPageMap;

class PublicPageService implements IPublicPageService
{
    private PageRepository $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function getSlugById(int $id): string
    {
        return $this->pageRepository->getSlugById($id);
    }

    public function getPublicPageDto(string $slug): PublicPageDto
    {
        $page = $this->pageRepository->getBySlug($slug);

        if (empty($page)) {
            $page = $this->pageRepository->getBySlug('404');
        }

        return PublicPageMap::mapPage($page);
    }
}
