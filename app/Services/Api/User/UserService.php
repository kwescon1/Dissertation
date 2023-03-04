<?php

namespace App\Services\Api\User;

use App\Models\User;
use App\Services\Api\CoreService;

class UserService extends CoreService implements UserServiceInterface
{

    /**
     * @param string $username
     * @return object?|NULL
     */
    public function findUserByUsername(string $username): ?object
    {
        return User::whereUsername($username)->first();
    }
}
