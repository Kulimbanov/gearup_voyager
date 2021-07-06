<?php

namespace App\Http\Controllers\Voyager;

use App\Services\Shop\IPropertyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController as BaseVoyagerBaseController;

class VoyagerProductController extends BaseVoyagerBaseController
{
    private $propertyService;

    public function __construct()
    {
        $this->propertyService = resolve(IPropertyService::class);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $return = parent::update($request, $id);

        $propertiesWithValues = collect($request->get('category_property'));
        $this->propertyService->addProductProperties($id, $propertiesWithValues);

        return $return;
    }

}
