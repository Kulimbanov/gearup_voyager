<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProductPropertiesRequest;
use App\Models\Product;
use App\Services\Shop\IPropertyService;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    private $propertyService;

    public function __construct()
    {
        $this->propertyService = resolve(IPropertyService::class);
    }

    public function index()
    {
        $products = Product::all()->toArray();
        return array_reverse($products);
    }


    public function getProperties(ProductPropertiesRequest $request): Jsonable
    {
        return $this->propertyService->getProductCategoryProperties(
            $request->getProductId(),
            $request->getCategoryId()
        );
    }
}
