<?php

namespace App\Services;

use App\DTO\Page\ProductPageDto;
use App\ENUM\PageTemplates;
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

    public function loadProductPage(?string $productSlug): ProductPageDto
    {
        if (empty($productSlug)) {
            return $this->pageService->loadPage('404');
        }

        $product = $this->productRepository->getProductBySlug($productSlug);

        if (empty($product)) {
            return $this->pageService->loadPage('404');
        }

        $headerImage = HeaderImageGenerator::generateHeaderImage($product->image);

        return (new ProductPageDto)
            ->setTitle($product->name)
            ->setBody($product->description)
            ->setSubTitle($product->sub_title)
            ->setHeaderImage($headerImage)
            ->setTemplate(PageTemplates::PRODUCT)
            ->setPrice($product->price)
            ->setImages(collect($product->image))
            ->setBrands($product->brands)
            ->setCategory($product->productCategory->name);
    }
}
