<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Page;
use App\Services\Page\Generator\IPublicPageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use TCG\Voyager\Http\Controllers\VoyagerBaseController as BaseVoyagerBaseController;

class VoyagerPageController extends BaseVoyagerBaseController
{
    private IPublicPageService $pageService;

    public function __construct()
    {
        $this->pageService = resolve(IPublicPageService::class);
    }

    public function store(Request $request): RedirectResponse
    {
        $request = $this->updateParentSlug($request);

        return parent::store($request);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request = $this->updateParentSlug($request);

        return parent::update($request, $id);
    }

    private function updateParentSlug(Request $request): Request
    {
        $parentId = $request->get(Page::PARENT_ID);
        if (!empty($parentId)) {
            $parentSlug = $this->pageService->getSlugById($request->get(Page::PARENT_ID));
            if (!empty($parentSlug)) {
                if (!Str::startsWith($request->get(Page::SLUG), $parentSlug . '/')) {
                    $request->merge([Page::SLUG => $parentSlug . '/' . $request->get(Page::SLUG)]);
                }
            }
        }

        return $request;
    }
}
