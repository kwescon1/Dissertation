<?php

namespace App\Services\Api\Auth;

interface AuthServiceInterface
{

    const LOGIN_CACHE_SECONDS = 60 * 60 * 24;

    public function loginUser($data): ?object;
}
