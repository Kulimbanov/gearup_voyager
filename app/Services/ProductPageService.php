<?php

namespace App\Services;

use App\DTO\Page\PublicPageDto;
use App\Repository\Shop\ProductRepository;
use App\Services\Page\HeaderImageGenerator;

class ProductPageService implements IProductPageService
{
    private ProductRepository $productRepository;
    private IPageService $pageService;

    public function __construct()
    {
        $this->productRepository = resolve(ProductRepository::class);
        $this->pageService = resolve(IPageService::class);
    }

    public function loadProductPage(?string $productSlug): PublicPageDto
    {
        if (empty($productSlug)) {
            return $this->pageService->loadPage('404');
        }

        $product = $this->productRepository->getProductBySlug($productSlug);

        $headerImage = HeaderImageGenerator::generateHeaderImage($product->image);

        return (new PublicPageDto)
            ->setTitle($product->name)
            ->setBody($product->description)
            ->setSubTitle($product->sub_title)
            ->setHeaderImage($headerImage)
            ->setTemplate($product->template);
    }
}
