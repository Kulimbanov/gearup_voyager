<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Models\User;
use App\Services\Auth\IUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private IUserService $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $response = $this->userService->register($request->getUserDto());

        return response()->json($response->jsonSerialize());
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        $response = $this->userService->login($request->getUserDto());

        return response()->json($response->jsonSerialize());
    }

    public function logout(): JsonResponse
    {
        $response = $this->userService->logout();

        return response()->json($response->jsonSerialize());
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $response = $this->userService->sendPasswordResetEmail($request->get(User::EMAIL));

        return response()->json($response->jsonSerialize());
    }
}
