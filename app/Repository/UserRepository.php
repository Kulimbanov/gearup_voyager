<?php

namespace App\Repository;

use App\DTO\Auth\UserDto;
use App\Models\User;

class UserRepository
{
    /**
     * @throws \Throwable
     */
    public function register(UserDto $userDto): void
    {
        (new User)->create([
            User::NAME => $userDto->getName(),
            User::EMAIL => $userDto->getEmail(),
            User::PASSWORD => $userDto->getPassword(),
        ]);
    }
}
