<?php

namespace App\Services\Api\User;

interface UserServiceInterface
{

    const STATUS_PENDING = 0; // default on add new user
    const STATUS_ACTIVE = 1;
    const STATUS_SUSPENDED = 2;

    public function findUserByUsername(string $username): ?object;
}
