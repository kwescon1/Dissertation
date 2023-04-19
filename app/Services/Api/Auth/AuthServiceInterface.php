<?php

namespace App\Services\Api\Auth;

use Illuminate\Http\Request;

interface AuthServiceInterface
{

    const LOGIN_CACHE_SECONDS = 60 * 60 * 24;

    public function loginUser($data): ?object;
    public function logout(Request $request): bool;
}
