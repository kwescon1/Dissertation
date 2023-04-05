<?php

namespace App\Services\Api\Role;

use App\Models\Role;
use App\Services\Api\CoreService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Collection;

class RoleService extends CoreService implements RoleServiceInterface
{
    private $viewAny, $view;

    public function __construct()
    {
        $this->viewAny = 'viewAny';
        $this->view = 'view';
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

    /**
     * Get the specified resource.
     *
     * @param  string  $id
     * @param string $facilityBranchId
     * @return object|Null
     */
    public function role(string $id, string $facilityBranchId): ?object
    {
        $role = Role::whereId($id)->whereFacilityBranchId($facilityBranchId)->with('permissions')->with('users.user')->first();


        if (!$role) {
            Log::error("Role with id: $id does not exist in this facility branch");

            throw new NotFoundException("The specified role does not exist");
        }

        Gate::authorize($this->view, $role);

        return $role;
    }
}
