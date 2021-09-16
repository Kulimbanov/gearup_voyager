<?php

namespace App\Services\Auth;

use App\DTO\ApiResponseDto;
use App\DTO\Auth\UserDto;
use App\ENUM\ResponseMessages;
use App\Repository\UserRepository;
use App\Services\Api\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Throwable;

class UserService implements IUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserDto $userDto): ApiResponseDto
    {
        try {
            $this->userRepository->register($userDto);
        } catch (Throwable $exception) {
            return Response::fail($exception->getMessage());
        }

        return Response::success(ResponseMessages::REGISTER_SUCCESS);
    }

    public function login(UserDto $userDto): ApiResponseDto
    {
        if (Auth::attempt($userDto->getCredentials())) {
            return Response::success(ResponseMessages::LOGIN_SUCCESS);
        } else {
            return Response::fail(ResponseMessages::LOGIN_FAIL);
        }
    }

    public function logout(): ApiResponseDto
    {
        try {
            Session::flush();

            return Response::success(ResponseMessages::LOGOUT);
        } catch (Throwable $exception) {
            return Response::fail($exception->getMessage());
        }
    }

    public function sendPasswordResetEmail(string $email): ApiResponseDto
    {
        try {
            //TODO: send restart pass email for this address
            return Response::success(ResponseMessages::PASSWORD_RESET_SEND);
        } catch (Throwable $exception) {
            return Response::fail($exception->getMessage());
        }
    }
}
