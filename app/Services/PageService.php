<?php

namespace App\Services;

use App\DTO\Page\PublicPageDto;
use App\Models\Page;
use App\Repository\PageRepository;
use App\Services\Page\HeaderImageGenerator;

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
            $page = $this->pageRepository->getBySlug('404');
        }

        return $this->mapPageDto($page);
    }

    private function mapPageDto(Page $page): PublicPageDto
    {
        $headerImage = HeaderImageGenerator::generateHeaderImage($page->header_image);

        return (new PublicPageDto)
            ->setTitle($page->title)
            ->setBody($page->body)
            ->setSubTitle($page->sub_title)
            ->setHeaderImage($headerImage)
            ->setTemplate($page->template);
    }
}
