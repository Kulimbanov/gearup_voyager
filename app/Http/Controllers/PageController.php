<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Services\IPageService;

class PageController extends Controller
{
    private $pageService;

    public function __construct()
    {
        $this->pageService = resolve(IPageService::class);
    }

    public function index(PageRequest $request)
    {
        logger($request->getSlug());
        $page = $this->pageService->load($request->route('slug'));

        return view('page.public')->with([
            'page' => $page,
        ]);
    }
}
