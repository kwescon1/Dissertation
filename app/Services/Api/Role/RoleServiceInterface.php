<?php

namespace App\Services\Api\Role;

use Illuminate\Support\Collection;

interface RoleServiceInterface
{
    public function listRoles(string $facilityBranchId): ?Collection;
}
