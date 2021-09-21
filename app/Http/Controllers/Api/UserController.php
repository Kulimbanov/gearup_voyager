<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Models\User;
use App\Services\Auth\IUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function logout(Request $request): JsonResponse
    {
        //$response = $this->userService->logout();
        $this->guard()->logout();

        $request->session()->invalidate();

        if ($request->wantsJson()) {
            return response()->json([], 204);
        }

        return redirect('/');

        //Auth::logout();

        //$request->session()->invalidate();
        //
        //$request->session()->regenerateToken();
        //
        ////return redirect('/');
        ////logger('logout');
        ////logger($response->jsonSerialize());
        ////
        //return response()->json([]);
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $response = $this->userService->sendPasswordResetEmail($request->get(User::EMAIL));

        return response()->json($response->jsonSerialize());
    }
}
