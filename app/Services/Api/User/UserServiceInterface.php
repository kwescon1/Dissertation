<?php

namespace App\Services\Api\User;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserServiceInterface
{

    const STATUS_PENDING = 0; // default on add new user
    const STATUS_ACTIVE = 1;
    const STATUS_SUSPENDED = 2;

    public function findUserByUsername(string $username): ?object;

    public function users(string $facilityId, string $facilityBranchId): ?Collection;

    public function user(string $id, string $facilityId, string $facilityBranchId): ?object;

    public function destroyUser(string $id, string $facilityId): bool;

    public function createUser(array $data): ?Model;

    public function updateUser(array $data, string $id, string $facilityId, string $facilityBranchId): ?Model;
}
