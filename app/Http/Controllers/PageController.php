<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Providers\RouteServiceProvider;
use App\Services\Page\Generator\ICategoryPageService;
use App\Services\Page\Generator\IProductPageService;
use App\Services\Page\Generator\IPublicPageService;
use App\Services\Page\GetTemplateView;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private IPublicPageService $publicPageService;
    private ICategoryPageService $categoryPageService;
    private IProductPageService $productPageService;

    public function __construct(
        IPublicPageService $publicPageService,
        ICategoryPageService $categoryPageService,
        IProductPageService $productPageService
    ) {
        $this->publicPageService = $publicPageService;
        $this->categoryPageService = $categoryPageService;
        $this->productPageService = $productPageService;
    }

    public function index(PageRequest $request)
    {
        $page = $this->publicPageService->getPublicPageDto(
            $request->route('slug', RouteServiceProvider::HOME)
        );

        return view(GetTemplateView::get($page->getTemplate()))->with([
            'page' => $page,
        ]);
    }

    public function shop(Request $request)
    {
        $categoryPageDto = $this->categoryPageService->getCategoryPageDto($request->route('categorySlug'));

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
