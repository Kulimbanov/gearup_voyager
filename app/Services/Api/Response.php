<?php

namespace App\Services\Api;

use App\DTO\ApiResponseDto;
use Illuminate\Support\Collection;

final class Response
{
    public static function success(?string $message, Collection $data = null): ApiResponseDto
    {
        return (new ApiResponseDto)->setSuccess(true)->setMessage($message)->setData($data);
    }

    public static function fail(?string $message, Collection $data = null): ApiResponseDto
    {
        return (new ApiResponseDto)->setSuccess(false)->setMessage($message)->setData($data);
    }
}
