<?php

namespace App\Services\Api\Role;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface RoleServiceInterface
{
    public function listRoles(string $facilityBranchId): ?Collection;

    public function role(string $id, string $facilityBranchId): ?object;

    public function destroyRole(string $id, string $facilityBranchId): bool;

    public function createRole(array $data, string $facilityBranchId): ?Model;
}
