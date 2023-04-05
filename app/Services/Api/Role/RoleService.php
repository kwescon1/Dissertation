<?php

namespace App\Services\Api\Role;

use App\Models\Role;
use App\Services\Api\CoreService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Collection;

class RoleService extends CoreService implements RoleServiceInterface
{
    private $viewAny;

    public function __construct()
    {
        $this->viewAny = 'viewAny';
    }

    /**
     * @param string $facilityBranchId
     * @return Collection|NULL
     */
    public function listRoles(string $facilityBranchId): ?Collection
    {
        $roles = Role::withCount('users')->whereFacilityBranchId($facilityBranchId)->get();

        Gate::authorize($this->viewAny, Role::class);

        return $roles;
    }
}
