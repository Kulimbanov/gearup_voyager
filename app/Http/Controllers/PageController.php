<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Services\IPageService;
use App\Services\Shop\ICategoryService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private IPageService $pageService;
    private ICategoryService $categoryService;

    public function __construct()
    {
        $this->pageService = resolve(IPageService::class);
        $this->categoryService = resolve(ICategoryService::class);
    }

    public function index(PageRequest $request)
    {
        $page = $this->pageService->loadPage($request->route('slug'));
        $template = !empty($page->template) ? 'templates.' . $page->template : 'public';

        return view('page.' . $template)->with([
            'page' => $page,
        ]);
    }

    public function shop(Request $request)
    {
        $category = $this->categoryService->loadCategoryPage($request->route('categorySlug'));

        return view('page.shop')->with([
            'page' => $category,
        ]);
    }
}
