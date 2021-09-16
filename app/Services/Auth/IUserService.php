<?php

namespace App\Services\Auth;

use App\DTO\ApiResponseDto;
use App\DTO\Auth\UserDto;

interface IUserService
{
    public function register(UserDto $userDto): ApiResponseDto;

    public function login(UserDto $userDto): ApiResponseDto;

    public function logout(): ApiResponseDto;

    public function sendPasswordResetEmail(string $email): ApiResponseDto;
}
