<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProductPropertiesRequest;
use App\Models\Product;
use App\Services\Shop\IProductService;
use App\Services\Shop\IPropertyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    private IPropertyService $propertyService;
    private IProductService $productService;

    public function __construct()
    {
        $this->propertyService = resolve(IPropertyService::class);
        $this->productService = resolve(IProductService::class);
    }

    public function index(Request $request): JsonResponse
    {
        $products = $this->productService->getProductsByCategoryId($request->get(Product::CATEGORY_ID));

        return response()->json($products);
    }

    public function getProperties(ProductPropertiesRequest $request): JsonResponse
    {
        return $this->propertyService->getProductCategoryProperties(
            $request->getProductId(),
            $request->getCategoryId()
        );
    }
}
