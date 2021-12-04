<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Partners\IPartnerService;
use Illuminate\Http\JsonResponse;

class PartnerController extends Controller
{
    private IPartnerService $partnerService;

    public function __construct()
    {
        $this->partnerService = resolve(IPartnerService::class);
    }

    public function index(): JsonResponse
    {
        $partners = $this->partnerService->getPartners();

        return response()->json($partners);
    }
}
