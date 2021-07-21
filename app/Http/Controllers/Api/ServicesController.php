<?php

namespace App\Http\Controllers\Api;

use App\Services\Repairments\IRepairmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ServicesController extends Controller
{
    private IRepairmentService $repairmentService;

    public function __construct()
    {
        $this->repairmentService = resolve(IRepairmentService::class);
    }

    public function index(Request $request): JsonResponse
    {
        $repairment = $this->repairmentService->getRepairmentByName($request->get());

        return response()->json($repairment);
    }
}
