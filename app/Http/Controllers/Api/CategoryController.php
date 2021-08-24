<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryPropertiesRequest;
use App\Services\Shop\ICategoryService;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{
    private $categoryService;

    public function __construct()
    {
        $this->categoryService = resolve(ICategoryService::class);
    }

    public function getProperties(CategoryPropertiesRequest $request): Jsonable
    {
        return $this->categoryService->getCategoryProperties($request->category_id);
    }
}
