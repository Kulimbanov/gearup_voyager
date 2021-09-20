<?php

namespace App\Repository;

use App\DTO\Auth\UserDto;
use App\Models\User;

class UserRepository
{
    /**
     * @throws \Throwable
     */
    public function register(UserDto $userDto): User
    {
        return (new User)->create([
            User::NAME => $userDto->getName(),
            User::EMAIL => $userDto->getEmail(),
            User::PASSWORD => $userDto->getPassword(),
        ]);
    }

    public function verifyByUserId(int $userId): bool
    {
        return (new User)->find($userId)->updateOrFail([User::EMAIL_VERIFIED_AT => strtotime(now())]);
    }

}
