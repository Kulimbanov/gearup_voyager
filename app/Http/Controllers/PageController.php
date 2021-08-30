<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Services\IPageService;
use App\Services\IProductPageService;
use App\Services\Page\GetTemplateView;
use App\Services\Shop\ICategoryService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private IPageService $pageService;
    private ICategoryService $categoryService;
    private IProductPageService $productPageService;

    public function __construct()
    {
        $this->pageService = resolve(IPageService::class);
        $this->categoryService = resolve(ICategoryService::class);
        $this->productPageService = resolve(IProductPageService::class);
    }

    public function index(PageRequest $request)
    {
        $page = $this->pageService->getPublicPageDto($request->route('slug'));

        return view(GetTemplateView::get($page->getTemplate()))->with([
            'page' => $page,
        ]);
    }

    public function shop(Request $request)
    {
        $categoryPageDto = $this->categoryService->getCategoryPageDto($request->route('categorySlug'));

        return view(GetTemplateView::get($categoryPageDto->getTemplate()))->with([
            'page' => $categoryPageDto,
        ]);
    }

    public function product(Request $request)
    {
        $productPageDto = $this->productPageService->getProductPageDto(
            $request->route('productSlug'),
            $request->route('categorySlug')
        );

        return view(GetTemplateView::get($productPageDto->getTemplate()))->with([
            'page' => $productPageDto
        ]);
    }
}
