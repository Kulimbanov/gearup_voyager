<?php

namespace App\Services;

use App\DTO\Page\PublicPageDto;
use App\Models\Page;
use App\Repository\PageRepository;
use TCG\Voyager\Facades\Voyager;

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
        $headerImage = $this->getHeaderImage($page);

        return (new PublicPageDto)
            ->setTitle($page->title)
            ->setBody($page->body)
            ->setSubTitle($page->sub_title)
            ->setHeaderImage($headerImage)
            ->setTemplate($page->template);
    }

    private function getHeaderImage(Page $page): string
    {
        return Voyager::image(!empty($page->header_image) ? $page->header_image : setting('site.headerImage'));
    }
}
