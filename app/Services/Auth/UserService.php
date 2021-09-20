<?php

namespace App\Services\Auth;

use App\DTO\ApiResponseDto;
use App\DTO\Auth\EmailVerifyResponseDto;
use App\DTO\Auth\UserDto;
use App\ENUM\ResponseMessages;
use App\Providers\RouteServiceProvider;
use App\Repository\UserRepository;
use App\Services\Api\Response;
use App\Services\Page\Generator\IPublicPageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Throwable;

class UserService implements IUserService
{
    private UserRepository $userRepository;

    protected IPublicPageService $pageService;

    public function __construct(UserRepository $userRepository, IPublicPageService $pageService)
    {
        $this->userRepository = $userRepository;
        $this->pageService = $pageService;
    }

    public function register(UserDto $userDto): ApiResponseDto
    {
        try {
            $user = $this->userRepository->register($userDto);
            $user->sendEmailVerificationNotification();
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

    public function verifyEmail(int $userId): EmailVerifyResponseDto
    {
        //todo:: do it better
        $publicPageDto = $this->pageService->getPublicPageDto(RouteServiceProvider::HOME);
        $returnDto = new EmailVerifyResponseDto($publicPageDto);

        try {
            $this->userRepository->verifyByUserId($userId);
        } catch (\Throwable $exception) {
            $returnDto->setApiResponseDto(Response::fail($exception->getMessage()));
        }

        Auth::loginUsingId($userId, true);

        if (!Auth::check()) {
            $returnDto->setApiResponseDto(Response::fail(ResponseMessages::REGISTER_FAIL));
        }

        return $returnDto->setApiResponseDto(Response::success(ResponseMessages::VERIFY_SUCCESS));
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
