<?php

namespace App\Services\Page;

use App\DTO\Page\CategoryPageDto;
use App\DTO\Page\ProductPageDto;
use App\DTO\Page\PublicPageDto;
use App\ENUM\PageTemplates;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\Page\Type\IPublicPage;

final class PublicPageMap
{
    public static function mapPage(Page $page): PublicPageDto
    {
        return (new PublicPageDto)
            ->setTitle($page->title)
            ->setSubTitle($page->sub_title)
            ->setHeaderImage(HeaderImageGenerator::generateHeaderImage($page->header_image))
            ->setBody($page->body)
            ->setTemplate($page->template ?? PageTemplates::PUBLIC);
    }

    public static function mapCategory(ProductCategory $productCategory): CategoryPageDto
    {
        return (new CategoryPageDto)
            ->setTitle($productCategory->name)
            ->setSubTitle($productCategory->title)
            ->setHeaderImage(HeaderImageGenerator::generateHeaderImage($productCategory->image))
            ->setBody($productCategory->description)
            ->setTemplate(PageTemplates::SHOP)
            ->setCategoryId($productCategory->id);
    }

    public static function mapProduct(IPublicPage $categoryPageDto, Product $product): ProductPageDto
    {
        logger(json_encode($product->productProperties()));
        return (new ProductPageDto)
            ->setTitle($categoryPageDto->getTitle())
            ->setSubTitle($categoryPageDto->getSubTitle())
            ->setHeaderImage($categoryPageDto->getHeaderImage())
            ->setTemplate(PageTemplates::PRODUCT)
            ->setBody($product->description)
            ->setPrice($product->price)
            ->setImages(collect($product->image))
            ->setBrands($product->brands)
            ->setCategory($product->productCategory->name)
            ->setProperties($product->productProperties);
    }

}
